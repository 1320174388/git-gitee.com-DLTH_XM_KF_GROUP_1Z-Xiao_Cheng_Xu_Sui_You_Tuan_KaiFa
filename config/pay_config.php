<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  wx_config.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/07/23 09:20
 *  文件描述 :  微信配置文件
 *  历史记录 :  -----------------------
 */
return [
    //小程序appid      【必填】
    'AppId'     => 'wx6516385261fa963a',
    //小程序AppSecret  【必填】
    'AppSecret' => 'dc9823245780a506e679a121bb535e0b',
    //商户号           【必填】
    'Merchant'  => '1502775551',
    //商户支付密钥     【必填】
    'Key'       => 'weqoiHJLDK46291werpvmdklsDPOS389',
    //支付回调Url      【必填】
    'NotifyUrl' => 'http://www.zhshgp.com/v1/wx_payment_module/wxPayNotify',
    //设置商户证书路径 cert.pem 【选填】 仅退款、撤销订单时需要
    'CertPath'  => App::getRootPath() . 'public'.'/cert/apiclient_cert.pem',
    //设置商户证书路径 key.pem  【选填】 仅退款、撤销订单时需要
    'KeyPath'   => App::getRootPath() . 'public'.'/cert/apiclient_key.pem'
];