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
    'dataType' => 'PUT',
    // 函数名称 : 默认 __function
    'name'     => 'activity',
    // 函数说明 : 默认 新创建函数
    'explain'  => '修改活动广告信息',
    // 函数输入 : 示例 [
    //  '$get['goodLimit']  => '商品页码';',
    //]
    'input'    => [
        '( File ) $put[\'ActivityId\']     => \'活动主键\';',
        '( File ) $put[\'ActivityFile\']   => \'活动图片\';',
        '(String) $put[\'ActivityTitle\']  => \'活动标题\';',
        '(String) $put[\'ActivityDes\']    => \'活动介绍\';',
        '(String) $put[\'ActivityType\']   => \'活动类型\';',
        '( Int )  $put[\'ActivityStatus\'] => \'活动状态\';',
        '( Int )  $put[\'ActivityClass\']  => \'活动分组\';',
        '(String) $put[\'ActivityStart\']  => \'开始时间\';',
        '(String) $put[\'ActivityEnd\']    => \'结束时间\';',
    ],
]);
