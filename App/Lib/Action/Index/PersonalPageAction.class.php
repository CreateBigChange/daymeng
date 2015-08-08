<?php
header('Content-Type:text/html;charset=utf-8');
Class PersonalPageAction extends Action{


	 Public function _initialize(){
	//  	 // 初始化的时候检查用户权限,通过session值判断
	// 	// $this->checkRbac();
	 	$user_id=session('user_id');
	 	if (!isset($user_id)) {
	 		$this->redirect('/login');
	 	}
	 	$model = M();
		$person_info = $model->query("
		select 
			niker,
			person_description,
			sex,
			address,
			img
		from
			dm_user,dm_user_info
		where dm_user_info.id=".$_SESSION["user_id"]." and dm_user.id = ".$_SESSION["user_id"]
		);
		
		$this->assign("person_info",$person_info);
		
		

	 }


	Public function exit1(){

			// setcookie('username','',time()-3600,'/');
			setcookie('password','',time()-3600,'/');
			setcookie('niker','',time()-3600,'/');
			session_unset();
			session_destroy();
			$this->redirect('/index'); 

	}


	Public function index(){
		$model = M();
		$person_info = $model->query("
		select 
			niker,
			person_description,
			sex,
			address,
			img,
			name,
			bird
		from dm_user,dm_user_info
		where dm_user_info.id=".$_SESSION["user_id"]." and dm_user.id = ".$_SESSION["user_id"]
		);
		//dump($person_info);
		$this->assign("person_info",$person_info);
		$user1 =M("dm_community_comments_first");
		$data1 = $user1->where("user_id=".$_SESSION["user_id"])->order("time")->select();
		//dump ($data1);
		//获取第一层的评论
		$user2 =M("dm_community_comments_second");
		$data2 = $user2->where("user_id=".$_SESSION["user_id"])->order("time")->select();
		//获取第二层的评论
				for($i=0;$i<count($data2);$i++)
		{
			
			$data2[$i]["content"]=stripcslashes($data2[$i]["content"]);//将字符串进行处理
		}
		
		//去除特定的字符串
		//$data = $user->where("user_id=1")->select();
		//dump ($data2);
		//两层安时间排序
		global $i;
		$i=0;
		global $k;
		$k=0;
		global $j;
		$j=0;
		for(;$i<count($data1)&&$k<count($data2);)
		{

				if($data1[$i]["time"]<$data2[$k]["time"])
				{
					$data1[$i]["time"]=date('Y-m-d H:i:s',$data1[$i]["time"]); 
					$data3[$j]=$data1[$i];
					$j++;
					$i++;
					
				}
				else
				{
					$data2[$i]["time"]=date('Y-m-d H:i:s',$data2[$i]["time"]); 
					$data3[$j]=$data2[$k];
					$j++;
					$k++;

				}
					
		}
		if($k<count($data2))
		{
			for(;$k<count($data2);$k++)
			{
				$data2[$k]["time"]=date('Y-m-d H:i:s',$data2[$k]["time"]); 
				$data3[$j] = $data2[$k];
				$j++;
			}
		}
		if($i<count($data1))
		{
			for(;$i<count($data1);$i++)
			{
				$data1[$i]["time"]=date('Y-m-d H:i:s',$data1[$i]["time"]); 
				$data3[$j] = $data1[$i];
				$j++;
			}
		}
		//获取好友的数据

		// dump($data3);
		$this->assign('person_info',$person_info);
		$this->assign('data',$data3);


		//获取消息数目，评论数目，系统消息数目,gjw
		$user_id=session('user_id');
		$newsnum=M()->query("select count(*) from dm_news where receiver_id = $user_id and is_read = 0");
		$grpnum=M()->query("select count(*) from dm_group_receive where receiver_id = $user_id and is_read = 0");
		if ($newsnum[0]['count(*)']>0 || $grpnum[0]['count(*)']>0) {
			session('news',"(新消息)");
			
		}
		// var_dump($grpnum);
		$this->display();
	} 
	Public function myCrowdfunding(){
		$items=M("dm_items");
		$data = $items->where("user_id =".session('user_id'))->select();
		for($i=0;$i<count($data);$i++)
		{
			
			$data[$i]["end_time"]= date('Y-m-d H:i:s',$data[$i]["begin_time"]+$data[$i]["time"]*24*3600);
			$data[$i]["begin_time"]=date('Y-m-d H:i:s',$data[$i]["begin_time"]); 
			$data[$i]["precent"] =$data[$i]["gain"]/$data[$i]["money"]*100 ;
			//转换未通过的项目的图片路径
			//	dump($data);
			if($data[$i]["item_check"]==0)
			{
			
				$data[$i]["img"]=str_replace("./", "/wish/", $data[$i]["img"]);
			
			}
			else
			{
				$data[$i]["img"]=str_replace("./", "/wish/", $data[$i]["new_img"]);
			}
		}
	
		$this->assign("item",$data);
		$this->display();
	} 
	//私信控制器
	Public function newsCenter(){
		// session('user_id',1);
		$user_id=session('user_id');
		// echo $user_id;
		$user=M();
		$data = $user->query("
			select dm_news.id,sender_id,content,
					time,
					is_read,
					dm_user.niker
			from 	dm_user,dm_news
			where   dm_news.receiver_id = $user_id 
			and dm_user.id = dm_news.sender_id 
			and sender_id != 0
		");
		$result = $user->query("select dm_group_receive.id,dm_group_msg.sender_id,content,send_time,is_read,niker 
			from dm_user,dm_group_msg,dm_group_receive 
			where dm_group_receive.new_id = dm_group_msg.id and dm_group_receive.receiver_id = {$user_id} and dm_group_msg.sender_id = dm_user.id"
			);
		// var_dump($result);
		$data_count=count($data);
		for($i=0;$i<$data_count;$i++)
		{
			$data[$i]["time"] =date('m\月d\日',$data[$i]["time"]);
			$data[$i]['preview']=$this->utf_substr($data[$i]['content'],30).'...';
			$data[$i]['content']=htmlspecialchars_decode($data[$i]['content']);
			$data[$i]['mid']='m'.$i;//模态框id
			$data[$i]['type']=0;//0表示私信
			$data[$i]['send_time'] = $data[$i]["time"];
		}
		$result_count=count($result);
		//合并两个数组，一个是从消息表中得到，一个是从群发表中得到。
		for($i=0;$i<$result_count;$i++)
		{
			$result[$i]["send_time"] =date('m\月d\日',$result[$i]["send_time"]);
			$result[$i]['preview']=$this->utf_substr($result[$i]['content'],30).'...';
			$result[$i]['content']=htmlspecialchars_decode($result[$i]['content']);
			$result[$i]['mid']='m'.($data_count+$i);
			$result[$i]['type']=1;//1表示群信息asdas
			$result[$i]['time'] =$result[$i]["send_time"];
			$data[$data_count+$i]=$result[$i];
		}
		// var_dump($data);

		//看到消息的时候，则把消息置空；
		session('news',null);

		$this->assign("data",$data);
		$this->display();
	} 
	Public function changePasswd(){
		if(!$_POST)
		{
		
		}
		else
		{
			$user=M("dm_user");
			$data = $user->where("id=".$_SESSION["user_id"]." and password ='".md5($_POST["old_pwd"])."'")->select();
			//$data=$user->where("id = 27 and password ="."123")->select();
			//dump ($data);
			if(!$data)
			{
				echo '<script>alert("原始密码错误");</script>';
			}
			else
			{
				
				$change["password"] =md5($_POST["user_pwd"]);
				$user->where("id=".$_SESSION["user_id"])->save($change);
				if($user)
				{
					echo '<script>alert("保存成功");</script>';
					//$this->redirect("PersonalPage/changePasswd");
				}
				else
				{
					echo '<script>alert("保存失败");</script>';
					//$this->redirect("");
				}
			}
			
		}
		$this->display();
	}
	Public function managefriends(){
		$user=M();
		$person_f = $user->query("
			select 
				niker,
				img,
				address,
				person_description,
				friend_id
			from 
				dm_user,
				dm_user_info,
				dm_person_friends
			where dm_person_friends.user_id =".$_SESSION["user_id"]." and dm_user.id = dm_person_friends.friend_id and dm_user_info.id = dm_person_friends.friend_id
		");
		$this->assign("person_f",$person_f);
		//dump($person_info);
		$this->display();
	}
	Public function addressManage(){
		if(!$_SESSION["user_id"]){
			$this->redirect('index/login','',1,'请先登录');
			return 0;
		}
		$user_id=$_SESSION["user_id"];//用户id
		$dm_address=M("dm_address")->where("user_id=".$_SESSION["user_id"]." and del=0")->order(	"id asc")->limit(5)->select();
		
		$dm_address1["dm_address"]=$dm_address;
		$this->assign("dm_address",$dm_address1)->display();
	
	
	} 
	Public function tradeInfo(){
		$user = M();
		
		//$limit_time = (time()+60*45);
		echo $limit_time;
		//echo ($_SESSION["user_id"]);
		$data =$user->query("
select dm_items.title,
       dm_repay.money,
       dm_trade_info.trade_status,
       dm_trade_info.time,
       dm_trade_info.items_id,
       dm_trade_info.repay_id,
	   dm_trade_info.WIDout_trade_no
from 
     dm_items,
     dm_trade_info,
     dm_repay
where 
      dm_items.id = dm_trade_info.items_id and
      dm_repay.id = dm_trade_info.repay_id and
      dm_trade_info.user_id = ".$_SESSION["user_id"]
        );

		for($i=0;$i<count($data);$i++)
		{
			
			if(time()-$data[$i]["time"]<60*45)
			{
				$data[$i]["status_zhifu"] =1; 
			}
			else
			{
				$data[$i]["status_zhifu"] =0;
			}
			$data[$i]["time"] = date('m-d H:i:s',$data[$i]["time"]); 
		}
		$this->assign("data",$data);
		//dump($data);
		$this->display();
		
	}
	Public function myInterstItem(){
		$user = M();
		$data = $user->query("
			select  dm_items.title,
					dm_items.id,
					dm_items.items_img
			from 	dm_items,dm_items_support
			where 	dm_items_support.attention = 1 and dm_items_support.user_id = ".$_SESSION["user_id"]." and dm_items.id = dm_items_support.items_id
		");
		//dump($data);
		$this->assign("data",$data);
		$this->display();
	} 
	Public function mysupportItem(){
		$user=M();
		$data = $user->query("
	select dm_trade_info.total_fee,
          dm_trade_info.repay_id,
          dm_trade_info.items_id,
          dm_trade_info.address_id,
          dm_trade_info.time,
          dm_trade_info.trade_status,
          dm_trade_info.WIDout_trade_no,
          dm_items.title,
          dm_items.id,
          dm_items.new_img,
          dm_repay.money,
          dm_repay.send_money
   from dm_trade_info,
        dm_items,
        dm_repay
   where dm_trade_info.user_id =".$_SESSION["user_id"]." and dm_items.id = dm_trade_info.items_id and dm_repay.id = dm_trade_info.repay_id
		");
		for($i=0;$i<count($data);$i++)
		{
			$data[$i]["time"]=date('m-d H:i:s',$data[$i]["time"]);
		}
		//dump ($data);
		$this->assign("data",$data);
		$this->display();
	} 
		// 截取中文字符串，用于预览消息
	Public function utf_substr($str,$len){
		for($i=0;$i<$len;$i++)
		{
			$temp_str=substr($str,0,1);
			if(ord($temp_str) > 127){
				$i++;
				if($i<$len){
				$new_str[]=substr($str,0,3);
				$str=substr($str,3);}
			}
			else{
				$new_str[]=substr($str,0,1);
				$str=substr($str,1);
			}
		}
		return join($new_str);
	} 

	Public function systemNews(){
		// ssession('user_id',1);
		$user_id=session('user_id');
		$news=M();
		$result=$news->query("select id,time,content,is_read from dm_news where receiver_id=$user_id and sender_id=0");
		//将消息预览加入进去
		foreach ($result as $k=>$value) {
			$result[$k]['time']=date('m\月d\日',$result[$k]['time']);
			$result[$k]['preview']=$this->utf_substr($value['content'],15).'....';
			$result[$k]['mid']='m'.$result[$k]['id'];
		}
		//看到消息的时候，则把消息置空；
		// session('news',"");
		$this->assign('result',$result);
		$this->display();
	}
	 //删除消息
	Public function delnews(){
		if (!isPost) halt('页面不存在');
		$id=I('id');
		$type=I('type');
		$news=M();
		if ($type==0) {
			$result=$news->query("delete from dm_news where id=$id");
		}
		if ($type==1) {	
			$result=$news->query("delete from dm_group_receive where id=$id");
		}
	}
	//查看消息
	Public function looknews(){
		if (!isPost) halt('页面不存在');
		$id=I('id');
		$type=I('type');
		$news=M();
		if ($type==0) {
			$news->query("update dm_news set is_read=1 where id=$id");
		}
		if ($type==1) {	
			$news->query("update dm_group_receive set is_read=1 where id=$id");
		}
	
	}

		//消息中心回复消息
	Public function replynews(){
		$receiver_id = $_GET['receiver_id'];
		$content = I('content','','htmlspecialchars');
		$data = array(
			'sender_id' => session('user_id'),
			'receiver_id' => $receiver_id,
			'content' => $content,
			'time' =>time()
			);
		M('dm_news')->data($data)->add();
		$this->redirect('/news');
	}
	
	Public function myComment(){
		$user=M();
		$data=$user->query("
		select dm_user_info.img,
                dm_user.niker,
                dm_user.id as uid,
                dm_community_comments_second.time,
                 dm_community_comments_first.content as c1,
                dm_community_comments_second.content,
                dm_community_comments_second.id,
				dm_community_comments_second.from_id
         from   dm_user,dm_user_info,dm_community_comments_second,dm_community_comments_first
         where  dm_community_comments_first.user_id = ".$_SESSION["user_id"]." and 
                dm_community_comments_second.from_id =dm_community_comments_first.id and 
                dm_user.id=dm_community_comments_second.user_id and 
                dm_user_info.id=dm_community_comments_second.user_id
		");
		for($i=0;$i<count($data);$i++)
		{
			$data[$i]["time"]=date('m-d H:i',$data[$i]["time"]);
		}
		$this->assign("data",$data);

		//看到消息的时候，则把消息置空；
		// session('news',"");
		// var_dump($data);
		$this->display();
	}
	Public function myPage_ajax()
	{
		$data =$_POST["id"];

	if(strstr($_POST["kind"],"yes"))
		{
		//第二层评论
			$User = M("dm_community_comments_second");
			$User->where("id=".$_POST["id"])->delete();
			
		}
		else
		{
		//第一层评论
			$User = M("dm_community_comments_first");
			$User->where("id=".$_POST["id"])->delete();
		}
		
		$this->ajaxReturn($data,'JSON');
	}
	Public function mycomment_ajax()//评论删除的ajax
	{
		preg_match('/[0-9]+/',$_POST["id"],$data);
		$User = M("");
		//echo ($_POST["id"]);p
		$sql="delete from dm_community_comments_second where id=".$data[0];
		$User->query($sql);
		//$this->ajaxReturn($data,'JSON');
	}
	Public function manageFriends_ajax()//评论删除的ajax
	{
		preg_match('/[0-9]+/',$_POST["id"],$data);
		$User = M("");
		//echo ($_POST["id"]);
		$sql="delete from dm_person_friends where friend_id=".$data[0]." and user_id =".$_SESSION["user_id"];
		//echo $sql;
		$User->query($sql);
		//$this->ajaxReturn($data,'JSON');
	}	
	Public function newsCenter_ajax()//评论删除的ajax
	{
		preg_match('/[0-9]+/',$_POST["id"],$data);
		$User = M("");
		//echo ($_POST["id"]);
		$sql="delete from dm_person_friends where friend_id=".$data[0]." and user_id =".$_SESSION["user_id"];
		//echo $sql;
		$User->query($sql);
		//$this->ajaxReturn($data,'JSON');
	}//
	Public function change_info_ajax()//修改个人信息呈现时的ajax
	{
		$user=M();
		$data=$user->query("
			select 
				dm_user.niker,
				dm_user_info.name,
				dm_user_info.sex,
				dm_user_info.address,
				dm_user_info.bird,
				dm_user_info.person_description,
				dm_user_info.name,
				dm_user_info.img
			from 
				dm_user,dm_user_info
			where 
				dm_user.id=".$_SESSION["user_id"]." and dm_user_info.id =".$_SESSION["user_id"]
		);
		
		$this->ajaxReturn($data,'JSON');
	}	
	Public function mypage_upload()//我的页面里面更改个人信息
	{
		//dump($_POST);

	import('ORG.Net.UploadFile');
	$upload = new UploadFile();// 实例化上传类
	$upload->maxSize  = 3145728 ;// 设置附件上传大小
	$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	$upload->savePath =  './Public/res/images/person_img/';// 设置附件上传目录


	if(!$upload->upload()) {// 上传错误提示错误信息没上传图片时其他数据的更新
	// 保存表单数据 包括附件数据

		$user1 = M("dm_user"); // 实例化User对象
		$data1["niker"]=I('post.niker','','htmlspecialchars'); //$_POST["niker"];
		$user1->where("id=".$_SESSION["user_id"])->save($data1);
		//更新dm——user
		$user2 = M("dm_user_info"); // 实例化User_INFO对象
		$data2["nick_name"]=I('post.niker','','htmlspecialchars'); //$_POST["niker"];
		$data2["name"]=I('post.name','','htmlspecialchars'); //$_POST["name"];
		if(I('post.iCheck','','htmlspecialchars')=="woman")
		{
			$data2["sex"]="女";//$_POST["sexr"];
		}
		else
		{
			if(I('post.iCheck','','htmlspecialchars')=="man")
			{
					$data2["sex"]="男";//$_POST["sexr"];asdsa
			}
			else
			{
				$data2["sex"]="";//$_POST["sexr"];
			}
		}


		$data2["bird"]=I('post.bird','','htmlspecialchars');//$_POST["bird"];
		
		if(I('post.province','','htmlspecialchars')!="省份" and I('post.city','','htmlspecialchars')=="地级市")
		{
			$data2["address"]=I('post.province','','htmlspecialchars');//$_POST["address"];
		}
		else
		{
			if( I('post.city','','htmlspecialchars')!="地级市")
			$data2["address"]=I('post.province','','htmlspecialchars').I('post.city','','htmlspecialchars');//$_POST["address"];
		}	
		$data2["person_description"]=I('post.person_description','','htmlspecialchars');//$_POST["person_description"];
		$user2->where("id=".$_SESSION["user_id"])->save($data2);
		if($_COOKIE["niker"]){
		setcookie('niker',$_POST["niker"],time()+3600*24*30,'/');

	}
	$_SESSION["niker"]=$_POST["niker"];
		$this->redirect("personal_page/index");


	}else{// 上传成功 获取上传文件信息

		$info =  $upload->getUploadFileInfo();
	}
	// 保存表单数据 包括附件数据

		$user1 = M("dm_user"); // 实例化User对象
		$data1["niker"]=I('post.niker','','htmlspecialchars'); //$_POST["niker"];
		$user1->where("id=".$_SESSION["user_id"])->save($data1);
		//更新dm——user
		$user2 = M("dm_user_info"); // 实例化User_INFO对象
		$data2["nick_name"]=I('post.niker','','htmlspecialchars'); //$_POST["niker"];
		$data2["name"]=I('post.name','','htmlspecialchars'); //$_POST["name"];
		if(I('post.iCheck','','htmlspecialchars')=="woman")
		{
			$data2["sex"]="女";//$_POST["sexr"];
		}
		else
		{
			if(I('post.iCheck','','htmlspecialchars')=="man")
			{
				$data2["sex"]="男";//$_POST["sexr"];
			}
			else
			{
				$data2["sex"]="";
			}
		
		}
		
		

		$data2["bird"]=I('post.bird','','htmlspecialchars');//$_POST["bird"];
		if(I('post.province','','htmlspecialchars')!="省份" and I('post.city','','htmlspecialchars')=="地级市")
		$data2["address"]=I('post.province','','htmlspecialchars').I('post.city','','htmlspecialchars');//$_POST["address"];
		$data2["person_description"]=I('post.person_description','','htmlspecialchars');//$_POST["person_description"];
		$user2->where("id=".$_SESSION["user_id"])->save($data2);
		//$this->error("修改成功");
//图片裁剪的上传
$source_path = "./Public/res/images/person_img/".$info[0]['savename'];




$source_info = getimagesize($source_path);
$source_width = $source_info[0];
$source_height = $source_info[1];
$source_mime = $source_info['mime'];
$source_ratio = $source_height / $source_width;
$target_ratio = $target_height / $target_width;
// 源图过高
if ($source_ratio > $target_ratio)
{
$cropped_width = $source_width;
$cropped_height = $source_width * $target_ratio;
$source_x = 0;
$source_y = ($source_height - $cropped_height) / 2;
}
// 源图过宽
elseif ($source_ratio < $target_ratio)
{
$cropped_width = $source_height / $target_ratio;
$cropped_height = $source_height;
$source_x = ($source_width - $cropped_width) / 2;
$source_y = 0;
}
// 源图适中
else
{
$cropped_width = $source_width;
$cropped_height = $source_height;
$source_x = 0;
$source_y = 0;
}

switch ($source_mime)
{
case 'image/gif':
$source_image = imagecreatefromgif($source_path);
break;

case 'image/jpeg':
$source_image = imagecreatefromjpeg($source_path);
break;

case 'image/png':
$source_image = imagecreatefrompng($source_path);
break;

default:
return false;
break;
}
$fileName = $info[0]['savename'];
if($_POST["w"]!=0 and $_POST["h"]!=0)
{
$_POST["x"] *=$source_width/304;
 $_POST["y"]=$_POST["y"]*$source_width/304-100; 
$_POST["w"] *=$source_width/304; 
$_POST["h"] *=$source_width/304; 


$cropped_image = imagecreatetruecolor($_POST["w"],$_POST["h"]);


// 裁剪
//imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
imagecopy($cropped_image, $source_image, 0, 0,$_POST["x"],$_POST["y"],$_POST["w"],$_POST["h"]);
// 缩放
$randNumber = mt_rand(00000, 99999). mt_rand(000, 999);
$fileName = substr(md5($randNumber), 8, 16) .".png";
imagepng($cropped_image,"./Public/res/images/person_img/".$fileName);
imagedestroy($cropped_image);
}


//imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);

//保存图片到本地(两者选一)





//图片裁剪的上传


	$data2["img"]=$fileName; // 保存上传的照片根据需要自行组装
	$user2->where("id=".$_SESSION["user_id"])->save($data2);
	//更新dm_user_info
	if($_COOKIE["niker"]){
	setcookie('niker',$_POST["niker"],time()+3600*24*30,'/');

	}
	$_SESSION["niker"]=$_POST["niker"];
	$this->redirect("personal_page/index");
	//	dump($_POST);
	//	dump($upload);
		//$this->success('数据保存成功！');
	}
	Public function manageFriends_send_ajax()//好友管理里面发私信的ajax
	{
		//$data = $_POST["id"];
		$user=M("dm_news");
		$data["sender_id"]=$_SESSION["user_id"];
		$data["receiver_id"]=$_POST["id"];
		$data["content"]=I('post.content','','htmlspecialchars'); //$_POST["content"];
		$data["time"]=time();
		$data=$user->add($data);
		$this->ajaxReturn($data,'JSON');
	}
	Public function mysupportItem_repay_ajax()//支持的项目里面查看回报信息的ajax
	{
		//$data=$_POST["id"];
		$user = M("dm_repay");
		$data=$user->where("id=".$_POST["id"])->select();
		$this->ajaxReturn($data,'JSON');
	}	
	Public function mysupportItem_address_ajax()//支持的项目里面查看收货地址的ajax
	{
		//$data=$_POST["address_id"];
		$user = M("dm_address");
		$data=$user->where("id=".$_POST["address_id"])->select();
		$this->ajaxReturn($data,'JSON');
	}
	Public function myInterstItem_ajax()//取消关注的ajax
	{
		//$data = $_POST["items_id"];
		$user=M("dm_items_support");
		$user->attention=0;
		$user->where("items_id=".$_POST["items_id"]." and user_id=".$_SESSION["user_id"])->delete();
		$user2=M("dm_items");
		//dump($_POST["items_id"]);
		$user2->where("id=".$_POST["items_id"])->setDec('attention',1);
		setcookie("attention".$_POST["items_id"],"1",time()-3600,'/');
		$this->ajaxReturn($data,'JSON');
	}
	Public function comment_submit_ajax()
	{
		$user=M("dm_community_comments_second");
		$data["user_id"]=$_SESSION["user_id"];
		$data["time"]=time();
		$data["content"]=I('post.content','','htmlspecialchars');//$_POST["content"]; 
		$data["from_id"]=$_POST["from_id"];
		$status=$user->add($data);
		//dump($status); 
		//dump($_POST);
		$this->redirect('/comment');
	}	
}
?>