<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicValidatePost.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请添加验证器
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\validator;
use think\Validate;

class ScenicValidatePost extends Validate
{
    /**
     * 名  称 : $rule
     * 功  能 : 验证规则
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['scenic_name']  => '景区名称';'
     * 输  入 : '$post['scenic_img']  => '景区图片';'
     * 输  入 : '$post['scenic_address']  => '景区地址';'
     * 输  入 : '$post['scenic_man']  => '景区负责人';'
     * 输  入 : '$post['scenic_phone']  => '联系电话';'
     * 输  入 : '$post['scenic_license']  => '执照照片路径';'
     * 输  入 : '$post['scenic_x']  => '景区x坐标';'
     * 输  入 : '$post['scenic_y']  => '景区y坐标';'
     * 输  入 : '$post['scenic_type']  => '景区类型';'
     * 输  入 : '$post['scenic_ticket']  => '景区门票';'
     * 输  入 : '$post['scenic_status']  => '申请状态';'
     * 创  建 : 2018/09/24 19:11
     */
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',
    ];

    /**
     * 名  称 : $message()
     * 功  能 : 设置验证信息
     * 创  建 : 2018/09/24 19:11
     */
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',
    ];
}