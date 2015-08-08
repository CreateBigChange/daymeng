<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><title>呆萌网福利专用！！！</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><style type="text/css">	*{
		margin: 0px;padding: 0px;
	}
	body{
		background-image: url(__PUBLIC__/res/images/test.png);width: 100%;height: 100%;
	}
	#black{
		width: 100%;height: 100%;display: none;background-color: #000;top: 0px;left: 0px;opacity: 0.5;filter:alpha(opacity=50);position: fixed;
	}
	#modal{
		position: absolute;top: 0px;left: 50%;margin-left: -540px; height: 600px;width: 1080px;
	}
	.step{
		position: absolute;top: 100px;left: 240px;height: 474px;width: 600px;
	}

	#stepa{
		display: none;background-image: url(__PUBLIC__/res/images/time.png);
	}
	.bshare-qzone{
		position: absolute;top: 160px;left: 442px;
	}
	.bshare-weixin{
		position: absolute;top: 160px;left: 518px;
	}
</style><body><!-- 网站页面阴影区 --><div id="black"></div><div id="modal"><div class="step" id="stepa"><div class="bshare-custom"><a title="分享到" href="http://www.bshare.cn/share" id="bshare-shareto" class="bshare-more"></a><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到微信" class="bshare-weixin" href="javascript:void(0);"></a><!-- 在这里添加更多平台 --></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=56edd4e7-308f-45c0-99d1-690348b3a330&style=-1"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC3.js"></script></div></div><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script type="text/javascript" charset="utf-8">bShare.addEntry({
    title: "呆萌网，发福利啦！！",
  //  url: "http://www.daymeng.com/",
    summary: "各位亲，伦家来了！呆萌网，湖南科技大学创业团队荣誉出品！！！",
    pic: "http://www.daymeng.com/public/res/images/time.png"
});
</script><script type="text/javascript">	$(document).ready(function(){
		$('#black,#modal,#stepa').show();
	});
</script></body></html>