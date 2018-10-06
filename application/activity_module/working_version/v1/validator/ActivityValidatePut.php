<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivityValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\validator;
use think\Validate;

class ActivityValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : ( File ) $put['ActivityId']     => '活动主键';
     * 输  入 : ( File ) $put['ActivityFile']   => '活动图片';
     * 输  入 : (String) $put['ActivityTitle']  => '活动标题';
     * 输  入 : (String) $put['ActivityDes']    => '活动介绍';
     * 输  入 : (String) $put['ActivityType']   => '活动类型';
     * 输  入 : ( Int )  $put['ActivityStatus'] => '活动状态';
     * 输  入 : ( Int )  $put['ActivityClass']  => '活动分组';
     * 输  入 : (String) $put['ActivityStart']  => '开始时间';
     * 输  入 : (String) $put['ActivityEnd']    => '结束时间';
     * 创  建 : 2018/10/05 12:16
     */
    protected $rule =   [
        'ActivityId'     => 'require|number',
        'ActivityTitle'  => 'require|min:1|max:12',
        'ActivityDes'    => 'require|max:200',
        'ActivityType'   => 'require|number',
        'ActivityStatus' => 'require|number',
        'ActivityClass'  => 'require|number',
        'ActivityStart'  => 'require|number',
        'ActivityEnd'    => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/05 12:16
     */
    protected $message  =   [
        'ActivityId.require'     => '请正确发送文章主键',
        'ActivityId.number'      => '请正确发送文章主键',
        'ActivityTitle.require'  => '请输入1~12字标题',
        'ActivityTitle.min'      => '请输入1~12字标题',
        'ActivityTitle.max'      => '请输入1~12字标题',
        'ActivityDes.require'    => '请输入不超过200字介绍',
        'ActivityDes.max'        => '请输入不超过200字介绍',
        'ActivityType.require'   => '请输入文章类型标识',
        'ActivityType.number'    => '请输入文章类型标识',
        'ActivityStatus.require' => '请输入文章状态标识',
        'ActivityStatus.number'  => '请输入文章状态标识',
        'ActivityClass.require'  => '请输入文章分组标识',
        'ActivityClass.number'   => '请输入文章分组标识',
        'ActivityStart.require'  => '请正确发送时间【0000-00-00 00:00:00】字符串',
        'ActivityStart.number'   => '请正确发送时间【0000-00-00 00:00:00】字符串',
        'ActivityEnd.require'    => '请正确发送时间【0000-00-00 00:00:00】字符串',
        'ActivityEnd.number'     => '请正确发送时间【0000-00-00 00:00:00】字符串',
    ];
}