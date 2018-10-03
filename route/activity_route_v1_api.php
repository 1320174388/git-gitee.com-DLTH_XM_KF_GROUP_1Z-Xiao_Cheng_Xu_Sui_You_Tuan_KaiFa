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
