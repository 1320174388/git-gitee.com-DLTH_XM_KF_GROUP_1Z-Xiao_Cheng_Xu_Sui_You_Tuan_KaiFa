<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  qrcode_route_v1_api.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码路由文件
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : POST
 * 路由功能 : 生成二维码
 */
Route::post(
    ':v/qrcode_module/qrcode_route',
    'qrcode_module/:v.controller.QrcodeController/qrcodePost'
);
