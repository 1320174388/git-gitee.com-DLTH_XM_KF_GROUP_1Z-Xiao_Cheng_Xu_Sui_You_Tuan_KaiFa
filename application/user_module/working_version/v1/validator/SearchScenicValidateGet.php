<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  SearchScenicValidateGet.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  用户端获取验证器
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\validator;
use think\Validate;

class SearchScenicValidateGet extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$get['scenic_name']  => '景区名称';'
     * 创  建 : 2018/10/05 10:23
     */
    protected $rule =   [
        'scenic_name'  => 'require',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/10/05 10:23
     */
    protected $message  =   [
        'scenic_name.require' => '景区名称scenic_name必须',
    ];
}