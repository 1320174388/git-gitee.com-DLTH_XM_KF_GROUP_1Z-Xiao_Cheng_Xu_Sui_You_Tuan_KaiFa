<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityValidateDelete.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理删除验证器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\validator;
use think\Validate;

class ActivityValidateDelete extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : ( Int )  $delete['ActivityId']     => '活动主键';
     * 创  建 : 2018/10/05 14:41
     */
    protected $rule =   [
        'ActivityId'     => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/05 14:41
     */
    protected $message  =   [
        'ActivityId.require'     => '请正确发送文章主键',
        'ActivityId.number'      => '请正确发送文章主键',
    ];
}