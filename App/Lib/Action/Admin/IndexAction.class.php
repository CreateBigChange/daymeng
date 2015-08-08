<?php
session_start();
header("Content-type:text/html;charset=utf-8");
/*
这是后台首页控制器
*/
Class IndexAction extends Action{
	Public function menu(){
		$model=new Model();
		$user_count=$model->query("select count(*) from dm_user where lock_=0");
		$this->user_count=$user_count[0]["count(*)"];
		$this->deleted_user=M("dm_user")->where("lock_=1")->count();
		$this->company_apply_checked_count=M("dm_company_info")->where("success=1")->count();
		$this->campus_apply_checked_count=M("dm_campus_info")->where("success=1")->count();
		$this->club_apply_checked_count=M("dm_club_info")->where("success=1")->count();
		$this->others_apply_checked_count=M("dm_others_info")->where("success=1")->count();
		$this->person_apply_checked_count=M("dm_person_info")->where("success=1")->count();;
		$this->apply_checked_count=M("dm_company_info")->where("success=1")->count()
		+M("dm_campus_info")->where("success=1")->count()+M("dm_club_info")->where("success=1")->count()+
		M("dm_others_info")->where("success=1")->count()+M("dm_person_info")->where("success=1")->count();

		$this->company_apply_unchecked_count=M("dm_company_info")->where("success=0")->count();
		$this->campus_apply_unchecked_count=M("dm_campus_info")->where("success=0")->count();
		$aa=M("")->query("select count(*) from dm_club_info,dm_items where dm_club_info.success=0 
			and dm_items.apply_id=dm_club_info.id  and  dm_items.apply_type=3 limit $limit");
		$this->club_apply_unchecked_count=$aa[0]["count(*)"];
		$this->others_apply_unchecked_count=M("dm_others_info")->where("success=0")->count();
		$this->person_apply_unchecked_count=M("dm_person_info")->where("success=0")->count();
		$this->apply_unchecked_count=M("dm_company_info")->where("success=0")->count()
		+M("dm_campus_info")->where("success=0")->count()+M("dm_club_info")->where("success=0")->count()+
		M("dm_others_info")->where("success=0")->count()+M("dm_person_info")->where("success=0")->count();
			
		$this->company_apply_deleted_count=M("dm_company_info")->where("success=2")->count();
		$this->campus_apply_deleted_count=M("dm_campus_info")->where("success=2")->count();
		$this->club_apply_deleted_count=M("dm_club_info")->where("success=2")->count();
		$this->others_apply_deleted_count=M("dm_others_info")->where("success=2")->count();
		$this->person_apply_deleted_count=M("dm_person_info")->where("success=2")->count();;
		$this->apply_deleted_count=M("dm_company_info")->where("success=2")->count()
		+M("dm_campus_info")->where("success=2")->count()+M("dm_club_info")->where("success=2")->count()+
		M("dm_others_info")->where("success=2")->count()+M("dm_person_info")->where("success=2")->count();


		$this->items_checked_count=M("dm_items")->where("item_check=1 or item_check=3 ")->count();
		$this->company_items_checked_count=M("dm_items")->where("item_check=1 and apply_type=1 or (item_check=3 and apply_type=1)")->count();
		$this->club_items_checked_count=M("dm_items")->where("item_check=1 and apply_type=3 or (item_check=3 and apply_type=3)")->count();
		$this->campus_items_checked_count=M("dm_items")->where("item_check=1 and apply_type=2 or (item_check=3 and apply_type=2)")->count();
		$this->person_items_checked_count=M("dm_items")->where("item_check=1 and apply_type=5 or (item_check=3 and apply_type=5)")->count();
		$this->others_items_checked_count=M("dm_items")->where("item_check=1 and apply_type=4 or(item_check=3 and apply_type=4)")->count();

		$this->items_unchecked_count=M("dm_items")->where("item_check=0")->count();	
		$this->items_deleted_unchecked_count=M("dm_items")->where("item_check=2")->count();

		$this->repay_checked_count=M("dm_repay")->where("repay_check=1")->count();
		$this->repay_unchecked_count=M("dm_repay")->where("repay_check=0")->count();
		$this->repay_deleted_checked_count=M("dm_repay")->where("repay_check=2")->count();
	





		// $this->apply_unchecked_count=M()
		$this->display();
	}

	public function complaint1(){
		import("ORG.Util.Page");
		$count=M("dm_complaint")->count();
		$page=new Page($count,3);
		$limit=$page->firstRow.",".$page->listRows;

		$complaint=M()->query("
			select dm_complaint.*,dm_user.niker,dm_user.username from dm_complaint,dm_user where dm_complaint.user_id=dm_user.id  order by dm_complaint.id limit $limit 
			");
		$this->complaint=$complaint;
		$this->page=$page->show();
		$this->display();
	}
	public function complaint2(){
		import("ORG.Util.Page");
		$count=M("")->query("
			select count(*) from dm_complaint  where dm_complaint.user_id is NULL and dm_complaint.content is not NULL 
			");
		$page=new Page($count[0]["count(*)"],3);
		$limit=$page->firstRow.",".$page->listRows;
		$complaint=M()->query("
			select * from dm_complaint where dm_complaint.user_id  is NULL  and dm_complaint.content is not NULL order by dm_complaint.id limit $limit 
			");
		$this->complaint=$complaint;
		$this->page=$page->show();
		$this->display();
	}
	Public function repay_deleted(){
		if(!$_SESSION['dm_admin_id']){//未登陆
		$this->redirect('admin/login/dm',0);
		}
				import("ORG.Util.Page");
				$model=new Model();
				$count=M("dm_repay")->where("repay_check=2")->count();
				$page_count=1;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// if($apply_info=M("dm_repay")->where("repay_check=2")->limit($limit)->select()){
				$apply_info=$model->query("
					select dm_repay.*,dm_items.title from dm_repay,dm_items where dm_repay.repay_check=2 and dm_items.id=dm_repay.items_id
					limit ".$limit."
					");
				$this->apply_info=$apply_info;
				$this->page=$page->show();
				$this->display();
		
	}
	Public function repay_checked(){
		if(!$_SESSION['dm_admin_id']){//未登陆
		$this->redirect('admin/login/dm',0);
		}
		import("ORG.Util.Page");
				$model=new Model();
				$count=M("dm_repay")->where("repay_check=1")->count();
				$page_count=1;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// if($apply_info=M("dm_repay")->where("repay_check=0")->limit($limit)->select()){
				$apply_info=$model->query("
					select dm_repay.*,dm_items.title from dm_repay,dm_items where dm_repay.repay_check=1 and dm_items.id=dm_repay.items_id
					limit ".$limit."
					");
				$this->apply_info=$apply_info;
				$this->page=$page->show();
				$this->display();
		
	}
	Public function repay_checked_search(){
		import("ORG.Util.Page");
			// p(I('post.'));
				$model=new Model();
			// 	$count=$model->query("
			// 		select count(*) from dm_repay,dm_items where dm_repay.repay_check=1 and dm_items.id=dm_repay.items_id 
			// 		and dm_items.title like '%".$_POST["search_repay"]."%'
			// 		");
				
			// 	$page_count=1;//每页的行数
			// 	$page=new Page($count[0]["count(*)"],$page_count);
			// 	$limit=$page->firstRow.",".$page->listRows;
				// if($apply_info=M("dm_repay")->where("repay_check=0")->limit($limit)->select()){
				$apply_info=$model->query("
					select dm_repay.*,dm_items.title from dm_repay,dm_items where dm_repay.repay_check=1 and dm_items.id=dm_repay.items_id 
					and dm_items.title like '%".$_POST["search_repay"]."%'
					
					");
				$this->apply_info=$apply_info;
				// $this->page=$page->show();
				$this->display();
				
	}
	Public function repay(){
		if(!$_SESSION['dm_admin_id']){//未登陆
		$this->redirect('admin/login/dm',0);
		}
		import("ORG.Util.Page");
			if($_POST["sure_search_repay"]=="搜索"){
				$model=new Model();
				$count=$model->query("
					select count(*) from dm_repay,dm_items where dm_repay.repay_check=0 and dm_items.id=dm_repay.items_id 
					and dm_items.title like '%".$_POST["search_repay"]."%'
					");
				$page_count=1;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// if($apply_info=M("dm_repay")->where("repay_check=0")->limit($limit)->select()){
				$apply_info=$model->query("
					select dm_repay.*,dm_items.title from dm_repay,dm_items where dm_repay.repay_check=0 and dm_items.id=dm_repay.items_id 
					and dm_items.title like '%".$_POST["search_repay"]."%'
					limit ".$limit."
					");
			
			}else{
				$model=new Model();
				$count=M("dm_repay")->where("repay_check=0")->count();
				$page_count=1;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// if($apply_info=M("dm_repay")->where("repay_check=0")->limit($limit)->select()){
				$apply_info=$model->query("
					select dm_repay.*,dm_items.title from dm_repay,dm_items where dm_repay.repay_check=0 and dm_items.id=dm_repay.items_id
					limit ".$limit."
					");
			}
				$this->apply_info=$apply_info;
				$this->page=$page->show();
				$this->display();
		
	}
	Public function show_deleted_items(){
		if(!$_SESSION['dm_admin_id']){//未登陆
		$this->redirect('admin/login/dm',0);
		}
		if($items=M("dm_items")->where("item_check=2")->select()){
			$this->items=$items;
			$this->display();
		}
	}
	Public function show_deleted_apply(){
		return ;
		if(!$_SESSION['dm_admin_id']){//未登陆
		$this->redirect('admin/login/dm',0);
		}
		if($items=M("dm_items")->where("item_check=2")->select()){
			$this->items=$items;
			$this->display();
		}
	}
	Public function dm(){
		if(!$_SESSION['dm_admin_id']){//未登陆
		$this->redirect('admin/login/login',0);
		}
		$this->display();
	}
	Public	function user_manage(){//显示
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
			import("ORG.Util.Page");
			$count=M("dm_user")->count();
			$page_count=20;//每页的行数
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$user=M("dm_user")->limit($limit)->select();
			// p($user);return;
			$this->user=$user;
			$this->page=$page->show();
			$this->display();
			}
	}
	Public	function comment_manage_deleted(){//显示
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*) from 
					dm_community_comments_first where deleted=1
						");
				// echo $count[0]["count(*)"];return;
				$page_count=4;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=$model->query("select dm_community_comments_first.*,dm_user.niker from 
					dm_community_comments_first,dm_user where dm_community_comments_first.deleted=1  
					and dm_user.id=dm_community_comments_first.user_id order by dm_community_comments_first.time desc limit ".$limit."");
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
			}
	}
	Public	function comment_manage(){//显示
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*) from 
					dm_community_comments_first where deleted=0
						");
				// echo $count[0]["count(*)"];return;
				$page_count=4;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=$model->query("select dm_community_comments_first.*,dm_user.niker from 
					dm_community_comments_first,dm_user where dm_community_comments_first.deleted=0  
					and dm_user.id=dm_community_comments_first.user_id order by dm_community_comments_first.time desc limit ".$limit."");
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
			}
	}
	Public	function comment_second_manage_deleted(){//显示
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*) from 
					dm_community_comments_second where deleted=1
						");
				// echo $count[0]["count(*)"];return;
				$page_count=4;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=$model->query("select dm_community_comments_second.*,dm_user.niker from 
					dm_community_comments_second,dm_user where dm_community_comments_second.deleted=1  
					and dm_user.id=dm_community_comments_second.user_id order by dm_community_comments_second.time desc limit ".$limit."");
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
			}
	}
	Public	function comment_second_manage(){//显示
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*) from 
					dm_community_comments_second where deleted=0
						");
				// echo $count[0]["count(*)"];return;
				$page_count=4;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=$model->query("select dm_community_comments_second.*,dm_user.niker from 
					dm_community_comments_second,dm_user where dm_community_comments_second.deleted=0  
					and dm_user.id=dm_community_comments_second.user_id order by dm_community_comments_second.time desc limit ".$limit."");
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
			}
	}
	Public	function company_apply_info_manage(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
					import("ORG.Util.Page");
				$count=M("dm_company_info")->where("success=1")->count();
				$page_count=4;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_company_info")->where("success=1")->limit($limit)->select();
				// $result=detail_apply_info_manage("dm_company_info");
				$this->apply_info=$result;
				$this->page=$page->show();
				$this->display();
			}
	}
	Public	function company_apply_info_search(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				$result=M("")->query("
					select * from dm_company_info where  success=1  and name like '%".I("search_company_info")."%'
					");
				$this->apply_info=$result;
				$this->display();
			}
	}
	Public	function campus_apply_info_manage(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				import("ORG.Util.Page");
				$count=M("dm_campus_info")->where("success=1")->count();
				$page_count=4;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_campus_info")->where("success=1")->limit($limit)->select();
				// $result=detail_apply_info_manage("dm_company_info");
				$this->apply_info=$result;
				$this->page=$page->show();
				$this->display();
			}
	}
	Public	function campus_apply_info_search(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				$result=M("")->query("
					select * from dm_campus_info where  success=1  and name like '%".I("search_campus_info")."%'
					");
				$this->apply_info=$result;
				$this->display();
			}
	}
	Public	function club_apply_info_manage(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
					import("ORG.Util.Page");
				$count=M("dm_club_info")->where("success=1")->count();
				$page_count=4;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_club_info")->where("success=1")->limit($limit)->select();
				$this->apply_info=$result;
				$this->page=$page->show();
				$this->display();
			}
	}
	Public	function club_apply_info_search(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
					$result=M("")->query("
					select * from dm_club_info where  success=1  and name like '%".I("search_club_info")."%'
					");
				$this->apply_info=$result;
				$this->display();
			}
	}
	Public	function others_apply_info_manage(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
				import("ORG.Util.Page");
				$count=M("dm_others_info")->where("success=1")->count();
				$page_count=4;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_others_info")->where("success=1")->limit($limit)->select();
				// $result=detail_apply_info_manage("dm_company_info");
				// p($limit);
				// p($result);return ;
				$this->apply_info=$result;
				$this->page=$page->show();
				$this->display();
			}
	}
	Public	function others_apply_info_search(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
					$result=M("")->query("
					select * from dm_others_info where  success=1  and name like '%".I("search_others_info")."%'
					");
				$this->apply_info=$result;
				$this->display();
			}
	}
	Public	function person_apply_info_manage(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
					import("ORG.Util.Page");
				$count=M("dm_person_info")->where("success=1")->count();
				$page_count=4;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_person_info")->where("success=1")->limit($limit)->select();
				// $result=detail_apply_info_manage("dm_company_info");
				$this->apply_info=$result;
				$this->page=$page->show();
				$this->display();
			}
	}
	Public	function person_apply_info_search(){//显示
		
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
					$result=M("")->query("
					select * from dm_person_info where  success=1  and name like '%".I("person_club_info")."%'
					");
				$this->apply_info=$result;
				$this->display();
			}
	}
	Public function user_search(){
				import("ORG.Util.Page");
				$key["username|niker"]=array('like',"%".I("search_user")."%","or");
				$count=M("dm_user")->where($key)->count();
				$page_count=2;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_user")->where($key)->order("logintime desc")->limit($limit)->select();
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function comment_deleted_search(){
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*)  from 
					dm_community_comments_first,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					");
				$page_count=2;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// echo "select dm_community_comments_first.*,dm_user.niker  from 
				// 	dm_community_comments_first,dm_user where 
				// 	(content like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	 order by dm_community_comments_first.time desc limit ".$limit."";
				// 	 return ;
				$result=$model->query("select dm_community_comments_first.*,dm_user.niker  from 
					dm_community_comments_first,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					 order by dm_community_comments_first.time desc limit ".$limit."");
				
					 // return ;
				// echo "select * from 
				// 	dm_community_comments_first,dm_user where content like '%".I("search_first")."%' or user_id in(
				// 		select dm_user.id from dm_user where dm_user.niker like '%".I("search_first")."%')  order by dm_community_comments_first.time desc limit ".$limit."";
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function comment_search(){
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*)  from 
					dm_community_comments_first,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					");
				$page_count=2;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// echo "select dm_community_comments_first.*,dm_user.niker  from 
				// 	dm_community_comments_first,dm_user where 
				// 	(content like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	 order by dm_community_comments_first.time desc limit ".$limit."";
				// 	 return ;
				$result=$model->query("select dm_community_comments_first.*,dm_user.niker  from 
					dm_community_comments_first,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					 order by dm_community_comments_first.time desc limit ".$limit."");
				
					 // return ;
				// echo "select * from 
				// 	dm_community_comments_first,dm_user where content like '%".I("search_first")."%' or user_id in(
				// 		select dm_user.id from dm_user where dm_user.niker like '%".I("search_first")."%')  order by dm_community_comments_first.time desc limit ".$limit."";
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function comment_second_deleted_search(){
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*)  from 
					dm_community_comments_second,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					");
				$page_count=2;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// echo "select dm_community_comments_first.*,dm_user.niker  from 
				// 	dm_community_comments_first,dm_user where 
				// 	(content like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	 order by dm_community_comments_first.time desc limit ".$limit."";
				// 	 return ;
				$result=$model->query("select dm_community_comments_second.*,dm_user.niker  from 
					dm_community_comments_second,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=1) 
					 order by dm_community_comments_second.time desc limit ".$limit."");
				
					 // return ;
				// echo "select * from 
				// 	dm_community_comments_first,dm_user where content like '%".I("search_first")."%' or user_id in(
				// 		select dm_user.id from dm_user where dm_user.niker like '%".I("search_first")."%')  order by dm_community_comments_first.time desc limit ".$limit."";
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function comment_second_search(){
				import("ORG.Util.Page");
				$model=new Model();
				$count=$model->query("select count(*)  from 
					dm_community_comments_second,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					");
				$page_count=2;//每页的行数
				$page=new Page($count[0]["count(*)"],$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				// echo "select dm_community_comments_first.*,dm_user.niker  from 
				// 	dm_community_comments_first,dm_user where 
				// 	(content like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id) 
				// 	 order by dm_community_comments_first.time desc limit ".$limit."";
				// 	 return ;
				$result=$model->query("select dm_community_comments_second.*,dm_user.niker  from 
					dm_community_comments_second,dm_user where 
					(content like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					or(dm_user.niker like '%".I("search_first")."%' and user_id=dm_user.id and deleted=0) 
					 order by dm_community_comments_second.time desc limit ".$limit."");
				
					 // return ;
				// echo "select * from 
				// 	dm_community_comments_first,dm_user where content like '%".I("search_first")."%' or user_id in(
				// 		select dm_user.id from dm_user where dm_user.niker like '%".I("search_first")."%')  order by dm_community_comments_first.time desc limit ".$limit."";
				$this->user=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function items_manage_company(){
		if(!$_SESSION['dm_admin_id']){//未登陆

			return 0;
		}else{
			import("ORG.Util.Page");
			$count=M("dm_items")->where("(finish='1' and item_check=1 and apply_type=1) or(finish='1' and item_check=3 and apply_type=1) ")->count();
			$page_count=4;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$items=M("dm_items")->where("finish='1' and item_check=1 and apply_type=1 or(finish='1' and item_check=3 and apply_type=1)")->limit($limit)->order("id desc")->select();
			$this->items=$items;
			$this->page=$page->show();
			$this->display();
			return 0;
		}
	} 
	Public function items_manage_campus(){
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
			import("ORG.Util.Page");
			$count=M("dm_items")->where("finish='1' and item_check=1 and apply_type=2 or(finish='1' and item_check=3 and apply_type=2)")->count();
			$page_count=4;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$items=M("dm_items")->where("finish='1' and item_check=1 and apply_type=2 or(finish='1' and item_check=3 and apply_type=2)")->limit($limit)->order("id desc")->select();
			$this->items=$items;
			$this->page=$page->show();
			$this->display();
			return 0;
		}
	}
	Public function items_manage_club(){
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
			import("ORG.Util.Page");
			$count=M("dm_items")->where("finish='1' and item_check=1 and apply_type=3 or(finish='1' and item_check=3 and apply_type=3)")->count();
			$page_count=4;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$items=M("dm_items")->where("finish='1' and item_check=1 and apply_type=3 or(finish='1' and item_check=3 and apply_type=3)")->limit($limit)->order("id desc")->select();
			$this->items=$items;
			$this->page=$page->show();
			$this->display();
			return 0;
		}
	} 
	Public function items_manage_others(){
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
			import("ORG.Util.Page");
			$count=M("dm_items")->where("finish='1' and item_check=1 and apply_type=4")->count();
			$page_count=4;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$items=M("dm_items")->where("finish='1' and item_check=1 and apply_type=4 or item_check=3 ")->limit($limit)->order("id desc")->select();
			$this->items=$items;
			$this->page=$page->show();
			$this->display();
			return 0;
		}
	} 
	Public function items_manage_person(){
		if(!$_SESSION['dm_admin_id']){//未登陆
			return 0;
		}else{
			import("ORG.Util.Page");
			$count=M("dm_items")->where("finish='1' and item_check=1 and apply_type=5 or(finish='1' and item_check=3 and apply_type=5)")->count();
			$page_count=4;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$items=M("dm_items")->where("finish='1' and item_check=1 and apply_type=5 or(finish='1' and item_check=3 and apply_type=5)")->limit($limit)->order("id desc")->select();
			$this->items=$items;
			$this->page=$page->show();
			$this->display();
			return 0;
		}
	} 
	Public function items_search_company(){
				import("ORG.Util.Page");
				$key["title"]=array('like',"%".I("search_items")."%","or");
				$key["finish|item_check|apply_type"]=array('exp',"in(1)");
				$count=M("dm_items")->where($key)->count();
				$page_count=2;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_items")->where($key)->order("id desc")->limit($limit)->select();
				$this->items=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function items_search_campus(){
				import("ORG.Util.Page");
				$key["title"]=array('like',"%".I("search_items")."%","or");
				$key["apply_type"]=2;
				$count=M("dm_items")->where($key)->count();
				$page_count=2;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_items")->where($key)->order("id desc")->limit($limit)->select();
				$this->items=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function items_search_club(){
				import("ORG.Util.Page");
				$key["title"]=array('like',"%".I("search_items")."%","or");
				$key["apply_type"]=3;
				$count=M("dm_items")->where($key)->count();
				$page_count=2;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_items")->where($key)->order("id desc")->limit($limit)->select();
				$this->items=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function items_search_others(){
				import("ORG.Util.Page");
				$key["title"]=array('like',"%".I("search_items")."%","or");
				$key["apply_type"]=4;
				$count=M("dm_items")->where($key)->count();
				$page_count=2;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_items")->where($key)->order("id desc")->limit($limit)->select();
				$this->items=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}	
	Public function items_search_person(){
				import("ORG.Util.Page");
				$key["title"]=array('like',"%".I("search_items")."%","or");
				$key["apply_type"]=5;
				$count=M("dm_items")->where($key)->count();
				$page_count=2;//每页的行数
				$page=new Page($count,$page_count);
				$limit=$page->firstRow.",".$page->listRows;
				$result=M("dm_items")->where($key)->order("id desc")->limit($limit)->select();
				$this->items=$result;
				$this->page=$page->show();
				$this->display();
				return 0;
	}
	Public function item_check(){
		import("ORG.Util.Page");
			if($_POST["sure_search_item"]=="搜索"){
			$model=new Model();
			$count=$model->query("
						select  count(*) from dm_items where (dm_items.apply_id in (select id from dm_person_info where dm_person_info.success=1) and apply_type=5 and item_check=0 and title like '%".$_POST["search_item"]."%' ) 
												 or (dm_items.apply_id in (select id from dm_others_info where dm_others_info.success=1) and apply_type=4 and item_check=0 and title like '%".$_POST["search_item"]."%') 
												 or (dm_items.apply_id in (select id from dm_club_info where dm_club_info.success=1) and apply_type=3 and item_check=0 and title like '%".$_POST["search_item"]."%')
												 or (dm_items.apply_id in (select id from dm_campus_info where dm_campus_info.success=1) and apply_type=2 and item_check=0 and title like '%".$_POST["search_item"]."%') 
												 or (dm_items.apply_id in (select id from dm_company_info where dm_company_info.success=1) and apply_type=1 and item_check=0 and title like '%".$_POST["search_item"]."%')
				 								");
			// $count=M("dm_items")->where("finish='1' and item_check=0 and apply_id in")->count();

			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;

			$items=$model->query("
						select * from dm_items where (dm_items.apply_id in (select id from dm_person_info where dm_person_info.success=1) and apply_type=5 and item_check=0 and title like '%".$_POST["search_item"]."%') 
												 or (dm_items.apply_id in (select id from dm_others_info where dm_others_info.success=1) and apply_type=4 and item_check=0 and title like '%".$_POST["search_item"]."%') 
												 or (dm_items.apply_id in (select id from dm_club_info where dm_club_info.success=1) and apply_type=3 and item_check=0 and title like '%".$_POST["search_item"]."%')
												 or (dm_items.apply_id in (select id from dm_campus_info where dm_campus_info.success=1) and apply_type=2 and item_check=0 and title like '%".$_POST["search_item"]."%') 
												 or (dm_items.apply_id in (select id from dm_company_info where dm_company_info.success=1) and apply_type=1 and item_check=0 and title like '%".$_POST["search_item"]."%')
				 							     limit $limit");
			// p($count);
			// echo '$count["count(*)"]='.$count[0]["count(*)"]."<br>";
			// p($page->show());
			// p($items);
			// return ;
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}


			}else{

			$model=new Model();
			$count=$model->query("
						select  count(*) from dm_items where (dm_items.apply_id in (select id from dm_person_info where dm_person_info.success=1) and apply_type=5 and item_check=0) 
												 or (dm_items.apply_id in (select id from dm_others_info where dm_others_info.success=1) and apply_type=4 and item_check=0) 
												 or (dm_items.apply_id in (select id from dm_club_info where dm_club_info.success=1) and apply_type=3 and item_check=0)
												 or (dm_items.apply_id in (select id from dm_campus_info where dm_campus_info.success=1) and apply_type=2 and item_check=0) 
												 or (dm_items.apply_id in (select id from dm_company_info where dm_company_info.success=1) and apply_type=1 and item_check=0)
				 								");
			// $count=M("dm_items")->where("finish='1' and item_check=0 and apply_id in")->count();

			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;

			$items=$model->query("
						select * from dm_items where (dm_items.apply_id in (select id from dm_person_info where dm_person_info.success=1) and apply_type=5 and item_check=0) 
												 or (dm_items.apply_id in (select id from dm_others_info where dm_others_info.success=1) and apply_type=4 and item_check=0) 
												 or (dm_items.apply_id in (select id from dm_club_info where dm_club_info.success=1) and apply_type=3 and item_check=0)
												 or (dm_items.apply_id in (select id from dm_campus_info where dm_campus_info.success=1) and apply_type=2 and item_check=0) 
												 or (dm_items.apply_id in (select id from dm_company_info where dm_company_info.success=1) and apply_type=1 and item_check=0)
				 							     limit $limit");
			// p($count);
			// echo '$count["count(*)"]='.$count[0]["count(*)"]."<br>";
			// p($page->show());
			// p($items);
			// return ;
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}

			}
			

			$this->new_details=$new_details;
			$this->items=$items;
			$this->page=$page->show();
			$this->display();

	}
	Public function items_manage_company_edit(){
			$items=M("dm_items")->where("id=".I("id"))->select();
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}
			$this->new_details=$new_details;
			$this->items=$items;
			$this->display();

	}
	Public function items_manage_campus_edit(){
			$items=M("dm_items")->where("id=".I("id"))->select();
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}
			$this->new_details=$new_details;
			$this->items=$items;
			$this->display();

	}
	Public function items_manage_club_edit(){
			$items=M("dm_items")->where("id=".I("id"))->select();
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}
			$this->new_details=$new_details;
			$this->items=$items;
			$this->display();

	}
	Public function items_manage_others_edit(){
			$items=M("dm_items")->where("id=".I("id"))->select();
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}
			$this->new_details=$new_details;
			$this->items=$items;
			$this->display();

	}
	Public function items_manage_person_edit(){
			$items=M("dm_items")->where("id=".I("id"))->select();
			for($i=0;$items[$i];$i++){
			$new_details=explode(",", $items[$i]["new_details"]);				
			}
			$this->new_details=$new_details;
			$this->items=$items;
			$this->display();

	}
	Public function others_apply_info_deleted(){
			import("ORG.Util.Page");
			$count=M("dm_others_info")->where("success=2")->count();
			$page_count=1;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("dm_others_info")->where("success=2")->limit($limit)->order("id asc")->select();
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function person_apply_info_deleted(){
			import("ORG.Util.Page");
			$count=M("dm_person_info")->where("success=2")->count();
			$page_count=1;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("dm_person_info")->where("success=2")->limit($limit)->order("applytime asc")->select();
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function club_apply_info_deleted(){
			import("ORG.Util.Page");
			$count=M("dm_club_info")->where("success=2")->count();
			$page_count=1;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("dm_club_info")->where("success=2")->limit($limit)->order("apply_time asc")->select();
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function campus_apply_info_deleted(){
			import("ORG.Util.Page");
			$count=M("dm_campus_info")->where("success=2")->count();
			$page_count=1;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("dm_campus_info")->where("success=2")->limit($limit)->order("apply_time asc")->select();
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function company_apply_info_deleted(){
			

	}
	
	Public function company_apply_info_check(){
			import("ORG.Util.Page");
			if($_POST["search"]=="搜索"){
			$count=M("")->query("select count(*) from dm_company_info,dm_items where dm_company_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_company_info.id  and  dm_items.apply_type=1 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("")->query("select dm_company_info.*,dm_items.title from dm_company_info,dm_items where dm_company_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_company_info.id  and  dm_items.apply_type=1 limit $limit");
			// echo "select dm_company_info.*,dm_items.title from dm_company_info,dm_items where dm_company_info.success=0 and name like '%".I("search_info")."%' 
			// and dm_items.apply_id=dm_company_info.id  and  dm_items.apply_type=1 ";
			// p($apply_info);
			// return ;
			}else{
			$count=M("")->query("select count(*) from dm_company_info,dm_items where dm_company_info.success=0  
			and dm_items.apply_id=dm_company_info.id  and  dm_items.apply_type=1 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			
			$apply_info=M("")->query("select dm_company_info.*,dm_items.title from dm_company_info,dm_items where dm_company_info.success=0 
			and dm_items.apply_id=dm_company_info.id  and  dm_items.apply_type=1 limit $limit");
			}
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function club_apply_info_check(){
		import("ORG.Util.Page");
			if($_POST["search"]=="搜索"){
			$count=M("")->query("select count(*) from dm_club_info,dm_items where dm_club_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_club_info.id  and  dm_items.apply_type=3 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("")->query("select dm_club_info.*,dm_items.title from dm_club_info,dm_items where dm_club_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_club_info.id  and  dm_items.apply_type=3  limit $limit");
			// echo "select dm_club_info.*,dm_items.title from dm_club_info,dm_items where dm_club_info.success=0 and name like '%".I("search_info")."%' 
			// and dm_items.apply_id=dm_club_info.id  and  dm_items.apply_type=1 ";
			// p($apply_info);
			// return ;
			}else{
			$count=M("")->query("select count(*) from dm_club_info,dm_items where dm_club_info.success=0  
			and dm_items.apply_id=dm_club_info.id  and  dm_items.apply_type=3 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			
			$apply_info=M("")->query("select dm_club_info.*,dm_items.title from dm_club_info,dm_items where dm_club_info.success=0 
			and dm_items.apply_id=dm_club_info.id  and  dm_items.apply_type=3 limit $limit");
			}

			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();
	}
	Public function campus_apply_info_check(){
			import("ORG.Util.Page");
			if($_POST["search"]=="搜索"){
			$count=M("")->query("select count(*) from dm_campus_info,dm_items where dm_campus_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_campus_info.id  and  dm_items.apply_type=2 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("")->query("select dm_campus_info.*,dm_items.title from dm_campus_info,dm_items where dm_campus_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_campus_info.id  and  dm_items.apply_type=2 limit $limit");
			// echo "select dm_campus_info.*,dm_items.title from dm_campus_info,dm_items where dm_campus_info.success=0 and name like '%".I("search_info")."%' 
			// and dm_items.apply_id=dm_campus_info.id  and  dm_items.apply_type=1 ";
			// p($apply_info);
			// return ;
			}else{
			$count=M("")->query("select count(*) from dm_campus_info,dm_items where dm_campus_info.success=0  
			and dm_items.apply_id=dm_campus_info.id  and  dm_items.apply_type=2 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			
			$apply_info=M("")->query("select dm_campus_info.*,dm_items.title from dm_campus_info,dm_items where dm_campus_info.success=0 
			and dm_items.apply_id=dm_campus_info.id  and  dm_items.apply_type=2 limit $limit");
			}

			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function others_apply_info_check(){
			import("ORG.Util.Page");
			if($_POST["search"]=="搜索"){
			$count=M("")->query("select count(*) from dm_others_info,dm_items where dm_others_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_others_info.id  and  dm_items.apply_type=4 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("")->query("select dm_others_info.*,dm_items.title from dm_others_info,dm_items where dm_others_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_others_info.id  and  dm_items.apply_type=4 limit $limit");
			// echo "select dm_others_info.*,dm_items.title from dm_others_info,dm_items where dm_others_info.success=0 and name like '%".I("search_info")."%' 
			// and dm_items.apply_id=dm_others_info.id  and  dm_items.apply_type=1 ";
			// p($apply_info);
			// return ;
			}else{
			$count=M("")->query("select count(*) from dm_others_info,dm_items where dm_others_info.success=0  
			and dm_items.apply_id=dm_others_info.id  and  dm_items.apply_type=4 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			
			$apply_info=M("")->query("select dm_others_info.*,dm_items.title from dm_others_info,dm_items where dm_others_info.success=0 
			and dm_items.apply_id=dm_others_info.id  and  dm_items.apply_type=4 limit $limit");
			}

			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	Public function person_apply_info_check(){
		if(I("id")){
			import("ORG.Util.Page");
			$count=M("dm_person_info")->where("success=1 and id=".I("id"))->count();
			$page_count=1;
			$page=new Page($count,$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("dm_person_info")->where("success=1 and id=".I("id"))->select();
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();
			return 0;
		}
			import("ORG.Util.Page");
			if($_POST["search"]=="搜索"){
			$count=M("")->query("select count(*) from dm_person_info,dm_items where dm_person_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_person_info.id  and  dm_items.apply_type=5 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			$apply_info=M("")->query("select dm_person_info.*,dm_items.title from dm_person_info,dm_items where dm_person_info.success=0 and name like '%".I("search_info")."%' 
			and dm_items.apply_id=dm_person_info.id  and  dm_items.apply_type=5 limit $limit");
			// echo "select dm_person_info.*,dm_items.title from dm_person_info,dm_items where dm_person_info.success=0 and name like '%".I("search_info")."%' 
			// and dm_items.apply_id=dm_person_info.id  and  dm_items.apply_type=5 $limit ";
			// p($apply_info);
			// return ;
			}else{
			$count=M("")->query("select count(*) from dm_person_info,dm_items where dm_person_info.success=0  
			and dm_items.apply_id=dm_person_info.id  and  dm_items.apply_type=5 ");
			$page_count=1;
			$page=new Page($count[0]["count(*)"],$page_count);
			$limit=$page->firstRow.",".$page->listRows;
			
			$apply_info=M("")->query("select dm_person_info.*,dm_items.title from dm_person_info,dm_items where dm_person_info.success=0 
			and dm_items.apply_id=dm_person_info.id  and  dm_items.apply_type=5 limit $limit");
			}
			$this->apply_info=$apply_info;
			$this->page=$page->show();
			$this->display();

	}
	

}
?>