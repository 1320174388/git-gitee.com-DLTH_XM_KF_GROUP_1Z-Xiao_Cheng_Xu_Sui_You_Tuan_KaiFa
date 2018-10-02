<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\dao;

interface CouponlistInterface
{
    /**
     * 名  称 : couponlistCreate()
     * 功  能 : 声明:添加优惠券数据数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['user_token']    => '用户标识';
     * 输  入 : $post['scenic_id']     => '景区主键';
     * 输  入 : $post['coupon_money']  => '优惠金额';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/26 14:46
     */
    public function couponlistCreate($post);

    /**
     * 名  称 : couponlistSelect()
     * 功  能 : 声明:获取景区所有优惠券信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenic_id'] => '景区ID';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/26 20:41
     */
    public function couponlistSelect($get);

    /**
     * 名  称 : couponlistDelete()
     * 功  能 : 声明:删除优惠券数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['user_token'] => '用户Token标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/27 09:31
     */
    public function couponlistDelete($delete);
}