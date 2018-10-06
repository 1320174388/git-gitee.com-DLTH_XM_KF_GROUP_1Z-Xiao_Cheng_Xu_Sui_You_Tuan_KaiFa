<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OperationValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\operation_module\working_version\v1\validator;
use think\Validate;

class OperationValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$get['limitNum']  => '当前已有信息数量';'
     * 创  建 : 2018/10/06 10:00
     */
    protected $rule =   [
        'limitNum'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/06 10:00
     */
    protected $message  =   [
        'limitNum.require' => '请正确输入当前已有信息数量',
        'limitNum.number'  => '请正确输入当前已有信息数量',
    ];
}