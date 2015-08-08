//项目信息页面，表单控制的js
	$('#next').click(function(){
		var title  = $('#title').val();
		var money  = $('#money').val();
		var day    = $('#day').val();
		var cate   = $('#class').val();
		var province =$('#s1').val();
		var city   =$('#s2').val();
		var photo  = $('#up').val();
		var introduce = $('#introduce').val();
		if (title=="") {
			alert('请填写项目名称');
			return false;
		}
		if (money=="") {
			alert('请注意填写金额');
			return false;
		}	
		if (day==""||day>90|| day <7) {
			alert('请注意时间在7-90天内');
			return false;
		}
		if (cate=="") {
			alert('请选择类别');
			return false;
		}
		if (province=="省份"||city=="地级市") {
			alert('请选择所属省份和城市');
			return false;
		}
		if (photo=="") {
			alert('请上传项目封面图');
			return false;
		}
		if (introduce=="") {
			alert('项目简介不为空');
			return false;
		}
		return true;
	});