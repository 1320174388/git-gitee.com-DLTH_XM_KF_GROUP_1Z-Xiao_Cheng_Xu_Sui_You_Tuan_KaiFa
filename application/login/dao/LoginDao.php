<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  LoginDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 18:00
 *  文件描述 :  数据持久层,操作User：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\login\dao;
use  app\login\model\UserModel;

class LoginDao implements LoginInterface
{
    /**
     * 名  称 : loginSelect()
     * 功  能 : 声明：获取用户数据
     * 变  量 : --------------------------------------
     * 输  入 : (string) $openid => '小程序用户openid';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/06/12 21:48
     */
    public function loginSelect($openid)
    {
        $userList = UserModel::all();

        return returnData('success',$userList);
    }

    /**
     * 名  称 : loginCreate()
     * 功  能 : 声明：添加用户数据
     * 变  量 : --------------------------------------
     * 输  入 : (string) $openid => '小程序用户openid';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/06/12 21:48
     */
    public function loginCreate($openid)
    {

    }
}