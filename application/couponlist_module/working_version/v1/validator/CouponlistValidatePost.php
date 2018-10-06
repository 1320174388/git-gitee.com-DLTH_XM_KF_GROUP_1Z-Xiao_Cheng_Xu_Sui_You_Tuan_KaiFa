<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\validator;
use think\Validate;

class CouponlistValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['user_token']    => '用户标识';
     * 输  入 : $post['scenic_id']     => '景区主键';
     * 输  入 : $post['coupon_money']  => '优惠金额';
     * 输  入 : $post['form_id']       => '表单ID';
     * 创  建 : 2018/09/26 14:46
     */
    protected $rule =   [
        'user_token'   => 'require|min:32|max:32',
        'scenic_id'    => 'require|number',
        'coupon_money' => 'require|float',
        'form_id'      => 'require',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/26 14:46
     */
    protected $message  =   [
        'user_token.require'    => '请正确输入用户Token',
        'user_token.min'        => '请正确输入用户Token',
        'user_token.max'        => '请正确输入用户Token',
        'scenic_id.require'     => '请正确输入景区ID',
        'scenic_id.number'      => '请正确输入景区ID',
        'coupon_money.require'  => '请正确输入优惠券金额',
        'coupon_money.float'    => '请正确输入优惠券金额',
        'form_id.require'       => '请发送表单Form_id',
    ];
}