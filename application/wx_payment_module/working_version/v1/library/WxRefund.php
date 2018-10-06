<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxRefund.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/08/16 10:30
 *  文件描述 :  微信退款
 *  历史记录 :  -----------------------
 */
namespace app\wx_payment_module\working_version\v1\library;
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