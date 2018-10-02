<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaseValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\validator;
use think\Validate;

class PurchaseValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['user_token']  => '用户标识';
     * 输  入 : $post['scenic_id']   => '景区主键';
     * 输  入 : $post['group_money'] => '团购价格';
     * 输  入 : $post['group_num']   => '团购人数';
     * 创  建 : 2018/09/28 20:31
     */
    protected $rule =   [
        'user_token'  => 'require|min:32|max:32',
        'scenic_id'   => 'require|number',
        'group_money' => 'require|float',
        'group_num'   => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/28 20:31
     */
    protected $message  =   [
        'user_token.require'  => '请正确发送管理员Token值',
        'user_token.min'      => '请正确发送管理员Token值',
        'user_token.max'      => '请正确发送管理员Token值',
        'scenic_id.require'   => '请正确发送景区Id',
        'scenic_id.number'    => '请正确发送景区Id',
        'group_money.require' => '请发送团购价格',
        'group_money.float'   => '请发送团购价格',
        'group_num.require'   => '请发送团购人数',
        'group_num.number'    => '请发送团购人数',
    ];
}