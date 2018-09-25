<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicspotDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 12:16
 *  文件描述 :  景区轮播图管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\scenicspot_module\working_version\v1\dao;
use app\scenicspot_module\working_version\v1\model\ScenicspotModel;

class ScenicspotDao implements ScenicspotInterface
{
    /**
     * 名  称 : scenicspotCreate()
     * 功  能 : 添加轮播图接口数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$post['imageFile']  => '图片资源';'
     * 输  入 : '$post['scenicId']   => '景区ID';'
     * 输  入 : '$post['imageSort']  => '景区排序';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 13:43
     */
    public function scenicspotCreate($post)
    {
        // TODO :  验证数据,如果排序为1删除员轮播图图片
        if($post['imageSort'] == 1)
        {
            $sowingList = ScenicspotModel::where(
                'scenic_id',$post['scenicId']
            )->select()->toArray();
            $string = '';
            foreach ($sowingList as $k=>$v)
            {
                if(file_exists('.'.$v['sowing_url']))
                {
                    unlink('.'.$v['sowing_url']);
                }
                $string .= $v['sowing_index'].',';
            }
            ScenicspotModel::where(
                'scenic_id',$post['scenicId']
            )->delete();
        }
        // TODO :  示例话 SowingModel 模型
        $sowingModel = new ScenicspotModel();
        // TODO :  处理数据
        $sowingModel->scenic_id   = $post['scenicId'];
        $sowingModel->images_url  = $post['imageFile'];
        $sowingModel->images_sort = $post['imageSort'];
        // TODO :  保存数据
        $save = $sowingModel->save();
        // TODO :  返回执行结果
        return \RSD::wxReponse($save,'M','上传成功','上传失败');

    }
}