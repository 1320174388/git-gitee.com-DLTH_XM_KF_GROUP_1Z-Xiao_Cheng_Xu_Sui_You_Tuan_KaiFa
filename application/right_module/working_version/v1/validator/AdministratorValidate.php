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

class AdministratorValidate extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['admin_token']  => '32位AdminToken标识';
     * 输  入 : $get['admin_class']  => '管理员分组标识数字';
     * 创  建 : 2018/09/22 19:31
     */
    protected $rule =   [
        'admin_token'  => 'require|min:32|max:32',
        'admin_class'  => 'require|number',
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
        'admin_class.require' => '请正确输入管理员分组标识数字',
        'admin_class.number'  => '请正确输入管理员分组标识数字',
    ];
}
