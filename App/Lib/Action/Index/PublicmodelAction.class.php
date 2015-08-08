<?php 
header('Content-Type:text/html;charset=utf-8');
Class PublicmodelAction extends Action{
	Public function check_rem(){//判断密码是否修改
		if(!IS_AJAX){
			_404("页面错误");
		}
		
		if(!$wish=M("dm_user")->where(array(
			'username'=>$_COOKIE["username"],
			'password'=>$_COOKIE["password"]
			))->find()){
			//密码验证不成功，删除cookie
			// setcookie("username",'',time()-3600,'/');
			setcookie("password",'',time()-3600,'/');
			setcookie("niker",'',time()-3600,'/');
			$this->ajaxReturn(array(
				'status'=>2,
				// 'username'=>$_COOKIE["username"],
				// 'password'=>$_COOKIE["password"],
				// 'niker'=>$_COOKIE["niker"],
				),'json');
		}else{//登录成功，存储session
			M("dm_user")->where("id=".$wish["id"])->setField("loginip",get_client_ip());
				M("dm_user")->where("id=".$wish["id"])->setField("logintime",time());
				$_SESSION["username"]=$wish["username"];
				$_SESSION["user_id"]=$wish["id"];	
				$_SESSION["niker"]=$wish["niker"];
				$_SESSION["password"]=$wish["password"];
				// 	$this->ajaxReturn(array(
				// 'status'=>1,
				// 'username'=>$_COOKIE["username"],
				// 'password'=>$_COOKIE["password"],
				// 'niker'=>$_COOKIE["niker"],
				// ),'json');

		}

	}
		Public function exit1(){
			// setcookie('username','',time()-3600,'/');
			if(isset($_COOKIE['password']))
			setcookie('password','',time()-3600,'/');
			if(isset($_COOKIE['niker']))
			setcookie('niker','',time()-3600,'/');
			session_unset();
			session_destroy();
			$this->ajaxReturn(array(
				'status'=>1
				),'json');

	}
	Public function t_login(){//登录模板
		$this->display();
	}
	Public function index()
	{
		$this->display();
	}
	//头文件的公共模版
	Public function footer()
	{
		$this->display();
	}
		//底部文件的公共模版
	Public function head()
	{
		
		$this->display();
	}
	//个人中心头部模版
		Public function person_footer()
	{
		$this->display();
	}
	//个人中心的底部模版
}
?>
