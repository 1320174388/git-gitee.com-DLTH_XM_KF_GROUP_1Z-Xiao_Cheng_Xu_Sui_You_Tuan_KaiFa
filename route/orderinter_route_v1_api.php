<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  orderinter_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 获取订单列表
 */
Route::get(
    ':v/orderinter_module/orderinter_route',
    'orderinter_module/:v.controller.OrderinterController/orderinterGet'
)->middleware('Right_v1_IsAdmin');

/**
 * 传值方式 : GET
 * 路由功能 : 获取订单详情
 */
Route::get(
    ':v/orderinter_module/orderinfo_route',
    'orderinter_module/:v.controller.OrderinfoController/orderinfoGet'
)->middleware('Right_v1_IsAdmin');
