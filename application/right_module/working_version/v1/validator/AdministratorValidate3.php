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

class AdministratorValidate3 extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['admin_token'] => '管理员标识';
     * 输  入 : $post['admin_name']  => '管理员姓名';
     * 输  入 : $post['admin_phone'] => '联系电话';
     * 输  入 : $post['admin_class'] => '分组注册ID';
     * 输  入 : $post['right_class'] => '所属权限标识';
     * 创  建 : 2018/09/22 19:31
     */
    protected $rule =   [
        'admin_token'  => 'require|min:32|max:32',
        'admin_name'   => 'require|min:2|max:10',
        'admin_phone'  => 'require|number|min:11|max:11',
        'admin_class'  => 'require|number',
        'right_class'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/22 19:31
     */
    protected $message  =   [
        'admin_token.require'=> '请输入32位AdminToken标识',
        'admin_token.min'    => '请输入32位AdminToken标识',
        'admin_token.max'    => '请输入32位AdminToken标识',
        'admin_name.require' => '请输入2~10个字管理员名称',
        'admin_name.min'     => '请输入2~10个字管理员名称',
        'admin_name.max'     => '请输入2~10个字管理员名称',
        'admin_phone.require'=> '请正确输入联系电话',
        'admin_phone.number' => '请正确输入联系电话',
        'admin_phone.min'    => '请正确输入联系电话',
        'admin_phone.max'    => '请正确输入联系电话',
        'admin_class.require'=> '请正确输入分组注册ID',
        'admin_class.number' => '请正确输入分组注册ID',
        'right_class.require'=> '请正确输入所属权限标识',
        'right_class.number' => '请正确输入所属权限标识',
    ];
}
