<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  LoginController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 15:12
 *  文件描述 :  用户登录控制器
 *  历史记录 :  -----------------------
 */
namespace app\login\controller;
use think\Controller;
use app\login\service\LoginService;

class LoginController extends Controller
{
    /**
     * 名  称 : loginInit()
     * 功  能 : 执行小程序用户登录功能,获取用户openid写入数据库
     * 变  量 : --------------------------------------
     * 输  入 : (string) $code => '用户临时登录code凭证';
     * 输  出 : {"errNum":0,"retMsg":"登录成功","retData":{"token":"用户标识"}}
     * 输  出 : {"errNum":1,"retMsg":"登录失败","retData":false}
     * 创  建 : 2018/06/12 21:50
     */
    public function loginInit($code)
    {
        // 获取小程序配置信息：AppID
        $appID    = config('wx_config.wx_AppID');
        // 获取小程序配置信息：AppSecret
        $appSecret =  config('wx_config.wx_AppSecret');
        // 调用LoginService逻辑
        $data = (new LoginService())->userInit($code,$appID,$appSecret);

        if($data['msg']=='error'){
            return returnResponse(1,'登录失败');
        }

        // 返回token数据
        return returnResponse(0,'登录成功',$data['data']);
    }
}