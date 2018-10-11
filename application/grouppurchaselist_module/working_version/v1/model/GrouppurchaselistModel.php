<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  GrouppurchaselistModel.php
 *  创 建 者 :  Jing Zhi Qiang
 *  创建日期 :  2018/10/11 19:23
 *  文件描述 :  查询未完成团购内容模型层
 *  历史记录 :  -----------------------
 */
namespace app\grouppurchaselist_module\working_version\v1\model;
use think\Model;

class GrouppurchaselistModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = '';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('grouppurchaselist_v1_tableName.Scen');
    }
}