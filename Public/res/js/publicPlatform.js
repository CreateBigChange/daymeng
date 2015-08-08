//查看用户
function getinfo(){
	var obj=document.getElementById('items');
	var index=obj.selectedIndex; //序号，取当前选中选项的序号
	var id = obj.options[index].value;
	var send = $('#send').val();
	$('#userinfo').empty();
	$.post(getuser,{id:id,send:send},function(data){
		var img='<img src="/Public/res/images/person_img/';
		var wish='<a href="/index.php/index/Person/index?id=';
		$.each(data,function(index,test){
				var html='';
				html+='<tr>';
				html+='<th>'+img+test.img+'\" width="50px" height="50px"></th>';
				html+='<td>'+wish+test.id+'\" target="_blank">'+test.nickname+'</a></td>';
				html+='<td>'+test.time+'</td>';
				html+='<td>'+test.total_fee+'</td>';
				html+='<td class="jsstatus">'+test.send+'</td>';
					
				html+='</tr>';	
			$('#userinfo').append(html);		
			});
		if (data=='') {
			alert('抱歉,暂无信息');
		}
		$('#js_ok_person').removeAttr('disabled').text('确定');
	});
	
}
//获取发货信息
function getp(){
	var obj=document.getElementById('itemsp');
	var index=obj.selectedIndex; //序号，取当前选中选项的序号
	var id = obj.options[index].value;
	var send = $('#sendp').val();
	$('#userinfo').empty();
	$.post(getpro,{id:id,send:send},function(data){
		$.each(data,function(index,test){
				var html='';
				html+='<tr>';
				html+='<th>'+test.name+'</th>';
				html+='<td>'+test.province+'&nbsp;'+test.town+'&nbsp;'+test.district+'</td>';
				html+='<td>'+test.phone_number+'</td>';
				html+='<td>'+test.postcode+'</td>';
				html+='<td>'+test.content+'</td>';
				html+='<td>'+test.limits+'</td>';
				html+='<td>'+test.send_money+'</td>';
				html+='<td>'+test.time+'</td>';
				html+='<td class="jsstatus">'+test.send+'</td>';
				if (test.send=='未发货') {
					html+='<td><a href="javascript:void(0);" class="jssend" data-id=\"'+test.WIDout_trade_no+'\">发货</a></td>';
				}
				if (test.send=='已发货') {
					html+='<td><a href="javascript:void(0);" class="jsdetail" data-id=\"'+test.WIDout_trade_no+'\">详情</a></td>'
				}
					
				html+='</tr>';	
			$('#userinfo').append(html);		
			});
		if (data=='') {
			alert('抱歉,暂无信息');
		}
		$('#js_ok').removeAttr('disabled').text('确定');
	});
	
}

//查看发货
$('#js_ok_person').click(function(){
	$(this).attr('disabled','disabled').text('查询中。。。');
	getinfo();
});

//发送
$('.jssend').click(function(){
	var sendid=$(this).attr('data-id');
	$(this).closest('tr').find('.jsstatus').text('已发货');
	$.post(sendurl,{id:sendid});
});

//查看发货
$('#js_ok').click(function(){
	$('#js_ok').attr('disabled','disabled').text('查询中。。。');
	getp();	
});