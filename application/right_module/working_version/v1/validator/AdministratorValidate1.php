<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdministratorValidator.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 19:26
 *  文件描述 :  权限管理~管理员管理验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class AdministratorValidate1 extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['admin_id']  => '管理ID';
     * 输  入 : $put['role_str']  => '请正确输入1~2000字职位字符串';
     * 创  建 : 2018/09/22 19:31
     */
    protected $rule =   [
        'admin_id'  => 'require|number',
        'role_str'  => 'require|min:1|max:2000',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/22 19:31
     */
    protected $message  =   [
        'admin_id.require' => '请正确输入管理ID',
        'admin_id.number'  => '请正确输入管理ID',
        'admin_to.require' => '请正确输入管理ID',
        'role_str.require' => '请正确输入1~2000字职位字符串',
        'role_str.min'     => '请正确输入1~2000字职位字符串',
        'role_str.max'     => '请正确输入1~2000字职位字符串',
    ];
}
