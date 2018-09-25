<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicspotValidateGet.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\scenicspot_module\working_version\v1\validator;
use think\Validate;

class ScenicspotValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 创  建 : 2018/09/25 14:41
     */
    protected $rule =   [
        'scenicId'  => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/25 14:41
     */
    protected $message  =   [
        'scenicId.require'  => '请正确发送景区ID',
        'scenicId.number'   => '请正确发送景区ID',
    ];
}