$(document).ready(function(){
	
	$(".delete").click(function(){//好友评论删除的ajax
		//alert($(this).next().text());
		$(this).parents(".person-space").hide();//前台先隐藏
								//后台ajax进行数据的删除
		
		var kind = $(this).attr("kind");
		var id = $(this).attr("com_id");
		$.ajax({
		url:mypage,
		datatype:"json",
		type:"post",
		data:{kind:kind,id:id},//取得评论的种类和id
		success:function(data)
		{
			//alert(data);
			//window.location.replace(location.href);
			//alert("success")
		},
		error:function()
		{
			//alert("error!");
		}
	});
	})
	//个人信息呈现的ajax
	$(".change").click(function(){

	$(".editor").show();
		
	})
	$(".ok").click(function(){
		$(".md-close").click();
		$("form").submit();
	})
	$(".cancel").click(function(){
			
	$(".editor").hide();
			return false;
	})
	
})