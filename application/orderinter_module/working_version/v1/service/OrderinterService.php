<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinterService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\service;
use app\orderinter_module\working_version\v1\dao\OrderinterDao;
use app\orderinter_module\working_version\v1\library\OrderinterLibrary;
use app\orderinter_module\working_version\v1\validator\OrderinterValidatePost;
use app\orderinter_module\working_version\v1\validator\OrderinterValidateGet;
use app\orderinter_module\working_version\v1\validator\OrderinterValidatePut;
use app\orderinter_module\working_version\v1\validator\OrderinterValidateDelete;

class OrderinterService
{
    /**
     * 名  称 : orderinterShow()
     * 功  能 : 获取订单列表逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']    => '景区ID';
     * 输  入 : $get['groupType']   => '团购类型';
     * 输  入 : $get['groupStatus'] => '完成状态';
     * 输  入 : $get['groupLimit']  => '订单数量';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/09 13:27
     */
    public function orderinterShow($get)
    {
        // 实例化验证器代码
        $validate  = new OrderinterValidateGet();

        // 验证数据
        if(empty($get['groupType'])){
            $get['groupType'] = 0;
        }
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $orderinterDao = new OrderinterDao();
        
        // 执行Dao层逻辑
        $res = $orderinterDao->orderinterSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}