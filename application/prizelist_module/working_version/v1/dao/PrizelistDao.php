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
        )->find();
        // 验证是否已有此奖品信息，如果存在拒绝添加
        if($prize){
            return returnData('error','此奖品已添加过');
        }
        // TODO :  实例化 PrizelistModel 模型
        $prizeModel = new PrizelistModel();
        // 处理数据
        $prizeModel->scenic_id  = $post['scenicId'];
        $prizeModel->prize_img  = $post['przeFile'];
        $prizeModel->prize_name = $post['przeName'];
        $prizeModel->prize_cost = $post['przePrice'];
        $prizeModel->prize_time = time();
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
        )->select()->toArray();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M',$res,'当前还没有添加奖品');
    }
}