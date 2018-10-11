<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ModuleNameModel.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 11:06
 *  文件描述 :  通过订单号获取个人信息模型层
 *  历史记录 :  -----------------------
 */
namespace app\ordergrouppurchase_module\working_version\v1\model;
use think\Model;

class ModuleNameModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = '主键';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('ordergrouppurchase_v1_tableName.数据表下标');
    }
}