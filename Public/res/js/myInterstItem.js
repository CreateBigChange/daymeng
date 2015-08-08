$(document).ready(function(){
	$(".del").click(function(){
			items_id=$(this).prev().text();
			//alert(items_id);
		$(this).parents("tr").hide();

			$.ajax({
			url:myInterstItem_ajax,
			datatype:"json",
			type:"post",
			data:{items_id:items_id},//ajaxÈ¡µÃÆÀÂÛµÄ·¶Î§
			success:function(data)
			{
				//alert(data);
				//alert(items_id+"attention");
			
				localStorage[items_id+"attention"]=0;
				
				//alert(localStorage[items_id+"attention"]);
				
			},
			error:function()
			{
				alert("error!");
			}
		});
	})
})