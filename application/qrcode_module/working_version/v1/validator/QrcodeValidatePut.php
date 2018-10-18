<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  QrcodeValidatePut.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 21:22
 *  文件描述 :  生成二维码修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\qrcode_module\working_version\v1\validator;
use think\Validate;

class QrcodeValidatePut extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : $put['token']      => '用户Token值';
     * 输  入 : $put['scene']      => '发送携带的参数';
     * 输  入 : $put['page']       => '页面地址';
     * 输  入 : $put['width']      => '二维码尺寸';
     * 输  入 : $put['line_color'] => '{"r":0,"g":0,"b":0}';
     * 创  建 : 2018/10/18 22:28
     */
    protected $rule =   [
        'token'       => 'require|min:32|max:32',
        'scene'       => 'require|max:32',
        'page'        => 'require',
        'width'       => 'require|number',
        'line_color'  => 'require',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/18 22:28
     */
    protected $message  =   [
        'token.require'      => '请发送用户Token标识',
        'token.min'          => '请发送用户Token标识',
        'token.max'          => '请发送用户Token标识',
        'scene.require'      => '请发送不超过32字携带的参数',
        'scene.max'          => '请发送不超过32字携带的参数',
        'page.require'       => '请发送页面地址不带开头/符号',
        'width.require'      => '请发送二维码尺寸',
        'width.number'       => '请发送二维码尺寸',
        'line_color.require' => '颜色参数:{"r":0,"g":0,"b":0}',
    ];
}