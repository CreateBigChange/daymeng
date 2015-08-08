<?php
//后台配置文件
return array(
	//修改__PUBLIC__地址
	'TMPL_PARSE_STRING'=>array(
		'__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/'.'Tpl/Admin/Index/Public'),
	  'SHOW_PAGE_TRACE' => false,//显示调试信息
	   'URL_MODEL' => '2',
	    'URL_HTML_SUFFIX'=>'.shtml'
	);
?>