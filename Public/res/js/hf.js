
function forbit_sub(time){
if(time<0){
clearTimeout(t);
setc1("jud_phone","0");
return ;
}
setc1("jud_time",time);
$(".get_verify_again1").text("再次获取>("+time+")");
time=time-1;
t=setTimeout("forbit_sub("+time+")",1000);

}

function getck1(objname){
  var ck=document.cookie.split(';');
for(var i=0;i<ck.length;i++){
  temp=ck[i].split("=");
   // alert("c!"+temp[0]+"...."+objname+temp[1]);
  if(temp[0].substr(1)==objname) return unescape(temp[1]);
  if(temp[0]==objname) return unescape(temp[1]);
}
}

function setc1(name,value)
{
    var exp = new Date();
    exp.setTime(exp.getTime() +3600*24*30);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function delc1(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() -3600);
    if(getck(name))
    document.cookie = name + "="+ getck(name) + ";expires=" + exp.toGMTString();
}


$(function(){
   // if(!getck("jud_phone")){
   //   alert("为了您的正常使用，请不要禁用cookie");
   //   //cookie被禁用
   //   return 0;
   // }

    if(getck1("jud_phone")==1 ){
      //1表示继续在第二个页面读秒
      forbit_sub(getck("jud_time"));
          $(".phone_sup").show(1000);
        $(".get_verify").hide(1000);
        $(".verify").show(1000);
            $(".again").show(1000);

  }
 $(".get_verify_again1").click(function(){  
  //点击获取验证码
  if($("input[name=phone_num]").val().length!=11){
    alert("手机号码格式不正确");
    return;
  }
  if(getck1("jud_phone")==1 ){
    $(".alert_phone").text("请在"+getck1("jud_time")+"秒之后再点击");
    $('.alert_phone').show();
    setTimeout("$('.alert_phone').hide(1000)",2000);
    return 0;
  }
        $(".get_verify").val("验证码发送中...");
        // $(".get_verify").prop("disabled",true);
  $.ajax({
  url:check_phone,
  type:"post",
  data:"phone_num="+$(".phone_num").val()+'&fund_repay_id='+fund_repay_id,
  success:function(data){
      if(data.Code==2){
        alert("每个账户和手机号码只能支持一次哦");
        $("input[name=phone_num]").focus();
        $(".get_verify").val("免费获取验证码");
        setc1("jud_phone","0");
      }else{
        if(data.Code==1){
          $(".phone_sup").text("支持");
        $(".phone_sup").prop("disabled",false);
        $(".phone_sup").css("background-color","#FF7F3F");  
        $(".phone_sup").show(1000);
        $(".get_verify").hide(1000);
        $(".verify").show(1000);
        $(".again").show(1000); 
        $(".get_verify").val("免费获取验证码");
        forbit_sub(60);
        }else{
          if(data.Code==3){
            alert("支持的人数已经达到上限了哦!");
           $(".get_verify").val("免费获取验证码");
           
          }else{
            if(data.Code==4){
            alert("请先登陆哦");
            }else{
                $(".get_verify").val("免费获取验证码");
            forbit_sub(1);
            alert("验证码发送失败,请刷新页面试试哦,错误代码："+data.Code)
            ;  
            }
            
          }
          
        }
        
      }
      
  },
  });
  setc1("jud_phone","1");
  setc1("jud_time",60);
  });
$(".phone_sup").click(function(){
  //提交验证码
  // alert(check_code);
  if($("input[name=phone_num]").val().length!=11){
    alert("手机号码格式不正确");
    return 0;
  }
  if($("input[name=verify]").val().length==0){
  alert("验证码格式不正确");
  return 0;
  }
  // alert('fund_item_id='+fund_item_id);
  // alert('fund_repay_id='+fund_repay_id);
  $.ajax({
    url:check_code,
    type:"post",
    data:'receive_code='+$("input[name=verify]").val()+'&fund_item_id='+fund_item_id+'&fund_repay_id='+fund_repay_id,
    success:function(data){
    if(data.Code==1){
      alert("支持成功,我们的项目有您更精彩!");
          setc1("jud_phone","0");
          setc1("jud_time",0);
        $(".phone_sup").hide();
          $(".get_verify").show();
          $(".verify").hide();
          $(".again").hide(); 
         $(".close").click();
    }else{
      if(data.Code==2){
        $("input[name=phone_num]").focus();
        alert("每个账户和手机号码只能支持一次哦");
      }else{
        if(data.Code==3){
          alert("验证码已经过期(请收到验证码时候在十分钟之内验证哦!)");
        }else{
          if(data.Code==4){
            alert("请先登录哦");
          }else{
            if(data.Code==5){
            alert("支持的人数已经达到上限了哦!");

            }else{
            alert("验证码错误");  
                              
            }
          }
              
        }
          
      }
      
      }
    },
    fail:function(){

    }
  });

});

});





