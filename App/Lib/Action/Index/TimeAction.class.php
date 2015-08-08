<?php

header('Content-Type:text/html;charset=utf-8');
Class TimeAction extends Action{
	public function index(){
		$pic=date(time(),'j').'png';
		$this->assign('pic',$pic);
		$this->display();
	}
}
?>