//删除操作
$('.js_del').click(function(){
	if (confirm("删除回报信息?")) {		
		var del=$(this).attr('id');
		$(this).closest('tr').remove();
		$.post(del_url,{id:del},function(data){
			num=data;
			$('#Js-edit-num').text('支持回报选项'+data);
		});
	}
});	

//编辑操作
$('.js_edit').click(function(){
	var edit=$(this).attr('id');
	$.post(edit_url,{id:edit},function(data){
		$('#money').val(data.money);
		$('#content').val(data.content);
		var path=PUBLIC+'/Uploads/repay/'+data.img;
		$('#ImgPr').attr('src',path);
		$('#limit').val(data.limits);
		$('#sendmoney').val(data.send_money);
		$('#time').val(data.time);
		$('#Js-edit-num').text('支持回报选项'+(data.repay_num));
		$('#form').attr('action','/index.php/index/Returninfo/get_info?id='+edit);//如果是更新数据，则附加上更新的数据id
	},'json');
}); 

//添加信息
$('#add').click(function(){
	var money=$('#money').val();
	var content=$('#content').val();
	var photo=$('#photo').val();
	var limit=$('#limit').val();
	var sendmoney=$('#sendmoney').val();
	var time=$('#time').val();
	if (money=="") {
		alert("请填写支持金额");
		return false;
	}
	if (content=="") {
		alert("请填写回报内容");
		return false;
	}	
	if (limit=="") {
		alert("请填写限定人数");
		return false;
	}
	if (sendmoney=="") {
		alert("请填写运费");
		return false;
	}
	if (time=="") {
		alert("请填写时间");
		return false;
	}
	is_finish=true;
	return true;
});

//下一步
$('#next').click(function(){
	if (num==0) {
		alert('请至少填写一条回报信息！');
		return false;
	}else{
		// alert(num);防止ie无法实现return true这种跳转方式
		// alert('请注意提交回报信息。。');
		window.location.href=next;
		return true;
	}
});