$(function(){
  $(".wx").mouseover(function(){
    $(".tow_code").css("display","inline");
  });
  $(".wx").mouseout(function(){
    $(".tow_code").css("display","none");
  });
  $(".mcalls").mouseover(function(){
    $(this).prop("src",$(this).prop("src").replace(".png","1.png"));
  });
  $(".mcalls").mouseout(function(){

    $(this).prop("src",$(this).prop("src").replace("1.png",".png"));
  });
      // var check_rem="{:U('login/check_rem','','')}";
    // var exit_url="{:U('publicmodel/exit1','','')}";
$("._exit").click(
    function(){
    $.ajax({
      url:exit_url,
      type:"post",
      success:function(){
        // alert("退出成功!");
        window.location.href=_home;
      },
      error:function(){
        // alert(exit_url);
        // alert("退出失败1！");
      }
    });

    }
    );
  $("#hid").hover(
    function(){
        $("#hid").find("li:hidden").not(".menus").css({
          "display":"block",
        });
    },
    function(){
        $("#hid").find("li:visible").not(".menus").css({
          "display":"none",          
        });
    }
    );

  $(".active_").hover(
      function(){
       $(this).css('background-color','#33a600');
       $(this).css('color','#fff');
      },
      function(){
       $(this).css('background-color','#fff');
       $(this).css('color','#333');

      }
    );

});

$(function(){//回到顶部
  var control=1;
         $(window).scroll(function(){  
                if ($(window).scrollTop()>500){  
                	//到下面
                    $("#backtotop").fadeIn(1000); 
                    if(control){
                      control=0;
                       $("#head_").css({
                      "max-height":"60px",
                      "position":"fixed",
                      "padding":"10px 0px",
                      "margin":"0px auto",
                      "top":"0px",
                      "left":"0px",
                      "box-shadow":"10px 0px 6px #888888",
                      "z-index":"100",
                      "display":"none"
                  });
                    
                    $(".top_img").css({
                      "width":"100px"
                    });
                    $(".person_img").css({
                      "width":"36px"
                    });
                    }
                    $("#head_").fadeIn(1000); 
                }  
                else  
                {   
                    control=1;
                    $("#head_").css({
                      "max-height":"100px",
                      "position":"relative",
                      "padding":"10px 0px",
                      "display":"block",
                      "box-shadow":"0px 0px 0px "
                  });
                   
                    $(".top_img").css({
                      "width":"160px"
                    });
                    $(".person_img").css({
                      "width":"46px"
                    });

                    $("#backtotop").fadeOut(1000);  
                }  
            });  
      $('#backtotop').click(
          function(){
            $('body,html').animate({scrollTop:0},400);  
           
                return false;  
          }
        );

});
$(function(){
  function getck(objname){
  var ck=document.cookie.split(';');
for(var i=0;i<ck.length;i++){
  temp=ck[i].split("=");
  // alert(temp[0]+"...."+objname+temp[1])
  if(temp[0].substr(1)==objname) return unescape(temp[1]);
}
}
 // alert(getck("niker"));
  if(getck("niker")){
  $("#bar1").text("");

  $("#bar1").append(
    "<div class='badge'>您好，欢迎来到呆萌！</div> "+
      "<a href='###'>"+unescape(decodeURI(getck("niker")))+"</a>"+
      "<a href='###'class='_exit'>"+"退出"+"</a>"+
        "<a href='./index.php/help/hefl123' target='_blank'>帮助中心</a>");
  $("._exit").click(
    function(){
    $.ajax({
      url:exit_url,
      type:"post",
      success:function(){
        // alert("退出成功!");
        window.location.href=_home;
      },
      error:function(){
        alert("退出失败2！");
      }
    });

    }
    );
    $.ajax({
    url:check_rem,
    type:'post',
    success:function(data){
          
      },
    fail:function(){

    }
  });
  }
});
