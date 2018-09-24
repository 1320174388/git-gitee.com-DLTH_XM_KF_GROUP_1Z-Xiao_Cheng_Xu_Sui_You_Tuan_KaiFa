<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleValidate3.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位管理验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class RoleValidate3 extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['role_id']     => '职位ID';
     * 输  入 : $put['role_class']  => '职位分组';
     * 创  建 : 2018/09/19 18:40
     */
    protected $rule =   [
        'role_id'    => 'require|number',
        'role_class' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/19 18:40
     */
    protected $message  =   [
        'role_id.require'    => '请正确输入职位ID',
        'role_id.number'     => '请正确输入职位ID',
        'role_class.require' => '请正确输入职位分组标识数字',
        'role_class.number'  => '请正确输入职位分组标识数字',
    ];
}
