<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache"><meta http-equiv="Cache-Control" content="no-cache"><meta http-equiv="expires" content="0"><!-- 指定以最新的IE版本模式来显示网页 --><meta http-equiv="X-UA-Compatible" content="IE=edge"><title>呆萌社区</title><meta name="description" content="呆萌网,呆萌社交,大学生社交,大学生众筹,呆萌众筹,众筹公益,呆萌基金,呆萌公益,大学生公益"/><meta name="Keywords" content="呆萌网,呆萌社交,大学生众筹,大学生社交,众筹网/"><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><link rel="stylesheet" href="__PUBLIC__/zc.css"/><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/community.css"><link rel="stylesheet" href="__PUBLIC__/res/css/jquery-sinaEmotion-2.1.0.min.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/lib/jquery.cookies.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/jquery-sinaEmotion-2.1.0.min.js"></script><script src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script src="__PUBLIC__/res/js/community.js"></script><script src="__PUBLIC__/res/js/community/tagscloud.js"></script><script src="__PUBLIC__/res/js/uploadPreview.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><script type="text/javascript" language="javascript" charset="utf-8">$(document).ready(function () {
    $('#nav-list-example li div.back').hide().css('left', 0);
    
    function mySideChange(front) {
        if (front) {
            $(this).parent().find('div.front').show();
            $(this).parent().find('div.back').hide();
            
        } else {
            $(this).parent().find('div.front').hide();
            $(this).parent().find('div.back').show();
        }
    }
    
    $('#nav-list-example li').hover(
        function () {
            $(this).find('div').stop().rotate3Di('flip', 250, {direction: 'clockwise', sideChange: mySideChange});
        },
        function () {
            $(this).find('div').stop().rotate3Di('unflip', 500, {sideChange: mySideChange});
        }
    );
});






	function checked_num(obj,obj_num){
	//alert(obj.value.length);
		if(obj.value.length>obj_num)
			obj.value = obj.value.substring(0,obj_num);
	}

//限定输入框的字数
</script></head><script>community = '<?php	echo U('community_ajax','','') ?>';//无限下滑的ajax
second_ajax = '<?php	echo U('second_ajax','','') ?>';//第二评论的ajax
upload = '<?php	echo U('upload','','') ?>';//评论图片的ajax	
zan_ajax = '<?php	echo U('zan_ajax','','') ?>';//赞的ajax
hot_zan_ajax='<?php echo U("hot_zan_ajax") ?>';//获取hot赞的ajax路径	
hot_t_p = '<?php echo U("hot_t_p")?>';//今日热议的ajax
next_y = '<?php echo U("next_y")?>';//寻找下一页的ajax
hot_num = <?php echo ($topic_num); ?>;//页的id
topic_id = <?php echo ($dm_today_topic[0]["id"]); ?>;topic_today = '<?php echo U("topic_today")?>';//寻找热门话题的ajax
if('<?php echo $_SESSION["user_id"];?>')//判断是否登陆
{
var login=1;
}
else

{
var login = 0;
}

