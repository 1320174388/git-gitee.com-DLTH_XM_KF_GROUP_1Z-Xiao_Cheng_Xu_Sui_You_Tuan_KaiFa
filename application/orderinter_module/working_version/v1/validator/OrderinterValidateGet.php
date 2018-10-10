<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinterValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\validator;
use think\Validate;

class OrderinterValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['scenicId']    => '景区ID';
     * 输  入 : $get['groupType']   => '团购类型';
     * 输  入 : $get['groupStatus'] => '完成状态';
     * 输  入 : $get['groupLimit']  => '订单数量';
     * 创  建 : 2018/10/09 13:27
     */
    protected $rule =   [
        'scenicId'    => 'require|number',
        'groupType'   => 'require|number',
        'groupStatus' => 'require|number',
        'groupLimit'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/09 13:27
     */
    protected $message  =   [
        'scenicId.require'    => '请正确发送景区ID',
        'scenicId.number'     => '请正确发送景区ID',
        'groupType.require'   => '请正确发送团购类型',
        'groupType.number'    => '请正确发送团购类型',
        'groupStatus.require' => '请正确发送完成状态',
        'groupStatus.number'  => '请正确发送完成状态',
        'groupLimit.require'  => '请正确发送订单数量',
        'groupLimit.number'   => '请正确发送订单数量',
    ];
}