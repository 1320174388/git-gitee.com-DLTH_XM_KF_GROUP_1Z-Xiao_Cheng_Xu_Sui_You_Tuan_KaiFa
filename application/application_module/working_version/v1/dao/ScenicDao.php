<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicDao.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请数据层
 *  历史记录 :  -----------------------
 */
namespace app\application_module\working_version\v1\dao;
use app\application_module\working_version\v1\model\ScenicModel;
use app\application_module\working_version\v1\model\UserModel;

class ScenicDao
{

    /**
     * 名  称 : scenicCreate()
     * 功  能 : 景区申请数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$usertoken['user_token']  => '用户token';'
     * 输  入 : '$scenicname['scenic_name']  => '景区名称';'
     * 输  入 : '$scenicimg['scenic_img']  => '景区图片';'
     * 输  入 : '$scenicaddress['scenic_address']  => '景区地址';'
     * 输  入 : '$scenicman['scenic_man']  => '景区负责人';'
     * 输  入 : '$scenicphone['scenic_phone']  => '联系电话';'
     * 输  入 : '$scenicx['scenic_x']  => '景区x坐标';'
     * 输  入 : '$scenicy['scenic_y']  => '景区y坐标';'
     * 输  入 : '$scenictype['scenic_type']  => '景区类型';'
     * 输  入 : '$scenicticket['scenic_ticket']  => '景区门票';'
     * 输  入 : '$scenicstatus['scenic_status']  => '申请状态';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicAdd($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();
        // 用户token
        $ScenicModel->user_token	 = $post['user_token'];
        // 景区名称
        $ScenicModel->scenic_name	 = $post['scenic_name'];
        // 景区图片
        $ScenicModel->scenic_img	 = $post['scenic_img'];
        // 景区地址
        $ScenicModel->scenic_address	 = $post['scenic_address'];
        // 景区负责人
        $ScenicModel->scenic_man	 = $post['scenic_man'];
        // 联系电话
        $ScenicModel->scenic_phone	 = $post['scenic_phone'];
        // 执照照片路径
        $ScenicModel->scenic_license	 = $post['scenic_license'];
        // 景区x坐标
        $ScenicModel->scenic_x	 = $post['scenic_x'];
        // 景区y坐标
        $ScenicModel->scenic_y	 = $post['scenic_y'];
        // 景区类型
        $ScenicModel->scenic_type	 = $post['scenic_type'];
        // 景区门票
        $ScenicModel->scenic_ticket	 = $post['scenic_ticket'];
        // 申请状态
        $ScenicModel->scenic_status	 = $post['scenic_status'];
        // 时间
        $ScenicModel->scenic_time	 = time();
        // 保存数据库
        $data = $ScenicModel->save();
        // 验证
        if(!$data){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$data);
    }


    /**
     * 名  称 : scenicPost()
     * 功  能 : 景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区ID';
     * 输  入 : '$post['scenic_license']  => '执照照片路径';
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function imgPost($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();
        // 景区ID
        $ScenicModel->scenic_id	 = $post['scenic_id'];
        // 用户token
        $ScenicModel->scenic_license	 = $post['scenic_license'];
        // 保存数据库
        $data = $ScenicModel->save();
        // 验证
        if(!$data){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$data);
    }



    /**
     * 名  称 : obtainScenic()
     * 功  能 : 获取景区列表接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区主键';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainScenic($scenicid='')
    {
        $ScenicModel= new ScenicModel();
        if($scenicid == ''){
            $list = $ScenicModel->select();
        }else{
            $list = $ScenicModel->where('scenic_id',$scenicid)->find();
        }
        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区申请接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenicstatus['scenic_status']  => '景区申请状态';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function modifyScenic($schoolid,$scenicstatus)
    {
        $ScenicModel= new ScenicModel();
        // 进行修改
        $res = $ScenicModel->save([
            $ScenicModel->scenic_status    = $scenicstatus
        ],['scenic_id'=>$schoolid]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }



    /**
     * 名  称 : obtainApplication()
     * 功  能 : 获取景区申请列表
     * 变  量 : --------------------------------------
     * 输  入 : '$post['scenic_id']  => '景区ID';'
     * 输  入 : '$post['scenic_type']  => '景区类型';'
     * 输  入 : '$post['scenic_status']  => '景区审核状态';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function obtainApplication($post)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();

        $list = $ScenicModel->where('scenic_type',$post['scenic_type'])
            ->where('scenic_status',$post['scenic_status'])
            ->select()->toArray();

        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }


    /**
     * 名  称 : modifyScenic()
     * 功  能 : 修改景区类型接口
     * 变  量 : --------------------------------------
     * 输  入 : '$schoolid['scenic_id']  => '景区主键';
     * 输  入 : '$scenictype['scenic_type']  => '景区类型';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicVip($schoolid,$scenictype)
    {
        $ScenicModel= new ScenicModel();
        // 进行修改
        $res = $ScenicModel->save([
            $ScenicModel->scenic_type    = $scenictype
        ],['scenic_id'=>$schoolid]);
        // 验证
        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }


    /**
     * 名  称 : singleScenic()
     * 功  能 : 搜索单个景区接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_identity']  => '用户身份证';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function singleScenic($useridentity)
    {
        $UserModel = new UserModel();

        $list = $UserModel->field('user_token')->where('user_identity',$useridentity)
            ->find()->toArray();

        $res = ScenicModel::where('user_token',$list)->find()->toArray();

        if(!$res){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$res);
    }

    /**
     * 名  称 : singleUser()
     * 功  能 : 搜索用户接口
     * 变  量 : --------------------------------------
     * 输  入 : '$post['user_identity']  => '用户身份证';'
     * 输  出 : {"errNum":0,"retMsg":"提示信息","retData":true}
     * 创  建 : 2018/09/24 19:11
     */
    public function singleUser($useridentity)
    {
        $UserModel = new UserModel();

        $list = $UserModel->where('user_identity',$useridentity)->find()->toArray();

        if(!$list){
            return returnData('error',false);
        }
        // 返回数据
        return returnData('success',$list);
    }
}