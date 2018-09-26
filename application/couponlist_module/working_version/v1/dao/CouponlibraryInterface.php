<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlibraryInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\dao;

interface CouponlibraryInterface
{
    /**
     * 名  称 : couponlibraryUpdate()
     * 功  能 : 声明:审核优惠券数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['coupon_id']     => '优惠券ID标识';
     * 输  入 : $put['coupon_status'] => '审核状态';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/26 19:17
     */
    public function couponlibraryUpdate($put);
}