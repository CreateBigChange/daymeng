$(function(){
	$('#dropdown_menu').hover(function(){
			$(this).css('background-color','#444444');
			$('#hid').show();

	},
	function(){
		$(this).css('background-color','#fff');
		$('#hid').hide();
	});
  $(".active_").hover(
      function(){
       $(this).css('background-color','#9dc82b');
      },
      function(){
       $(this).css('background-color','#fff');
      }
    );

});
$(function(){//回到顶部
         $(window).scroll(function(){  
                if ($(window).scrollTop()>500){  
                    $("#backtotop").fadeIn(1000);  
                }  
                else  
                {  
                    $("#backtotop").fadeOut(1000);  
                }  
            });  
      $('#backtotop').click(
          function(){
            $('body,html').animate({scrollTop:0},500);  
                return false;  
          }
        );

});