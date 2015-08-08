<?php
function _initinal(){
	echo "后台";
}
function detail_opration($opration_kinds,$table_name,$id){
	if($opration_kinds=="cancel"){
		$rel_table_name="dm_".$table_name;
		M($rel_table_name)->where("id=".$id)->setField("lock_","1");	
		return "";	
	}
	if($opration_kinds=="change"){
		$rel_table_name="dm_".$table_name;
		$result=M($rel_table_name)->where("id=".$id)->find();
		return $result;
	}
}
?>
