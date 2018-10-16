<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  common.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  用户端模块公共何函数文件
 *  历史记录 :  -----------------------
 */

// +----------------------------------
// : 自定义函数区域
// +----------------------------------
/**
 * 名  称 : randomInt()
 * 功  能 : 生成随机数
 * 变  量 : --------------------------------------
 * 输  入 : (int) $length   =>  长度  【默认：5】
 * 输  出 : （string） 随机数
 * 创  建 : 2018/07/31 09:20
 */
function randomInt($length = 5)
{
    $int = '1234567890';
    $resInt = '';
    for ($i = 0; $i < $length; $i++){
        $resInt .= substr($int,rand(1,strlen($int)),1);
    }
    return $resInt;
}
/**
 * 求两个已知经纬度之间的距离,单位为米
 *
 * @param lng1 $ ,lng2 经度
 * @param lat1 $ ,lat2 纬度
 * @return float 距离，单位米
 */
function getdistance($lng1, $lat1, $lng2, $lat2) {
    // 将角度转为狐度
    $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);
    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
    return $s;
}