<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketgroupInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;

interface TicketgroupInterface
{
    /**
     * 名  称 : ticketgroupSelect()
     * 功  能 : 声明:获取门票信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区ID';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/27 20:31
     */
    public function ticketgroupSelect($get);

    /**
     * 名  称 : ticketgroupUpdate()
     * 功  能 : 声明:修改门票金额数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  入 : $put['ticket_money'] => '门票价格';
     * 输  入 : $put['form_id']      => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 10:23
     */
    public function ticketgroupUpdate($put);
}