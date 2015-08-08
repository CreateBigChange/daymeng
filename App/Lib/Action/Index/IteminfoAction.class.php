<?php
header('Content-Type:text/html;charset=utf-8');
/**
* 回报信息填写控制器
*/
class IteminfoAction extends Action
{
	/**
	 * 当用户不是由上一步跳转时，提示信息;
	 */
	Public function _initialize(){
	 	 // 初始化的时候检查用户权限,通过session值判断
		// $this->checkRbac();
		$user_id=session('user_id');
		$userinfo=session('userinfo');
		if (!isset($user_id)) {
			$this->error('请先登陆',U('index/Login/index'));
		}
		if (!isset($userinfo)) {
			$this->error('请先填写个人信息',U('index/Startitem/index'));
		}
	}

	public function index(){
		$this->display();
	}
	public function getInfo(){

		//使用kindeditor自带的过滤方式
		$details = '';
		if (!empty($_POST['content'])) {
			if (get_magic_quotes_gpc()) {
					$details = stripslashes($_POST['content']);
				} 
				else {
				$details = $_POST['content'];
			}
		}

		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/items/';// 设置附件上传目录	
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			
			$info =  $upload->getUploadFileInfo();
			$file=$info[0]['savename'];
		}

		$user_id=session('user_id');
		$apply_id=session('apply_id');
		$apply_type=session('apply_type');
		$title = I('itemname','','htmlspecialchars'); 
		$money = I('money','','htmlspecialchars');
		$time = I('day','','htmlspecialchars');
		$items_classes = I('iCheck');
		$province=I('province');
		$city=I('city');
		$items_description = I('introduce','','htmlspecialchars');

		

		$data = array(
			'user_id' => $user_id,//session中获得
			'apply_id' => $apply_id,//session中获得
			'apply_type' => $apply_type,//session中获得
			'title' => $title,
			'money' => $money,
			'time' => $time,
			'items_classes' => $items_classes,
			'province' => $province,
			'city' => $city,
			'img' =>$file,
			'items_description' => $items_description,
			'details' => $details,
			'begin_time'=>time()
			);
		$items = M('dm_items');
		$id=$items->data($data)->add();
		if ($id) {
			session('items_id',$id);
			$this->redirect('Returninfo/index');
		}
	}
}
?>