<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxloginaddInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\wxloginadd_module\working_version\v1\dao;

interface WxloginaddInterface
{
    /**
     * 名  称 : wxloginaddCreate()
     * 功  能 : 声明:授权登录数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['userToken']  => '用户token';
     * 输  入 : $post['avatarUrl']  => '用户头像';
     * 输  入 : $post['nickName']   => '用户昵称';
     * 输  入 : $post['gender']     => '用户昵称';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/10 22:36
     */
    public function wxloginaddCreate($post);
}