<?php
return array(
	//'配置项' =>'配置值'
	'MODULE_ALLOW_LIST' =>    array('Home','Admin',),
	//我们用了入口版定 所以下面这行可以注释掉
	//'DEFAULT_MODULE'    =>    'Home',  // 默认模块	
	//'SHOW_PAGE_TRACE'   =>  true, 
	'LOAD_EXT_CONFIG'   => 'db,wechat,oauth', 
	'URL_CASE_INSENSITIVE'  =>  true,  //url不区分大小写
	'URL_MODEL'   =>0,
	'URL_HTML_SUFFIX'  =>'html',
	'TAGLIB_BUILD_IN'        => 'Cx,Common\Tag\My',              // 加载自定义标签
	//'DEFAULT_FILTER'        => 'htmlspecialchars',
	'SUPER_ADMIN_ID'=>1,  //超级管理员id 删除用户的时候用这个禁止删除
	'SHOW_ERROR_MSG'        =>  true, 
	//用户注册默认信息
	'DEFAULT_SCORE'=>100,
	'LOTTERY_NUM'=>3,  //每天最多的抽奖次数



    'EMAIL_FROM_NAME'        => '2119508463@qq.com',        // 发件人
    'EMAIL_SMTP'             => 'smtp.qq.com',  // smtp
    'EMAIL_USERNAME'         => '2119508463@qq.com',        // 账号
    'EMAIL_PASSWORD'         => 'qrlksmtvdmpocafd',        // 密码  注意: 163和QQ邮箱是授权码；不是登录的密码
    'EMAIL_SMTP_SECURE'      => 'ssl',          // 如果使用QQ邮箱；需要把此项改为  ssl
    'EMAIL_PORT'             => '465',          // 如果使用QQ邮箱；需要把此项改为  465
);