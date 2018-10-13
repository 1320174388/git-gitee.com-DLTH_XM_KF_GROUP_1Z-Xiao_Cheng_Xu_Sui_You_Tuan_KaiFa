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
use app\user_module\working_version\v1\model\AdminBespeakModel;
use app\user_module\working_version\v1\model\GroupMemberModel;
use app\user_module\working_version\v1\model\HomeUsersModel;
use app\user_module\working_version\v1\model\UsersListModel;
use app\user_module\working_version\v1\model\UserMemberModel;
use app\user_module\working_version\v1\model\MemberListModel;
use app\user_module\working_version\v1\model\UserExtendModel;
use app\user_module\working_version\v1\model\GroupInfoModel;
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
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : userGroupListDao()
     * 功  能 : 获取个人团购列表
     * 变  量 : --------------------------------------
     * 输  入 : '$get['user_token']  => '用户token';'
     * 输  入 : '$get['group_status']  => '团购状态';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function userGroupListDao($get)
    {
        //查询条件 用户token、 团购状态 、查团购订单
        $res = GroupMemberModel::leftjoin(
                    config('v1_tableName.groupInfo'),
                    config('v1_tableName.GroupMember').'.group_number = '.
                    config('v1_tableName.groupInfo').'.group_number'
                )
                    ->where([
                        config('v1_tableName.GroupMember').'.user_token' => $get['user_token'],
                        config('v1_tableName.groupInfo').'.group_status' => $get['group_status'],
                    ])
                    ->where('group_type','in','2,3')
                    ->select()
                    ->toArray();
        //返回结果
        return \RSD::wxReponse($res,'M',$res,'没有搜索到结果');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : isUserGroup()
     * 功  能 : 获取预约团购订单信息
     * 变  量 : --------------------------------------
     * 输  入 : '$data['group_invite']  => '邀请码|订单号';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function isUserGroup($data)
    {
        $res = GroupMemberModel::field(
                config('v1_tableName.groupInfo').'.group_type,
                            group_money'
            )
            ->leftjoin(
                config('v1_tableName.groupInfo'),
                config('v1_tableName.GroupMember').'.group_number = '.
                config('v1_tableName.groupInfo').'.group_number'
            )
            ->where(
                config('v1_tableName.GroupMember').'.group_invite',
                $data['group_invite']
            )->find();
        //判断
        if ($res){
            if($res['group_type'] != 2){
                return returnData('error','此订单不是预约团购');
            }
        }
        //返回结果
        return \RSD::wxReponse($res,'M',$res,'查询异常');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : cancelGroupDao()
     * 功  能 : 取消预约团购
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['group_invite']  => '订单号';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function cancelGroupDao($post)
    {
        // 创建模型
        $opject = new GroupMemberModel();
        // 修改加入团购状态
       $res = $opject->save([
                    'member_status' => 0
                ],[
                    'user_token'    => $post['user_token'],
                    'group_invite'  => $post['group_invite']
                ]);
        //返回结果
        return \RSD::wxReponse($res,'M','金额已退回您的零钱，请查收','取消失败');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : cancelGroupScale()
     * 功  能 : 获取取消预约退款比例
     * 变  量 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function cancelGroupScale()
    {
        // 执行查询
        $res = AdminBespeakModel::get(1);
        // 返回结果
        return \RSD::wxReponse($res,'M',$res,'么有数据');
    }
    /**
     * 作  者 : Feng Tianshui
     * 名  称 : sponsorGroupDao()
     * 功  能 : 发起团购接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_token']  => '用户token';'
     * 输  入 : '$post['scenic_id']  => '景区id';'
     * 输  入 : '$post['group_num']  => '团购人数';'
     * 输  入 : '$post['group_type']  => '团购类型';'
     * 输  入 : '$post['group_money']  => '价格';'
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/10/06 10:23
     */
    public function sponsorGroupDao($post)
    {
        // 查询用户id
        $userId = HomeUsersModel::where('user_token',$post['user_token'])
                        ->field('user_id')
                        ->find();
        // 生成订单号
        $orderNum = ''.time().''.randomInt(4).$userId['user_id'];
        switch ($post['group_type']){
            case 1 :
                $depict = '个人订单';
                break;
            case 2 :
                $depict = '普通团购';
                break;
            case 3 :
                $depict = '预约团购';
                break;
        }
        // 开启事务
        \think\Db::startTrans();
        // 创建模型
        $opject = new GroupInfoModel();

        $opject->group_number = $orderNum;
        $opject->scenic_id    = $post['scenic_id'];
        $opject->group_num    = $post['group_num'];
        $opject->group_type   = $post['group_type'];
        $opject->group_money  = $post['group_money'];
        // 完成状态
        $opject->group_status  = 0;
        // 已有人数
        $opject->man_num  = 1;
        // 订单说明
        $opject->order_depict  = $depict;

        $GroupInfo = $opject->save();

        // 创建团购成员模型
        $member = new GroupMemberModel();
        $member->group_number = $orderNum;
        $member->user_token = $post['user_token'];
        $member->group_invite = $orderNum;
        $member->member_status = 1;
        $member->comment_status = 0;
        $member->group_status = 0;
        $res = $member->save();
        if ($GroupInfo && $res){
            // 提交事务
            \think\Db::commit();
            return \RSD::wxReponse($res,'M','发起成功','发起失败');
        }else{
            // 事务回滚
            \think\Db::rollback();
            return returnData('error','发起失败');
        }

    }

}