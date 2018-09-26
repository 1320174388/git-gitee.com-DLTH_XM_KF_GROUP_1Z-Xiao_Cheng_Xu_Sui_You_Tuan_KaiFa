<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CouponlistValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/26 14:36
 *  文件描述 :  景区优惠券管理获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\couponlist_module\working_version\v1\validator;
use think\Validate;

class CouponlistValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['scenic_id'] => '景区ID';
     * 创  建 : 2018/09/26 20:41
     */
    protected $rule =   [
        'scenic_id'    => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/26 20:41
     */
    protected $message  =   [
        'scenic_id.require'     => '请正确输入景区ID',
        'scenic_id.number'      => '请正确输入景区ID',
    ];
}