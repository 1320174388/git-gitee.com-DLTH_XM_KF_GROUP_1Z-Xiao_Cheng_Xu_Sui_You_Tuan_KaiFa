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
    'AppId'     => 'wxbaa373833fc5237d',
    //小程序AppSecret  【必填】
    'AppSecret' => 'b261dfdd19b56183d0ed4adaad88bc93',
    //商户号           【必填】
    'Merchant'  => '1493660532',
    //商户支付密钥     【必填】
    'Key'       => 'fgGHGJ58GHJgjkjkj568GHghkfhjFHJ9',
    //支付回调Url      【必填】
    'NotifyUrl' => 'http://paysdk.weixin.qq.com/notify.php',
    //设置商户证书路径 cert.pem 【选填】 仅退款、撤销订单时需要
    'CertPath'  => App::getRootPath() . 'public'.'\cert\apiclient_cert.pem',
    //设置商户证书路径 key.pem  【选填】 仅退款、撤销订单时需要
    'KeyPath'   => App::getRootPath() . 'public'.'\cert\apiclient_key.pem'
];