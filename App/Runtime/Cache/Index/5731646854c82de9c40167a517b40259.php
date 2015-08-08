<?php if (!defined('THINK_PATH')) exit();?><!DOCTTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache"><meta http-equiv="Cache-Control" content="no-cache"><meta http-equiv="expires" content="0"><meta name="description" content="京东金融综合互联网理财服务，基金理财,金融服务，敬请享受! "/><meta name="Keywords" content="众筹,京东理财,网上理财,基金理财,金融服务,马上有钱,理财规划,个人理财,家庭理财,第三方理财,投资理财/"><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/next_support.css"/><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><style type="text/css">
  .time_show{
    text-align: right;
    width: 300px;
    height: 20px;
    float: right;
    position: relative;
    top: -50px;

  }
  .info_time{
    color: #333;
    font-size: 16px;
    margin-right: 10px;
  }
  .ajax_time{
    color: red;
    margin-left: 10px;
  }
    </style></head><body><!--包含头文件的渲染--><!--导航条部分--><!-- Fixed navbar --><div id="bar1"><div class="badge">您好，欢迎来到呆萌！</div><?php  if($_SESSION["user_id"]) { echo "<a href=".U('/my','','').">".$_SESSION["niker"]."</a>"; echo "<a href='###'  class='_exit'>退出</a>"; } else { echo "<a href=".U('/login','','')."  target='_blank'>登录</a>"; echo "<a href=".U('/register','','')." target='_blank'>[免费注册]</a>"; } ?><a href="<?php echo U('/help/124','','');?>">帮助中心</a></div><div id="head_"><ul ><li style="margin-left:100px;"><a href="<?php echo U('/index','','');?>"><img class="top_img" src="__PUBLIC__/res/images/top_pic/1.9.png" style="width:160px"></a></li><li><a class="active_" style=" text-decoration: none;" href="<?php echo U('/index');?>" onfocus="this.blur();">首页</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/item','','');?>" target="_blank">浏览项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/start/agreement','','');?>" target="_blank">发起项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/community','','');?>" target="_blank">呆萌社区</a></li><li><form action="<?php echo U('index/items/index');?>" method="post" ><input class="search_content" type="text" name="search_content" style="width:200px;" placeholder="搜索喜爱的项目" maxlength="15" /><input class="search_sub" type="submit" style="color:#fff;width:70" value="搜索" /></form></li><li    style="margin-left:35px;"><ul id="hid"style="display:inline;"><li class="menus" style="display:block;"><img class="person_img" src="__PUBLIC__/res/images/small_pic/person.png" style="width:46px;"><a  style=" text-decoration: none;color:#33a600;" href="<?php echo U('/person/'.session("user_id"));?>" >个人中心</a></li><li  class="top_dashed" style="padding:0px;margin:0px;"></li><li class="person_blur" style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/support','','');?>">我的众筹</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/news','','');?>">消息中心</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/my','','');?>">个人信息</a></li></ul></li></ul></div><script type="text/javascript">    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";

    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";

    _home="<?php echo U('/Index','','');?>";

    </script><div class="next_support"><div class="next_title" style="padding:5px 10px;">订单提交成功：<?php echo ($returns["dm_items"]["title"]); ?></div><div class="next_content"><div class="time_show" ><span class='info_time' ><h3 style="font-family:'Microsoft YaHei';"> 付款剩余时间:<span class='ajax_time' ><?php echo ($returns["time"]); ?></span></h3></span><input  type="hidden"  class="hid_time"  name="hid_time"  /></div><div><span class="next_weight">订单号：</span><span class="next_info"><?php echo ($returns["widout_trade_no"]); ?></span></div><div><span class="next_weight">联系人：</span><span class="next_info"><?php echo ($returns["dm_address"]["name"]); ?></span></div><div><span class="next_weight">联系方式：</span class="next_info"><span><?php echo ($returns["dm_address"]["phone_number"]); ?></span></div><div class="next_border"><span class="next_weight">收货人信息：</span class="next_info"><span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["name"]); ?></span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["phone_number"]); ?></span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["province"]); ?></span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["town"]); ?></span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["district"]); ?></span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["detial_address"]); ?></span><span style="padding:0px 5px;"><?php echo ($returns["dm_address"]["postcode"]); ?></span></span></div><table><tr class="items_info_title"><td style="width:250px">项目名称</td><td style="width:100px">发起人</td><td style="width:400px">回报</td><td style="width:100px">支付金额</td><td style="width:100px"> 配送费用</td></tr><tr class="items_info"><td><?php  if(strlen($returns["dm_items"]["title"])>15) echo mb_substr($returns["dm_items"]["title"], 0,15,"UTF-8")."..." ?></td><td><?php echo ($returns["itemsapply_user_niker"]); ?></td><td><?php echo ($returns["dm_repay"]["content"]); ?></td><td><?php echo ($returns["dm_repay"]["money"]); ?></td><td><?php echo ($returns["dm_repay"]["send_money"]); ?></td></tr></table><div style="text-align:right"><span style="color:#5e5e5e;margin-right:10px;">应付金额:</span><span style="color:#f35d5d ;font-size:22px;font-weight:bold;">￥<?php echo ($returns["money"]); ?></span></div><form action="<?php echo U('index/pay/doalipay','','');?>"  method="post" ><input type="hidden" size="30" name="WIDout_trade_no" value="<?php echo ($returns["widout_trade_no"]); ?>" /><input type="hidden" size="30" name="WIDtotal_fee" value="<?php echo ($returns["money"]); ?>" /><input type="hidden" size="100" name="WIDsubject" value="<?php echo ($returns["dm_items"]["title"]); ?>" /><input type="hidden" size="200" name="WIDbody" value="<?php echo ($returns["dm_repay"]["content"]); ?>" /><button class="next_sub" type="button" >立即付款</button></form></div></div><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><div class="footer"><div class="footer1" style="height:200px;width:100%;float:left;padding:0px;margin:0px;background: url('__PUBLIC__/res/images/small_pic/ft_bj.png') no-repeat;"><a class="start_it" href="<?php echo U('/start/agreement','','');?>"><img src="__PUBLIC__/res/images/small_pic/start_it.png" style='margin-top:20px;' ></a></div><div id='backtotop'></div><div class="footer2"><div class="intro" ><span ><a href="<?php echo U('/help','','');?>" target="_blank">关于呆萌</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">洽谈合作</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">加入我们</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">联系我们</a></span>|

  	 			<span><a href="<?php echo U('/help/127','','');?>" target="_blank">免责声明</a></span>|

  	 			 <p>Copyright © 2014 呆萌网 www.daymeng.com<br><a href="http://www.miitbeian.gov.cn" style="color:#474e5d">湘ICP备09043258号-2</a> 湖南橙讯科技有限公司 版权所有 <span style="font-size:12px;color:#474e5d">投资有风险，购买需谨慎</span></p></div><div class="calls"><ul ><li><img  style='width:120px;' src="__PUBLIC__/res/images/small_pic/tow_code.jpg" class="tow_code"></li><li><img class="mcalls wx"  src="__PUBLIC__/res/images/small_pic/wx.png"><span class='wx' style='color:#fff;padding-left:5px;'>官方微信</span></li><li><a href="http://weibo.com/u/5240303575" target='_blank'><img class="mcalls" src="__PUBLIC__/res/images/small_pic/sina.png"><span style='color:#fff;padding-left:5px;cursor:pointer;'>官方微博</span></a></li><li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=521187146&amp;site=qq&amp;menu=yes"><img src="__PUBLIC__/res/images/small_pic/kefu.png"></a><span style='color:#fff;padding-left:5px;cursor:pointer;'>在线客服</span></li><!-- 百度统计 --><div style='display:none;'><script type="text/javascript">              var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

              document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F86c414347828cadccc690dd5e0ddd83e' type='text/javascript'%3E%3C/script%3E;"));

              </script></div></ul></div></div></div><!--  <div class="row" ><div class="col-lg-4 "></div><div class="col-lg-2"><a href="<?php echo U('startitem/index');?>"><img src="__PUBLIC__/res/images/small_pic/project.png" style="margin-top:50px;"></a></div><div class="col-lg-3  yxs_change"><div class="row"><div class="col-lg-6 "><img class="tubiao"  src="__PUBLIC__/res/images/small_pic/wx.png"><span >关注微信</span><img src="__PUBLIC__/res/images/small_pic/wx1.png"></div><div class="col-lg-6 "><img class="tubiao" src="__PUBLIC__/res/images/small_pic/wb.png"><span >关注微博</span><a target="_blank" href="http://weibo.com/5240303575/profile?rightmod=1&wvr=5&mod=personinfo"><img  src="__PUBLIC__/res/images/small_pic/wb1.png"></a><p class="address">weibo.stm.com</p></div></div></div><div class="col-lg-3  _email yxs_change"><div class="col-lg-6 "><p>联系邮箱</p><a href="http://mail.163.com/"><img src="__PUBLIC__/res/images/small_pic/email.png">daymeng@163.com</a></div></div></div> --><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/md5.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/next_support.js"></script><script type="text/javascript">
        var t;
        var time=$(".ajax_time").text();
           function settime(TIME){
           var min=Math.floor(TIME/60);
           var sec=TIME%60;
           $(".ajax_time").text(min+"分"+sec+"秒");
            TIME=TIME-1;
           $(".hid_time").val(TIME);
           if(TIME<=0){
            TIME=0;
            clearTimeout(t);
           }
           t=setTimeout("settime("+TIME+")",1000);
        }
        settime(time);

        $(".next_sub").click(function(){
          if($(".hid_time").val()>0){
            //在规定的时间内
            $(".next_sub").parent("form").submit();

          }else{
            alert("此订单已经过期");
          }
        });

                 </script></body></html>