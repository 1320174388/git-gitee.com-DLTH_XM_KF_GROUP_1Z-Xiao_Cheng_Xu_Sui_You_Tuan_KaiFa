<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxloginaddValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\wxloginadd_module\working_version\v1\validator;
use think\Validate;

class WxloginaddValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['userToken']  => '用户token';
     * 输  入 : $post['avatarUrl']  => '用户头像';
     * 输  入 : $post['nickName']   => '用户昵称';
     * 输  入 : $post['gender']     => '用户性别';
     * 创  建 : 2018/10/10 22:36
     */
    protected $rule =   [
        'userToken' => 'require|min:32|max:32',
        'avatarUrl' => 'require|max:260',
        'nickName'  => 'require|max:50',
        'gender'    => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/10 22:36
     */
    protected $message  =   [
        'userToken.require' => '请正确发送用户token',
        'userToken.min'     => '请正确发送用户token',
        'userToken.max'     => '请正确发送用户token',
        'avatarUrl.require' => '请发送用户头像URL地址信息',
        'avatarUrl.max'     => '请发送用户头像URL地址信息',
        'nickName.require'  => '请发送用户昵称',
        'nickName.max'      => '请发送用户昵称',
        'gender.require'    => '请发送用户性别',
        'gender.number'     => '请发送用户性别',
    ];
}