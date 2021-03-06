<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\validator;
use think\Validate;

class ActivityValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : ( Int )  $get['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 创  建 : 2018/10/05 11:09
     */
    protected $rule =   [
        'ActivityType'   => 'require|number',
        'ActivityClass'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/05 11:09
     */
    protected $message  =   [
        'ActivityType.require'   => '请正确发送活动类型标识',
        'ActivityType.number'    => '请正确发送活动类型标识',
        'ActivityClass.require'  => '请正确发送活动分组标识',
        'ActivityClass.number'   => '请正确发送活动分组标识',
    ];
}