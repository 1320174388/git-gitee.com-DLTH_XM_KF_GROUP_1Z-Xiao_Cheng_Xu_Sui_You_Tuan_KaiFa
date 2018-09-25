<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  scenicspot_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 添加轮播图接口
 */
Route::post(
    ':v/scenicspot_module/scenicspot_route',
    'scenicspot_module/:v.controller.ScenicspotController/scenicspotPost'
);
