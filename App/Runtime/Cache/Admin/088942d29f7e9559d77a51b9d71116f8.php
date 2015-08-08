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



	</style></head><body><table  border="1px" cellspacing="0px" style="margin:0px auto;" class="manage_user"><tr ><td colspan="27"><h2 style="text-align:center">其它项目一览</h2><form action="<?php echo U('admin/index/items_search_company','','');?>"method="post" style="text-align:left;"><input type="text" value="" name="search_items" placeholder="请输入项目标题称进行搜索" style="width:200px;height:20px;" /><input type="submit" value="搜索项目"  name="sub_search" style="width:80px;height:25px;"  /></form></td></tr><tr><td>项目id</td><td>申请者id</td><td>对应五类信息登记表的id</td><td>申请人所属类别</td><td>标题</td><td>目标金额</td><td>项目持续时间</td><td>项目类别</td><td>项目省份</td><td>所属城市</td><td>项目首页图片</td><td>项目简介</td><td>详细内容</td><td>新详细内容</td><td>浏览项目图片</td><td>项目开始时间</td><td>是否已经完成项目</td><td>是否通过审核</td><td>判断是否填写完成信息</td><td>普通已经达到金额</td><td>普通支持数</td><td>基金已经达到金额</td><td>基金支持数</td><td>关注数</td><td>排序等级</td><td>操作</td><!--<td>操作</td>--></tr><?php if(is_array($items)): foreach($items as $key=>$v): ?><tr><td><?php echo ($v["id"]); ?></td><td><?php echo ($v["user_id"]); ?></td><td><?php echo ($v["apply_id"]); ?></td><td><?php echo ($v["apply_type"]); ?></td><td><?php echo ($v["title"]); ?></td><td><?php echo ($v["money"]); ?></td><td><?php echo ($v["time"]); ?></td><td><?php echo ($v["itmes_classes"]); ?></td><td><?php echo ($v["province"]); ?></td><td><?php echo ($v["city"]); ?></td><td><?php echo ($v["img"]); ?></td><td><?php echo ($v["items_description"]); ?></td><td><div class="items_details"><?php echo htmlspecialchars($v["details"]) ?></div></td><td><?php echo ($v["new_details"]); ?></td><td><?php echo ($v["details_img"]); ?></td><td><?php echo ($v["begin_time"]); ?></td><td><?php echo ($v["success"]); ?></td><td><?php echo ($v["item_check"]); ?></td><td><?php echo ($v["finish"]); ?></td><td><?php echo ($v["gain"]); ?></td><td><?php echo ($v["sup"]); ?></td><td><?php echo ($v["fund_gain"]); ?></td><td><?php echo ($v["fund_sup"]); ?></td><td><?php echo ($v["attention"]); ?></td><td><?php echo ($v["prise"]); ?></td><td><?php echo ($v["recommend_level"]); ?></td><td><a href="<?php echo U('admin/index/items_manage_company_edit','','');?>?id=<?php echo ($v["id"]); ?>" style="margin-left:5px;" ><img src="__PUBLIC__/res/images/small/xg.gif" title="修改"></td><!--

		<td class="opration"><a href="<?php echo U('admin/management/item_cancel','','');?>?id=<?php echo ($v["id"]); ?>" style="margin-right:5px;" ><img src="__PUBLIC__/res/images/small/sc.gif" title="删除"></a><a href="<?php echo U('admin/management/item_change','','');?>?id=<?php echo ($v["id"]); ?>" style="margin-left:5px;" ><img src="__PUBLIC__/res/images/small/xg.gif" title="修改"></a></td>		--></tr><?php endforeach; endif; ?><tr><td colspan="27" style="text-align:center;" class="pages"><?php echo ($page); ?></td></tr></table></body><script type="text/javascript" src="__PUBLIC__/res/js/jquery-1.11.1.min.js"></script><script type="text/javascript">	var max_length=50;

	var current=$(".items_details");

	for(var i=0;i<current.length;i++){

		if(current.eq(i).text().length>60)

		current.eq(i).text(current.eq(i).text().substr(0,60)+"...");

	}

</script></html><!--