<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  personalorder_route_v1_api.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/10 19：19
 *  文件描述 :  查个人订单
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 查个人订单
 */
Route::get(
    'v1/personalorder_module/Personalorder',
    'personalorder_module/v1.controller.PersonalorderController/Personalorder'
);