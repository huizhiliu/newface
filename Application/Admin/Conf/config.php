<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_L_DELIM'=>'<{',
	'TMPL_R_DELIM'=>'}>',
	
	//裁剪图片
	'exts' => array('jpg', 'gif', 'png', 'jpeg'), //图片上传类型
	'maxSize'    =>    31457280,	//设置上传大小
	'rootPath'   =>    './Public/images/', //大图保存的根路径
	'imageWidth' => 438,	//大图的宽度
	'imageHeight' => 368,	//大图的高度
	
	'thumbPath' => './Public/thumb/',  //缩略图保存的根路径
	'thumbWidth' => 214,		//设定缩略图尺寸
	'thumbHeight' => 161,
		
	'temporary' => './Public/temporary/', //临时图片保存地址
	'wechat' => './Public/wechat/',  //微信图片保存地址	
);
