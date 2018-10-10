<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SearchScenicValidateGet.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  景区评论数据验证器
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\validator;
use think\Validate;

class ScenicCommentPost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['group_number']  => '订单号';'
     * 输  入 : '$post['comment_service']  => '服务星级';'
     * 输  入 : '$post['comment_health']  => '卫生星级';'
     * 输  入 : '$post['comment_view']  => '景观星级';'
     * 输  入 : '$post['comment_cosy']  => '舒适度星级';'
     * 输  入 : '$post['comment_content']  => '评论内容';'
     * 创  建 : 2018/10/05 10:23
     */
    protected $rule =   [
        'scenic_id'         => 'require',
        'user_token'        => 'require',
        'group_number'      => 'require',
        'comment_service'   => 'require',
        'comment_health'    => 'require',
        'comment_view'      => 'require',
        'comment_cosy'      => 'require',
        'comment_content'   => 'require|max:200'
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/05 10:23
     */
    protected $message  =   [
        'scenic_id.require'         => '景区id`scenic_id`必须',
        'user_token.require'        => '用户token`user_token`必须',
        'group_number.require'      => '订单号`group_number`必须',
        'comment_service.require'   => '服务星级`comment_service`必须',
        'comment_health.require'    => '卫生星级`comment_health`必须',
        'comment_view.require'      => '景观星级`comment_view`必须',
        'comment_content.require'   => '评论内容`comment_content`必须',
        'comment_cosy.require'      => '舒适度星级`comment_cosy`必须',
        'comment_content.max'       => '内容不能超过200个字'
    ];
}