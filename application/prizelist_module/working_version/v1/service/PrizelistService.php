<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\service;
use app\prizelist_module\working_version\v1\dao\PrizelistDao;
use app\prizelist_module\working_version\v1\library\PrizelistLibrary;
use app\prizelist_module\working_version\v1\validator\PrizelistValidatePost;
use app\prizelist_module\working_version\v1\validator\PrizelistValidateGet;
use app\prizelist_module\working_version\v1\validator\PrizelistValidatePut;
use app\prizelist_module\working_version\v1\validator\PrizelistValidateDelete;

class PrizelistService
{
    /**
     * 名  称 : prizelistAdd()
     * 功  能 : 添加奖品信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenicId']  => '景区主键';
     * 输  入 : $post['przeName']  => '奖品名称';
     * 输  入 : $post['przeFile']  => '奖品图片';
     * 输  入 : $post['przePrice'] => '奖品价值';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 15:03
     */
    public function prizelistAdd($post)
    {
        // 实例化验证器代码
        $validate  = new PrizelistValidatePost();
        
        // 验证数据
        if (!$validate->scene('edit')->check($post)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'przeFile',
            './uploads/prizelist/',
            '/uploads/prizelist/'
        );
        if($imageUploads['msg']=='error'){
            return returnData('error','请发送文件数据');
        }
        $post['przeFile'] = $imageUploads['data'];
        
        // 实例化Dao层数据类
        $prizelistDao = new PrizelistDao();
        
        // 执行Dao层逻辑
        $res = $prizelistDao->prizelistCreate($post);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : prizelistShow()
     * 功  能 : 获取奖品信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']  => '景区主键';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/25 15:34
     */
    public function prizelistShow($get)
    {
        // 实例化验证器代码
        $validate  = new PrizelistValidateGet();
        
        // 验证数据
        if (!$validate->scene('edit')->check($get)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $prizelistDao = new PrizelistDao();
        
        // 执行Dao层逻辑
        $res = $prizelistDao->prizelistSelect($get);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : prizelistEdit()
     * 功  能 : 修改奖品信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $put['prizeId']   => '奖品主键';
     * 输  入 : $put['scenicId']  => '景区主键';
     * 输  入 : $put['przeName']  => '奖品名称';
     * 输  入 : $put['przeFile']  => '奖品图片';
     * 输  入 : $put['przePrice'] => '奖品价值';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 16:15
     */
    public function prizelistEdit($put)
    {
        // 实例化验证器代码
        $validate  = new PrizelistValidatePut();
        
        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 判断文件资源是否上传
        $imageUploads = imageUploads(
            'przeFile',
            './uploads/prizelist/',
            '/uploads/prizelist/'
        );
        if($imageUploads['msg']=='success'){
            $put['przeFile'] = $imageUploads['data'];
        }else{
            $put['przeFile'] = 'no';
        }

        // 实例化Dao层数据类
        $prizelistDao = new PrizelistDao();
        
        // 执行Dao层逻辑
        $res = $prizelistDao->prizelistUpdate($put);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }

    /**
     * 名  称 : prizelistDel()
     * 功  能 : 删除奖品信息逻辑
     * 变  量 : --------------------------------------
     * 输  入 : $delete['prizeId']   => '奖品主键';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 20:46
     */
    public function prizelistDel($delete)
    {
        // 实例化验证器代码
        $validate  = new PrizelistValidateDelete();
        
        // 验证数据
        if (!$validate->scene('edit')->check($delete)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }
        
        // 实例化Dao层数据类
        $prizelistDao = new PrizelistDao();
        
        // 执行Dao层逻辑
        $res = $prizelistDao->prizelistDelete($delete);
        
        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}