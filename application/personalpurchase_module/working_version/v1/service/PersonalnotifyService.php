<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\service;
use app\personalpurchase_module\working_version\v1\dao\PersonalnotifyDao;
use app\personalpurchase_module\working_version\v1\library\PersonalnotifyLibrary;
use app\personalpurchase_module\working_version\v1\validator\PersonalnotifyValidatePost;
use app\personalpurchase_module\working_version\v1\validator\PersonalnotifyValidateGet;
use app\personalpurchase_module\working_version\v1\validator\PersonalnotifyValidatePut;
use app\personalpurchase_module\working_version\v1\validator\PersonalnotifyValidateDelete;

class PersonalnotifyService
{
    /**
     * 名  称 : personalnotifyAdd()
     * 功  能 : 个人购票回调逻辑
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 16:36
     */
    public function personalnotifyAdd($post)
    {
        // 实例化Dao层数据类
        $personalnotifyDao = new PersonalnotifyDao();
        
        // 执行Dao层逻辑
        $res = $personalnotifyDao->personalnotifyCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}