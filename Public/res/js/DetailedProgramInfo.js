$(document).ready(function(){//jqurey格式
//如果check=0或者3则变黑
$(".login_1").click(function(){
	$("#t_login").click();
})
$("#change_change").click(function(){
					$.ajax({
					url:chang_ajax,
					type:"post",
					dataType:"json",
					data:{},
					success:function(product)
					{	text="";
						for(i=0;i<=3;i++)
						{


				text+='	<div style="background: none repeat scroll 0 0 #fff;box-shadow: 0 3px 3px #e5e5e5;float: left;height: 380px;margin-bottom: 20px;margin-left: 30px;overflow: hidden; width: 235px;">';
				text+='	<a href="/index.php/detail/index.php?item_id='+product[i]["id"]+'"><img src="/Public/res/images/Items/'+product[i]["items_img"]+'" style="width:235px;height:235px;"/></a>';
				text+='	<div STYLE="height:40px;overflow:hidden">'+product[i]["title"]+'</div>';
				text+='	<div class="row">';
				text+='		<div class="col-lg-8" style="padding:0px">';
				text+='			<div style="margin-top:12px;margin-left:5px;background: url('+"'/Public/res/images/small_pic/icon-progress.gif'"+') 0px 0px ;height:8px;width:100%;"><div style="float:right;height:8px;width:'+(100-product[i]["percent"])+'%;background:#DEE3E7"></div></div>';
				text+='		</div>';
				text+='		<div class="col-lg-4" style="padding:0px">';
				text+='			<img style="float:left" src="/Public/res/images/small_pic/button.png">';
				text+='		</div>';
				text+='	</div>';
				text+='	<div class="row" style="font_size:8px;margin-top:5px;margin-left:3px;padding:0px;">';
				text+='		<div class="col-lg-4" style="padding:0px;">'+product[i]["percent"]+'%<br>已达</div>';
				text+='		<div class="col-lg-4" style="padding:0px;">￥'+product[i]["gain"]+'<br>已达</div>';
				text+='		<div class="col-lg-4" style="padding:0px;">'+product[i]["remain_time"]+'天<br>剩余时间</div>';
				text+='	</div>';
				text+='	<div>';
				text+='		<div style="float:right	;margin-top:15px;margin-right:15px"> ';
				text+='			支持:'+product[i]["sup"]+'&nbsp;关注:'+product[i]["attention"]+' &nbsp;赞'+product[i]["prise"]+'';
				text+='		</div>';
				text+='	</div>';
				text+='</div>';
						}
						

				$(".button").empty();
				//alert(text);
				$(".button").append(text);
					},
					error:function()
					{
						alert("ajax 失败");
					}
					})

})
			//分类里面的左右变换
$("._left").click(function(){
	
	if($(this).next().children("a").text()==1)
	alert("已是第一页");
	else
	{
		//在底下的数字加减
	$(this).next().children("a").text(parseInt($(this).next().children("a").text())-5);
	$(this).next().next().children("a").text(parseInt($(this).next().next().children("a").text())-5);
	$(this).next().next().next().children("a").text(parseInt($(this).next().next().next().children("a").text())-5)
	$(this).next().next().next().next().children("a").text(parseInt($(this).next().next().next().next().children("a").text())-5);
	$(this).next().next().next().next().next().children("a").text(parseInt($(this).next().next().next().next().next().children("a").text())-5);
	}


});
$("._right").click(function(){
//在底下的数字加减
	$(this).prev().children("a").text(parseInt($(this).prev().children("a").text())+5);
	$(this).prev().prev().children("a").text(parseInt($(this).prev().prev().children("a").text())+5);
	$(this).prev().prev().prev().children("a").text(parseInt($(this).prev().prev().prev().children("a").text())+5)
	$(this).prev().prev().prev().prev().children("a").text(parseInt($(this).prev().prev().prev().prev().children("a").text())+5);
	$(this).prev().prev().prev().prev().prev().children("a").text(parseInt($(this).prev().prev().prev().prev().prev().children("a").text())+5);
});
		//加为好友的ajax
	$("#msg_send").click(function(){
		sender_id=$(this).attr("sender_id");
		content=$("#cnt").val();
		if($("#cnt").val()=="")
		{
			alert("内容不能为空!");
		}
		else
		{
					$.ajax({
					url:send_msg_ajax,
					type:"post",
					dataType:"json",
					data:{sender_id:sender_id,content:content},//传入好友的id
					success:function(product)
					{
						
						if(product==0)
						{
							//alert("请先登陆!");
							$("#t_login").click();
						}
						else
						{
							//alert("成功");
						}
						
					},
					error:function()
					{
						//alert("ajax 失败");
					}
					})
		}
	});

		$("#add_friend").click(function(){
				friend_id = $(this).attr("friend_id");
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
		//实现关注和赞的ajax
		 function detail_ajax(id,func)
		{

			//alert(func);
			//alert(id);

				$.ajax({
					url:opinion_url,
					type:"post",
					dataType:"json",
					data:{items_id:id,title:func},//id 项目id func传入是哪种参数
					success:function(data)
					{
						if(data==1)
						{
							localStorage[id+"attention"]=0;
							$("#"+func).text(($("#"+func).text().replace(/\d+/,parseInt($("#"+func).text().match(/\d+/))-1)));//关注或者赞之后的页面及时更新
							$("#t_login").click();
						}
						else
						{

							if(data==0)
							{

								$("#"+func).text(($("#"+func).text().replace(/\d+/,parseInt($("#"+func).text().match(/\d+/))-1)));//关注或者赞之后的页面及时更新
								alert("请不要重复关注");
							}

						}
						
					},
					error:function()
					{
							
							localStorage[id+"attention"]=0;
							$("#"+func).text(($("#"+func).text().replace(/\d+/,parseInt($("#"+func).text().match(/\d+/))-1)));//关注或者赞之后的页面及时更新
							//$("#t_login").click();
							alert("服务器错误");
					}
					})
			

		}
		function getLocalTime(nS) {
			return new Date(parseInt(nS) * 1000).toLocaleString().substr(0,17)
			} 

		//反馈活动里卖的图片放大功能
		var sign=0;
		$(".pic").click(function(){
		var link=$(this).attr("src");
		//alert(link);
		//link=link.match(/\w+\.[a-z]+/);
		var text='<div id="pic" style="position:fixed;left:300px;top:100px;width:322px;height:430px" ><a href="javascript:void(0)"><img id="pic_del" style="position: fixed;left:300px;top:100px;"'; 
		text+='src="/Public/res/images/small_pic/x.png"></a><img style="width:400px;" src="'+link+'" /> </div>';
		if(sign==0)
		{
			$("body").append(text);
			sign=1;
			
			$("#pic_del").click(function(){
			$("#pic").remove();
			sign=0;
		})
		}
		else
		{
			$("#pic").remove();
			$("body").append(text);
			$("#pic_del").click(function(){
			$("#pic").remove();
			sign=0;
		})
		}
		});

function getck(objname){
  var ck=document.cookie.split(';');
for(var i=0;i<ck.length;i++){
  temp=ck[i].split("=");
   // alert("!"+temp[0].substr(1)+"...."+objname+temp[1])
  if(temp[0].substr(1)==objname) return unescape(temp[1]);
}
}
		//点击支持和赞的时候ajax调用关注要登录
		$("#attention").click(function(){

		//localStorage[$("#itemId").text()+"attention"]=0;
				if(localStorage[$("#itemId").text()+"attention"]==1)
				{
					alert("请不要重复关注");
					return 0;
				}
			//alert($("#itemId").text()+"attention");
			localStorage[$("#itemId").text()+"attention"]=1;
			//alert(localStorage[$("#itemId").text()+"attention"]);
			$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/))+1)));//关注或者赞之后的页面及时更新
			detail_ajax($("#itemId").text(),$(this)[0].id);		
			
		}
		);
		//点击支持和赞的时候ajax调用支持cookie相同不可以重复

	$("#prise").click(function(){

			//alert("1");
				//localStorage[$("#itemId").text()+"prise"]=0;
			if(localStorage[$("#itemId").text()+"prise"]==1)
				{
					alert("请不要重复点赞");
					return 0;
				}
			//alert($("#itemId").text()+"attention");
			localStorage[$("#itemId").text()+"prise"]=1;
			//alert("2");
				 if(getck("prise"+$("#itemId").text()))
				 {
				 	alert("请不要重复点赞");
				 	return 0;
				 }
			
			 // alert($("#itemId").text());
			// setc("prise"+$("#itemId").text(),$("#itemId").text(),36500);
			 // alert("prise"+$("#itemId").text());
			// alert(getck("prise"+$("#itemId").text()));
			$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/))+1)));//关注或者赞之后的页面及时更新
		
			
			//alert(prise_ajax);
			//alert($("#itemId").text());
			
			$.ajax({
				url:prise_ajax,
				datatype:"json",
				type:"post",
				data:{id:$("#itemId").text()},
				success:function(data)
				{
					
				},
				error:function()
				{
					alert("数据加载失败");
					$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/))-1)));//关注或者赞之后的页面及时更新

				}

			})




			/*
			$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/))+1)));//关注或者赞之后的页面及时更新
			detail_ajax($("#itemId").text(),$(this)[0].id);
		
			*/
			

		}
		)
		
		//点击话题的时候调用ajax
		$(".topic").click(function()
		{
			//alert($("#itemId").text());
			$.ajax({
			url:topicAjax,
			datatype:"json",
			type:"post",
			data:{id:$("#itemId").text(),begin:0},
			success:function(data)
			{
			//alert("success");
			//alert(data.length);
			var text=" ";
			$(".add").empty();
			
			for(var i=0;i<data.length;i++)
			{
			//alert(person_center);
			//alert(data[i]["id"]);
			myperson=person_center+'/'+data[i]["id"];//前往他人的个人中心的路径
			//	alert(myperson)
				//alert(data[i]["img"]);
				text +='<div class="row detel" style="height:130px;" >';
				text +='<div class="col-md-2 col-lg-2" style="height:115px;padding:0px;">';
				text +='<a href='+myperson+'><img src="/Public/res/images/person_img/'+data[i]["img"]+'" class="img-circle" style="width:80px;height:80px;margin-left:30px;margin-top:10px;"></a>';
				text +='</div>';
				text +='<div class="col-md-9 col-lg-9" style="height:115px;">';
				text +='<div>';
				text +='<span style="font-size:10px;"><span style="float:left;"><strong>'+data[i]["niker"]+'&nbsp&nbsp&nbsp&nbsp </strong></span><span style="float:left">'+getLocalTime(data[i]["time"])+'前</span><span style="float:right;"></span></span>';
				text +='<div class="result" style="overflow:hidden;color:#666666;font-weight:100;width:100%;height:80px;border:1px #E7EBEF solid;float:left;font-size:14px;line-height:20px;font-family:"Microsoft Yahei","微软雅黑",Arial,"Hiragino Sans GB","宋体";" >'+data[i]["content"];
				text +='</div>';
				text +='<span style="float:right;"><a class="comment_prise" href="javascript:void(0)" topic_id='+data[i]["comment_id"]+'><img class="dzan" src="/Public/res/images/small_pic/dzan.png" style="width:25px;"></a>(<span>'+data[i]["prise_number"]+'</span>)</span>';
				text +='</div>';
				text +='</div>';
				text +='</div>';
				//text +='<div style="width:90%;height:1px;background-color:#DEDBDE"> </div>';
			}

			$(".add").append(text);
			//$(".result").parseEmotion();
			//
			//给赞加事件
			$(".dzan").mousemove(function(){

				$(this).attr("src","/Public/res/images/small_pic/dzan1.png");
			$(".dzan").mouseout(function(){

				$(this).attr("src","/Public/res/images/small_pic/dzan.png");
			})
			})
			//给赞家ajax
			$(".comment_prise").click(function(){
				topic_prise_id=$(this).attr("topic_id");
				topic_id=$(this).attr("topic_id");
				//alert($(this).parent().children("span").text(parseInt($(this).parent().children("span").text())+1));
				if(localStorage[topic_id]==1)
				{

					alert("请不要重复点赞");
					return 0;
				}
				localStorage[topic_id] = 1;//判断不要重复点赞	
				//前台ajax把赞的数目加一
				//alert(parseInt($(this).text().match(/\d+/)[0])+1);

				$(this).parent().children("span").text(parseInt($(this).parent().children("span").text())+1)
				//alert($(this).attr("topic_id"));
					
				//alert(topic_prise_ajax);
					
					$.ajax({
					url:topic_prise_ajax,
					datatype:"json",
					type:"post",
					data:{id:topic_id},
					success:function(data)
					{
						//alert(ssion);
					
						//alert("提交成功");
						//alert(data.length);
					},
					error:function(){
						$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/)[0])-1)));
						//前台ajax把赞的数目减一
					}

					})










			})
			},
			error:function()
			{
				//alert("error");
			}
			});
			
		})
		//点击提交话题的时候调用ajax
		$(".submit").click(function()
		{
		
			if($("#content").val()=="")
				alert("内容请不要为空");
			else
			{
				content=$("#content").val();
			
				if(ssion!="")
				{
					$.ajax({
					url:inserttopicAjax,
					datatype:"json",
					type:"post",
					data:{id:$("#itemId").text(),user_id:ssion,content:content},
					success:function(data)
					{
						//alert(ssion);
						//alert(data);
						//alert("评论成功");
						location.reload();
						//alert(data.length);
					}
					})
					
				}else
				{
					
					$("#t_login").click();
				}
			}

		})
		//话题分页
		$(".shuzi").click(function(){
			//alert($(this).text());
			
			//alert($("#itemId").text());
			$.ajax({
			url:topicAjax,
			datatype:"json",
			type:"post",
			data:{id:$("#itemId").text(),begin:($(this).text()-1)*10},
			success:function(data)
			{
			//alert("success");
			//alert(data.length);
			var text=" ";
			$(".add").empty();
			
			for(var i=0;i<data.length;i++)
			{

				//alert(data[i]["img"]);


				text +='<div class="row detel" style="height:130px;" >';
				text +='<div class="col-md-2 col-lg-2" style="height:115px;padding:0px;">';
				text +='<a href='+myperson+'><img src="/Public/res/images/person_img/'+data[i]["img"]+'" class="img-circle" style="width:80px;height:80px;margin-left:30px;margin-top:10px;"></a>';
				text +='</div>';
				text +='<div class="col-md-9 col-lg-9" style="height:115px;">';
				text +='<div>';
				text +='<span style="font-size:10px;"><span style="float:left;"><strong>'+data[i]["niker"]+'&nbsp&nbsp&nbsp&nbsp </strong></span><span style="float:left">'+getLocalTime(data[i]["time"])+'前</span><span style="float:right;"></span></span>';
				text +='<div class="result" style="overflow:hidden;color:#666666;font-weight:100;width:100%;height:80px;border:1px #E7EBEF solid;float:left;font-size:14px;line-height:20px;font-family:"Microsoft Yahei","微软雅黑",Arial,"Hiragino Sans GB","宋体";" >'+data[i]["content"];
				text +='</div>';
				text +='<span style="float:right;"><a class="comment_prise" href="javascript:void(0)" topic_id='+data[i]["comment_id"]+'><img class="dzan" src="/Public/res/images/small_pic/dzan.png" style="width:25px;"></a>(<span>'+data[i]["prise_number"]+'</span>)</span>';
				text +='</div>';
				text +='</div>';
				text +='</div>';
				//text +='<div style="width:90%;height:1px;background-color:#DEDBDE"> </div>';
			}
		
			$(".add").append(text);
		//	$(".result").parseEmotion();

						//给赞加事件
			$(".dzan").mousemove(function(){

				$(this).attr("src","/Public/res/images/small_pic/dzan1.png");
			$(".dzan").mouseout(function(){

				$(this).attr("src","/Public/res/images/small_pic/dzan.png");
			})
			})



					//给赞家ajax
			$(".comment_prise").click(function(){
				 //topic_prise_id=$(this).attr("topic_id");
				// alert(topic_prise_id);
				topic_id=$(this).attr("topic_id");
				// alert($(this).parent().children("span").text(parseInt($(this).parent().children("span").text())+1));
				 if(localStorage[topic_id]==1)
				 {

				 	alert("请不要重复点赞");
				 	return 0;
				 }
				 localStorage[topic_id] = 1;//判断不要重复点赞	
				 //前台ajax把赞的数目加一
				 //alert(parseInt($(this).text().match(/\d+/)[0])+1);

				 $(this).parent().children("span").text(parseInt($(this).parent().children("span").text())+1)
				// //alert($(this).attr("topic_id"));
					
				// //alert(topic_prise_ajax);
					
					$.ajax({
					url:topic_prise_ajax,
					datatype:"json",
					type:"post",
					data:{id:topic_id},
					success:function(data)
					{
						//alert(ssion);
					
						//alert("提交成功");
						//alert(data.length);
					},
					error:function(){
						$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/)[0])-1)));
						//前台ajax把赞的数目减一
					}
			});

				 	})
				
			
			},
			error:function()
			{
				//alert("error");
			}
			})
			
		})
		//支持者的ajax
		$(".suport").click(function(){
			//alert("www");
			var text1='<div class="row">';
		$.ajax({
			url:sup_ajax,
			datatype:"json",
			type:"post",
			data:{id:$("#itemId").text(),begin:0},
			success:function(data)
			{
				var k=0;
				for(i=0;i<data['people'].length;i++)
				{	
				
					
					
					myperson=person_center+'/'+data["people"][i]["id"];//前往他人的个人中心的路径
				//	alert(myperson)
					
					text1+='<div class="col-lg-6 col-md-6" style="padding:10px;" >';
					text1+='<div style="width:100%; background:#F7F7F7">';
					text1+='<div class="row">';	
					text1+='<div class="col-lg-3">';
					text1+='<a href="'+myperson+'"><img src="/Public/res/images/person_img/'+data["people"][i]["img"]+'" class="img-circle" style="width:56px;height:56px;"></a>';
					text1+='</div>';		
					text1+='<div class="col-lg-7">';
					text1+='<span name="name">'+data["people"][i]["niker"]+'</span><br>';
					text1+='<span name="name">支持项目￥'+data["people"][i]["money"]+'元</span><br>';
					text1+='<span name="name">发起：'+data['people'][i]["set"][0]["count(id)"]+'     支持：'+data['people'][i]["sup"][0]["count(*)"]+' </span><br>	';
					text1+='</div>';								
					text1+='<div class="col-lg-2">';
					text1+='</div>';								
					text1+='</div>';
					text1+='</div>';
					text1+='</div>';
					if(k%2==1)
					{
						text1+='</div> 	';
						text1+='<div  style="width:100%;background:#ffffff;height:5px"></div><div class="row">';
					}
					k++;
				}
				
				$("#sup_add").empty();
				$("#sup_add").prepend(text1);
			},
			error:function()
			{
				//alert("error!");
			}
			})
			
		})
		//支持者的分页
		$(".shuzi").click(function()
		{
			var text1='<div class="row">';
			$.ajax({
			url:sup_ajax,
			datatype:"json",
			type:"post",
			data:{id:$("#itemId").text(),begin:($(this).text()-1)*8},
			success:function(data)
			{
				var k=0;
				for(i=0;i<data['people'].length;i++)
				{	
					text1+='<div class="col-lg-6 col-md-6"  style="padding:0px;">';
					text1+='<div style="width:100%;height:70px; background:#F7F7F7">';
					text1+='<div class="row">';	
					text1+='<div class="col-lg-3">';
					text1+='<a href="javascript:'+data["people"][i]["id"]+'"><img src="/Public/res/images/person_img/'+data["people"][i]["img"]+'" class="img-circle" style="width:56px;height:56px;"></a>';
					text1+='</div>';						
					text1+='<div class="col-lg-7">';
					text1+='<span name="name">'+data["people"][i]["niker"]+'</span><br>';
					text1+='<span name="name">支持项目￥'+data["people"][i]["money"]+'元</span><br>';
					text1+='<span name="name">发起：'+data['people'][0]["set"][0]["count(id)"]+'     支持：'+data['people'][0]["sup"][0]["count(*)"]+' </span><br>	';
					text1+='</div>';								
					text1+='<div class="col-lg-2">';
					text1+='</div>';								
					text1+='</div>';
					text1+='</div>';
					text1+='</div>';
					if(k%2==1)
					{
						text1+='</div> 	';
						text1+='<div  style="width:100%;background:#ffffff;height:5px"></div><div class="row">';
					}
					k++;
				}
				
				$("#sup_add").empty();
				$("#sup_add").prepend(text1);
			},
			error:function()
			{
				//alert("error!");
			}
			})
			
		})
		


})
