<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  QrcodeInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码_数据接口声明
 *  历史记录 :  -----------------------
 */
namespace app\qrcode_module\working_version\v1\dao;

interface QrcodeInterface
{
    /**
     * 名  称 : qrcodeCreate()
     * 功  能 : 声明:生成二维码数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['UserToken']   => '用户Token值';
     * 输  入 : $post['StringData']  => '字符串数据';
     * 输  入 : $post['codeWidth']   => '二维码宽度';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/10 21:27
     */
    public function qrcodeCreate($post);

    /**
     * 名  称 : qrcodeUpdate()
     * 功  能 : 声明:生成小程序码数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['token']      => '用户Token值';
     * 输  入 : $put['scene']      => '发送携带的参数';
     * 输  入 : $put['page']       => '页面地址';
     * 输  入 : $put['width']      => '二维码尺寸';
     * 输  入 : $put['line_color'] => '{"r":0,"g":0,"b":0}';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/18 22:28
     */
    public function qrcodeUpdate($put);
}