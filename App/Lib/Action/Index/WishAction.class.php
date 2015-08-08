<?php
header("Content-type:text/html;charset=utf-8");
/*
这是许愿墙控制器
*/
//首页视图 
Class WishAction extends Action{
	Public function index(){
		if(!$_SESSION['user_id']){//未登陆
			$this->redirect('index/login','',2,'请先登陆哦,浏览器将在1秒之后跳转到登陆页面.');
			return 0;
		}
		$wish=M("hd_wish")->limit(5)->order('prise_number desc')->select();
		$this->assign('wish',$wish)->display();
	}
	//异步发布处理
	Public function handle(){
		if(!IS_AJAX){//如果不是ajax提交
			halt("页面不存在");
		} 
			$data=array(
					"username"=>$_SESSION['username'],
					"content"=>I("wish_content"),
					"time"=>date('y-m-d H:m:s',time()),
				);
			if(!$_SESSION['release_wish_time'])//第一次许愿
					$_SESSION['release_wish_time']=time();
			else{
				if(time()-$_SESSION['release_wish_time']<300)//发表间隔小于五分钟
					return 0;
			}
			$_SESSION['release_wish_time']=time();
			if(M('hd_wish')->add($data)){
				$this->ajaxReturn(array('status'=>1),'json');
			}else{
				$this->ajaxReturn(array('status'=>0),'json');

			}

	}
	Public function wishsort(){
			if(!IS_AJAX){
				_404('页面不存在');
			}
			$page=$_POST['page'];
			$begin=5;
			$sum=8;
			$sort=$_POST['sort'];
			$total_page=ceil((M('hd_wish')->count()-$begin)/$sum);
			if($data=M('hd_wish')->limit($begin+($page-1)*$sum,$sum)->order( $sort.' desc')->select()){
				$this->ajaxReturn(array(
					'data1'=>$data,
					 'total_page'=>$total_page
					),'json');
			}else{
				$this->ajaxReturn($data,'json');

			}
	}
	
}
?>