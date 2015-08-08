<?php if (!defined('THINK_PATH')) exit();?><!DOCTTYPE html><html><head><title>呆萌-大学生众筹社交平台</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache"><meta http-equiv="Cache-Control" content="no-cache"><meta http-equiv="expires" content="1"><meta name="viewport" content="width=device-width, initial-scale=0.3, minimum-scale=0.1, maximum-scale=2.0, user-scalable=yes"/><!--  初始缩放比例   最小缩放比例   最大缩放比例  --><!-- 指定以最新的IE版本模式来显示网页 --><meta name="renderer" content="webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="description" content="呆萌网,呆萌首页,大学生众筹,大学生社交，呆萌众筹,众筹公益,呆萌基金,呆萌公益,大学生公益"/><meta name="Keywords" content="呆萌网,呆萌首页,大学生众筹,众筹网，大学生社交/"><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/zc.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"></head><script type="text/javascript">  detailed = "<?php echo U('index/detail/index');?>";

     prise_ajax='<?php echo U('index/detail/prise_ajax','','')?>';//赞的ajax

</script><body><!--包含头文件的渲染--><!--导航条部分--><!-- Fixed navbar --><div id="bar1"><div class="badge">您好，欢迎来到呆萌！</div><?php  if($_SESSION["user_id"]) { echo "<a href=".U('/my','','').">".$_SESSION["niker"]."</a>"; echo "<a href='###'  class='_exit'>退出</a>"; } else { echo "<a href=".U('/login','','')."  target='_blank'>登录</a>"; echo "<a href=".U('/register','','')." target='_blank'>[免费注册]</a>"; } ?><a href="<?php echo U('/help/124','','');?>">帮助中心</a></div><div id="head_"><ul ><li style="margin-left:100px;"><a href="<?php echo U('/index','','');?>"><img class="top_img" src="__PUBLIC__/res/images/top_pic/1.9.png" style="width:160px"></a></li><li><a class="active_" style=" text-decoration: none;" href="<?php echo U('/index');?>" onfocus="this.blur();">首页</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/item','','');?>" target="_blank">浏览项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/start/agreement','','');?>" target="_blank">发起项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/community','','');?>" target="_blank">呆萌社区</a></li><li><form action="<?php echo U('index/items/index');?>" method="post" ><input class="search_content" type="text" name="search_content" style="width:200px;" placeholder="搜索喜爱的项目" maxlength="15" /><input class="search_sub" type="submit" style="color:#fff;width:70" value="搜索" /></form></li><li    style="margin-left:35px;"><ul id="hid"style="display:inline;"><li class="menus" style="display:block;"><img class="person_img" src="__PUBLIC__/res/images/small_pic/person.png" style="width:46px;"><a  style=" text-decoration: none;color:#33a600;" href="<?php echo U('/person/'.session("user_id"));?>" >个人中心</a></li><li  class="top_dashed" style="padding:0px;margin:0px;"></li><li class="person_blur" style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/support','','');?>">我的众筹</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/news','','');?>">消息中心</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/my','','');?>">个人信息</a></li></ul></li></ul></div><script type="text/javascript">    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";

    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";

    _home="<?php echo U('/Index','','');?>";

    </script><!-- 图片轮播--><div id="myCarousel" class="carousel " data-ride="carousel" ><ol class="carousel-indicators"><li data-target="#myCarousel" data-slide-to="0" class="active"></li><li data-target="#myCarousel" data-slide-to="1"></li><li data-target="#myCarousel" data-slide-to="2"></li><li data-target="#myCarousel" data-slide-to="3"></li></ol><div class="carousel-inner" role="listbox"><div class="item active"><img src="__PUBLIC__/res/images/index/1.png" alt="First slide"></div><div class="item"><img src="__PUBLIC__/res/images/index/2.png" alt="Second slide"></div><div class="item"><a href="/detail/13"><img src="__PUBLIC__/res/images/index/3.png" alt="Third slide"></a></div><div class="item"><a href="/detail/15"><img src="__PUBLIC__/res/images/index/4.png" alt="Four slide"></a></div></div><a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next</span></a></div><!-- /.carousel --><div class="container1 border_control"><div  class="left1" style="width:770;position:relative;float:left;min-height:1200px;" ><div class="row underline" style="margin:0px;"><div class="aa "><span><h2 class="business_project">精品项目</h2></span></div><div class="bb sort"><ul ><li><a class="sort_ " href="javascript:void(0); " onclick='sort1(0)'>综合推荐</a></li><li><a class="sort_ " href="javascript:void(0);"  onclick='sort1(1)'>支持最多</a></li><li><a class="sort_ " href="javascript:void(0);" onclick='sort1(2)'>金额最高</a></li><li><a class="sort_ " href="javascript:void(0);" onclick='sort1(3)'>时间最早</a></li><li  class="_more" style="margin:0px;padding:0px;"><a href="<?php echo U('/item','','');?>" target="_blank" style="font-size:12px;">浏览更多项目</a></li><li></li></ul></div></div><div class="cg"></div></div><div class="right1" style="width:250;position:relative;float:left;margin-left:10px;min-height:1200px;"><div class="notice1" ><div class="notice" ><h3 ><img style="padding:0px;" class="hot_help" src="__PUBLIC__/res/images/index/notice.png"  /><span style="font-size:16px;">呆萌平台上线啦!</span></h3></div><div class="notice_content "><p>
          呆萌众筹公测啦！致力打造不一样的，集梦想、创意、新奇的众筹社交平台，欢迎各种小伙伴儿撒欢、调戏、抱大腿！如果小伙伴们有任何问题,大家可以到社区里留言和讨论哦！   <a href="<?php echo U('./community','','');?>" style="text-decoration:none;color:red;font-weight:900;">        >>点击进入

       </a></p></div></div><div class="wish "><h3 class="wish_title "><img class="hot_help" src="__PUBLIC__/res/images/small_pic/hot_help.png" /><span>呆萌基金</span></h3><div class="love" style="padding:20px;margin:0px;"><!-- <img src="__PUBLIC__/res/images/small_pic/hot_help.gif" style="width:100px;"> -->    呆萌基金，与爱同行，为你代言！ 100万基金总额，向世界为你寻求支持，一起助力成就梦想！

		<p><a href="javascript:;" style="text-decoration:none;color:red;font-weight:900;" onclick="alert('小呆告诉你一个秘密,基金正在滚滚注入中...敬请期待哦!')">        >>点击进入

     	 </a></p></div></div><div class="hot_words"><h3 ><img class="hot_help" src="__PUBLIC__/res/images/small_pic/hot_help.png" />热门话题</h3><?php if(is_array($hots)): foreach($hots as $key=>$v): ?><div class="contents" style="height:50px"><div style="position:relative;float:left;height:40px"><a href="<?php echo U('/community','','');?>?id=<?php echo ($v["id"]); ?>"><?php echo ($v["content"]); ?></a></div><div style="position:relative;float:right;height:29px;width:30;top:-15px;text-align:center;padding-top:3px;"class="topic_"><a href="<?php echo U('/community','','');?>?id=<?php echo ($v["id"]); ?>" style="margin-top:5px;text-decoration:none;color:#fff"><?php echo ($v["com_num"]); ?></a></div></div><?php endforeach; endif; ?></div><div class="hot_words"><h3 ><img class="hot_help" src="__PUBLIC__/res/images/small_pic/hot_help.png" />小呆帮助</h3><div class="contents"><p><a href="<?php echo U('/help/124.html','','');?>" target="_blank">新手帮助</a></p><p><a href="<?php echo U('/help/124.html','','');?>#help1" target="_blank">如何支持众筹项目？</a></p><p><a href="<?php echo U('/help/124.html','','');?>#help3" target="_blank">我的众筹项目失败了会怎么样？</a></p><p><a href="<?php echo U('/help/124.html','','');?>#help4" target="_blank">怎样知道项目团队身份是否属实？</a></p><p><a href="<?php echo U('/help/help124.html','','');?>#help6" target="_blank">我没有收到回报，这时应怎么做？</a></p><p><a href="<?php echo U('/help/help124.html','','');?>#help7" target="_blank">怎么保证我支持的项目得到回报呢？</a></p></div></div><div class="inspect"><h3 ><img class="hot_help" src="__PUBLIC__/res/images/small_pic/hot_help.png" />我要吐槽</h3><div class="contents"><div class="form-group"><textarea maxlength='500' rows='4' class="form-control" rows="2" placeholder='您的槽点就是我们的改进点'></textarea><button type="button" onclick='complaint()'  class="btn btn-default btn-sm">         提交

        </button></div></div></div></div></div><!--包含底部文件的渲染--><!-- 引导页。gglinux --><div id="black"></div><div id="modal"><div class="step" id="stepa"><a href="javascript:;" title="关闭">关闭</a><span title="下一步">下一步</span></div><div class="step" id="stepb"><a href="javascript:;" title="关闭">关闭</a><span title="下一步">下一步</span></div><div class="step" id="stepc"><a href="javascript:;" title="关闭">关闭</a><span title="下一步">下一步</span></div></div><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><div class="footer"><div class="footer1" style="height:200px;width:100%;float:left;padding:0px;margin:0px;background: url('__PUBLIC__/res/images/small_pic/ft_bj.png') no-repeat;"><a class="start_it" href="<?php echo U('/start/agreement','','');?>"><img src="__PUBLIC__/res/images/small_pic/start_it.png" style='margin-top:20px;' ></a></div><div id='backtotop'></div><div class="footer2"><div class="intro" ><span ><a href="<?php echo U('/help','','');?>" target="_blank">关于呆萌</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">洽谈合作</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">加入我们</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">联系我们</a></span>|

  	 			<span><a href="<?php echo U('/help/127','','');?>" target="_blank">免责声明</a></span>|

  	 			 <p>Copyright © 2014 呆萌网 www.daymeng.com<br><a href="http://www.miitbeian.gov.cn" style="color:#474e5d">湘ICP备09043258号-2</a> 湖南橙讯科技有限公司 版权所有 <span style="font-size:12px;color:#474e5d">投资有风险，购买需谨慎</span></p></div><div class="calls"><ul ><li><img  style='width:120px;' src="__PUBLIC__/res/images/small_pic/tow_code.jpg" class="tow_code"></li><li><img class="mcalls wx"  src="__PUBLIC__/res/images/small_pic/wx.png"><span class='wx' style='color:#fff;padding-left:5px;'>官方微信</span></li><li><a href="http://weibo.com/u/5240303575" target='_blank'><img class="mcalls" src="__PUBLIC__/res/images/small_pic/sina.png"><span style='color:#fff;padding-left:5px;cursor:pointer;'>官方微博</span></a></li><li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=521187146&amp;site=qq&amp;menu=yes"><img src="__PUBLIC__/res/images/small_pic/kefu.png"></a><span style='color:#fff;padding-left:5px;cursor:pointer;'>在线客服</span></li><!-- 百度统计 --><div style='display:none;'><script type="text/javascript">              var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

              document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F86c414347828cadccc690dd5e0ddd83e' type='text/javascript'%3E%3C/script%3E;"));

              </script></div></ul></div></div></div><!--  <div class="row" ><div class="col-lg-4 "></div><div class="col-lg-2"><a href="<?php echo U('startitem/index');?>"><img src="__PUBLIC__/res/images/small_pic/project.png" style="margin-top:50px;"></a></div><div class="col-lg-3  yxs_change"><div class="row"><div class="col-lg-6 "><img class="tubiao"  src="__PUBLIC__/res/images/small_pic/wx.png"><span >关注微信</span><img src="__PUBLIC__/res/images/small_pic/wx1.png"></div><div class="col-lg-6 "><img class="tubiao" src="__PUBLIC__/res/images/small_pic/wb.png"><span >关注微博</span><a target="_blank" href="http://weibo.com/5240303575/profile?rightmod=1&wvr=5&mod=personinfo"><img  src="__PUBLIC__/res/images/small_pic/wb1.png"></a><p class="address">weibo.stm.com</p></div></div></div><div class="col-lg-3  _email yxs_change"><div class="col-lg-6 "><p>联系邮箱</p><a href="http://mail.163.com/"><img src="__PUBLIC__/res/images/small_pic/email.png">daymeng@163.com</a></div></div></div> --><button data-toggle="modal" data-target="#myModal" id="t_login" style="display:none">   登录

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

    </script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><!-- 控制引导的js gglinux--><script type="text/javascript">        function getCookie(c_name)

            {

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

              //判断是否存在cookie

              var cookie=getCookie("dm_sign");

              // alert(cookie);

              if (cookie!="dm.yxs") {

                $('#black').css('z-index','200');

                $('#modal').css('z-index','300');

                $('#black,#modal,#stepa').show();

                $('#modal div span').click(function(){

                  var current=$(this).parent();

                  current.hide();

                  current.next().show();

                });

                $('#modal div a,#modal div span:last').click(function(){

                  $('#black,#modal').hide().css('z-index','0');

                });

              }



            });

       </script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/login.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/zc.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><script type="text/javascript">            var opnion_url='<?php echo U("index/index/zan",'','');?>';

            var sort_url='<?php echo U("index/index/sort1",'','');?>';

            var complaint_url='<?php echo U("index/index/complaint",'','');?>';

            var _home="__APP__";

            var PUBLIC='__PUBLIC__';

            var att_url='<?php echo U("index/index/att",'','');?>'

        </script></body></html>