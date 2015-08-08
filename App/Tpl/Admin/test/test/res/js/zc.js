$(function(){
	$("#dropdown_menu").hover(function(){
			$(this).css("background-color","#444444");
			$("#hid").show();

	},
	function(){
		$(this).css("background-color","#fff");
		$("#hid").hide();
	});
});