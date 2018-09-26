<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  couponlist_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 添加优惠券数据
 */
Route::post(
    ':v/couponlist_module/couponlist_route',
    'couponlist_module/:v.controller.CouponlistController/couponlistPost'
);

/**
 * 传值方式 : GET
 * 路由功能 : 获取景区所有优惠券信息
 */
Route::get(
    ':v/couponlist_module/couponlist_route',
    'couponlist_module/:v.controller.CouponlistController/couponlistGet'
);
