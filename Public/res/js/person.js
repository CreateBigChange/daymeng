$(document).ready(function(){
	$(".password_again").blur(function(){
		if($(".password").val()!=$(".password_again").val())
		{
			$(".error-text").text("两次密码不一致");
			$(".error-text").removeClass("hidden");
		}
		else
		{	
			$(".error-text").addClass("hidden");
				
			if($(".password").val()==""||$(".password_again").val()=="")
			{
				$(".error-text").text("密码不能为空");
				$(".error-text").removeClass("hidden");
			}
			else
			$(".error-text").addClass("hidden");
		}
		
	})
	$("#save").click(function(){
		if($(".password").val()!=$(".password_again").val())
		{
			$(".error-text").text("两次密码不一致");
			$(".error-text").removeClass("hidden");
			alert("两次密码不同！");
			return false;
		}
		else
		{	
			$(".error-text").addClass("hidden");
				
			if($(".password").val()==""||$(".password_again").val()=="")
			{
				$(".error-text").text("密码不能为空");
				$(".error-text").removeClass("hidden");
				alert("密码不为空！");
				return false;
			}
			else
			$(".error-text").addClass("hidden");
		}
	})
})