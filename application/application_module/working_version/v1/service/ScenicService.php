<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicService.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\service;
use app\application_module\working_version\v1\dao\ScenicDao;
use app\application_module\working_version\v1\library\ScenicLibrary;
use app\application_module\working_version\v1\validator\ScenicValidatePost;
use app\application_module\working_version\v1\validator\ScenicValidateGet;
use app\application_module\working_version\v1\validator\ScenicValidatePut;
use app\application_module\working_version\v1\validator\ScenicValidateDelete;

class ScenicService
{

    /**
     * 名  称 : scenicAdd()
     * 功  能 : 景区申请逻辑
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['scenic_name']  => '景区名称';'
     * 输  入 : '$post['scenic_img']  => '景区图片';'
     * 输  入 : '$post['scenic_address']  => '景区地址';'
     * 输  入 : '$post['scenic_man']  => '景区负责人';'
     * 输  入 : '$post['scenic_phone']  => '联系电话';'
     * 输  入 : '$post['scenic_x']  => '景区x坐标';'
     * 输  入 : '$post['scenic_y']  => '景区y坐标';'
     * 输  入 : '$post['scenic_type']  => '景区类型';'
     * 输  入 : '$post['scenic_ticket']  => '景区门票';'
     * 输  入 : '$post['scenic_status']  => '申请状态';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicAdd($post)
    {
        // 实例化Dao层数据类
        $scenicDao = new ScenicDao();

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'imageFile',
            './uploads/scenicspot/',
            '/uploads/scenicspot/'
        );
        if($imageUploads['msg']=='error'){
            return returnData('error','请发送文件数据');
        }
        $post['scenic_img'] = $imageUploads['data'];

        // 执行Dao层逻辑
        $res = $scenicDao->scenicAdd($post);

        // 处理函数返回值
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : scenicPost()
     * 功  能 : 景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区ID';
     * 输  入 : '$post['scenic_license']  => '执照照片路径';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function imgPost($post)
    {
        // 实例化Dao层数据类
        $scenicDao = new ScenicDao();

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'imageFile',
            './uploads/scenicspot/',
            '/uploads/scenicspot/'
        );
        if($imageUploads['msg']=='error'){
            return returnData('error','请发送文件数据');
        }
        $post['scenic_license'] = $imageUploads['data'];

        // 执行Dao层逻辑
        $res = $scenicDao->imgPost($post);

        // 处理函数返回值
        return returnData('success',$res['data']);
    }


    /**
     * 名  称 : obtainScenic()
     * 功  能 : 获取景区列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainScenic($scenicid='')
    {
        // ScenicDao
        $res=(new ScenicDao())->obtainScenic($scenicid);
        if($res['msg']=='error') return returnData('error','查询失败');
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenicstatus['scenic_status']  => '景区申请状态';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function modifyScenic($schoolid,$scenicstatus)
    {
        // ScenicDao
        $res=(new ScenicDao())->modifyScenic($schoolid,$scenicstatus);
        if($res['msg']=='error') return returnData('error','修改失败');
        // 返回数据
        return returnData('success',$res['data']);
    }
}