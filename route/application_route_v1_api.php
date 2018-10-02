<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  application_route_v1_api.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/09/24 18:59
 *  文件描述 :  景区申请路由文件
 *  历史记录 :  -----------------------
 */


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：执行申请景区路由地址
 */
Route::post(
    'v1/application_module/scenicPost',
    'application_module/v1.controller.ScenicController/scenicPost'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：执行申请景区上传营业执照路由地址
 */
Route::post(
    'v1/application_module/imgPost',
    'application_module/v1.controller.ScenicController/imgPost'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区列表
 */
Route::post(
    'v1/application_module/obtainScenic',
    'application_module/v1.controller.ScenicController/obtainScenic'
)->middleware('Right_v1_IsAdmin');


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区申请
 */
Route::post(
    'v1/application_module/modifyScenic',
    'application_module/v1.controller.ScenicController/modifyScenic'
)->middleware('Right_v1_IsAdmin');


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：默认获取景区申请列表
 */
Route::post(
    'v1/application_module/obtainApplication',
    'application_module/v1.controller.ScenicController/obtainApplication'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区申请列表
 */
Route::post(
    'v1/application_module/scenicApplication',
    'application_module/v1.controller.ScenicController/scenicApplication'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区vip或普通
 */
Route::post(
    'v1/application_module/scenicVip',
    'application_module/v1.controller.ScenicController/scenicVip'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：搜索单个景区接口
 */
Route::post(
    'v1/application_module/singleScenic',
    'application_module/v1.controller.ScenicController/singleScenic'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：搜索用户接口
 */
Route::post(
    'v1/application_module/singleUser',
    'application_module/v1.controller.ScenicController/singleUser'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区信息接口
 */
Route::post(
    'v1/application_module/scenicModify',
    'application_module/v1.controller.ScenicController/scenicModify'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区管理员接口
 */
Route::post(
    'v1/application_module/modifyAdmin',
    'application_module/v1.controller.ScenicController/modifyAdmin'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取会员卡信息接口
 */
Route::post(
    'v1/application_module/membershipSel',
    'application_module/v1.controller.ScenicController/membershipSel'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取管理积分接口
 */
Route::post(
    'v1/application_module/integralSel',
    'application_module/v1.controller.ScenicController/integralSel'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改管理积分接口
 */
Route::post(
    'v1/application_module/integralUpt',
    'application_module/v1.controller.ScenicController/integralUpt'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取用户积分接口
 */
Route::post(
    'v1/application_module/userIntegral',
    'application_module/v1.controller.ScenicController/userIntegral'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改用户积分接口
 */
Route::post(
    'v1/application_module/userintegralUpt',
    'application_module/v1.controller.ScenicController/userintegralUpt'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区押金接口
 */
Route::post(
    'v1/application_module/depositScenic',
    'application_module/v1.controller.ScenicController/depositScenic'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区押金接口
 */
Route::post(
    'v1/application_module/depositscenicUpt',
    'application_module/v1.controller.ScenicController/depositscenicUpt'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改会员卡接口
 */
Route::post(
    'v1/application_module/membershipUpt',
    'application_module/v1.controller.ScenicController/membershipUpt'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取申请通过的景区列表接口
 */
Route::post(
    'v1/application_module/scenicList',
    'application_module/v1.controller.ScenicController/scenicList'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取预约团购扣除比例接口
 */
Route::post(
    'v1/application_module/groupProportion',
    'application_module/v1.controller.ScenicController/groupProportion'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改预约团购扣除比例接口
 */
Route::post(
    'v1/application_module/groupUpt',
    'application_module/v1.controller.ScenicController/groupUpt'
);