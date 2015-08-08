<?php
header("Content-type:text/html;charset=utf-8");
/*
这是前台登陆控制器
*/
Class RegisterAction extends Action{
	Public function index(){
		$this->display();
	}
	Public function judge(){
			$type=$_POST["type"];
			$username=$_POST["username"];
			$data=M('dm_user')->where(array(
					$type=>$username
				))->find();
			if($data){//如果找到了这个username  存在
				$this->ajaxReturn(array('status'=>1));
				return 0;
			}else{
				$this->ajaxReturn(array('status'=>0));				
			}


	}
	Public function register(){
		if(!IS_AJAX){//非ajax提交
			_404("页面不存在");
		}
		 if($_SESSION["verify"]!=md5(strtolower(I("verify"))) ) {//验证码错误
				$this->ajaxReturn(array('verify'=>0));
				return 0;
		 }
		 $user["username"]=I("username");
		 $user['password']=I('password','','md5');
		 $user['loginip']=get_client_ip();
		 $user['logintime']=time();
		 $user['email']=$user["username"];
		 $user["niker"]=$user["username"];
		 $judge=M('dm_user')->add($user);
		 //插入user_info表的默认值
		 $user_info['nickname']=$user["username"];
		 $moren_user_name=rand(1,107);
		 $user_info["img"]=$moren_user_name.".jpg";//默认的个人图片
		 $user_info["name"]="小萌";//默认的姓名
		 $user_info["sex"]="";//默认的性别为空
		 $user_info["bird"]="暂无";//默认的出生日期
		 $user_info["address"]="暂无描述";//默认的出生地址
		 $user_info["person_description"]="暂无描述";//默认的个人描述
		 $user_info["last_change_time"]=time();//默认的登陆时间
		 // var_dump($user_info);
		 $judge2=M('dm_user_info')->add($user_info);
		 if($judge&&$judge2){
		 		$_SESSION["username"]=I("username");
				$_SESSION["user_id"]=$judge;
				$_SESSION["niker"]=$user["username"];;	
				$this->ajaxReturn(array('verify'=>1,
					// 'judge'=>$judge
				),'json');//数据库插入成功		 	
		 		return 0;
		 }
		 else{
		 	// var_dump($judge2);
				$this->ajaxReturn(array('verify'=>2),'');//数据库插入失败		 	
		 		return 0;
		 }
		 	
	}
	Public function verify(){
		verify_();
	}

}

?>