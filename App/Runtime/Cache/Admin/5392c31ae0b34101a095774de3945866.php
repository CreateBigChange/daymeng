<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">body{

	font-family: 'Microsoft Yahei';

}

td{

		max-width:750px;

		max-height: 100px;

		padding: 5px 10px;

		text-align: left;



	}

	.page{

		text-align: center;

	}

	.page a{

	padding: 5px 10px;

	}



</style><table border="1px" cellspacing="0px" style="margin:0px auto;"><?php if(is_array($items)): foreach($items as $key=>$v): ?><form action="<?php echo U('admin/management/items_check','','');?>" method="post" enctype="multipart/form-data"><tr><td colspan="3" style="text-align:center;"><a href="<?php echo U('admin/management/item_delete','','');?>?id=<?php echo ($v["id"]); ?>">删除</a></td></tr><tr><td>项目ID</td><td><input type="text" value="<?php echo ($v["id"]); ?>"maxlength="30" name="id" readonly /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>用户id</td><td><input type="text" value="<?php echo ($v["user_id"]); ?>"maxlength="126"  name="user_id"  readonly /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>对应五类信息登记表的id</td><td><input type="text" value="<?php echo ($v["apply_id"]); ?>"maxlength="30"  name="apply_id"  disabled /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>申请人所属类别</td><td><input type="text" value="<?php echo ($v["apply_type"]); ?>"maxlength="30" name="apply_type"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>标题</td><td><input type="text" value="<?php echo ($v["title"]); ?>"maxlength="30" name="title"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>目标金额</td><td><input type="text" value="<?php echo ($v["money"]); ?>"maxlength="30" name="money"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>项目持续时间</td><td><input type="text" value="<?php echo ($v["time"]); ?>"maxlength="30" name="time"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>项目类别</td><td><input type="text" value="<?php echo ($v["items_classes"]); ?>"maxlength="30" name="items_classes"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>所属省份</td><td><input type="text" value="<?php echo ($v["province"]); ?>"maxlength="30" name="province"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>所属城市</td><td><input type="text" value="<?php echo ($v["city"]); ?>"maxlength="30" name="city"  /></td><td style="color:#a7ce37">可修改</td></tr><tr><td>项目简介图片</td><td><img src="__ROOT__/Public/uploads/Items/<?php echo ($v["img"]); ?>" style="width:700px;"><td style="color:#a7ce37">请保存另存为修改(400*220)好之后上传</td></tr><tr><td>在此上传修改(400*200)好之后的项目简介图片(大小:10K-2M)</td><td><input type="file" name="new_img" /></td></tr><tr><td>新项目简介图片</td><td><img src="__ROOT__/Public/res/images/index/<?php echo ($v["new_img"]); ?>"><td style="color:#a7ce37">正式显示的项目简介的图片</td></tr><tr><td>项目简介</td><td><textarea type="text" rows="4" cols="100"maxlength="300" name="items_description"  ><?php echo ($v["items_description"]); ?></textarea></td><td style="color:#a7ce37">可修改</td></tr><tr><td>详细内容</td><td><?php echo ($v["details"]); ?><td style="color:#a7ce37">请另存为修改(600*1000px)好之后上传</td></tr><tr><td>在此上传修改(600*1000px)好之后的新的详细内容图片(大小:10K-2M)</td><td colspan="2"><input class="image_upload" type="file" name="pic[]" ><input class="image_upload" type="file" name="pic[]" ><input class="image_upload" type="file" name="pic[]" ><input class="image_upload" type="file" name="pic[]" ><input class="image_upload" type="file" name="pic[]" ><div class="append_to"></div></td></tr><tr><td>新详细内容</td><td><?php if(is_array($new_details)): foreach($new_details as $key=>$v1): ?><img src="__ROOT__/Public/res/images/detailed/<?php echo ($v1); ?>"><?php endforeach; endif; ?><td style="color:#ea544a">正式显示的图片</td></tr><tr><td>浏览项目图片</td><td><img src="__ROOT__/Public/res/images/Items/<?php echo ($v["items_img"]); ?>"></td></tr><tr><td>请将项目简介图片修改(220*220px)好之后上传</td><td><input type="file"  name="items_img"  /></td></tr><tr><td>项目开始时间</td><td><input type="text" value="<?php echo date("Y-m-d H:i:s",$v["begin_time"]) ?>"maxlength="30" name="begin_time"  /><span style="color:#ea544a">请注意一定要按照正确的格式输入时间，如：2014-12-12 12:12:12</span></td><td style="color:#a7ce37">可修改</td></tr><tr><td>是否已经完成</td><td><input type="text" value="<?php echo ($v["success"]); ?>"maxlength="30" name="success" disabled /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>审核状态</td><td><input type="radio" value="0"maxlength="30" name="item_check"   

		<?php
 if($v["item_check"]==0){ echo " checked"; } ?>		/>0

		 <input type="radio" value="1"maxlength="30" name="item_check" 

		 <?php
 if($v["item_check"]==1){ echo " checked"; } ?>		 />1

		  <input type="radio" value="3"maxlength="30" name="item_check" 

		 <?php
 if($v["item_check"]==3){ echo " checked"; } ?>		 />3

		</td><td style="color:#a7ce37">0表示未通过审核,1表示通过审核,3表示即将推出</td></tr><tr><td>已经达到金额</td><td><input type="text" value="<?php echo ($v["gain"]); ?>"maxlength="30" name="gain" disabled /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>支持数</td><td><input type="text" value="<?php echo ($v["sup"]); ?>"maxlength="30" name="sup" disabled /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>赞的数目</td><td><input type="text" value="<?php echo ($v["prise"]); ?>"maxlength="30" name="prise" disabled /></td><td style="color:#ea544a">不可修改</td></tr><tr><td>排序等级</td><td><input type="text" value="<?php echo ($v["recommend_level"]); ?>"maxlength="30" name="recommend_level"  /></td><td style="color:#a7ce37">可修改</td></tr><td style="margin-left:30px;color:#ea544a">在此填写(不)通过原因(此信息将被发给申请者)</td><td><textarea rows="4" cols="100" name="content"></textarea></td></tr><tr><td colspan="3" style="text-align:center;"><input type="submit" name="sure_check" value="确认通过审核" /></td></tr><tr><td colspan="3" class="page"><?php echo ($page); ?></td></tr></form><?php endforeach; endif; ?></table><script type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script type="text/javascript">		$(".image_upload").click(

			function(){

				$("<input class='image_upload' type='file' name='pic[]' >").appendTo(".append_to");

				}

			);

</script>