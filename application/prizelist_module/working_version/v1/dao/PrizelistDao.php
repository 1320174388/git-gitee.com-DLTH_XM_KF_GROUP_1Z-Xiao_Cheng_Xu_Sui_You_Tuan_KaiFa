<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PrizelistDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/25 15:02
 *  文件描述 :  景区奖品管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\prizelist_module\working_version\v1\dao;
use app\prizelist_module\working_version\v1\model\PrizelistModel;

class PrizelistDao implements PrizelistInterface
{
    /**
     * 名  称 : prizelistCreate()
     * 功  能 : 添加奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['scenicId']  => '景区主键';
     * 输  入 : $post['przeName']  => '奖品名称';
     * 输  入 : $post['przeFile']  => '奖品图片';
     * 输  入 : $post['przePrice'] => '奖品价值';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 15:03
     */
    public function prizelistCreate($post)
    {
        // TODO :  PrizelistModel 模型
        $prize = PrizelistModel::where(
            'prize_name',$post['przeName']
        )->where(
            'scenic_id',$post['scenicId']
        )->where(
            'prize_status',1
        )->find();
        // 验证是否已有此奖品信息，如果存在拒绝添加
        if($prize){
            return returnData('error','此奖品已添加过');
        }
        // TODO :  实例化 PrizelistModel 模型
        $prizeModel = new PrizelistModel();
        // 处理数据
        $prizeModel->scenic_id    = $post['scenicId'];
        $prizeModel->prize_img    = $post['przeFile'];
        $prizeModel->prize_name   = $post['przeName'];
        $prizeModel->prize_cost   = $post['przePrice'];
        $prizeModel->prize_status = 1;
        $prizeModel->prize_time   = time();
        // TODO :  写入数据
        $res = $prizeModel->save();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M','奖品添加成功','奖品添加失败');
    }

    /**
     * 名  称 : prizelistSelect()
     * 功  能 : 获取奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['scenicId']  => '景区主键';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/25 15:34
     */
    public function prizelistSelect($get)
    {
        // TODO :  PrizelistModel 模型
        $res = PrizelistModel::where(
            'scenic_id',$get['scenicId']
        )->where(
            'prize_status',1
        )->select()->toArray();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M',$res,'当前还没有添加奖品');
    }

    /**
     * 名  称 : prizelistUpdate()
     * 功  能 : 修改奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['prizeId']   => '奖品主键';
     * 输  入 : $put['scenicId']  => '景区主键';
     * 输  入 : $put['przeName']  => '奖品名称';
     * 输  入 : $put['przeFile']  => '奖品图片';
     * 输  入 : $put['przePrice'] => '奖品价值';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 16:15
     */
    public function prizelistUpdate($put)
    {
        // TODO :  实例化 PrizelistModel 模型
        $prizeModel = PrizelistModel::get($put['prizeId']);
        // 验证是否已有此奖品信息，如果存在拒绝添加
        if(!$prizeModel){
            return returnData('error','此奖品不存在');
        }
        // 处理数据
        $prizeModel->scenic_id  = $put['scenicId'];
        if($put['przeFile']!='no'){
            if(file_exists('.'.$prizeModel['prize_img']))
            {
                unlink('.'.$prizeModel['prize_img']);
            }
            $prizeModel->prize_img  = $put['przeFile'];
        }
        $prizeModel->prize_name = $put['przeName'];
        $prizeModel->prize_cost = $put['przePrice'];
        $prizeModel->prize_time = time();
        // TODO :  写入数据
        $res = $prizeModel->save();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M','奖品修改成功','奖品修改失败');
    }

    /**
     * 名  称 : prizelistDelete()
     * 功  能 : 删除奖品信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['prizeId']   => '奖品主键';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/25 20:46
     */
    public function prizelistDelete($delete)
    {
        // TODO :  PrizelistModel 模型
        $data = PrizelistModel::where(
            'prize_id',$delete['prizeId']
        )->where(
            'prize_status',1
        )->find();
        // TODO :  判断是否有数据
        if(!$data){
            return returnData('error','奖品已被删除');
        }
        // TODO :  软删除数据
        $data->prize_status = 0;
        $res = $data->save();
        // 返回数据
        return \RSD::wxReponse($res,'M','奖品删除成功','奖品删除失败');
    }
}