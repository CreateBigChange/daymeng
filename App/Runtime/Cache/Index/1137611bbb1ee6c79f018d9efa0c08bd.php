<?php if (!defined('THINK_PATH')) exit();?><!Doctype html><html><head><title><?php echo ($data[0]["title"]); ?></title><meta http-equiv="expires" content="0"><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/><!-- 指定以最新的IE版本模式来显示网页 --><meta name="renderer" content="webkit" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><!-- 指定以最新的IE版本模式来显示网页 --><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/><!-- 指定以最新的IE版本模式来显示网页 --><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><link rel="stylesheet" href="__PUBLIC__/res/css/jquery-sinaEmotion-2.1.0.min.css"/><meta name="description" content="呆萌网,呆萌众筹,众筹公益,呆萌基金,呆萌公益,大学生公益"/><meta name="Keywords" content="呆萌网,众筹,呆萌众筹,大学生众筹网,众筹社交,呆萌公益,大学生社交,大学生公益/"><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/DetailedProgramInfo.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/jquery-sinaEmotion-2.1.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/login.js"></script><script language="javascript" type="text/javascript" >

    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";

    _home="<?php echo U('/Index','','');?>";

    </script><button data-toggle="modal" data-target="#myModal1" id="phone" style="display:none">
   登录
</button><style type="text/css">
.get_verify{
	border:1px solid #888888;
	margin-left: 90px;
	border-radius: 25px;
	-web-kit-border-radius: 25px;
	-moz-border-radius: 25px;
	padding: 10px 25px;
	margin-bottom: 20px;
	width: 150px;
	cursor:pointer;
  color: #888;
}
.get_verify_again{
	color: #aaa;
	padding: 1px;
	margin-bottom: 20px;
	width: 50px;
	cursor:pointer;
}
.get_verify_again:hover{
	color: #888;
}
.get_verify:hover{
	background-color:#33a600;
	color: #fff;
}
.phone_sup{
  border:0px;
	display: none;
text-align: center;
padding: 5px 5px;
height: 35px;
color: #ffffff;
background: #FF7F3F;
border-radius: 5px;
-web-kit-border-radius: 5px;
-moz-border-radius: 5px;
width: 220px;
font-size: 18px;
margin: 0px auto;
cursor: pointer;

}
.verify{
	display: none;
}
.phone_num{
	margin-left: 20px;
	margin-bottom: 20px;
}
.alert_phone{
  color: red;
  
}
.again{
  display: none;
}
</style><!-- 按钮触发模态框 --><!-- 模态框（Modal） --><div class="modal fade" id="myModal1" tabindex="-1" role="dialog"  
   aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="width:700px;margin:0px auto;margin-top:100px;"><div class="modal-header" style="background-color:#f3f3f3" style="margin:0px auto
         "><button type="button" class="close" data-dismiss="modal" 
               aria-hidden="true">×
            </button><div class="mobile" style="margin:0px auto;width:600px;height:200px;background:url(__PUBLIC__/res/images/index/phonetest.jpg) no-repeat;"></div></div><div class="modal-body" style="text-align:center;min-height:150px;"><table style="text-align:center;margin:0px auto;"><tr><td style="padding-bottom: 20px;"><span>手机号:  </span><span style='color:#888' >(+86)</span></td><td><input type="text"  name="phone_num" class="phone_num" /></td></tr><tr class="verify"><td style="padding-bottom: 20px;"><span>验证码: </span></td><td><input type="text"  name="verify" class="phone_num" /></td></tr><tr><td colspan="2"><div><input  type='button' class="get_verify  get_verify_again1"  value="免费获取验证码>"  /></a></div></td></tr><tr><td colspan="2"><button class="phone_sup">
                    支持
                  </button></td></tr><tr><td colspan="2"><div style="height:50px;margin-left:0px;font-size: 12px;margin-top:30px;" class="again" >
            如2分钟后仍未收到，请尝试
            <a    href="javascript:void(0);" class="get_verify_again get_verify_again1   " style="text-decoration: none;" >再次获取></a><p class="alert_phone"></p></div></td></tr></table></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal --><script>
   var login_url="<?php echo U('Index/Login/login','','');?>";
      var login_check="<?php echo U('Index/Login/login_check','','');?>";
      var login_verify='<?php echo U("Index/Login/verify","","");?>';
      var login="<?php echo U('Index/Login/','','');?>";
        var rem_login="<?php echo U('Index/Login/rem_login','','');?>";
      var home="<?php echo U('/Index','','');?>"; 
  // $("#t_login").click();
   // $(function () { $('#myModal').modal({
   //    keyboard: true
   // })});

 </script><script type="text/javascript">
    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";
    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";
    </script><!--包含头文件的渲染--><button data-toggle="modal" data-target="#myModal" id="t_login" style="display:none">   登录

</button><style type="text/css">   .verify_{

  display: none;

 }

 li{

  list-style: none;

 }

