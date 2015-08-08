<?php
header("Content-type:text/html;charset=utf-8");
/*
这是前台首页控制器
*/
Class LoveAction extends Action{
	public function index(){
		$this->display();
	}
}
?>