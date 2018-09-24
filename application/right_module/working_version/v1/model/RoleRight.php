<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleRight.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  职位权限关联模型层
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\model;
use think\Model;

class RoleRight extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = '';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.Index_Role_Rights');
    }
}
