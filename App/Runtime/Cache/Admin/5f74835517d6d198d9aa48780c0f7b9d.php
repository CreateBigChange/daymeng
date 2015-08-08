<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><title></title><style type="text/css">	body{

		background-color:#f3f3f3;

	}

	.manage_user td{

		max-width:300px;

		word-break:break-all

	}

	table{

		border-color: #a7ce37;

		width: 3000px;

	}

	

	td a{

		margin: 5px 0px;

	}

	.pages a{

		padding: 10px;

	}

	.opration a:hover{

		position: relative;

		left: -2px;

		top: -2px;

	}

	input{

		border: 1px solid #a7ce37;

		border-radius: 3px 3px;

		-web-kit-border-radius: 3px 3px;

		-moz-border-radius: 3px 3px;

	}



	</style></head><body><table  border="1px" cellspacing="0px" style="margin:0px auto;" class="manage_user"><tr ><td colspan="23"><h2 style="text-align:left">社团的申请信息</h2><form action="<?php echo U('admin/index/club_apply_info_search','','');?>"method="post" style="text-align:left;"><input type="text" value="" name="search_club_info" placeholder="请输入社团名称进行搜索" style="width:200px;height:20px;" /><input type="submit" value="搜索项目"  name="sub_search" style="width:80px;height:25px;"  /></form></td></tr><tr><td>社团申请id</td><td>用户的id</td><td>社团名称</td><td>社团邮箱</td><td>社团地址</td><td>证件地址</td><td>身份证姓名</td><td>证件照片地址</td><td>手机号码</td><td>信息提交时间</td><td>是否通过审核</td><td>操作</td></tr><?php if(is_array($apply_info)): foreach($apply_info as $key=>$v): ?><tr><td><?php echo ($v["id"]); ?></td><td><?php echo ($v["user_id"]); ?></td><td><?php echo ($v["name"]); ?></td><td><?php echo ($v["email"]); ?></td><td><?php echo ($v["address"]); ?></td><td><?php echo __ROOT__."/".preg_replace("/\//","", $v['license_address']) ?></td><td><?php echo ($v["card_id"]); ?></td><td><?php echo ($v["id_num"]); ?></td><td><?php echo ($v["card_address"]); ?></td><td><?php echo ($v["phone_number"]); ?></td><td><?php echo ($v["apply_time"]); ?></td><td><?php echo ($v["success"]); ?></td><td><a href="<?php echo U('admin/management/apply_info_delete','','');?>?id=<?php echo ($v["id"]); ?>&kinds=dm_club_info" style="margin-right:5px;" ><img src="__PUBLIC__/res/images/small/sc.gif" title="删除"></a></td><!--

		<td class="opration"><a href="<?php echo U('admin/management/item_cancel','','');?>?id=<?php echo ($v["id"]); ?>" style="margin-right:5px;" ><img src="__PUBLIC__/res/images/small/sc.gif" title="删除"></a><a href="<?php echo U('admin/management/item_change','','');?>?id=<?php echo ($v["id"]); ?>" style="margin-left:5px;" ><img src="__PUBLIC__/res/images/small/xg.gif" title="修改"></a></td>		--></tr><?php endforeach; endif; ?></table></body><script type="text/javascript" src="__PUBLIC__/res/js/jquery-1.11.1.min.js"></script><script type="text/javascript">/*

	var max_length=50;

	var current=$(".items_details");

	for(var i=0;i<current.length;i++){

		if(current.eq(i).text().length>60)

		current.eq(i).text(current.eq(i).text().substr(0,60)+"...");

	}

*/

</script></html><!--