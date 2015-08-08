<?php
header("Content-type:text/html;charset=utf-8");
class SupportAction extends Action{
	public function index(){
		if(!$_SESSION["user_id"]){
			$_SESSION["url"]=$_POST["url"];
			$this->redirect('index/login','',1,'请先登录呆萌哦!');
			return 0;
		}
		$user_id=$_SESSION["user_id"];//用户id
		$items_id=I("items_id");//项目id
		$repay_id=I("repay_id");//回报id
		if(!$items_id || !$repay_id){
			echo "请从正确位置进入此页面";
			return 0;
		}
		if(!$items=M("dm_items")->where("id=".$items_id)->find()){
			echo "服务器发生错误";
			return 0;
		}
		if(!$repay=M("dm_repay")->where("id=".$repay_id)->find()){
			echo "服务器发生错误";
			return 0;
		}
		$dm_address=M("dm_address")->where("user_id=".$_SESSION["user_id"]." and del=0")->order("id asc")->limit(5)->select();
		$repay["items_id"]=$items_id;

		// $this->assign("repay",$repay)->display();
		$dm_address1["dm_address"]=$dm_address;
		$dm_address1["repay"]=$repay;
		$dm_address1["items"]=$items;

		$this->assign("dm_address",$dm_address1)->display();
	}




