<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ScenicCommentModel.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/10/05 09:54
 *  文件描述 :  景区评论表模型层
 *  历史记录 :  -----------------------
 */
namespace app\user_module\working_version\v1\model;
use think\Model;

class ScenicCommentModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'comment_id';

    //设置时间字段名称
    protected $createTime = 'comment_time';

    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 加载配置数据表名
    protected function initialize()
    {
        $this->table = config('v1_tableName.scenicComment');
    }
    //关联用户表
    public function user()
    {
        return $this->hasOne('UsersListModel','user_token');
    }
}