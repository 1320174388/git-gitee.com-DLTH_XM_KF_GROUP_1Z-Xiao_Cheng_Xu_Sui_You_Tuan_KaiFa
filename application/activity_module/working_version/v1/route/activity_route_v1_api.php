<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  activity_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 添加活动
 */
Route::post(
    ':v/activity_module/activity_route',
    'activity_module/:v.controller.ActivityController/activityPost'
);

/**
 * 传值方式 : POST
 * 路由功能 : 添加活动详情
 */
Route::post(
    ':v/activity_module/activitcont_route',
    'activity_module/:v.controller.ActivitcontController/activitcontPost'
);

/**
 * 传值方式 : DELETE
 * 路由功能 : 删除活动详情
 */
Route::delete(
    ':v/activity_module/activitcont_route',
    'activity_module/:v.controller.ActivitcontController/activitcontDelete'
);

/**
 * 传值方式 : GET
 * 路由功能 : 获取活动详情列表
 */
Route::get(
    ':v/activity_module/activitcont_route',
    'activity_module/:v.controller.ActivitcontController/activitcontGet'
);

/**
 * 传值方式 : GET
 * 路由功能 : 获取活动广告列表
 */
Route::get(
    ':v/activity_module/activity_route',
    'activity_module/:v.controller.ActivityController/activityGet'
);


/**
 * 传值方式 : GET
 * 路由功能 : 二次获取活动列表
 */
Route::get(
    ':v/activity_module/activit2_route',
    'activity_module/:v.controller.Activit2Controller/activit2Get'
);

/**
 * 传值方式 : POST
 * 路由功能 : 修改活动广告信息
 */
Route::post(
    ':v/activity_module/activity_routput',
    'activity_module/:v.controller.ActivityController/activityPut'
);
