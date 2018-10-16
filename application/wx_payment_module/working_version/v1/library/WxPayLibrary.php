<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  IndexController.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/07/23 11:20
 *  文件描述 :  微信统一下单支付控制器
 *  历史记录 :  -----------------------
 */
namespace app\wx_payment_module\working_version\v1\library;
use App;
use app\wx_payment_module\working_version\v1\service\WxSdkService;
use app\wx_payment_module\working_version\v1\service\WxNotify;

use think\Validate;

class WxPayLibrary extends WxRefund
{
    /**
     * 名  称 : wxUnifiedApy()
     * 创  建 : 2018/07/23 14:40
     * 功  能 : 微信统一下单支付接口
     * 变  量 : --------------------------------------
     * 输  入 : (string) `token`          => `用户token`              【必填】
     * 输  入 : (string) `body`           => `商品或支付单简要描述`   【必填】
     * 输  入 : (string) `attach`         => `商品附加数据`           【必填】
     * 输  入 : (string) `total_fee`      => `商品支付总金额`         【必填】
     * 输  入 : (string) `out_trade_no`   => `商户订单号`             【选填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":{}
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false
     */
    public function wxUnifiedApy($notifyUrl)
    {
        //验证数据
        $validate =  new Validate([
            'token'      => 'require',
            'body'       => 'require',
            'total_fee'  => 'require',
            'out_trade_no' => 'require'
        ],[
            'token.require'      => '缺少用户标识`token`数据',
            'body.require'       => '缺少商品描述`body`数据',
            'total_fee.require'  => '缺少商品价格`total_fee`数据',
            'out_trade_no.require'  => '缺少订单号`out_trade_no`数据',
        ]);
        //返回数据错误
        if(!$validate->check($_POST))
        {
            return returnData('error',$validate->getError());
        }
        $attach = isset($_POST['attach']) ? $_POST['attach'] : $_POST['body'];
        //创建微信SDK
        $info = new WxSdkService();
        $info->Openid        = $info->GetOpenid($_POST['token']);
        $info->Body          = $_POST['body'];
        $info->Attach        = $attach;
        $info->Out_trade_no  = $_POST['out_trade_no'];
        $info->Total_fee     = ($_POST['total_fee']*100);
        $info->Time_start    = date("YmdHis");
        $info->Time_expire   = date("YmdHis", time() + 600);
        $info->Notify_url    = $notifyUrl;
        try{
            //获取微信支付参数
            $payData = $info->payOrder()['data'];
            //返回微信支付参数
            return returnData('success',$payData);
        }catch (\Exception $e){
            return returnData('error','参数错误');
        }

    }
    /**
     * 名  称 : wxOrderQuery()
     * 创  建 : 2018/07/25 14:40
     * 功  能 : 查询订单
     * 变  量 : --------------------------------------
     * 输  入 : (string) `out_trade_no`   => `商户订单号`   【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":{}
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false
     */
    public function wxOrderQuery()
    {
        //获取商户订单号
        $out_trade_no = isset($_REQUEST['out_trade_no']) ? $_REQUEST['out_trade_no'] : false;
        //验证商户订单号参数
        VerificationData($out_trade_no,'缺少商品订单号`out_trade_no`数据');
        $info = new WxSdkService();
        //传入商户订单号
        $info->Out_trade_no = $out_trade_no;
        $data = $info->orderQuery();
        if ($data['msg'] == 'error') return returnResponse(0,'订单不存在');

        return returnResponse(0,'获取成功',$data['data']);
    }
    /**
     * 名  称 : wxRefund()
     * 创  建 : 2018/07/25 14:40
     * 功  能 : 微信退款
     * 变  量 : --------------------------------------
     * 输  入 : (string) `out_trade_no`   => `商户订单号`   【必填】
     * 输  入 : (string) `total_fee`      => `支付总金额`   【必填】
     * 输  入 : (string) `refund_fee`     => `退款金额`     【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":{}
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false
     */
//    public function wxRefund()
//    {
//        $out_trade_no   = isset($_REQUEST['out_trade_no']) ? $_REQUEST['out_trade_no'] : false;
//        $total_fee      = isset($_REQUEST['total_fee']) ? $_REQUEST['total_fee'] : false;
//        $refund_fee     = isset($_REQUEST['refund_fee']) ? $_REQUEST['refund_fee'] : false;
//        //验证商品订单号
//        VerificationData($out_trade_no,'缺少商品订单号`out_trade_no`数据');
//        //验证支付总金额
//        VerificationData($total_fee,'缺少支付总金额`total_fee`数据');
//        //验证退款金额
//        VerificationData($refund_fee,'缺少退款金额`refund_fee`数据');
//        $info = new WxSdkService();
//        //商户订单号
//        $info->Out_trade_no = $out_trade_no;
//        //支付总金额
//        $info->Total_fee    = $total_fee;
//        //退款金额
//        $info->Refund_fee   = $refund_fee;
//        //退款单号
//        $info->Out_refund_no= 'T'.time().''.randomInt(5);
//        //返回退款状态信息
//        $refundData = $info->refund();
//        return returnResponse(0,'获取成功',$refundData['data']);
//    }
    /**
     * 名  称 : wxRefundQuery()
     * 创  建 : 2018/07/25 19:40
     * 功  能 : 微信退款查询
     * 变  量 : --------------------------------------
     * 输  入 : (string) `out_refund_no`   => `退款单号`   【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":{}
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false
     */
    public function wxRefundQuery()
    {
        $out_refund_no   = isset($_REQUEST['out_refund_no']) ? $_REQUEST['out_refund_no'] : false;
        //验证退款单号
        VerificationData($out_refund_no,'缺少退款单号`out_refund_no`数据');
        $info = new WxSdkService();
        //设置退款单号
        $info->Out_refund_no = $out_refund_no;
        $refundQuery = $info->refundQuery();
        return returnResponse(0,'获取成功',$refundQuery['data']);
    }
    /**
     * 名  称 : wxPayNotify()
     * 创  建 : 2018/07/25 19:40
     * 功  能 : 支付回调
     */
    public function wxPayNotify()
    {
        $wxConfig = new WxSdkConfig();
        $notify = new WxNotify();
        $notify->Handle($wxConfig,false);
        return json_decode(NOTIFYDATA,true);
    }
}

