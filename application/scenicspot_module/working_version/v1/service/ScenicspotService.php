<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicspotService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\scenicspot_module\working_version\v1\service;
use app\scenicspot_module\working_version\v1\dao\ScenicspotDao;
use app\scenicspot_module\working_version\v1\library\ScenicspotLibrary;
use app\scenicspot_module\working_version\v1\validator\ScenicspotValidatePost;
use app\scenicspot_module\working_version\v1\validator\ScenicspotValidateGet;
use app\scenicspot_module\working_version\v1\validator\ScenicspotValidatePut;
use app\scenicspot_module\working_version\v1\validator\ScenicspotValidateDelete;

class ScenicspotService
{
    /**
     * 名  称 : scenicspotAdd()
     * 功  能 : 添加轮播图接口逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$post['imageFile']  => '图片资源';'
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 输  入 : '$post['imageSort']  => '景区排序';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 13:43
     */
    public function scenicspotAdd($post)
    {
        // 实例化验证器代码
        $validate  = new ScenicspotValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'imageFile',
            './uploads/scenicspot/',
            '/uploads/scenicspot/'
        );
        if($imageUploads['msg']=='error'){
            return returnData('error','请发送文件数据名称');
        }
        $post['imageFile'] = $imageUploads['data'];
        
        // 实例化Dao层数据类
        $scenicspotDao = new ScenicspotDao();
        
        // 执行Dao层逻辑
        $res = $scenicspotDao->scenicspotCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}