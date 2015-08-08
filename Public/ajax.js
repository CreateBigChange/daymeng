$(function(){
	$('._submit').click(
		function(){
		var wish_content=$('.wish_content').val();
		/*
		$.post(handleUrl,{username:'cg',content:wish_content,time:'12-3-4 15:6'},function(){
			alert('sss');
		},'json');
		*/
		$.ajax({
		url:handleUrl,
		type:'post',//以post方式和服务器进行沟通
		data:'wish_content='+wish_content,
		success:function(data,textStatus){
			if(data.status==1){
				alert('心愿许下，您可以再下方查看您的心愿');
			}else{
				if(data.status==0)
				alert('心愿发布失败');					
				else{
				alert('发布时间间隔请大于5分钟哦!');
				}
			}
		},
		error:function(){
			alert('服务器错误失败');
		},
			});
		}
		);
});

$(function(){
		wish('prise_number');		
});
function wish(sort,page){
		if(!page) page=1;
		$.ajax({
			url:wish_sort_url,
			type:'post',
			data:'sort='+sort+'&page='+page,
			success:function(data,textStatus){
				$('.feed_inner_list').text('');
				if(data){
					for(var i=0;data.data1[i];i++){
						if(i%4==0){
							$('.feed_inner_list').append('<tr></tr>');
							$('.feed_inner_list').find('tr:last-child').append(
						"<td>"+
				        "<div class='list_content'>"+
				        "<div class='bg_image' style='background:url("+PUBLIC+data.data1[i].img+") no-repeat;'></div>"+
				       " <div class='des'>"+data.data1[i].content+"</div>"+
				        "<div class='interaction'>"+
				        "<a href='###'class='zan1' ><span>赞("+data.data1[i].prise_number+")</span></a>"+
				        "<a href='###' class='pl'><span>评论("+data.data1[i].comment_number+")</span></a>"+
				        "<a href='###' class='sl'><span></span></a>"+
				        "</div>"+
				        "</div>"+
				        "</td> ");
						}else{
						$('.feed_inner_list').find('tr:last-child').append(
						"<td>"+
				        "<div class='list_content'>"+
				        "<div class='bg_image' style=background:url("+PUBLIC+data.data1[i].img+") no-repeat;></div>"+
				       " <div class='des'>"+data.data1[i].content+"</div>"+
				        "<div class='interaction'>"+
				        "<a href='###'class='zan1' ><span>赞("+data.data1[i].prise_number+")</span></a>"+
				        "<a href='###' class='pl'><span>评论("+data.data1[i].comment_number+")</span></a>"+
				        "<a href='###' class='sl'><span></span></a>"+
				        "</div>"+
				        "</div>"+
				        "</td> "
								);
						}
					}
					var pages= $('.pages a');
					for(var i=0;i<pages.length;i++){
							if(parseInt(page)+i<=data.total_page)
							pages.eq(i).text(parseInt(page)+i);
							else{
							pages.eq(i).text('');
							}

					}
				}
				else{
					alert('服务器发生错误!');
				}
			},
			error:function(){
					alert('请不要频繁刷新');
			}
		});
}
$('.pages a').click(
		function(){
		wish('prise_number',$(this).text());
		}
);