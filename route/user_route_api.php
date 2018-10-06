<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ticketgroup_route_v1_api.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  用户端路由
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 模糊查询景区
 */
Route::get(
    ':v/user_module/searchScenicGet',
    'user_module/:v.controller.SearchScenicController/searchScenicGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 精准查询景区
 */
Route::get(
    ':v/user_module/accurateScenicGet',
    'user_module/:v.controller.SearchScenicController/accurateScenicGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询景区详细信息
 */
Route::get(
    ':v/user_module/scenicInfoGet',
    'user_module/:v.controller.SearchScenicController/scenicInfoGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询景区轮播图信息
 */
Route::get(
    ':v/user_module/scenicCarouselGet',
    'user_module/:v.controller.SearchScenicController/scenicCarouselGet'
);