<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  WxloginaddDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户数据层
 *  历史记录 :  -----------------------
 */
namespace app\wxloginadd_module\working_version\v1\dao;
use app\wxloginadd_module\working_version\v1\model\WxloginaddModel;
use app\wxloginadd_module\working_version\v1\model\WxusermemnerModel;

class WxloginaddDao implements WxloginaddInterface
{
    /**
     * 名  称 : wxloginaddCreate()
     * 功  能 : 授权登录数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['userToken']  => '用户token';
     * 输  入 : $post['avatarUrl']  => '用户头像';
     * 输  入 : $post['nickName']   => '用户昵称';
     * 输  入 : $post['gender']     => '用户昵称';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/10 22:36
     */
    public function wxloginaddCreate($post)
    {
        // 启动事务
        \think\Db::startTrans();
        try {
            $wxloginisData = WxloginaddModel::where(
                'user_token',$post['userToken']
            )->find();
            if(!$wxloginisData){
                // TODO :  WxloginaddModel 模型
                $wxlogin = new WxloginaddModel();
                // 处理数据
                $wxlogin->user_token     = $post['userToken'];
                $wxlogin->user_avatarUrl = $post['avatarUrl'];
                $wxlogin->user_nickName  = $post['nickName'];
                $wxlogin->user_gender    = $post['gender'];
                // 保存数据
                $wxlogin->save();
            }else{
                // 处理数据
                $wxloginisData->user_avatarUrl = $post['avatarUrl'];
                $wxloginisData->user_nickName  = $post['nickName'];
                $wxloginisData->user_gender    = $post['gender'];
                // 保存数据
                $wxloginisData->save();
            }
            $wxusermemnerisData = WxusermemnerModel::where(
                'user_token',$post['userToken']
            )->find();
            if(!$wxusermemnerisData){
                // TODO :  WxusermemnerModel 模型
                $wxusermemner = new WxusermemnerModel();
                $wxusermemner->user_token      = $post['userToken'];
                $wxusermemner->member_id       = 1;
                $wxusermemner->int_transaction = 0;
                // 保存数据
                $wxusermemner->save();
            }
            // 提交事务
            \think\Db::commit();
            return returnData('success','授权成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','授权失败');
        }
    }
}