$(document).ready(function(){(//jqurey格式
	function(){//定义匿名函数
		
		//实现关注和赞的ajax
		function detail_ajax(id,func)
		{
			//alert(id);
			//alert(detailAjax);

				$.ajax({
					url:detailAjax,
					type:"post",
					dataType:"json",
					data:{id:id,func:func},//id 项目id func传入是哪种参数
					success:function(product)
					{
						//alert("ajax 成功");
						//alert(product[0]);
						//alert(product[1]);
					},
					error:function()
					{
						alert("ajax 失败");
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
		link=link.match(/\w+\.[a-z]+/);
		var text='<div id="pic" style="position: fixed;left:300px;top:30px;width:322px;height:430px" ><img id="pic_del" style="position: fixed;left:300px;top:30px;"  src="/wish/Public/res/images/detailed/repay/x.png"><img  src="/wish/Public/res/images/detailed/repay/'+link+'" /> </div>';
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
		$(".form1").click(function(){
			$(this).parent()[0].submit();
		});
		//点击支持和赞的时候ajax调用关注要登录
		$("#attention").click(function(){
			if(ssion!="")
			{
				detail_ajax($("#itemId").text(),$(this)[0].id);
				//alert($(this).text());
				$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/))+1)));//关注或者赞之后的页面及时更新
				//$(this).text($(this).text());
			}
			else
			{
				alert("请先登录!");
			}
		}
		);
		//点击支持和赞的时候ajax调用支持cookie相同不可以重复
		$("#prise").click(function(){
			if(window.localStorage.prise){
				 alert('请不要重复赞！');
				}else{
				detail_ajax($("#itemId").text(),$(this)[0].id);
				//alert($(this).text());
				$(this).text(($(this).text().replace(/\d+/,parseInt($(this).text().match(/\d+/))+1)));//关注或者赞之后的页面及时更新
				//$(this).text($(this).text());
				window.localStorage.prise="1";
				}
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
				//alert(data[i]["img"]);
				text +='<div class="row detel" >';
				text +='<div class="col-md-2 col-lg-2" style="height:115px;">';
				text +='<img src="/wish/Public/res/images/person_img/'+data[i]["img"]+'" class="img-circle" style="width:85px">';
				text +='</div>';
				text +='<div class="col-md-10 col-lg-10" style="height:115px;">';
				text +='<div>';
				text +='<span style="font-size:10px;"><span style="float:left;"><strong>'+data[i]["niker"]+'&nbsp&nbsp&nbsp&nbsp <strong></span><span style="float:left">'+getLocalTime(data[i]["time"])+'前</span><span style="float:right;">精华帖</span></span>';
				text +='<div class="result" style="width:100%;height:80px;border:1px solid;float:left;" >'+data[i]["content"];
				text +='</div>';
				text +='<span style="float:right;"><a href="javascript:void(0)">赞('+data[i]["prise_number"]+')</a></span>';
				text +='</div>';
				text +='</div>';
				text +='</div>';
				text +='<div style="width:90%;height:1px;background-color:#DEDBDE"> </div>';
			}
		
			$(".add").append(text);
			$(".result").parseEmotion();
			},
			error:function()
			{
				alert("error");
			}
			});
			
		})
		//点击提交话题的时候调用ajax
		$(".submit").click(function()
		{
			//alert($("textarea").val());
			if(ssion!="")
			{
				$.ajax({
				url:inserttopicAjax,
				datatype:"json",
				type:"post",
				data:{id:$("#itemId").text(),user_id:ssion,content:$("textarea").val()},
				success:function(data)
				{
					//alert(ssion);
					//alert(data);
					alert("提交成功");
					//alert(data.length);
				}
				})
				
			}else
			{
				alert("请先登录");
			}

		})
		//话题分页
		$("#topic_paging li a").click(function(){
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
				text +='<div class="row detel" >';
				text +='<div class="col-md-2 col-lg-2" style="height:115px;">';
				text +='<img src="/wish/Public/res/images/person_img/'+data[i]["img"]+'" class="img-circle" style="width:85px">';
				text +='</div>';
				text +='<div class="col-md-10 col-lg-10" style="height:115px;">';
				text +='<div>';
				text +='<span style="font-size:10px;"><span style="float:left;"><strong>'+data[i]["niker"]+'&nbsp&nbsp&nbsp&nbsp <strong></span><span style="float:left">'+getLocalTime(data[i]["time"])+'前</span><span style="float:right;">精华帖</span></span>';
				text +='<div class="result" style="width:100%;height:80px;border:1px solid;float:left;" >'+data[i]["content"];
				text +='</div>';
				text +='<span style="float:right;"><a href="javascript:void(0)">赞('+data[i]["prise_number"]+')</a></span>';
				text +='</div>';
				text +='</div>';
				text +='</div>';
				text +='<div style="width:90%;height:1px;background-color:#DEDBDE"> </div>';
			}
		
			$(".add").append(text);
			$(".result").parseEmotion();
			
			},
			error:function()
			{
				alert("error");
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
				
					
					text1+='<div class="col-lg-6 col-md-6" >';
					text1+='<div style="width:100%;height:70px; background:#F7F7F7">';
					text1+='<div class="row">';	
					text1+='<div class="col-lg-3">';
					text1+='<a href="#"><img src="/wish/Public/res/images/person_img/'+data["people"][i]["img"]+'" class="img-circle" style="width:56px;height:56px;"></a>';
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
				alert("error!");
			}
			})
			
		})
		//支持者的分页
		$("#sup_change li a").click(function()
		{
			//alert($(this).text())
						//alert("www");
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
				
					
					text1+='<div class="col-lg-6 col-md-6" >';
					text1+='<div style="width:100%;height:70px; background:#F7F7F7">';
					text1+='<div class="row">';	
					text1+='<div class="col-lg-3">';
					text1+='<a href="#"><img src="/wish/Public/res/images/person_img/'+data["people"][i]["img"]+'" class="img-circle" style="width:56px;height:56px;"></a>';
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
				alert("error!");
			}
			})
			
		})
		
	}
)()
})