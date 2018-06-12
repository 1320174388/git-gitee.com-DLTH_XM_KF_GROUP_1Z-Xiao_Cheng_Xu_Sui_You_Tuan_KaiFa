<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  LoginService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 17:24
 *  文件描述 :  处理用户登录的业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\login\service;
use app\login\dao\LoginDao;

class LoginService
{
    /**
     * 名  称 : userInfo()
     * 功  能 : 获取dao层返回的用户信息
     * 变  量 : --------------------------------------
     * 输  入 : (string) $openid => '小程序用户openid';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/06/12 21:50
     */
    public function userInfo($openid)
    {
        $arr = (new LoginDao)->loginSelect($openid);

        if($arr['msg']=='error') return returnData($arr);

        return returnData('success',$arr['data']);
    }
}