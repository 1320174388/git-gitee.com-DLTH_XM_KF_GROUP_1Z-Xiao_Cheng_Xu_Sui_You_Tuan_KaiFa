<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketgroupLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购自定义类
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\library;

class TicketgroupLibrary
{
    /**
     * 名  称 : ticketgroupLibGet()
     * 功  能 : 获取门票信息函数类
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区ID';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/27 20:31
     */
    public function ticketgroupLibGet($get)
    {
        // TODO : 执行函数处理逻辑
        
        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }

    /**
     * 名  称 : ticketgroupLibPut()
     * 功  能 : 修改门票金额函数类
     * 变  量 : --------------------------------------
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  入 : $put['ticket_money'] => '门票价格';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 10:23
     */
    public function ticketgroupLibPut($put)
    {
        // TODO : 执行函数处理逻辑
        
        // TODO : 返回函数输出数据
        return ['msg'=>'success','data'=>'返回数据'];
    }
}