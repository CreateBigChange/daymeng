  //邮箱号码
  $("#name").blur(function(){
    name=$("#name").val();
    if (name== ""||name=="邮箱")  {
      $("#user_msg").css("display","inline").text("请输入邮箱号");
      flag=false;
    }else{
      $("#user_msg").css("display","none");
      flag=true;
    };
  });

// 验证码
$("#ver_code").blur(function(){
  verify=$("#ver_code").val();
  if (verify == "" || verify == "验证码") {
    $("#code_msg").css("display","inline").text("请输入验证码");
    flag=false;
  } else{
    $("#code_msg").css("display","none");
    flag=true;
  };
});
  $("#confirm").click(
    // $(this).attr("disabled","disabled");
    // alert($(this).attr("disabled"));
    function(){
      $('#confirm').attr('disabled','disabled').text('发生邮件中。。。');
      $.ajax({
        url:login_url,
        type:'post',
        data:'username='+$("input[name='uername']").val()+"&verify="+$("input[name='verify']").val(),
        success:function(data){
          if(data.status==2){
            alert("验证码错误");
            // window.location.href=login;
             $('#confirm').removeAttr('disabled').text('确定');
          }
          if(data.status==1){
            alert('请查看您的邮箱，修改密码！');
             window.location.href=login;
            $('#confirm').removeAttr('disabled').text('确定');
          }
          if(data.status==3){
            alert('请重新提交！'); 
            $('#confirm').removeAttr('disabled').text('确定');
          }
        },
        fail:function(){
          alert("数据发送失败");
        }
      });
    }
    );  