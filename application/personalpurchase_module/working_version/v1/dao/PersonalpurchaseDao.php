<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalpurchaseDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票数据层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\dao;
use app\wx_payment_module\working_version\v1\library\WxPayLibrary;
use app\personalpurchase_module\working_version\v1\model\UserModel;
use app\personalpurchase_module\working_version\v1\model\ScenicModel;
use app\personalpurchase_module\working_version\v1\model\CouponModel;
use app\personalpurchase_module\working_version\v1\model\MemberModel;
use app\personalpurchase_module\working_version\v1\model\GroupTypeModel;

class PersonalpurchaseDao implements PersonalpurchaseInterface
{
    /**
     * 名  称 : personalpurchaseCreate()
     * 功  能 : 个人购票数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenic_id']    => '景区ID';
     * 输  入 : $post['group_id']     => '团购ID';
     * 输  入 : $post['group_type']   => '购票类型:1=个人,2=发起团购,3=加入团购,4=发起预约,5=加入预约';
     * 输  入 : $post['token']        => '用户token';
     * 输  入 : $post['coupon_id']    => '优惠券ID不使用发0';
     * 输  入 : $post['invitation']   => '邀请状态标识:yes/no';
     * 输  入 : $post['invitanumber'] => '邀请码或加入订单号';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 14:29
     */
    public function personalpurchaseCreate($post)
    {
        // TODO :  判断用户是否已经在本次要加入的团购中
        if(
            ($post['group_type']=='3')||
            ($post['group_type']=='5')||
            ($post['invitation']=='yes')
        ){
            $result = MemberModel::where(
                'group_invite',$post['invitanumber']
            )->where(
                'user_token',$post['token']
            )->find();
            if($result){
                return returnData('error','您已经在本团购中');
            }
        }
        // TODO :  实例化景区表 ScenicModel 模型 获取景区数据
        $scenicData = ScenicModel::get($post['scenic_id']);
        if(!$scenicData){
            return returnData('error','景区不存在');
        }

        // TODO :  实例化优惠券表 CouponModel 模型 获取优惠券数据
        $couponData = CouponModel::get($post['coupon_id']);
        if(!$couponData){
            $couponData = [];
            $couponData['coupon_money'] = 0;
        }
        if($post['group_type']!='1'){
            // TODO : 获取团购数据
            $groupType = GroupTypeModel::where(
                'group_id',$post['group_id']
            )->where(
                'group_status',1
            )->find();
            if(!$groupType){
                return returnData('error','团购模式已被删除');
            }
        }

        // 判断购票状态
        if($post['group_type']=='1'){
            // TODO :  处理数据
            $money = math_sub($scenicData['scenic_ticket'], $couponData['coupon_money']);
            $post['group_num'] = 1;
            $post['group_money'] = $scenicData['scenic_ticket'];
        }elseif(
            ($post['group_type']=='2')||
            ($post['group_type']=='3')
        ){
            // TODO :  处理数据
            $money = math_sub($groupType['group_money'], $couponData['coupon_money']);
            $post['group_num'] = $groupType['group_num'];
            $post['group_money'] = $groupType['group_money'];
        }else{
            // TODO :  处理数据
            $money = $groupType['group_money'];
            $post['group_num'] = $groupType['group_num'];
            $post['group_money'] = $groupType['group_money'];
        }
        if($money<=0){
            $money = 0.01;
        }

        $user = UserModel::where(
            'user_token',$post['token']
        )->find();

        $out_trade_no = time().mt_rand(1000,9999).$user['user_id'];

        file_put_contents(
            './uploads/payment_order_information/'.$out_trade_no.'.txt',
            json_encode($post,320)
        );

        $_POST = [
            'token'        => $post['token'],
            'attach'       => $out_trade_no,
            'body'         => $scenicData['scenic_name'].'-景区门票',
            'total_fee'    => $money,
            'out_trade_no' => $out_trade_no,
        ];

        // 发起预支付订单
        $res = (new WxPayLibrary)->wxUnifiedApy(
            "https://{$_SERVER['HTTP_HOST']}/v1/personalpurchase_module/personalnotify_route"
        );

        // TODO :  处理函数返回值
        return \RSD::wxReponse(
            $res,'M', json_decode($res['data']),json_decode($res['data'])
        );
    }
}