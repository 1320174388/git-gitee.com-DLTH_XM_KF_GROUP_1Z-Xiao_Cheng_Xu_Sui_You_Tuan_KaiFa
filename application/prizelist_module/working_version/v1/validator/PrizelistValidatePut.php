<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\validator;
use think\Validate;

class PrizelistValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['prizeId']   => '奖品主键';
     * 输  入 : $put['scenicId']  => '景区主键';
     * 输  入 : $put['przeName']  => '奖品名称';
     * 输  入 : $put['przeFile']  => '奖品图片';
     * 输  入 : $put['przePrice'] => '奖品价值';
     * 创  建 : 2018/09/25 16:15
     */
    protected $rule =   [
        'prizeId'   => 'require|number',
        'scenicId'  => 'require|number',
        'przeName'  => 'require|min:1|max:12',
        'przePrice' => 'require|float',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/25 16:15
     */
    protected $message  =   [
        'prizeId.require'   => '请正确发送奖品ID',
        'prizeId.number'    => '请正确发送奖品ID',
        'scenicId.require'  => '请正确发送景区ID',
        'scenicId.number'   => '请正确发送景区ID',
        'przeName.require'  => '请输入1~12字奖品名称',
        'przeName.min'      => '请输入1~12字奖品名称',
        'przeName.max'      => '请输入1~12字奖品名称',
        'przePrice.require' => '请发送商品价值float浮点数',
        'przePrice.float'   => '请发送商品价值float浮点数',
    ];
}