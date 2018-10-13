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
use app\personalpurchase_module\working_version\v1\model\GroupModel;
use app\personalpurchase_module\working_version\v1\model\MemberModel;
use app\personalpurchase_module\working_version\v1\model\PrizeModel;
use app\personalpurchase_module\working_version\v1\model\BagModel;

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
        file_put_contents('./data.txt',json_encode($data,320));

        // 定义状态
        $depictArr = [
            1 => '个人购票订单',
            2 => '团购购票订单',
            3 => '团购购票订单',
            4 => '预约团购订单',
            5 => '预约团购订单',
        ];
        $dataArr = json_decode($data['attach'],true);
        // 如果已经处理订单，将不再处理
        $result = MemberModel::where(
            'group_invite',$dataArr['invitanumber']
        )->find();
        if($result){return;}
        // TODO : 启动事务
        \think\Db::startTrans();
        try {
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
                $group->group_num    = '1';
                $group->man_num      = '1';
                $group->group_type   = '1';
                $group->order_depict = $depictArr[$dataArr['group_type']];
                $group->group_status = '1';
                $group->group_time   = time();
                $group->group_money  = math_div($data['total_fee'],100);
                // 保存数据
                $group->save();
                // 配置订单号
                $out_trade_no = $data['out_trade_no'];
            }else{
                // 赋值邀请人订单号
                $out_trade_no = $dataArr['invitanumber'];
            }
            // 实例化订单表模型
            $member = new MemberModel();
            // 处理数据
            $member->group_number   = $out_trade_no;
            $member->user_token     = $dataArr['token'];
            $member->group_invite   = $data['out_trade_no'];
            $member->member_status  = '1';
            $member->comment_status = '0';
            $member->comment_status = '1';
            $member->member_time    = time();
            // 保存数据
            $member->save();

            // 如果用户是通过邀请码进入团购的，
            // 邀请码订单号发起人随机获取一个景区的奖品到个人仓库
            $prizeArr = PrizeModel::where(
                'scenic_id',$dataArr['scenic_id']
            )->where(
                'prize_status',1
            )->select()->toArray();
            // 随机获取一个奖品
            $prizeData = $prizeArr[mt_rand(0,count($prizeArr)-1)];

            // 给邀请人添加奖品
            $result = MemberModel::where(
                'group_invite',$post['invitanumber']
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
            // 提交事务
            \think\Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            file_put_contents('./Exception.txt',json_encode($e,320));
        }
    }
}