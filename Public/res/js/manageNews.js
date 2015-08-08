// 点击回复消息
$('.js_reply').click(function(){
	$(this).closest('li').find('form').css('display','block');
});

$('.js_reply_pickup').click(function(){
	$(this).closest('form').css('display','none');
});
$('.js_delete').click(function(){
	var id=$(this).attr('data');
	$(this).closest('li').remove();
	$.post(delete_url,{id:id});
});