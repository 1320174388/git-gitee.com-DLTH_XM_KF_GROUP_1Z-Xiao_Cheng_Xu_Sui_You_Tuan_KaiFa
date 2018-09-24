<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdministratorDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/22 19:26
 *  文件描述 :  权限管理~管理员管理数据层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\UserModel;
use app\right_module\working_version\v1\model\AdminModel;
use app\right_module\working_version\v1\model\AdminRole;

class AdministratorDao implements AdministratorInterface
{
    /**
     * 名  称 : administratorSelect()
     * 功  能 : 获取管理员列表数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $get['admin_token']  => '32位AdminToken标识';
     * 输  入 : $get['admin_class']  => '管理员分组标识数字';
     * 输  出 : ['msg'=>'success','data'=>'返回数据']
     * 创  建 : 2018/09/22 19:31
     */
    public function administratorSelect($get)
    {
        // TODO :  判断是否是最高管理员，获取管理员列表信息
        if(($get['admin_class']=='0')&&($this->userIsAdmin($get))){
            $res = $this->adminListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'当前还没有添加管理员'
            );
        }
        // TODO :  判断是不是当前组最高管理员，获取管理员列表信息
        if(($get['admin_class']!=='0')&&($this->userIsClassAdmin($get))){
            $res = $this->adminListGet($get);
            return \RSD::wxReponse(
                $res,'M',$res,'当前还没有添加职位,请添加职位'
            );
        }
        // TODO :  获取管理员列表信息
        $res = $this->adminsListGet($get);
        return \RSD::wxReponse(
            $res,'M',$res,'没有下级管理员'
        );
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
            &&($get['admin_class']=='0')){
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
        if($type){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取最高管理组管理员列表
     */
    private function adminListGet($get)
    {
        // TODO :  AdminModel 模型，返回权限数据列表
        return AdminModel::where(
            'admin_class',
            $get['admin_class']
        )->where(
            'admin_type',
            2
        )->select()->toArray();
    }

    /**
     * 获取管理员列表数据类
     */
    private function adminsListGet($get)
    {
        // TODO :  AdminModel 模型，获取管理员细腻
        $admin = AdminModel::where(
            'admin_token',$get['admin_token']
        )->where(
            'admin_class',$get['admin_class']
        )->find()['admin_right'];
        // TODO :  AdminModel 模型，返回权限数据列表
        $resArr = AdminModel::where(
            'admin_class',
            $get['admin_class']
        )->where(
            'admin_type',
            2
        )->select()->toArray();

        // 处理数据
        $resNewArr = [];
        $resArrNum = count(json_decode($admin,true));
        foreach($resArr as $v){
            $types  = true;
            $arrNum = 0;
            foreach(json_decode($v['admin_right'],true) as $j){
                if(!in_array($j,json_decode($admin,true))){
                    $types = false;
                }
                $arrNum++;
            }
            if(($types)&&($arrNum<$resArrNum)){
                $resNewArr[] = $v;
            }
        }

        // 返回数据
        return $resNewArr;
    }

    /**
     * 名  称 : administratorUpdate()
     * 功  能 : 修改管理员权限数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $put['admin_id']  => '管理ID';
     * 输  入 : $put['role_str']  => '请正确输入1~2000字职位字符串';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 21:17
     */
    public function administratorUpdate($put)
    {
        // 启动事务
        \think\Db::startTrans();
        try {
            // TODO :  AdminModel 模型
            $admin = AdminModel::get($put['admin_id']);
            // TODO :  判断用户是否存在
            if(!$admin){
                return returnData('error','管理员用户不存在');
            }

            // TODO :  处理数据
            $roleArr = explode(',',$put['role_str']);

            // TODO :  处理数据
            $admin->admin_right  = json_encode($roleArr,320);
            // TODO :  修改数据
            $admin->save();

            AdminRole::where('admin_id',$put['admin_id'])->delete();

            // 处理数据
            $roleArray = [];
            foreach($roleArr as $k => $v){
                if(is_numeric($v)){
                    $roleArray[] = [
                        'admin_id'  => $put['admin_id'], 'role_id' => $v
                    ];
                }
            }
            // 写入职位
            $adminRole = new AdminRole();
            $adminRole->saveAll($roleArray);

            // 提交事务
            \think\Db::commit();
            return returnData('success','修改成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','修改失败');
        }
    }

    /**
     * 名  称 : administratorDelete()
     * 功  能 : 删除管理员数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $delete['admin_id']  => '管理ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 21:45
     */
    public function administratorDelete($delete)
    {
        // 启动事务
        \think\Db::startTrans();
        try {
            // TODO :  AdminModel 模型
            $admin = AdminModel::get($delete['admin_id']);
            // TODO :  判断用户是否存在
            if(!$admin){
                return returnData('error','管理员用户不存在');
            }

            $admin->delete();

            AdminRole::where('admin_id',$delete['admin_id'])->delete();

            // 提交事务
            \think\Db::commit();
            return returnData('success','删除成功');
        } catch (\Exception $e) {
            // 回滚事务
            \think\Db::rollback();
            return returnData('error','删除失败');
        }
    }

    /**
     * 名  称 : administratorCreate()
     * 功  能 : 注册分组管理员函数数据处理
     * 变  量 : --------------------------------------
     * 输  入 : $post['admin_token'] => '管理员标识';
     * 输  入 : $post['admin_name']  => '管理员姓名';
     * 输  入 : $post['admin_phone'] => '联系电话';
     * 输  入 : $post['admin_class'] => '分组注册ID';
     * 输  入 : $post['right_class'] => '所属权限标识';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/22 22:09
     */
    public function administratorCreate($post)
    {
        // TODO :  AdminModel 模型
        $find = AdminModel::where(
            'admin_token',$post['admin_token']
        )->where(
            'admin_class',$post['admin_class']
        )->where(
            'right_class',$post['right_class']
        )->find();
        // TODO :  处理数据
        if($find){
            $find->admin_name  = $post['admin_name'];
            $find->admin_phone = $post['admin_phone'];
            // TODO :  返回数据
            $res = $find->save();
            // TODO :  返回数据
            return \RSD::wxReponse($res,'M','权限组修改成功','权限组修改失败');
        }
        // TODO :  AdminModel 模型
        $admin = AdminModel::where(
            'admin_type',1
        )->where(
            'right_class',$post['right_class']
        )->find();
        // TODO :  处理数据
        if($admin){
            $admin->admin_token = $post['admin_token'];
            $admin->admin_name  = $post['admin_name'];
            $admin->admin_phone = $post['admin_phone'];
            // TODO :  返回数据
            $res = $admin->save();
            // TODO :  返回数据
            return \RSD::wxReponse($res,'M','权限组修改成功','权限组修改失败');
        }
        // TODO :  AdminModel 模型
        $adminModel = new AdminModel();
        // TODO :  处理数据
        $adminModel->admin_token  = $post['admin_token'];
        $adminModel->admin_name   = $post['admin_name'];
        $adminModel->admin_phone  = $post['admin_phone'];
        $adminModel->admin_type   = 1;
        $adminModel->admin_class  = $post['admin_class'];
        $adminModel->admin_status = 1;
        $adminModel->right_class  = $post['right_class'];
        // TODO :  写入数据
        $res = $adminModel->save();
        // TODO :  返回数据
        return \RSD::wxReponse($res,'M','权限组注册成功','权限组注册失败');
    }

}
