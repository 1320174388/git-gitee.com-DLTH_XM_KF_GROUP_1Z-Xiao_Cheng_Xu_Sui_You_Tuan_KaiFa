<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  UserInfoDao.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/06 09:54
 *  文件描述 :  用户信息数据层
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\dao;
use app\user_module\working_version\v1\model\UsersListModel;
use app\user_module\working_version\v1\model\UserMemberModel;
use app\user_module\working_version\v1\model\MemberListModel;
use app\user_module\working_version\v1\model\UserExtendModel;
class UserInfoDao
{
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : UserInfoSelect()
     * 功  能 : 获取用户信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function UserInfoSelect($get)
    {
        //联查用户会员表
        $res = UsersListModel::leftjoin(
                config('v1_tableName.userMember'),
                config('v1_tableName.usersList').'.user_token = '.
                config('v1_tableName.userMember').'.user_token'
            )->leftJoin(
                config('v1_tableName.memberList'),
                config('v1_tableName.userMember').'.member_id = '.
                config('v1_tableName.memberList').'.member_id'
        )
            ->where(config('v1_tableName.usersList').'.user_token',$get['user_token'])
            ->find();

        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : vipExplainSelect()
     * 功  能 : 获取会员权益说明
     * 变  量 : --------------------------------------
     * 输  入 : '$get['member_id']  => '会员主键';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function vipExplainSelect($get)
    {
        //创建模型
        $opject = new MemberListModel();
        $res = $opject->where('member_id',$get['member_id'])
                ->field('member_text')
                ->find();
        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : extendSelect()
     * 功  能 : 获取推广人员列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['num']  => '分页数量';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/05 10:23
     */
    public function extendSelect($get)
    {
        $res = UserExtendModel::field(
            config('v1_tableName.usersList').'.user_nickName,
                                    user_name,
                                    user_phone,'.
                 config('v1_tableName.userExtend').'.extend_int,
                                    extend_time'
            )
              ->leftjoin(
                config('v1_tableName.usersList'),
                config('v1_tableName.userExtend').'.extends_id = '.
                config('v1_tableName.usersList').'.user_token'
            )->where(config('v1_tableName.userExtend').'.user_token',
                            $get['user_token'])
             ->limit($get['num'],12)
             ->select()
             ->toArray();
        //查询总记录
        $count = UserExtendModel::where('user_token',$get['user_token'])
                        ->count();
        $data = [
            'count' => $count,
            'list'  => $res
        ];
        //返回结果
        return \RSD::wxReponse($res,'M',$data,'没有搜索到结果');
    }
}