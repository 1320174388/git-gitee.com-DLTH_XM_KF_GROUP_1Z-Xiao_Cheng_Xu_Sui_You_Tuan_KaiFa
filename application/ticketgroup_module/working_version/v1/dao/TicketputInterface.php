<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketputInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;

interface TicketputInterface
{
    /**
     * 名  称 : ticketputUpdate()
     * 功  能 : 声明:修改门票数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 15:34
     */
    public function ticketputUpdate($put,$status=1);
}