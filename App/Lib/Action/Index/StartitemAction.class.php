<?php
header('Content-Type:text/html;charset=utf-8');

Class StartitemAction extends Action{
	
	//验证码
	protected  $security_code;

	// 文件
	protected $file;

	Public function index(){
		$user_id=session('user_id');
		// 判断是否登陆，没有登陆给前段信号0
		if (!isset($user_id)) {
			$sign = 0;
			$this->assign('sign',$sign);
		}
		else{
			$sign = 1;
			$this->assign('sign',$sign);
		}
		$this->display();

	} 
	// 获取企业信息
	public function comUpload(){
		if(!IS_POST) halt('页面不存在');

			//手机验证码
			$this->file=session('file');
			$this->security_code = session('security_code');

			if(I('msgcode','','htmlspecialchars') != $this->security_code){
				$data=array('state'=> 0 ,'news'=>'验证码错误,请核对验证码！');
				$this->ajaxReturn($data);
				die();
			}
			
			if ($this->file[0]['type']!='com'&&$this->file[1]['name']!='id') {
				$data=array('state'=> 0 ,'news'=>'请注意提交图片和图片大小');
				$this->ajaxReturn($data);
				die();
			}
			$data = array(
				'user_id'=>session('user_id'),
				'name' => I('comname','','htmlspecialchars'),
				'email' => I('commail','','htmlspecialchars'),
				'address' => I('comaddress','','htmlspecialchars'),
				'register_number' => I('licensecode','','htmlspecialchars'),
				'scanner_address' => $this->file[0]['filename'],
				'code' => I('orgcode','','htmlspecialchars'),
				'id_name' => I('operatorname','','htmlspecialchars'),
				'idcard_photo_address'=>$this->file[1]['filename'],
				'phone_number' => I('phonenum','','htmlspecialchars'),
				'apply_time' => time(),
				'success'=>0
			);
			$com = M('dm_company_info');
			$id=$com->data($data)->add();
			if($id){
				session('file',null);
				session('security_code',null);
				session('apply_type',$this->file[0]['type']);
				session('apply_id', $id);
				$data=array('state'=>1,'news'=>'数据添加成功！');
				session('userinfo','1');//用来判定用户是否由上一步传递过来
				$this->ajaxReturn($data);
				
			}else{
				$this->error('添加失败');
			}
	}
	//获取校园信息
	public function schoolUpload(){
			if(!IS_POST) halt('页面不存在');
			//手机验证码
			$this->file=session('file');
			$this->security_code = session('security_code');

			if(I('msgcode','','htmlspecialchars') != $this->security_code){
				echo $this->security_code;
				$data=array('state'=> 0 ,'news'=>'验证码错误！');
				$this->ajaxReturn($data);
				die();
			}
			
			if ($this->file[0]['type']!='school'&&$this->file[1]['name']!='id') {
				$data=array('state'=> 0 ,'news'=>'请注意提交图片和图片大小');
				$this->ajaxReturn($data);
				die();
			}

			$data = array(
				'user_id'=>1,
				'name' => I('schoolname','','htmlspecialchars'),
				'email' => I('schoolmail','','htmlspecialchars'),
				'address' => I('schooladdress','','htmlspecialchars'),
				'license_address' =>$this->file[0]['filename'],
				'card_id' => I('operatorname','','htmlspecialchars'),
				'id_num' => I('operatorid','','htmlspecialchars'),
				'card_address'=>$this->file[1]['filename'],
				'phone_number' => I('phonenum','','htmlspecialchars'),
				'apply_time' => time(),
				'success'=>0
			);
			// var_dump($data);
			$com = M('dm_campus_info');
			$id=$com->data($data)->add();
			if($id){
				session('file',null);
				session('security_code',null);
				session('apply_type',$this->file[0]['type']);
				session('apply_id', $id);
				$data=array('state'=>1,'news'=>'数据添加成功！');
				session('userinfo','1');
				$this->ajaxReturn($data);
				
			}else{
				$this->error('添加失败');
			}
	}
	//获取社团信息
	public function teamUpload(){
			if(!IS_POST) halt('页面不存在');
			//手机验证码
			$this->file=session('file');
			$this->security_code = session('security_code');

			if(I('msgcode','','htmlspecialchars') != $this->security_code){
				$data=array('state'=> 0 ,'news'=>'验证码错误！');
				$this->ajaxReturn($data);
				die();
			}
			
			if ($this->file[0]['type']!='team'&&$this->file[1]['name']!='id') {
				$data=array('state'=> 0 ,'news'=>'请注意提交图片和图片大小');
				$this->ajaxReturn($data);
				die();
			}

			$data = array(
				'user_id'=>1,
				'name' => I('teamname','','htmlspecialchars'),
				'email' => I('teammail','','htmlspecialchars'),
				'address' => I('teamaddress','','htmlspecialchars'),
				'license_address' =>$this->file[0]['filename'],
				'card_id' => I('operatorname','','htmlspecialchars'),
				'id_num' => I('operatorid','','htmlspecialchars'),
				'card_address'=>$this->file[1]['filename'],
				'phone_number' => I('phonenum','','htmlspecialchars'),
				'apply_time' => time(),
				'success'=>0
			);
			$com = M('dm_club_info');
			$id=$com->data($data)->add();
			if($id){
				session('file',null);
				session('security_code',null);
				session('apply_type',$this->file[0]['type']);
				session('apply_id', $id);
				$data=array('state'=>1,'news'=>'数据添加成功！');
				session('userinfo','1');
				$this->ajaxReturn($data);
				
			}else{
				$this->error('添加失败');
			}
	}
	//获取其他组织信息
	public function orgUpload(){
			if(!IS_POST) halt('页面不存在');
			//手机验证码
			$this->file=session('file');
			$this->security_code = session('security_code');

			if(I('msgcode','','htmlspecialchars') != $this->security_code){
				$data=array('state'=> 0 ,'news'=>'验证码错误！');
				$this->ajaxReturn($data);
				die();
			}
			
			if ($this->file[0]['type']!='org'&&$this->file[1]['name']!='id') {
				$data=array('state'=> 0 ,'news'=>'请注意提交图片和图片大小');
				$this->ajaxReturn($data);
				die();
			}

			$data = array(
				'user_id'=>1,
				'name' => I('orgname','','htmlspecialchars'),
				'email' => I('orgmail','','htmlspecialchars'),
				'address' => I('orgaddress','','htmlspecialchars'),
				'license_address' =>$this->file[0]['filename'],
				'card_id' => I('operatorname','','htmlspecialchars'),
				'id_num' => I('operatorid','','htmlspecialchars'),
				'card_address'=>$this->file[1]['filename'],
				'phone_number' => I('phonenum','','htmlspecialchars'),
				'apply_time' => time(),
				'success'=>0
			);
			$com = M('dm_others_info');
			$id=$com->data($data)->add();
			if($id){
				session('file',null);
				session('security_code',null);
				session('apply_type',$this->file[0]['type']);
				session('apply_id', $id);
				$data=array('state'=>1,'news'=>'数据添加成功！');
				session('userinfo','1');
				$this->ajaxReturn($data);
				
			}else{
				$this->error('添加失败');
			}
	}
	//获取个人信息
	public function personUpload(){
			if(!IS_POST) halt('页面不存在');
			//手机验证码
			$this->file=session('file');
			$this->security_code = session('security_code');

			if(I('msgcode','','htmlspecialchars') != $this->security_code){
				$data=array('state'=> 0 ,'news'=>'验证码错误！');
				$this->ajaxReturn($data);
				die();
			}

			if ($this->file['type']!='person'&&$this->file['name']!='id') {
				$data=array('state'=> 0 ,'news'=>'请注意提交图片和图片大小');
				$this->ajaxReturn($data);
				die();
			}

			$data = array(
				'user_id'=>1,
				'name' => I('personname','','htmlspecialchars'),
				'email' => I('personmail','','htmlspecialchars'),
				'address' => I('personaddress','','htmlspecialchars'),
				'id_num' => I('operatorid','','htmlspecialchars'),
				'card_address'=>$this->file['filename'],
				'phone_number' => I('phonenum','','htmlspecialchars'),
				'applytime' => time(),
				'success'=>0
			);
			$com = M('dm_person_info');
			$id=$com->data($data)->add();
			if($id){
				session('file',null);
				session('security_code',null);
				session('apply_type',$this->file['type']);
				session('apply_id', $id);
				$data=array('state'=>1,'news'=>'数据添加成功！');
				session('userinfo','1');
				$this->ajaxReturn($data);
				
			}else{
				$this->error('添加失败');
			}
	}

	public function phonenum(){
		import('Class.SendMsg',APP_PATH);
		// $phonenum="13017148493";
		// $phonecode="{\"param1\":\"1000\"}";
		if (!IS_POST) {
			halt('页面不存在！');
		}
		$phonenum=I('post.phone_num','','htmlspecialchars');	

		$this->security_code=rand(10000,99999);
		$phonecode="{\"param1\":\"{$this->security_code}\"}";
		$msg=new SendMsg($phonenum,$phonecode);
		$msg->init();
		// $this->security_code=10000;
		$code=session('security_code');
		if (isset($code)) {
			session('security_code',null);
		}
		session('security_code',$this->security_code);
		$data =1;
		$this->ajaxReturn($data);
	}
	
	public function imageupload(){

		import('Class.UploadHandler',APP_PATH);
		
		if (!IS_POST) halt('页面不存在！');
		$type = I('get.type');
		$name = I('get.name');


		// type和name的对应关系
		switch ($type) {
			case 1:$type='com';break;
			case 2:$type='school';break;
			case 3:$type='team';break;
			case 4:$type='org';break;
			case 5:$type='person';break;
		}
		switch ($name) {
			case 1:$name='id';break;
			case 2:$name='license';break;
			case 3:$name='item';break;
		}
		
		//文件上传到服务器
		$dir='/App/Upload/'.$type.'/'.$name.'/';
		$upload_handler = new UploadHandler($dir,$type,$name);
		switch ($type) {
			case 'com':$type=1;break;
			case 'school':$type=2;break;
			case 'team':$type=3;break;
			case 'org':$type=4;break;
			case 'person':$type=5;break;
		}
		$file_name=$upload_handler->file_name;
		$file_address=$dir.$file_name;
		$id=session('file');			
		session('file',null);
		if (isset($id)&&isset($id[1])) {	
			$id=null;	//如果刷新之后再次提交，清楚session
		}
		if (isset($id)) {
			$newfile = array(
				0 => array(
						'filename' => $id['filename'],
						'type' => $id['type'],
						'name' => $id['name'],
					),
				1 => array(
						'filename' => $file_name,
						'type' => $type,
						'name' => $name,
					)
				); 
			session('file',$newfile);
		}
		else{
			$this->file = array(
				'filename' => $file_name,
				'type' => $type,
				'name' => $name,
			 );
			session('file',$this->file);
		}
	}
}
?>