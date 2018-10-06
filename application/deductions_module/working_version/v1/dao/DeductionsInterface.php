<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  DeductionsInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 14:10
 *  文件描述 :  扣除景区押金_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\deductions_module\working_version\v1\dao;

interface DeductionsInterface
{
    /**
     * 名  称 : deductionsUpdate()
     * 功  能 : 声明:扣除景区押金数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['ScenicId']   => '景区主键';
     * 输  入 : $put['Deduction']  => '扣除原因';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/06 17:05
     */
    public function deductionsUpdate($put);
}