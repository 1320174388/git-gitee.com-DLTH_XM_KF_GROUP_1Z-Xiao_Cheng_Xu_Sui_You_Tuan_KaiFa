<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicspotInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\scenicspot_module\working_version\v1\dao;

interface ScenicspotInterface
{
    /**
     * 名  称 : scenicspotCreate()
     * 功  能 : 声明:添加轮播图接口数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$post['imageFile']  => '图片资源';'
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 输  入 : '$post['imageSort']  => '景区排序';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 13:43
     */
    public function scenicspotCreate($post);

    /**
     * 名  称 : scenicspotSelect()
     * 功  能 : 声明:获取轮播图接口数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/25 14:41
     */
    public function scenicspotSelect($get);
}