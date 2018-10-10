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
use app\qrcode_module\working_version\v1\library\QrcodeLibrary;

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
}