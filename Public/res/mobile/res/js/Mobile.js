$(document).ready(function(){//jqurey格式
//**********************************赞的ajax*******************************************//
$("#a_prais").click(function(){

items_id = $(this).attr("data");//获取项目的id
//判断是不是已经赞过了
if($.cookie("detaile_prise"+items_id)==1)
{
	
	alert("已经赞过了哦！！！");
	return 0;
}
//前台先加一
$("#prise_num").text(parseInt($("#prise_num").text())+1);
//防止重复的赞
$.cookie("detaile_prise"+items_id,"1",{expires:90});
//alert(prise_ajax);
$.ajax({
	url:prise_ajax,
	datatype:"json",
	type:"post",
	data:{id:items_id},
	success:function(data)
	{
	//alert(ssion);
	//alert("提交成功");
	//alert(data.length);
	},
	error:function(){
	
	$("#prise_num").text(praseInt($("#prise_num").text())-1);
	//前台ajax把赞的数目减一
	$cookie("detaile_prise"+items_id,0);
	//把cookie复原
	}
		});

})
//**********************************赞的ajax*******************************************//


//////////////////////////////关注的ajax/////////////////////////////////////
$("#a_focus").click(function(){
//alert(opinion_url);
items_id = $(this).attr("data");
if($.cookie("detaile_focuse"+items_id)==1)
{
	alert("你已经关注过了哦!!!");
	return 0;
}
//前台先加一
$("#attention_num").text(parseInt($("#attention_num").text())+1);
$.cookie("detaile_focuse"+items_id, "1",{expires:90});//前台防止重复的关注
//调用详细页面的ajax
				$.ajax({
					url:opinion_url,
					type:"post",
					dataType:"json",
					data:{items_id:items_id},//id 项目id func传入是哪种参数
					success:function(data)
					{
						if(data==1)
						{
							$cookie("detaile_focuse"+items_id,0);
							$("#attention_num").text(parseInt($("#attention_num").text())-1);//关注或者赞之后的页面及时更新
							$("#t_login").click();
						}
						else
						{

							if(data==0)
							{

								$("#attention_num").text(parseInt($("#attention_num").text())-1);//关注或者赞之后的页面及时更新
								alert("请不要重复关注");
							}

						}
						
					},
					error:function()
					{
							
							$cookie("detaile_focuse"+items_id,0);
							$("#attention_num").text(parseInt($("#attention_num").text())-1);//关注或者赞之后的页面及时更新
							alert("服务器错误");
					}
					})
//调用详细页面的ajax
})
//////////////////////////////关注的ajax/////////////////////////////////////
})	