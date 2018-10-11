<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ticketgroup_route_v1_api.php
 *  创 建 者 :  Feng Tianshui
 *  创建日期 :  2018/09/27 18:51
 *  文件描述 :  用户端路由
 *  历史记录 :  -----------------------
 */

/**
 * 传值方式 : GET
 * 路由功能 : 模糊查询景区
 */
Route::get(
    ':v/user_module/searchScenicGet',
    'user_module/:v.controller.SearchScenicController/searchScenicGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 精准查询景区
 */
Route::get(
    ':v/user_module/accurateScenicGet',
    'user_module/:v.controller.SearchScenicController/accurateScenicGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询景区详细信息
 */
Route::get(
    ':v/user_module/scenicInfoGet',
    'user_module/:v.controller.SearchScenicController/scenicInfoGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询景区轮播图信息
 */
Route::get(
    ':v/user_module/scenicCarouselGet',
    'user_module/:v.controller.SearchScenicController/scenicCarouselGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询景区客服人员信息
 */
Route::get(
    ':v/user_module/scenicLinkmanGet',
    'user_module/:v.controller.SearchScenicController/scenicLinkmanGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询景区评论信息
 */
Route::get(
    ':v/user_module/scenicCommentGet',
    'user_module/:v.controller.SearchScenicController/scenicCommentGet'
);

/**
 * 传值方式 : GET
 * 路由功能 : 获取用户信息及会员信息
 */
Route::get(
    ':v/user_module/userInfoGet',
    'user_module/:v.controller.UserInfoController/userInfoGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 获取会员权益说明
 */
Route::get(
    ':v/user_module/vipExplainGet',
    'user_module/:v.controller.UserInfoController/vipExplainGet'
);
/**
 * 传值方式 : GET
 * 路由功能 : 获取用户推广人员列表
 */
Route::get(
    ':v/user_module/extendGet',
    'user_module/:v.controller.UserInfoController/extendGet'
);
/**
 * 传值方式 : POST
 * 路由功能 : 用户实名认证接口
 */
Route::post(
    ':v/realname_module/realnamePost',
    'realname_module/:v.controller.RealnameController/realnamePost'
);
/**
 * 传值方式 : GET
 * 路由功能 : 查询实名制状态
 */
Route::get(
    ':v/realname_module/realnameGet',
    'realname_module/:v.controller.RealnameController/realnameGet'
);
/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：提现景区余额接口
 */
Route::post(
    'v1/application_module/scenicBalanceExtract',
    'application_module/v1.controller.ScenicDepositController/scenicBalanceExtract'
);
/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：景区评论接口
 */
Route::post(
    ':v/user_module/scenicCommentPost',
    'user_module/:v.controller.SearchScenicController/scenicCommentPost'
);
/**
 * 传值方式：GET
 * 传值参数：
 * 路由功能：获取个人团购列表
 */
Route::get(
    ':v/user_module/userGroupList',
    'user_module/:v.controller.UserInfoController/userGroupList'
);

