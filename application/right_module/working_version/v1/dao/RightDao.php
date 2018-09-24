<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 10:11
 *  文件描述 :  权限管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\UserModel;
use app\right_module\working_version\v1\model\AdminModel;
use app\right_module\working_version\v1\model\RightModel;

class RightDao implements RightInterface
{
    /**
     * 名  称 : rightSelect()
     * 功  能 : 获取所有权限信息数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token'] => '管理员UserToken标识';
     * 输  入 : $get['admin_class'] => '管理员分组,1/2/3,分级获取';
     * 输  入 : $get['role_class']  => '角色分组,1/2/3,分级获取';
     * 输  入 : $get['right_class'] => '权限分组,1/2/3,分级获取';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/19 11:30
     */
    public function rightSelect($get)
    {
        // TODO :  判断是否是最高管理员，获取最高管理员权限
        if(($get['right_class']=='0')&&($this->userIsAdmin($get))){
            $res = $this->rightListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'当前还没有添加权限,请联系开发者添加权限'
            );
        }
        // TODO :  判断是不是当前组最高管理员，获取最高管理员权限
        if(($get['right_class']!=='0')&&($this->userIsClassAdmin($get))){
            $res = $this->rightListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'当前还没有添加权限,请联系开发者添加权限'
            );
        }
        // TODO :  查看用户是不是管理员，有没有权限
        if($this->userIsAdminList($get)){
            $res = $this->rightAdminListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'您没有权限'
            );
        }
        // TODO :  返回数据
        return \RSD::wxReponse(false,'M',false,'您不是管理员');
    }

    /**
     * 判断用户是不是小程序最高管理员
     */
    private function userIsAdmin($get)
    {
        // TODO :  UserModel 模型
        $token = UserModel::get(1)['user_token'];
        // TODO :  判断用户是否是最高管理员
        if(($token == $get['admin_token'])
            &&($get['admin_class']=='0')
            &&($get['admin_class']==$get['role_class'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断用户是不是小程序其他分组最高管理员
     */
    private function userIsClassAdmin($get)
    {
        // TODO :  AdminModel 模型
        $type = AdminModel::where(
            'admin_token',$get['admin_token']
        )->where(
            'admin_class',$get['admin_class']
        )->where(
            'admin_type',1
        )->where(
            'admin_status',1
        )->find();
        // TODO :  判断用户是否是最高管理员
        if(($type)&&($get['right_class']==$type['right_class'])
            &&($get['admin_class']==$get['role_class'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断用户是不是管理员
     */
    private function userIsAdminList($get)
    {
        // TODO :  AdminModel 模型
        $type = AdminModel::where(
            'admin_token',$get['admin_token']
        )->where(
            'admin_class',$get['admin_class']
        )->where(
            'admin_status',1
        )->find();
        // TODO :  判断用户是不是管理员
        if($type){
            if($get['right_class']==$type['right_class']){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 获取小程序最高管理员权限
     */
    private function rightListGet($get)
    {
        // TODO :  RightModel 模型，返回权限数据列表
        return RightModel::where(
            'right_class',
            $get['right_class']
        )->select()->toArray();
    }

    /**
     * 获取管理员权限
     */
    private function rightAdminListGet($get)
    {
        // TODO :  AdminModel 模型，返回权限数据列表
        return AdminModel::Distinct(true)->field(
            config('v1_tableName.Data_Right_Lists').'.*'
        )->leftJoin(
            config('v1_tableName.Index_Admin_Roles'),
            config('v1_tableName.Data_User_Admins').'.admin_id = '.
            config('v1_tableName.Index_Admin_Roles').'.admin_id'
        )->leftJoin(
            config('v1_tableName.Data_Role_Lists'),
            config('v1_tableName.Index_Admin_Roles').'.role_id = '.
            config('v1_tableName.Data_Role_Lists').'.role_id'
        )->leftJoin(
            config('v1_tableName.Index_Role_Rights'),
            config('v1_tableName.Data_Role_Lists').'.role_id = '.
            config('v1_tableName.Index_Role_Rights').'.role_id'
        )->leftJoin(
            config('v1_tableName.Data_Right_Lists'),
            config('v1_tableName.Index_Role_Rights').'.right_id = '.
            config('v1_tableName.Data_Right_Lists').'.right_id'
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_token',
            $get['admin_token']
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_class',
            $get['admin_class']
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_status',
            1
        )->where(
            config('v1_tableName.Data_Right_Lists').'.right_class',
            $get['right_class']
        )->where(
            config('v1_tableName.Data_Role_Lists').'.role_class',
            $get['role_class']
        )->where(
            config('v1_tableName.Data_User_Admins').'.admin_status',
            1
        )->select()->toArray();
    }
}
