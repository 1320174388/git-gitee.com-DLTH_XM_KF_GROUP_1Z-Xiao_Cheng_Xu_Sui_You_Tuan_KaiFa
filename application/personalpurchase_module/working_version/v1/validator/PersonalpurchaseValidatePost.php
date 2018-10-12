<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalpurchaseValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\validator;
use think\Validate;

class PersonalpurchaseValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['scenic_id']    => '景区ID';
     * 输  入 : $post['token']        => '用户token';
     * 输  入 : $post['coupon_id']    => '优惠券ID不使用发0';
     * 创  建 : 2018/10/12 14:29
     */
    protected $rule =   [
        'scenic_id' => 'require|number',
        'token'     => 'require|min:32|max:32',
        'coupon_id' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/12 14:29
     */
    protected $message  =   [
        'scenic_id.require' => '请正确发送景区ID',
        'scenic_id.number'  => '请正确发送景区ID',
        'token.require'     => '请正确发送用户token',
        'token.min'         => '请正确发送用户token',
        'token.max'         => '请正确发送用户token',
        'coupon_id.require' => '请发送优惠券ID不使用发0',
        'coupon_id.number'  => '请发送优惠券ID不使用发0',
    ];
}