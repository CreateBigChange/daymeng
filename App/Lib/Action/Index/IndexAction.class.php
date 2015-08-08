<?php
header("Content-type:text/html;charset=utf-8");
/*
这是前台首页控制器
*/
Class IndexAction extends Action{
	// 倒计时
	Public function _initialize(){
				$result = M('dm_items')->query('select id,begin_time from dm_items where item_check = 3');
			foreach ($result as $key => $value) {
			if ($value['begin_time']<time()) {
				M('dm_items')->query("update dm_items set item_check=1 where id = {$value['id']} ");
			}
		}
		// 查看项目是不是已经该上线了
			if(isMobile()){
			$this->redirect('index/Mobile/mb');
		}


	
	}


	Public function index(){
		// $dm_items=M("dm_items")->where("item_check=1 and '(".time()."-begin_time)'<time*3600*24")->order(array("recommend_level"=>"desc"))->limit("10")->select();
		$hots=M("dm_community_comments_first")->order(array("com_num"=>"desc"))->limit(3)->select();
		$i=0;
		while ($hots[$i]) {
			if(mb_strlen($hots[$i]['content'])>15)
			$hots[$i]['content']=mb_substr($hots[$i]['content'],0,12,'utf-8')."...";
			$i++;
		}
		$this->hots=$hots;
		$this->display();			
	}
			
	Public function sort1(){
		if(!IS_AJAX){//如果不是ajax提交
			halt("页面不存在");
		} 		$value = cookie('dm_sign');
	
			$value = 'dm.yxs';
			setcookie('dm_sign',$value,time()+30*24*3600,'/');
			// echo cookie('dm_sign');
			$dm_items[0]=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time() )->order(array("recommend_level"=>"desc"))->limit("10")->select();

			$dm_items[1]=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time())->order(array("(fund_sup+sup)"=>"desc"))->limit("10")->select();

			$dm_items[2]=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time())->order(array("(fund_gain+gain)"=>"desc"))->limit("10")->select();
			$dm_items[3]=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time())->order(array("begin_time"=>"asc"))->limit("10")->select();
			if($dm_items){
			for($j=0;$j<4;$j++){
					$i=0;
					while($dm_items[$j][$i]){
					 $dm_items[$j][$i]["remaining_day"]= $dm_items[$j][$i]["time"]-floor((time()-$dm_items[$j][$i]["begin_time"])/24/3600);
					 $dm_items[$j][$i]["gain"]=sprintf("%.1f",$dm_items[$j][$i]["gain"]+$dm_items[$j][$i]["fund_gain"]);
					 $dm_items[$j][$i]["gained"]=ceil($dm_items[$j][$i]["gain"]/$dm_items[$j][$i]["money"]*100);
					 $dm_items[$j][$i]["sup"]=$dm_items[$j][$i]["sup"]+$dm_items[$j][$i]["fund_sup"];
					 // $dm_items[$i]["gain"]=substr($dm_items[$i]["gain"],0,strpos($dm_items[$i]["gain"],".")).'.'.ceil(substr($dm_items[$i]["gain"],strpos($dm_items[$i]["gain"],".")+1,strpos($dm_items[$i]["gain"],".")+2)/100.0);
					 if(strlen($dm_items[$j][$i]["items_description"])>50)
					 $dm_items[$j][$i]["items_description"]= mb_substr($dm_items[$j][$i]["items_description"],0,50,"UTF-8")."...";
					 $i++;
			}
			}

		}
		$this->ajaxReturn($dm_items,"json");
	}
	Public function zan(){
	if(!IS_AJAX){
		return 0;
	}
	if(M("dm_items")->where("id=".I("id"))->setInc("prise")) {//赞成功
		$this->ajaxReturn(array(
			"status"=>1
			),"json");
	}else{//点赞失败
		setcookie('prise'.I("id"),I("id"),time()-3600,'/');
		$this->ajaxReturn(array(
			"status"=>0
			),"json");
	}

	}
	Public function att(){
	if(!IS_AJAX){
		return 0;
	}
	if(!$_SESSION["user_id"]){//未登录
		$this->ajaxReturn(array(
			"status"=>3
			),"json");
	}
	if(M("dm_items_support")->where("items_id=".I("items_id")." and user_id=".$_SESSION["user_id"])->find()) {//记录存在
		$this->ajaxReturn(array(
			"status"=>0
			),"json");
		return 0;
	}else{//记录不存在
		$sav["attention"]=1;
		$sav["items_id"]=I("items_id");
		$sav["user_id"]=$_SESSION["user_id"];
		if(M("dm_items_support")->add($sav)&&M("dm_items")->where("id=".I("items_id"))->setInc("attention")) {//更新成功
			$this->ajaxReturn(array(
			"status"=>1
			),"json");
			return 0;
		}else{//更新失败
			setcookie('prise'.I("id"),I("id"),time()-3600,'/');
		$this->ajaxReturn(array(
			"status"=>2,
			"js"=>M("dm_items_support")->getLastSql(),
			'js2'=>M("dm_items")->getLastSql()
			),"json");
		}
		
		
	}

	}
	Public function complaint(){
		// if(!session("user_id")){
		// 	return 0;
		// }
			if($_SESSION['ip']==get_client_ip() && time()-$_SESSION['ip_time']<300  ){//同一ip多次吐槽
				$this->ajaxReturn(array('status'=>2),'json');	
				return 0;	
			}else{
			$_SESSION['ip']=get_client_ip();
			$_SESSION['ip_time']=time();
			$data["content"]=I('content');
			$data['user_id']=session('user_id');
			$data['time']=time();
			$data['ip']=get_client_ip();
			if(M('dm_complaint')->add($data)){	
				$this->ajaxReturn(array('status'=>1),'json');
			}else{
				$this->ajaxReturn(array('status'=>0),'json');				
			}
			}
			

	}

}
?>