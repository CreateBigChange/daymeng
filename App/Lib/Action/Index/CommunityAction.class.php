<?php
	class CommunityAction extends Action
	{
		//寻找另一页的今日话题评论
		public function topic_today()
		{
			$id = $_POST["id"];
			//找出主评论和第二评论
			$user=M();
			$main_community = $user->query("
				select 
					dm_community_comments_first.id,
					dm_community_comments_first.prise,
					dm_community_comments_first.time,
					dm_community_comments_first.user_id,
					dm_community_comments_first.content,
					dm_community_comments_first.img,
					dm_community_comments_first.com_num,
					dm_user.niker,
					dm_user_info.img as person_img
				from 
					dm_community_comments_first,
					dm_user,
					dm_user_info
				where 	 
					dm_user_info.id = dm_community_comments_first.user_id and 
					dm_user.id=dm_community_comments_first.user_id and
					dm_community_comments_first.id =".$id
			);


			///////////////////////////////////////////////////////////
			//获取前第所有第二主评论
				for($i=0;$i<count($main_community) ;$i++)
				{
					//dump($main_community[$i]["id"]);
					$second_community[$i] = $user->query("
					select 
						dm_community_comments_second.id,
						dm_community_comments_second.time,
						dm_community_comments_second.user_id,
						dm_community_comments_second.content,
						dm_user.niker,
						dm_user_info.img as person_img
					from 
						dm_community_comments_second,
						dm_user,dm_user_info
					where 
						dm_community_comments_second.from_id = ".$main_community[$i]["id"]." and dm_user.id = dm_community_comments_second.user_id and dm_user_info.id = dm_community_comments_second.user_id
					");
					//获取前第所有第三主评论
					$main_community[$i]["time"] = date('Y-m-d H:i:s',$main_community[$i]["time"]);
					for($k=0;$k<count($second_community[$i]);$k++)
					{
					//	dump($second_community[$i][$k]["id"]);

						$second_community[$i][$k]["time"] = date('Y-m-d H:i:s',$second_community[$i][$k]["time"]);
					//把时间戳转化为具体的时间

					}
				}
			$data[0] = $main_community;
			$data[1] = $second_community;
			$this->ajaxReturn($data,'JSON');

			
			//找出主评论和第二评论
			
		}
		public function next_y()
		{
			
			$topic_id = $_POST["topic_id"];
			$id = $_POST["id"]*5;
			
			$data = M()->query('
				select 
					*
				from 
					dm_second_topic
				where father_id ="'. $topic_id.'"order by time desc limit '.$id.',5'
			);
			
			for($i=0;$i<count($data);$i++)
			{
					$tmp=M()->query("
						SELECT 
							niker 
						FROM 
							`dm_user` 
						WHERE id =".$data[$i]['user_id']
						);
				$data[$i]['niker']=$tmp[0]["niker"];
			}
			//$data = $_POST["id"];
			$this->ajaxReturn($data,'JSON');
		}
		
		//进入话题的评论
		public function hot_t_p()
		{
			$user = M("dm_second_topic");
			$user->user_id= $_SESSION["user_id"];
			$user->content=I('post.content','','htmlspecialchars');
			$user->time = time();
			$user->father_id =$_POST["father_id"];
			$user->add();
			M("dm_today_topic")->where("id = ".$_POST["father_id"])->setInc("p_num");
			$data=1;
			$this->ajaxReturn($data,'JSON');
		}
		//进入话题的评论
		
		//进入话题的点赞
		public function hot_zan_ajax(){
			M("dm_today_topic")->where("id = ".$_POST["id"])->setInc("prise_num");
			$data= "1";
			$this->ajaxReturn($data,'JSON');
		}
		//进入话题的点赞
		public function zan_ajax(){
			$User=M("dm_community_comments_first");
			
			$status=$User->where('id='.$_POST["from_id"])->setInc('prise'); // 用户话题的赞加1
			//$this->success('数据保存成功！');
			
			if(!$status)
			{
				$data=0;//返回错误代码
			}
			$this->ajaxReturn($data,'JSON');
		}
		public function index()
		{
		//热门话题
		$hot_topic_one = M("dm_community_comments_first")->order("com_num desc")->limit(10)->select();

		//dump($hot_topic_one);
		$this->assign("hot_topic_one",$hot_topic_one);
		//热门话题
		//获取今日最新的话题
			$dm_today_topic=M("dm_today_topic")->order('dm_time desc')->limit(1)->select();
			//dump($dm_today_topic);
			$this->assign("dm_today_topic",$dm_today_topic);
		//获取今日最新的话题
		
		//获取最新话题的子评论
			$today_topic_child = M()->query('
				select 
					*
				from 
					dm_second_topic
				where father_id ="'. $dm_today_topic[0]["id"].'"order by time desc limit 0,5'	
			);
			$topic_num = $dm_today_topic[0]["p_num"];
			for($i=0;$i<5;$i++)
			{
				
				$tmp=M()->query("
				SELECT 
					niker 
				FROM 
					`dm_user` 
				WHERE id =".$today_topic_child[$i]["user_id"]
				);
				$today_topic_child[$i]['niker']=$tmp[0]["niker"];
			}
			//dump($tmp);
			//dump ($topic_num);
			$this->assign("topic_num",$topic_num);
			//dump($today_topic_child);
			$this->assign("today_topic_child",$today_topic_child);
		//获取最新话题的子评论
	
		
			
			$_POST["id"]=$_SESSION["user_id"];
			//获取个人的信息
			$user=M();
			$person_info = $user->query("
				select img,niker,person_description 
				from dm_user_info,dm_user
				where dm_user_info.id = ".$_POST["id"]." and dm_user.id = ".$_POST["id"]
				);
			//dump($person_info);
			//获取前5个第一主评论的
			$main_community = $user->query("
				select 
				dm_community_comments_first.id,
				dm_community_comments_first.prise,
				dm_community_comments_first.time,
				dm_community_comments_first.user_id,
				dm_community_comments_first.content,
				dm_community_comments_first.img,
				dm_community_comments_first.com_num,
				dm_user.niker,
				dm_user_info.img as person_img
				from dm_community_comments_first,dm_user,dm_user_info
				where dm_user_info.id = dm_community_comments_first.user_id and dm_user.id=dm_community_comments_first.user_id   Order By time Desc limit 0,5
			");
				//获取前第所有第二主评论
				for($i=0;$i<count($main_community) ;$i++)
				{
					//dump($main_community[$i]["id"]);
					$second_community[$i] = $user->query("
					select 
					dm_community_comments_second.id,
					dm_community_comments_second.time,
					dm_community_comments_second.user_id,
					dm_community_comments_second.content,
					dm_user.niker,
					dm_user_info.img as person_img
					from dm_community_comments_second,dm_user,dm_user_info
					where dm_community_comments_second.from_id = ".$main_community[$i]["id"]." and dm_user.id = dm_community_comments_second.user_id and dm_user_info.id = dm_community_comments_second.user_id
					");
					//获取前第所有第三主评论
					$main_community[$i]["time"] = date('Y-m-d H:i:s',$main_community[$i]["time"]);
					for($k=0;$k<count($second_community[$i]);$k++)
					{
					//	dump($second_community[$i][$k]["id"]);

						$second_community[$i][$k]["time"] = date('Y-m-d H:i:s',$second_community[$i][$k]["time"]);
					//把时间戳转化为具体的时间

					}
				}
				
				
			//dump($main_community);
			$this->assign("main_community",$main_community);
		//	dump("--------------------------第二------------------------------");
		//	dump($second_community);
			$this->assign("second_community",$second_community);
		//	dump("----------------------------第三----------------------------");
		//	dump($three_community);
		//	$this->assign("three_community",$three_community);
			$this->assign("person_info",$person_info);
			$this->display();
		}
		public function community_ajax()
		{
			//$data=$_POST["page"];
			$user=M();
			
			//每次下拉获取3条评论
			//获取主评论
			
				$first_community = $user->query("
					select
						dm_community_comments_first.id,
						dm_community_comments_first.time,
						dm_community_comments_first.prise,
						dm_community_comments_first.user_id,
						dm_community_comments_first.content,
						dm_community_comments_first.img,
						dm_community_comments_first.com_num,
						dm_user.niker,
						dm_user_info.img as person_img
					from dm_community_comments_first,dm_user,dm_user_info
					where dm_user_info.id = dm_community_comments_first.user_id and dm_user.id=dm_community_comments_first.user_id order by time desc limit ".$_POST["page"].",3
				");
				//获取第二评论
				for($i=0;$i<count($first_community);$i++)
				{
					
					$second_community[$i]=$user->query("
					select 
						dm_community_comments_second.id,
						dm_community_comments_second.time,
						dm_community_comments_second.user_id,
						dm_community_comments_second.content,
						dm_user.niker,
						dm_user_info.img as person_img
					from dm_community_comments_second,dm_user,dm_user_info
					where dm_community_comments_second.from_id = ".$first_community[$i]["id"]." and dm_user.id = dm_community_comments_second.user_id and dm_user_info.id = dm_community_comments_second.user_id
				");
				$first_community[$i]['time'] = date('Y-m-d H:i:s',$first_community[$i]['time']); 
				for($k=0;$k<count($second_community[$i]);$k++)
				{
					$second_community[$i][$k]["time"] = date('Y-m-d H:i:s',$second_community[$i][$k]["time"]); 
				}
				//换算时间
			}
			$data[0]=$first_community;
			$data[1]=$second_community;
			$data[2]=$three_community;
			
			$this->ajaxReturn($data,'JSON');
		}
		public function main_ajax()//主要评论的提交
		{
			$data=$_SESSION["user_id"];
			$user=M("dm_community_comments_first");
			$user->time=time();
			$user->content=I('post.content','','htmlspecialchars');
			$user->user_id=$_POST["id"];
			$user->add();
			$this->ajaxReturn($data,'JSON');
		}
		public function second_ajax()//第二评论的ajax
		{
			
			$data=$_POST["content"];
			
			$user=M("dm_community_comments_second");
			$user->time=time();
			$user->content=I('post.content','','htmlspecialchars');
			$user->user_id=$_SESSION["user_id"];
			$user->from_id=$_POST["from_id"];
			$user->add();
			$user=M("dm_community_comments_first")->where("id = ".$_POST["from_id"])->setInc("com_num");
			$this->ajaxReturn($data,'JSON');
		}
		public function three_ajax()//第三评论的ajax
		{
			$data=$_POST["content"];
			$user=M("dm_community_comments_three");
			$user->time=time();
			$user->content=$_POST["content"];
			$user->user_id=$_POST["id"];
			$user->from_id=$_POST["from_id"];
			$user->add();
			$this->ajaxReturn($data,'JSON');
		}
		
		Public function upload(){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/res/images/community/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
			
			//当没没有上传图片的时候进入
			
			$User = M("dm_community_comments_first"); // 实例化User对象
			$User->user_id=$_SESSION["user_id"];
			$User->content=I('post.photo2','','htmlspecialchars');
			$User->time=time();	
			$User->add(); // 写入用户数据到数据库
			$this->redirect("index");
			
			
		
			
			
			}else{// 上传成功 获取上传文件信息，上传图片时进入
			$info =  $upload->getUploadFileInfo();
		
			}
			 
			// 保存表单数据 包括附件数据
			
			$User = M("dm_community_comments_first"); // 实例化User对象
			$User->user_id=$_SESSION["user_id"];
			$User->content=I('post.photo2','','htmlspecialchars');
			$User->time=time();
			$User->img = $info[0]['savename']; // 保存上传的照片根据需要自行组装	
			$User->add(); // 写入用户数据到数据库
			$this->redirect("index");
			
			}
		
	}
?>