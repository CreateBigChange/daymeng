$(document).ready(function(){
sing= 1;
topic_sign =0;
$(".pl").click(function()
		{
			$("#hot_hid").slideToggle();
		}
	)
	//上一页
	

	
	
	function com(obj){
		id=obj;
		
		
		//alert(topic_today);
		//alert(id);
		if(topic_sign ===1)
		{
			$(".commuty").first().remove();
		}
			$.ajax({
			url:topic_today,
			datatype:"json",
			type:"post",
			data:{id:id},//ajax取得评论的范围
			success:function(data)
				{	
							
								text="";
					
								text+='	<div class="commuty panel panel-default">';
								text+='		<div class="info">';
								text+='		<img src="/Public/res/images/person_img/'+data[0][0]["person_img"]+'" style="width:100px;height:100px;" class="commniuty_img img-circle"/>';
								text+='		<div class="niker">'+data[0][0]["niker"]+'</div>';
								text+='	</div>';
								text+='	<div class="second_content"><div style="height:300px">';
								text+='	<div class="community_id">'+data[0][0]["id"]+'</div>';
																if(!data[0][0]["img"]){}
																else
																{
																	text+='<div ><img src="/Public/res/images/community/'+data[0][0]["img"]+'" class="first_img "></div>';
																}
								text+='			<div class="title">'+data[0][0]["content"]+'</div>';	
								text+='			</div><div class="">';
								text+='				<div class="main_time">'+data[0][0]["time"]+'</div>';
								text+='				<a href="javascript:void(0)"><span style="color: rgb(38, 200, 0); font-size: 21px;float:right"  from_id='+data[0][0]["id"]+' class="glyphicon glyphicon-thumbs-up zan"><span class="">'+data[0][0]["prise"]+'</span>赞</span></a>';
								text+='				<a href="javascript:void(0)"><span style="color: rgb(38, 200, 0); font-size: 21px;float:right;margin-right:30px;" id="pinglun" class="glyphicon glyphicon-pencil hid" >';
								text+='评论<span style="margin-left:0px;padding: 0 8px;background:#ff6559;border-radius: 11px;font-size: 13px;color: #FFF;">'+data[0][0]["com_num"]+'</span>';
												
								text+='			</span></a></div>';
								
								
								text+='			<div class="second" >';		
								text+='				<div class="change" style="height:80px;">';
								text+='					<form class="publish form" style="float:left;width:90%;" >';
								text+='					<div id="result"></div>';
								text+='					<textarea onkeyup="checked_num(this,400)" class="content form-control" id="content" style="width:100%;height:100px;float:left;margin-top:5px" placeholder="分享你关于梦想的思考[呵呵]"></textarea><br />';
								text+='					<input class="face" type="button" value="表情" />';
								text+='					<input class="second_submit" data1='+data[0][0]["id"]+' type="button" value="提交" />';
								text+='					</form>';
								text+='				</div>';
								//text+='				</div>';
									for(j=0;j<data[1][0].length;j++)
									{
										text+='				<div class="person_community" style="margin-top:50px;">';
										text+='					<img src="/Public/res/images/person_img/'+data[1][0][j]["person_img"]+'"  class="person_community_pic img-circle"/>';
										text+='					<div class="other_content">';
										text+='						<div class="name">'+data[1][0][j]["niker"]+' 公开评论:</div>';
										text+='						<div class="community_id">'+data[1][0][j]["id"]+'</div>';
										text+='						<div class="content_1 "> '+data[1][0][j]["content"]+'</div>';
										text+='						<div class="botton">';
										text+='							<div class="time">'+data[1][0][j]["time"]+'</div>';
										text+='							<a href="javascript:void(0)"><div class="second_repay_content">回复</div></a>';
										text+='						</div>';
										text+='					</div>';
										text+='				</div>';
									}
									text+='	<div class="hiden"></div>';

									text+='</div>';
									text+='</div>';
									text+='<div class="nav"></div>';
									text+='</div>';
									
									$(".all_content").prepend(text);
									////////////////////////////////给话题加事///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									
									
						$(".zan").unbind("click");
								
						$(".zan").click(function(){
							from_id=$(this).attr("from_id");
							if(localStorage[from_id]==1)
							{
								alert("请不要重复点赞")
								localStorage[from_id]=1;
								return ;
							}
								localStorage[from_id]=1;
									//if(localStorage.from_id==1)
									
									$(this).children().text(parseInt($(this).children().text())+1);
					
								$.ajax({
									url:zan_ajax,
									datatype:"json",
									type:"post",
									data:{from_id:from_id},//ajax取得评论的范围
									success:function(data)
									{
										if(data==0)
										{
											alert("数据插入失败");
											$(this).children().text(parseInt($(this).children().text())-1);
										}
									},
									error:function()
									{
										alert("error!");
										$(this).children().text(parseInt($(this).children().text())-1);
									}
								});
							})
									
									
							$(".title").parseEmotion();
								$(".content_1").parseEmotion();
								$(".hid").unbind();
								$(".hid").click(function(){
									$(this).parent().parent().next(".second").toggle();
								})
								
								
								
								
								
								
								
								
								
								
														//评论的ajax
						$(".second_submit").unbind();
						$(".second_submit").click(function(){
						if($(this).parents('form').find('.content').val()=="")
						{
							alert("不能为空！");
						}
						else
						{
							if(login==1)
							{
		
							from_id=$(this).attr("data1");
							$.ajax({
								url:second_ajax,
								datatype:"json",
								type:"post",
								data:{id:"1",content:$(this).parents('form').find('.content').val(),from_id:from_id},//ajax取得评论的范围
								success:function(data)
								{
									//alert(data);
									window.location.replace(location.href);
									//alert("success")
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

})									
								//点击收放
							

//插件的使用
						$('.face').bind({
						click: function(event){
						if(! $('#sinaEmotion').is(':visible')){
						$(this).sinaEmotion();
						event.stopPropagation();
						}
						}
						});
								
								
								
								
								
								topic_sign =1;//记录是不是第一次话题	
									
									////////////////////////////////给话题加事///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								
				},
			error:function(){
					alert("error");
				}
				
			});
			
		
		
	}
	
		$(".top_hot_one").click(function(obj){
			com($(this).attr("id"))
	})
	
	function next_info(obj)
	{
		//ajax   寻找一页的评论		
		id = obj;//页的id
		topic_id //今日话题的id
		//alert(next_y);
		$.ajax({
			url:next_y,
			datatype:"json",
			type:"post",
			data:{topic_id:topic_id,id:id},//ajax取得评论的范围
			success:function(data)
				{
					//window.location.replace(location.href);
					//alert("ok");
					
					//alert(data[0]["content"]);
						text = "";
					for(i=0;i<data.length;i++)
					{
					
						text+='			<div style="width:250px;height:100px;;">';
						text+='				<div class="panel-default">';
						text+='					'+data[i]["content"];
						text+='				</div>';
						text+='				<div style="float:right">-----'+data[i]["niker"]+'</div>';
						text+='			</div>';
					}
					$("#hot_content_f").empty();
					//alert(text);
					$("#hot_content_f").append(text);
				
				},
			error:function(){
				
				}
				
			});
			
	}
	$(".prev").click(function(){
	
		if($(".prev").attr("id")==0)
		{
			alert("已经是第一页了！")
			return 0;
		}
			
			next_info($(".prev").attr("id"));
			$(".prev").attr("id",parseInt($(".prev").attr("id"))-1);
		
	})
	$(".next").click(function(){

	if((parseInt($(".prev").attr("id"))+1)*5>hot_num)
		{
			alert("已经是最后一页了！")
			return 0;
		}
			next_info($(".prev").attr("id"));
			$(".prev").attr("id",parseInt($(".prev").attr("id"))+1);
		
	})
	
	//下一页

	//对今日话题的评论
	$("#hot_t_p").click(function(){
		content = $("#hot_t_c").val();		//获取 content
		//alert(content);
		father_id = $(".hot_prise").attr("id")	//获取 fatherid
	//	alert(father_id);
		//alert(login);
		//alert(hot_t_p);
		if(login!==1)
		{
			alert("请先登录");
			return 0;
		}
		
		$.ajax({
			url:hot_t_p,
			datatype:"json",
			type:"post",
			data:{father_id:father_id,content:content},//ajax取得评论的范围
			success:function(data)
				{
					window.location.replace(location.href);
					//alert("ok");
				},
			error:function(){
				//$("#prise_num").text(parseInt($("#prise_num").text())-1);
				//alert("error");
				}
			});
		
	})
	//对今日话题的评论
$(".hot_prise").click(function(){

if(localStorage["topic_hot"+$(this).attr("id")]==1)
{
	alert("请不要重复点赞哦！！");
	return 0
}
id=$(this).attr("id");
$("#prise_num").text(parseInt($("#prise_num").text())+1);
localStorage["topic_hot"+$(this).attr("id")]=1;
								$.ajax({
									url:hot_zan_ajax,
									datatype:"json",
									type:"post",
									data:{id:id},//ajax取得评论的范围
									success:function(data)
									{
										//alert("ok");
									},
									error:function(){
										$("#prise_num").text(parseInt($("#prise_num").text())-1);
										//alert("error");
									}
								});
								
})
num=0;
	var sign_k=1;
      obj1= setInterval(function(){
		sign_k=1
		//alert(sign_k);
	  },2000);//1000为1秒钟
//评论的下标的变化1
//给评论加赞的ajax
$(".zan").click(function(){
							from_id=$(this).attr("from_id");
							
							if(localStorage[from_id]==1)
							{
								alert("请不要重复点赞")
								localStorage[from_id]=1;
								return ;
							}
								localStorage[from_id]=1;
									//if(localStorage.from_id==1)
									
									$(this).children().text(parseInt($(this).children().text())+1);
					
								$.ajax({
									url:zan_ajax,
									datatype:"json",
									type:"post",
									data:{from_id:from_id},//ajax取得评论的范围
									success:function(data)
									{
										if(data==0)
										{
											alert("数据插入失败");
											$(this).children().text(parseInt($(this).children().text())-1);
										}
									},
									error:function()
									{
										alert("error!");
										$(this).children().text(parseInt($(this).children().text())-1);
									}
								});
})
$(".zan").mouseout(function(){
alert(this.attr("src"));
	this.src=this.src.replace(/zan1.png/,"zan.png");
	alert(this.src);
})
$(".zan").mouseover(function(){
alert(this.attr("src"));
this.src=this.src.replace(/zan.png/,"zan1.png");

})
//评论的下标的变化3
$(".pinglun").mouseover(function(){
	this.src=this.src.replace(/pinglun.png/,"pinglun1.png");
})
$(".pinglun").mouseout(function(){
	this.src=this.src.replace(/pinglun1.png/,"pinglun.png");
})

/////////////////////////////////////////////////////////////////
//已加载的所有的评论表情化
page=0; //无限下拉的标记
$("#pic_load").click(function(){
	if(login==1)
	{
	
			if($.cookie('community')>10)
		{			
			alert("发言太频繁了,小呆萌忙不过来");
			return 0;
		}
		
		
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
		$(this).parents("form").submit();
	}
	else
	alert("请先登陆！");
})
$(".title").parseEmotion();
$(".content_1").parseEmotion();
$(".hid1").click(function(){
$(this).parent().parent().next().fadeToggle();
});

$('.face').bind({
click: function(event){
			if(! $('#sinaEmotion').is(':visible')){
		$(this).sinaEmotion();
				event.stopPropagation();
				}
			}
		});
		
//给第二评论加ajax提交
$(".second_submit").click(function(){
						if($(this).parents('form').find('.content').val()=="")
							alert("不能为空！");
						else
							{
								if(login==1)
								{
								
								from_id = $(this).attr("from_id");
								if($.cookie('community')>10)
								{
									alert("发言太频繁了,小呆萌忙不过来");
									return 0;
								}
								$.ajax({
									url:second_ajax,
									datatype:"json",
									type:"post",
									data:{id:"1",content:$(this).parents('form').find('.content').val(),from_id:from_id},//ajax取得评论的范围
									success:function(data)
									{
										
										if(!$.cookie('community'))
										{
												var cookietime = new Date();
												cookietime.setTime(cookietime.getTime() + (60 *  1000));//coockie保存一小时
												$.cookie("community", "1",{expires:cookietime}); 
										}
											else
												$.cookie('community',parseInt($.cookie('community'))+1); 
											
											
											//防止灌水的标志
										
										window.location.replace(location.href);
										//alert("success")
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

})
//无限下拉


$(window).bind("scroll", function(){ 
//当滚动条滚动时

if($(document).height()-$(window).height()-$(document).scrollTop()<=100)
{
			if(sign_k==1){
							num++;
							text="";
							$.ajax({
							url:community,
							datatype:"json",
							type:"post",
							data:{page:page*3+5},//ajax取得评论的范围
							success:function(data)
							{
								//alert(data[0][0]["person_img"]);
								//window.location.replace(location.href);
								//alert("success")
								/*************/
								
								//无限下拉的文本
								for(i=0;i<data[0].length;i++)
								{
								text+='	<div class="commuty panel panel-default">';
								text+='		<div class="info">';
								text+='		<img src="/Public/res/images/person_img/'+data[0][i]["person_img"]+'" style="width:100px;height:100px;" class="commniuty_img img-circle"/>';
								text+='		<div class="niker">'+data[0][i]["niker"]+'</div>';
								text+='	</div>';
								text+='	<div class="second_content"><div style="min-height:100px">';
								text+='	<div class="community_id">'+data[0][i]["id"]+'</div>';
																if(!data[0][i]["img"]){}
																else
																{
																	text+='<div ><img src="/Public/res/images/community/'+data[0][i]["img"]+'" class="first_img "></div>';
																}
								text+='			<div class="title">'+data[0][i]["content"]+'</div>';	
								text+='			</div><div class="">';
								text+='				<div class="main_time">'+data[0][i]["time"]+'</div>';
								text+='				<a href="javascript:void(0)"><span style="color: rgb(38, 200, 0); font-size: 21px;float:right"  from_id='+data[0][i]["id"]+' class="glyphicon glyphicon-thumbs-up zan"><span class="">'+data[0][i]["prise"]+'</span>赞</span></a>';
								text+='				<a href="javascript:void(0)"><span style="color: rgb(38, 200, 0); font-size: 21px;float:right;margin-right:30px;" id="pinglun" class="glyphicon glyphicon-pencil hid" >';
								text+='	评论<span style="margin-left:0px;padding: 0 8px;background:#ff6559;border-radius: 11px;font-size: 13px;color: #FFF;">'+data[0][i]["com_num"]+'</span>';
								text+='</span></a>';
								text+='			</div>';
								text+='			<div class="second" >';		
								text+='				<div class="change" style="height:80px;">';
								text+='					<form class="publish form" style="float:left;width:90%;" >';
								text+='					<div id="result"></div>';
								text+='					<textarea onkeyup="checked_num(this,400)" class="content form-control" id="content" style="width:100%;height:100px;float:left;margin-top:5px" placeholder="分享你关于梦想的思考[呵呵]"></textarea><br />';
								text+='					<input class="face" type="button" value="表情" />';
								text+='					<input class="second_submit" data1='+data[0][i]["id"]+' type="button" value="提交" />';
								text+='					</form>';
								text+='				</div>';
								//text+='				</div>';
									for(j=0;j<data[1][i].length;j++)
									{
										text+='				<div class="person_community" style="margin-top:50px;">';
										text+='					<img src="/Public/res/images/person_img/'+data[1][i][j]["person_img"]+'"  class="person_community_pic img-circle"/>';
										text+='					<div class="other_content">';
										text+='						<div class="name">'+data[1][i][j]["niker"]+' 公开评论:</div>';
										text+='						<div class="community_id">'+data[1][i][j]["id"]+'</div>';
										text+='						<div class="content_1 "> '+data[1][i][j]["content"]+'</div>';
										text+='						<div class="botton">';
										text+='							<div class="time">'+data[1][i][j]["time"]+'</div>';
										text+='							<a href="javascript:void(0)"><div class="second_repay_content">回复</div></a>';
										text+='						</div>';
										text+='					</div>';
										text+='				</div>';
									}
									text+='	<div class="hiden"></div>';

									text+='</div>';
									text+='</div>';
									text+='<div class="nav"></div>';
									text+='</div>';
								}
								/*************/
								$(".all_content").append(text);
								//给无限下拉的东西加事件
								
								$(".title").parseEmotion();
								$(".content_1").parseEmotion();
								
								$(".hid").unbind();
								$(".hid").click(function(){
									$(this).parent().parent().next(".second").toggle();
								})
								
								
								$(".zan").unbind("click");
								
						$(".zan").click(function(){
							from_id=$(this).attr("from_id");
							if(localStorage[from_id]==1)
							{
								alert("请不要重复点赞")
								localStorage[from_id]=1;
								return ;
							}
								localStorage[from_id]=1;
									//if(localStorage.from_id==1)
									
									$(this).children().text(parseInt($(this).children().text())+1);
					
								$.ajax({
									url:zan_ajax,
									datatype:"json",
									type:"post",
									data:{from_id:from_id},//ajax取得评论的范围
									success:function(data)
									{
										if(data==0)
										{
											alert("数据插入失败");
											$(this).children().text(parseInt($(this).children().text())-1);
										}
									},
									error:function()
									{
										alert("error!");
										$(this).children().text(parseInt($(this).children().text())-1);
									}
								});
})
								
								
								
								
								
								
								


								
						//评论的ajax
						$(".second_submit").unbind();
						$(".second_submit").click(function(){
						if($(this).parents('form').find('.content').val()=="")
						{
							alert("不能为空！");
						}
						else
						{
							if(login==1)
							{
		
							from_id=$(this).attr("data1");
							$.ajax({
								url:second_ajax,
								datatype:"json",
								type:"post",
								data:{id:"1",content:$(this).parents('form').find('.content').val(),from_id:from_id},//ajax取得评论的范围
								success:function(data)
								{
									//alert(data);
									window.location.replace(location.href);
									//alert("success")
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

})									
								//点击收放
							

//插件的使用
						$('.face').bind({
						click: function(event){
						if(! $('#sinaEmotion').is(':visible')){
						$(this).sinaEmotion();
						event.stopPropagation();
						}
						}
						});
								
						page++;
							},
							error:function()
							{
								alert("error!");
							}
						});
//alert("www");
			sign_k=0;
			}

}
}); 
$("#pinglun").mouseover(function(){
	$(this).css("src","./sdas")
})
});

