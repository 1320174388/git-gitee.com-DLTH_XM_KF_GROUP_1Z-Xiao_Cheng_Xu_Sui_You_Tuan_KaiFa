<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxSdkService.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/09/12 22:23
 *  文件描述 :  引入微信支付SDK
 *  历史记录 :  -----------------------
 */
namespace app\wx_payment_module\working_version\v1\service;
use App;
use app\wx_payment_module\working_version\v1\dao\UserDao;
// +----------------------------------------------------------------------
// | 引入微信sdk配置实现类
// +----------------------------------------------------------------------
use app\wx_payment_module\working_version\v1\library\WxSdkConfig;

// +----------------------------------------------------------------------
// | TP5.1 `Loader::import` 方法以废除
// | TP5.1 强制引入没有命名空间的第三方类库 【微信支付sdk】
// +----------------------------------------------------------------------
require App::getRootPath() . 'extend'.'/wxPaySdk/WxPay.Api.php';

class WxSdkService
{
    //用户openid
    public $Openid;
    //商品或支付单简要描述
    public $Body;
    //附加数据
    public $Attach;
    //商户系统内部的订单号
    public $Out_trade_no;
    //订单总金额
    public $Total_fee;
    //订单生成时间
    public $Time_start;
    //订单失效时间
    public $Time_expire;
    //微信支付异步通知回调地址
    public $Notify_url;
    //退款金额
    public $Refund_fee;
    //退款单号
    public $Out_refund_no;
    /**
     * 名  称 : payOrder()
     * 创  建 : 2018/07/24 16:40
     * 功  能 : 微信统一下单
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : [ 'msg' => 'success', 'data' => $data ]
     */
    public function payOrder()
    {
        $wxData = new \WxPayUnifiedOrder();
        //创建微信SDK配置类
        $wxConfig = new WxSdkConfig();
        //设置用户openid
        $wxData->SetOpenid($this->Openid);
        //设置商品或支付单简要描述
        $wxData->SetBody($this->Body);
        //设置商品附加数据
        $wxData->SetAttach($this->Attach);
        //设置商户订单号
        $wxData->SetOut_trade_no($this->Out_trade_no);
        //设置订单总金额
        $wxData->SetTotal_fee($this->Total_fee);
        //设置订单生成时间
        $wxData->SetTime_start($this->Time_start);
        //设置订单失效时间
        $wxData->SetTime_expire($this->Time_expire);
        //设置微信支付异步通知回调地址
        $wxData->SetNotify_url($this->Notify_url);
        //设置交易类型
        $wxData->SetTrade_type('JSAPI');
        //返回微信支付参数
        $order = \WxPayApi::unifiedOrder($wxConfig,$wxData);
        //验证微信支付参数
        $data = $this->verification($order);
        return returnData('success',$data);
    }
    /**
     * 名  称 : orderQuery()
     * 创  建 : 2018/07/25 18:40
     * 功  能 : 查询订单
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : [ 'msg' => 'success', 'data' => $data ]
     * 输  出 : [ 'msg' => 'error', 'data' => $data ]
     */
    public function orderQuery()
    {
        $data = new \WxPayOrderQuery();
        //创建微信SDK配置类
        $wxConfig= new WxSdkConfig();
        //设置商户订单号
        $data->SetOut_trade_no($this->Out_trade_no);
        //返回结果
        $res = \WxPayApi::orderQuery($wxConfig,$data);
        //订单错误
        if (isset($res['err_code'])) return returnData('error',$res);
        //查询订单成功
        return returnData('success',$res);
    }
    /**
     * 名  称 : refund()
     * 创  建 : 2018/07/25 18:40
     * 功  能 : 退款
     * 变  量 : --------------------------------------
     * 输  出 : [ 'msg' => 'success', 'data' => $data ]
     * 输  出 : [ 'msg' => 'error', 'data' => $data ]
     */
    public function refund()
    {
        $input = new \WxPayRefund();
        //创建微信SDK配置类
        $config = new WxSdkConfig();
        //设置商户订单号
        $input->SetOut_trade_no($this->Out_trade_no);
        //设置支付金额
        $input->SetTotal_fee($this->Total_fee);
        //设置退款金额
        $input->SetRefund_fee($this->Refund_fee);
        //设置退款单号
        $input->SetOut_refund_no($this->Out_refund_no);
        //设置操作帐号, 默认为商户号
        $input->SetOp_user_id($config->GetMerchantId());
        //返回退款信息
        $data = \WxPayApi::refund($config, $input);
        return returnData('success',$data);
    }
    /**
     * 名  称 : refundQuery()
     * 创  建 : 2018/07/25 18:40
     * 功  能 : 退款查询
     * 变  量 : --------------------------------------
     * 输  出 : [ 'msg' => 'success', 'data' => $data ]
     * 输  出 : [ 'msg' => 'error', 'data' => $data ]
     */
    public function refundQuery()
    {
        $input = new \WxPayRefundQuery();
        //创建微信SDK配置类
        $config = new WxSdkConfig();
        //设置退款单号
        $input->SetOut_refund_no($this->Out_refund_no);
        $data = \WxPayApi::refundQuery($config, $input);
        return returnData('success',$data);
    }
    /**
     * 名  称 : verification()
     * 创  建 : 2018/07/24 18:40
     * 功  能 : 验证微信返回支付数据
     * 变  量 : --------------------------------------
     * 输  入 : $UnifiedOrderResult  微信支付参数
     * 输  出 : $parameters   最终微信支付参数
     */
    public function verification($UnifiedOrderResult)
    {
        if(!array_key_exists("appid", $UnifiedOrderResult)
            || !array_key_exists("prepay_id", $UnifiedOrderResult)
            || $UnifiedOrderResult['prepay_id'] == "")
        {
            throw new \WxPayException("参数错误");
        }
        $jsapi = new \WxPayJsApiPay();
        $jsapi->SetAppid($UnifiedOrderResult["appid"]);
        $timeStamp = time();
        $jsapi->SetTimeStamp("$timeStamp");
        $jsapi->SetNonceStr(\WxPayApi::getNonceStr());
        $jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);

        $config = new WxSdkConfig();
        $jsapi->SetPaySign($jsapi->MakeSign($config));
        $parameters = json_encode($jsapi->GetValues());
        return $parameters;
    }
    /**
     * 名  称 : GetOpenid()
     * 创  建 : 2018/07/24 18:40
     * 功  能 : 获取Openid
     * 变  量 : --------------------------------------
     * 输  入 : (string)  $token =>   `用户token`
     * 输  出 : (string)  openid
     */
    public function GetOpenid($token)
    {
       $result = (new UserDao())->getOpenid($token);
       //返回结果
        return $result['data']['user_openid'];
    }
}