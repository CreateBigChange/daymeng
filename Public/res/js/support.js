var NAME;
var PROVINCE;
var SEL_CITY;
var SEL_COUNTY;
var DETAIL_ADDRESS;
var ADDRESS_PHONE;
var POSTCODE;
var id;

function dele_address(){
	var current=$("input[name='address']:checked").parent("span");
		 id=$("input[name='address']:checked").val();
	if(current.prev().val()=="undefined")//上级元素不存在
	current.prev().find("input[name='address']").prop("checked",true);
	else
	current.next().find("input[name='address']").prop("checked",true);
	$.ajax({
		url:del_address,
		type:"post",
		data:"id="+id,
		success:function(data,textStatus){
				if(data.status==1){
					current.text("");
					$("input[name='address']:checked").parent("span").find("a").show();
				}else {
					alert("删除失败");
				}
		},
		errror:function(){
			alert("请不要频繁点击");
		}
	});
}
$(function(){
	//设置提交的address_id的值
	$("input[name='address_id']").val($("input[name='address']:checked").parent("span").find(".address_id").val());
	$("input[name='address']:checked").parent("span").find("a").show();
	$("input[name='address']").click(
		function(){
			$("input[name='address_id']").val($("input[name='address']:checked").parent("span").find(".address_id").val());
			var current1=$(this);
			$(".edit_address").hide();
			var cl='.'+$("input[name='address']:checked").parent("span").find("a").attr("class");
			$("input[name='address']:checked").parent("span").find("a").show();
			$(cl).not($("input[name='address']:checked").parent("span").find("a")).hide();
			$("input[name='address_id']").val(current1.parent("span").find(".address_id").val());
			
		}
		);
	$(".sav_address").click(
		function(){
			id=$("input[name='address']:checked").val();
			var control_click=$(this);
			control_click.attr("disabled","value");
			var name=$("#address_name").val();
		 	var province=$("#sel_Province").find("option:selected").text();
		 	var sel_City=$("#sel_City").find("option:selected").text();
		 	var sel_County=$("#sel_County").find("option:selected").text();
		 	var detail_address=$("#detail_address").val();
		 	var address_phone=$("#address_phone").val();
		 	var postcode=$("#postcode").val();
		 //	alert(name+province+sel_City+sel_County+detail_address+address_phone+postcode);
			if(name&&province&&sel_City&&sel_County&&detail_address&&address_phone&&postcode
				&&province!="省份"&&sel_City!="地级市"
			){//都非空并且满足格式要求
		  	if(name==NAME&&province==PROVINCE&&sel_City==SEL_CITY&&sel_County==SEL_COUNTY
			   &&detail_address==DETAIL_ADDRESS&&address_phone==ADDRESS_PHONE&&postcode==POSTCODE)
			{
				$(".edit_address").hide();
				control_click.removeAttr("disabled");

			}else{
				if(sel_County=="市、县级市、县") sel_County="";
				$.ajax({
					url:sav_address,
					type:"post",
					data:"name="+name+"&province="+province+"&town="+sel_City+"&district="+sel_County+"&detail_address="+
					detail_address+"&phone_number="+address_phone+"&postcode="+postcode+"&id="+id,
					success:function(data,textStatus){
						if(data.status==1){
							alert("修改成功");
							$(".edit_address").hide();
							$(".next_support").prop("disabled",false);
							control_click.removeAttr("disabled");
							$("input[name='address']:checked").parent("span").find(".address_name").text(name);
							$("input[name='address']:checked").parent("span").find(".address_phone").text(address_phone);
							$("input[name='address']:checked").parent("span").find(".address_province").text(province);
							$("input[name='address']:checked").parent("span").find(".address_town").text(sel_City);
							$("input[name='address']:checked").parent("span").find(".address_district").text(sel_County);
							$("input[name='address']:checked").parent("span").find(".detail_address").text(detail_address);
							$("input[name='address']:checked").parent("span").find(".postcode").text(postcode);
						}else
						if(data.status==0){
							alert("修改失败");
							$(".edit_address").hide();
							control_click.removeAttr("disabled");


						}else
						if(data.status==2){
							$(".next_support").prop("disabled",false);
							// alert("增加成功");
							$(".edit_address").hide();
							control_click.removeAttr("disabled");
							var operate;
							if($(".addresss").length==0)//对象不存在
								operate=$(".total_address");
								else
								operate=$(".addresss").last("span").parent("div");
								operate.append("<span class='addresss' > <input type='radio' name='address' value="+data.id+" checked  /><span>"
					           +"<span class='address_name'>"+name+"</span>"
					           +"<span class='address_phone'>"+address_phone+"</span>"
					           +"<span class='phone_alert'>(手机号码用来接收回报信息，请确认无误!)&nbsp</span>"
					           +"<span class='address_province'>"+province+"&nbsp</span>"
					           +"<span class='address_town'>"+sel_City+"&nbsp</span>"
					           +"<span class='address_district'>"+sel_County+"&nbsp</span>"
					           +"<span class='detail_address'>"+detail_address+"&nbsp</span>"
					           +"<span class='postcode'>"+postcode+"&nbsp</span>"
					           +"<input type='hidden' class='address_id' value="+id+"' />"
					           +"<a href='##' style='margin-left:20px; display:' class='judge_edit'  onclick='show_edit(1)'>编辑</a>"
					           +"<a href='###' style='margin-left:20px; display:' class='judge_edit'  onclick='show_edit(2)'>添加</a>"
					           +"<a href='###' style='margin-left:20px; display:' class='judge_edit'  onclick='dele_address()'>删除</a>"
					            +"</span>"
					          +"</span>");
						var cl='.'+$("input[name='address']:checked").parent("span").find("a").attr("class");
						$("input[name='address']:checked").parent("span").find("a").show();
						$(cl).not($("input[name='address']:checked").parent("span").find("a")).hide();
						$("input[name='address_id']").val("111");
						}else
						if(data.status==3){ 
							alert("增加失败");
							$(".edit_address").hide();
							control_click.removeAttr("disabled");

						}else{
							alert("添加失败，地址数目已经达到上限");
							$(".edit_address").hide();
							control_click.removeAttr("disabled");
						}
					},
				errror:function(){
					alert("请不要频繁提交");
				}
				});
			}
			}else{
				/*
				var   reg;
				reg=/^[a-zA-Z0-9\u4e00-\u9fa5]{1,100}$/ //匹配大小写英文字符及数字 0 到 9 之间的任意 以及中文字符
				if(!reg.test(name)){//格式不正确

				}
				*/
				alert("格式不正确");
				control_click.removeAttr("disabled");

			}
		}
		);
});
function show_edit(judge){
	AreaSelector().init();
	$(".edit_address").show(500);
	if(judge==1){
	$("#address_name").val($("input[name='address']:checked").parent("span").find(".address_name").text());
	 NAME=$("#address_name").val();
	$("#detail_address").val($("input[name='address']:checked").parent("span").find(".detail_address").text());
	 DETAIL_ADDRESS=$("#detail_address").val();
	$("#address_phone").val($("input[name='address']:checked").parent("span").find(".address_phone").text());
	ADDRESS_PHONE=$("#address_phone").val();
	if($("input[name='address']:checked").parent("span").find(".address_province").text())
	 {
	 	$("#sel_Province").find("option:selected").text($("input[name='address']:checked").parent("span").find(".address_province").text());
		PROVINCE=$("#sel_Province").find("option:selected").text();
	}
	if($("input[name='address']:checked").parent("span").find(".address_town").text())
	 {
	 	$("#sel_City").find("option:selected").text($("input[name='address']:checked").parent("span").find(".address_town").text());
		SEL_CITY=$("#sel_City").find("option:selected").text();	
	}
	if($("input[name='address']:checked").parent("span").find(".address_district").text())
	 {
	 	$("#sel_County").find("option:selected").text($("input[name='address']:checked").parent("span").find(".address_district").text());
		SEL_COUNTY=$("#sel_County").find("option:selected").text();
	}
	$("#postcode").val($("input[name='address']:checked").parent("span").find(".postcode").text());
		POSTCODE=$("#postcode").val();
	id=$("input[name='address']:checked").parent("span").find(".address_id").val();
	}else{
		id="undefined";
	}
}

$(function(){
	$(".next_support").click(function(){

		var current=$(this);
		 	if(!$("input[name='address']:checked").val()){
		 		$(".next_support").prop("disabled",true);
		 	alert("请选择您的收货地址");	
		}else{
		$("input[name='address_id']").val($("input[name='address']:checked").val());
		var repay_id=$("input[name='repay_id']").val();



		// alert(repay_id);return ;
		// $.ajax({
		// 	url:judge_number,
		// 	type:'post',
		// 	data:"repay_id="+repay_id,
		// 	success:function(data){
		// 		if(data.status==1){
		// 			current.parent("form").submit();
		// 		}else{
		// 			if(data.status==2){
		// 				alert("你已经有过订单过了哦，请到个人中心，我支持的项目中在规定的时间内继续完成付款");
		// 			}else{
		// 				if(data.status==3){
		// 				alert("此项目所对应的这个回报您已经支持过了哦");
		// 				}else{
		// 					if(data.status==0||data.status==4){
		// 					alert("真是不好意思,您要的回报已经被预定完了,下次请早点来哦");

		// 					}
		// 				}

		// 			}

		// 		}
		// 	}
		// });
		}
	});
});