	public function next(){
			if(!$_SESSION["user_id"]){
			$this->redirect('index/login','',1,'请先登录');
			return 0;
		}
		if(!IS_POST){
			echo "请按照正确的方式提交";
		}
			$items_id=$_POST["items_id"];//项目id
			$repay_id=$_POST["repay_id"];//回报id
			$address_id=$_POST["address_id"];//项目地址id
			
			if($_POST["trade_number"]){//订单号post过来
				$widout_trade_no=$_POST["trade_number"];
				$_SESSION["trade_number"]="";
				unset($_SESSION["trade_number"]);
			}else{
				if($_SESSION["trade_number"]){//session存在
					$trade_info=M("dm_trade_info")->where("WIDout_trade_no=".$_SESSION["trade_number"])->find();
			if(!$trade_info){
				$_SESSION["trade_number"]="";
				unset($_SESSION["trade_number"]);
			//通过订单查找失败
			echo "订单已经不存在了,请刷新页面试试哦!";
			return ;
			}
			if($trade_info["trade_status"]=='TRADE_SUCCESS'){//已经支持成功
				$_SESSION["trade_number"]="";
				unset($_SESSION["trade_number"]);
			}
			if(time()-$trade_info["time"]>45*60) {//订单时间已经过期
				$_SESSION["trade_number"]="";
				unset($_SESSION["trade_number"]);
			}else{
				$widout_trade_no=$_SESSION["trade_number"];
			}	
			}
			}
			

			if($widout_trade_no) {//订单号已经存在
			$trade_info=M("dm_trade_info")->where("WIDout_trade_no=".$widout_trade_no)->find();
			$items_id=$trade_info["items_id"];
			$repay_id=$trade_info["repay_id"];
			$address_id=$trade_info["address_id"];
				if(!$dm_repay=M("dm_repay")->where("id=".$repay_id)->find()){
				//回报信息查找失败
				echo "回报信息不存在,订单已经失效".M("dm_repay")->getLastSql();
				return 0;
			}
			if(!$dm_address=M("dm_address")->where("id=".$address_id)->find()){
				//地址信息查找失败
				echo "收货地址不存在,订单已经失效";
				return 0;	
			}

			if(!$dm_items=M("dm_items")->where("id=".$items_id)->find()) {//项目信息
				//项目信息查找失败

			echo "项目已经不存在,订单已经失效";
			return 0;
			}else{
			$itemsapply_user_id=$dm_items["user_id"];
			if(!$itemsapply_user_niker=M("dm_user")->where("id=".$itemsapply_user_id)->find()){
				//项目发起者信息查找失败
				echo "发起者已经不存在,订单已经失效";			
			}
				$itemsapply_user_niker=$itemsapply_user_niker["niker"];			
			}
		$returns["dm_address"]=$dm_address;
		$returns["dm_repay"]=$dm_repay;
		$returns["dm_items"]=$dm_items;
		$returns["time"]=45*60-(time()-$trade_info["time"]);
		if($returns["time"]<=0)
			$returns["time"]=0;
		$returns["money"]=($dm_repay["money"]+$dm_repay["send_money"]);
		$returns["itemsapply_user_niker"]=$itemsapply_user_niker;
		$returns["widout_trade_no"]=$widout_trade_no;
		$this->assign("returns",$returns)->display();
		}
		else{//订单号不存在
		$dm_trade_info["user_id"]=$_SESSION["user_id"];
		$dm_trade_info["repay_id"]=$_POST["repay_id"];
		$dm_trade_info["items_id"]=$_POST["items_id"];
		$dm_trade_info["address_id"]=$_POST["address_id"];
		$dm_trade_info["time"]=time();
		$dm_trade_info["WIDout_trade_no"]=$_SESSION['user_id'].time();
		$dm_trade_info["trade_status"]="待支付";
			if(!M("dm_trade_info")->add($dm_trade_info)) {//订单号
			// echo M("dm_trade_info")->getLastSql();
				$_SESSION["trade_number"]="";
			unset($_SESSION["trade_number"]);
			echo "服务器发送错误4";
			// p($dm_trade_info);
			return 0;
		}else{

			$pay_count=M("dm_trade_info")->where("(repay_id=".$_POST["repay_id"]." and ".time()."- time <45*60 and trade_status!='TRADE_SUCCESS')
			 or "."(repay_id=".$_POST["repay_id"]." and trade_status='TRADE_SUCCESS')")->count();//已经支持的人数
			$limit_ount=M("dm_repay")->where("id=".$_POST["repay_id"])->getField("limits");//限制的人数
			if($pay_count>$limit_ount && $limit_ount!=0 ){//支持的人数大于限制的人数
				M("dm_trade_info")->where($dm_trade_info)->delete();
				echo "该订单已经被别人抢先一步了哦!";
				// echo "该订单已经被别人抢先一步了哦!"."(repay_id=".$_POST["repay_id"]." and ".time()."- time >45*60 and trade_status!='TRADE_SUCCESS')
			 // or "."(repay_id=".$_POST["repay_id"]." and trade_status='TRADE_SUCCESS')";
				return 0;
			}

			// $widout_trade_no=M("dm_trade_info")->where($dm_trade_info)->find();
			$widout_trade_no=$dm_trade_info["WIDout_trade_no"];
		}
			if(!$dm_repay=M("dm_repay")->where("id=".$_POST["repay_id"])->find()){
				//回报信息查找失败
				echo "回报信息不存在,订单已经失效1";
				return 0;
			}
			if(!$dm_address=M("dm_address")->where("id=".$_POST["address_id"])->find()){
				//地址信息查找失败
				echo "地址信息不存在,订单已经失效1";
				return 0;	
			}


		if(!$dm_items=M("dm_items")->where("id=".$items_id)->find()) {//项目信息
			echo "项目信息不存在,订单已经失效1";
			return 0;
		}else{
			$itemsapply_user_id=$dm_items["user_id"];
			if(!$itemsapply_user_niker=M("dm_user")->where("id=".$itemsapply_user_id)->find()){
				echo "发起者已经不存在,订单已经失效1";			
			}
				$itemsapply_user_niker=$itemsapply_user_niker["niker"];			
		}
		$_SESSION["trade_number"]=$dm_trade_info["WIDout_trade_no"];
		$returns["dm_address"]=$dm_address;
		$returns["dm_repay"]=$dm_repay;
		$returns["dm_items"]=$dm_items;
		$returns["time"]=45*60-(time()-$dm_trade_info["time"]);
		if($returns["time"]<=0)
			$returns["time"]=0;
		$returns["money"]=($dm_repay["money"]+$dm_repay["send_money"]);
		$returns["itemsapply_user_niker"]=$itemsapply_user_niker;
		$returns["widout_trade_no"]=$widout_trade_no;
		$this->assign("returns",$returns)->display();

		}
	}
	public function sav_address(){
		if(!IS_AJAX){
			_404("页面不存在");
		}
		$dm_address=$_POST;
		$dm_address["user_id"]=$_SESSION["user_id"];
		if($dm_address["id"]!="undefined"&&$dm_address["id"]){//id存在，更新
			if(M("dm_address")->save($dm_address)){//更新成功
			 $new_dm_address=M("dm_address")->where("user_id=".$_SESSION["user_id"]." and del=0")->order("id asc")->limit(5)->select();
			 $this->ajaxReturn(array("status"=>1,
			 	),'json');
		}else{
			$this->ajaxReturn(array("status"=>0),'json');
		}
		}else{//id不存在,新增
			if(M("dm_address")->where("user_id=".$_SESSION["user_id"])->count()>=5)
			return 0;
			if(M("dm_address")->add($dm_address)){//新增成功
				 $new_dm_address=M("dm_address")->where("user_id=".$_SESSION["user_id"]." and del=0")->order("id desc")->find();
			 $result["status"]=2;
			 $result["id"]=$new_dm_address["id"];
			 $this->ajaxReturn($result,'json');
			}else{
			 $this->ajaxReturn(array("status"=>3),'json');				
			}
		}
		
	}
	public function del_address(){
		if(!IS_AJAX){
			_404("页面不存在");
		}
		$id=I("id");
		if(M("dm_address")->where("id=".$id)->setField('del','1'))
			$this->ajaxReturn(array("status"=>1),"json");
		else
			$this->ajaxReturn(array("status"=>0),"json");

	}

	 public function judge_number(){
	 	if(!IS_AJAX){
	 		return ;
	 	}
	 	$repay=M("dm_repay")->where("id=".I("repay_id"))->find();
	 	if($repay["num"]>$repay["limits"]){
	 		//点击人数超过限制人数
	 	//支付失败(未完成)的项目数
	 	  $repayed_fail=M("dm_trade_info")->where("(repay_id=".I("repay_id")." and trade_status!='TRADE_SUCCESS' and ".time()."-time>45*60 )" )->count();
	 		M("dm_repay")->where("id=".I("repay_id"))->setDec("num",$repayed_fail);//点击数-
	 		$this->ajaxReturn(array(
	 		'limits'=>$repay["limits"],
	 		'repayed'=>$repay["num"],
	 		// 'sql'=>M("dm_trade_info")->getLastSql(),
	 		'status'=>4,
	 		'repayed_fail'=>$repayed_fail,
	 		'id'=>I("repay_id")
	 		),json);

		return ;
	 	}

	 	$limits=M("dm_repay")->where("id=".I("repay_id"))->getField("limits");
	 	//已经有订单的人数（包括支付成功的和在支付时间范围内的）
	 	$repayed=M("dm_trade_info")->where("(repay_id=".I("repay_id")." and trade_status='TRADE_SUCCESS') or (repay_id=".I("repay_id")." and trade_status!='TRADE_SUCCESS' and ".time()."-time<45*60 )" )->count();
	 	if($repayed>$limits){
	 		// M("dm_repay")->where("id=".I("repay_id"))->setDec("num");//点击数-1
	 	//此回报的支持人数已经大于支持人数,不可以继续支持
	 	$this->ajaxReturn(array(
	 		'limits'=>$limits,
	 		'repayed'=>$repayed,
	 		// 'sql'=>M("dm_trade_info")->getLastSql(),
	 		'status'=>0
	 		),json);
	 	return ;
	 
	 }
	 		$trade=M("dm_trade_info")->where("repay_id=".I("repay_id")." and user_id=".$_SESSION["user_id"])->order("time desc")->find();
	 		$time=$trade["time"];
	 		if($time){//如果订单已经存在
	 			if(time()-$time>45*60){//订单时间已经大于45分钟,原来订单已经失效
	 		$this->ajaxReturn(array(
	 		'limits'=>$limits,
	 		'repayed'=>$repayed,
	 		'time'=>$time,
	 		'status'=>1
	 		),json);
	 			
	 			}else{//订单时间已经没有45分钟,原来没有失效，还能继续支付

	 		if($trade["trade_status"]=="TRADE_SUCCESS"){
	 			//已经支持过
	 			$this->ajaxReturn(array(
	 		'limits'=>$limits,
	 		'repayed'=>$repayed,
	 		'time'=>$time,
	 		'status'=>3
	 		),json);
	 		}else{
			$this->ajaxReturn(array(
				 		'limits'=>$limits,
				 		'repayed'=>$repayed,
				 		'time'=>$time,
				 		'status'=>2
				 		),json);
	 			
	 		}

	 		
	 			}
	 		}else{//订单不存在
	 			$this->ajaxReturn(array(
	 		'limits'=>$limits,
	 		'repayed'=>$repayed,
	 		'time'=>$time,
	 		'status'=>1
	 		),json);
	 		}
	 

}



}




?>