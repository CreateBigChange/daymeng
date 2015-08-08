//删除
$('.jsdel').click(function(){
	$(this).closest('tr').remove();
	var id=$(this).closest('td').attr('data-id');
	var type=$(this).attr('data-type');
	$.post(del_url,{id:id,type:type});
});
//查看
$('.jslook').click(function(){
	var islook=$(this).closest('tr').find('.islook');
	// alert(islook.text());
	var type=$(this).attr('data-type');
	var id=$(this).closest('td').attr('data-id');
	if (islook.text()==='未阅读') {
		islook.css('color','#000000');
		islook.text('已阅读');
		$.post(look_url,{id:id,type:type});
	}
});
//回复
$('.jsreply').on('click',function(){
	var id = $(this).closest('td').attr('data-id');
	if ($('#'+id).css('display')=='none') {
		$('#'+id).show();
	}
	else {
		$('#'+id).css('display','none');
	}
});
$('.pickup').click(function(){
	$(this).closest('tr').css('display','none');
});