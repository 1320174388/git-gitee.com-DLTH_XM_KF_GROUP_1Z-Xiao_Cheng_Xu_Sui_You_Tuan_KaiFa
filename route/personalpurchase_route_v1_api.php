<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  personalpurchase_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 个人购票
 */
Route::post(
    ':v/personalpurchase_module/personalpurchase_route',
    'personalpurchase_module/:v.controller.PersonalpurchaseController/personalpurchasePost'
);

/**
 * 传值方式 : rule
 * 路由功能 : 个人购票回调
 */
Route::rule(
    ':v/personalpurchase_module/personalnotify_route',
    'personalpurchase_module/:v.controller.PersonalnotifyController/personalnotifyPost'
);
