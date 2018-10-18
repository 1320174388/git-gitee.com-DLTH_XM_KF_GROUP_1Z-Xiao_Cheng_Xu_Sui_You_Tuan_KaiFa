<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  QrcodeDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码数据层
 *  历史记录 :  -----------------------
 */
namespace app\qrcode_module\working_version\v1\dao;
use app\qrcode_module\working_version\v1\library\AccessTokenRequest;
use app\qrcode_module\working_version\v1\library\Small_Program_Generate;

class QrcodeDao implements QrcodeInterface
{
    /**
     * 名  称 : qrcodeCreate()
     * 功  能 : 生成二维码数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['UserToken']   => '用户Token值';
     * 输  入 : $post['StringData']  => '字符串数据';
     * 输  入 : $post['codeWidth']   => '二维码宽度';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/10 21:27
     */
    public function qrcodeCreate($post)
    {
        //生成二维码图片
        $filename = '/uploads/wx_qrcode/'.$post['UserToken'].'.png';
        \QRcode::png(
            $post['StringData']
            ,'.'.$filename , 'L', $post['codeWidth'], 2
        );
        // 处理函数返回值
        return \RSD::wxReponse(true,'M',$filename,'请求失败');
    }

    /**
     * 名  称 : qrcodeUpdate()
     * 功  能 : 生成小程序码数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['token']      => '用户Token值';
     * 输  入 : $put['scene']      => '发送携带的参数';
     * 输  入 : $put['page']       => '页面地址';
     * 输  入 : $put['width']      => '二维码尺寸';
     * 输  入 : $put['line_color'] => '{"r":0,"g":0,"b":0}';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/18 22:28
     */
    public function qrcodeUpdate($put)
    {
        // TODO :  获取success_token
        $accessTokenArr = AccessTokenRequest::wxRequest(
            config('v1_config.wx_AppID'),
            config('v1_config.wx_AppSecret'),
            './project_access_token/'
        );

        $res = Small_Program_Generate::SmallRequest(
            $accessTokenArr['data']['access_token'],
            [
                // 发送携带的参数
                'scene'      => $put['scene'],
                // 页面地址
                'page'       => $put['page'],
                // 二维码尺寸
                'width'      => $put['width'],
                // 二维码颜色
                'auto_color' => false,
                'line_color' => json_decode(
                    $put['line_color'],true
                ),
                'is_hyaline' => true,
            ],
            // 二维吗保存路径
            './uploads/wx_appkeycode/',
            // 用户Token标识
            $put['token']
        );

        // 处理函数返回值
        return \RSD::wxReponse($res,'L',$res['data'],$res['data']);
    }
}