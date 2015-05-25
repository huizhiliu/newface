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
<style type="text/css">
	.right-div{
	width:100%;
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


<div class="right-div">


<div class="user_manage">
	
	<div class="u_m_title">手动裁剪式上传图片</div>
	<h4>原图大小裁剪……页面可能会很大……不过照样可以裁剪 请见谅</h4>
	<div class="u_detile_box uploadbox">
		<form action="/newface/index.php/Admin/User/doUploadThumbImg" enctype="multipart/form-data" method="post">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="text" name="id" value="<?php echo ($vo["stu_id"]); ?>" hidden="true">
			<input type="text" name="xuehao" value="<?php echo ($vo["stu_xuehao"]); ?>" hidden="true">
			<div>您所要上传的人是:<?php echo ($vo["stu_name"]); ?></div><br/>
			<div>他的性别是:<?php echo ($vo["stu_gender"]); ?></div><br/>
			<div>他的学号是:<?php echo ($vo["stu_xuehao"]); ?></div><br/>
			<div>他的学院是:<?php echo ($vo["stu_academy"]); ?></div><br/><?php endforeach; endif; else: echo "" ;endif; ?>
			<div>上传图片：<input type="file" name="photo"/></div>
			<div class="button_group">
				<input type="submit" value="确定" class="button_s" name="upload">
				<button class="button_b" onclick="javascript:history.back(-1);return false;">返回</button>
			</div>
		</form>
	</div>
	</div>
	
	<h1>---------------------------------我是分界线---------------------------------</h1>
	
	<div class="user_manage">
	<div class="u_m_title">自动裁剪式上传图片</div>
	<div class="u_detile_box uploadbox">
		<form action="/newface/index.php/Admin/User/doUploadImg" enctype="multipart/form-data" method="post">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="text" name="id" value="<?php echo ($vo["stu_id"]); ?>" hidden="true">
			<input type="text" name="xuehao" value="<?php echo ($vo["stu_xuehao"]); ?>" hidden="true">
			<div>您所要上传的人是:<?php echo ($vo["stu_name"]); ?></div><br/>
			<div>他的性别是:<?php echo ($vo["stu_gender"]); ?></div><br/>
			<div>他的学号是:<?php echo ($vo["stu_xuehao"]); ?></div><br/>
			<div>他的学院是:<?php echo ($vo["stu_academy"]); ?></div><br/><?php endforeach; endif; else: echo "" ;endif; ?>
			<div>上传图片：<input type="file" name="photo"/></div>
			<div class="button_group">
				<input type="submit" value="确定" class="button_s" name="upload">
				<button class="button_b" onclick="javascript:history.back(-1);return false;">返回</button>
			</div>
		</form>
	</div>
	</div>


</div>
</body>
</html>