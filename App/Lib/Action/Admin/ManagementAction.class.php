<?php
header("Content-type:text/html;charset=utf-8");

/*
后台管理控制器
*/
class ManagementAction extends Action{

	Public function send_msg(){
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}
		if(!IS_POST){
			return 0;
		}
		$news["sender_id"]=0;
		$receiver_id=M("dm_user")->where("username='".I("username")."'")->getField("id");
		$news["receiver_id"]=$receiver_id;
		$news["content"]=I("send_msg");
		$news["time"]=time();
		if(I("username")==0){
			//群发
			echo "公共还未实现";
			return ;
			M("")->query("
				insert into dm_news(sender_id,receiver_id,content,time) value(,,,) 
				");
		}else{
			//单发

			if(M("dm_news")->add($news)) {
				echo "发送成功";
			}else{
				echo "发送失败";
			}

		}
		
	}
	Public function apply_info_recover(){
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}
		if(M(I("kinds"))->where("id=".I("id"))->setField("success","0") ){
			//删除成功
				$this->redirect("admin/index/".I('turn'),'',1,"恢复成功,页面自动跳转到浏览页面");

		}else{
			echo "恢复失败";
		}
	}
	Public function opration(){//具体操作
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
			$result=detail_opration(I("kinds"),I("table_name"),I("id"));
			if($result){//$result不为空,操作为修改
				$this->user=$result;
				// p($result);return ;
				$this->display();
			}else{//为空是删除操作

				if(I("table_name")=="community_comments_first"){
				$this->redirect("admin/index/comment_manage",'',1,"操作成功,页面自动跳转");					
				}else{
					if(I("table_name")=="community_comments_second"){
					$this->redirect("admin/index/comment_second_manage",'',1,"操作成功,页面自动跳转");					
					}else{
						if(I("table_name")=="user"){
						$this->redirect("admin/index/user_manage",'',1,"操作成功,页面自动跳转");

						}
					}
				}
			}
			}
		}
		Public function hf_comment(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
		if(M(I("table_name"))->where("id=".I("id"))->setField("deleted","0")){//删除帖子成功
				$this->redirect("admin/index/".I('kinds'),'',1,"恢复成功,页面自动跳转到浏览页面");
		}else{
				$this->redirect("admin/index/".I('kinds'),'',1,"恢复失败,页面自动跳转到浏览页面");

		}
		}
		Public function delete_comment(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
		if(M(I("table_name"))->where("id=".I("id"))->setField("deleted","1"))  {//删除帖子成功
				$this->redirect("admin/index/".I('kinds'),'',1,"删除成功,页面自动跳转到浏览页面");
		}else{
				$this->redirect("admin/index/".I('kinds'),'',1,"删除失败,页面自动跳转到浏览页面");

		}
		}
		Public function sav_change(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
			if(!IS_POST){
				echo "请正确提交";
				return 0;
			}
			$user=I("post.");
			$pre_user=M("dm_user")->where("id=".$user["id"])->find();
			if(md5($uer["password"])==$pre_user["password"]){//密码没有修改
				unset($user["password"]);
			}else{
				$user["password"]=md5($user["password"]);
			}
			if(M("dm_user")->save($user)) {
				$this->redirect("admin/index/user_manage",'',1,"修改成功");
			}else{
				// M("dm_user")
				$this->redirect("admin/index/user_manage",'',1,"修改失败");

			}
		}

		Public function item_delete(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
			$save["item_check"]=2;
			if(M("dm_items")->where("id=".I("id"))->save($save)){
				$this->redirect("admin/index/item_check",'',1,"删除待审核项目成功，1秒钟之后跳转到下一审核项目");
			}else{
				$this->redirect("admin/index/item_check",'',1,"删除待审核项目失败，1秒钟之后跳转到下一审核项目");
			}
		}
			Public function item_recover(){
			$save["item_check"]=0;
			if(M("dm_items")->where("id=".I("id"))->save($save)){
				$this->redirect("admin/index/item_check",'',1,"恢复待审核项目成功，1秒钟之后跳转");
			}else{
				$this->redirect("admin/index/item_check",'',1,"恢复待审核项目失败，1秒钟之后跳转到下一审核项目");
			}
		}
		Public function items_check(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
			if(!IS_POST){//不是post提交
				echo "请按照正确的方式提交";
				return;
			}
		
			$details_file_path="./Public/res/images/detailed/";//details详细项目图片上传路径
			$index_file_path="./Public/res/images/index/";//index项目简介图片
			$items_file_path="./Public/res/images/Items/";//items下浏览时的图片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			if($_POST["sure_check"]=="确认通过审核"||$_POST["sure_check"]=="确认修改"){
			if($_FILES["new_img"]["size"]!=0){
			if($_FILES["new_img"]["size"]>2046*1000||$_FILES["new_img"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_img"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_img"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_img"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_img"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确"."(错误的图片格式为:".$post_fix.")";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				// echo $tmp_index_file_name."<br>";
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 } else{
	 	 		$index_last_name="";
	 	 	}
	 	 	if($_FILES["items_img"]["size"]!=0){
	 	 	if($_FILES["items_img"]["size"]>2046*1000||$_FILES["items_img"]["size"]<10*1000){//10KB到2M之间的大小
	  			//浏览项目图片
	  			echo "items_img文件大小不合适"."(错误的图片大小为:".$_FILES["items_img"]["size"].")";
	  			return 0;
	 	 	}else{
	 	 		$tmp_items_file_name=$_FILES["items_img"]["tmp_name"];
	 	 		$items_file_name=$_FILES["items_img"]["name"];
	  			$post_fix=substr($items_file_name, strrpos($items_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo "items_img文件格式不正确"."(错误的图片格式为:".$post_fix.")";
	  			exit();
	  			}
	  			$items_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$items_file_path.$items_last_name;
	  			if(move_uploaded_file($tmp_items_file_name, $upload_file_name)){
	  			echo $items_file_name."上传成功<br>";	  				
	  			}else{
	  				// echo $tmp_items_file_name;
	  			echo $items_file_name."上传失败 <br>";	  
	  			return 0;
	  			}
	 	 	}
	 	 }else{
	 	 		$items_last_name="";
	 	 	}
	 	 	$details_names="";
	 	 	$judge=1;
			foreach ($_FILES["pic"]["error"] as $key => $error) { 
			//详细内容的图片
	  		if ($error =="UPLOAD_ERR_OK") {
	  		if($_FILES["pic"]["size"][$key]!=0){ 
	  			if($_FILES["pic"]["size"][$key]>2046*1000||$_FILES["pic"]["size"][$key]<10*1000){//10KB到2M之间的大小
	  			echo $_FILES["pic"]["name"][$key]."文件大小不合适"."(错误的图片大小为:".$_FILES["items_img"]["size"].$_FILES["pic"]["size"][$key].")";
	  			return 0;
	 	 	}
	 	 	else{
	 	 			//系统中暂时存储的文件名
		  	$tmp_name=$_FILES["pic"]["tmp_name"][$key];
	  		//实际的文件名
	  		$name=$_FILES["pic"]["name"][$key];
			//文件后缀名
	  		$post_fix=substr($name, strrpos($name, ".")) ;//文件后缀名
	  		if(!in_array($post_fix,$image_type)){//后缀名不正确
	  		echo "文件格式不正确";
	  		exit();
	  		}
	  		//存储到数据库中的文件名
	  		$details_last_name=I("id")."_".$key."_".time().$post_fix;
	  		if($judge==1){
	  		$details_names=$details_last_name;
			$judge=2;	  			
	  		}
	  		else
	  		$details_names=$details_names.",".$details_last_name;
	  		//上传之后的文件路径和名称
	  		$upload_file_name=$details_file_path.$details_last_name;
	  		if(move_uploaded_file($tmp_name, $upload_file_name)){
	  		echo $index_file_name."上传成功<br>";	  			
	  		}else{
	  			echo $tmp_name;
	  		echo $index_file_name."上传失败<br>";	
	  		return 0;
	  		}
	 	 	}
	 	 }
	 	 }
	 	 	
}
			
			$sav["id"]=I("id");
			$sav["apply_type"]=I("apply_type");
			$sav["title"]=I("title");
			if($index_last_name)
			$sav["new_img"]=$index_last_name;
			if($details_names)
			$sav["new_details"]=$details_names;
			if($items_last_name)
			$sav["items_img"]=$items_last_name;
			$sav["item_check"]=I("item_check");
			$sav["items_description"]=I("items_description");
			$sav["money"]=I("money");
			$sav["time"]=I("time");
			$sav["begin_time"]=strtotime(I("begin_time"));
			$sav["items_classes"]=I("items_classes");
			$sav["province"]=I("province");
			$sav["recommend_level"]=I("recommend_level");
			$sav["city"]=I("city");
			if(M("dm_items")->save($sav)){
			//	echo U('admin/index/item_check');
				if($_POST["sure_check"]=="确认通过审核"){

						$news["receiver_id"]=I("user_id");
						$news["sender_id"]=0;
						$news["time"]=time();
						if(I("content")){
						$news["content"]=I("content");							
						if(!M("dm_news")->add($news)){
						$this->redirect("admin/index/item_check","",1,"审核成功,但是消息发送失败");							
						}else{
						$this->redirect("admin/index/item_check","",1,"审核成功,页面即将跳转到下一跳转");													
						}
						}
						
						$this->redirect('admin/index/item_check','',2,"审核已经保存,页面2秒之后跳转");
				}
				// else{
				// 	if($_POST["apply_id"]==1)
				// 		$this->redirect('admin/index/items_company_manage','',2,"修改已经保存,页面2秒之后跳转");
				// 	if($_POST["apply_id"]==2)
				// 		$this->redirect('admin/index/items_club_manage','',2,"修改已经保存,页面2秒之后跳转");
				// 	if($_POST["apply_id"]==3)
				// 		$this->redirect('admin/index/items_campus_manage','',2,"修改已经保存,页面2秒之后跳转");
				// 	if($_POST["apply_id"]==4)
				// 		$this->redirect('admin/index/items_others_manage','',2,"修改已经保存,页面2秒之后跳转");
				// 	if($_POST["apply_id"]==5)
				// 		$this->redirect('admin/index/items_person_manage','',2,"修改已经保存,页面2秒之后跳转");

				// }
			}else{
				echo "更新失败"."<br>";
				echo M("dm_items")->getLastSql();  //输出最后的sql执行结果
				
				}
}
		}
		Public function apply_info_delete(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}			
			if(M(I("kinds"))->where("id=".I("id"))->setField("success",2)){//删除成功
				$this->redirect("admin/index/company_apply_info_check","",1,"删除成功,页面即将跳转到下一审核");
			}else{
			echo "删除失败";

			}
		}
		Public function company_apply_info_check(){
					$index_file_path='./App/Upload/company/new/';//新身份证图片
					$index_file_path_license='./App/Upload/company/license/';//新组织证件照片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			$upload_file_name="";//上传的身份证文件名
			$upload_file_name_license="";//上传的证件文件名
			if($_FILES["new_idcard_photo_address"]["size"]!=0){
			if($_FILES["new_idcard_photo_address"]["size"]>2046*1000||$_FILES["new_idcard_photo_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_idcard_photo_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_idcard_photo_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_idcard_photo_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_idcard_photo_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
	 	 if($_FILES["new_scanner_address"]["size"]!=0){
			if($_FILES["new_scanner_address"]["size"]>2046*1000||$_FILES["new_scanner_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_scanner_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_scanner_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_scanner_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_scanner_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name_license=$index_file_path_license.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name_license)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
					$data["phone_number"]=I("phone_number");
					$data["success"]=I("success");
					$data["name"]=I("name");
					$data["register_number"]=I("register_number");
					$data["email"]=I("email");
					$data["address"]=I("address");
					$data["code"]=I("code");
					$data["id_name"]=I("id_name");
					if($upload_file_name)
					$data["new_idcard_photo_address"]=$upload_file_name;
					if($upload_file_name_license)
					$data["new_scanner_address"]=$upload_file_name_license;
			
					if(M("dm_company_info")->where("id=".I("id"))->save($data)){//
						$news["receiver_id"]=I("user_id");
						$news["sender_id"]=0;
						if(I("content")){
						$news["content"]=I("content");	
						$news["time"]=time();
						if(!M("dm_news")->add($news)){
						$this->redirect("admin/index/company_apply_info_check","",1,"审核成功,但是消息发送失败");							
						}else{
						$this->redirect("admin/index/company_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						}				
						}
						$this->redirect("admin/index/company_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						
					}else{
						echo M("dm_company_info")->getLastSql()."失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}
		}
		Public function campus_apply_info_check(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
					$index_file_path='./App/Upload/campus/new/';//新身份证图片
					$index_file_path_license='./App/Upload/campus/license/';//新组织证件照片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			$upload_file_name="";//上传的身份证文件名
			$upload_file_name_license="";//上传的证件文件名
			if($_FILES["new_card_address"]["size"]!=0){
			if($_FILES["new_card_address"]["size"]>2046*1000||$_FILES["new_card_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_card_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_card_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_card_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_card_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
	 	 if($_FILES["new_license_address"]["size"]!=0){
			if($_FILES["new_license_address"]["size"]>2046*1000||$_FILES["new_license_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_license_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_license_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_license_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_license_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name_license=$index_file_path_license.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name_license)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
					$data["phone_number"]=I("phone_number");
					$data["success"]=I("success");
					$data["name"]=I("name");
					$data["email"]=I("email");
					$data["address"]=I("address");
					$data["card_id"]=I("card_id");
					$data["id_name"]=I("id_name");
					if($upload_file_name)
					$data["new_card_address"]=$upload_file_name;
					if($upload_file_name_license)
					$data["new_license_address"]=$upload_file_name_license;
			
					if(M("dm_campus_info")->where("id=".I("id"))->save($data)){//
						$news["receiver_id"]=I("user_id");
						$news["sender_id"]=0;
						if(I("content")){
						$news["content"]=I("content");	
						$news["time"]=time();
						if(!M("dm_news")->add($news)){
						$this->redirect("admin/index/campus_apply_info_check","",1,"审核成功,但是消息发送失败");							
						}else{
						$this->redirect("admin/index/campus_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						}				
						}
						$this->redirect("admin/index/campus_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						
					}else{
						echo M("dm_campus_info")->getLastSql()."失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}
		}
		Public function club_apply_info_check(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
					$index_file_path='./App/Upload/club/new/';//新身份证图片
					$index_file_path_license='./App/Upload/club/license/';//新组织证件照片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			$upload_file_name="";//上传的身份证文件名
			$upload_file_name_license="";//上传的证件文件名
			if($_FILES["new_card_address"]["size"]!=0){
			if($_FILES["new_card_address"]["size"]>2046*1000||$_FILES["new_card_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_card_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_card_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_card_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_card_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
	 	 if($_FILES["new_license_address"]["size"]!=0){
			if($_FILES["new_license_address"]["size"]>2046*1000||$_FILES["new_license_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_license_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_license_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_license_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_license_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name_license=$index_file_path_license.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name_license)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
					$data["phone_number"]=I("phone_number");
					$data["success"]=I("success");
					$data["name"]=I("name");
					$data["email"]=I("email");
					$data["address"]=I("address");
					$data["card_id"]=I("card_id");
					if($upload_file_name)
					$data["new_card_address"]=$upload_file_name;
					if($upload_file_name_license)
					$data["new_license_address"]=$upload_file_name_license;
					if(M("dm_club_info")->where("id=".I("id"))->save($data)){//
						$news["receiver_id"]=I("user_id");
						$news["sender_id"]=0;
						if(I("content")){
						$news["content"]=I("content");	
						$news["time"]=time();
						if(!M("dm_news")->add($news)){
						$this->redirect("admin/index/club_apply_info_check","",1,"审核成功,但是消息发送失败");							
						}else{
						$this->redirect("admin/index/club_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						}				
						}
						$this->redirect("admin/index/club_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						
					}else{
						echo M("dm_club_info")->getLastSql()."失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}
		}
		Public function others_apply_info_check(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
					$index_file_path="./App/Upload/others/new/";//新身份证图片
					$index_file_path_license="./App/Upload/others/license/";//新组织证件照片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			$upload_file_name="";//上传的文件名
			$upload_file_name_license="";//上传的文件名
			if($_FILES["new_card_address"]["size"]!=0){
			if($_FILES["new_card_address"]["size"]>2046*1000||$_FILES["new_card_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_card_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_card_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_card_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_card_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
	 	 if($_FILES["new_license_address"]["size"]!=0){
			if($_FILES["new_license_address"]["size"]>2046*1000||$_FILES["new_license_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_license_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_license_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_license_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_license_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name_license=$index_file_path_license.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name_license)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
  	

					$data["phone_number"]=I("phone_number");
					$data["success"]=I("success");
					$data["name"]=I("name");
					$data["email"]=I("email");
					$data["address"]=I("address");
					if($upload_file_name)
					$data["new_card_address"]=$upload_file_name;
					if($upload_file_name_license)
					$data["new_license_address"]=$upload_file_name_license;
					if(M("dm_others_info")->where("id=".I("id"))->save($data)){//
						$news["receiver_id"]=I("user_id");
						$news["sender_id"]=0;
						if(I("content")){
						$news["content"]=I("content");	
						$news["time"]=time();
						if(!M("dm_news")->add($news)){
						$this->redirect("admin/index/others_apply_info_check","",1,"审核成功,但是消息发送失败");							
						}else{
						$this->redirect("admin/index/others_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						}				
						}
						$this->redirect("admin/index/others_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						
					}else{
						echo M("dm_others_info")->getLastSql()."失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}
		}
		Public function person_apply_info_check(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
			$index_file_path="./App/Upload/person/new/";//新身份证图片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			$upload_file_name="";//上传的文件名
			if($_FILES["new_card_address"]["size"]!=0){
			if($_FILES["new_card_address"]["size"]>2046*1000||$_FILES["new_card_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_card_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_card_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_card_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_card_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				// echo $tmp_index_file_name."<br>";
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
  	

					$data["phone_number"]=I("phone_number");
					$data["success"]=I("success");
					$data["email"]=I("email");
					$data["address"]=I("address");
					$data["phone_number"]=I("phone_number");
					if($upload_file_name)
					$data["new_card_address"]=$upload_file_name;
					if(M("dm_person_info")->where("id=".I("id"))->save($data)){//
						$news["receiver_id"]=I("user_id");
						$news["sender_id"]=0;
						if(I("content")){
						$news["content"]=I("content");	
						$news["time"]=time();
						if(!M("dm_news")->add($news)){
						$this->redirect("admin/index/person_apply_info_check","",1,"审核成功,但是消息发送失败");							
						}else{
						$this->redirect("admin/index/person_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						}				
						}
						$this->redirect("admin/index/person_apply_info_check","",1,"审核成功,页面即将跳转到下一审核");													
						
					}else{
						echo M("dm_person_info")->getLastSql()."失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}
		}
		Public function repay_recover(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
		if(M("dm_repay")->where("id=".I("id"))->setField("repay_check","0")) {
		$this->redirect("admin/index/repay","",1,"恢复至未审核成功,页面即将跳转到下一审核");													
		}else{
			echo "恢复失败";
		}
		}
		Public function repay_delete(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
		if(M("dm_repay")->where("id=".I("id"))->setField("repay_check","2") ) {
		$this->redirect("admin/index/repay","",1,"删除成功,页面即将跳转到下一审核");													
		}else{
			echo "删除失败";
		}
		}
		Public function repay(){
			if(!$_SESSION['dm_admin_id']){//未登陆
				echo "请先登录";
				return 0;
		}
			$index_file_path="./Public/res/images/detailed/repay/";//新身份证图片
			$image_type=array(".jpg",".JPG",".gif",".GIF",".png",".PNG","jepg","JEPG");//文件类型
			$upload_file_name="";//上传的文件名
			if($_FILES["new_card_address"]["size"]!=0){
			if($_FILES["new_card_address"]["size"]>2046*1000||$_FILES["new_card_address"]["size"]<10*1000){//10KB到2M之间的大小
	  			//项目简介图片
	  			echo $_FILES["new_card_address"]["name"]."文件大小不合适"."错误的大小为".$_FILES["new_card_address"]["size"];
	  			return 0;
	 	 	}else{
	 	 		$tmp_index_file_name=$_FILES["new_card_address"]["tmp_name"];
	 	 		$index_file_name=$_FILES["new_card_address"]["name"];
	  			$post_fix=substr($index_file_name, strrpos($index_file_name, ".")) ;//文件后缀名
	  			if(!in_array($post_fix,$image_type)){//后缀名不正确
	  			echo $index_file_name."文件格式不正确";
	  			exit();
	  			}
	  			$index_last_name=I("id")."_".time().$post_fix;
	  			$upload_file_name=$index_file_path.$index_last_name;
	  			if(move_uploaded_file($tmp_index_file_name, $upload_file_name)){
	  			echo $index_file_name."上传成功<br>";
	  			}else{
	  				// echo $tmp_index_file_name."<br>";
	  				echo $index_file_name."上传失败 <br>";	 
	  				return 0;
	  			}
	 	 	}
	 	 }
  	

					$data["items_id"]=I("items_id");
					$data["money"]=I("money");
					$data["content"]=I("content");
					$data["send_money"]=I("send_money");
					$data["limits"]=I("limits");
					$data["time"]=I("time");
					$data["repay_num"]=I("repay_num");
					$data["repay_check"]=I("repay_check");
					if($upload_file_name)
					$data["new_img"]=$upload_file_name;
					if($_POST['copy']=='复制这个回报'){
						if(M("dm_repay")->add($data)){//			
						$this->redirect("admin/index/repay","",1,"增加成功,页面即将跳转到下一审核");
						}else{
						echo M("dm_repay")->getLastSql()."增加失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}	
					}else{
						if(M("dm_repay")->where("id=".I("id"))->save($data)){//			
						$this->redirect("admin/index/repay","",1,"审核成功,页面即将跳转到下一审核");													
						
					}else{
						echo M("dm_repay")->getLastSql()."失败";
						// $this->redirect("admin/index/company_apply_info_check","",1,"审核失败");				
					}
					}
					
		}
		}
		
		

?>