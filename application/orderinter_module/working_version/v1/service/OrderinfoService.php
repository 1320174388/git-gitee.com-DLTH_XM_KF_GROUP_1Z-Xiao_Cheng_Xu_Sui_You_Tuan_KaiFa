<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinfoService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\service;
use app\orderinter_module\working_version\v1\dao\OrderinfoDao;
use app\orderinter_module\working_version\v1\library\OrderinfoLibrary;
use app\orderinter_module\working_version\v1\validator\OrderinfoValidatePost;
use app\orderinter_module\working_version\v1\validator\OrderinfoValidateGet;
use app\orderinter_module\working_version\v1\validator\OrderinfoValidatePut;
use app\orderinter_module\working_version\v1\validator\OrderinfoValidateDelete;

class OrderinfoService
{
    /**
     * 名  称 : orderinfoShow()
     * 功  能 : 获取订单详情逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['groupNumber'] => '订单编号';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/09 16:31
     */
    public function orderinfoShow($get)
    {
        // 实例化验证器代码
        $validate  = new OrderinfoValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $orderinfoDao = new OrderinfoDao();
        
        // 执行Dao层逻辑
        $res = $orderinfoDao->orderinfoSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}