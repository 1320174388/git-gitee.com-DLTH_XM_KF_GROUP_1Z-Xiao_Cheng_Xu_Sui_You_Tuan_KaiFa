<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  deductions_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 14:10
 *  文件描述 :  扣除景区押金路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : PUT
 * 路由功能 : 扣除景区押金
 */
Route::put(
    ':v/deductions_module/deductions_route',
    'deductions_module/:v.controller.DeductionsController/deductionsPut'
);
/**
 * 传值方式 : get
 * 路由功能 : 获取景区平均星级
 */
Route::get(
    ':v/deductions_module/scenicLevelGet',
    'deductions_module/:v.controller.DeductionsController/scenicLevelGet'
);
