<?php
header("Content-type:text/html;charset=utf-8");
session_start();
/*
这是后台登陆首页控制器
*/
Class LoginAction extends Action{
	Public function login(){
		if(!IS_POST){
			_404("页面错误");
		}
		if(md5(strtolower(I("verify")))!=session("verify")){
			// echo "验证码错误";
			$this->error("验证码错误",U('/admin/login/dm'));
		}
		else{
			$admin=M('dm_admin')->where(array(
					'username'=>$_POST['username'],
					'password'=>md5($_POST['password']),
				))->find();
			if($admin){
				$_SESSION['dm_admin_id']=$admin['id'];
				// $_SESSION['admin_username']=$admin['username'];
				// echo "登陆成功";
				$this->redirect('admin/index/dm',0);
			}else{
				// echo "密码错误！";
			$this->error("密码错误",U('/admin/login/dm','',''));

			}
		}
	}
	Public function exit1(){
		session_unset();//删除内存中的session变量
		session_destroy();//删除文件,内存中的依然保留
		$this->redirect('admin/login/dm',0);
	}
	Public function verify(){
			import("ORG.util.Image");
			Image::buildImageVerify(1,5,"png");
	}

}
?>