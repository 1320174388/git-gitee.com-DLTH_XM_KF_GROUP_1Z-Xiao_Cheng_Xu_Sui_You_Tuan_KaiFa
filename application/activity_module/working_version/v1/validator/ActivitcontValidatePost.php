<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ActivitcontValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\validator;
use think\Validate;

class ActivitcontValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : ( Int )  $post['ActivityId']       => '活动ID';
     * 输  入 : (String) $post['ActivityType']     => '内容类型';
     * 输  入 : (String) $post['ActivityCont']     => '活动内容';
     * 输  入 : (String) $post['ActivitySort']     => '活动排序';
     * 创  建 : 2018/10/05 09:35
     */
    protected $rule =   [
        'ActivityId'   => 'require|number',
        'ActivityType' => 'require|min:4|max:5',
        'ActivityCont' => 'min:6|max:2000',
        'ActivitySort' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/05 09:35
     */
    protected $message  =   [
        'ActivityId.require'   => '请发送主键ID',
        'ActivityId.number'    => '请发送主键ID',
        'ActivityType.require' => '请发送内容类型',
        'ActivityType.min'     => '请发送内容类型',
        'ActivityType.max'     => '请发送内容类型',
        'ActivityCont.min'     => '请发送6~2000字内容',
        'ActivityCont.max'     => '请发送6~2000字内容',
        'ActivitySort.max'     => '请发送6~2000字内容',
    ];
}