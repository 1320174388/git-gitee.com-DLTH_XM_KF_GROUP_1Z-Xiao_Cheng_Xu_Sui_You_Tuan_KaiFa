<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 名  称 : returnData()
 * 功  能 : 返回函数数据
 * 变  量 : --------------------------------------
 * 输  入 : (string) $string => 'success'/'error'
 * 输  入 : ( data ) $data   => '任意数据格式内容'
 * 输  出 : [ 'msg' => 'success', 'data' => $data ]
 * 输  出 : [ 'msg' => 'error',  'data' => $data ]
 * 创  建 : 2018/06/12 21:40
 */
function returnData($string,$data = false)
{
    return [ 'msg'=>$string, 'data'=>$data ];
}

/**
 * 名  称 : returnResponse()
 * 功  能 : 返回接口响应数据
 * 变  量 : --------------------------------------
 * 输  入 : (int)    $number  => '返回状态编号';
 * 输  入 : (string) $string  => '提示信息'
 * 输  入 : (data)   $retData => '任意数据格式内容'
 * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":{}
 * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false
 * 创  建 : 2018/06/12 21:40
 */
function returnResponse($number,$string,$retData = false)
{
    return json_encode([
        'errNum'  => $number,
        'retMsg'  => $string,
        'retData' => $retData
    ],JSON_UNESCAPED_UNICODE );
}

/**
 * 精确加法
 * @param [type] $a [description]
 * @param [type] $b [description]
 */
function math_add($a,$b,$scale = '2') {
    return bcadd($a,$b,$scale);
}
/**
 * 精确减法
 * @param [type] $a [description]
 * @param [type] $b [description]
 */
function math_sub($a,$b,$scale = '2') {
    return bcsub($a,$b,$scale);
}
/**
 * 精确乘法
 * @param [type] $a [description]
 * @param [type] $b [description]
 */
function math_mul($a,$b,$scale = '2') {
    return bcmul($a,$b,$scale);
}
/**
 * 精确除法
 * @param [type] $a [description]
 * @param [type] $b [description]
 */
function math_div($a,$b,$scale = '2') {
    return bcdiv($a,$b,$scale);
}
/**
 * 精确求余/取模
 * @param [type] $a [description]
 * @param [type] $b [description]
 */
function math_mod($a,$b) {
    return bcmod($a,$b);
}
/**
 * 比较大小
 * @param [type] $a [description]
 * @param [type] $b [description]
 * 大于 返回 1 等于返回 0 小于返回 -1
 */
function math_comp($a,$b,$scale = '5') {
    return bccomp($a,$b,$scale); // 比较到小数点位数
}