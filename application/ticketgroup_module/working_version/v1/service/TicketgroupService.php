<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketgroupService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\service;
use app\ticketgroup_module\working_version\v1\dao\TicketgroupDao;
use app\ticketgroup_module\working_version\v1\library\TicketgroupLibrary;
use app\ticketgroup_module\working_version\v1\validator\TicketgroupValidatePost;
use app\ticketgroup_module\working_version\v1\validator\TicketgroupValidateGet;
use app\ticketgroup_module\working_version\v1\validator\TicketgroupValidatePut;
use app\ticketgroup_module\working_version\v1\validator\TicketgroupValidateDelete;

class TicketgroupService
{
    /**
     * 名  称 : ticketgroupShow()
     * 功  能 : 获取门票信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$get['scenic_id']  => '景区ID';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/27 20:31
     */
    public function ticketgroupShow($get)
    {
        // 实例化验证器代码
        $validate  = new TicketgroupValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $ticketgroupDao = new TicketgroupDao();
        
        // 执行Dao层逻辑
        $res = $ticketgroupDao->ticketgroupSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : ticketgroupEdit()
     * 功  能 : 修改门票金额逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $put['user_token']   => '用户标识';
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  入 : $put['ticket_money'] => '门票价格';
     * 输  入 : $put['form_id']      => '表单ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 10:23
     */
    public function ticketgroupEdit($put)
    {
        // 实例化验证器代码
        $validate  = new TicketgroupValidatePut();
        
        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $ticketgroupDao = new TicketgroupDao();
        
        // 执行Dao层逻辑
        $res = $ticketgroupDao->ticketgroupUpdate($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}