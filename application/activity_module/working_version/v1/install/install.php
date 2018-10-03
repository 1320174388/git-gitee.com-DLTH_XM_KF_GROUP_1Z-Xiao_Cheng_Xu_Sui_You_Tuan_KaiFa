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
    'name'     => 'activity',
    // 函数说明 : 默认 新创建函数
    'explain'  => '添加活动',
    // 函数输入 : 示例 [
    //  '$get['goodLimit']  => '商品页码';',
    //]
    'input'    => [
        '( File ) $post[\'ActivityFile\']   => \'活动图片\';',
        '(String) $post[\'ActivityTitle\']  => \'活动标题\';',
        '(String) $post[\'ActivityDes\']    => \'活动介绍\';',
        '(String) $post[\'ActivityType\']   => \'活动类型\';',
        '( Int )  $post[\'ActivityStatus\'] => \'活动状态\';',
        '( Int )  $post[\'ActivityClass\']  => \'活动分组\';',
        '(String) $post[\'ActivityStart\']  => \'开始时间\';',
        '(String) $post[\'ActivityEnd\']    => \'结束时间\';',
    ],
]);
