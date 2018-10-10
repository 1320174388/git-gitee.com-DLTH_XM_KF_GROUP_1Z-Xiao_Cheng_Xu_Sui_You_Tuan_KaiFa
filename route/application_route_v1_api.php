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


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：兑换门票接口(显示门票内容)
 */
Route::post(
    'v1/application_module/exchangeTicket',
    'application_module/v1.controller.ScenicController/exchangeTicket'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：确认兑换门票接口
 */
Route::post(
    'v1/application_module/confirmexchangeTicket',
    'application_module/v1.controller.ScenicController/confirmexchangeTicket'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：兑换奖品接口(显示奖品内容)
 */
Route::post(
    'v1/application_module/prizeTicket',
    'application_module/v1.controller.ScenicController/prizeTicket'
);



/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：确认兑换奖品接口
 */
Route::post(
    'v1/application_module/confirmprizeTicket',
    'application_module/v1.controller.ScenicController/confirmprizeTicket'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改活动状态接口
 */
Route::post(
    'v1/application_module/activeStatus',
    'application_module/v1.controller.ScenicController/activeStatus'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取押金扣除记录列表接口
 */
Route::post(
    'v1/application_module/depositDeduction',
    'application_module/v1.controller.ScenicController/depositDeduction'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区押金接口
 */
Route::post(
    'v1/application_module/scenicDeposit',
    'application_module/v1.controller.ScenicController/scenicDeposit'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：删除景区客服接口
 */
Route::post(
    'v1/application_module/sceniccustomerserviceDel',
    'application_module/v1.controller.ScenicController/sceniccustomerserviceDel'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：景区押金支付接口
 */
Route::post(
    'v1/wx_payment_module/wxUnifiedApy',
    'wx_payment_module/v1.controller.IndexController/wxUnifiedApy'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：判断用户是否支付景区押金
 */
Route::post(
    'v1/application_module/depositPayment',
    'application_module/v1.controller.ScenicController/depositPayment'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：景区添加客服接口
 */
Route::post(
    'v1/application_module/customerAdd',
    'application_module/v1.controller.ScenicController/customerAdd'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区客服列表接口
 */
Route::post(
    'v1/application_module/customerSel',
    'application_module/v1.controller.ScenicController/customerSel'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：修改景区客服接口
 */
Route::post(
    'v1/application_module/customerUpt',
    'application_module/v1.controller.ScenicController/customerUpt'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区评论列表
 */
Route::post(
    'v1/application_module/Comment',
    'application_module/v1.controller.ScenicController/Comment'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：领取个人优惠券接口
 */
Route::post(
    'v1/application_module/coupon',
    'application_module/v1.controller.ScenicController/coupon'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：判断用户是否领取优惠劵接口
 */
Route::post(
    'v1/application_module/couponReceive',
    'application_module/v1.controller.ScenicController/couponReceive'
);

/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：获取景区下正在进行的团购列表
 */
Route::post(
    'v1/application_module/grouppurchaseList',
    'application_module/v1.controller.ScenicController/grouppurchaseList'
);


/**
 * 传值方式：POST
 * 传值参数：
 * 路由功能：提现景区押金接口
 */
Route::post(
    'v1/application_module/scenicExtractPost',
    'application_module/v1.controller.ScenicDepositController/scenicDepositExtract'
);
/**
 * 传值方式：GET
 * 传值参数：
 * 路由功能：获取景区余额
 */
Route::get(
    'v1/application_module/scenicBalanceGet',
    'application_module/v1.controller.ScenicDepositController/scenicBalanceGet'
);
/**
 * 传值方式：GET
 * 传值参数：
 * 路由功能：获取景区收益余额列表
 */
Route::get(
    'v1/application_module/profitListGet',
    'application_module/v1.controller.ScenicDepositController/scenicProfitGet'
);