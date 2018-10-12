<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalnotifyDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/12 14:11
 *  文件描述 :  个人购票数据层
 *  历史记录 :  -----------------------
 */
namespace app\personalpurchase_module\working_version\v1\dao;
use app\wx_payment_module\working_version\v1\library\WxPayLibrary;
use app\personalpurchase_module\working_version\v1\model\GroupModel;
use app\personalpurchase_module\working_version\v1\model\MemberModel;

class PersonalnotifyDao implements PersonalnotifyInterface
{
    /**
     * 名  称 : personalnotifyCreate()
     * 功  能 : 个人购票回调数据处理
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/10/12 16:36
     */
    public function personalnotifyCreate($post)
    {
        // TODO : wxPayNotify 回调
        $data = (new WxPayLibrary)->wxPayNotify();
        file_put_contents('./data.txt',json_encode($data,320));
        // TODO : 启动事务
        \think\Db::startTrans();
        try {
            // 实例化订单表模型
            $group = new GroupModel();
            // 处理数据
            $group->group_number = $data['out_trade_no'];
            $group->scenic_id    = $data['attach']['scenic_id'];
            $group->group_num    = 1;
            $group->man_num      = 1;
            $group->group_type   = 1;
            $group->order_depict = '个人购票订单';
            $group->group_status = 1;
            $group->group_time   = time();
            $group->group_money  = $data['cash_fee'];
            // 保存数据
            $group->save();
            // 实例化订单表模型
            $member = new MemberModel();
            // 处理数据
            $member->group_number   = $data['out_trade_no'];
            $member->user_token     = $data['attach']['token'];
            $member->group_invite   = $data['out_trade_no'];
            $member->member_status  = 1;
            $member->comment_status = 0;
            $member->comment_status = 1;
            $member->member_time    = time();
            // 保存数据
            $member->save();
            // 提交事务
            \think\Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
        }
        // 处理函数返回值
        return \RSD::wxReponse(true,'M','','');
    }
}