<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\dao;

interface PrizelistInterface
{
    /**
     * 名  称 : prizelistCreate()
     * 功  能 : 声明:添加奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenicId']  => '景区主键';
     * 输  入 : $post['przeName']  => '奖品名称';
     * 输  入 : $post['przeFile']  => '奖品图片';
     * 输  入 : $post['przePrice'] => '奖品价值';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 15:03
     */
    public function prizelistCreate($post);

    /**
     * 名  称 : prizelistSelect()
     * 功  能 : 声明:获取奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']  => '景区主键';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/25 15:34
     */
    public function prizelistSelect($get);

    /**
     * 名  称 : prizelistUpdate()
     * 功  能 : 声明:修改奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['prizeId']   => '奖品主键';
     * 输  入 : $put['scenicId']  => '景区主键';
     * 输  入 : $put['przeName']  => '奖品名称';
     * 输  入 : $put['przeFile']  => '奖品图片';
     * 输  入 : $put['przePrice'] => '奖品价值';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 16:15
     */
    public function prizelistUpdate($put);

    /**
     * 名  称 : prizelistDelete()
     * 功  能 : 声明:删除奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['prizeId']   => '奖品主键';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 20:46
     */
    public function prizelistDelete($delete);
}