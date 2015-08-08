<?php if (!defined('THINK_PATH')) exit();?><html><head><title>吐槽浏览</title><style type="text/css">
td{
	width: 200px;
}

</style></head><body><table  border=1  cellspacing="0px" style="margin:0px auto;"><form action='<?php echo U("/admin/management/send_msg",'','');?>'	 method='post'	><tr><td colspan='3'  ><textarea name='send_msg' cols='100' rows='10' placeholder='请输入要发送的内容' ></textarea></td></tr><tr><td>
请输入要发送的用户的账号
</td><td><input type='text' name='username' placeholder='填写用户账号或者0'  /></td><td>请注意,当填写为0时,表示群发</td></tr><tr><td colspan='3'><input type='submit' value='发送' /></td></tr></form></table></body></html>