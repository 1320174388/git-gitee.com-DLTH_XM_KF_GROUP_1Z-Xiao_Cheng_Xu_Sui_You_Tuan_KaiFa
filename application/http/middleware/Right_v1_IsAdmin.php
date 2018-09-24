<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Right_v1_IsAdmin.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/09/19 17:39
 *  文件描述 :  权限管理模块中间件
 *  历史记录 :  -----------------------
 */
namespace app\http\middleware;
use app\right_module\working_version\v1\library\RightLibrary;

class Right_v1_IsAdmin
{
    public function handle(\think\Request $request, \Closure $next,$array = [])
    {
        // 获取传值数据
        if(empty($request->param('admin_token_auth'))){
            return redirect('/v1/right_module/return_json');
        }
        $array['admin_token'] = $request->param('admin_token_auth');
        $array['admin_class'] = $request->param('group_class_auth','0');
        $array['role_class']  = $request->param('group_class_auth','0');
        $array['right_class'] = $request->param('right_class_auth','0');
        // 实例化权限获取函数类
        $rightLibrary = new RightLibrary();
        // 获取权限数据
        $res = $rightLibrary->rightLibGet($array);
        // 判断用户权限信息
        if($res['msg']=='error'){
            return redirect('/v1/right_module/return_right');
        }
        // 遍历权限数据
        $typs = false;
        foreach($res['data'] as $v){
            if($v['right_route']==request()->baseUrl()){
                $typs = true;
            }
        }
        // 获取用户访问路由
        if($typs){
            return $next($request);
        }else{
            return redirect('/v1/right_module/return_right');

        }
    }
}
