$(document).ready(function(){
	$(".close").click(function(){
		$("#chat").hide();

	})
	var k;
	$(".del").click(function(){

		$(this).parents("tr").hide();
		id=$(this).prev().text();
			$.ajax({
			url:manageFriends_ajax,
			datatype:"json",
			type:"post",
			data:{id:id},//ajax取得评论的范围
			success:function(data)
			{
				//alert(data);
				//window.location.replace(location.href);
				//alert("success")

			},
			error:function()
			{
				alert("error!");
			}
		});
	})
	
	$(".send").click(function(){
		$("#chat").show();
		//alert($(this).next().text());
		k =$(this).next().text();//传递好友id号	
	});
	//ajax传递私信
	$('body').delegate('.reply', {
	click : function(event){
	$(this).next('.comment_body').toggle();
	event.preventDefault();
	}
	});
	$('.submit').bind({
	click : function(){
		//alert(k);

	var content = $(this).parents('form').find('.content').val();
	//alert(content);
	$('#result').html(content).parseEmotion();
		$.ajax({//发送好友消息的ajax
			url:manageFriends_send_ajax,
			datatype:"json",
			type:"post",
			data:{id:k,content:content},//取得好友的id
			success:function(data)
			{
				//alert(data);
				//window.location.replace(location.href);
				$(".submit").parents('form').find('.content').text("sadww");
				$("#chat").hide();
			},
			error:function()
			{
				alert("wwww");
				alert("error!");
			}
		});
	}
	});
	$('.face').bind({
	click: function(event){
	if(! $('#sinaEmotion').is(':visible')){
	$(this).sinaEmotion();
	event.stopPropagation();
	}
	}
	});
})