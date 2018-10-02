<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PurchaselibLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购自定义类
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\library;
use app\ticketgroup_module\working_version\v1\dao\PurchaselibDao;
use app\ticketgroup_module\working_version\v1\validator\PurchaselibValidatePost;
use app\ticketgroup_module\working_version\v1\validator\PurchaselibValidateGet;
use app\ticketgroup_module\working_version\v1\validator\PurchaselibValidatePut;
use app\ticketgroup_module\working_version\v1\validator\PurchaselibValidateDelete;

class PurchaselibLibrary
{
    /**
     * 名  称 : purchaselibLibPut()
     * 功  能 : 审核团购模式添加函数类
     * 变  量 : --------------------------------------
     * 输  入 : $put['group_id'] => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/29 09:59
     */
    public function purchaselibLibPut($put,$status)
    {
        // 实例化验证器代码
        $validate  = new PurchaselibValidatePut();

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证审核状态
        if(($status!=1)&&($status!=2)){
            return returnData('error','请正输入审核状态');
        }

        // 实例化Dao层数据类
        $purchaselibDao = new PurchaselibDao();

        // 执行Dao层逻辑
        $res = $purchaselibDao->purchaselibUpdate($put,$status);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : purchaselibLibDelete()
     * 功  能 : 删除团购模式函数类
     * 变  量 : --------------------------------------
     * 输  入 : $delete['group_id']   => '团购ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/02 15:05
     */
    public function purchaselibLibDelete($delete,$status)
    {
        // 实例化验证器代码
        $validate  = new PurchaselibValidateDelete();

        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证审核状态
        if(($status!=1)&&($status!=2)){
            return returnData('error','请正输入审核状态');
        }

        // 实例化Dao层数据类
        $purchaselibDao = new PurchaselibDao();

        // 执行Dao层逻辑
        $res = $purchaselibDao->purchaselibDelete($delete,$status);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}