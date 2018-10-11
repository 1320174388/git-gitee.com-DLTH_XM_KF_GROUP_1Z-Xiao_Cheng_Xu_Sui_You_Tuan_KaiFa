<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  grouppurchaselist_route_api.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 19:23
 *  文件描述 :  景区下正在进行的团购订单
 *  历史记录 :  -----------------------
 */
/**
 * 传值方式：GET
 * 传值参数：[ :v => 版本号 ]
 * 路由功能：查看景区下正在进行的团购订单
 */
Route::get(
    ':v/grouppurchaselist_module/Grouppurchaselist',
    'grouppurchaselist_module/:v.controller.GrouppurchaselistController/Grouppurchaselist'
);