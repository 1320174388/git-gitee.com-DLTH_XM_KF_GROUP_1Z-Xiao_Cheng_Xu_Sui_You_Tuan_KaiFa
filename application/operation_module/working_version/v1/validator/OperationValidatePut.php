<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OperationValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\operation_module\working_version\v1\validator;
use think\Validate;

class OperationValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$get['OperationId']     => '申请主键';'
     * 输  入 : '$get['OperationStatus'] => '审核状态';'
     * 创  建 : 2018/10/06 10:37
     */
    protected $rule =   [
        'OperationId'     => 'require|number',
        'OperationStatus' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/06 10:37
     */
    protected $message  =   [
        'OperationId.require'     => '请正确输入申请主键',
        'OperationId.number'      => '请正确输入申请主键',
        'OperationStatus.require' => '请正确输入审核状态',
        'OperationStatus.number'  => '请正确输入审核状态',
    ];
}