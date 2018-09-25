<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\validator;
use think\Validate;

class PrizelistValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['scenicId']  => '景区主键';
     * 输  入 : $post['przeName']  => '奖品名称';
     * 输  入 : $post['przeFile']  => '奖品图片';
     * 输  入 : $post['przePrice'] => '奖品价值';
     * 创  建 : 2018/09/25 15:03
     */
    protected $rule =   [
        'scenicId'  => 'require|number',
        'przeName'  => 'require|min:1|max:12',
        'przePrice' => 'require|float',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/25 15:03
     */
    protected $message  =   [
        'scenicId.require'  => '请正确发送景区ID',
        'scenicId.number'   => '请正确发送景区ID',
        'przeName.require'  => '请输入1~12字奖品名称',
        'przeName.min'      => '请输入1~12字奖品名称',
        'przeName.max'      => '请输入1~12字奖品名称',
        'przePrice.require' => '请发送商品价值float浮点数',
        'przePrice.float'   => '请发送商品价值float浮点数',
    ];
}