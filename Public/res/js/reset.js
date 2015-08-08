$('#ok').click(function (){
	var passwd=$("input[name='password']").val();
	var repasswd=$("input[name='repassword']").val();
	if (passwd==""||repasswd=="") {
		alert('请填写完整！');
		return false;
	}
	if (passwd!=repasswd) {
		alert('两次密码不一致！');
		return false;
	}
	else{
		return true;
	}
});