function getLocalTime(nS) {     
return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');     
}  //定义时间转化函数
</script><body class="all"><div class="head" style="position:fixed;z-index:1"><a href="javascript:void(0)"><img   class="head_img" src="__PUBLIC__/res/images/small_pic/logo_community1.png"/></a><span  class="commonity_logo"><a href="<?php echo U('index/index');?>"><img class="img_logo" src="__PUBLIC__/res/images/small_pic/community_logo.png"><h3 class="h3" style="line-height:0.1px;">呆萌首页</h3></a></span></div><div style="width:100%;height:80px;"></div><div class="row"><div class="col-lg-1 "></div><div class="col-lg-10"><div class="row"><div class="col-lg-9 main"><div class="talk "><h3 style="float:left;margin-left:55px;">有什么新想法和大家分享?</h3><h5 style="float:right;margin-top:30px;margin-right:80px;">请遵守社区公约,最多可以输入<span style="color:red;">300</span>个字</h5><div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true"><form  method="post" action="<?php echo U('upload','','')?>"  enctype="multipart/form-data" ><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" 
	   data-dismiss="modal" aria-hidden="true">		  &times;
	</button><h4 class="modal-title" id="myModalLabel"><!--图片上传实时浏览的插件--><script>$(function () {
	$("#up").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120 });
});
</script><div id="main"><div class="card" id="up_img"><div class="summary"><div style=" width:120px; height:120px;"><img id="ImgPr" width="120" height="120" style="display: inherit;" /></div><input type="file" id="up" id="inputfile" name="photo1" /></div></div></h4></div><div class="modal-body"><div style="display:none"><input  name="photo3" value="1"></div><textarea name="photo2"  class="content form-control" id="content" onkeyup="checked_num(this,200)" style="width:100%;height:100px;float:left;margin-top:5px" placeholder="分享你关于梦想的思考[呵呵]"></textarea></div><div class="modal-footer"><button type="button" class="btn btn-default" 
	   data-dismiss="modal">关闭
	</button><button  type="button" class="btn btn-primary" id="pic_load">	 提交
	</button></div></div><!-- /.modal-content --></div><!-- /.modal --></form></div><div class="main_form"><form class="publish form" style="float:left;width:90%;" ><div id="result"></div><div class="form-group"><textarea class="content form-control" id="content"   onkeyup="checked_num(this,'450')"  style="width:100%;height:100px;float:left;margin-top:5px" placeholder="欢迎来社区吐槽哦！！"></textarea><br /></div><div class="bti"><!--原来 
						<input class="face btn btn-default" type="button" value="表情" />						原来/--><div  class="talk_top" ><a href="javascript:void(0)"><div data-toggle="modal" data-target="#myModal"><img class="talk_img" src="__PUBLIC__/res/images/small_pic/7.png"/><div class="talk_word">图文</div></div></a></div><!--修改--><div class="talk_top" data-toggle="modal" data-target="#myModal"><a href="javascript:void(0)"><div class="face"><img class="talk_img" src="__PUBLIC__/res/images/small_pic/0.gif"/><div class="talk_word">表情</div></div></a></div><!--修改/--><input style="float:right;margin-right:20px;margin-top:5px;width:100px;background:#52AA10;" class="submit btn btn-default" type="button" value="发布" /></div></form></div><script type="text/javascript">					$('body').delegate('.reply', {
						click : function(event){
						$(this).next('.comment_body').toggle();
						event.preventDefault();
					}
					});
					
					
					$('.submit').click(function(){
						if('<?php echo $_SESSION["user_id"];?>')//判断是否登陆
						{
							var login=1;
							
						}
						else
						{
							var login = 0;
						
						}
					
					
					
					
						if($(this).parents('form').find('.content').val()=="")
						{
							alert("不能为空！");
							
							
							
						}
						else
						{
							if(login==1)
							{
						//	alert("www");
							
							
								user_id = '<?php echo $_SESSION["user_id"]; ?>';
								//alert(user_id);
								url = '<?php	echo U("main_ajax") ?>';
								//alert(url);
								
								//alert($.cookie('community'))
								if($.cookie('community')>10)
								{
									alert("发言太频繁了,小呆萌忙不过来");
									return 0;
								}
								//一分钟只能发十次话
								content = $(this).parents('form').children(".form-group").find('.content').val();
								
										$.ajax({

										url:url,

										datatype:"json",

										type:"post",

										data:{id:user_id,content:content},//ajax取得评论的范围

										success:function(data)

										{
											if(!$.cookie('community'))
											{
											
												var cookietime = new Date();
												cookietime.setTime(cookietime.getTime() + (60*1000));
											
											
												$.cookie("community", "1",{expires:cookietime}); 
 
											}
												  
											else
											{
													
														var cookietime = new Date();
													cookietime.setTime(cookietime.getTime() + (60*1000));
													$.cookie('community',parseInt($.cookie('community'))+1,{expires:cookietime}); 
											}
											
												
											
											
											//防止灌水的标志
			
					
											window.location.replace(location.href);
											
											

										},

										error:function()

										{

											alert("error!");

										}

										});
										
								
							}
							else
							{
								alert("请先登陆");
							}
						}

					});
					
					
					

					</script></div><div class="main_nav"></div><div class="main_content"><div class="first_title"></div><div class="all_content" style="background:#EFF3EF" id="h_all_content"><!--三重嵌套--><?php if(is_array($main_community)): $i = 0; $__LIST__ = $main_community;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$main): $mod = ($i % 2 );++$i;?><div class="commuty panel panel-default" ><div class="info" style="min-height:150px;width:100px;margin-left:-3px;margin-top:-3px;"><a href="<?php echo U('/person/'.$main['user_id']);?>"><img src="__PUBLIC__/res/images/person_img/<?php echo ($main["person_img"]); ?>" class="commniuty_img img-circle" style="width:130px;height:130px;margin-top:10px;margin-left:5px;"/></a><a href="javascript:void(0)"><div class="niker" title="<?php echo ($main["niker"]); ?>"><?php echo ($main["niker"]); ?></div></a></div><div class="second_content"><div style="min-height:100px;"><div class="title">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($main["content"]); ?></div><div class="community_id" style="display:none;"><?php echo ($main["id"]); ?></div><?php if(empty($main['img'])): else: ?><div><img  style="margin-top:5px;" src="__PUBLIC__/res/images/community/<?php echo ($main["img"]); ?> " class="first_img "></div><?php endif; ?></div><!--  --><div class="" style="border-left:1px sold green;"><div class="main_time"><div style="margin-left:18px;margin-top:10px;"><?php echo ($main["time"]); ?></div></div><a href="javascript:void(0)"><span style="color: rgb(38, 200, 0); font-size: 21px;float:right"  from_id=<?php echo ($main["id"]); ?> class="glyphicon glyphicon-thumbs-up zan"><span class=""><?php echo ($main["prise"]); ?></span>赞</span></a><a href="javascript:void(0)"><span style="color: rgb(38, 200, 0);background:#ffffff; font-size: 21px;float:right;margin-right:30px;" id="pinglun" class="glyphicon glyphicon-pencil hid1">												评论												<span style="margin-left:-20px;padding: 0 8px;background:#ff6559;border-radius: 11px;font-size: 13px;color: #FFF;"><?php echo ($main["com_num"]); ?></span></span></a></div><div class="second"><div class="change"style="height:80px;"><form class="publish form" style="float:left;width:90%;" ><div id="result"></div><script language="javascript" type="text/javascript"></script><textarea class="content form-control" id="content" onkeyup="checked_num(this,400)" style="margin-left:35px;width:100%;height:100px;float:left;margin-top:5px" placeholder="分享你关于梦想的思考[呵呵]"></textarea><br /><button class="btn btn-default face" type="button" value=""  style="float:left;margin-left:50px;margin-top:5px;margin-bottom:10px;">表情</button><button class="btn btn-default second_submit" type="button"  from_id=<?php echo ($main["id"]); ?>  value="" style="float:left;margin-left:10px;margin-top:5px;">提交</button></form></div><?php if(is_array($second_community[$i-1])): $k = 0; $__LIST__ = $second_community[$i-1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$second): $mod = ($k % 2 );++$k;?><div class="person_community" style="margin-top:50px;"><img src="__PUBLIC__/res/images/person_img/<?php echo ($second["person_img"]); ?>" class="person_community_pic img-circle"/><div class="other_content"><div class="name"><?php echo ($second["niker"]); ?> 公开评论:</div><div class="community_id" style="display:none"><?php echo ($second["id"]); ?></div><div class="content_1"><?php echo ($second["content"]); ?></div><div class="botton"><div class="time"><?php echo ($second["time"]); ?></div><a href="javascript:void(0)"><div class="second_repay_content">回复</div></a></div></div></div><?php endforeach; endif; else: echo "" ;endif; ?></div></div><div class="nav"></div></div><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div><div class="col-lg-3"><div class="person img-circle"><?php if(empty($person_info)): ?><img class="img-circle" style="width:200px;height:200px;margin-top:10px;;" src="__PUBLIC__/res/images/person_img/person.png" /><?php else: ?><img class="img-circle" style="width:200px;height:200px;margin-top:10px;;" src="__PUBLIC__/res/images/person_img/<?php echo ($person_info[0]['img']); ?>" /><span class="person_niker" style="width:200px;" ><a href="javascript:void(0)" style="color:#808080;font-size:16px;"><?php echo ($person_info[0]['niker']); ?></a></span><?php endif; ?></div><div><div style="margin-top:120px;background:#ffffff;padding:5px;"><div class="huati_head"><h3><img src="__PUBLIC__/res/images/index/notice.png">公告栏</h3></div><div class="huati_body"><span class="top_hot_one" >#主人,我们等你很久了，呆萌社区正式公测,功能和页面正在美化和完善中。。。。。。。欢迎小伙伴们在社区撒欢，调戏，有什么好的建议和问题，联系小萌。QQ:3097645607</span><span style= "float:right;padding: 0 8px;border-radius: 11px;font-size: 13px;color: #808080;"></span><br></div></div></div><div class="top_hot"><div class="p-head"><h3 style="padding:0px;">					今日话题
				</h3></div><div class="p-body"><div class="shang"><div class="zuo"><img style="width:240px;" src="__PUBLIC__/res/images/community/<?php echo ($dm_today_topic[0]["img"]); ?>"></div><div class="you"><?php echo ($dm_today_topic[0]["content"]); ?></div><div style="height:20px;" class="you-hot"><div class="hot_com"><a href="javascript:void(0)" class="pl">评论(<?php echo ($topic_num); ?>)</a></div><div class="hot_prise" id=<?php echo ($dm_today_topic[0]["id"]); ?>><a  href="javascript:void(0)" >赞(<span id="prise_num"><?php echo ($dm_today_topic[0]["prise_num"]); ?></span>)</a></div></div></div><div class="xia"><div style="margin-top:20px;"><form role="form"><div class="form-group"><textarea  onkeyup="checked_num(this,256)" id="hot_t_c" class="form-control" rows="3" style="width:240px;"></textarea></div><div style="margin-left:80px;color:red;padding-bottom:10px" ><button type="button" style="width:70px;background:#52AA10" id="hot_t_p" class="btn btn-success ">评论</button></div></form><div style="margin-top:20px;display:none" id="hot_hid"><!--今天话题的循环输出--><div id="hot_content_f"><?php if(is_array($today_topic_child)): $i = 0; $__LIST__ = $today_topic_child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="width:250px;height:100px;;"><div class="panel-default"><?php echo ($vo["content"]); ?></div><div style="float:right">-----<?php echo ($vo["niker"]); ?></div></div><?php endforeach; endif; else: echo "" ;endif; ?></div><!--今天话题的循环输出--><button class="btn btn-success prev" style="background:#33A600;" id="0">上一页</button>							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button class="btn btn-success next" style="background:#33A600;">下一页</button></div></div></div></div></div><div class="huati"><div class="huati_head"><h3>热门话题</h3></div><div class="huati_body"><?php if(is_array($hot_topic_one)): $i = 0; $__LIST__ = $hot_topic_one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="top_hot_one" id="<?php echo ($vo["id"]); ?>" ><a href="#h_all_content"># <?php echo ((substr($vo["content"],0,30)."...")) ?></a></span><span style= "float:right;padding: 0 8px;border-radius: 11px;font-size: 13px;color: #808080;"><?php echo ($vo["com_num"]); ?></span><br><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div></div><div class="col-lg-1"></div></div><!--包含底部文件的渲染--><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><div class="footer"><div class="footer1" style="height:200px;width:100%;float:left;padding:0px;margin:0px;background: url('__PUBLIC__/res/images/small_pic/ft_bj.png') no-repeat;"><a class="start_it" href="<?php echo U('/start/agreement','','');?>"><img src="__PUBLIC__/res/images/small_pic/start_it.png" style='margin-top:20px;' ></a></div><div id='backtotop'></div><div class="footer2"><div class="intro" ><span ><a href="<?php echo U('/help','','');?>" target="_blank">关于呆萌</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">洽谈合作</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">加入我们</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">联系我们</a></span>|

  	 			<span><a href="<?php echo U('/help/127','','');?>" target="_blank">免责声明</a></span>|

  	 			 <p>Copyright © 2014 呆萌网 www.daymeng.com<br><a href="http://www.miitbeian.gov.cn" style="color:#474e5d">湘ICP备09043258号-2</a> 湖南橙讯科技有限公司 版权所有 <span style="font-size:12px;color:#474e5d">投资有风险，购买需谨慎</span></p></div><div class="calls"><ul ><li><img  style='width:120px;' src="__PUBLIC__/res/images/small_pic/tow_code.jpg" class="tow_code"></li><li><img class="mcalls wx"  src="__PUBLIC__/res/images/small_pic/wx.png"><span class='wx' style='color:#fff;padding-left:5px;'>官方微信</span></li><li><a href="http://weibo.com/u/5240303575" target='_blank'><img class="mcalls" src="__PUBLIC__/res/images/small_pic/sina.png"><span style='color:#fff;padding-left:5px;cursor:pointer;'>官方微博</span></a></li><li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=521187146&amp;site=qq&amp;menu=yes"><img src="__PUBLIC__/res/images/small_pic/kefu.png"></a><span style='color:#fff;padding-left:5px;cursor:pointer;'>在线客服</span></li><!-- 百度统计 --><div style='display:none;'><script type="text/javascript">              var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

              document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F86c414347828cadccc690dd5e0ddd83e' type='text/javascript'%3E%3C/script%3E;"));

              </script></div></ul></div></div></div><!--  <div class="row" ><div class="col-lg-4 "></div><div class="col-lg-2"><a href="<?php echo U('startitem/index');?>"><img src="__PUBLIC__/res/images/small_pic/project.png" style="margin-top:50px;"></a></div><div class="col-lg-3  yxs_change"><div class="row"><div class="col-lg-6 "><img class="tubiao"  src="__PUBLIC__/res/images/small_pic/wx.png"><span >关注微信</span><img src="__PUBLIC__/res/images/small_pic/wx1.png"></div><div class="col-lg-6 "><img class="tubiao" src="__PUBLIC__/res/images/small_pic/wb.png"><span >关注微博</span><a target="_blank" href="http://weibo.com/5240303575/profile?rightmod=1&wvr=5&mod=personinfo"><img  src="__PUBLIC__/res/images/small_pic/wb1.png"></a><p class="address">weibo.stm.com</p></div></div></div><div class="col-lg-3  _email yxs_change"><div class="col-lg-6 "><p>联系邮箱</p><a href="http://mail.163.com/"><img src="__PUBLIC__/res/images/small_pic/email.png">daymeng@163.com</a></div></div></div> --></body></html>