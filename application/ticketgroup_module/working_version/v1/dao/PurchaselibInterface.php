<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaselibInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\dao;

interface PurchaselibInterface
{
    /**
     * 名  称 : purchaselibUpdate()
     * 功  能 : 声明:审核团购模式添加数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['group_id'] => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/29 09:59
     */
    public function purchaselibUpdate($put,$statsu);

    /**
     * 名  称 : purchaselibDelete()
     * 功  能 : 声明:删除团购模式数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/02 15:05
     */
    public function purchaselibDelete($delete,$status);
}