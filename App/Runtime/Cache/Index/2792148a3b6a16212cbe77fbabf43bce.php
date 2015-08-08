<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><title>发起人信息</title><meta http-equiv="X-UA-Compatible" content="IE=edge"><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="description" content="呆萌网,呆萌首页,大学生众筹,大学生社交，呆萌众筹,众筹公益,呆萌基金,呆萌公益,大学生公益"/><meta name="Keywords" content="呆萌网,呆萌首页,大学生众筹,众筹网，大学生社交/"><script language="javascript" type="text/javascript" src="__PUBLIC__/res/jquery/jquery-1.9.0.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/bootstrap/js/bootstrap.min.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/hf.js"></script><link rel="stylesheet" href="__PUBLIC__/res/bootstrap/css/bootstrap.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/start_item.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/start_item2.css"/><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><link rel="stylesheet" href="__PUBLIC__/Fileupload/css/jquery.fileupload.css"><link rel="Shortcut Icon" href="__PUBLIC__/res/images/sty.ico"></head><body><!--导航条部分--><!-- Fixed navbar --><!--导航条部分--><!-- Fixed navbar --><div id="bar1"><div class="badge">您好，欢迎来到呆萌！</div><?php  if($_SESSION["user_id"]) { echo "<a href=".U('/my','','').">".$_SESSION["niker"]."</a>"; echo "<a href='###'  class='_exit'>退出</a>"; } else { echo "<a href=".U('/login','','')."  target='_blank'>登录</a>"; echo "<a href=".U('/register','','')." target='_blank'>[免费注册]</a>"; } ?><a href="<?php echo U('/help/124','','');?>">帮助中心</a></div><div id="head_"><ul ><li style="margin-left:100px;"><a href="<?php echo U('/index','','');?>"><img class="top_img" src="__PUBLIC__/res/images/top_pic/1.9.png" style="width:160px"></a></li><li><a class="active_" style=" text-decoration: none;" href="<?php echo U('/index');?>" onfocus="this.blur();">首页</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/item','','');?>" target="_blank">浏览项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/start/agreement','','');?>" target="_blank">发起项目</a></li><li><a class="active_" style=" text-decoration: none;"href="<?php echo U('/community','','');?>" target="_blank">呆萌社区</a></li><li><form action="<?php echo U('index/items/index');?>" method="post" ><input class="search_content" type="text" name="search_content" style="width:200px;" placeholder="搜索喜爱的项目" maxlength="15" /><input class="search_sub" type="submit" style="color:#fff;width:70" value="搜索" /></form></li><li    style="margin-left:35px;"><ul id="hid"style="display:inline;"><li class="menus" style="display:block;"><img class="person_img" src="__PUBLIC__/res/images/small_pic/person.png" style="width:46px;"><a  style=" text-decoration: none;color:#33a600;" href="<?php echo U('/person/'.session("user_id"));?>" >个人中心</a></li><li  class="top_dashed" style="padding:0px;margin:0px;"></li><li class="person_blur" style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/support','','');?>">我的众筹</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/news','','');?>">消息中心</a></li><li class="person_blur"  style="display:none;padding:5px 55px 5px 55px;margin:10px 0px"><a style="text-decoration:none;;"href="<?php echo U('/my','','');?>">个人信息</a></li></ul></li></ul></div><script type="text/javascript">    var check_rem="<?php echo U('publicmodel/check_rem','','');?>";

    var exit_url="<?php echo U('/index/publicmodel/exit1','','');?>";

    _home="<?php echo U('/Index','','');?>";

    </script><div class="container"><div class="order-process"><ul style="list-style-type:none"><li class="active">	                发起人信息
	                <span class="order_behind_arrow order_arrow"></span><span class="order_ahead_arrow order_arrow"></span></li><li >	                项目信息
	                <span class="order_behind_arrow order_arrow"></span><span class="order_ahead_arrow order_arrow"></span></li><li>	                回报设置
	                <span class="order_behind_arrow order_arrow"></span><span class="order_ahead_arrow order_arrow"></span></li><li>	                完成项目
	                <span class="order_behind_arrow order_arrow"></span><span class="order_ahead_arrow order_arrow"></span></li></ul></div><div class="title"><div class="col-md-3 title-content">				发起项目
			</div><div class="col-md-9"></div></div><div class="prompt_msg"><div class="frm_desc"><h3>用户信息登记</h3><p>呆萌网致力于打造真实、合法、有效的众筹平台，我们有志与诚信守约、进取担当的第三方合作伙伴携手并进，建立和维护良性互动、健康有序的平台秩序。为了更好的保障你和广大用户的利益,请认真填写以下相关信息。<a href="<?php echo U('/help/125');?>" target="_blank">呆萌网信息登记说明</a>。 </p><ul><li>用户信息登记审核通过后你可以:</li><li>1. 成功发起自己的项目</li><li>2. 提高帐号可信任度</li><li>3. 获得项目的公众账号</li></ul><h4 style="padding-top:20px;"><strong>请确保认真填写以下登记信息</strong></h4></div></div><div class="info-body"><ul id="myTab" class="nav nav-tabs"><li><label for="" class="frm_label" select="option">类型</label></li><li class="active"><a href="#company" data-toggle="tab">企业</a></li><li><a href="#school" data-toggle="tab">院校</a></li><li ><a href="#corporation" data-toggle="tab">社团</a></li><li><a href="#other_orgnization" data-toggle="tab">其他组织</a></li><li><a href="#person" data-toggle="tab">个人</a></li></ul><!-- 这是隐藏的部分 --><div id="myTabContent" class="tab-content"><!-- 申请者为个人			    --><div class="tab-pane fade" id="person"><div  class="row info-body3"><div class="col-md-2"><label for="" select="option">身份证姓名</label></div><div class="col-md-4"><input type="text" class="form-control" id="personname" placeholder="请输入申请者身份证姓名"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">联系邮箱</label></div><div class="col-md-4"><input type="text" class="form-control" id="personmail" placeholder="请输入联系邮箱"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">所在地址</label></div><div class="col-md-4"><input type="text" class="form-control" id="personaddress" placeholder="请输入所在地址"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">身份证号码</label></div><div class="col-md-4"><input type="text" class="form-control" id="personidnum" placeholder="请输入申请者身份证号码"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手持证件照片</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="personapplyID" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="personidprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径'<?php echo U('index/Startitem/imageupload','','');?>';

								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=5&name=1');?>',

								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#personapplyID').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        accept_file_types: '/(\.|\/)(gif|jpe?g|png)$/i',
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#personIDfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								                $("#idpersonExample").css('display',"none");

								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#personapplyID').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#personidprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-2"><div id="personIDfiles" class="personIDfiles"></div><img src="__PUBLIC__/res/images/startitem/ID.PNG" id="idpersonExample"></div><div class="col-md-5" style="margin-left:-20px;padding-top:10px;">							身份证上的所有信息清晰可见，必须能看清证件号。<br/>							 照片需免冠，建议未化妆，手持证件人的五官清晰可见。<br/>							 照片内容真实有效，不得做任何修改。<br />							 支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M
							</div></div><!-- 图片上传之后的预览js --><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手机号码</label></div><div class="col-md-5"><div class="row"><div class="col-md-7"><input type="text" class="form-control" id="personphonenum" placeholder="请输入申请者的手机号码"></div><div class="col-md-5"><button type="button" class="btn btn-default" id="person_btn">获取验证码</button></div></div></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">短信验证码</label></div><div class="col-md-3"><input type="text" class="form-control" id="personcode" placeholder="请输入收到的五位短信验证码"></div></div><div class="row tool_bar"><div class="col-md-3"></div><div class="col-md-7"><a href="<?php echo U('/start/agreement/');?>"><button type="button" class="btn btn-success btn_next" style="font-size:17px">上一步</button></a><a href="#"><button type="button" class="btn btn-success btn_next" style="margin-left:40px;font-size:17px;" id="personsubmit">下一步</button></a></div></div></div><!-- 申请单位为学校 --><div class="tab-pane fade" id="school"><div  class="row info-body3"><div class="col-md-2"><label for="" select="option">院校名称</label></div><div class="col-md-4"><input type="text" class="form-control" id="schoolname" placeholder="请输入院校的名称"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">联系邮箱</label></div><div class="col-md-4"><input type="text" class="form-control" id="schoolmail" placeholder="请输入联系邮箱"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">院校地址</label></div><div class="col-md-4"><input type="text" class="form-control" id="schooladdress" placeholder="请输入院校地址"></div></div><div class="row info-body3" style=""><div class="col-md-2"><label for="" select="option">院校相关证明材料</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="schoollicense" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="schoolprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div><!-- 上传后的文件显示区域 --><div id="schoolfiles" class="schoolfiles"></div></div><div class="col-md-2"></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=2&name=2');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#schoollicense').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#schoolfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#schoollicense').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#schoolprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-5"><p><a href="__PUBLIC__/File/school.doc">学校证明资料模版下载</a></p>								下载模版后填写<span style="color:red;font-size:18px;">拍照上传</span>，在有效期内</br>	 							支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M。
							</div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证姓名</label></div><div class="col-md-4"><input type="text" class="form-control" id="schoolidname" placeholder="请输入运营者身份证姓名"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证号码</label></div><div class="col-md-4"><input type="text" class="form-control" id="schoolidnum" placeholder="请输入运营者身份证号码"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手持证件照片</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="schoolapplyID" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="schoolidprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=2&name=1');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#schoolapplyID').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#schoolIDfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								                $("#idschoolExample").css('display',"none");

								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#schoolapplyID').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#schoolidprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-2"><div id="schoolIDfiles" class="schoolIDfiles"></div><img src="__PUBLIC__/res/images/startitem/ID.PNG" id="idschoolExample"></div><div class="col-md-5" style="margin-left:-20px;padding-top:10px;">							身份证上的所有信息清晰可见，必须能看清证件号。</br>							 照片需免冠，建议未化妆，手持证件人的五官清晰可见。</br>							 照片内容真实有效，不得做任何修改。</br>							 支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M
							</div></div><!-- 图片上传之后的预览js --><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手机号码</label></div><div class="col-md-5"><div class="row"><div class="col-md-7"><input type="text" class="form-control" id="schoolphonenum" placeholder="请输入申请者的手机号码"></div><div class="col-md-5"><button type="button" class="btn btn-default" id="school_btn">获取验证码</button></div></div></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">短信验证码</label></div><div class="col-md-3"><input type="text" class="form-control" id="schoolcode" placeholder="请输入收到的五位短信验证码"></div></div><div class="row tool_bar"><div class="col-md-3"></div><div class="col-md-7"><a href="<?php echo U('/start/agreement','','');?>"><button type="button" class="btn btn-success btn_next" style="font-size:17px">上一步</button></a><a href="#"><button type="button" class="btn btn-success btn_next" style="margin-left:40px;font-size:17px;" id="schoolsubmit">下一步</button></a></div></div></div><!-- 申请单位为社团 --><div class="tab-pane fade" id="corporation"><div  class="row info-body3"><div class="col-md-2"><label for="" select="option">社团名称</label></div><div class="col-md-4"><input type="text" class="form-control" id="teamname" placeholder="请输入社团的名称"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">联系邮箱</label></div><div class="col-md-4"><input type="text" class="form-control" id="teammail" placeholder="请输入联系邮箱"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">所属院校地址</label></div><div class="col-md-4"><input type="text" class="form-control" id="teamaddress" placeholder="请输入所属院校地址"></div></div><div class="row info-body3" style=""><div class="col-md-2"><label for="" select="option">社团相关证明材料</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="teamlicense" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="teamprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div><!-- 上传后的文件显示区域 --><div id="teamfiles" class="files"></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=3&name=2');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#teamlicense').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#teamfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#teamlicense').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#teamprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-5"><p><a href="__PUBLIC__/File/team.doc">社团认证资料模版下载</a></p>								下载后填写<span style="color:red;font-size:18px;">拍照上传</span>，在有效期内</br>	 							支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M。
							</div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证姓名</label></div><div class="col-md-4"><input type="text" class="form-control" id="teamidname" placeholder="请输入运营者身份证姓名"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证号码</label></div><div class="col-md-4"><input type="text" class="form-control" id="teamidnum" placeholder="请输入运营者身份证号码"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手持证件照片</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="teamapplyID" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="teamidprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=3&name=1');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#teamapplyID').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#teamIDfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								                $("#idteamExample").css('display',"none");

								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#orgapplyID').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#teamidprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-2"><div id="teamIDfiles" class="teamIDfiles"></div><img src="__PUBLIC__/res/images/startitem/ID.PNG" id="idteamExample"></div><div class="col-md-5" style="margin-left:-20px;padding-top:10px;">							身份证上的所有信息清晰可见，必须能看清证件号。</br>							 照片需免冠，建议未化妆，手持证件人的五官清晰可见。</br>							 照片内容真实有效，不得做任何修改。</br>							 支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M
							</div></div><!-- 图片上传之后的预览js --><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手机号码</label></div><div class="col-md-5"><div class="row"><div class="col-md-7"><input type="text" class="form-control" id="teamphonenum" placeholder="请输入申请者的手机号码"></div><div class="col-md-5"><button type="button" class="btn btn-default" id="team_btn">获取验证码</button></div></div></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">短信验证码</label></div><div class="col-md-3"><input type="text" class="form-control" id="teamcode" placeholder="请输入收到的五位短信验证码"></div></div><div class="row tool_bar"><div class="col-md-3"></div><div class="col-md-7"><a href="<?php echo U('/start/agreement','','');?>"><button type="button" class="btn btn-success btn_next" style="font-size:17px">上一步</button></a><a href="#"><button type="button" class="btn btn-success btn_next" style="margin-left:40px;font-size:17px;" id="teamsubmit">下一步</button></a></div></div></div><!-- 申请单位为其他组织 --><div class="tab-pane fade" id="other_orgnization"><div  class="row info-body3"><div class="col-md-2"><label for="" select="option">组织名称</label></div><div class="col-md-4"><input type="text" class="form-control" id="orgname" placeholder="请输入组织机构的名称"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">联系邮箱</label></div><div class="col-md-4"><input type="text" class="form-control" id="orgmail" placeholder="请输入联系邮箱"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">组织所在地址</label></div><div class="col-md-4"><input type="text" class="form-control" id="orgaddress" placeholder="请输入组织地址"></div></div><div class="row info-body3" style=""><div class="col-md-2"><label for="" select="option">组织相关证明材料</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="orglicense" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="orgprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div><!-- 上传后的文件显示区域 --><div id="orgfiles" class="files"></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=4&name=2');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#orglicense').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#orgfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#orglicense').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#orgprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-5"><p><a href="__PUBLIC__/File/org.doc">组织认证资料模版下载</a></p>								下载后填写<span style="color:red;font-size:18px;">拍照上传</span>，在有效期内</br>	 							支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M。
							</div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证姓名</label></div><div class="col-md-4"><input type="text" class="form-control" id="orgidnum" placeholder="请输入运营者身份证姓名"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证号码</label></div><div class="col-md-4"><input type="text" class="form-control" id="orgidnum" placeholder="请输入运营者身份证号码"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手持证件照片</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="orgapplyID" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="orgidprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=4&name=1');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#orgapplyID').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#orgIDfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								                $("#idorgExample").css('display',"none");

								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#orgapplyID').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#orgidprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-2"><div id="orgIDfiles" class="orgIDfiles"></div><img src="__PUBLIC__/res/images/startitem/ID.PNG" id="idorgExample"></div><div class="col-md-5" style="margin-left:-20px;padding-top:10px;">							身份证上的所有信息清晰可见，必须能看清证件号。</br>							 照片需免冠，建议未化妆，手持证件人的五官清晰可见。</br>							 照片内容真实有效，不得做任何修改。</br>							 支持.jpg .jpeg .bmp .gif<span style="color:red;font-size:18px;">格式照片</span>，大小不超过2M
							</div></div><!-- 图片上传之后的预览js --><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手机号码</label></div><div class="col-md-5"><div class="row"><div class="col-md-7"><input type="text" class="form-control" id="orgphonenum" placeholder="请输入申请者的手机号码"></div><div class="col-md-5"><button type="button" class="btn btn-default" id="org_btn">获取验证码</button></div></div></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">短信验证码</label></div><div class="col-md-3"><input type="text" class="form-control" id="orgcode" placeholder="请输入收到的五位短信验证码"></div></div><div class="row tool_bar"><div class="col-md-3"></div><div class="col-md-7"><a href="<?php echo U('/start/agreement','','');?>"><button type="button" class="btn btn-success btn_next" style="font-size:17px">上一步</button></a><a href="#"><button type="button" class="btn btn-success btn_next" style="margin-left:40px;font-size:17px;" id="orgsubmit">下一步</button></a></div></div></div><!-- 申请单位为企业 --><div class="tab-pane fade in active info-body3" id="company"><div  class="row info-body3"><div class="col-md-2"><label for="" select="option">企业名称</label></div><div class="col-md-4"><input type="text" class="form-control" id="comname" placeholder="请输入企业的名称"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">企业邮箱</label></div><div class="col-md-4"><input type="text" class="form-control" id="commail" placeholder="请输入企业邮箱"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">企业地址</label></div><div class="col-md-4"><input type="text" class="form-control" id="comaddress" placeholder="请输入企业地址"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">营业执照注册号</label></div><div class="col-md-4"><input type="text" class="form-control" id="licensecode" placeholder="请输入营业执照注册号"></div></div><div class="row info-body3" style=""><div class="col-md-2"><label for="" select="option">营业执照副本扫描件</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="comlicense" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="comprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div><!-- 上传后的文件显示区域 --><div id="comfiles" class="files"></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
								    var url = window.location.hostname === 'blueimp.github.io' ?
								                '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=1&name=2');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#comlicense').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#comfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#comlicense').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#comprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:5px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-5">								请上传营业执照清晰彩色原件扫描件或数码照</br>	 							在有效期内且年检章齐全（当年成立的可无年检章）</br>	 							由中国大陆工商局或市场监督管理局颁发</br>	 							支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M。
							</div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">组织机构代码</label></div><div class="col-md-4"><input type="text" class="form-control" id="orgnizationcode" placeholder="请输入企业组织机构代码"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">运营者身份证姓名</label></div><div class="col-md-4"><input type="text" class="form-control" id="operatorname" placeholder="请输入运营者身份证姓名"></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手持证件照片</label></div><div class="col-md-4"><!-- 图片上传 --><span class="btn btn-success fileinput-button"><!-- <i class="glyphicon glyphicon-plus"></i> --><span>选择文件</span><!-- The file input field used as target for the file upload widget --><input id="comapplyID" type="file" name="files[]" multiple></span><br><br><!-- 进度条展示 --><div id="comidprogress" class="progress"><div class="progress-bar progress-bar-success"></div></div></div><script type="text/javascript">								$(function () {
								    'use strict';
								    // Change this to the location of your server-side upload handler:
									//文件上传路径
									var url = window.location.hostname === 'blueimp.github.io' ?
								        '//jquery-file-upload.appspot.com/' : '<?php echo U('index/Startitem/imageupload','type=1&name=1');?>',
								        uploadButton = $('<button/>')
								            .addClass('btn btn-primary')
								            .prop('disabled', true)
								            .text('正在上传。。。')
								            .on('click', function () {
								                var $this = $(this),
								                    data = $this.data();
								                $this
								                    .off('click')
								                	data.submit().always(function () {
								                    $this.remove();
								                });
								            });

								    $('#comapplyID').fileupload({
								        url: url,
								        dataType: 'json',
								        autoUpload: false,
								        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
								        maxNumberOfFiles : 1,
								        maxFileSize: 2000000, // 5 MB
								        // Enable image resizing, except for Android and Opera,
								        // which actually support image resizing, but fail to
								        // send Blob objects via XHR requests:
								        disableImageResize: /Android(?!.*Chrome)|Opera/
								            .test(window.navigator.userAgent),
								        previewMaxWidth: 100,
								        previewMaxHeight: 100,
								        previewCrop: true
								        // 显示正在上传的文件名
								    }).on('fileuploadadd', function (e, data) {
								        data.context = $('<div/>').appendTo('#comIDfiles');
								        $.each(data.files, function (index, file) {
								            var node = $('<p/>')
								                    .append($('<span/>').text(file.name));
								            if (!index) {
								                node
								                    .append('<br>')
								                    .append(uploadButton.clone(true).data(data));
								            }
								            node.appendTo(data.context);
								        });
								        // 每个图片下面显示预览
								    }).on('fileuploadprocessalways', function (e, data) {
								        var index = data.index,
								            file = data.files[index],
								            node = $(data.context.children()[index]);
								        //文件预览
								        if (file.preview) {
								            node
								                .prepend('<br>')
								                .prepend(file.preview);
								                $("#idcomExample").css('display',"none");

								        }
								        // 显示文件出错
								        if (file.error) {
								            node
								                .append('<br>')
								                .append($('<span class="text-danger"/>').text(file.error));
								        }
								        // 显示upload按钮
								        if (index + 1 === data.files.length) {
								            data.context.find('button')
								                .text('提交')
								                .prop('disabled', !!data.files.error);
								                $('#comapplyID').attr('disabled',true);
								        }
								        // 文件上传进度条
								    }).on('fileuploadprogressall', function (e, data) {
								        var progress = parseInt(data.loaded / data.total * 100, 10);
								        $('#comidprogress .progress-bar').css(
								            'width',
								            progress + '%'
								        );
								        // 文件上传完成，为文件添加a标签
								    }).prop('disabled', !$.support.fileInput)
								        .parent().addClass($.support.fileInput ? undefined : 'disabled');
								});
							</script></div><div class="row" style="margin-top:20px;margin-left:10px;"><div class="col-md-2"></div><div class="col-md-2"><!-- 上传后的文件显示区域 --><div id="comIDfiles" class="comIDfiles"></div><img src="__PUBLIC__/res/images/startitem/ID.PNG" id="idcomExample"></div><div class="col-md-5" style="margin-left:-20px;padding-top:10px;">							身份证上的所有信息清晰可见，必须能看清证件号。</br>							 照片需免冠，建议未化妆，手持证件人的五官清晰可见。</br>							 照片内容真实有效，不得做任何修改。</br>							 支持.jpg .jpeg .bmp .gif格式<span style="color:red;font-size:18px;">照片</span>，大小不超过2M
							</div></div><!-- 图片上传之后的预览js --><div class="row info-body3"><div class="col-md-2"><label for="" select="option">申请者手机号码</label></div><div class="col-md-5"><div class="row"><div class="col-md-7"><input type="text" class="form-control" id="comphonenum" placeholder="请输入申请者的手机号码"></div><div class="col-md-5"><button type="button" class="btn btn-default" id="com_btn">获取验证码</button></div></div></div></div><div class="row info-body3"><div class="col-md-2"><label for="" select="option">短信验证码</label></div><div class="col-md-3"><input type="text" class="form-control" id="comcode" placeholder="请输入收到的五位短信验证码"></div></div><div class="row tool_bar"><div class="col-md-3"></div><div class="col-md-7"><a href="<?php echo U('/start/agreement','','');?>"><button type="button" class="btn btn-success btn_next" style="font-size:17px">上一步</button></a><a href="javascript:void(0)"><button type="button" class="btn btn-success btn_next" style="margin-left:40px;font-size:17px;" id="comsubmit">下一步</button></a></div></div></div></div></div><!-- 底下部分，摘陈刚 --></div><link rel="stylesheet" href="__PUBLIC__/res/css/hf.css"/><div class="footer"><div class="footer1" style="height:200px;width:100%;float:left;padding:0px;margin:0px;background: url('__PUBLIC__/res/images/small_pic/ft_bj.png') no-repeat;"><a class="start_it" href="<?php echo U('/start/agreement','','');?>"><img src="__PUBLIC__/res/images/small_pic/start_it.png" style='margin-top:20px;' ></a></div><div id='backtotop'></div><div class="footer2"><div class="intro" ><span ><a href="<?php echo U('/help','','');?>" target="_blank">关于呆萌</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">洽谈合作</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">加入我们</a></span>|

  	 			<span><a href="<?php echo U('/help/130','','');?>" target="_blank">联系我们</a></span>|

  	 			<span><a href="<?php echo U('/help/127','','');?>" target="_blank">免责声明</a></span>|

  	 			 <p>Copyright © 2014 呆萌网 www.daymeng.com<br><a href="http://www.miitbeian.gov.cn" style="color:#474e5d">湘ICP备09043258号-2</a> 湖南橙讯科技有限公司 版权所有 <span style="font-size:12px;color:#474e5d">投资有风险，购买需谨慎</span></p></div><div class="calls"><ul ><li><img  style='width:120px;' src="__PUBLIC__/res/images/small_pic/tow_code.jpg" class="tow_code"></li><li><img class="mcalls wx"  src="__PUBLIC__/res/images/small_pic/wx.png"><span class='wx' style='color:#fff;padding-left:5px;'>官方微信</span></li><li><a href="http://weibo.com/u/5240303575" target='_blank'><img class="mcalls" src="__PUBLIC__/res/images/small_pic/sina.png"><span style='color:#fff;padding-left:5px;cursor:pointer;'>官方微博</span></a></li><li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=521187146&amp;site=qq&amp;menu=yes"><img src="__PUBLIC__/res/images/small_pic/kefu.png"></a><span style='color:#fff;padding-left:5px;cursor:pointer;'>在线客服</span></li><!-- 百度统计 --><div style='display:none;'><script type="text/javascript">              var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

              document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F86c414347828cadccc690dd5e0ddd83e' type='text/javascript'%3E%3C/script%3E;"));

              </script></div></ul></div></div></div><!--  <div class="row" ><div class="col-lg-4 "></div><div class="col-lg-2"><a href="<?php echo U('startitem/index');?>"><img src="__PUBLIC__/res/images/small_pic/project.png" style="margin-top:50px;"></a></div><div class="col-lg-3  yxs_change"><div class="row"><div class="col-lg-6 "><img class="tubiao"  src="__PUBLIC__/res/images/small_pic/wx.png"><span >关注微信</span><img src="__PUBLIC__/res/images/small_pic/wx1.png"></div><div class="col-lg-6 "><img class="tubiao" src="__PUBLIC__/res/images/small_pic/wb.png"><span >关注微博</span><a target="_blank" href="http://weibo.com/5240303575/profile?rightmod=1&wvr=5&mod=personinfo"><img  src="__PUBLIC__/res/images/small_pic/wb1.png"></a><p class="address">weibo.stm.com</p></div></div></div><div class="col-lg-3  _email yxs_change"><div class="col-lg-6 "><p>联系邮箱</p><a href="http://mail.163.com/"><img src="__PUBLIC__/res/images/small_pic/email.png">daymeng@163.com</a></div></div></div> --><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/md5.js"></script><!-- 图片及文件Ajax上传，预览jQuery插件 --><script src="__PUBLIC__/Fileupload/js/vendor/jquery.ui.widget.js"></script><script src="__PUBLIC__/Fileupload/js/load-image.all.min.js"></script><script src="__PUBLIC__/Fileupload/js/jquery.iframe-transport.js"></script><script src="__PUBLIC__/Fileupload/js/jquery.fileupload.js"></script><script src="__PUBLIC__/Fileupload/js/jquery.fileupload-process.js"></script><script src="__PUBLIC__/Fileupload/js/jquery.fileupload-image.js"></script><script language="javascript" type="text/javascript" src="__PUBLIC__/res/js/startitem2.js"></script><script type="text/javascript">        	var comupload_url='<?php echo U("index/Startitem/comUpload",'','');?>';
        	var schoolupload_url='<?php echo U("index/Startitem/schoolUpload",'','');?>';
        	var teamupload_url='<?php echo U("index/Startitem/teamUpload",'','');?>';
        	var orgupload_url='<?php echo U("index/Startitem/orgUpload",'','');?>';
        	var personupload_url='<?php echo U("index/Startitem/personUpload",'','');?>';
        	var next_url='<?php echo U("/start/item",'','');?>';

        	var phonenum_url='<?php echo U("index/Startitem/phonenum",'','');?>';

            // var exit_url='<?php echo U("index/login/exit1",'','');?>';
            var sort_url='<?php echo U("index/index/sort1",'','');?>';
            var opnion_url='<?php echo U("index/index/opnion",'','');?>';
            var complaint_url='<?php echo U("index/index/complaint",'','');?>';
            var _home='__APP__';
            var PUBLIC='__PUBLIC__';
        </script></body></html>