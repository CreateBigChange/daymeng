$(function(){
	$(".menu").click(
     	function(){
     		if($(this).nextAll(".menus").eq(0).css("display")=="none") {
     		   $(this).nextAll(".menus").eq(0).slideDown("500");     			
     		}else{
     		   $(this).nextAll(".menus").eq(0).slideUp("500");  
     		}
     	}
		);
	$(".min_menu").click(
     	function(){
     		if($(this).nextAll("ul").eq(0).css("display")=="none") {
     		   $(this).nextAll("ul").eq(0).slideDown("500");     			
     		}else{
     		   $(this).nextAll("ul").eq(0).slideUp("500");  
     		}
     	}
		);
});