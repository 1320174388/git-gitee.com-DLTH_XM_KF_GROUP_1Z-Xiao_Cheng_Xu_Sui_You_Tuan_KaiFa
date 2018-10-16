<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票数据层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\dao;
use app\wx_payment_module\working_version\v1\library\WxPayLibrary;
use app\wx_payment_module\working_version\v1\library\WxRefund;
use app\personalpurchase_module\working_version\v1\library\AccessTokenRequest;
use app\personalpurchase_module\working_version\v1\library\TemplateMessagePushLibrary;
use app\personalpurchase_module\working_version\v1\model\GroupModel;
use app\personalpurchase_module\working_version\v1\model\MemberModel;
use app\personalpurchase_module\working_version\v1\model\PrizeModel;
use app\personalpurchase_module\working_version\v1\model\BagModel;
use app\personalpurchase_module\working_version\v1\model\UserModel;
use app\personalpurchase_module\working_version\v1\model\TicketModel;

class PersonalnotifyDao implements PersonalnotifyInterface
{
    /**
     * 名  称 : personalnotifyCreate()
     * 功  能 : 个人购票回调数据处理
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 16:36
     */
    public function personalnotifyCreate($post)
    {
        // TODO : wxPayNotify 回调
        $data = (new WxPayLibrary)->wxPayNotify();
        file_put_contents('./Data.txt',json_encode($data,320));
        // TODO : 启动事务
        \think\Db::startTrans();
        try {
            // 如果已经处理订单，将不再处理
            $result = MemberModel::where(
                'group_invite',$data['out_trade_no']
            )->find();
            if($result){return '';}
            // 定义状态
            $depictArr = [
                1 => '个人购票订单', 2 => '团购购票订单',
                3 => '团购购票订单', 4 => '预约团购订单',
                5 => '预约团购订单',
            ];
            $typeArr   = [ 1 => 1, 2 => 2, 3 => 2, 4 => 3, 5 => 3, ];
            $statusArr = [ 1 => 1, 2 => 0, 3 => 0, 4 => 0, 5 => 0, ];
            $dataArr = json_decode(
                file_get_contents(
                    './uploads/payment_order_information/'.$data['out_trade_no'].'.txt'
                ),true
            );
            if(file_exists('./uploads/payment_order_information/'.$data['out_trade_no'].'.txt')){
                unlink('./uploads/payment_order_information/'.$data['out_trade_no'].'.txt');
            }
            // 判断购票状态
            if(
                ($dataArr['group_type']!='3')&&
                ($dataArr['group_type']!='5')
            ){
                // 实例化订单表模型
                $group = new GroupModel();
                // 处理数据
                $group->group_number = $data['out_trade_no'];
                $group->scenic_id    = $dataArr['scenic_id'];
                $group->group_num    = $dataArr['group_num'];
                $group->man_num      = '1';
                $group->group_type   = $typeArr[$dataArr['group_type']];
                $group->order_depict = $depictArr[$dataArr['group_type']];
                $group->group_status = $statusArr[$dataArr['group_type']];;
                $group->group_time   = time();
                $group->group_money  = $dataArr['group_money'];
                // 保存数据
                $group->save();
                // 配置订单号
                $out_trade_no = $data['out_trade_no'];

                // 实例化订单表模型
                $member = new MemberModel();
                // 处理数据
                $member->group_number   = $out_trade_no;
                $member->user_token     = $dataArr['token'];
                $member->group_invite   = $data['out_trade_no'];
                $member->member_status  = '1';
                $member->comment_status = '0';
                $member->group_status   = $statusArr[$dataArr['group_type']];
                $member->form_id        = $dataArr['form_id'];
                $member->member_time    = time();
                $member->group_money    = math_div($data['total_fee'],100);
                // 保存数据
                $member->save();
                // 个人购票
                if($dataArr['group_type']=='1'){
                    $data = [
                        'scenic_id'    => $dataArr['scenic_id'],
                        'user_token'   => $dataArr['token'],
                        'order_number' => $data['out_trade_no'],
                        'ticket_type'  => $dataArr['group_type'],
                        'ticket_sratus'=> 0,
                        'group_money'  => $dataArr['group_money'],
                    ];
                    $this->userTicketData(
                        $data,
                        $member,
                        $dataArr['group_money'].'',
                        $dataArr['scenic_name']
                    );
                }
            }else{
                // 获取已存在订单数据
                $group = GroupModel::get($dataArr['invitanumber']);
                if($group['group_num']==$group['man_num']){
                    (new WxRefund)->wxRefund([
                        'out_trade_no'   => $data['out_trade_no'],
                        'total_fee'      => $data['total_fee'],
                        'refund_fee'     => $data['total_fee'],
                        'refund_desc'    => '团购人数已满加入失败'
                    ]);
                    // 回滚事务
                    \think\Db::rollback();
                    return '';
                }
                if($group['group_status']=='1'){
                    (new WxRefund)->wxRefund([
                        'out_trade_no'   => $data['out_trade_no'],
                        'total_fee'      => $data['total_fee'],
                        'refund_fee'     => $data['total_fee'],
                        'refund_desc'    => '团购已结束加入失败'
                    ]);
                    // 回滚事务
                    \think\Db::rollback();
                    return '';
                }
                // 处理数据
                $group->man_num      = math_add($group['man_num'],'1',0);
                if($group['group_num']==$group['man_num']){
                    $group->group_status = '1';
                }
                $group->group_money  = $dataArr['group_money'];
                // 保存数据
                $group->save();
                // 赋值邀请人订单号
                $out_trade_no = $dataArr['invitanumber'];

                // 实例化订单表模型
                $member = new MemberModel();
                // 处理数据
                $member->group_number   = $out_trade_no;
                $member->user_token     = $dataArr['token'];
                $member->group_invite   = $data['out_trade_no'];
                $member->form_id        = $dataArr['form_id'];
                $member->member_status  = '1';
                $member->comment_status = '0';
                if($group['group_num']==$group['man_num']){
                    $member->group_status = '1';
                }else{
                    $member->group_status = '0';
                }
                $member->member_time    = time();
                $member->group_money    = math_div($data['total_fee'],100);
                // 保存数据
                $member->save();

                if($group['group_num']==$group['man_num']){
                    // 修改所有团购人员状态
                    $memberResult = $this->updataGroupStatus($out_trade_no);
                    if(
                        ($dataArr['group_type']!='4')&&
                        ($dataArr['group_type']!='5')
                    ){
                        // 团购购票
                        $data = [
                            'scenic_id'    => $dataArr['scenic_id'],
                            'user_token'   => '',
                            'order_number' => '',
                            'ticket_type'  => $dataArr['group_type'],
                            'ticket_sratus'=> 0,
                            'group_money'  => $dataArr['group_money'],
                        ];
                        $this->userTicketData(
                            $data,$memberResult,
                            $dataArr['group_money'].'',
                            $dataArr['scenic_name'],
                            true
                        );
                    }
                }
            }

            if(
                ($dataArr['group_type']!='4')&&
                ($dataArr['group_type']!='5')&&
                (!empty($dataArr['coupon_id']))
            ){
                // TODO :  实例化优惠券表 CouponModel 模型 获取优惠券数据
                $bagData = BagModel::get($dataArr['coupon_id']);
                $bagData->bag_status = 1;
                $bagData->save();

            }

            // 如果用户是通过邀请码进入团购的，
            // 邀请码订单号发起人随机获取一个景区的奖品到个人仓库
            if($dataArr['invitation']=='yes'){
                // 获取奖品数据
                $prizeArr = PrizeModel::where(
                    'scenic_id',$dataArr['scenic_id']
                )->where(
                    'prize_status',1
                )->select()->toArray();
                // 随机获取一个奖品
                if(count($prizeArr)<=1){
                    $prizeData = $prizeArr[0];
                }else{
                    $prizeData = $prizeArr[mt_rand(0,count($prizeArr))];
                }
                // 给邀请人添加奖品
                $result = MemberModel::where(
                    'group_invite',$dataArr['invitanumber']
                )->find();
                // 获取邀请人Token值
                $userToken = $result['user_token'];
                // 给用户添加奖品
                $bag = new BagModel();
                // 处理数据
                $bag->user_token = $userToken;
                $bag->index_id   = $prizeData['prize_id'];
                $bag->bag_type   = 'prize';
                $bag->bag_status = 0;
                $bag->bag_time   = time();
                // 保存数据
                $bag->save();
            }
            // 提交事务
            \think\Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            file_put_contents('./Exception1.txt',$e);
        }
    }

