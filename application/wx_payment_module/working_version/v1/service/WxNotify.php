<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxNotify.php
 *  创 建 者 :  Feng TianShui
 *  创建日期 :  2018/07/26 15:20
 *  文件描述 :  微信支付回调逻辑
 *  历史记录 :  -----------------------
 */
namespace app\wx_payment_module\working_version\v1\service;
use App;
// +----------------------------------------------------------------------
// | 引入微信sdk配置实现类
// +----------------------------------------------------------------------
use app\wx_payment_module\working_version\v1\library\WxSdkConfig;

// +----------------------------------------------------------------------
// | TP5.1 `Loader::import` 方法以废除
// | TP5.1 强制引入没有命名空间的第三方类库 【微信支付sdk】
// +----------------------------------------------------------------------
require App::getRootPath() . 'extend'.'/wxPaySdk/WxPay.Api.php';
require App::getRootPath() . 'extend'.'/wxPaySdk/WxPay.Notify.php';


class WxNotify extends \WxPayNotify
{
    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);

        $config = new WxSdkConfig();
        $result = \WxPayApi::orderQuery($config, $input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    /**
     *
     * 回包前的回调方法
     * 业务可以继承该方法，打印日志方便定位
     * @param string $xmlData 返回的xml参数
     *
     **/
    public function LogAfterProcess($xmlData)
    {
        $fileName = fopen('wpy_log.txt','a');
        fwrite($fileName, json_encode($xmlData));
        fclose($fileName);
        return;
    }

    //重写回调处理函数
    /**
     * @param WxPayNotifyResults $data 回调解释出的参数
     * @param WxPayConfigInterface $config
     * @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
     * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
     */
    public function NotifyProcess($objData, $config, &$msg)
    {

        $data = $objData->GetValues();
        //TODO 1、进行参数校验
        if(!array_key_exists("return_code", $data)
            ||(array_key_exists("return_code", $data) && $data['return_code'] != "SUCCESS")) {
            //TODO失败,不是支付成功的通知
            //如果有需要可以做失败时候的一些清理处理，并且做一些监控
            $msg = "异常异常";
            $fileName = fopen('wpy_log.txt','a');
            $data = $msg.PHP_EOL;
            fwrite($fileName, $data);
            fclose($fileName);
            return false;
        }
        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            $fileName = fopen('wpy_log.txt','a');
            $data = $msg.PHP_EOL;
            fwrite($fileName, $data);
            fclose($fileName);
            return false;
        }

        //TODO 2、进行签名验证
        try {
            $checkResult = $objData->CheckSign($config);
            if($checkResult == false){
                //签名错误
                $fileName = fopen('wpy_log.txt','a');
                $data = '签名错误'.PHP_EOL;
                fwrite($fileName, $data);
                fclose($fileName);
                return false;
            }
        } catch(\Exception $e) {

        }

        //TODO 3、处理业务逻辑


        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            $fileName = fopen('wpy_log.txt','a');
            $data = $msg.PHP_EOL;
            fwrite($fileName, $data);
            fclose($fileName);
            return false;
        }
        define("NOTIFYDATA", json_encode($data,320));
        return true;
    }
}