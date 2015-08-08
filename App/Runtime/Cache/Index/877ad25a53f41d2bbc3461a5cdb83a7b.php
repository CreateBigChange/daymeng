<?php if (!defined('THINK_PATH')) exit();?><!-- saved from url=(0043)http://m.z.jd.com/project/details/2406.html --><html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><!-- width：设备的宽度，最小的缩放比例，最大的缩放比例 ,不能缩放--><meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"><!-- 手机号码不被显示为拨号连接 --><meta name="format-detection" content="telephone=no"><!-- ios设备对meta定义的私有属性：（可以添加至主屏幕） --><meta name="apple-mobile-web-app-capable" content="yes"><meta charset="utf-8"><title>呆萌网详情触屏版</title><link rel="stylesheet" href="__PUBLIC__/res/mobile/res/css/zc-common.css"><link rel="stylesheet" href="__PUBLIC__/res/mobile/res/css/zc-index.css"><link rel="stylesheet" href="__PUBLIC__/res/mobile/res/css/detail_mobile.css"><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/lib/jquery.cookies.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/mobile/res/js/Mobile.js" ></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/login.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><script>
			     prise_ajax='<?php echo U('index/detail/prise_ajax','','')?>';//赞的ajax
				 opinion_url='<?php echo U('index/detail/attention_ajax','','')?>';//关注的ajax
				 check_phone = '<?php echo U("/index/mobile/check_phone");?>';//手机验证码的ajax
				 check_code = '<?php echo U("/index/mobile/check_code");?>';//手机验证码的ajax
				 var fund_item_id =  <?php echo ($data[0]['id']); ?>;
				 var fund_repay_id = <?php if($fund_repay_id) echo ($fund_repay_id);else echo "null";?>;
	</script><style>
	.modal-content
	{
		width:400px !important;
	}
	.mobile
	{
		background:url("/Public/res/images/index/phonetest1.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
	}
	.mobile_text
	{
		border:1px solid ##041C4C !important;
	}
	</style></head><body><div class="wrapbox1"><!-- heard --><header class="header"><h2><a href="/index"><span class="title">呆萌众筹</span></a></h2><a href="/index" clstag="jr|keycount|zc_m_product|zc_zy" class="icon btn-home" style="left: 0px"></a><a href="/my" clstag="jr|keycount|zc_m_product|zc_zcdetail" class="icon btn-person"></a></header><!-- /head 结束 --><button data-toggle="modal" data-target="#myModal1" id="phone" style="display:none">
   登录
</button><style type="text/css">
.get_verify{
	border:1px solid #888888;
	margin-left: 90px;
	border-radius: 25px;
	-web-kit-border-radius: 25px;
	-moz-border-radius: 25px;
	padding: 10px 25px;
	margin-bottom: 20px;
	width: 150px;
	cursor:pointer;
  color: #888;
}
.get_verify_again{
	color: #aaa;
	padding: 1px;
	margin-bottom: 20px;
	width: 50px;
	cursor:pointer;
}
.get_verify_again:hover{
	color: #888;
}
.get_verify:hover{
	background-color:#33a600;
	color: #fff;
}
.phone_sup{
  border:0px;
	display: none;
text-align: center;
padding: 5px 5px;
height: 35px;
color: #ffffff;
background: #FF7F3F;
border-radius: 5px;
-web-kit-border-radius: 5px;
-moz-border-radius: 5px;
width: 220px;
font-size: 18px;
margin: 0px auto;
cursor: pointer;

}
.verify{
	display: none;
}
.phone_num{
	margin-left: 20px;
	margin-bottom: 20px;
}
.alert_phone{
  color: red;
  
}
.again{
  display: none;
}
</style><!-- 按钮触发模态框 --><!-- 模态框（Modal） --><div class="modal fade" id="myModal1" tabindex="-1" role="dialog"  
   aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="width:700px;margin:0px auto;margin-top:100px;"><div class="modal-header" style="background-color:#f3f3f3" style="margin:0px auto
         "><button type="button" class="close" data-dismiss="modal" 
               aria-hidden="true">×
            </button><div class="mobile" style="margin:0px auto;width:600px;height:200px;background:url(__PUBLIC__/res/images/index/phonetest.jpg) no-repeat;"></div></div><div class="modal-body" style="text-align:center;min-height:150px;"><table style="text-align:center;margin:0px auto;"><tr><td style="padding-bottom: 20px;"><span>手机号:  </span><span style='color:#888' >(+86)</span></td><td><input type="text"  name="phone_num" class="phone_num" /></td></tr><tr class="verify"><td style="padding-bottom: 20px;"><span>验证码: </span></td><td><input type="text"  name="verify" class="phone_num" /></td></tr><tr><td colspan="2"><div><input  type='button' class="get_verify  get_verify_again1"  value="免费获取验证码>"  /></a></div></td></tr><tr><td colspan="2"><button class="phone_sup">
                    支持
                  </button></td></tr><tr><td colspan="2"><div style="height:50px;margin-left:0px;font-size: 12px;margin-top:30px;" class="again" >
            如2分钟后仍未收到，请尝试
            <a    href="javascript:void(0);" class="get_verify_again get_verify_again1   " style="text-decoration: none;" >再次获取></a><p class="alert_phone"></p></div></td></tr></table></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal --><script>
   var login_url="<?php echo U('Index/Login/login','','');?>";
      var login_check="<?php echo U('Index/Login/login_check','','');?>";
      var login_verify='<?php echo U("Index/Login/verify","","");?>';
      var login="<?php echo U('Index/Login/','','');?>";
        var rem_login="<?php echo U('Index/Login/rem_login','','');?>";
      var home="<?php echo U('/Index','','');?>"; 
  // $("#t_login").click();
   // $(function () { $('#myModal').modal({
   //    keyboard: true
   // })});

 </script><script type="text/javascript">
    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";
    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";
    </script><!-- 模态框（Modal） --><!-- main --><div class="pd-b50"><!-- 项目详情 开始--><div class="zc-list"><div class="zc-item"><!-- 项目详情大图 --><div><a clstag="jr|keycount|zc_m_product|zc_xmxq" href="/index.php/Mobiledetail/index.html?items=<?php echo ($data[0]['id']); ?>"><img src="__PUBLIC__/res/images/index/<?php echo ($data[0]['new_img']); ?>" alt=""></a></div><!-- 项目详细介绍 --><div class="pd-0-10 bd-b"><a clstag="jr|keycount|zc_m_product|zc_xmxq" href="/index.php/Mobiledetail/index.html?items=<?php echo ($data[0]['id']); ?>" class="detail-a" style="text-decoration:none;color:#33A600"><!-- 标题 --><h4 class="h4-title"><?php echo ($data[0]['title']); ?><i class="icon more-r fr"></i></h4><!-- 介绍 --><p><?php echo ($data[0]['items_description']); ?></p></a><!-- 详情 --><div class="progress-box"><div class="progrestate-b s-ing fr">众筹中</div><div class="progresnum"><?php echo ($data[0]["percent"]); ?>%</div><div class="progressbar"><div class="progressing" style="width: <?php echo ($data[0]['percent']); ?>%"></div></div></div><div class="gridbox zc-datum"><div class="grid-3"><strong>￥<?php echo ($data[0]["gain"]); ?></strong><p>已筹集</p></div><div class="grid-2"><strong><?php echo ($data[0]["sup"]); ?></strong><p>支持人数</p></div><div class="grid-2"><strong><?php echo ($data[0]["kepp_day"]); ?>天</strong><p>剩余时间</p></div></div><!-- 关注量 --><ul class="gridbox"><li class="grid-1 btn-oncern"><a clstag="jr|keycount|zc_m_product|zc_gz" href="javascript:;" id="a_focus" data =<?php echo ($data[0]['id']); ?> ><i class="icon"></i>已关注(<span id="attention_num"><?php echo ($data[0]["attention"]); ?></span>)</a></li><li class="grid-1 btn-praise"><a clstag="jr|keycount|zc_m_product|zc_dz" href="javascript:;" id="a_prais" data =<?php echo ($data[0]['id']); ?>  ><i class="icon"></i>赞（<span id="prise_num"><?php echo ($data[0]["prise"]); ?></span>）</a></li><input type="hidden" id="user_pin" value="undefined"><input type="hidden" id="project_id" value="2406"></ul><!-- 项目话题，可有可无 --><!--                 <a clstag="jr|keycount|zc_m_detail|zc_htxq" href="#" class="btn btn-l2 topicbtn">
                                                                        项目话题（106个）
                                                                <i class="icon more-r"></i></a> --></div></div></div><!-- 项目详情结束 --><h2 class="h2-title">选择回报</h2><!-- 回报开始 --><ul class="return-list"><!-- 回报一开始 --><?php if(is_array($repay)): $i = 0; $__LIST__ = $repay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><div class="gridbox supportbox"><div class="grid-2 supp-price">
                    支持￥<?php echo ($vo["money"]); ?></div><!--判断是不是无限额的支持--><?php if(($vo['limits']) == "0"): ?><!--无限额的支持--><div class="grid-2"><form class="tijiao" action="<?php echo U('Index/support/index','','');?>" method="post"><input type="hidden" name="items_id"  value="<?php echo ($vo['items_id']); ?>" /><input type="hidden" name="repay_id"  value="<?php echo ($vo['id']); ?>" /><input type="hidden" name="url"  value="" /><!--判断是不是基金类的--><?php if(($vo['money']) == "0"): ?><!--基金项目--><button type="button"  class="btn_self1 fr" id="fund" value="<?php echo ($vo["money"]); ?>" style="background:#33a600;"/><?php echo ($vo["money"]); ?>￥</button><!--基金项目--><?php else: ?><!--非基金项目 --><button type="button" class="btn_self fr" value="<?php echo ($vo["money"]); ?>" style="background:#33a600;"/><?php echo ($vo["money"]); ?>￥</button><!--非基金类项目--><?php endif; ?></form></div><!--无限额的支持--><?php else: ?><!--有限额的支持--><?php if(($vo['num']) >= $vo['limits']): ?><a href="javascript:;" class="btn btn-disable fr">限额已满</a><?php else: ?><form class="tijiao" action="<?php echo U('Index/support/index','','');?>" method="post"><input type="hidden" name="items_id"  value="<?php echo ($vo['items_id']); ?>" /><input type="hidden" name="repay_id"  value="<?php echo ($vo['id']); ?>" /><input type="hidden" name="url"  value="" /><!--判断是不是基金类的----><?php if(($vo['money']) == "0"): ?><!--基金类的项目--><button type="button"   class="btn_self1  dfr" id="fund" value="<?php echo ($vo["money"]); ?>" style="background:#33a600;"/><?php echo ($vo["money"]); ?>￥</button><!--基金类的项目--><?php else: ?><!--非基金类的项目--><button type="button" class="btn_self fr" value="<?php echo ($vo["money"]); ?>" style="background:#33a600;"/><?php echo ($vo["money"]); ?>￥</button><!--非基金类的项目--><?php endif; ?></form><?php endif; ?><!--有限额的支持--><?php endif; ?><!--判断是不是无限额的支持--></div><div class="info-min"><p><?php if(is_array($vo['content'])): $i = 0; $__LIST__ = $vo['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo ($v); endforeach; endif; else: echo "" ;endif; ?></p><a href="" class="lightbox" data-id="bigimg1"><?php if(empty($vo['new_img'])): else: ?><img height="64" width="64" src="/<?php echo ($vo["new_img"]); ?>" class=""><?php endif; ?></a><p>
                    配送费用:<?php if(($vo['send_money']) == "0"): ?>免运费
								<?php else: echo ($vo["send_money"]); endif; ?></p><p>预计回报发送时间：项目成功结束后<?php echo ($vo["time"]); ?>天内</p></div><div class="info-all"><p><?php if(is_array($vo['content'])): $i = 0; $__LIST__ = $vo['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo ($v); endforeach; endif; else: echo "" ;endif; ?></p><p>配送费用：
                    <?php if(($vo['send_money']) == "0"): ?>免运费
					<?php else: echo ($vo["send_money"]); endif; ?></p><p>预计回报发送时间：项目成功结束后<?php echo ($vo["time"]); ?>天内</p></div><div class="gridbox supportfoot"><div class="grid-1"><div class="grid-2"><span class="text-red"><strong><?php echo ($vo["number"]); ?>位
							  </strong></span>支持者
							（剩余
							<!--判断是不是无限额的--><?php if(($vo['limits']) == "0"): ?><!--无限额的支持者--><span class="text-red">无限额
								</span><!--无限额的支持者--><?php else: ?><!--有限额的支持者--><span class="text-red"><?php echo ($vo['limits'] - $vo['num']); ?></span><!--有限额的支持者--><?php endif; ?>
							）
					</div></div></div></li><?php endforeach; endif; else: echo "" ;endif; ?><!-- 下面依次类推，li开始、/li结束 --></ul><!-- 猜你喜欢推荐 --><h2 class="h2-title">猜你喜欢</h2><ul class="goods-list youlike"><!-- 推荐开始 --><?php if(is_array($like_items)): $i = 0; $__LIST__ = $like_items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$like): $mod = ($i % 2 );++$i;?><li><a clstag="jr|keycount|zc_m_product|zc_cnxh" href="#" class="gridbox"><div class="goods-pic"><!-- 图片 --><a href="/detail/<?php echo ($like['id']); ?>"><img width="100" height="100" src="__PUBLIC__/res/images/Items/<?php echo ($like["items_img"]); ?>" alt=""></a></div><div class="grid-1"><h5 class="h5-title"><!-- 标题 --><a href="/detail/<?php echo ($like['id']); ?>"><?php echo ($like["title"]); ?></a></h5><!-- 详细内容 --><p class="pheight"><a href="/detail/<?php echo ($like['id']); ?>"><?php echo ($like["items_description"]); ?></a></p></div></a></li><?php endforeach; endif; else: echo "" ;endif; ?><!-- 推荐结束，下面依次类推 --><!--百度一键分享--><div class="bdsharebuttonbox" data-tag="share_1" style="display:none;"><a class="bds_tsina" id="tsina" data-cmd="tsina"></a><a class="bds_weixin" id="weixin" data-cmd="weixin"></a></div><!--百度一键分享--></ul><!-- 微博空间分享 --><div class="bdsharebuttonbox" data-tag="share_1"><div class="gridbox sharebox" ><div class="grid-1" id="wxShareBtn"><a class="bds_qzone qzone" id="qzone" data-cmd="qzone" href="#" style="margin-top:15px;margin-left:40px;"></a></div><div class="grid-1"><a class="bds_tsina weibo" id="tsina" data-cmd="tsina" style="margin-top:15px;margin-left:40px;"></a></div><div class="grid-1"><a class="bds_weixin  weixin" id="weixin" data-cmd="weixin" style="margin-top:15px;margin-right:10px;"></a></div></div></div><!-- 微博空间结束 --><!--微信扫一扫分享开始--><div class="wxShare-layer notInWx" id="wxShareLayer-1"><div class="wxShareCloseBtn"></div><div class="pro-title"><?php echo ($data[0]['title']); ?></div><div class="ercodeHolder"><a href=""><img src="__PUBLIC__/res/mobile/res/images/detail/m_get_wxcode.html" alt="呆萌众筹"></a></div><div class="shareTxt"><h5> 截屏到相册后，使用微信扫一扫</h5><h6> 即可将发起的项目分享给微信好友或微信好友圈</h6></div></div><div class="wxShare-layer InWx" id="wxShareLayer-2"></div><!--微信扫一扫分享结束--><div class="mypanel f-text2"><a clstag="jr|keycount|zc_m_product|zc_dl" href="/login">登录</a><a clstag="jr|keycount|zc_m_product|zc_hddb" href="javascript:;" class="fr" id="goTop">回到顶部</a></div><div class="footer"><p class="f-text1">Copyright © 2004－2014呆萌daimeng.com版权所有</p><p class="f-text2"><span>|</span><a href="/help/130">联系我们</a></p></div><!--一键分享--><script>
	window._bd_share_config = {
		common : {
			bdText : '<?php echo ($data[0]["title"]); ?>',	
			bdDesc : '<?php echo ($data[0]["items_description"]); ?>',		
			bdPic : 'http://www.daymeng.com/Public/res/images/Items/<?php echo ($data[0]["new_img"]); ?>'
		},
		share : [{
			"bdSize" : 24
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	
	$("#d_weixin").click(function(){
		document.getElementById("weixin").click(); //既触发了a标签的点击事件，又触发了页面跳转 微信的点击事件
	})

	$("#d_weibo").click(function(){
		document.getElementById("tsina").click(); //既触发了a标签的点击事件，又触发了页面跳转  微博的点击事件
	})
	$("#d_qzone").click(function(){
		document.getElementById("qzone").click(); //既触发了a标签的点击事件，又触发了页面跳转  qq空间的点击事件
	})
	
	$(".btn_self").click(function(){

		if("<?php echo $_SESSION['user_id'] ?>"=="")
		{
			alert("请先登陆哦！！");
			window.location.href="<?php echo U('/login'); ?>";
		}
		else
		{
			//alert($(this).parents("form"));
			$(this).parents("form")[0].submit();
		}
	})
	$("#fund").click(function(){
		$("#phone").click();
	})
	/*
	if(<?php echo ($data[0]["item_check"]); ?>==0||<?php echo ($data[0]["begin_time"]); ?>>$str||end_time<$str)
	{
		//alert("ok");
		$(".btn_self").attr("Disabled",true);
	}
	*/
</script><!--一键分享--></div></div><!-- end main --></body></html>