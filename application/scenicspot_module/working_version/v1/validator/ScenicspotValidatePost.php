<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicspotValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\scenicspot_module\working_version\v1\validator;
use think\Validate;

class ScenicspotValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$post['imageFile']  => '图片资源';'
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 输  入 : '$post['imageSort']  => '景区排序';'
     * 创  建 : 2018/09/25 13:43
     */
    protected $rule =   [
        'scenicId'  => 'require|number',
        'imageSort' => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/25 13:43
     */
    protected $message  =   [
        'scenicId.require'  => '请正确发送景区ID',
        'scenicId.number'   => '请正确发送景区ID',
        'imageSort.require' => '请正确发送图片排序',
        'imageSort.number'  => '请正确发送图片排序',
    ];
}