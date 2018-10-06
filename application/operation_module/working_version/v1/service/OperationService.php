<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  OperationService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/06 09:57
 *  文件描述 :  审核管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\operation_module\working_version\v1\service;
use app\operation_module\working_version\v1\dao\OperationDao;
use app\operation_module\working_version\v1\library\OperationLibrary;
use app\operation_module\working_version\v1\validator\OperationValidatePost;
use app\operation_module\working_version\v1\validator\OperationValidateGet;
use app\operation_module\working_version\v1\validator\OperationValidatePut;
use app\operation_module\working_version\v1\validator\OperationValidateDelete;

class OperationService
{
    /**
     * 名  称 : operationShow()
     * 功  能 : 获取所有景区申请信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$get['limitNum']  => '当前已有信息数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:00
     */
    public function operationShow($get)
    {
        // 实例化验证器代码
        $validate  = new OperationValidateGet();

        // 处理数据
        if(empty($get['limitNum'])){
            $get['limitNum'] = 0;
        }
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $operationDao = new OperationDao();
        
        // 执行Dao层逻辑
        $res = $operationDao->operationSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : operationEdit()
     * 功  能 : 审核景区操作逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$get['OperationId']     => '申请主键';'
     * 输  入 : '$get['OperationStatus'] => '审核状态';'
     * 输  入 : '$get['OperationInfo']   => '失败原因';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/06 10:37
     */
    public function operationEdit($put)
    {
        // 实例化验证器代码
        $validate  = new OperationValidatePut();
        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 处理数据
        if(($put['OperationStatus']!='1')&&($put['OperationStatus']!='2')){
            return returnData('error','请正确输入审核状态');
        }
        if(($put['OperationStatus']==2)&&empty($put['OperationInfo'])){
            return returnData('error','请填写审核失败原因');
        }
        
        // 实例化Dao层数据类
        $operationDao = new OperationDao();
        
        // 执行Dao层逻辑
        $res = $operationDao->operationUpdate($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}