class WxRefund
{
    /**
     * 名  称 : wxRefund()
     * 创  建 : 2018/07/25 14:40
     * 功  能 : 微信退款
     * 变  量 : --------------------------------------
     * 输  入 : (string) `out_trade_no`   => `商户订单号`   【必填】
     * 输  入 : (string) `total_fee`      => `支付总金额`   【必填】
     * 输  入 : (string) `refund_fee`     => `退款金额`     【必填】
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":{}
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false
     */
    public function wxRefund($data)
    {
        //验证数据
        $validate =  new \think\Validate([
            'out_trade_no'   => 'require',
            'total_fee'      => 'require',
            'refund_fee'     => 'require',
            'refund_desc'     => 'require'
        ],[
            'out_trade_no.require'      => '缺少商品订单号`out_trade_no`数据',
            'total_fee.require'       => '缺少支付总金额`total_fee`数据',
            'refund_fee.require'     => '缺少退款金额`refund_fee`数据',
            'refund_desc.require'     => '缺少退款金额`refund_desc`数据',
        ]);
        //返回数据错误
        if(!$validate->check($data))
        {
            return returnData('error',$validate->getError());
        }
        $input = new \WxPayRefund();
        //创建微信SDK配置类
        $config = new WxSdkConfig();
        //设置商户订单号
        $input->SetOut_trade_no($data['out_trade_no']);
        //设置支付金额
        $input->SetTotal_fee($data['total_fee']);
        //设置退款金额
        $input->SetRefund_fee($data['refund_fee']);
        //退款描述
        $input->SetRefund_desc($data['refund_desc']);

        //设置退款单号
        $input->SetOut_refund_no($this->UniqueToken());
        //设置操作帐号, 默认为商户号
        $input->SetOp_user_id($config->GetMerchantId());
        //返回退款信息
        $data = \WxPayApi::refund($config, $input);
        return returnData('success',$data);
    }
    /**
     * 名  称 : userToken()
     * 功  能 : 生成Token标识字符串
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : 单一功能函数，只返回token字符串
     * 创  建 : 2018/06/13 15:09
     */
    public function UniqueToken()
    {
        $str  = 'abcdefghijklmnopqrstuvwxyz';
        $str .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str .= '_123456789';

        $newStr = '';
        for( $i = 0; $i < 32; $i++) {
            $newStr .= $str[mt_rand(0,strlen($str)-1)];
        }
        $newStr .= time().mt_rand(100000,999999);

        return md5(uniqid().mt_rand(100000,999999)).md5($newStr);
    }
}