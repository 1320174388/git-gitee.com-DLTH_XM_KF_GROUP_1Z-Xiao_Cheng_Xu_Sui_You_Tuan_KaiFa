<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  application_route_v1_api.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请路由文件
 *  历史记录 :  -----------------------
 */
/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：执行申请景区路由地址
 */
Route::post(
    'v1/application_module/scenicPost',
    'application_module/v1.controller.ScenicController/scenicPost'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区列表
 */
Route::post(
    'v1/application_module/obtainScenic',
    'application_module/v1.controller.ScenicController/obtainScenic'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区申请
 */
Route::post(
    'v1/application_module/modifyScenic',
    'application_module/v1.controller.ScenicController/modifyScenic'
);