$(document).ready(function(){
	$(".model").mouseenter(function(){
		if($(this).css("background-color")=='rgb(71, 78, 93)'||$(this).css("background-color")=='#474e5d')
		;
		else
		$(this).css("background-color","#ececec")
	})
	$(".model").mouseleave(function(){
		if($(this).css("background-color")=='rgb(71, 78, 93)')
		;
		else
		$(this).css("background-color","#ffffff")
	})
	$(".change").mouseenter(function(){
		$(this).children("div.col-lg-8").children("div.text_1").text("");
		$(this).children("div.col-lg-8").children("div.text_2").addClass("write");
		$(this).children("div.col-lg-8").children("div.text_2").removeClass("text_2"); 
		$(this).css("background-color","#ff6458");
		if($(this).children("div.change_2").children("b.transparent").length==0)
		{
			$(this).children("div.change_2").prepend("<b class='transparent'></b>")
		}
		$(this).siblings().children("div.col-lg-8").children("div.text_1").text("HALOBAND, 重新定义智能手环");
		$(this).siblings().css("background-color"," #00CBCE");
		$(this).siblings().children("div.change_2").children("b").remove();
	})
function LOOK_ajax(look_id)
{	
	$.ajax({
	url:LOOKURL+"/ajax",
	type:"post",
	dataType:"json",
	data:{look_id:look_id},
	dataType:"json",
	success:function(pruduct)
	{
		alert("aja成功");


		for(var i=8;i>pruduct.data.length;i--)
		{
				$("#look_"+i).remove();
		}
		for(var i=0;i<pruduct.data.length;i++)
		{
			$("#look_"+i)
		}
		alert(pruduct.data[0].sup);
		alert(pruduct.data.length);
		
	},
	error:function()
	{
		alert("aja失败");
	}
	});
}	
	$(".model").click(function(){
		$(".model").css({"background-color":"#fff","color":"#000"});
		$(this).css({"background-color":"#474e5d","color":"#fff"});
		LOOK_ajax($(this)[0].id)
	})
})