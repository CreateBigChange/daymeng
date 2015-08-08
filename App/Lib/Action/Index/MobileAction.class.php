<?php
header("Content-type:text/html;charset=utf-8");

	Class MobileAction extends Action{
			Public function mb(){
		// echo cookie('dm_sign');
			$dm_items=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time() )->order(array("recommend_level"=>"desc"))->limit("10")->select();
			if(I("type")==0){
			$dm_items=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time() )->order(array("recommend_level"=>"desc"))->limit("10")->select();

			}else{
				if(I("type")==1){
			$dm_items=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time())->order(array("(fund_sup+sup)"=>"desc"))->limit("10")->select();

		}else{
			if(I("type")==2){
			$dm_items=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time())->order(array("(fund_gain+gain)"=>"desc"))->limit("10")->select();

		}else{
			if(I("type")==3){
			$dm_items=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time())->order(array("begin_time"=>"asc"))->limit("10")->select();

			}else{
			$dm_items=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time() )->order(array("recommend_level"=>"desc"))->limit("10")->select();

			}
			}
			}
			}
			if($dm_items){
				$i=0;
					while($dm_items[$i]){
					 $dm_items[$i]["remaining_day"]= $dm_items[$i]["time"]-floor((time()-$dm_items[$i]["begin_time"])/24/3600);
					 $dm_items[$i]["gain"]=sprintf("%.1f",$dm_items[$i]["gain"]+$dm_items[$i]["fund_gain"]);
					 $dm_items[$i]["gained"]=ceil($dm_items[$i]["gain"]/$dm_items[$i]["money"]*100);
					 $dm_items[$i]["sup"]=$dm_items[$i]["sup"]+$dm_items[$i]["fund_sup"];
					 // $dm_items[$i]["gain"]=substr($dm_items[$i]["gain"],0,strpos($dm_items[$i]["gain"],".")).'.'.ceil(substr($dm_items[$i]["gain"],strpos($dm_items[$i]["gain"],".")+1,strpos($dm_items[$i]["gain"],".")+2)/100.0);
					 if(strlen($dm_items[$i]["items_description"])>50)
					 $dm_items[$i]["items_description"]= mb_substr($dm_items[$i]["items_description"],0,50,"UTF-8")."...";
					 $i++;
			}

		}
		$this->items=$dm_items;
		$this->display();

	}

		
		public function check_code(){
		//验证验证码
		if(!$_SESSION["user_id"]){
			$this->ajaxReturn(array(
			'Code'=>4,
			));
			return 0;
		}
		if(!IS_AJAX){
			return ;
		}
		if(time()-$_SESSION["code_time"]>60*10){//验证码已经过了十分钟
			$this->ajaxReturn(array(
			'Code'=>3,
			));
			return ;
		}
		if($_POST["receive_code"]==$_SESSION["send_phone_code"] && isset($_POST["receive_code"])) {
			//接收过来的验证码等于发送过去的验证码,验证成功，返回1，清除session
			// unset($_SESSION["send_phone_code"]);			
			$dm_phone["repay_id"]=I("fund_repay_id");
		    $dm_phone["phone_number"]=$_SESSION["fund_phone"];
		    if( $phone=M("dm_phone")->where($dm_phone)->find()){
			 	//该号码已经支持过该项目
			 $this->ajaxReturn(array(
			'Code'=>2,
			// 'send_phone_code'=>$_SESSION["send_phone_code"],
			// 'receive_code'=>$_SESSION["receive_code"],
			));
			 return 0;
			 }
			 $dm_phone["item_id"]=I("fund_item_id");
			$dm_phone["user_id"]=$_SESSION["user_id"];
			 M("dm_phone")->add($dm_phone);
			$count=M("dm_phone")->where('repay_id='.I("fund_repay_id"))->count();//这个项目的基金支持数
		    $limits=M("dm_repay")->where("id=".I("fund_repay_id"))->getField("limits");//回报的限定人数
		   if($count>$limits){
		   	//删除
			 M("dm_phone")->where($dm_phone)->delete();
		  	 $this->ajaxReturn(array(
			'Code'=>5,
			));
			 return 0;
			 }
		
			
			 $result1=M("")->query("update dm_items set fund_sup=fund_sup+1,fund_gain=fund_gain+1 where id=".I("fund_item_id")."");
			 //支持成功之后清楚验证码
			 unset($_SESSION["send_phone_code"]);
			 $this->ajaxReturn(array(
			'Code'=>1,
			// 'send_phone_code'=>$_SESSION["send_phone_code"],
			// 'receive_code'=>$_SESSION["receive_code"],
			// 'sql'=>M("dm_phone")->getLastSql()
			));
		}else{
		//验证码错误，返回0
			$this->ajaxReturn(array(
			'Code'=>0,
			// 'send_phone_code'=>$_SESSION["send_phone_code"],
			// 'receive_code'=>$_POST["receive_code"],
			));
		}
	}

	public function check_phone()
	{
		//获取验证码
			 	//该号码已经支持过该项目
		import('Class.SendMsg',APP_PATH);
		// $phonenum="13017148493";
		// $phonecode="{\"param1\":\"1000\"}";
		if (!IS_AJAX) {
			halt('页面不存在！');
		}
			 
		 //电话号码
		  $phonenum=I('phone_num','','htmlspecialchars');	
		   
		   $dm_phone["repay_id"]=I("fund_repay_id");//项目id
		   $dm_phone["phone_number"]=$phonenum;
		  
		 if( $phone=M("dm_phone")->where($dm_phone)->find()){
			 	//该号码已经支持过该项目
			 $this->ajaxReturn(array(
			'Code'=>2,
			// 'send_phone_code'=>$_SESSION["send_phone_code"],
			// 'receive_code'=>$_SESSION["receive_code"],
			));
			 return 0;
			 }
			 M("dm_phone")->add($dm_phone);
			$count=M("dm_phone")->where('repay_id='.I("fund_repay_id"))->count();//这个项目的基金支持数
		    $limits=M("dm_repay")->where("id=".I("fund_repay_id"))->getField("limits");//回报的限定人数
		   if($count>$limits){
		   	//删除
			 M("dm_phone")->where($dm_phone)->delete();
		  	 $this->ajaxReturn(array(
			'Code'=>3,
			));
			 return 0;
			 }
			 M("dm_phone")->where($dm_phone)->delete();
		$this->security_code=rand(10000,99999);
		$phonecode="{\"param1\":\"{$this->security_code}\"}";
		$msg=new SendMsg($phonenum,$phonecode);
		$msg->init();
		// $this->security_code=10000;
		// $code=session('security_code');
		//设置手机号码session
		session('fund_phone',I('phone_num','','htmlspecialchars'));
		//设置验证码session
		$_SESSION["code_time"]=time();//验证码过期时间
		session('send_phone_code',$this->security_code);//验证码
		$this->ajaxReturn(array(
			'Code'=>1
			));
		return 0;
	
	}

		
		Public function index()
		{
			
			
			//return 0;
			//dump($_GET['items_id_']);
			//var_dump($_GET);
			$_GET["id"]=I('get.items_id_');
			
			//判断是否登陆
			$data=M("dm_items")->where("id=".$_GET["id"])->select();
			$data[0]["gain"] = $data[0]["gain"]+$data[0]["fund_gain"];//计算获得的总钱
			$data[0]["percent"]=ceil(($data[0]["gain"]/$data[0]["money"])*100);//计算百分比
			$data[0]['sup'] =$data[0]['sup']+$data[0]['fund_sup']; //计算总得支持人数
			$data[0]["kepp_day"]= floor(($data[0]["begin_time"]+$data[0]["time"]*24*60*60-time())/(24*60*60));//计算剩余的天数
			
			
		//查找所有的回报设置
		$Model_repay = M("dm_repay"); 
		$Model_trade_info = M("dm_trade_info");
		$repay=$Model_repay->where("repay_check=1 and items_id=".$_GET["id"])->select();
		//找出一个项目的所有回报

		//查找每一项回报的支持人数
		for($i=0;$i<count($repay);$i++)
		{	
			if($repay[$i]["money"]==0)
			{
				$repay[$i]["num"]=$data[0]["fund_sup"];
				$repay[$i]["number"]=$data[0]["fund_sup"];
				$fund_repay_id = $repay[$i]["id"];
				//echo $repay[$i]["id"];
			}
			else
			{
				$repay[$i]["num"]=$Model_trade_info->where("trade_status='TRADE_SUCCESS' and repay_id = ".$repay[$i]["id"])->count();
				
			
				$repay[$i]["number"]=M("dm_trade_info")->where("(repay_id=".$repay[$i]["id"]." and ".time()."- time <45*60 and trade_status!='TRADE_SUCCESS')
					or "."(repay_id=".$repay[$i]["id"]." and trade_status='TRADE_SUCCESS')")->count();//已经支持的人数

			
				
				//$repay[$i]["number"]=M("dm_trade_info")->where("(repay_id=".$repay[$i]["id"]." and trade_status='TRADE_SUCCESS') or (repay_id=".$repay[$i]["id"]." and trade_status!='TRADE_SUCCESS' and ".time()."-time<2*60 )" )->count();
			}
			
			$repay[$i]["content"]=explode(" ",$repay[$i]["content"]);
		}
		$this->assign("fund_repay_id",$fund_repay_id);
		//猜你喜欢
		$newtopic = M();
			$like_items = $newtopic->query("
				select  *  
				from dm_items 
				where item_check = 1
				order by rand() limit 4 
			");
	for($z=0;$z<4;$z++)
	{
		//$like_items[$z]=$item->where("id=".rand($begain,$end))->select();
		$like_items[$z]["img"]=explode(",",$like_items[$z]["new_details"]);
		$like_items[$z]["percent"]=ceil(($like_items[$z]["gain"]/$like_items[$z]["money"])*100);
		//$begain=$end+1;
		//$end=$end+floor(count($like)/4);
		$like_items[$z]["remain_time"]=floor((($like_items[$z]["begin_time"]+$like_items[$z]["time"]*24*3600)-time())/(24*3600));
	}
	

	//dump($like_items);
	$like_items[1]["constant"] = 100; //常量100
		$this->assign("like_items",$like_items);
		//猜你喜欢
			//dump($repay);
			$this->assign("data",$data);
			$this->assign("repay",$repay);
			//dump($data);
			$this->display();
		}
	} 
?>