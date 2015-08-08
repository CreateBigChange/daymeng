<?php
/**
 * 公众平台控制器，都在一个页面里面
 */
header('Content-Type:text/html;charset=utf-8');
Class PublicplatformAction extends Action{

	
	Public function _initialize(){
	 	 // 初始化的时候检查用户权限,通过session值判断
		// $this->checkRbac();
		$user_id=session('user_id');
		if (!isset($user_id)) {
			$this->redirect('index/Login/index');
		}
		$result = M()->query("select public from dm_user where id = $user_id");
		// var_dump($result);
		if ($result[0]['public']=='0') {
			$this->error('亲，发起项目才拥有公众平台哦。。。',U('/my'));
		}
	}
	
	Public function index(){		//公众平台首页
		$user_id=session('user_id');
		$new=M();
		//得到新收到的消息
		$new_news=$new->query('select count(*) from dm_news where receiver_id= '.$user_id.' and is_read=0');
		//得到关注的人数，不重复
		
		$new_man=$new->query("select count( distinct user_id) from dm_items_support where 
					attention = 1 and dm_items_support.items_id in (select id from dm_items where user_id = $user_id)");
		//支持成功的数目，可能重复
		$all=$new->query("select count(*) from dm_trade_info 
			where trade_status= 'TRADE_SUCCESS' and items_id in (select id from dm_items where user_id = $user_id)");
		
		$username=$new->query("select username from dm_user where dm_user.id = {$user_id}");
		$img=$new->query("select img from dm_user_info where id= {$user_id}");

		session('nickname',$username[0]['username']);
		session('img',$img[0]['img']);

		$nickname=session('nickname');
		$img=session('img');
		// var_dump($img);
		// var_dump($nickname);
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
		$this->assign('news',$new_news);
		$this->assign('man',$new_man);
		$this->assign('all',$all);
		$this->display();
	} 
	 Public function sendGroupMsg(){
	 	//功能拓展，消息发送分类
	 	$nickname=session('nickname');
		$img=session('img');
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
		$this->display();
	 	
	 }
	 public function login(){
	 	// 先圣的登陆界面的控制器
	 	echo '登陆窗口';
	 }
	  Public function manageNews(){
	  	$data=M();
	  	$receiver_id=session('user_id');
	  	$result=$data->query("select dm_news.id,content,time,is_reply,nickname,img 
	  		from 
	  			dm_news,dm_user_info
	  		where 
	  			dm_news.receiver_id={$receiver_id} and dm_user_info.id=dm_news.sender_id");
	  	$nickname=session('nickname');
		$img=session('img');
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
		// var_dump($result);
		foreach ($result as $key => $value) {
	  		$result[$key]['content']=htmlspecialchars_decode($result[$key]['content']);
	  	}
	  	$this->assign('result',$result);

		$this->display();
	 	
	 }
	  Public function manageUser(){
	  	$user=M();
	  	//总的用户量;
	  	$user_id=session('user_id');
	  	$result=$user->query("select id,title from dm_items where user_id = $user_id and item_check = 1");
	  	for ($i=0; $i <count($result) ; $i++) { 
			$result[$i]['title']='项目'.($i+1).': '.$result[$i]['title'];
			$result[$i]['order']='项目'.($i+1);
		}
		$data=M()->query("select WIDout_trade_no,img,nickname,dm_user_info.id,total_fee,time,send from dm_trade_info,dm_user_info where dm_user_info.id = dm_trade_info.user_id 
			and trade_status = 'TRADE_SUCCESS' and items_id in (select id from dm_items where user_id = $user_id) order by time desc ");
	 	foreach ($data as $key => $value) {
	 		$data[$key]['time']=date('n\月j\日',$data[$key]['time']);
	 		if ($data[$key]['send']=='1') {
	 			$data[$key]['send']='已发货';
	 		}
	 		if($data[$key]['send']=='0'){
	 			$data[$key]['send']='未发货';
	 		}
	 	};
	  	$this->assign('title',$result);
	  	$this->assign('data',$data);
	  	$nickname=session('nickname');
		$img=session('img');
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
		$this->display();
	 	
	 }
	 public function setInfo(){
	 	$user=M();
	 	$user_id=session('user_id');
	 	$result=$user->query("select nickname,img,name,sex,address,person_description from dm_user_info where id = {$user_id}");
	 	$nickname=session('nickname');
		$img=session('img');
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
	 	$this->assign('result',$result);
	 	$this->display();
	 }
	 public function logOut(){
	 	//清除session,cookie
	 	session(null);
	 	cookie('password',null);
		cookie('niker',null);
	 	$this->redirect('/index');
	 }
	 public function getinfo(){
	 	// if(!IS_POST) halt('页面不存在');
	 	// 使用kindeditor自带的过滤方式
		$content = '';
		if (!empty($_POST['content'])) {
			if (get_magic_quotes_gpc()) {
					$content = stripslashes($_POST['content']);
				} 
				else {
				$content = $_POST['content'];
			}
		}
	 	$sender_id=session('user_id');
	 	$object=I('post.object','','htmlspecialchars');
	 	$type=I('post.type','','htmlspecialchars');
	 	$send_time=time();	
	 	//判断接受者类型,后期功能拓展,这里的反应有点慢啊。。。。
	 	if ($object=='全部用户'&& $type=='关注者') {
			$con=mysqli_connect('localhost','root','yxs.checent1314','daimeng');
			// mysql_default_chearset('utf8');
			if ( mysqli_connect_errno ()) {
			     printf ( "Connect failed: %s\n" ,  mysqli_connect_error ());
			    exit();
			}
			mysqli_set_charset ( $con ,  "utf8" );
			$sql="call send_groupmsg_all (' {$sender_id} ',' {$content} ',' {$send_time} ');";
			$sql.="call send_msg_atten ( '{$sender_id}')";
			if (mysqli_multi_query($con,$sql)) {
				do{
					// echo 'ok!';
					mysqli_free_result($con);
				}
				while(mysqli_next_result($con));	
			}
			mysqli_close($con);
	 	}
	 	if ($object=='全部用户'&& $type=='支持者') {
			$con=mysqli_connect('localhost','root','yxs.checent1314','daimeng');
			// mysql_default_chearset('utf8');
			if ( mysqli_connect_errno ()) {
			     printf ( "Connect failed: %s\n" ,  mysqli_connect_error ());
			    exit();
			}
			mysqli_set_charset ( $con ,  "utf8" );
			$sql="call send_groupmsg_all (' {$sender_id} ',' {$content} ',' {$send_time} ');";
			$sql.="call send_msg_sup ( '{$sender_id}')";
			if (mysqli_multi_query($con,$sql)) {
				do{
					// echo 'ok!';
					mysqli_free_result($con);
				}
				while(mysqli_next_result($con));	
			}
			mysqli_close($con);
	 	}
	 	$this->redirect('index/Publicplatform/sendGroupMsg');

	 }
	 // 公众平台，用户查看中获取已付款用户信息
	 //后期这里功能要加强，包括未付款用户的展示
	 public function getuser(){
	 	// if(!IS_POST) halt('页面不存在');
	 	$user_id=session('user_id');
	 	$itemid=I('id');
	 	$send= I('send');
	 	if ($itemid=='全部') $sql="select WIDout_trade_no,img,nickname,total_fee,dm_user_info.id,time,send from dm_trade_info,dm_user_info where dm_user_info.id = dm_trade_info.user_id and trade_status = 'TRADE_SUCCESS' and items_id in (select id from dm_items where user_id = $user_id)";
	 	else $sql="select repay_id,img,nickname,dm_user_info.id,total_fee,time,send from dm_trade_info,dm_user_info where items_id = $itemid and dm_user_info.id = dm_trade_info.user_id and trade_status = 'TRADE_SUCCESS' ";
	 	
	 	switch ($send) {
	 		case '已发货':
	 			$sql=$sql. " and send= '1' ";break;
	 		case '未发货':
	 			$sql=$sql." and send= '0' ";break;
	 		case '全部':break;			
	 	}
	 	$sql=$sql.' order by time desc';
	 	$data=M()->query($sql);
	 	foreach ($data as $key => $value) {
	 	$data[$key]['time']=date('n\月j\日',$data[$key]['time']);
	 	if ($data[$key]['send']=='1') {
	 			$data[$key]['send']='已发货';
	 	}
	 	if($data[$key]['send']=='0'){
	 			$data[$key]['send']='未发货';
	 	}
	 	};
	 	$this->ajaxReturn($data);

	 }
	 public function get_reply(){
	 	if (!IS_POST) halt('页面不存在');
	 	$content=I('content','','htmlspecialchars');
	 	$id=$_GET['id'];
	 	$time=time();
	 	$reply=M();
	 	$reply->query("update dm_news set is_reply=1 where id = {$id}");
	 	$data=$reply->query("select sender_id,receiver_id from dm_news where id = $id");
	 	$reply->query("update dm_news set is_read=1 where id = {$id}");
	 	$reply->query("insert into dm_news(sender_id,receiver_id,content,time) values( {$data[0]['receiver_id']}, {$data[0]['sender_id']},'{$content}','{$time}' )");
	 	$this->redirect('index/Publicplatform/manageNews');
	 }
	 public function sendproduct(){
	 	if (!IS_POST) halt('页面不存在');
	 	$id=I('id');
	 	// echo $id;
	 	M()->query("update dm_trade_info set send=1 where WIDout_trade_no = $id");
	 }
	 Public function manageItem(){
	 	$nickname=session('nickname');
		$img=session('img');
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
	 	$this->assign('result',$result);

	 	//杨先生
	 	$items=M("dm_items");
		$data = $items->where("user_id =".$_SESSION["user_id"])->select();
		for($i=0;$i<count($data);$i++)
		{
			if ($data[$i]["item_check"]==3 && time()>$data[$i]["begin_time"]) {
				$data[$i]["item_check"]=4;
			}
			$time=$data[$i]["begin_time"]+$data[$i]["time"]*86400;
			$data[$i]["end_time"]= date('n\月j\日 H:i:s',$time);
			$data[$i]["begin_time"]=date('n\月j\日 H:i:s',$data[$i]["begin_time"]); 
			
			$data[$i]["precent"] =$data[$i]["gain"]/$data[$i]["money"]*100 ;
			//转换未通过的项目的图片路径
			if($data[$i]["item_check"]==0)
			{
				$data[$i]["img"]=str_replace("./", "/wish/", $data[$i]["img"]);
			}

		}
		$this->assign("item",$data);
		$this->display();
	 }
	 Public function manageProduct(){
	 	$user=M();
	  	//总的用户量;
	  	$user_id=session('user_id');
	  	$result=$user->query("select id,title from dm_items where user_id = $user_id and item_check = 1");
	  	for ($i=0; $i <count($result) ; $i++) { 
			$result[$i]['title']='项目'.($i+1).': '.$result[$i]['title'];
			$result[$i]['order']='项目'.($i+1);
		}
		$sql="select 
			       WIDout_trade_no,name,dm_address.province,town,district,detail_address,phone_number,postcode,content,limits,send_money,dm_repay.time,send,dm_items.begin_time
			from 
			       dm_trade_info,dm_repay,dm_address,dm_items
			where 
			       dm_repay.id=dm_trade_info.repay_id 
			and
			       dm_address.id=dm_trade_info.address_id 
			and    
			       trade_status = 'TRADE_SUCCESS'
			and 
			       dm_items.id=dm_trade_info.items_id 
			and 
			       dm_trade_info.items_id in (select id from dm_items where user_id = $user_id and item_check = 1)";
		$sql=$sql.' order by time desc';
		$data=M()->query($sql);
		// echo $sql;
	 	foreach ($data as $key => $value) {
	 		$data[$key]['time']=date('n\月j\日',$data[$key]['begin_time']+(86400*$data[$key]['time']));
	 		if ($data[$key]['send']=='1') {
	 			$data[$key]['send']='已发货';
	 		}
	 		if($data[$key]['send']=='0'){
	 			$data[$key]['send']='未发货';
	 		}
	 	};
	  	$this->assign('title',$result);
	  	$this->assign('data',$data);
	  	$nickname=session('nickname');
		$img=session('img');
		$this->assign('nickname',$nickname);
		$this->assign('img',$img);
		$this->display();
	 }
	 	//发货信息
	 	 public function getpro(){
	 	// if(!IS_POST) halt('页面不存在');
	 	$user_id=session('user_id');
	 	$itemid=I('id');
	 	$send= I('send');
	 	if ($itemid=='全部') $sql="select 
			       WIDout_trade_no,name,dm_address.province,town,district,detail_address,phone_number,postcode,content,limits,send_money,dm_repay.time,send,dm_items.begin_time
			from 
			       dm_trade_info,dm_repay,dm_address,dm_items
			where 
			       dm_repay.id=dm_trade_info.repay_id 
			and
			       dm_address.id=dm_trade_info.address_id 
			and    
			       trade_status = 'TRADE_SUCCESS'
			and 
			       dm_items.id=dm_trade_info.items_id 
			and 
			       dm_trade_info.items_id in (select id from dm_items where user_id = $user_id and item_check = 1)";
	 	
	 	else $sql="select 
			       name,dm_address.province,town,district,detail_address,phone_number,postcode,content,limits,send_money,dm_repay.time,send,dm_items.begin_time
			from 
			       dm_trade_info,dm_repay,dm_address,dm_items
			where 
			       dm_repay.id=dm_trade_info.repay_id 
			and
			       dm_address.id=dm_trade_info.address_id 
			and    
			       trade_status = 'TRADE_SUCCESS'
			and 
			       dm_items.id=dm_trade_info.items_id 
			and 
			       dm_trade_info.items_id = $itemid";
	 	
	 	switch ($send) {
	 		case '已发货':
	 			$sql=$sql. " and send= '1' ";break;
	 		case '未发货':
	 			$sql=$sql." and send= '0' ";break;
	 		case '全部':break;			
	 	}
		$sql=$sql.' order by time desc';
	 	$data=M()->query($sql);
	 	foreach ($data as $key => $value) {
	 	$data[$key]['time']=date('n\月j\日',$data[$key]['begin_time']+(86400*$data[$key]['time']));
	 	if ($data[$key]['send']=='1') {
	 			$data[$key]['send']='已发货';
	 	}
	 	if($data[$key]['send']=='0'){
	 			$data[$key]['send']='未发货';
	 	}
	 	};
	 	$this->ajaxReturn($data);

	 }
}
?>