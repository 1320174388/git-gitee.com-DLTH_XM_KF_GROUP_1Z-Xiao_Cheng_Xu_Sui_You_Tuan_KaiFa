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
use app\login\library\LoginLibrary;

class LoginService
{
    /**
     * 名  称 : userInit()
     * 功  能 : 处理用户登录认证，返回用户token身份标识
     * 变  量 : --------------------------------------
     * 输  入 : (string) $code      => '用户临时登录code凭证';
     * 输  入 : (string) $appId     => '小程序AppId';
     * 输  入 : (string) $appSecret => '小程序AppSecret秘钥';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/06/12 21:50
     */
    public function userInit($code,$appId,$appSecret)
    {
        // 引入LoginLibrary类库文件
        $data = (new LoginLibrary)->userOpenid($code,$appId,$appSecret);

        if($data['msg']=='error'){
            return returnData('error','登录失败');
        }

        return returnData('success',$data['data']);
    }
}