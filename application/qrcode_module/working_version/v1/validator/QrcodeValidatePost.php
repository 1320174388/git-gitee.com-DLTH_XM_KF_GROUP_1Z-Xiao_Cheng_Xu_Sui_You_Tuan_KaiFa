<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  QrcodeValidatePost.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\qrcode_module\working_version\v1\validator;
use think\Validate;

class QrcodeValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $post['UserToken']   => '用户Token值';
     * 输  入 : $post['StringData']  => '字符串数据';
     * 输  入 : $post['codeWidth']   => '二维码宽度';
     * 创  建 : 2018/10/10 21:27
     */
    protected $rule =   [
        'UserToken'   => 'require|min:32|max:32',
        'StringData'  => 'require|min:1|max:2000',
        'codeWidth'   => 'require|number',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/10 21:27
     */
    protected $message  =   [
        'UserToken.require'  => '请发送用户Token值',
        'UserToken.min'      => '请发送用户Token值',
        'UserToken.max'      => '请发送用户Token值',
        'StringData.require' => '请发送不超过2000字【字符串】数据',
        'StringData.min'     => '请发送不超过2000字【字符串】数据',
        'StringData.max'     => '请发送不超过2000字【字符串】数据',
        'codeWidth.require'  => '请发送二维码宽度',
        'codeWidth.number'   => '请发送二维码宽度',
    ];
}