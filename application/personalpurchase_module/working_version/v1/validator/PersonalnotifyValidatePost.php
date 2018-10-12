<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\validator;
use think\Validate;

class PersonalnotifyValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : --------------------------------------
     * 创  建 : 2018/10/12 16:36
     */
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/12 16:36
     */
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',
    ];
}