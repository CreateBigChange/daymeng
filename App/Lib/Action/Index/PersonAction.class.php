<?php
header('Content-Type:text/html;charset=utf-8');
Class PersonAction extends Action{


	Public function _initialize(){
	 	 // 初始化的时候检查用户权限,通过session值判断
		// $this->checkRbac();
		$user_id=session('user_id');
		if (!isset($user_id)) {
			$this->redirect('/login');
		}
	}
	
	public function index(){
		$id=I('id','','htmlspecialchars');
		$my_id=session('user_id');
		// 只能通过get id才能访问
		if (empty($id)) {
			$this->error('页面不存在!','/index');
			die();
		}

		$atten=M()->query("select count(*) from dm_items_support where user_id = $id and attention=1");//关注的人数
		$frien=M()->query("select count(*) from dm_person_friends where user_id = $id  ");//好友数
		$topic=M()->query("select count(*) from dm_community_comments_first where user_id = $id ");//帖子数
		$userinfo=M()->query("select * from dm_user_info where id = $id");
		if (empty($userinfo[0])) {
			$this->error('不存在该用户','/index');
			die();
		}
		$usernews=M()->query("select * from dm_community_comments_first where user_id = $id");
		foreach ($usernews as $key => $value) {
			$usernews[$key]['time']= date('n\月j\日 G:i',$value['time']);
		}

		$this->assign('atten',$atten);
		$this->assign('frien',$frien);
		$this->assign('topic',$topic);
		$this->assign('add_id',$id);
		// $this->assign('my_id',$id);
		$this->assign('userinfo',$userinfo);
		$this->assign('usernews',$usernews);
		$this->display();
	}
}