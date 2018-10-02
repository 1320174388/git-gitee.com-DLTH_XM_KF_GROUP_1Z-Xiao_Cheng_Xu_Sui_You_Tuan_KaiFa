<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  TicketputLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  景区门票团购自定义类
 *  历史记录 :  -----------------------
 */
namespace app\ticketgroup_module\working_version\v1\library;
use app\ticketgroup_module\working_version\v1\dao\TicketputDao;
use app\ticketgroup_module\working_version\v1\validator\TicketputValidatePost;
use app\ticketgroup_module\working_version\v1\validator\TicketputValidateGet;
use app\ticketgroup_module\working_version\v1\validator\TicketputValidatePut;
use app\ticketgroup_module\working_version\v1\validator\TicketputValidateDelete;

class TicketputLibrary
{
    /**
     * 名  称 : ticketputLibPut()
     * 功  能 : 修改门票函数类
     * 变  量 : --------------------------------------
     * 输  入 : $put['scenic_id']    => '景区ID';
     * 输  出 : ['msg'=>'success','data'=>'提示信息']
     * 创  建 : 2018/09/28 15:34
     */
    public function ticketputLibPut($put,$status=1)
    {
        // 实例化验证器代码
        $validate  = new TicketputValidatePut();

        // 验证数据
        if (!$validate->scene('edit')->check($put)) {
            return ['msg'=>'error','data'=>$validate->getError()];
        }

        // 验证审核 状态
        if(($status!=1)&&($status!=2)){
            return returnData('error','审核状态输入错误');
        }

        // 实例化Dao层数据类
        $ticketputDao = new TicketputDao();

        // 执行Dao层逻辑
        $res = $ticketputDao->ticketputUpdate($put);

        // 处理函数返回值
        return \RSD::wxReponse($res,'D');
    }
}