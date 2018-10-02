<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CoupondelInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\dao;

interface CoupondelInterface
{
    /**
     * 名  称 : coupondelDelete()
     * 功  能 : 声明:删除优惠券数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/27 09:54
     */
    public function coupondelDelete($delete);
}