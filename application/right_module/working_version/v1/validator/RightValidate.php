<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightValidator.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 10:11
 *  文件描述 :  权限管理验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class RightValidate extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['admin_token'] => '管理员UserToken标识';
     * 输  入 : $get['admin_class'] => '管理员分组,1/2/3,分级获取';
     * 输  入 : $get['role_class']  => '角色分组,1/2/3,分级获取';
     * 输  入 : $get['right_class'] => '权限分组,1/2/3,分级获取';
     * 创  建 : 2018/09/19 11:30
     */
    protected $rule =   [
        'admin_token' => 'require|min:32|max:32',
        'admin_class' => 'require|number',
        'role_class'  => 'require|number',
        'right_class' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/19 11:30
     */
    protected $message  =   [
        'admin_token.require' => '请正确发送32位管理员UserToken标识',
        'admin_token.min'     => '请正确发送32位管理员UserToken标识',
        'admin_token.max'     => '请正确发送32位管理员UserToken标识',
        'admin_class.require' => '请正确发送管理员分组,1/2/3,获取对应权限',
        'admin_class.number'  => '请正确发送管理员分组,1/2/3,获取对应权限',
        'role_class.require'  => '请正确发送角色分组,1/2/3,获取对应权限',
        'role_class.number'   => '请正确发送角色分组,1/2/3,获取对应权限',
        'right_class.require' => '请正确发送权限分组,1/2/3,获取对应权限',
        'right_class.number'  => '请正确发送权限分组,1/2/3,获取对应权限',
    ];
}
