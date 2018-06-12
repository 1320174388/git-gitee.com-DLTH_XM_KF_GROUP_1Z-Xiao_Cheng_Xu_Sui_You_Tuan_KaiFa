<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  login_route_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 15:04
 *  文件描述 :  模块路由地址
 *  历史记录 :  -----------------------
 */
Route::post('/login_init/:code','login/LoginController/loginInit');