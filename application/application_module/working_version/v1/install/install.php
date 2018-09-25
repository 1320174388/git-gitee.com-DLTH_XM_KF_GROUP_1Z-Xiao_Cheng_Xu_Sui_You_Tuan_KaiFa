<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  install.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/08/15 20:27
 *  文件描述 :  Wx_小程序：执行函数生成类
 *  历史记录 :  -----------------------
 */
include('./library/Function_Create_Library.php');

Function_Create_Library::execCreateFunction([
    // 传值类型 : (GET/POST/PUT/DELETE)
    'dataType' => 'POST',
    // 函数名称 : 默认 __function
    'name'     => 'scenic',
    // 函数说明 : 默认 新创建函数
    'explain'  => '景区申请',
    // 函数输入 : 示例 [
    //  '$get['goodLimit']  => '商品页码';',
    //]
    'input'    => [
        '\'$post[\'scenic_id\']  => \'景区主键\';\'',
        '\'$post[\'user_token\']  => \'用户token\';\'',
        '\'$post[\'scenic_name\']  => \'景区名称\';\'',
        '\'$post[\'scenic_img\']  => \'景区图片\';\'',
        '\'$post[\'scenic_address\']  => \'景区地址\';\'',
        '\'$post[\'scenic_man\']  => \'景区负责人\';\'',
        '\'$post[\'scenic_phone\']  => \'联系电话\';\'',
        '\'$post[\'scenic_license\']  => \'执照照片路径\';\'',
        '\'$post[\'scenic_x\']  => \'景区x坐标\';\'',
        '\'$post[\'scenic_y\']  => \'景区y坐标\';\'',
        '\'$post[\'scenic_type\']  => \'景区类型\';\'',
        '\'$post[\'scenic_ticket\']  => \'景区门票\';\'',
        '\'$post[\'scenic_status\']  => \'申请状态\';\'',
    ],
]);
