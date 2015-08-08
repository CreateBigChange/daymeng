$(document).ready(function(){
//评论的下标的变化1
$(".zan").mouseover(function(){
	this.src=this.src.replace(/zan.png/,"zan1.png");
})
$(".zan").mouseout(function(){
	this.src=this.src.replace(/zan1.png/,"zan.png");
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
	$(this).parents("form").submit();
	else
	alert("请先登陆！");
})
$(".title").parseEmotion();
$(".content_1").parseEmotion();
$(".hid1").click(function(){
$(this).next().fadeToggle();
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
								from_id=$(this).parent("form").parent(".change").parent(".second").siblings(".community_id").text();
								$.ajax({
									url:second_ajax,
									datatype:"json",
									type:"post",
									data:{id:"1",content:$(this).parents('form').find('.content').val(),from_id:from_id},//ajax取得评论的范围
									success:function(data)
									{
										alert(data);
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
								text+='		<img src="/public/res/images/person_img/'+data[0][i]["person_img"]+'" class="commniuty_img img-circle"/>';
								text+='		<div class="niker">'+data[0][i]["niker"]+'</div>';
								text+='	</div>';
								text+='	<div class="panel panel-default second_content">';
								text+='	<div class="community_id">'+data[0][i]["id"]+'</div>';
																if(!data[0][i]["img"]){}
																else
																{
																	text+='<div ><img src="/public/res/images/community/'+data[0][i]["img"]+'" class="first_img "></div>';
																}
								text+='			<div class="title">'+data[0][i]["content"]+'</div>';
								text+='			<div class="hid">';
								text+='				<div class="main_time">'+data[0][i]["time"]+'</div>';
								text+='				<a href="javascript:void(0)"><img class="small_pic zan" id="zan" src="/public/res/images/small_pic/zan.png"/></a>';
								text+='				<a href="javascript:void(0)"><img class="small_pic pinglun" id="pinglun" src="/public/res/images/small_pic/pinglun.png"/></a>';
								text+='			</div>';
								text+='			<div class="second" >';		
								text+='				<div class="change">';
								text+='					<form class="publish form" style="float:left;width:90%;" >';
								text+='					<div id="result"></div>';
								text+='					<textarea class="content form-control" id="content" style="width:100%;height:100px;float:left;margin-top:5px" placeholder="分享你关于梦想的思考[呵呵]"></textarea><br />';
								text+='					<input class="face" type="button" value="表情" />';
								text+='					<input class="second_submit" type="button" value="提交" />';
								text+='					</form>';
								text+='				</div>';
								//text+='				</div>';
									for(j=0;j<data[1][i].length;j++)
									{
										text+='				<div class="person_community" style="margin-top:50px;">';
										text+='					<img src="/public/res/images/person_img/'+data[1][i][j]["person_img"]+'" class="person_community_pic img-circle"/>';
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
								//表情化
								$(".zan").mouseover(function(){
								this.src=this.src.replace(/zan.png/,"zan1.png");
								})
								$(".zan").mouseout(function(){
								this.src=this.src.replace(/zan1.png/,"zan.png");
								})

								//评论的下标的变化3
								$(".pinglun").mouseover(function(){
								this.src=this.src.replace(/pinglun.png/,"pinglun1.png");
								})
								$(".pinglun").mouseout(function(){
								this.src=this.src.replace(/pinglun1.png/,"pinglun.png");
								})

								$(".title").parseEmotion();
								$(".content_1").parseEmotion();
								
								$(".hid").unbind();
								$(".hid").click(function(){
									$(this).next(".second").toggle();
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
							from_id=$(this).parent("form").parent(".change").parent(".second").siblings(".community_id").text();
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
}
}); 
$("#pinglun").mouseover(function(){
	$(this).css("src","./sdas")
})
});

