<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  DeductionsValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 14:10
 *  文件描述 :  扣除景区押金修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\deductions_module\working_version\v1\validator;
use think\Validate;

class DeductionsValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['ScenicId']   => '景区主键';
     * 输  入 : $put['Deduction']  => '扣除原因';
     * 创  建 : 2018/10/06 17:05
     */
    protected $rule =   [
        'ScenicId'   => 'require|number',
        'Deduction'  => 'require|min:1|max:200',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/06 17:05
     */
    protected $message  =   [
        'ScenicId.require'  => '请正确发送景区主键',
        'ScenicId.number'   => '请正确发送景区主键',
        'Deduction.require' => '请填写1~200字押金扣除原因',
        'Deduction.min'     => '请填写1~200字押金扣除原因',
        'Deduction.max'     => '请填写1~200字押金扣除原因',
    ];
}