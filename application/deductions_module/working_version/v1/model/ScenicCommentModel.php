<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicCommentModel.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/06 17:04
 *  文件描述 :  景区评论模型层
 *  历史记录 :  -----------------------
 */
namespace app\deductions_module\working_version\v1\model;
use think\Model;

class ScenicCommentModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'comment_id';

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('tableName.scenicComment');
    }
}