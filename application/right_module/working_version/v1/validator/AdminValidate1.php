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

class AdminValidate1 extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['admin_class']  => '管理分组';
     * 创  建 : 2018/09/22 09:43
     */
    protected $rule =   [
        'admin_class'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/22 09:43
     */
    protected $message  =   [
        'admin_class.require'=> '请正确输入管理员分组标识数字',
        'admin_class.number' => '请正确输入管理员分组标识数字',
    ];
}
