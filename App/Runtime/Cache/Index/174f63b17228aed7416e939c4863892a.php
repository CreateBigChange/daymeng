<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/index.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/personalPagebase.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/myPage.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/modal/css/component.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/newsCenter.css"><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script src="__PUBLIC__/modal/js/modernizr.custom.js"></script><script src="__PUBLIC__/res/js/uploadPreview.js"></script><!-- 图片裁剪 --><!-- // <script src="__PUBLIC__/res/js/jquery.min.js"></script> --><script src="__PUBLIC__/res/js/jquery.Jcrop.js"></script><link rel="stylesheet" href="__PUBLIC__/res/css/jquery.Jcrop.css" type="text/css" /><script type="text/javascript">															function   chkmaxsms(vobj1,vmax)   {   															  var   str=vobj1.value;   															  var   strlen=str.length;   															  if(strlen>vmax)   {   												 															  eval(vobj1.value=str.substr(0,vmax));   															  }   															  }   															  //限定输入框的字数
		function test (argument) {
	 		$('#cropbox').Jcrop({
		      aspectRatio: 1,
		      onSelect: updateCoords
		    });
		 
		}
		function test2 (argument) {
			setTimeout("test()",3000);
		}
		
		  function updateCoords(c)
		  {
		    $('#x').val(c.x);
		    $('#y').val(c.y);
		    $('#w').val(c.w);
		    $('#h').val(c.h);
		  };

		  function checkCoords()
		  {
		    if (parseInt($('#w').val())) return true;
		    alert('Please select a crop region then press submit.');
		    return false;
		  };
	</script><style type="text/css">		  #target {
		    background-color: #ccc;
		    width: 500px;
		    height: 330px;
		    font-size: 24px;
		    display: block;
		  }
		</style><!-- 图片裁剪 --><script>		mypage='<?php echo U('index/personalPage/myPage_ajax','',''); ?>';
		change_info_ajax='<?php echo U('index/personalPage/change_info_ajax','',''); ?>';
	</script><script src="__PUBLIC__/res/js/mypage.js"></script><style type="text/css">		.table td{
			line-height: 30px;
			padding-top: 15px;
		}
		.info{
			width:78px;
		}
		form{
			width: 800px;
		}
		.ok{
			margin-left: 100px;
		}
		.md-close{
			margin-left: 100px;
		}
		.main-right p{
			padding-top: 20px;
			padding-left: 20px;
		}
		.important{
			/*color: #4BA733;*/
			padding-left: 30px!important;
			padding-top: 10px!important;
		}
	</style><!--模态框--><!--/模态框--><title>个人中心-管理信息</title></head><body onload="setup();preselect('湖南省');promptinfo();"><!--模态框--><div class="md-modal md-effect-1" id="modal-1"><div class="md-content" style="height:500px;width:900px"><h3>系统消息</h3><div><div  style="display:none" class="editor"><script>						$(function () {
							$("#up").uploadPreview({ Img: "cropbox", Width: 300, Height: 300 });
						});
						</script><!-- 表格填写 --><form method="post" action="<?php echo U('index/personalPage/mypage_upload','','');?>" enctype="multipart/form-data"><div style="float:left;"><table class="table"><!--
							<tr><td class="info">姓名:</td><td colspan="3"><input id="name" size="30"type="text" name="name" value="<?php echo ($person_info[0]['name']); ?>" /></td></tr>--><tr><td class="info">昵称:</td><td colspan="3"><input onkeyup="javascript:chkmaxsms(this,'8')" id="niker"size="30" type="text" name="niker" value="<?php echo ($person_info[0]['niker']); ?>"/></td></tr><?php
 if($person_info[0]['sex']=="男") echo '
							
							<tr><td class="info">性别:</td><td colspan="3"><input type="radio" name="iCheck" id="class" checked value="man">男</span><input type="radio" name="iCheck" id="class" value="woman" style="margin-left:20px;">女</span></td></tr>		'; else echo '
							
							<tr><td class="info">性别:</td><td colspan="3"><input type="radio" name="iCheck" id="class"  value="man">男</span><input type="radio" name="iCheck" id="class" checked value="woman" style="margin-left:20px;">女</span></td></tr>		'; ?><tr><td class="info">地址:</td><td colspan="3"><select class=" control-label" name="province" id="s1"><option></option></select><select class=" control-label" name="city" id="s2" style="margin-left:20px;"><option></option></select></td></tr><!--
							<tr><td class="info">出生日期:</td><td colspan="3"><input id="name" size="30"type="text" name="bird" value="<?php echo ($person_info[0]['bird']); ?>" /></td></tr>--><tr><td class="info">个人图片：</td><td><input type="file" name="photo1" id="up" onchange="test2();" /></td></tr><tr><td class="info">个性签名:</td><td colspan="3"><textarea onkeyup="javascript:chkmaxsms(this,'64')" id="person_description" style="width:300px;height:120px"type="text" name="person_description"><?php echo ($person_info[0]['person_description']); ?></textarea></td></tr></table></div><!-- 图片裁剪区域	 --><div id="header" style="float:right;height:300px;"><div class="container"><div class="row"><div class="span12"><div class="jc-demo-box"><!-- This is the image we're attaching Jcrop to --><!-- <img src="demo_files/pool.jpg" id="cropbox" />	 --><img id="cropbox" width="300" height="300" /><!-- This is the form that our event handler fills --><form action="crop.php" method="post" onsubmit="return checkCoords();"><input type="hidden" id="x" name="x" /><input type="hidden" id="y" name="y" /><input type="hidden" id="w" name="w" /><input type="hidden" id="h" name="h" /></form></div></div></div></div><p style="margin-top:30px;margin-left: 50px;"><button class="ok" style="display:inline">确认</button>									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="button" class="md-close" style="display:inline">关闭</button></p></div></form></div></div></div></div><div class="md-overlay"></div><!-- the overlay element --><!--/模态框--><!-- 头部 --><!-- 头部 --><div class="header"><div class="wrap clearfix" pbid="header"><div class="img-logo"><h1><a title="呆萌众筹" class="ie6fixpic" href="<?php echo U('/index','','');?>" alt="呆萌众筹">呆萌众筹</a></h1></div><!--menu start--><div class="menu"><ul class="clearfix"><li><a href="<?php echo U('/my','','');?>">个人中心 </a></li><li><a href="<?php echo U('/support','','');?>">我的众筹 </a></li><!-- <li><a href="/open">我的好友 </a></li> --><li><a href="<?php echo U('/news','','');?>">消息中心 &nbsp;<span style="color:red;font-size:12px;" ><?php echo session('news');?></span></a></li><li><a href="<?php echo U('/mp/index','','');?>">公众平台 </a></li></ul></div><div style="float:right;"><a href="<?php echo U('/person/'.session("user_id"));?>"><img style="width:50px;height:50px;margin-top:20px;" src="/Public/res/images/person_img/<?php echo ($person_info[0]['img']); ?>" /></a><span style="margin-left:5px;margin-top:-10px;"><a href="/my"><?php echo ($person_info[0]["niker"]); ?></a>&nbsp;|
		   		 <a href="<?php echo u('exit1');?>" calss="one" style="margin-left:5px;margin-top:-10px;">退出</a></span></div></div><!-- user menu end--></div><!-- 主内容去区--><div class="main clearfix"><div class="setting wrap"><div class="setting-title clearfix"><h3>个人中心</h3></div><div class="setting-content clearfix"><div class="setting-menu" style="padding-top:0px!important"><ul class="clearfix"><li class="select" ><a class="icons msg ie6fixpic" href="<?php echo U('/my','','');?>" >信息修改</a></li><li ><a class="icons rec-com ie6fixpic" href="<?php echo U('/password','','');?>">密码修改</a></li><li><a class="icons rec-com ie6fixpic" href="<?php echo U('/friend','','');?>">好友管理</a></li><li><a class="icons rec-com ie6fixpic" href="<?php echo U('/address','','');?>">收货地址管理</a></li><li><a class="icons rec-com ie6fixpic" href="<?php echo U('/trade','','');?>">我的交易信息</a></li></ul></div><div class="main-right" style="width:740px!important;background:#ffffff"><div class="person-info"><p style="font-size:26px;color:green;"><?php echo ($person_info[0]["niker"]); ?></p><p style="padding-left:30px;">简介：<?php echo ($person_info[0]["person_description"]); ?></p><p class="important">性别：<?php echo ($person_info[0]["sex"]); ?></p><p class="important">地址：<?php echo ($person_info[0]["address"]); ?></p><p style="padding-left:30px;"><a  class="change Js-addr-modify md-trigger" href="javascript:void(0)" style="color:#4BA733;" data-modal="modal-1"><img src="__PUBLIC__/res/images/small_pic/edit.png"> 编辑</a></p></div><!-- 评论消息 --><?php if(is_array($data)): foreach($data as $key=>$vo): ?><div class="person-space" ><div class="article"><div class="content"><div class="content-text"><p class="word"><?php echo ($vo['content']); ?></p><?php if(($vo['img']) != ""): ?><p class="img"><img src="__PUBLIC__/res/images/community/<?php echo ($vo['img']); ?>" width="100" height="100" ></p><?php endif; ?><ul><?php if(empty($vo['from_id'])): ?><li class="delete" com_id=<?php echo ($vo["id"]); ?> kind="no" ><a href="javascript:void(0)"  style="font-size:12px;padding-left:20px;">删除</li></a><?php else: ?><li class="delete" com_id=<?php echo ($vo["id"]); ?> kind="yes"><a href="javascript:void(0)"  style="font-size:12px;padding-left:20px;">删除</li></a><?php endif; ?><li style="color: #7e8a8c;">&nbsp;<?php echo ($vo['time']); ?></li></ul></div></div><div class="meta"></div></div></div><?php endforeach; endif; ?></div></div></div></div></div><!-- 尾部 --><div class="gbottom"><div class="gbottom-nav"><a href="<?php echo U('/help','','');?>">关于呆萌</a><a href="<?php echo U('/help/130','','');?>">洽谈合作</a><a href="<?php echo U('/help/130','','');?>">加入我们</a><a href="<?php echo U('/help/130','','');?>">联系我们</a><a href="<?php echo U('/help/127','','');?>">免责声明</a><a href="javascript:;">呆萌社区</a><a href="javascript:;">呆萌基金</a></div><div class="gbottom-i">©2014呆萌网&nbsp;湘ICP备09043258号-2</div></div><!--模态框--><div class="md-overlay"></div><!-- the overlay element --><script src="__PUBLIC__/modal/js/classie.js"></script><script src="__PUBLIC__/modal/js/modalEffects.js"></script><script>			var polyfilter_scriptpath = '/js/';
		</script><script src="__PUBLIC__/modal/js/cssParser.js"></script><!-- 地址选择器	 --><script src="__PUBLIC__/res/js/geo.js"></script><script>			function promptinfo()
				{
					var address = document.getElementById('address');
					var s1 = document.getElementById('s1');
					var s2 = document.getElementById('s2');
					address.value = s1.value + s2.value;
				}
		</script><script src="__PUBLIC__/modal/js/css-filters-polyfill.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/mySupportItem.js"></script><!--/模态框--></body></html>