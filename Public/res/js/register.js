$(function(){
	var judge=0;
	var username;
	var password;
	$('.verify').click(
		function(){
			$(this).attr('src',url_verify+'/'+Math.random());
		}
		);
	$('form input').blur(
		function(){
			var v=$(this);
			if(v.attr("name")=="username"){
				var reg=/^\w{6,}@{1}\w{2,6}\.\w{2,6}/;
				if(!reg.test(v.val())){
					v.closest("div").next().text("邮箱格式不正确");
					v.closest("div").next().css("color","red");
					judge=0;
					return 0;
				}else{
					$.ajax({
					url:url_judge,
					type:'post',
					data:'type='+v.attr("name")+'&username='+v.val(),
					success:function(data,textstatus){
							if(data.status){
							v.closest("div").next().text("此邮箱已经注册过呆萌号");
							v.closest("div").next().css("color","red");
							judge=0;
							return 0;
							}
							else{
								v.closest("div").next().text("邮箱可用");
								v.closest("div").next().css("color","#a7ce37");
								username=v.val();
								judge=1;
							}
					}
				});
					return 0;
				}
				}
			if(v.attr("name")=="password"){
				var reg=/\w{6,}/;
				if(!reg.test(v.val())){
					v.closest("div").next().text("密码只能由字母数字和下划线组成,并且位数大于6位数");
					v.closest("div").next().css("color","red");
					judge=0;
					return 0;
				}else{
					v.closest("div").next().text("√");
					v.closest("div").next().css("color","#a7ce37");
					password=v.val();
						if(v.val()!=v.parent("div").parent("div").next("div").find("input").val()){
						if(v.parent("div").parent("div").next("div").find("input").val()){//非空
						v.parent("div").parent("div").next("div").find("div").eq(1).text("两次密码不正确");
						v.parent("div").parent("div").next("div").find("div").eq(1).css("color","red");
						judge=0;
						return 0;													
						}
					}else{
						v.closest("div").next().text("√");
						v.closest("div").next().css("color","#33ff33");
						v.parent("div").parent("div").next("div").find("div").eq(1).text("√");
						v.parent("div").parent("div").next("div").find("div").eq(1).css("color","#33ff33");
						judge=1;
						return 0;
					}
				}

			}
			if(v.attr("name")=="repassword"){
					if(v.val()!=v.parent("div").parent("div").prevAll("div").eq(0).find("input").val()){
					v.closest("div").next().text("两次密码输入不正确");
					v.closest("div").next().css("color","red");
					judge=0;
					return 0;
				}
				else{
					if(v.val()>6){
					v.closest("div").next().text("√");
					v.closest("div").next().css("color","#a7ce37");
					judge=1;
					return 0;
				}
				}
			}
			
		}
		);
		
		$(".creat_user").click(
			function(){
				if(!$("input[name='consent']:checked").val()){//未同意协议
					alert("请认证阅读协议并同意哦!");
					return 0;
				}

			if(judge==1){
				
		 		$.ajax({
		 			url:url_register,
		 			type:'post',
		 			data:"username="+username+"&password="+password+"&verify="+$(".verify").eq(0).val(),
		 			success:function(data,textstatus){
		
		 					if(data.verify==0){
		 						alert("验证码错误");
		 						window.location.href=register;	
		 					}
		 					else{
		 						if(data.verify==1){
		 						window.location.href=home;	

		 						}
		 					else
		 						alert("注册失败");

		 					}
		 			}
		 		});
		 		return 0;
		 }else{
		 	alert("请正确填写哦!");
		 }
		}
			);

});
