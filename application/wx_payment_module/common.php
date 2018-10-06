<?php
// +----------------------------------------------------------------------
// | 版权声明 :  地老天荒科技有限公司
// | 文件名称 :  common.php
// | 创 建 者 :  Feng TianShui
// | 创建日期 :  2018/07/23 09:20
// | 文件描述 :  微信支付公共函数文件
// +----------------------------------------------------------------------
/**
 * 名  称 : randomInt()
 * 创  建 : 2018/07/25 09:40
 * 功  能 : 生成随机数
 * 变  量 : --------------------------------------
 * 输  入 : (int)     $length => int; 【默认：5】
 * 输  出 : (string)  随机数字
 */
function randomInt($length = 5)
{
    $int = '1234567890';
    $resInt = '';
    for ($i = 0; $i <= $length; $i++){
        $resInt .= substr($int,rand(1,strlen($int)),1);
    }
    return $resInt;
}
/**
 * 名  称 : VerificationData()
 * 创  建 : 2018/07/25 09:40
 * 功  能 : 验证数据是否为空
 * 变  量 : --------------------------------------
 * 输  入 : $VerificationData  => 验证的数据
 * 输  入 ：$message           => 提示信息
 * 输  出 :
 */
function VerificationData($VerificationData,$message)
{
    $VerificationData or exit(returnResponse(0,$message));
}