    /**
     * 修改团购所有人完成状态
     */
    private function updataGroupStatus($orderNumber)
    {
        // 获取所有团购人员信息
        $member = MemberModel::where(
            'group_number',$orderNumber
        )->where(
            'member_status',1
        );
        $member1 = clone($member);
        $member2 = clone($member);
        $member2->update(['group_status' => 1]);
        $memberResult = $member1->select()->toArray();
        return $memberResult;
    }

    /**
     * 给用户添加门票
     */
    private function userTicketData($data=[],$memberResult=false,$group_money,$scenic_name,$type = false)
    {
        $ticket =  new TicketModel();
        if($type){
            $list = [];
            $user_token_str = '';
            $Arr = [];
            foreach($memberResult as $v){
                $data['user_token']   = $v['user_token'];
                $data['order_number'] = $v['group_invite'];
                $list[] = $data;
                $user_token_str.= $v['user_token'].',';
                $Arr[$v['user_token']] = $v;
            }
            $user_token_str = rtrim($user_token_str,',');
            // TODO :  获取success_token
            $accessTokenArr = AccessTokenRequest::wxRequest(
                config('v1_config.wx_AppID'),
                config('v1_config.wx_AppSecret'),
                './project_access_token/'
            );

            // TODO :  获取openid
            $userArr = UserModel::field('user_token,user_openid')->where(
                'user_token','in',$user_token_str
            )->select()->toArray();

            foreach($userArr as $v){
                // 发送模板消息
                TemplateMessagePushLibrary::sendTemplate(
                    $accessTokenArr['data']['access_token'],
                    [
                        'touser'      => $v['user_openid'],
                        'template_id' => config('wx_config.wx_Ticket_Push'),
                        'page'        => config('wx_config.wx_Ticket_URL'),
                        'form_id'     => $Arr[$v['user_token']]['form_id'],
                        'data'        => [
                            'keyword1' => ['value'=>$Arr[
                                $v['user_token']
                            ]['group_invite']],
                            'keyword2' => ['value'=>$group_money],
                            'keyword3' => ['value'=>1],
                            'keyword4' => ['value'=>$scenic_name],
                        ],
                    ]
                );
            }
        }else{
            $list = [];
            $list[] = $data;
            // TODO :  获取success_token
            $accessTokenArr = AccessTokenRequest::wxRequest(
                config('v1_config.wx_AppID'),
                config('v1_config.wx_AppSecret'),
                './project_access_token/'
            );

            // TODO :  获取openid
            $userArr = UserModel::field('user_openid')->where(
                'user_token',$data['user_token']
            )->find();

            // 发送模板消息
            TemplateMessagePushLibrary::sendTemplate(
                $accessTokenArr['data']['access_token'],
                [
                    'touser'      => $userArr['user_openid'],
                    'template_id' => config('wx_config.wx_Ticket_Push'),
                    'page'        => config('wx_config.wx_Ticket_URL'),
                    'form_id'     => $memberResult['form_id'],
                    'data'        => [
                        'keyword1' => ['value'=>$memberResult['group_invite']],
                        'keyword2' => ['value'=>$group_money],
                        'keyword3' => ['value'=>1],
                        'keyword4' => ['value'=>$scenic_name],
                    ],
                ]
            );
        }
        $ticket->saveAll($list);
    }
}