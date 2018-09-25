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

class ScenicDao
{

    /**
     * 名  称 : scenicCreate()
     * 功  能 : 景区申请数据处理
     * 变  量 : --------------------------------------
     * 输  入 : '$scenicid['scenic_id']  => '景区主键';'
     * 输  入 : '$usertoken['user_token']  => '用户token';'
     * 输  入 : '$scenicname['scenic_name']  => '景区名称';'
     * 输  入 : '$scenicimg['scenic_img']  => '景区图片';'
     * 输  入 : '$scenicaddress['scenic_address']  => '景区地址';'
     * 输  入 : '$scenicman['scenic_man']  => '景区负责人';'
     * 输  入 : '$scenicphone['scenic_phone']  => '联系电话';'
     * 输  入 : '$sceniclicense['scenic_license']  => '执照照片路径';'
     * 输  入 : '$scenicx['scenic_x']  => '景区x坐标';'
     * 输  入 : '$scenicy['scenic_y']  => '景区y坐标';'
     * 输  入 : '$scenictype['scenic_type']  => '景区类型';'
     * 输  入 : '$scenicticket['scenic_ticket']  => '景区门票';'
     * 输  入 : '$scenicstatus['scenic_status']  => '申请状态';'
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/24 19:11
     */
    public function scenicAdd($scenicid,$usertoken,$scenicname,$scenicimg,$scenicaddress,
                              $scenicman,$scenicphone,$sceniclicense,$scenicx,$scenicy,
                              $scenictype,$scenicticket,$scenicstatus)
    {
        // TODO :  ScenicModel 模型
        // 实例化model
        $ScenicModel = new ScenicModel();
        // 景区主键
        $ScenicModel->scenic_id	 = $scenicid;
        // 用户token
        $ScenicModel->user_token	 = $usertoken;
        // 景区名称
        $ScenicModel->scenic_name	 = $scenicname;
        // 景区图片
        $ScenicModel->scenic_img	 = $scenicimg;
        // 景区地址
        $ScenicModel->scenic_address	 = $scenicaddress;
        // 景区负责人
        $ScenicModel->scenic_man	 = $scenicman;
        // 联系电话
        $ScenicModel->scenic_phone	 = $scenicphone;
        // 执照照片路径
        $ScenicModel->scenic_license	 = $sceniclicense;
        // 景区x坐标
        $ScenicModel->scenic_x	 = $scenicx;
        // 景区y坐标
        $ScenicModel->scenic_y	 = $scenicy;
        // 景区类型
        $ScenicModel->scenic_type	 = $scenictype;
        // 景区门票
        $ScenicModel->scenic_ticket	 = $scenicticket;
        // 申请状态
        $ScenicModel->scenic_status	 = $scenicstatus;
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
}