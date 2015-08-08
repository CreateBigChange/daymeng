<?php
header('Content-Type:text/html;charset=utf-8');
Class ItemsAction extends Action{

	Public function _initialize(){
		//查看项目是不是已经该上线了
		$result = M('dm_items')->query('select id,begin_time from dm_items where item_check = 3');
		foreach ($result as $key => $value) {
			if ($value['begin_time']<time()) {
				M('dm_items')->query("update dm_items set item_check=1 where id = {$value['id']} ");
			}
		}
			//手机显示页面
		if ($this->isMobile()) {
			$this->display('mobile');
			die();
		}
	}

	public function isMobile(){ 
	    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
	    {
	        return true;
	    } 
	    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	    if (isset ($_SERVER['HTTP_VIA']))
	    { 
	        // 找不到为flase,否则为true
	        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	    } 
	    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
	    if (isset ($_SERVER['HTTP_USER_AGENT']))
	    {
	        $clientkeywords = array ('nokia',
	            'sony',
	            'ericsson',
	            'mot',
	            'samsung',
	            'htc',
	            'sgh',
	            'lg',
	            'sharp',
	            'sie-',
	            'philips',
	            'panasonic',
	            'alcatel',
	            'lenovo',
	            'iphone',
	            'ipod',
	            'blackberry',
	            'meizu',
	            'android',
	            'netfront',
	            'symbian',
	            'ucweb',
	            'windowsce',
	            'palm',
	            'operamini',
	            'operamobi',
	            'openwave',
	            'nexusone',
	            'cldc',
	            'midp',
	            'wap',
	            'mobile'
	            ); 
	        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
	        {
	            return true;
	        } 
	    } 
	    // 协议法，因为有可能不准确，放到最后判断
	    if (isset ($_SERVER['HTTP_ACCEPT']))
	    { 
	        // 如果只支持wml并且不支持html那一定是移动设备
	        // 如果支持wml和html但是wml在html之前则是移动设备
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
	        {
	            return true;
	        } 
	    } 
	    return false;
	} 


	Public function index(){
		if($_POST["search_content"])
	{
		$search = M();
		$sql = "
			select 
				* 
			from 
				dm_items
				where dm_items.title like '%".$_POST["search_content"]."%' and item_check =1  and begin_time+time*24*60*60 > unix_timestamp(now())
				and begin_time<".time()." order by time desc  limit 0,8 ";
		$data = $search->query($sql);
		//dump ($data);
	}
	else
	{
		//排列前8个项目浏览
		$product = M();
		$data =M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time() )->select();
		$data = M()->query("
										select * from dm_items 
									where 
									item_check =1  and    begin_time+time*24*60*60 > unix_timestamp(now()) and begin_time<now()
									order by begin_time desc limit 0,8
		");
	}
		//排列前8个项目浏览
		//dump($data);
		$k=1; 
		for($i=count($data)-1;$k<=8&&$k<=count($data);$i--)
		{
			$neededData[$k-1] = $data[$i];
			$data[$i]["gain"]=$data[$i]["gain"]+$data[$i]["fund_gain"];//获取支持总钱
			$neededData[$k-1]["sup"]=$data[$i]["sup"]+$data[$i]["fund_sup"];//获取支持的总人数
			$neededData[$k-1]["percent"]=ceil(($data[$i]["gain"]/$data[$i]["money"])*100);
			$neededData[$k-1]["day"]=ceil($data[$i]["time"]-(time()-$data[$i]["begin_time"])/(3600*24));
			$neededData[$k-1]["gain"]=floor($data[$i]["gain"]);
			//金钱化整
			$k++;

		}
		$neededData["constant"] = 100; //常量100
		//dump ($neededData["constant"]);
		//dump($neededData);
		$this->assign("data",$neededData);
		//排出本周人气榜的数据
		$product_rq = M("dm_items");
		$data_rq=M("dm_items")->where("item_check=1 and ".time()."-begin_time<time*3600*24"." and begin_time<".time() )->order('sup desc')->limit('0,5')->select();
		for($i=0;$i<=4;$i++)
		{

			$data_re[$i]["sup"] = $data_rq[$i]["sup"]+$data_rq[$i]["fund_sup"];
			$data_rq[$i]["gain"] = floor($data_rq[$i]["gain"]+$data_rq[$i]["fund_gain"]);//取消人气榜金额的小数点
		}
		//dump($data_rq);
		$this->assign("data2",$data_rq);
		//即将推出的项目
		$Model = new Model();
		$recommend=M("dm_items")->where("item_check=3 and begin_time > ".time() )->select();

		//dump($recommend);
		for($i=0;$i<count($recommend);$i++)
		{	
			$recommend[$i]["gain"]=$recommend[$i]["gain"]+$recommend[$i]["fund_gain"];
			$recommend[$i]["percent"]=ceil(($recommend[$i]["gain"]/$recommend[$i]["money"])*100);
			$recommend[$i]["day"]=ceil($recommend[$i]["time"]-(time()-$recommend[$i]["begin_time"])/(3600*24));
			$recommend[$i]["begin_time"] =  date('Y-m-d H:i:s',$recommend[$i]["begin_time"]);
		}
	   
	  // dump($recommend);
	   $this->assign("recommend",$recommend);
		$this->display();
		
	}
	Public function ajax(){
	//
	//$_POST["look_id"]="activity";
		//$_POST["begin"]
	//echo $_POST["look_id"];
		
		
				$product1 = new Model();
			
				if($_POST["look_id"] =="all")
				{

					$data1["data"] = $product1->query('
								select * from dm_items 
									where 
									item_check =1  and begin_time+time*24*60*60 > unix_timestamp(now()) and begin_time<'.time().'
									order by begin_time desc limit '.(($_POST["begin"]-1)*8).',8
							');

				}
				else
				{
										$data1["data"] = $product1->query('
						select * from dm_items 
							where 
						item_check =1  and begin_time+time*24*60*60 > unix_timestamp(now()) and begin_time<'.time().' and items_classes= "'.$_POST["look_id"].'"
						order by begin_time desc limit '.(($_POST["begin"]-1)*8).',8
							');
				}

				
			for($i=0;$i<count($data1["data"]);$i++)
			{	
				$data1["data"][$i]["percent"]=ceil(($data1["data"][$i]["gain"]/$data1["data"][$i]["money"])*100);
				$data1["data"][$i]["day"]=ceil($data1["data"][$i]["time"]-(time()-$data1["data"][$i]["begin_time"])/(3600*24));
				$data1["data"][$i]["gain"] = $data1["data"][$i]["gain"]+$data1["data"][$i]["fund_gain"];
			}
			

	$this->ajaxReturn($data1,'JSON');
	}
	Public function change_ajax()
	{
		$change_product = M("dm_items");
		$change_data["data"]=$change_product->where('item_check=1 and id='. $_POST["product_id"])->select();
		//dump($change_data);
		//$change_data["post"] = $_POST["product_id"];
		$this->ajaxReturn($change_data,'JSON');
	}
	//排列项目的ajax
	public function look_ajax()
	{
		$this->ajaxReturn($change_data,'JSON');
	}
}

?> 