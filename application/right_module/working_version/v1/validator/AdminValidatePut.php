<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminValidator.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 09:45
 *  文件描述 :  权限管理~管理员管理验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class AdminValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['admin_id']     => '管理ID';
     * 输  入 : $put['admin_to']     => '审核状态';
     * 输  入 : $put['role_str']     => '职位ID字符窜';
     * 创  建 : 2018/09/22 09:43
     */
    protected $rule =   [
        'admin_id'  => 'require|number',
        'admin_to'  => 'require|min:2|max:3',
        'role_str'  => 'require|min:1|max:2000',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/22 09:43
     */
    protected $message  =   [
        'admin_id.require' => '请正确输入管理ID',
        'admin_id.number'  => '请正确输入管理ID',
        'admin_to.require' => '请正确输入管理ID',
        'admin_to.min'     => '请正确输入：yes|no，审核状态',
        'admin_to.max'     => '请正确输入：yes|no，审核状态',
        'role_str.require' => '请正确输入1~2000字职位字符串',
        'role_str.min'     => '请正确输入1~2000字职位字符串',
        'role_str.max'     => '请正确输入1~2000字职位字符串',
    ];
}
