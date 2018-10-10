<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OrderinterInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 20:18
 *  文件描述 :  景区订单_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\orderinter_module\working_version\v1\dao;

interface OrderinterInterface
{
    /**
     * 名  称 : orderinterSelect()
     * 功  能 : 声明:获取订单列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']    => '景区ID';
     * 输  入 : $get['groupType']   => '团购类型';
     * 输  入 : $get['groupStatus'] => '完成状态';
     * 输  入 : $get['groupLimit']  => '订单数量';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/09 13:27
     */
    public function orderinterSelect($get);
}