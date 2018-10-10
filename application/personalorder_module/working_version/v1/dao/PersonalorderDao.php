<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PersonalorderDao.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/10 19:29
 *  文件描述 :  个人订单数据层
 *  历史记录 :  -----------------------
 */
namespace app\personalorder_module\working_version\v1\dao;
use app\personalorder_module\working_version\v1\model\PersonalorderModel;

class PersonalorderDao implements PersonalorderInterface
{
    /**
     * 名  称 : personalorder()
     * 功  能 : 根据用户token状态，查询出有无用户
     * 变  量 : --------------------------------------
     * 变  量 : --------------------------------------
     * 输  入 : user_token => user_token;
     * 输  出 : [ 'msg' => 'success', 'data' => $userInfo ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/10/10 19:29
     */
    public function personalorder($post)
    {
        //执行查询
        $res = PersonalorderModel::field(
            config('personalorder_v1_tableName.Perorder').'.*,'.
            config('personalorder_v1_tableName.GroupInfo').'.group_money,'.
            config('personalorder_v1_tableName.GroupInfo').'.group_type,'.
            config('personalorder_v1_tableName.DataScenic').'.scenic_name'
        )->leftJoin(
            config('personalorder_v1_tableName.GroupInfo'),
            config('personalorder_v1_tableName.Perorder').'.group_number = '.
            config('personalorder_v1_tableName.GroupInfo').'.group_number'
        )->leftJoin(
            config('personalorder_v1_tableName.DataScenic'),
            config('personalorder_v1_tableName.GroupInfo').'.scenic_id = '.
            config('personalorder_v1_tableName.DataScenic').'.scenic_id'
        )->where(
            config('personalorder_v1_tableName.Perorder').'.user_token',
            $post['user_token']
        )->select()->toArray();
        //返回结果
        return \RSD::wxReponse($res,'M',$res,'没有订单');
    }
}