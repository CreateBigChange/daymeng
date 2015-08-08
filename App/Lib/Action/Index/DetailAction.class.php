<?php
header("Content-type:text/html;charset=utf-8");
/*d
这是前台首页控制器
*/
Class DetailAction extends Action{
	Public function _initialize(){
		if(isMobile()){
			$this->redirect('index/Mobile/index?items_id ='.I('get.item_id'));
		 	return 0;
		}
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
		   if($count>$limits&&$limits!=0){
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
		   if($count>$limits&&$limits!=0){
		   	//删除
			 M("dm_phone")->where($dm_phone)->delete();
		  	 $this->ajaxReturn(array(
			'Code'=>3,
			));
			 return 0;
			 }
			 M("dm_phone")->where($dm_phone)->delete();

		// 	$phonenum=I('phone_num','','htmlspecialchars');	//电话号码
		//    $dm_phone["repay_id"]=I("fund_repay_id");//项目id
		//    session('fund_phone',I('phone_num','','htmlspecialchars'));
		// //设置验证码session
		// 	$_SESSION["code_time"]=time();//验证码过期时间
		// 	session('send_phone_code',1);//验证码
		// 	$this->ajaxReturn(array(
		// 	'Code'=>1,
		// 	'dm_phone'=>$dm_phone,
		// 	));
		// 	return 0;

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

	public  function ajax_submit()
	{
		if(!IS_AJAX)
		{
			return 0;
		}
			$now_num = M("dm_repay")->where("id = ".I("repay_id"))->getField("num");
			$all_num = M("dm_repay")->where("id = ".I("repay_id"))->getField("limits");
			if($now_num>=$all_num)
			{
				
				$data= 2;
				//表示人数已满
				$this->ajaxReturn($data,'JSON');
			}
			M("dm_repay")->where("id = ".I("repay_id"))->setInc("num");
			$data=1;
			$this->ajaxReturn($data,'JSON');
	}

	Public function prise_ajax()
	{

		$user=M("dm_items");
		$user->where("id=".$_POST["id"])->setInc("prise");
		$data=$_POST["id"];
		$this->ajaxReturn($data,'JSON');
		//赞的ajax
	}
	public function chang_ajax(){
		$newtopic=M();
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
	


	$like_items[1]["constant"] = 100; //常量100
	$this->ajaxReturn($like_items,'JSON');


	}
	Public function attention_ajax(){
		$support=M("dm_items_support");
		$support1=M("dm_items");
		if(!$_SESSION["user_id"])
		{
			$data=1;//表示先登录
			$this->ajaxReturn($data,'JSON');
		}
		if($support->where("items_id = ".$_POST["items_id"]." and user_id=".$_SESSION["user_id"]." and attention =1")->select())
		{
			$data=0;//表示已经赞
			$this->ajaxReturn($data,'JSON');
		}
		else
		{
				$data1["user_id"]=$_SESSION["user_id"];
				$data1["time"]=time();
				$data1["attention"] = '1';
				$data1["items_id"] = $_POST["items_id"];
				$support->add($data1);
				//更新dm_items_support
				$support1->where("id =".$_POST["items_id"])->setInc("attention");
				$data=2;//表示成功
				$this->ajaxReturn($data,'JSON');
		}
		//关注的ajax
	}
	Public function index(){
		//$_GET["item_id"]=1;

		$count=M("dm_detailitem_comment")->where("items_id ='%d'",I('get.item_id'))->count();
		//评论数
		
		$this->assign("count",$count);


		$newtopic = M();
		$sql = "select  * 
		from dm_detailitem_comment  
		where items_id=".$_GET["item_id"]." ORDER  BY  time  Desc limit 0,3
		";
		$topicdata=$newtopic->query($sql);
		$this->assign("topicdata",$topicdata);
		//dump($topicdata);

//最新话题
		$item = M("dm_items");
		
	//猜你喜欢
	$like_items = $newtopic->query("
		select  *  
		from dm_items 
		where item_check = 1
		order by rand() limit 4 
		");

	for($z=0;$z<4;$z++)
	{
		//$like_items[$z]=$item->where("id=".rand($begain,$end))->select();
		$like_items[$z]["gain"]=$like_items[$z]["gain"]+$like_items[$z]["fund_gain"];
		$like_items[$z]["sup"] = $like_items[$z]["sup"] +$like_items[$z]["fund_sup"]; 
		
		$like_items[$z]["img"]=explode(",",$like_items[$z]["new_details"]);
		$like_items[$z]["percent"]=ceil(($like_items[$z]["gain"]/$like_items[$z]["money"])*100);
		//$begain=$end+1;
		//$end=$end+floor(count($like)/4);
		$like_items[$z]["remain_time"]=floor((($like_items[$z]["begin_time"]+$like_items[$z]["time"]*24*3600)-time())/(24*3600));
	}
	


	$like_items[1]["constant"] = 100; //常量100
		$this->assign("like_items",$like_items);
		//dump($like_items);
		
			//猜你喜欢

		
		$data = $item->where("id=".$_GET["item_id"])->select();
				//在浏览项目之前的查看
		//dump($data);
		//dump($_SESSION["admin_id"]);
		if($data[0]["item_check"]==0&&!$_SESSION["dm_admin_id"])
		{
		 if($_SESSION["user_id"]!=$data[0]["user_id"])
			{
			$this->success("项目还没上线哦!",U('/index'));
		
			return ;
			}
		}
		$data["begain_day"]=date('Y-m-d',$data[0]["begin_time"]); 
		$data["end_day"]= date('Y-m-d',($data[0]["begin_time"]+$data[0]["time"]*24*60*60));
		$i=0;
		$token = strtok($data[0]["new_details"], ",");
		//项目图片的检索
		while ($token !== false)
		{
			$data["pic_url"][$i]=$token;
			$token = strtok(",");
			$i++;
			
		}
		//算出结束日期
		$data[0]["end_day"]=date("Y年m月d日", $data[0]["begin_time"]+$data[0]["time"]*24*60*60) ; 
		$data[0]["kepp_day"]= floor(($data[0]["begin_time"]+$data[0]["time"]*24*60*60-time())/(24*60*60));
		
		//算出百分比
		
		$data[0]["gain"]=$data[0]["gain"]+$data[0]["fund_gain"];//总金额=获得+基金
		$data[0]["sup"]=$data[0]["sup"]+$data[0]["fund_sup"];//总支持者=支持者+基金
		$data[0]["sup1"] = $data[0]["sup"];//放在分页的支持数
		$data[0]["percent"]=ceil(($data[0]["gain"]/$data[0]["money"])*100);
		$data[0]["constant"] = 100; //常量100
		//多表联合查询找出用户支持项目数发起项目数和用户昵称 图片 个人说明等
		$Model = new Model(); // 实例化一个model对象 没有对应任何数据表
		$person_info["info"]=$Model->query('
		select 
			dm_user.id,niker,person_description,dm_user_info.img
       from 
            dm_user,dm_user_info,dm_items
       where 
             (dm_items.id="'.$_GET["item_id"].'" and dm_user_info.id=dm_items.user_id and dm_user.id=dm_items.user_id)
		');
		//支持项目的数量
		$person_info["sup_count"]=$Model->query('
		select count(*)
       from dm_trade_info
       where user_id="'.$person_info["info"][0]["id"].'"'
		);
		//发起项目的数量
		$person_info["initiate_count"]=$Model->query('
		select 
			count(*)
       from 
			dm_items
       where user_id="'.$person_info["info"][0]["id"].'"
		');
		//找出该项目所以的支持者里面最新的10个
		
		
		$itme_sup = $Model->query('
		SELECT 
			dm_user.id,niker,dm_user_info.img 
		FROM 
			dm_trade_info,dm_user,dm_user_info
		WHERE 
			dm_trade_info.items_id="'.$_GET["item_id"].'" and dm_user.id=dm_trade_info.user_id and dm_user_info.id = dm_trade_info.user_id  and dm_trade_info.trade_status="TRADE_SUCCESS" Order by time DESC limit 0,10	
		');
		
		
		
		
		//查找所有的回报设置
		$Model_repay = M("dm_repay"); 
		$Model_trade_info = M("dm_trade_info");
		$repay=$Model_repay->where("repay_check=1 and items_id=".$_GET["item_id"])->order('money')->select();
		//找出一个项目的所有回报
	//dump($repay);
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
		///dump($repay);
		//dump($itme_sup);
		//dump($data);
		//dump($person_info);
		//查找相关项目的评论
		$comment = $Model->query('
				select content,dm_detailitem_comment.time,prise_number,img,niker
				from  dm_detailitem_comment,dm_user,dm_user_info
				where dm_detailitem_comment.items_id = 10 and  dm_user.id = dm_detailitem_comment.user_id and dm_user_info.id = dm_detailitem_comment.user_id
			');
		//dump($comment);
		$this->assign('comment',$comment);
		$this->assign('itme_sup',$itme_sup);
		$this->assign('repay',$repay);
		$this->assign('person_info',$person_info);
		$this->assign('data',$data);
		$this->assign('pic_url',$data["pic_url"]);
		$this->display();
	}
	//赞和关注的ajax执行插入

	//显示话题ajax
	Public function topic_ajax()
	{
		$Model = new Model();
		$data = $Model->query('
		select 
			content,
			dm_detailitem_comment.time,
			prise_number,
			img,
			niker,dm_user.id,
			dm_detailitem_comment.id as comment_id
		from  
			dm_detailitem_comment,
			dm_user,
			dm_user_info
		where dm_detailitem_comment.items_id = "'.$_POST["id"].'" and  dm_user.id = dm_detailitem_comment.user_id and dm_user_info.id = dm_detailitem_comment.user_id
		order by time desc
 		limit '.$_POST["begin"].',10
		');
		// $_POST["id"];
		$this->ajaxReturn($data,'JSON');
	}
	//提交插入话题ajax
	public function insert_topic_ajax()
	{
		$data[0]=$_POST["id"];
		$data[1]=$_POST["user_id"];
		$user = M("dm_detailitem_comment");
		$user->items_id=$_POST["id"];
		$user->user_id = $_POST["user_id"];
		$user->content = I('post.content','','htmlspecialchars'); //$_POST["content"];
		$user->time = time();
		$user->add();
		$this->ajaxReturn($data,'JSON');
	}
	//支持者页面的ajax
	public function sup_ajax()
	{
		$data["id"] = $_POST["id"];
		$model= new Model();
		$data["people"]= $model->query('
		select  
			dm_user_info.img,
			niker,
			dm_repay.money,
			dm_user.id
		from
			dm_trade_info,dm_user,dm_user_info,dm_repay
		where 
		dm_trade_info.items_id = "'.$_POST["id"].'"and dm_trade_info.trade_status ="TRADE_SUCCESS" and dm_user.id=dm_trade_info.user_id and dm_user_info.id =dm_trade_info.user_id and dm_repay.id = dm_trade_info.repay_id
		limit '.$_POST["begin"].',8
		');
		//$data["length"] = count($data["people"]);
		
		for($i=0;$i<count($data["people"]);$i++)
		{
			$data["people"][$i]["sup"] = $model->query('
			select count(*)
			from  dm_trade_info
			where dm_trade_info.trade_status ="TRADE_SUCCESS" and dm_trade_info.user_id ='.$data["people"][$i]["id"]
			);
			$data["people"][$i]["set"] = $model->query('
			select count(id) 
			from  dm_items
			where dm_items.user_id ='.$data["people"][$i]["id"]
			);
		}
		$this->ajaxReturn($data,'JSON');
	}
	//添加好友的ajax
	Public function add_friend()
	{
		$user=M();
		//dump ($_SESSION["user_id"]);
		$data1 =$user->query("
		     select * 
			 from 
			  dm_person_friends
			  where user_id=".$_SESSION["user_id"]." and friend_id = ".$_POST["friend_id"]);
		//
		$data2 =$user->query("
		     select * 
			 from 
			  dm_person_friends
			  where friend_id=".$_SESSION["user_id"]." and user_id = ".$_POST["friend_id"]);
		//
		if(!$_SESSION["user_id"])
		{
			$data=1;
		}
		else
		{
			if($data1 || $data2)
			{
				$data = 2;
			}
			else
			{
			//添加到数据库
				$model=M("dm_person_friends");
				$data1["user_id"] = $_SESSION["user_id"];
				$data1["friend_id"] =$_POST["friend_id"];
				$model->add($data1);
				$data=3;
			}
		}
						//1表示请先登录
						//2已是好友请不要重复添加
						//3添加成功
		//var_dump ($_POST["friend_id"][0]);
		$this->ajaxReturn($data,'JSON');
	}
	Public function send_msg_ajax()//给发起者发信息的ajax
	{
		if($_SESSION["user_id"]=="")
		{
			$data="0";
			$this->ajaxReturn($data,'JSON');
		}
		else
		{
			$user=M("dm_news");
			$data["sender_id"]=$_SESSION["user_id"];
			$data["receiver_id"]=I('post.sender_id','','htmlspecialchars'); 
			$data["content"]=I('post.content','','htmlspecialchars'); 
			$data["time"]=time();
			$user->add($data);
			$this->ajaxReturn($data,'JSON');
		}
	}
	Public function topic_prise_ajax()
	{
		    $data=$_POST["id"];
		    M('dm_detailitem_comment')->where('id='.$_POST["id"])->setInc('prise_number',1);
		    $this->ajaxReturn($data,'JSON');
	}
}
?>