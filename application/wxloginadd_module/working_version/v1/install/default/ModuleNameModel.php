<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ModuleNameModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/10/10 22:22
 *  文件描述 :  添加用户模型层
 *  历史记录 :  -----------------------
 */
namespace app\wxloginadd_module\working_version\v1\model;
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
        $this->table = config('wxloginadd_v1_tableName.数据表下标');
    }
}