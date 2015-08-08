// 企业信息提交
$('#comsubmit').click(function(){

	var com_name=$('#comname').val();
	var com_mail=$('#commail').val();
	var com_address=$('#comaddress').val();
	var license_code=$('#licensecode').val();
	var org_code=$('#orgnizationcode').val();
	var operator_name=$('#operatorname').val();
	var phone_num=$('#comphonenum').val();
	var msg_code=$('#comcode').val();

	if (com_name!="" && com_mail!="" && com_address!="" && license_code!="" && org_code!="" && operator_name!="" && phone_num!="" && msg_code!="") {
		$.post(comupload_url,{comname:com_name,commail:com_mail,comaddress:com_address,licensecode:license_code,orgcode:org_code,operatorname:operator_name,phonenum:phone_num,msgcode:msg_code},function(data){
			if (data.state) {
				window.location.href=next_url;
			}
			else{
				alert(data.news);
			}
		},'json');
	}
	else{
		alert('请完整填写您的申请信息！');
	}
	// return false;

});

// 院校信息提交
$('#schoolsubmit').click(function(){

	var name=$('#schoolname').val();
	var mail=$('#schoolmail').val();
	var address=$('#schooladdress').val();
	var operator_name=$('#schoolidname').val();
	var operator_id=$('#schoolidnum').val();
	var phone_num=$('#schoolphonenum').val();
	var msg_code=$('#schoolcode').val();

	if (name!="" && mail!="" && address!="" && operator_name!="" && operator_id!="" && phone_num!="" && msg_code!="") {
		$.post(schoolupload_url,{schoolname:name,schoolmail:mail,schooladdress:address,operatorname:operator_name,operatorid:operator_id,phonenum:phone_num,msgcode:msg_code},function(data){
			if (data.state) {
				window.location.href=next_url;
			}
			else{
				alert(data.news);
			}
		},'json');
	}
	else{
		alert('请完整填写您的申请信息！');
	}
	return false;

});

// 社团信息提交
$('#teamsubmit').click(function(){

	var name=$('#teamname').val();
	var mail=$('#teammail').val();
	var address=$('#teamaddress').val();
	var operator_name=$('#teamidname').val();
	var operator_id=$('#teamidnum').val();
	var phone_num=$('#teamphonenum').val();
	var msg_code=$('#teamcode').val();

	if (name!="" && mail!="" && address!="" && operator_name!="" && operator_id!="" && phone_num!="" && msg_code!="") {
		$.post(teamupload_url,{teamname:name,teammail:mail,teamaddress:address,operatorname:operator_name,operatorid:operator_id,phonenum:phone_num,msgcode:msg_code},function(data){
			if (data.state) {
				window.location.href=next_url;
			}
			else{
				alert(data.news);
			}
		},'json');
	}
	else{
		alert('请完整填写您的申请信息！');
	}
	return false;

});

// 其他组织信息提交
$('#orgsubmit').click(function(){

	var name=$('#orgname').val();
	var mail=$('#orgmail').val();
	var address=$('#orgaddress').val();
	var operator_name=$('#orgidname').val();
	var operator_id=$('#orgidnum').val();
	var phone_num=$('#orgphonenum').val();
	var msg_code=$('#orgcode').val();

	if (name!="" && mail!="" && address!="" && operator_name!="" && operator_id!="" && phone_num!="" && msg_code!="") {
		$.post(orgupload_url,{orgname:name,orgmail:mail,orgaddress:address,operatorname:operator_name,operatorid:operator_id,phonenum:phone_num,msgcode:msg_code},function(data){
			if (data.state) {
				window.location.href=next_url;
			}
			else{
				alert(data.news);
			}
		},'json');
	}
	else{
		alert('请完整填写您的申请信息！');
	}
	return false;

});

// 个人信息提交
$('#personsubmit').click(function(){

	var name=$('#personname').val();
	var mail=$('#personmail').val();
	var address=$('#personaddress').val();
	var operator_id=$('#personidnum').val();
	var phone_num=$('#personphonenum').val();
	var msg_code=$('#personcode').val();

	if (name!="" && mail!="" && address!="" && operator_id!="" && phone_num!="" && msg_code!="") {
		$.post(personupload_url,{personname:name,personmail:mail,personaddress:address,operatorid:operator_id,phonenum:phone_num,msgcode:msg_code},function(data){
			if (data.state) {
				window.location.href=next_url;
			}
			else{
				alert(data.news);
			}
		},'json');
	}
	else{
		alert('请完整填写您的申请信息!');
	}
	return false;

});

//手机号码正则表达式
function isDigit(s){

	 var patrn=/^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/;
	 if (!patrn.exec(s)) return false;
	 return true;
 }

function timecount (time,type) {
	// alert(time);
	if (time) {
		type.attr('disabled','disabled').text(time+"秒后，再次获取");
		time=time-1;
		setTimeout(function(){
		timecount(time,type);
	},1000);
	}
	else{
		type.removeAttr("disabled").text("再次获取");
		return 0;
	}
	
}

//上传用户手机号码，获取验证码
function send_phone_num(phonenum,url){
	if (phonenum!=" "&& isDigit(phonenum)) {
		$.post(url,{phone_num:phonenum},function(data){
			if (data) {
				alert('5位验证码已发送，请注意查收！');
				setTimeout(function(){
					timecount(time,type);
				},1000);
				return 1;
			} 
			else{
				//发送失败
				alert('发送失败！');
				return 0;
			}
		});
	}
	else{
		alert('请填写正确的手机号码!');
		return 0;
	}
}

//短信发送
$('#person_btn').click(function(){
	type=$(this);
	time=60;
	var phone_num = $('#personphonenum').val();
	send_phone_num(phone_num,phonenum_url);
});

$('#org_btn').click(function(){
	type=$(this);
	time=60;
	var phone_num=$('#orgphonenum').val();
	send_phone_num(phone_num,phonenum_url);
});

$('#team_btn').click(function(){
	type=$(this);
	time=60;
	var phone_num=$('#teamphonenum').val();
	send_phone_num(phone_num,phonenum_url);
});

$('#school_btn').click(function(){
	type=$(this);
	time=60;
	var phone_num=$('#schoolphonenum').val();
	send_phone_num(phone_num,phonenum_url);
});

$('#com_btn').click(function(){
	type=$(this);
	time=60;
	var phone_num=$('#comphonenum').val();
	send_phone_num(phone_num,phonenum_url);
});