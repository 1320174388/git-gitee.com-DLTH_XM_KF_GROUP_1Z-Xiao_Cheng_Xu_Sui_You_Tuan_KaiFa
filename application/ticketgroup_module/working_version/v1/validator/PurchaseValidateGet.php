<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaseValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\validator;
use think\Validate;

class PurchaseValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $get['scenic_id']  => '景区主键';
     * 创  建 : 2018/10/03 10:39
     */
    protected $rule =   [
        'scenic_id' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/03 10:39
     */
    protected $message  =   [
        'scenic_id.require' => '请正确输入景区ID',
        'scenic_id.number'  => '请正确输入景区ID',
    ];
}