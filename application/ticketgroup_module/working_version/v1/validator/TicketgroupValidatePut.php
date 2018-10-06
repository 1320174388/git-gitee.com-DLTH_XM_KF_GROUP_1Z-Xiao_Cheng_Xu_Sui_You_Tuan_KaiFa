<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketgroupValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\validator;
use think\Validate;

class TicketgroupValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  入 : $put['ticket_money'] => '门票价格';
     * 输  入 : $put['form_id']      => '表单ID';
     * 创  建 : 2018/09/28 10:23
     */
    protected $rule =   [
        'user_token'   => 'require|min:32|max:32',
        'scenic_id'    => 'require|number',
        'ticket_money' => 'require|float',
        'form_id'      => 'require',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/28 10:23
     */
    protected $message  =   [
        'user_token.require'   => '请正确发送用户Token标识',
        'user_token.min'       => '请正确发送用户Token标识',
        'user_token.max'       => '请正确发送用户Token标识',
        'scenic_id.require'    => '请正确发送景区ID',
        'scenic_id.number'     => '请正确发送景区ID',
        'ticket_money.require' => '请正确发送门票价格',
        'ticket_money.float'   => '请正确发送门票价格',
        'form_id.require'      => '请正确发送表单ID',
    ];
}