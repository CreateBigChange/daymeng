$(document).ready(function(){(
	function(){
		var sign=0;
		$(".pic").click(
		function(){
		var link=$(this).attr("src");
		
		link=link.match(/\w+\.[a-z]+/);
		var text='<div id="pic" style="position: fixed;left:300px;top:30px;width:322px;height:430px" ><img id="pic_del" style="position: fixed;left:300px;top:30px;"  src="/wish/Public/res/images/x.png"><img  src="/wish/Public/res/images/'+link+'" /> </div>';
		if(sign==0)
		{
			$("body").append(text);
			sign=1;
			
			$("#pic_del").click(function(){
			$("#pic").remove();
			sign=0;
		})
		}
		else
		{
			$("#pic").remove();
			$("body").append(text);
			$("#pic_del").click(function(){
			$("#pic").remove();
			sign=0;
		})
		}

		});
	}
)()
})