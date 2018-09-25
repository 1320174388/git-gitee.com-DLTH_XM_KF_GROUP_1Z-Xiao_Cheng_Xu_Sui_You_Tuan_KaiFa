<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistValidateDelete.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理删除验证器
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\validator;
use think\Validate;

class PrizelistValidateDelete extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $delete['prizeId']   => '奖品主键';
     * 创  建 : 2018/09/25 20:46
     */
    protected $rule =   [
        'prizeId'   => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/25 20:46
     */
    protected $message  =   [
        'prizeId.require'   => '请正确发送奖品ID',
        'prizeId.number'    => '请正确发送奖品ID',
    ];
}