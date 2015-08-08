<?php
/**
* 找回密码的控制器
*/
header("Content-type:text/html;charset=utf-8");
class PasswordAction extends Action{
	public function index(){
		$this->display();
	}

	public function password(){	
		if(!IS_POST){
			_404("页面不存在");
		}
		$email=I('username','','htmlspecialchars');

		if(I("verify","","md5")!=session("verify")){//验证码错误;
			$this->ajaxReturn(array('status'=>2));
			return 0;
		}
		else{
				// $this->ajaxReturn(array('status'=>1));//发送成功！
				import('Class.smtp',APP_PATH);
				date_default_timezone_set('Asia/Shanghai');
				$time=time();
				$appy_time=date('Y-m-d H:i',$time);
				$data=M();
				$sql="select id from dm_user where username= '{$email}'";
				$result=$data->query("select id from dm_user where username= '{$email}'");
				$reset=$data->query("update dm_user set resettime=$time where username ='{$email}'");
				$id= base64_encode($result[0]['id']);//使用base64对数据加密
				$url=U('index/Password/reset?time='.$time.'&yxs='.$id.'&mail='.$email);

				$MailServer = 'smtp.163.com';      //SMTP 服务器
				$MailPort   = '25';					 //SMTP服务器端口号 默认25
				$MailId     = 'daymeng@163.com';  //服务器邮箱帐号
				$MailPw     = 'checent.com';			     //服务器邮箱密码
				$Title      = '呆萌网找回登陆密码！';        //邮件标题
				$Content    = '呆萌网在 '.$appy_time.' 收到了邮箱 '.$email.' 的密码重置申请。请点击以下的链接修改密码：
				</br>
				http://'.$_SERVER['HTTP_HOST'].$url.'
				</br>
				如果邮箱中不能打开链接，您也可以将它复制到浏览器地址栏中打开。';        //邮件内容
				$email      = $email;//接收者邮箱


				$smtp = new smtp($MailServer,$MailPort,true,$MailId,$MailPw);
				$smtp->debug = false;
				if($smtp->sendmail($email,$MailId, $Title, $Content, "HTML")){
					 $this->ajaxReturn(array('status'=>1));//发送成功！
				} else {
					 $this->ajaxReturn(array('status'=>3));//请重新发送
				}			
		}
	}

	public function reset(){
		$time=I('time','','htmlspecialchars');
		$mail=I('mail','','htmlspecialchars');
		$id=base64_decode(I('yxs','','htmlspecialchars'));
		$user=M();
		$sql="select resettime from dm_user where id=$id and username = '{$mail}'";
		$result=$user->query("select resettime from dm_user where id=$id and username = '{$mail}'");
		// $sql="select resettime from dm_user where id=$id and username = '{$mail}'";
		// echo $sql;
		if ($result[0]) {
			$diff=time()-$result[0]['resettime'];
			//链接有效期为十分钟
			if ($diff<600) {
				session('user_id',$id);
				$this->assign('mail',$mail);
				$this->display();
				die();
			}
			$this->error('链接已经过期！');
		}
		else{
			$this->error('对不起，不存在该账户，请注册',U('/register'));
			// halt('页面不存在！');
		}
	}

	public function getinfo(){
		$password=I('password','','htmlspecialchars');
		$password=md5($password);
		$id=session('user_id');
		$data=M()->query("update dm_user set password = '{$password}' where id=$id");
		session('user_id',null);
		 $this->success('修改成功', U('/login'));
	}
}
?>