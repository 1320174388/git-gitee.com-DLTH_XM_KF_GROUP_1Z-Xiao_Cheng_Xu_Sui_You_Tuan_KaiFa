<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\dao;

interface PersonalnotifyInterface
{
    /**
     * 名  称 : personalnotifyCreate()
     * 功  能 : 声明:个人购票回调数据处理
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 16:36
     */
    public function personalnotifyCreate($post);
}