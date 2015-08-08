<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><!-- saved from url=(0035)http://www.dariobrozzi.com/404.html --><html lang="en" xml:lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"><meta name="robots" content="noindex, nofollow"><title>网页跳转</title><link rel="icon" type="image/png" href="__PUBLIC__/res/images/small_pic/meng_ico.ico"><style type="text/css" media="screen">			html, body{ margin: 0; padding: 0; border: 0; font-size: 100%; vertical-align: baseline; }
			body{ font: 100%/160% Georgia, Constantia, "Lucida Bright", LucidaBright, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Times, Serif; text-align: center; color: #2A2925; background: #ffffff; padding-top: 10%; }
			img{ float: right; width: 25%; min-width: 150px; max-width: 300px; height: auto; margin-top: -5%;margin-right: 150px; }
			p{ margin: 0; padding: 0 2% 2% 2%; line-height: 1em; font-size: 1.8em; }
			.error{ font-size: 4em; }
			.funny{ font-style: italic; }
      		a, a:link, a:visited{ color: #fff; background: #33A600; text-decoration: none; padding: .2em .4em; line-height: 2em; -webkit-border-radius: .5em; -moz-border-radius: .5em; border-radius: .5em; }
        	a:hover{ background: #4AC713; }
		</style></head><body><img src="__PUBLIC__/res/images/404.png" alt="troopers needs cofee too!"><?php if(isset($message)): ?><p class="funny"><?php echo($message); ?></p><?php else: ?><p class="funny"><?php echo($error); ?></p><?php endif; ?></p><p>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p><script type="text/javascript">(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
 </script></body></html>