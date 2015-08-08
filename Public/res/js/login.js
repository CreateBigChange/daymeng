	var judge_min_alert_username=0;
	var email=new Array("@qq.com","@163.com","@sina.com");
	var j=-1;

// $(function(){
// document.onkeydown = function(e){ 
//     if(e.keyCode==13) {
//     var cur=$(".user_name");
// 			$.ajax({
// 				url:login_check,
// 				type:'post',
// 				data:'username='+cur.val(),
// 				success:function(data){
// 						if(data.status==1){
// 							$(".verify_").css("display","block");
// 							$("#ver_code").prop("disabled",false);
// 						}else{
// 							if(data.status==2){
// 							$(".verify_").css("display","none");
// 							$("#ver_code").prop("disabled",true);
// 							}
// 						}
// 						},
// 				error:function(){
// 					alert("服务器发生错误1!");
// 				}
// 			});
//     	$(".login").click();

//      }
// }
// });  
      function getck(objname){
  var ck=document.cookie.split(';');
for(var i=0;i<ck.length;i++){
  temp=ck[i].split("=");
  // alert(temp[0]+"...."+objname+temp[1])
  if(temp[0].substr(1)==objname) return unescape(temp[1]);
}
}

$(function(){

	  if(getck('username')){
        $(".user_name").val(getck('username'));
        $(".user_password").focus();
      }else{
      	$(".user_name").focus();
      }
	function updown(code){
		if(code>2) return 0;
		else{
		if(code<0)  return 2;
		else{
			return code;
		}
		}
	}
	$("input").not(".user_name").keyup(function(e){
		  if(e.keyCode==13){
      $("#name").focus();
			$(".alert_").css("color","#ffffff").text("a");
			if($(".user_name").val().length<6){
				//账号值为空
				$(".alert_").css("color","red").text("用户账号不能小于6位数");					
				return ;
			}
			if($(".user_password").val().length<6){
				//用户密码不能为空
				$(".alert_").css("color","red").text("用户密码不能小于6位数");					
				return ;
			}
			if(!$("#ver_code").val() && $("#ver_code").prop("disabled")!=true){
				//验证码需要输入时
				$(".alert_").css("color","red").text("验证码不能为空");					
				return ;
				}

				// alert($("input[name='uername']").val());
			$.ajax({
				url:login_url,
				type:'post',
				data:'username='+$("input[name='uername']").val()+"&password="+$("input[name='password']").val()+"&verify="+$("input[name='verify']").val(),
				success:function(data){
					if(data.status==2){
    				$(".alert_").css("color","red").text("验证码错误");
					$(".verify").prop("src",login_verify+"?"+Math.random());
					$('.login').text('登录');$('.login').prop('disabled',false);
					}
					if(data.status==3){
    				$(".alert_").css("color","red").text("此账户已经被冻结");
					$('.login').text('登录');$('.login').prop('disabled',false);

    				$(".verify").prop("src",login_verify+"?"+Math.random());
					}
					if(data.status==1){
						if($("#t_login").length){
							//小页面
							if($("input[name='remember']").prop("checked")){
								//记住密码
								$.ajax({
								url:rem_login,
								type:'post',
								success:function(){
							 	window.location.href=home;
								
								},
								fail:function(){
									alert("记住登录失败");
							 	window.location.href=home;
									
								}
							});
							}else{
							 	window.location.href=home;
								

									location.reload(true);
							}
						}else{
							//大登陆页面
							if($("input[name='remember']").prop("checked")){
								//记住密码	
								$.ajax({
								url:rem_login,
								type:'post',
								success:function(){
				

								// alert("记住登录成功");
							 	window.location.href=home;
								

								},
								fail:function(){
									alert("记住登录失败");
							 	window.location.href=home;
									
								}
							});
							}else{
							 	window.location.href=home;
							}
								
						}
							}
					if(data.status==0){
						$(".alert_").css("color","red").text("账号或者密码错误");
						$(".verify").prop("src",login_verify+"?"+Math.random());
						$('.login').text('登录');$('.login').prop('disabled',false);
					}
					},
				fail:function(){
					$(".verify").prop("src",login_verify+"?"+Math.random());
					alert("数据发送失败3");
				}
			});
				$(".alert_username").css("display","none");	
			
			$(".login").text("登录中...");
			$(".login").prop("disabled",true);
		}
		  	
	});
	$(".user_name").keyup(function(e){
		judge_min_alert_username=0;
		$(".alert_username").text("");
		var cur=$(this);
		for(var i=0;i<email.length;i++){
		if(cur.val())
		$(".alert_username").append("<li  class='min_alert_username' style='color:#999'>"+"<span >"+cur.val().replace(/@[\s|\S]*/g,"")+"</span>"+email[i]+"</li>");
		}
		$(".min_alert_username").mouseover(
			function(){
				$(this).css('background-color','#33a600');
				$(".min_alert_username").not($(this)).css('background-color','#fff')
			});
		$(".alert_username").css("display","block");
		$(".min_alert_username").click(function(){
		cur.val($(this).text());
		 judge_min_alert_username=1;
		$(".alert_username").css("display","none");	
	});
		if(e.keyCode==40){//下方向键盘
			j++;
			j=updown(j);
				$(".min_alert_username").eq(j).css({
				"background-color":"#33a600",
				"color":"#fff"
			});
		}
		if(e.keyCode==38){//上方向键盘
			j--;
			j=updown(j);
				$(".min_alert_username").eq(j).css({
				"background-color":"#33a600",
				"color":"#fff"
			});
		}
		if(e.keyCode==13){//回车选择
			if(j==-1) j=0;
				$(this).val($(".min_alert_username").eq(j).text());
				$(".alert_username").css("display","none");	
		}
	});
	 // alert($(".user_name").is(":focus"));
	 $("input").not("user_name").focus(function(){//其它两个表单得到焦点的时候
				$(".alert_username").css("display","none");
	 	
	 });
	$(".user_name").blur(
		function(){
			// $(".login").prop("disabled",true);
			if(judge_min_alert_username==1){//鼠标点击过,隐藏
				$(".alert_username").css("display","none");
			}
			var cur=$(this);
			$.ajax({
				url:login_check,
				type:'post',
				data:'username='+cur.val(),
				success:function(data){
						if(data.status==1){
							$(".verify_").css("display","block");
							$("#ver_code").prop("disabled",false);
						}else{
							if(data.status==2){
							$(".verify_").css("display","none");
							$("#ver_code").val("");
							$("#ver_code").prop("disabled",true);
							// alert($("#ver_code").val());

							}
						}
						},
				error:function(){
					// alert("服务器发生错误1!");
				}
			});
		}
		);
	$(".user_password").blur(
		function(){
			var cur=$(".user_name");
			$.ajax({
				url:login_check,
				type:'post',
				data:'username='+cur.val(),
				success:function(data){
						if(data.status==1){
							$(".verify_").css("display","block");
							$("#ver_code").prop("disabled",false);
						}else{
							if(data.status==2){
							$(".verify_").css("display","none");
							$("#ver_code").prop("disabled",true);
							}
						}
				},
				error:function(){
					// alert("服务器发生错误2!");
				}
			});
		}
		);
	if($(".user_name").val()){//已经填写好账号
				$("#login").prop("disabled",true);
				$.ajax({
				url:login_check,
				type:'post',
				data:'username='+$(".user_name").val(),
				success:function(data){
						if(data.status==1){
							$(".verify_").css("display","block");
							$("#ver_code").prop("disabled",false);
							$("#login").prop("disabled",false);

						}else{
							if(data.status==2){
							$(".verify_").css("display","none");
							$("#ver_code").prop("disabled",true);
							$("#login").prop("disabled",false);


							}
						}
						},
				error:function(){
					alert("服务器发生错误1!");
				}
			});
				}
	$(".login").click(
		function(){
      $("#name").focus();
			$(".alert_").css("color","#ffffff").text("a");
			if($(".user_name").val().length<6){
				//账号值为空
				$(".alert_").css("color","red").text("用户账号不能小于6位数");					
				return ;
			}
			if($(".user_password").val().length<6){
				//用户密码不能为空
				$(".alert_").css("color","red").text("用户密码不能小于6位数");					
				return ;
			}
			if(!$("#ver_code").val() && $("#ver_code").prop("disabled")!=true){
				//验证码需要输入时
				$(".alert_").css("color","red").text("验证码不能为空");					
				return ;
				}

				// alert($("input[name='uername']").val());
			$.ajax({
				url:login_url,
				type:'post',
				data:'username='+$("input[name='uername']").val()+"&password="+$("input[name='password']").val()+"&verify="+$("input[name='verify']").val(),
				success:function(data){
					if(data.status==2){
    				$(".alert_").css("color","red").text("验证码错误");
					$(".verify").prop("src",login_verify+"?"+Math.random());
					$('.login').text('登录');$('.login').prop('disabled',false);
					}
					if(data.status==3){
    				$(".alert_").css("color","red").text("此账户已经被冻结");
					$('.login').text('登录');$('.login').prop('disabled',false);

    				$(".verify").prop("src",login_verify+"?"+Math.random());
					}
					if(data.status==1){
						if($("#t_login").length){
							//小页面
							if($("input[name='remember']").prop("checked")){
								//记住密码
								$.ajax({
								url:rem_login,
								type:'post',
								success:function(){
							 	window.location.href=home;
								
								},
								fail:function(){
									alert("记住登录失败");
							 	window.location.href=home;
									
								}
							});
							}else{
							 	window.location.href=home;
								

									location.reload(true);
							}
						}else{
							//大登陆页面
							if($("input[name='remember']").prop("checked")){
								//记住密码	
								$.ajax({
								url:rem_login,
								type:'post',
								success:function(){
				

								// alert("记住登录成功");
							 	window.location.href=home;
								

								},
								fail:function(){
									alert("记住登录失败");
							 	window.location.href=home;
									
								}
							});
							}else{
							 	window.location.href=home;
							}
								
						}
							}
					if(data.status==0){
						$(".alert_").css("color","red").text("账号或者密码错误");
						$(".verify").prop("src",login_verify+"?"+Math.random());
						$('.login').text('登录');$('.login').prop('disabled',false);
					}
					},
				fail:function(){
					$(".verify").prop("src",login_verify+"?"+Math.random());
					alert("数据发送失败3");
				}
			});
				$(".alert_username").css("display","none");	
			
			$(".login").text("登录中...");
			$(".login").prop("disabled",true);
		}
		);	
});
