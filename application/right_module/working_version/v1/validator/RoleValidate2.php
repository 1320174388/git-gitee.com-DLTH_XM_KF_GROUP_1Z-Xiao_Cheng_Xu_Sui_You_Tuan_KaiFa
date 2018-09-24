<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleValidate2.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位管理验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class RoleValidate2 extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['role_id']     => '职位ID';
     * 输  入 : $put['admin_token'] => '管理标识';
     * 输  入 : $put['role_name']   => '职位名称';
     * 输  入 : $put['role_class']  => '职位分组';
     * 输  入 : $put['right_str']   => '权限ID字符串';
     * 创  建 : 2018/09/19 18:40
     */
    protected $rule =   [
        'role_id'    => 'require|number',
        'admin_token'=> 'require|min:32|max:32',
        'role_name'  => 'require|min:2|max:10',
        'role_class' => 'require|number',
        'right_str'  => 'require|min:1|max:2000',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/19 18:40
     */
    protected $message  =   [
        'role_id.require'    => '请正确输入职位ID',
        'role_id.number'     => '请正确输入职位ID',
        'admin_token.require'=> '请输入32位AdminToken标识',
        'admin_token.min'    => '请输入32位AdminToken标识',
        'admin_token.max'    => '请输入32位AdminToken标识',
        'role_name.require'  => '请输入2~10个字角色名称',
        'role_name.min'      => '请输入2~10个字角色名称',
        'role_name.max'      => '请输入2~10个字角色名称',
        'role_class.require' => '请正确输入职位分组标识数字',
        'role_class.number'  => '请正确输入职位分组标识数字',
        'right_str.require'  => '请输入1~2000权限ID标识,多个标识用逗号隔开',
        'right_str.min'      => '请输入1~2000权限ID标识,多个标识用逗号隔开',
        'right_str.max'      => '请输入1~2000权限ID标识,多个标识用逗号隔开',
    ];
}
