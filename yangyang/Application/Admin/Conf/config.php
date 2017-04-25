<?php
return array(
	//'配置项'=>'配置值'
    //主题静态文件路径
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__.'/Application/'.MODULE_NAME.'/View/' . '/Public/static',),
    'TAGLIB_BUILD_IN'        => 'Cx,Common\Tag\My',             
     // 加载自定义标签
);