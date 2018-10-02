<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ticketgroup_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 获取门票信息
 */
Route::get(
    ':v/ticketgroup_module/ticketgroup_route',
    'ticketgroup_module/:v.controller.TicketgroupController/ticketgroupGet'
);

/**
 * 传值方式 : PUT
 * 路由功能 : 修改门票金额
 */
Route::put(
    ':v/ticketgroup_module/ticketgroup_route',
    'ticketgroup_module/:v.controller.TicketgroupController/ticketgroupPut'
);

/**
 * 传值方式 : POST
 * 路由功能 : 添加团购模式
 */
Route::post(
    ':v/ticketgroup_module/purchase_route',
    'ticketgroup_module/:v.controller.PurchaseController/purchasePost'
);


/**
 * 传值方式 : DELETE
 * 路由功能 : 删除团购模式
 */
Route::delete(
    ':v/ticketgroup_module/purchase_route',
    'ticketgroup_module/:v.controller.PurchaseController/purchaseDelete'
);
