<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistValidateDelete.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理删除验证器
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\validator;
use think\Validate;

class CouponlistValidateDelete extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $delete['user_token'] => '用户Token标识';
     * 输  入 : $delete['scenic_id']  => '景区主键';
     * 输  入 : $delete['coupon_id']  => '优惠券ID';
     * 输  入 : $delete['form_id']    => '表单ID';
     * 创  建 : 2018/09/27 09:31
     */
    protected $rule =   [
        'user_token'   => 'require|min:32|max:32',
        'coupon_id'    => 'require|number',
        'scenic_id'    => 'require|number',
        'form_id'      => 'require',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/27 09:31
     */
    protected $message  =   [
        'user_token.require'    => '请正确输入用户Token',
        'user_token.min'        => '请正确输入用户Token',
        'user_token.max'        => '请正确输入用户Token',
        'coupon_id.require'     => '请正确输入景区主键',
        'coupon_id.number'      => '请正确输入景区主键',
        'scenic_id.require'     => '请正确输入景区ID',
        'scenic_id.number'      => '请正确输入景区ID',
        'form_id.require'       => '请发送表单Form_id',
    ];
}