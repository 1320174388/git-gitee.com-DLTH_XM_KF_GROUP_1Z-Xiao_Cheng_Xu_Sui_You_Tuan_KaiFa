<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  QrcodeService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\qrcode_module\working_version\v1\service;
use app\qrcode_module\working_version\v1\dao\QrcodeDao;
use app\qrcode_module\working_version\v1\library\QrcodeLibrary;
use app\qrcode_module\working_version\v1\validator\QrcodeValidatePost;
use app\qrcode_module\working_version\v1\validator\QrcodeValidateGet;
use app\qrcode_module\working_version\v1\validator\QrcodeValidatePut;
use app\qrcode_module\working_version\v1\validator\QrcodeValidateDelete;

class QrcodeService
{
    /**
     * 名  称 : qrcodeAdd()
     * 功  能 : 生成二维码逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['UserToken']   => '用户Token值';
     * 输  入 : $post['StringData']  => '字符串数据';
     * 输  入 : $post['codeWidth']   => '二维码宽度';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/10 21:27
     */
    public function qrcodeAdd($post)
    {
        // 实例化验证器代码
        $validate  = new QrcodeValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $qrcodeDao = new QrcodeDao();
        
        // 执行Dao层逻辑
        $res = $qrcodeDao->qrcodeCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}