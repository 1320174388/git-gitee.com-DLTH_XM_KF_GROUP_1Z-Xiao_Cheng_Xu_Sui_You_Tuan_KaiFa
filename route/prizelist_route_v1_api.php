<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  prizelist_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 添加奖品信息
 */
Route::post(
    ':v/prizelist_module/prizelist_route',
    'prizelist_module/:v.controller.PrizelistController/prizelistPost'
);

/**
 * 传值方式 : GET
 * 路由功能 : 获取奖品信息
 */
Route::get(
    ':v/prizelist_module/prizelist_route',
    'prizelist_module/:v.controller.PrizelistController/prizelistGet'
);
