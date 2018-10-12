<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票数据层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\dao;
use app\personalpurchase_module\working_version\v1\model\PersonalnotifyModel;

class PersonalnotifyDao implements PersonalnotifyInterface
{
    /**
     * 名  称 : personalnotifyCreate()
     * 功  能 : 个人购票回调数据处理
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 16:36
     */
    public function personalnotifyCreate($post)
    {
        // TODO :  PersonalnotifyModel 模型
        
        // 处理函数返回值
        return \RSD::wxReponse(true,'M','','');
    }
}