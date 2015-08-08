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



</style><table border="1px" cellspacing="0px" style="margin:0px auto;"><tr><td colspan="3" style="text-align:left"><form action="<?php echo U('admin/index/repay_checked_search','','');?>" method="post" ><input  type="text"  placeholder="请输入项目名称进行搜索" name="search_repay"  /><input  type='submit' value='搜索' name="sure_search_repay" /></form></td></tr><?php if(is_array($apply_info)): foreach($apply_info as $key=>$v): ?><form action="<?php echo U('admin/management/repay','','');?>" method="post"enctype="multipart/form-data" ><tr><td colspan="3" style="text-align:center;"><a  href="<?php echo U('admin/management/repay_delete','','');?>?id=<?php echo ($v["id"]); ?>&kinds=dm_company_info">删除</a></td></tr><tr><td>回报ID</td><td><input type="text" value="<?php echo ($v["id"]); ?>"maxlength="30" name="id" readonly /></td></tr><tr><td>项目id</td><td><input type="text" value="<?php echo ($v["items_id"]); ?>"maxlength="126"  name="items_id" readonly /></td></tr><tr><td>项目名称</td><td><?php echo ($v["title"]); ?></td></tr><tr><td>支持金额</td><td><input type="text" value="<?php echo ($v["money"]); ?>"maxlength="30"  name="money"   /></td></tr><tr><td>回报内容</td><td><textarea type="text"  cols='50' rows='10' name="content"  ><?php echo ($v["content"]); ?></textarea></td></tr><tr><td>说明图片</td><td><img src="__ROOT__/Public/Uploads/repay/<?php echo ($v["img"]); ?>" /></td><td><input type="file" value="上传新的说明图片" name="new_card_address" /></td></tr><tr><td>新的说明图片</td><td><img src="__ROOT__/<?php echo ($v["new_img"]); ?>" /></td></tr><tr><td>限定名额</td><td><input type="text" value="<?php echo ($v["limits"]); ?>"maxlength="30" name="limits"  /></td></tr><tr><td>运费</td><td><input type="text" value="<?php echo ($v["send_money"]); ?>"maxlength="30" name="send_money"  /></td></tr><tr><td>回报时间</td><td><input type="text" value="<?php echo ($v["time"]); ?>"maxlength="30" name="time"  /></td></tr><tr><td>每个回报信息在项目中的序号</td><td><input type="text" value="<?php echo ($v["repay_num"]); ?>" maxlength="300" name="repay_num" /></td></tr><tr><td>审核状态</td><td><input type="radio" value="0"maxlength="30" name="repay_check"   

		<?php
 if($items["repay_check"]==0){ echo " checked"; } ?>		/>0

		 <input type="radio" value="1"maxlength="30" name="repay_check" 

		 <?php
 if($items["repay_check"]==1){ echo " checked"; } ?>		 />1

		 

		 <span style="margin-left:30px;color:#ea544a">(0表示未通过审核,1表示通过审核)</span></td></tr><tr><tr><td colspan="2" style="text-align:center"><input type="submit" value="确认通过审核" /><input type="submit" name='copy' value="复制这个回报" /></td></tr><tr><td colspan="3" class="page"><?php echo ($page); ?></td></tr></form><?php endforeach; endif; ?></table>