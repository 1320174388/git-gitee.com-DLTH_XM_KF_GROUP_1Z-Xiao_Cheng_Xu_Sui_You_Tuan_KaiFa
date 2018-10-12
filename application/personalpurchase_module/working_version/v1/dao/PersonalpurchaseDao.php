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
use app\personalpurchase_module\working_version\v1\model\GroupModel;
use app\personalpurchase_module\working_version\v1\model\ScenicModel;
use app\personalpurchase_module\working_version\v1\model\CouponModel;

class PersonalpurchaseDao implements PersonalpurchaseInterface
{
    /**
     * 名  称 : personalpurchaseCreate()
     * 功  能 : 个人购票数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenic_id']    => '景区ID';
     * 输  入 : $post['token']        => '用户token';
     * 输  入 : $post['coupon_id']    => '优惠券ID不使用发0';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 14:29
     */
    public function personalpurchaseCreate($post)
    {
        // TODO :  实例化景区表 ScenicModel 模型 获取景区数据
        $scenicData = ScenicModel::get($post['scenic_id']);
        if(!$scenicData){
            return returnData('error','景区不存在');
        }
        // TODO :  实例化景区表 ScenicModel 模型 获取景区数据
        $couponData = CouponModel::get($post['coupon_id']);
        if(!$couponData){
            $couponData = [];
            $couponData['coupon_money'] = 0;
        }
        // TODO :  处理数据
        $money = math_sub($scenicData['scenic_ticket'], $couponData['coupon_money']);
        if($money<=0){
            $money = 0.01;
        }
        $user = UserModel::where(
            'user_token',$post['token']
        )->find();
        $_POST = [
            'token'        => $post['token'],
            'attach'       => json_encode($post,320),
            'body'         => $scenicData['scenic_name'].'-景区门票',
            'total_fee'    => $money,
            'out_trade_no' => time().mt_rand(1000,9999).$user['user_id'],
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