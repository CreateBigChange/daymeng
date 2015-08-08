<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><title>发起项目</title><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><meta name="description" content="呆萌网,呆萌首页,大学生众筹,大学生社交，呆萌众筹,众筹公益,呆萌基金,呆萌公益,大学生公益"/><meta name="Keywords" content="呆萌网,呆萌首页,大学生众筹,众筹网，大学生社交/"><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><!-- <link rel="stylesheet" href="__PUBLIC__/zc.css"/> --><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/start_item.css"/><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"></head><body><!--导航条部分--><!-- Fixed navbar --><!--导航条部分--><!-- Fixed navbar --><div id="bar1"><div class="badge">您好，欢迎来到呆萌！</div><?php  if($_SESSION["user_id"]) { echo "<a href=".U('/my','','').">".$_SESSION["niker"]."</a>"; echo "<a href='###'  class='_exit'>退出</a>"; } else { echo "<a href=".U('/login','','')."  target='_blank'>登录</a>"; echo "<a href=".U('/register','','')." target='_blank'>[免费注册]</a>"; } ?><a href="<?php echo U('/help/124','','');?>">帮助中心</a></div><div id="head_"><ul ><li style="margin-left:100px;"><a href="<?php echo U('/index','','');?>"><img class="top_img" src="__PUBLIC__/res/images/top_pic/1.9.png" style="width:160px"></a></li><li><a class="active_" style=" text-decoration: none;" href="<?php echo U('/index');?>" onfocus="this.blur();">首页</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/item','','');?>" target="_blank">浏览项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/start/agreement','','');?>" target="_blank">发起项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/community','','');?>" target="_blank">呆萌社区</a></li><li><form action="<?php echo U('index/items/index');?>" method="post" ><input class="search_content" type="text" name="search_content" style="width:200px;" placeholder="搜索喜爱的项目" maxlength="15" /><input class="search_sub" type="submit" style="color:#fff;width:70" value="搜索" /></form></li><li    style="margin-left:35px;"><ul id="hid"style="display:inline;"><li class="menus" style="display:block;"><img class="person_img" src="__PUBLIC__/res/images/small_pic/person.png" style="width:46px;"><a  style=" text-decoration: none;color:#33a600;" href="<?php echo U('/person/'.session("user_id"));?>" >个人中心</a></li><li  class="top_dashed" style="padding:0px;margin:0px;"></li><li class="person_blur" style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/support','','');?>">我的众筹</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/news','','');?>">消息中心</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/my','','');?>">个人信息</a></li></ul></li></ul></div><script type="text/javascript">    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";

    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";

    _home="<?php echo U('/Index','','');?>";

    </script><!--头文件的包含--><!-- 主体部分--><div class="container"><div class="title"><div class="col-md-3 title-content">        发起项目

      </div><div class="col-md-9"></div></div><div class="content1"><div class="col-md-6 content-img"><img src="__PUBLIC__/res/images/top_pic/startitem.png" width="300px;" height="260;" style="margin-left:50px;margin-top:10px;"></div><div class="col-md-6 img-right"><h4>屌丝们的神器，开启属于自己的众筹时代......</h4><p>呆萌众筹是一家可以帮助您实现梦想的网站，在这里您可以发布您的梦想、创意或创业计划等·······筹人、筹钱、筹伙伴，通过呆萌网让一切不可能变为可能，让一切可能变为现实！马上开启属于自己的奇妙“众筹”之旅！</p><p class="content-xy"><input type="checkbox" id="agreement">阅读并同意呆萌众筹 <a href="<?php echo U('/help/125');?>" target="_blank">《服务协议》 </a></p><p><a href="javascript:;" id="startitem"><button type="button" class="btn  btn-danger" >立即发起项目</button></a></p></div></div></div><button data-toggle="modal" data-target="#myModal" id="t_login" style="display:none">   登录

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

    </script><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><div class="footer"><div class="footer1" style="height:200px;width:100%;float:left;padding:0px;margin:0px;background: url('__PUBLIC__/res/images/small_pic/ft_bj.png') no-repeat;"><a class="start_it" href="<?php echo U('/start/agreement','','');?>"><img src="__PUBLIC__/res/images/small_pic/start_it.png" style='margin-top:20px;' ></a></div><div id='backtotop'></div><div class="footer2"><div class="intro" ><span ><a href="<?php echo U('/help','','');?>" target="_blank">关于呆萌</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">洽谈合作</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">加入我们</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">联系我们</a></span>|

  	 			<span><a href="<?php echo U('/help/127','','');?>" target="_blank">免责声明</a></span>|

  	 			 <p>Copyright © 2014 呆萌网 www.daymeng.com<br><a href="http://www.miitbeian.gov.cn" style="color:#474e5d">湘ICP备09043258号-2</a> 湖南橙讯科技有限公司 版权所有 <span style="font-size:12px;color:#474e5d">投资有风险，购买需谨慎</span></p></div><div class="calls"><ul ><li><img  style='width:120px;' src="__PUBLIC__/res/images/small_pic/tow_code.jpg" class="tow_code"></li><li><img class="mcalls wx"  src="__PUBLIC__/res/images/small_pic/wx.png"><span class='wx' style='color:#fff;padding-left:5px;'>官方微信</span></li><li><a href="http://weibo.com/u/5240303575" target='_blank'><img class="mcalls" src="__PUBLIC__/res/images/small_pic/sina.png"><span style='color:#fff;padding-left:5px;cursor:pointer;'>官方微博</span></a></li><li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=521187146&amp;site=qq&amp;menu=yes"><img src="__PUBLIC__/res/images/small_pic/kefu.png"></a><span style='color:#fff;padding-left:5px;cursor:pointer;'>在线客服</span></li><!-- 百度统计 --><div style='display:none;'><script type="text/javascript">              var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

              document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F86c414347828cadccc690dd5e0ddd83e' type='text/javascript'%3E%3C/script%3E;"));

              </script></div></ul></div></div></div><!--  <div class="row" ><div class="col-lg-4 "></div><div class="col-lg-2"><a href="<?php echo U('startitem/index');?>"><img src="__PUBLIC__/res/images/small_pic/project.png" style="margin-top:50px;"></a></div><div class="col-lg-3  yxs_change"><div class="row"><div class="col-lg-6 "><img class="tubiao"  src="__PUBLIC__/res/images/small_pic/wx.png"><span >关注微信</span><img src="__PUBLIC__/res/images/small_pic/wx1.png"></div><div class="col-lg-6 "><img class="tubiao" src="__PUBLIC__/res/images/small_pic/wb.png"><span >关注微博</span><a target="_blank" href="http://weibo.com/5240303575/profile?rightmod=1&wvr=5&mod=personinfo"><img  src="__PUBLIC__/res/images/small_pic/wb1.png"></a><p class="address">weibo.stm.com</p></div></div></div><div class="col-lg-3  _email yxs_change"><div class="col-lg-6 "><p>联系邮箱</p><a href="http://mail.163.com/"><img src="__PUBLIC__/res/images/small_pic/email.png">daymeng@163.com</a></div></div></div> --><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script type="text/javascript">            // var exit_url='<?php echo U("index/login/exit1",'','');?>';

            var sort_url='<?php echo U("index/index/sort1",'','');?>';

            var opnion_url='<?php echo U("index/index/opnion",'','');?>';

            var complaint_url='<?php echo U("index/index/complaint",'','');?>';

            var _home='__APP__';

            var PUBLIC='__PUBLIC__';

            var sign='<?php echo ($sign); ?>';

        </script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/login.js"></script><!-- 只有当用户点击确定协议时才能进行下一步 --><script type="text/javascript">           $('#agreement').click(function(){

            var result=$('#agreement')[0].checked;

            if (result) {

              $('#agreement').bind('click',function(){

                $('#agreement')[0].checked=false;

              });

            }

            else{

                $('#agreement').bind('click',function(){

                   $('#agreement')[0].checked=true;

              });

            }

          });



            $('#startitem').click(function(){

              if (sign==1 && $("#agreement")[0].checked) {

                  $("#startitem").attr("href","<?php echo U('/start/info');?>");

              }

              if (sign==1 && !$("#agreement")[0].checked) {

                  alert('请先同意协议！');

              }

              if (sign==0) {

                   $("#t_login").click();

              }          

            });

        </script></body></html>