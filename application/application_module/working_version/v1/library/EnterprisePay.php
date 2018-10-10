<?php
namespace app\application_module\working_version\v1\library;
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  EnterprisePay.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/08/16 10:30
 *  文件描述 :  微信商户向用户付款
 *  历史记录 :  -----------------------
 */
class EnterprisePay
{
    //商户配置数组
     static $configArray = [
        //商户账号appid
        'mch_appid'         =>  '',
        //商户号
        'mchid'             =>  '',
        //商户密钥
        'key'               =>  '',
         //证书文件路径cert
         'sslCertPath'      =>  '',
         //证书文件路径key
         'sslKeyPath'      =>   ''
    ];
    /**
     * 名 称 : __construct()
     * 功 能 : 构造函数
     * 输 入 : (string)   $mch_appid      =  商户账号appid
     * 输 入 : (string)   $mchid          =  商户号
     * 输 入 : (string)   $key            =  商户密钥
     * 输 入 : (string)   $sslCertPath    =  证书文件路径cert
     * 输 入 : (string)   $sslKeyPath     =  证书文件路径key
     * 创 建 : 2018/08/16 10:29
     */
    public function __construct($mch_appid,$mchid,$key,$sslCertPath,$sslKeyPath)
    {
        self::$configArray['mch_appid'] = $mch_appid;
        self::$configArray['mchid'] = $mchid;
        self::$configArray['key'] = $key;
        self::$configArray['sslCertPath'] = $sslCertPath;
        self::$configArray['sslKeyPath'] = $sslKeyPath;
    }

    /**
     * 名 称 : pay()
     * 功 能 : 微信企业向个人付款
     * 输 入 : (string)   $desc           =  企业付款描述信息
     * 输 入 : (string)   $openid         =  用户openid
     * 输 入 : (string)   $re_user_name   =  用户真实姓名
     * 输 入 : (int)      $amount         =  金额
     * 创 建 : 2018/08/16 10:29
     */
    public function pay($data)
    {
        //请求微信企业向个人付款接口
        $xml = self::requestApi(self::requestData($data));
        $op = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        //xml 转成数组
        $resultArr = json_decode(json_encode($op, true),320);

        //返回结果
        if ($resultArr['return_code'] == 'SUCCESS' && $resultArr['result_code'] == 'SUCCESS'){
            return ['msg'=>0,'data'=>$resultArr];
        }
        return ['msg'=>1,'data'=>$resultArr];

    }
    /**
     * 名 称 : requestData()
     * 功 能 : 请求数据
     * 创 建 : 2018/08/16 10:29
     */
    protected static function requestData($data)
    {
        $datas = [
            //商户账号appid
            'mch_appid'         => self::$configArray['mch_appid'],
            //商户号
            'mchid'             => self::$configArray['mchid'],
            //随机字符串
            'nonce_str'         => self::randomString(),
            //商户订单号
            'partner_trade_no'  => ''.time().self::randomString(10),
            //校验用户姓名选项 不效验【NO_CHECK】
            'check_name'        => 'FORCE_CHECK',
            //Ip地址
            'spbill_create_ip'  => $_SERVER['REMOTE_ADDR'],
        ];
        //合并数据
        $datas = array_merge($datas,$data);
        //生成签名
        $sign = self::sign($datas);
        $datas['sign'] = $sign;
        //转换xml
        return self::arrayXml($datas);
    }
    /**
     * 名 称 : sign()
     * 功 能 : 生成签名
     * 输 入 : (array)   $data  = >数据
     * 创 建 : 2018/08/16 10:29
     */
    protected static function sign($data)
    {
        //1、按照参数名ASCII字典序排序
        $stringA = '';
        ksort($data);
        //转换url格式
        foreach ($data as $key => $value){
            $stringA .= $key.'='.$value.'&';
        }
        //2、拼接商户平台密钥key
        $stringSignTemp = $stringA.'key='.self::$configArray['key'];
        //3、MD5加密并转大写
        $string = strtoupper(MD5($stringSignTemp));
        return $string;
    }
    /**
     * 名 称 : randomString()
     * 功 能 : 生成随机字符串
     * 输 入 ：(int)   $length => 字符串长度
     * 输 出 : 随机字符串
     * 创 建 : 2018/08/16 10:29
     */
    protected static function randomString($length = 32)
    {
        $str = '1234567890qwertyuiopasdfghjklzxcvbnm';
        $randomStr = '';
        for ($i = 0; $i < $length;$i++){
            $randomStr .= substr($str, mt_rand(0, strlen($str)-1), 1);
        }
        return $randomStr;
    }
    /**
     * 名 称 : arrayXml()
     * 功 能 : 数组转换xml
     * 输 入 ：(array)   $data  = >数据
     * 输 出 : xml 字符串
     * 创 建 : 2018/08/16 10:29
     */
    protected static function arrayXml($data)
    {
        $xml = '';
        foreach ($data as $key => $value)
        {
            $xml .=  '<'.$key.'>'.$value.'</'.$key.'>';
        }
        return '<xml>'.$xml.'</xml>';
    }
    /**
     * 名 称 : requestApi()
     * 功 能 : 请求微信企业向个人付款接口
     * 输 入 ：(string)   $xmlData  = > 请求数据
     * 输 出 :
     * 创 建 : 2018/08/16 10:29
     */
    protected static function requestApi($xmlData)
    {
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //设置证书
        //使用证书：cert 与 key 分别属于两个.pem文件
        $sslCertPath = self::$configArray['sslCertPath'];
        $sslKeyPath = self::$configArray['sslKeyPath'];
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT, $sslCertPath);
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY, $sslKeyPath);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        set_time_limit(0);
        //运行curl
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
