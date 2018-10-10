<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinfoValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\validator;
use think\Validate;

class OrderinfoValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['groupNumber'] => '订单编号';
     * 创  建 : 2018/10/09 16:31
     */
    protected $rule =   [
        'groupNumber' => 'require|number|max:32',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/09 16:31
     */
    protected $message  =   [
        'groupNumber.require' => '请正确输入订单编号',
        'groupNumber.number'  => '请正确输入订单编号',
        'groupNumber.max'     => '请正确输入订单编号',
    ];
}