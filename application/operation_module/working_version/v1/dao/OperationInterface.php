<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OperationInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\operation_module\working_version\v1\dao;

interface OperationInterface
{
    /**
     * 名  称 : operationSelect()
     * 功  能 : 声明:获取所有景区申请信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['limitNum']  => '当前已有信息数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:00
     */
    public function operationSelect($get);

    /**
     * 名  称 : operationUpdate()
     * 功  能 : 声明:审核景区操作数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['OperationId']     => '申请主键';'
     * 输  入 : '$get['OperationStatus'] => '审核状态';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/06 10:37
     */
    public function operationUpdate($put);
}