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
     * 输  出 : json_encode([
     *              'errNum'  => 0/1,
     *              'retMsg'  => '登录成功/登录失败',
     *              'retData' => false/[
     *                  'token' => '用户唯一身份标识'
     *              ]
     *          ]);
     * 创  建 : 2018/06/12 21:50
     */
    public function loginInit($code)
    {
        $arr = (new LoginService)->userInfo($code);

        if($arr['msg'] == 'error'){
            return returnResponse(1,'登录失败');
        }

        return returnResponse(0,'登录成功',[
            'token' => $arr['data']
        ]);
    }
}