</style><!-- 按钮触发模态框 --><!-- 模态框（Modal） --><div class="modal fade" id="myModal" tabindex="-1" role="dialog"  

   aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="width:75%;margin:0px auto;margin-top:100px;"><div class="modal-header" style="background-color:#f3f3f3"><button type="button" class="close" data-dismiss="modal" 

               aria-hidden="true">×

            </button><h4 class="modal-title" id="myModalLabel"><img src="__PUBLIC__/res/images/top_pic/1.9.png" style="width:50px"> 登录呆萌账号

            </h4></div><div class="modal-body" style="text-align:center;"><p class="gform-box alert_" style="padding:0px;margin:0px;display:inline;" >&nbsp</p><p class="gform-box" style="margin:10px auto;"><input type="text" class="form-control user_name" id="name" placeholder="邮箱" name="uername" style="width:70%;display:inline;height:40px"><ul  class="alert_username" style="z-index:10;position:absolute;float:left;padding-left:10px;padding-right:10px;letter-spacing:1px;border-left:solid 1px #ccc;border-right:solid 1px #ccc;border-bottom:solid 1px #ccc;display:none;margin-left:60px;width:260px;text-align: left;"></ul><!-- 用户空，显示提示信息 --><span id="user_msg" style="padding-left:10px;color:red;display:none;"></span></p><p class="gform-box" style="margin:10px auto;"><input type="password" class="form-control user_password" id="passwd" name="password"

                                placeholder="密码" style="width:70%;display:inline;height:40px"><!-- 密码空，显示提示信息 --><span id="passwd_msg" style="padding-left:10px;color:red;display:none;"></span></p><p class="gform-box  verify_" style="margin:10px auto;margin-left: 60px;text-align: left;"><input type="text" style="width:30%;display:inline;height:40px" class="form-control" id="ver_code" name="verify"  placeholder="验证码" disabled="true"><img  class='verify' style="padding-left:20px;" src="<?php echo U("Index/Login/verify","","");?>" onclick='this.src="<?php echo U("Index/Login/verify","","");?>?+Math.random()"'/><span id="code_msg" style="padding-left:10px;color:red;display:none;"></span></p><p class="gform-box" style="text-align: left;margin-left: 65px;"><input type=checkbox name="remember" >下次自动登录 

            <span><a href="<?php echo U('index/password/index');?>">&nbsp;&nbsp;忘记密码？</a></span></p><p class="gform-box"><button type="button" class="btn btn-success login  btn-lg btn-block" id="login" name="button" style="width:280px;display:inline;margin:8px 0px;">登 录</button></p></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal --><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script>  // $("#t_login").click();

   // $(function () { $('#myModal').modal({

   //    keyboard: true

   // })});



 </script><script type="text/javascript">    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";

    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";

    var login_check="<?php echo U('Index/Login/login_check','','');?>";

      var login_url="<?php echo U('Index/Login/login','','');?>";

      var rem_login="<?php echo U('Index/Login/rem_login','','');?>";

      var login_verify='<?php echo U("Index/Login/verify","","");?>';

      var login="<?php echo U('Index/Login/','','');?>";

      var home="<?php echo U('/Index','','');?>"; 

    </script><!-- 模态框（Modal） --><div class="modal fade" id="myModal_send" tabindex="-1" role="dialog" 

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">洽谈合作</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">加入我们</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">联系我们</a></span>|

  	 			<span><a href="<?php echo U('/help/127','','');?>" target="_blank">免责声明</a></span>|

  	 			 <p>Copyright © 2014 呆萌网 www.daymeng.com<br><a href="http://www.miitbeian.gov.cn" style="color:#474e5d">湘ICP备09043258号-2</a> 湖南橙讯科技有限公司 版权所有 <span style="font-size:12px;color:#474e5d">投资有风险，购买需谨慎</span></p></div><div class="calls"><ul ><li><img  style='width:120px;' src="__PUBLIC__/res/images/small_pic/tow_code.jpg" class="tow_code"></li><li><img class="mcalls wx"  src="__PUBLIC__/res/images/small_pic/wx.png"><span class='wx' style='color:#fff;padding-left:5px;'>官方微信</span></li><li><a href="http://weibo.com/u/5240303575" target='_blank'><img class="mcalls" src="__PUBLIC__/res/images/small_pic/sina.png"><span style='color:#fff;padding-left:5px;cursor:pointer;'>官方微博</span></a></li><li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=521187146&amp;site=qq&amp;menu=yes"><img src="__PUBLIC__/res/images/small_pic/kefu.png"></a><span style='color:#fff;padding-left:5px;cursor:pointer;'>在线客服</span></li><!-- 百度统计 --><div style='display:none;'><script type="text/javascript">              var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

              document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F86c414347828cadccc690dd5e0ddd83e' type='text/javascript'%3E%3C/script%3E;"));

              </script></div></ul></div></div></div><!--  <div class="row" ><div class="col-lg-4 "></div><div class="col-lg-2"><a href="<?php echo U('startitem/index');?>"><img src="__PUBLIC__/res/images/small_pic/project.png" style="margin-top:50px;"></a></div><div class="col-lg-3  yxs_change"><div class="row"><div class="col-lg-6 "><img class="tubiao"  src="__PUBLIC__/res/images/small_pic/wx.png"><span >关注微信</span><img src="__PUBLIC__/res/images/small_pic/wx1.png"></div><div class="col-lg-6 "><img class="tubiao" src="__PUBLIC__/res/images/small_pic/wb.png"><span >关注微博</span><a target="_blank" href="http://weibo.com/5240303575/profile?rightmod=1&wvr=5&mod=personinfo"><img  src="__PUBLIC__/res/images/small_pic/wb1.png"></a><p class="address">weibo.stm.com</p></div></div></div><div class="col-lg-3  _email yxs_change"><div class="col-lg-6 "><p>联系邮箱</p><a href="http://mail.163.com/"><img src="__PUBLIC__/res/images/small_pic/email.png">daymeng@163.com</a></div></div></div> --></div><script type="text/javascript">