<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LoginInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 17:54
 *  文件描述 :  数据持久层接口,声明：获取用户数据、添加用户数据
 *  历史记录 :  -----------------------
 */
namespace app\login_module\working_version\v1\dao;

interface LoginInterface{

    /**
     * 名  称 : loginSelect()
     * 功  能 : 声明：获取用户数据
     * 变  量 : --------------------------------------
     * 输  入 : (string) $openid => '小程序用户openid';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/06/12 17:54
     */
    public function loginSelect($openid);

    /**
     * 名  称 : loginCreate()
     * 功  能 : 声明：添加用户数据
     * 变  量 : --------------------------------------
     * 输  入 : (string) $openid => '小程序用户openid';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/06/12 17:54
     */
    public function loginCreate($openid);

}
