<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  QrcodeController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码控制器
 *  历史记录 :  -----------------------
 */
namespace app\qrcode_module\working_version\v1\controller;
use think\Controller;
use app\qrcode_module\working_version\v1\service\QrcodeService;

class QrcodeController extends Controller
{
    /**
     * 名  称 : qrcodePost()
     * 功  能 : 生成二维码接口
     * 变  量 : --------------------------------------
     * 输  入 : $post['UserToken']   => '用户Token值';
     * 输  入 : $post['StringData']  => '字符串数据';
     * 输  入 : $post['codeWidth']   => '二维码宽度';
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":true}
     * 创  建 : 2018/10/10 21:27
     */
    public function qrcodePost(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $qrcodeService = new QrcodeService();
        
        // 获取传入参数
        $post = $request->post();
        
        // 执行Service逻辑
        $res = $qrcodeService->qrcodeAdd($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','请求成功');
    }

    /**
     * 名  称 : qrcodePut()
     * 功  能 : 生成小程序码接口
     * 变  量 : --------------------------------------
     * 输  入 : $put['token']      => '用户Token值';
     * 输  入 : $put['scene']      => '发送携带的参数';
     * 输  入 : $put['page']       => '页面地址';
     * 输  入 : $put['width']      => '二维码尺寸';
     * 输  入 : $put['line_color'] => '{"r":0,"g":0,"b":0}';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/10/18 22:28
     */
    public function qrcodePut(\think\Request $request)
    {
        // 实例化Service层逻辑类
        $qrcodeService = new QrcodeService();
        
        // 获取传入参数
        $put = $request->put();
        
        // 执行Service逻辑
        $res = $qrcodeService->qrcodeEdit($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'S','');
    }
}