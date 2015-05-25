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


	<div class="info">
		<div class="title">
			产品团队
		</div>
		<div class="infobox">
			<table>
				<tbody>
					<tr><th>管理规划部</th><td>朱鑫 孙周阳</td></tr>
					<tr><th>视觉设计部</th><td>龚琴淋 王依宁</td></tr>
					<tr><th>Web研发部</th><td>刘晨凌 陈沁宇 刘慧芝</td></tr>
					<tr><th>Web研发部</th><td>何少康 陈唯 张兴哲 舒云</td></tr>
					<tr><th>运营维护部</th><td>王博饶 刘爽</td></tr>
					<tr><th>官方网站</th><td><a href="http://hongyan.cqupt.edu.cn/">http://hongyan.cqupt.edu.cn/</a></td></tr>
					<tr><th>BUG反馈</th><td>465049812@qq.com</td></tr>
				</tbody>
			</table>
		</div>
	</div>


</div>
</body>
</html>