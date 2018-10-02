<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\validator;
use think\Validate;

class CouponlistValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区主键';
     * 输  入 : $put['coupon_id']    => '优惠券ID';
     * 输  入 : $put['coupon_type']  => '发布状态数字0/1';
     * 创  建 : 2018/09/27 14:43
     */
    protected $rule =   [
        'user_token'   => 'require|min:32|max:32',
        'scenic_id'    => 'require|number',
        'coupon_id'    => 'require|number',
        'coupon_type'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/27 14:43
     */
    protected $message  =   [
        'user_token.require'    => '请正确输入用户Token',
        'user_token.min'        => '请正确输入用户Token',
        'user_token.max'        => '请正确输入用户Token',
        'scenic_id.require'     => '请正确输入景区ID',
        'scenic_id.number'      => '请正确输入景区ID',
        'coupon_id.require'     => '请正确输入优惠券ID',
        'coupon_id.number'      => '请正确输入优惠券ID',
        'coupon_type.require'   => '请正确输入发布状态数字0/1',
        'coupon_type.number'    => '请正确输入发布状态数字0/1',
    ];
}