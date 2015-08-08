<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/index.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/personalPagebase.css"><title>个人中心</title></head><body><!-- 头部 --><div class="header"><div class="wrap clearfix" pbid="header"><div class="img-logo"><h1><a title="众筹网" class="ie6fixpic" href="/index.php" alt="众筹网">众筹网</a></h1></div><!--menu start--><div class="menu"><ul class="clearfix"><li><a href="<?php echo U('/my','','');?>">修改信息 </a></li><li><a href="<?php echo U('/support','','');?>">我的众筹 </a></li><!-- <li><a href="/open">我的好友 </a></li> --><li><a href="<?php echo U('/news','','');?>">我的消息 </a></li></ul></div></div><!-- user menu end--></div><!-- 主内容去区--><div class="main"><div class="main-left"><!-- 个人图片显示 --><div class="person-img"><div class="cool flip"><div class="front"><img src="__PUBLIC__/res/images/person_img/<?php echo ($userinfo[0]['img']); ?>" width="200" height="200" alt="" class="aaaaa"></img></div></div></div><div><a id="add_friend" href="javascript:void(0)" friend_id="<?php echo ($add_id); ?>"><img title="加为好友" src="/Public/res/images/small_pic/friend.png" style="width:90px;margin-top:15px;margin-left:70px;"></a></div><!-- 好友详情表 --><div class="friend-table"><ul class="stats-list clearfix"><li class="first"><strong id="QM_Profile_Photo_Cnt"><a href="/atten"><?php echo ($atten[0]['count(*)']); ?></a></strong><span>关注</span></li><li style=" border-left: 1px #ddedf0 solid;"><strong id="QM_Profile_Mood_Cnt"><a href="/friend"><?php echo ($frien[0]['count(*)']); ?></a></strong><span>萌友</span></li><li style=" border-left: 1px #ddedf0 solid;"><strong id="QM_Profile_Blog_Cnt"><a href="/my"><?php echo ($topic[0]['count(*)']); ?></a></strong><span>帖子</span></li></ul></div></div><!-- 个人动态展示 --><div class="main-right"><div class="person-info"><h1 style="font-size:30px;"><?php echo ($userinfo[0]['nickname']); ?></h1><h2 style="font-size:20px;">简介：<?php echo ($userinfo[0]['person_description']); ?></h2><h3><ul><li><!-- <img src="__PUBLIC__/res/images/personalPage/male.png"> --></li><li>姓名：<?php echo ($userinfo[0]['name']); ?></li><li>性别：<?php echo ($userinfo[0]['sex']); ?></li></ul></h3><!-- <h4>编辑个人资料</h4> --></div><?php if(is_array($usernews)): foreach($usernews as $key=>$vo): ?><div class="person-space" ><div class="article"><div class="content" style="border-left:1px solid #c7e5eb;border:1px solid #c7e5eb;"><div class="content-text"><p class="word" ><?php echo ($vo['content']); ?></p><?php if(($vo['img']) != ""): ?><p class="img"><img src="__PUBLIC__/res/images/community/<?php echo ($vo['img']); ?>" width="100" height="100" ></p><?php endif; ?><ul><li><a href="javascript:;" class="jscom" data="<?php echo ($vo['id']); ?>"> 评论(<span id="p<?php echo ($vo['id']); ?>"><?php echo ($vo['com_num']); ?></span>)</a></li><li><a href="javascript:;" class="jssup" data="<?php echo ($vo['id']); ?>" sup="0"> 点赞(<span ><?php echo ($vo['prise']); ?></span>)</a></li><li style="color: #7e8a8c;">&nbsp;<?php echo ($vo['time']); ?></li></ul></div></div><div class="meta" style="margin-top:10px;display:none" id="<?php echo ($vo['id']); ?>"><textarea style="height:30px; width:600px;margin-top:20px;margin-left:10px;" placeholder="在这里评论" ></textarea><p style="text-align:right;margin-right:80px;margin-bottom:10px;"><a href="javascript:;" class="submit" data="<?php echo ($vo['id']); ?>"><img src="__PUBLIC__/res/images/small_pic/com.png"></a></p></div></div></div><?php endforeach; endif; ?></div></div><!-- 尾部 --><div class="gbottom"><div class="gbottom-nav"><a href="<?php echo U('/help','','');?>">关于呆萌</a><a href="<?php echo U('/help/130','','');?>">洽谈合作</a><a href="<?php echo U('/help/130','','');?>">加入我们</a><a href="<?php echo U('/help/130','','');?>">联系我们</a><a href="<?php echo U('/help/127','','');?>">免责声明</a><a href="javascript:;">呆萌社区</a><a href="javascript:;">呆萌基金</a></div><div class="gbottom-i">©2014呆萌网&nbsp;湘ICP备09043258号-2</div></div><script src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script type="text/javascript">	add_friend= '<?php echo U('index/detail/add_friend','','')?>';		

		$("#add_friend").click(function(){
				friend_id = $(this).attr("friend_id");//改成好友的id
			//	alert(friend_id);	
					$.ajax({
					url:add_friend,
					type:"post",
					dataType:"json",
					data:{friend_id:friend_id},//传入好友的id
					success:function(product)
					{
						//alert(product);
						switch(product)
						{
						case 1:
						 // alert("请先登录");
						  $("#t_login").click();
						  break;
						case 2:
						   alert("已是好友请不要重复添加");
						  break;	
						  case 3:
						   alert("添加成功");
						  break;
						default:
							alert("sorry");
						}
						//1表示请先登录
						//2已是好友请不要重复添加
						//3添加成功
					},
					error:function()
					{
						//alert("ajax 失败");
					}
					})
		});

		var url_sup ="<?php echo U('index/Community/zan_ajax');?>";
		var url_com ="<?php echo U('index/Community/second_ajax');?>";

		$('.jscom').on('click',function(){
			var id=$(this).attr('data');
			var meta=$('#'+id);
			if (meta.css('display')=='none') {
				meta.css('display','block');
			}
			else{
				meta.css('display','none');
			}
		});
		//点赞
		$('.jssup').on('click',function(){
			var id=$(this).attr('data');
			if ($(this).attr('sup')=='0') {
				$.post(url_sup,{from_id:id});
				$(this).attr('sup','1');
				var a=$(this).find('span').text();
				$(this).find('span').text(parseInt(a)+1);
			}
			else{
				alert('你已经点过赞了哦！');
			}
		})
		//评论
		$('.submit').click(function(){
			var id=$(this).attr('data');
			var content=$(this).closest('.meta').find('textarea').val();
			if (content!="") {
				$.post(url_com,{from_id:id,content:content});
				a=$('#p'+id).text();
				$('#p'+id).text(parseInt(a)+1);
				alert('谢谢你的评论哦。。。');
				$(this).closest('.meta').find('textarea').hide();
			}
			else{
				alert('请不要发送空内容。。。');
			}
		});
</script></body></html>