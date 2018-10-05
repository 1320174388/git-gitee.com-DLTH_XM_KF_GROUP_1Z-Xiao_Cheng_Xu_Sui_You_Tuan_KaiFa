<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Activit2Interface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/03 14:20
 *  文件描述 :  活动管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\activity_module\working_version\v1\dao;

interface Activit2Interface
{
    /**
     * 名  称 : activit2Select()
     * 功  能 : 声明:二次获取活动列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : ( Int )  $get['ActivityClass']  => '活动分组';
     * 输  入 : ( Int )  $get['ActivityLimit']  => '活动数量';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 12:08
     */
    public function activit2Select($get);
}