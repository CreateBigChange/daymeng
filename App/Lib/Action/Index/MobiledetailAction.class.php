<?php
header("Content-type:text/html;charset=utf-8");
Class MobiledetailAction extends Action{
	public function index()
	{
		//dump($_GET);
		//echo "wwwwwwwwwwwwww";
		//$_GET["items"]=13;
		$data = M()->query('
			select 
				* 
			from 
				dm_items
			where id='.$_GET["items"]
			);
			
			
			
					//猜你喜欢
		$newtopic = M();
			$like_items = $newtopic->query("
				select  *  
				from dm_items 
				where item_check = 1
				order by rand() limit 4 
			");
	for($z=0;$z<4;$z++)
	{
		//$like_items[$z]=$item->where("id=".rand($begain,$end))->select();
		$like_items[$z]["img"]=explode(",",$like_items[$z]["new_details"]);
		$like_items[$z]["percent"]=ceil(($like_items[$z]["gain"]/$like_items[$z]["money"])*100);
		//$begain=$end+1;
		//$end=$end+floor(count($like)/4);
		$like_items[$z]["remain_time"]=floor((($like_items[$z]["begin_time"]+$like_items[$z]["time"]*24*3600)-time())/(24*3600));
	}
	

	//dump($like_items);
	$like_items[1]["constant"] = 100; //常量100
		$this->assign("like_items",$like_items);
		//猜你喜欢
			
			//dump($data);
			$this->assign("data",$data);
			$this->display();
	}
}
?>