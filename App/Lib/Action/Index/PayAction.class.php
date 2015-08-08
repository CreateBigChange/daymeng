<?php
header("Content-type:text/html;charset=utf-8");
    class PayAction extends Action
    {
         //在类初始化方法中，引入相关类库  
    public function _initialize() {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');    
    }
    /*
    public function index(){
        if(!IS_AJAX){
            _404("页面不存在");
        }
        $
        $this->display();
    }
    */
        //doalipay方法
        /*该方法其实就是将接口文件包下alipayapi.php的内容复制过来
          然后进行相关处理
        */
             /*********************************************************
            把alipayapi.php中复制过来的如下两段代码去掉，
            第一段是引入配置项，
            第二段是引入submit.class.php这个类。
           为什么要去掉？？
            第一，配置项的内容已经在项目的Config.php文件中进行了配置，我们只需用C函数进行调用即可；
            第二，这里调用的submit.class.php类库我们已经在PayAction的_initialize()中已经引入；所以这里不再需要；
            *****************************************************/
    public function doalipay(){
         //这里我们通过TP的C函数把配置项参数读出，赋给$alipay_config；
       $alipay_config=C('alipay_config');  
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = C('alipay.notify_url');
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = C('alipay.return_url'); 
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //卖家支付宝帐户
        $seller_email = C('alipay.seller_email');
        //必填

        //商户订单号
        $out_trade_no = I('WIDout_trade_no');
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = I('WIDsubject');
        //必填

        //付款金额
        $total_fee = I('WIDtotal_fee');
        //必填

        //订单描述

        $body = I('WIDbody');
        //商品展示地址
        $show_url = I('WIDshow_url');
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = get_client_ip();
        //非局域网的外网IP地址，如：221.0.0.1
        $extra_common_param=I("extra_common_param");//公用回传参数

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
        "service" => "create_direct_pay_by_user",
        "partner" => trim($alipay_config['partner']),
        "payment_type"  => $payment_type,
        "notify_url"    => $notify_url,
        "return_url"    => $return_url,
        "seller_email"  => $seller_email,
        "out_trade_no"  => $out_trade_no,
        "subject"   => $subject,
        "total_fee" => $total_fee,
        "body"  => $body,
        "show_url"  => $show_url,
        "anti_phishing_key" => $anti_phishing_key,
        "exter_invoke_ip"   => $exter_invoke_ip,
        "_input_charset"    => trim(strtolower($alipay_config['input_charset'])),
        "extra_common_param"=>$extra_common_param,
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");
echo $html_text;
    }
            /******************************
        服务器异步通知页面方法
        其实这里就是将notify_url.php文件中的代码复制过来进行处理
        
        *******************************/
       public function notifyurl(){
        //  echo p(I('post.'));
        // return ;
                /*
                同理去掉以下两句代码；
                */ 
                //require_once("alipay.config.php");
                //require_once("lib/alipay_notify.class.php");
                
                //这里还是通过C函数来读取配置项，赋值给$alipay_config
        // logResult(implode(',',I('post.'))."1".$dm_trade_info['trade_status']."!='TRADE_SUCCESS'||".$dm_trade_info['total_fee']."!=".$total_fee);
        $alipay_config=C('alipay_config');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {
               //验证成功
                   //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
           $out_trade_no   = $_POST['out_trade_no'];      //商户订单号
           $trade_no       = $_POST['trade_no'];          //支付宝交易号
           $trade_status   = $_POST['trade_status'];      //交易状态
           $total_fee      = $_POST['total_fee'];         //交易金额
            $subject        =$_POST['subject'];          //商品名称
       //    $notify_id      = $_POST['notify_id'];         //通知校验ID。
          $notify_time    = $_POST['notify_time'];       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
           $buyer_email    = $_POST['buyer_email'];       //买家支付宝帐号；
              $parameter = array(
             "WIDout_trade_no"     => $out_trade_no, //商户订单编号；
             "trade_no"     => $trade_no,     //支付宝交易号；
             "total_fee"     => $total_fee,    //交易金额；
             "trade_status"     => $trade_status, //交易状态
         //    "notify_id"     => $notify_id,    //通知校验ID。
              'WIDsubject'           =>$subject,           //商品名称
             "notify_time"   => $notify_time,  //通知的发送时间。
             "buyer_email"   => $buyer_email,  //买家支付宝帐号；
           );
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                $_SESSION["trade_number"]="";
        unset($_SESSION["trade_number"]);
                
        logResult("1".$dm_trade_info['trade_status']."!='TRADE_SUCCESS'||".$dm_trade_info['total_fee']."!=".$total_fee);
      

            if(!$dm_trade_info=M("dm_trade_info")->where("WIDout_trade_no=".$out_trade_no)->find()){
                //查找交易表失败，无此订单,记录下不正常交易,状态记录为1
                $parameter["status"]=1;
                M("dm_check_trade")->save($parameter);
            }else{//查找交易表成功
               //查找交易表成功
            	if($dm_trade_info["trad_status"]!="TRADE_SUCCESS"){
            		//支付宝异步通知时间作为付款完成时间
                 	$parameter["finish_time"]=$notify_time;
                    if(!M("dm_trade_info")->save($parameter)){
                     //更新交易表失败,状态记录为2
                     $parameter["status"]=2;                    
                    M("dm_check_trade")->add($parameter); 
                    return ;
                    }
                    
                $items_id=M("dm_trade_info")->where("WIDout_trade_no=".$out_trade_no)->getField("items_id");
                if(!M("dm_items")->where("id=".$items_id)->setInc("gain",$total_fee)) {
                    //更新项目表,状态记录为2
                   $parameter["status"]=3;
                    //更新出现错误,状态或者费用不一致
                    M("dm_check_trade")->add($parameter); 
                    return ;
                }
                 //支持数增加
                if(!M("dm_items")->where("id=".$items_id)->setInc("sup")){
                	   //更新项目表,状态记录为2
                   $parameter["status"]=4;
                    //更新出现错误,状态或者费用不一致
                    M("dm_check_trade")->add($parameter); 
                    return ;
					} 
            }
            	}

        //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
                
        //注意：
        //该种交易状态只在两种情况下出现
        //1、开通了普通即时到账，买家付款成功后。
        //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

        //调试用，写文本函数记录程序运行情况是否正常
        // logResult("1".$dm_trade_info['trade_status']."!='TRADE_SUCCESS'||".$dm_trade_info['total_fee']."!=".$total_fee);
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
        // logResult("2".$parameter['trade_status']."!='TRADE_SUCCESS'||".$parameter['total_fee']."!=".$total_fee);
        $_SESSION["trade_number"]="";
            unset($_SESSION["trade_number"]);
        if(!$dm_trade_info=M("dm_trade_info")->where("WIDout_trade_no=".$out_trade_no)->find()){
                //查找交易表失败，无此订单,记录下不正常交易
                $parameter["status"]=1;
                M("dm_check_trade")->add($parameter);
            }else{//查找交易表成功
            	if($dm_trade_info["trad_status"]!="TRADE_SUCCESS"){
            		//支付宝异步通知时间作为付款完成时间
                 	$parameter["finish_time"]=$notify_time;
                    if(!M("dm_trade_info")->save($parameter)){
                     //更新交易表失败,状态记录为=

                     $parameter["status"]=2;                    
                    M("dm_check_trade")->add($parameter); 
                    return ;
                    }
                    
                $items_id=M("dm_trade_info")->where("WIDout_trade_no=".$out_trade_no)->getField("items_id");
                if(!M("dm_items")->where("id=".$items_id)->setInc("gain",$total_fee)) {
                    //更新项目表,状态记录为2
                   $parameter["status"]=3;
                    //更新出现错误,状态或者费用不一致
                    M("dm_check_trade")->add($parameter); 
                    return ;
                }
                 //支持数增加
                if(!M("dm_items")->where("id=".$items_id)->setInc("sup")){
                	   //更新项目表,状态记录为2
                   $parameter["status"]=4;
                    //更新出现错误,状态或者费用不一致
                    M("dm_check_trade")->add($parameter); 
                    return ;
					} 
            }
            	}

            	
        //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
                
        //注意：
        //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

        //调试用，写文本函数记录程序运行情况是否正常
        // logResult("2".$dm_trade_info['trade_status']."!='TRADE_SUCCESS'||".$dm_trade_info['total_fee']."!=".$total_fee);
         // logResult("update dm_items set gain=gain+".$total_fee." where id=".$items_id);
    //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                echo "success";        //请不要修改或删除
         }else {
             logResult("3".$dm_trade_info['trade_status']."!='TRADE_SUCCESS'||".$dm_trade_info['total_fee']."!=".$total_fee);

                //验证失败
                echo "fail";
        }

    }else{
        logResult('验证失败'.implode(',',I('post.'))."1".$dm_trade_info['trade_status']."!='TRADE_SUCCESS'||".$dm_trade_info['total_fee']."!=".$total_fee);

    }
}


        /*
        页面跳转处理方法；
        这里其实就是将return_url.php这个文件中的代码复制过来，进行处理； 
        */
    public function returnurl(){
                //头部的处理跟上面两个方法一样，这里不罗嗦了！
        $alipay_config=C('alipay_config');
        $alipayNotify = new AlipayNotify($alipay_config);//计算得出通知验证结果
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
        $out_trade_no   = $_GET['out_trade_no'];      //商户订单号
        $trade_no       = $_GET['trade_no'];          //支付宝交易号
        $trade_status   = $_GET['trade_status'];      //交易状态
        $total_fee      = $_GET['total_fee'];         //交易金额
        $subject        =$_GET['subject'];          //商品名称
//        $notify_id      = $_GET['notify_id'];         //通知校验ID。
//        $notify_time    = $_GET['notify_time'];       //通知的发送时间。
        $buyer_email    = $_GET['buyer_email'];       //买家支付宝帐号；
            
        $parameter = array(
            "WIDout_trade_no"     => $out_trade_no,      //商户订单编号；
            "trade_no"     => $trade_no,          //支付宝交易号；
            "total_fee"      => $total_fee,         //交易金额；
            "trade_status"     => $trade_status,      //交易状态
            'WIDsubject'           =>$subject,           //商品名称
//            "notify_id"      => $notify_id,         //通知校验ID。
//            "notify_time"    => $notify_time,       //通知的发送时间。
            "buyer_email"    => $buyer_email,       //买家支付宝帐号
        );
        
   if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
        // $parameter["finish_time"]=time();
        // if(!M("dm_trade_info")->save($parameter)){//交易信息表更新不成功

        //         $info["error"]= "交易失败，如果您已经付款成功，请联系我们的客服人员";
        //         $info["info"]="fail.png";
        //         $this->assign("info",$info)->display();
        // }else{//交易成功
        //     //总金额加上去
        //        $items_id=M("dm_trade_info")->where("WIDout_trade_no=".$out_trade_no)->getField("items_id");
        //         if(!M("dm_items")->where("id=".$items_id)->setInc("gain",$total_fee)){
        //             //总金额加上去失败
        //              $info["info"]= "fail.png";
        //             $this->assign("info",$info)->display();
        //             return ;
        //         }
        //          //支持数增加失败
        //          if(!M("dm_items")->where("id=".$items_id)->setInc("sup")){
        //              $info["info"]= "fail.png"; 
        //              $this->assign("info",$info)->display();
        //             return ;
        //          }              
                $info["info"]= "success.png";
                $this->assign("info",$info)->display();
       // }
        //--交易成功
        //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
    
   // echo"交易成功";
   /*
        $parameter["user_id"]=$_SESSION["user_id"];
        $parameter["time"]=time();
        $trade_info=M("dm_trade_info")->add($parameter);
        $item=M("dm_items")->where("id=".I("id"))->setInc(I('title'));//更新dm_items数据表
        if($trade_info)
            echo "成功";
        else
            echo "失败，请联系网站客服人员";
*/


    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }

    //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
 }


    }
?>