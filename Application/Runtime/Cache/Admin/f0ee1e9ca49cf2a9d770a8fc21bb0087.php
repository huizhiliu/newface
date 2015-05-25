<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/newface/Public/admin/style/bootstrap.css" />
<script type="text/javascript" src="/newface/Public/admin/js/jquery1.9.1.min.js"></script>
<script type="text/javascript" src="/newface/Public/admin/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/newface/Public/admin/style/admin.css" />
<link rel="stylesheet" type="text/css" href="/newface/Public/admin/style/jquery.Jcrop.css" />
<script type="text/javascript" src="/newface/Public/admin/js/jquery.Jcrop.js"></script>
<script type="text/javascript" src="/newface/Public/admin/js/admin.js"></script>
<link rel="stylesheet" href="/newface/Public/admin/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/newface/Public/admin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/newface/Public/admin/kindeditor/lang/zh_CN.js"></script>
<style type="text/css">

/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 150px;
  right: 680px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 250px;
  height: 170px;
  overflow: hidden;
}

</style>
</head>

<body>
<div class="top-div">
	<span class="top-div-title">
		RedRock
	</span>
	<div class="top-div-select">
		<ul class="nav nav-pills top-font" role="tablist">
			
			 <!-- class="active" -->
			<li role="presentation" id="homeli" class="<?php echo ($home); ?>">
				<a href="/newface/index.php/Admin/Index/index" onclick="selectHome()">主页</a>
			</li>
			
			
			<li role="presentation" id="userli" class="<?php echo ($user); ?>">
				<a href="/newface/index.php/Admin/User/index" onclick="selectUser()">用户管理</a>
			</li>
			
			
			<li role="presentation" id="comli" class="<?php echo ($comment); ?>">
				<a href="/newface/index.php/Admin/Comment/index" onclick="selectCom()">评论管理</a>
			</li>
			
			
			<li role="presentation"  class="<?php echo ($wechat); ?>">
				<a href="/newface/index.php/Admin/Wechat/index">微信图片</a>
			</li>
			
		</ul>
	</div>
	<div class="exit">
		<a href="/newface/index.php/Admin/Login/exitLogin">退出</a>
	</div>
</div>

<!--
<div class="left-div">


	<div class="left-title">
		<h1>新生笑脸后台管理 </h1>
	</div>
	<h3 class="smile">╰(￣▽￣)╯</h3>


</div>
-->

<div class="right-div">


<div class="user_manage">
	<div class="u_m_title">评论编辑</div>
	<div class="u_detile_box">
		<form action="/newface/index.php/Admin/Comment/doChangeDetile" method="post">
			<?php if(is_array($detile)): $i = 0; $__LIST__ = $detile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
				<label>id</label>
				<div><input type="text" name="id" value="<?php echo ($vo["com_id"]); ?>" class="a_input"></div>
			</div>
			<input type="text" name="oldid" value="<?php echo ($vo["com_id"]); ?>" hidden="true">
			<div>
				<label>评论人id</label>
				<div><input type="text" name="uid" value="<?php echo ($vo["com_uid"]); ?>" class="a_input">
				(<?php echo ($vo["stu_name"]); ?>)</div>
			</div>
			<div>
				<label>评论的图片id</label>
				<div><input type="text" name="pid" value="<?php echo ($vo["com_pid"]); ?>" class="a_input"></div>
			</div>
			<div>
				<label>评论内容</label>
				<div><textarea name="content" style="height:200px;"><?php echo ($vo["com_content"]); ?></textarea></div>
			</div>
			<div>
				<label>评论时间</label>
				<div><input type="text" name="addtime" value="<?php echo ($vo["com_addtime"]); ?>" class="a_input"></div>
			</div>
			<div class="button_group">
				<input type="submit" value="确定" class="button_s">
				<button class="button_b"
					onclick="javascript:history.back(-1);return false;">返回</button>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</form>
	</div>
	<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
		</script>


</div>
</body>
</html>