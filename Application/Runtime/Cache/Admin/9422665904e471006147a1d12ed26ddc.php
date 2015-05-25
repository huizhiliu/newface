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
	<div class="u_m_title">评论管理(<?php echo ($count); ?>)</div>
	<div class="u_m_search">
		<form action="/newface/index.php/Admin/Comment/findComment" method="get">
			<div class="btn-group left-select">
				<select class="btn btn-default dropdown-toggle"
					data-toggle="dropdown" name="what">
					<option value="1">姓名</option>
					<option value="2">内容</option>
				</select>
			</div>
			<div class="row right-submit">
				<div class="col-lg-6">
					<div class="input-group">
						<input type="text" class="form-control" name="word">
						<span class="input-group-btn">
							<input class="btn btn-default" type="submit" value="查找">
						</span>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="u_m_table">
	<table>
		<thead>
			<tr>
				<th>编号</th>
				<th>姓名</th>
				<th>评论的图片id</th>
				<th class="thcon">评论内容</th>
				<th class="thimg">评论时间</th>
				<th class="thopt">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($comlist)): $i = 0; $__LIST__ = $comlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo["com_id"]); ?></td>
				<td><?php echo ($vo["stu_name"]); ?></td>
				<td><?php echo ($vo["com_pid"]); ?></td>
				<td><?php echo ($vo["com_content"]); ?></td>
				<td><?php echo (date("n-j",$vo["com_addtime"])); ?></td>
				<td>
					<a href="/newface/index.php/Admin/Comment/changeDetile?id=<?php echo ($vo["com_id"]); ?>">编辑</a>
					<a href="/newface/index.php/Admin/Comment/deleteComment?id=<?php echo ($vo["com_id"]); ?>">删除</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div><?php echo ($page); ?></div>
</div>


</div>
</body>
</html>