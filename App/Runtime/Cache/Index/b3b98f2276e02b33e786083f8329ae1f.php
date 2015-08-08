<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!-- 指定以最新的IE版本模式来显示网页 --><meta http-equiv="X-UA-Compatible" content="IE=edge"><link href="__PUBLIC__/res/bootstrap/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="__PUBLIC__/res/css/login.css"><title>登录</title><style type="text/css"> .verify_{

  display: none;

 }



  </style></head><body ><div class="header"><div class="header_top"></div><div class="header_main"><div class="logo"><a href="<?php echo U('/index');?>"></a></div><div class="logo-title"><span class="logo-tit user-reg">欢迎登录</span></div><div class="motto"><img src="__PUBLIC__/res/images/small_pic/login_motto.png"></div></div></div><div class="main"><div class="img_left"></div><div class="main_form"><h1>欢迎来到呆萌<span style="font-size:14px;">&nbsp;&nbsp;没有账号？<a href="<?php echo U('/register','','');?>">立即注册</a></span></h1><p class="gform-box alert_" style="padding:0px;margin:0px;display:inline;" >&nbsp</p><p class="gform-box"><input type="text" class="form-control user_name" id="name" placeholder="邮箱" name="uername" style="width:70%;display:inline;" maxlength="32"><ul  class="alert_username" style="z-index:10;position:absolute;float:left;padding-left:10px;padding-right:10px;letter-spacing:1px;border-left:solid 1px #ccc;border-right:solid 1px #ccc;border-bottom:solid 1px #ccc;display:none"></ul><!-- 用户空，显示提示信息 --><span id="user_msg" style="padding-left:10px;color:red;display:none;"></span></p><p class="gform-box"><input type="password" class="form-control user_password" id="passwd" name="password"

                                placeholder="密码" style="width:70%;display:inline;"><!-- 密码空，显示提示信息 --><span id="passwd_msg" style="padding-left:10px;color:red;display:none;"></span></p><p class="gform-box  verify_"><input type="text" style="width:30%;display:inline;" class="form-control" id="ver_code" name="verify"  placeholder="验证码" disabled="true"><img  class='verify' style="padding-left:20px;" src="<?php echo U("Index/Login/verify","","");?>" onclick='this.src="<?php echo U("Index/Login/verify","","");?>?+Math.random()"'/><span id="code_msg" style="padding-left:10px;color:red;display:none;"></span></p><p class="gform-box"><input type=checkbox name="remember" >自动登录 

            <span><a href="<?php echo U('/forget');?>">&nbsp;&nbsp;忘记密码？</a></span></p><p class="gform-box"><button type="button" class="btn btn-success login  btn-lg btn-block" id="login" name="button" style="width:280px;">登 录</button></p></div></div><div class="gbottom"><div class="gbottom-nav"><a href="<?php echo U('/help','','');?>">关于呆萌</a><a href="<?php echo U('/help/130','','');?>">洽谈合作</a><a href="<?php echo U('/help/130','','');?>">加入我们</a><a href="<?php echo U('/help/130','','');?>">联系我们</a><a href="<?php echo U('/help/127','','');?>">免责声明</a><a href="javascript:;">呆萌社区</a><a href="javascript:;">呆萌基金</a></div><div class="gbottom-i">©2014呆萌网&nbsp;湘ICP备09043258号-2</div></div><script src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script src="__PUBLIC__/res/js/login.js" charset="utf-8"></script><script src="__PUBLIC__/res/js/hf.js" charset="utf-8"></script><!-- 验证码显示 --><script type="text/javascript">      var login_url="<?php echo U('Index/Login/login','','');?>";

      var rem_login="<?php echo U('Index/Login/rem_login','','');?>";

      var login_check="<?php echo U('Index/Login/login_check','','');?>";

      var login_verify='<?php echo U("Index/Login/verify","","");?>';

      var login="<?php echo U('Index/Login/','','');?>";

      var home="<?php echo U('/index','','');?>"; 



  </script></body></html>