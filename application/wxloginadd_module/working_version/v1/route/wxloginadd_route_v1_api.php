<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  wxloginadd_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 授权登录
 */
Route::post(
    ':v/wxloginadd_module/wxloginadd_route',
    'wxloginadd_module/:v.controller.WxloginaddController/wxloginaddPost'
);
