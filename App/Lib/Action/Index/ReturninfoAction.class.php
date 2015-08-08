<?php
	/**
	* 回报信息,完成项目控制器
	*注意所有itemid都是由session中得到的，先是以9作为测试数据
	*/
	class ReturninfoAction extends Action{
		
		//判断是否由上一页面跳转过来
		Public function _initialize(){
		 	 // 初始化的时候检查用户权限,通过session值判断
			// $this->checkRbac();
			$user_id=session('user_id');
			$items_id=session('items_id');
			if (!isset($user_id)) {
				$this->error('请先登陆',U('index/Login/index'));
			}
			if (!isset($items_id)) {
				$this->error('请先填写个人信息',U('index/Startitem/index'));
			}
		}

		public function index(){
			$info=M('dm_repay');
			$items_id=session('items_id');
			$list=$info->where('items_id='.$items_id)->order('repay_num')->select();//items_id由session中获得
			$this->assign('list',$list);
			$last_num=$info->where('items_id='.$items_id)->order('repay_num desc')->getField('repay_num');//获得最后一个项目id
			$last_num+=1;
			$this->assign('num',$last_num);
//			echo $items_id;
			$this->display();
		}

		public function del_data(){
			if(!IS_POST) halt('页面不存在');
			$id=I('id');
			$info=M('dm_repay');
			$items_id=session('items_id');
			$info->where('id='.$id)->delete();
			$num=$info->where('items_id='.$items_id)->count();
			$this->ajaxReturn($num);
		}

		public function edit_data(){
			if(!IS_POST) halt('页面不存在');
			$id=I('id');
			$info=M('dm_repay');
			$data=$info->where('id='.$id)->find();
			$this->ajaxReturn($data);
		}

		public function get_info(){			

				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  './Public/Uploads/repay/';// 设置附件上传目录
				$items_id=session('items_id');

			if (isset($_GET['id'])) { //更新操作；

				$id=$_GET['id'];
				$data['money']=I('post.money','','htmlspecialchars');
				$data['content']=I('post.content','','htmlspecialchars');
				$data['limits']=I('post.limits','','htmlspecialchars');
				$data['send_money']=I('post.send_money','','htmlspecialchars');
				$data['time']=I('post.time','','htmlspecialchars');

				// 如果改变图片则修改图片路径，否则不修改
				if(!$upload->upload() && $upload->getErrorMsg()=='没有选择上传文件') {
					$repay=M('dm_repay');
					$repay->where('id='.$id)->data($data)->save();
					$this->redirect('index/Returninfo');
				}
				else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
					$data['img']=$info[0]['savename']; 
					$repay=M('dm_repay');
					$repay->where('id='.$id)->data($data)->save();
					$this->redirect('index/Returninfo');
				}
			}
			//插入操作
			else{

				$data['items_id']=session('items_id');
				$data['money']=I('post.money','','htmlspecialchars');
				$data['content']=I('post.content','','htmlspecialchars');
				$data['limits']=I('post.limits','','htmlspecialchars');
				$data['send_money']=I('post.send_money','','htmlspecialchars');
				$data['time']=I('post.time','','htmlspecialchars');
				if(!$upload->upload()) {// 没有上传，则路径置为空
					$data['img']=''; 				
				}
				else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
					$data['img']=$info[0]['savename']; 
				}

				$repay=M('dm_repay');
				$last=$repay->where('items_id='.$items_id)->order('repay_num desc')->find();
				if ($last) {	//如果已经存在则在该基础上加上1插入
					$data['repay_num']=$last['repay_num']+1;	
					$repay->data($data)->add();
					$this->redirect('index/Returninfo');			
				}
				else{
					$repay->data($data)->add();
					$this->redirect('index/Returninfo');
				}		
			}		
		}

		//发起项目完成，将finish属性置为1，清除session
		public function finish(){
			$item=M();
			$data['finish']=1;
			$items_id=session('items_id');
			$user_id=session('user_id');
			$item->query("update dm_items set finish=1 where id = $items_id ");
			$item->query("update dm_user set public =1 where id = $user_id");
			$item->query("insert into dm_publicplatform (user_id) values ($user_id) ");
			$this->display();
			session('items_id',null);
			session('userinfo',null);
		}
	}
?>
