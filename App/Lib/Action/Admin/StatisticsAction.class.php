<?php
header("Content-type:text/html;charset=utf-8");

/*
后台管理控制器
*/
class StatisticsAction extends Action{
		Public function all_number(){
			if(!$_SESSION["dm_admin_id"]){
				return ;
			}
			$model=new Model();
			$result=$model->query("
				select count(*) from dm_user where (".time()."-logintime)<3600
				");
			$user_number=$result[0]["count(*)"];
			$this->user_number=$user_number;
			$this->display();
			// echo session_id()."<br>";
			// echo session_cache_limiter();
		}
}
?>