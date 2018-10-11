<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ordergrouppurchase_route_v1_api.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 15:57
 *  文件描述 :  查看团购信息
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 查看团购信息页
 */
Route::get(
    'v1/ordergrouppurchase_module/Ordergrouppurchase',
    'ordergrouppurchase_module/v1.controller.OrdergrouppurchaseController/Ordergrouppurchase'
);