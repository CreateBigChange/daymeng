<?php
header("Content-type:text/html;charset=utf-8");
/*
这是前台首页控制器
*/
Class LoginAction extends Action{
	
	Public function rem_login(){//登录成功，记住登录
		if(!IS_AJAX){
			_404("页面错误");
		}
		
		if($_SESSION["username"]&&$_SESSION["password"]&&$_SESSION["niker"]){//登录成功，记住cookie
		setcookie("username",$_SESSION["username"],time()+3600*24*30,'/');
		setcookie("password",$_SESSION["password"],time()+3600*24*30,'/');
		setcookie("niker",urlencode($_SESSION["niker"]),time()+3600*24*30,'/');
		}
		
				// $this->ajaxReturn(array('username'=>$_COOKIE["username"],
				// 	'password'=>$_COOKIE["password"],
				// 	'niker'=>$_COOKIE["niker"]
				// 	),'json');

	}

	// Public function _initialize(){
	// 	//echo "这是自动运行的方法";
	// }
	Public function index(){
		$this->display();
	}

	
	Public function login_check(){
		if(!IS_AJAX){
			_404("页面错误");
		}
		if($wish=M("dm_user")->where(array(
					'username'=>I("username"),
					// 'password'=>I("password",'','md5'),
				))->find()){//账号存在
				if($wish["error_login"]>=3){//密码错误超过1次数
				$_SESSION["error_login".I("username")]=0;
		 		$this->ajaxReturn(array('status'=>1,
		 				"error_login".I("username")=>$_SESSION["error_login".I("username")]
		 			),'json');
				}else{//没有登录错误过
					$_SESSION["error_login".I("username")]=1;
		 			$this->ajaxReturn(array('status'=>2,
		 				"error_login".I("username")=>$_SESSION["error_login".I("username")]
		 				),'json');
					
				}
		}else{//账号不存在
					$_SESSION["error_login".I("username")]=1;
					$this->ajaxReturn(array('status'=>2));
					
		}
	}
	
	Public function login(){
		if(!IS_POST){
			_404("页面错误");
		}
		
			if(empty($_POST["verify"])&&$_SESSION["error_login".I("username")]){//验证码不存在,并且没有登录错误过
				if($wish=M("dm_user")->where(array(
					'username'=>I("username"),
					'password'=>I("password",'','md5'),
				))->find()){
				if($wish['lock_']==1){
					$this->ajaxReturn(array('status'=>3));//账户已经被冻结
					return 0;
				}else{//登陆成功
					M("dm_user")->where("id=".$wish["id"])->setField("loginip",get_client_ip());
				M("dm_user")->where("id=".$wish["id"])->setField("logintime",time());
				$_SESSION["username"]=I("username");
				$_SESSION["user_id"]=$wish["id"];	
				$_SESSION["niker"]=$wish["niker"];
				$_SESSION["password"]=$wish["password"];	
				M("dm_user")->where("id=".$wish["id"])->setField("error_login",0);							
		 		$this->ajaxReturn(array('status'=>1));
		 		return 0;			
				}
			}
			else{//账号或者密码错误
				if($dm_username=M("dm_user")->where("username='".I("username")."'")->find()){//账号存在
					M("dm_user")->where("username='".$dm_username["username"]."'")->setInc("error_login",1);
		 			$this->ajaxReturn(array('status'=>0,
		 									'aaa'=>111
		 				),'json');
				}else{
		 				$this->ajaxReturn(array('status'=>0,
		 									'username'=>222,
		 									'js'=>M("dm_user")->getLastSql()
		 				),'json');

				}
				return 0;
			}
			}else{//验证码存在 
			if(md5(strtolower(I("verify")))!=session("verify")){//验证码错误
			$this->ajaxReturn(array('status'=>2,
				'vfy'=>I("verify"),
				'er_unm'=>$_SESSION["error_login".I("username")],
				'sys_verify'=>session("verify")
				),'json');
			return 0;
			}
			if($wish=M("dm_user")->where(array(
					'username'=>I("username"),
					'password'=>I("password",'','md5'),
				))->find()){
				if($wish['lock_']==1){
					$this->ajaxReturn(array('status'=>3));//账户已经被冻结
					return 0;
				}else{//登陆成功
					M("dm_user")->where("id=".$wish["id"])->setField("loginip",get_client_ip());
				M("dm_user")->where("id=".$wish["id"])->setField("logintime",time());
				$_SESSION["username"]=I("username");
				$_SESSION["password"]=$wish["password"];	
				$_SESSION["user_id"]=$wish["id"];
				$_SESSION["niker"]=$wish["niker"];
				M("dm_user")->where("id=".$wish["id"])->setField("error_login",0);				
		 		$this->ajaxReturn(array('status'=>1));
		 		return 0;			
				}
			}
			else{//账号或者密码错误
					$this->ajaxReturn(array('status'=>0,
		 									'aaa'=>555,
		 									// 'js'=>M("dm_user")->getLastSql()
		 				),'json');
				if($dm_username=M("dm_user")->where("username='".I("username")."'")->find()){//账号存在
					M("dm_user")->where("username='".$dm_username["username"]."'")->setInc("error_login",1);
		 				$this->ajaxReturn(array('status'=>0,
		 									'aaa'=>333,
		 									// 'js'=>M("dm_user")->getLastSql()
		 				),'json');
				}else{
		 				$this->ajaxReturn(array('status'=>0,
		 									'aaa'=>444,
		 									// 'js'=>M("dm_user")->getLastSql()
		 				),'json');

				}
				return 0;
			}

			}
	}
	Public function verify(){
			verify_();

	}


}
?>