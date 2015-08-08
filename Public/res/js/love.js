function test(){
	if(k==6){
		k=0;
		$('#1').show().addClass('selected');
		$('#2').hide().removeClass("selected");
		$('#3').hide().removeClass("selected");
	}	
	else{
		k++;
		if(k==2){
		$('#1').hide().removeClass("selected");
		$('#2').show().addClass('selected');
		$('#3').hide().removeClass("selected");
		}
		if(k==4){
		$('#1').hide().removeClass("selected");
		$('#2').hide().removeClass("selected");
		$('#3').show().addClass('selected');
		}
	}
		
}
 function getCookie(c_name){
    if (document.cookie.length>0)//不存在cookie
      {
      //cookie的格式类似于 sign=yxs,得到sign的s索引
      c_start=document.cookie.indexOf(c_name + "=");
      if (c_start!=-1)
        { 
        //得到=的索引
        c_start=c_start + c_name.length+1;
        //从c_start开始找到;的索引
        c_end=document.cookie.indexOf(";",c_start);
        //没有;则说明是最后一个cookie
        if (c_end==-1) c_end=document.cookie.length;
        return (document.cookie.substring(c_start,c_end));
        } 
      }
    return "";
}

$(document).ready(function(){
	$('.weixin').on('mouseover',function(){
		$(this).closest('LI').find('.weixinimg').css('display','block');
	});
	$('.weixin').on('mouseout',function(){
		$(this).closest('LI').find('.weixinimg').css('display','none');
	});

 // 轮播
	k=0;
	setInterval(test,4000);
// 轮播按钮
$('#prve').on("click",function(){
	var id=$('.selected').attr('id');
	 if (id==1) {
		$("#"+id).hide().removeClass("selected");
		$("#3").show().addClass('selected');
		$("#2").hide().removeClass("selected");
	}
	if (id==2) {
		$("#"+id).hide().removeClass("selected");
		$("#1").show().addClass('selected');
		$("#3").hide().removeClass("selected");
	}
	if (id==3) {
		$("#"+id).hide().removeClass("selected");
		$("#2").show().addClass('selected');
		$("#1").hide().removeClass("selected");
	}
});

$('#next').on("click",function(){
	var id=$('.selected').attr('id');
	 if (id==1) {
		$("#"+id).hide().removeClass("selected");
		$("#2").show().addClass('selected');
		$("#3").hide().removeClass("selected");
	}
	if (id==2) {
		$("#"+id).hide().removeClass("selected");
		$("#3").show().addClass('selected');
		$("#1").hide().removeClass("selected");
	}
	if (id==3) {
		$("#"+id).hide().removeClass("selected");
		$("#1").show().addClass('selected');
		$("#2").hide().removeClass("selected");
	}
});
$('#whatis').click(function(){
	$('#black,#modal,#stepa').show();
    $('#modal div span').click(function(){
    $('#whatis').css('z-index','10');
      var current=$(this).parent();
      current.hide();
      current.next().show();
    });
    $('#modal div a,#modal div span:last').click(function(){
      $('#black,#modal').hide();
    });
});
$('#whatis').css('z-index','1005');

});
