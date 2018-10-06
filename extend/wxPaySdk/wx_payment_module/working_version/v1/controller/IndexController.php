<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  IndexController.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/07/23 11:20
 *  文件描述 :  微信统一下单支付控制器
 *  历史记录 :  -----------------------
 */
namespace app\wx_payment_module\working_version\v1\controller;
use App;
use app\wx_payment_module\working_version\v1\library\WxSdkConfig;
use think\Controller;
use app\wx_payment_module\working_version\v1\service\WxSdkService;
use app\wx_payment_module\working_version\v1\service\WxNotify;
use think\Validate;

class IndexController extends Controller
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
    public function wxUnifiedApy()
    {
        //验证数据
       $validate =  new Validate([
           'token'      => 'require',
           'body'       => 'require',
           'attach'     => 'require',
           'total_fee'  => 'require'
       ],[
           'token.require'      => '缺少商品描述`token`数据',
           'body.require'       => '缺少商品描述`body`数据',
           'attach.require'     => '缺少商品描述`attach`数据',
           'total_fee.require'  => '缺少商品描述`total_fee`数据'
       ]);
       //返回数据错误
        if(!$validate->check($_POST))
        {
            return returnResponse(1,$validate->getError(),false);
        }
        //POST来接收商户订单号
        $out_trade_no   = isset($_POST['out_trade_no']) ? $_POST['out_trade_no'] : ''.time().''.randomInt(5);
        //创建微信SDK
        $info = new WxSdkService();
        $info->Openid        = $info->GetOpenid($_POST['token']);
        $info->Body          = $_POST['body'];
        $info->Attach        = $_POST['attach'];
        $info->Out_trade_no  = $out_trade_no;
        $info->Total_fee     = $_POST['total_fee'];
        $info->Time_start    = date("YmdHis");
        $info->Time_expire   = date("YmdHis", time() + 600);
        $info->Notify_url    = config('wx_config.NotifyUrl');
        //获取微信支付参数
        $payData = $info->payOrder()['data'];
        //返回微信支付参数
        return returnResponse(0,'获取成功',$payData);
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
    public function wxRefund()
    {
        $out_trade_no   = isset($_REQUEST['out_trade_no']) ? $_REQUEST['out_trade_no'] : false;
        $total_fee      = isset($_REQUEST['total_fee']) ? $_REQUEST['total_fee'] : false;
        $refund_fee     = isset($_REQUEST['refund_fee']) ? $_REQUEST['refund_fee'] : false;
        //验证商品订单号
        VerificationData($out_trade_no,'缺少商品订单号`out_trade_no`数据');
        //验证支付总金额
        VerificationData($total_fee,'缺少支付总金额`total_fee`数据');
        //验证退款金额
        VerificationData($refund_fee,'缺少退款金额`refund_fee`数据');
        $info = new WxSdkService();
        //商户订单号
        $info->Out_trade_no = $out_trade_no;
        //支付总金额
        $info->Total_fee    = $total_fee;
        //退款金额
        $info->Refund_fee   = $refund_fee;
        //退款单号
        $info->Out_refund_no= 'T'.time().''.randomInt(5);
        //返回退款状态信息
        $refundData = $info->refund();
        return returnResponse(0,'获取成功',$refundData['data']);
    }
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
    }
}