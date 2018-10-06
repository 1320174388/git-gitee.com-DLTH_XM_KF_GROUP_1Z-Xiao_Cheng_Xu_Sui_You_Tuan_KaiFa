<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  operation_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 获取所有景区申请信息
 */
Route::get(
    ':v/operation_module/operation_route',
    'operation_module/:v.controller.OperationController/operationGet'
);

/**
 * 传值方式 : PUT
 * 路由功能 : 审核景区操作
 */
Route::put(
    ':v/operation_module/operation_route',
    'operation_module/:v.controller.OperationController/operationPut'
);
