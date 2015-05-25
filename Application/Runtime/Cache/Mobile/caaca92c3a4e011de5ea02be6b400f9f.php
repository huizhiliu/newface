<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">
	<title></title>
    <link rel="stylesheet" type="text/css" href="/newface/Public/mobile/css/detilereset.css">
    <link rel="stylesheet" type="text/css" href="/newface/Public/mobile/css/detilemystyle.css">
</head>
<body>
<div class="wrapper">
    <div class="header">

        <h4>笑脸详情</h4>

    </div>


    <div class="popup">
        <div class="popup_face">
            <div class="img_container">
                <img class="detail_img" src="/newface/Public/images/<?php echo ($img); ?>">
            </div>
<!--             <div class="detail_wrapper">
                <img src="/newface/Public/mobile/images/heart.png"> <p class="popup_zan"><?php echo ($praise_count); ?></p>
                <img src="/newface/Public/mobile/images/review.png"> <p class="popup_review"><?php echo ($comment_count); ?></p>
            </div> -->

        </div>

        <div class="popup_list">
       	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="review_list">
	
	                <img src="/newface/Public/mobile/images/user_img.png">
	                <div class="speaker_wrapper">
	                    <p class="speaker"><span class="username"><?php echo ($vo["stu_name"]); ?></span>评论</p>
	                    <span class="speak_time"><?php echo (date("n月j日",$vo["com_addtime"])); ?></span>
	                    <p class="speak_content"><?php echo ($vo["com_content"]); ?></p>
	                </div>
	
	            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

        <div class="popup_box">
            <div class="text_wrapper">
                <textarea class="popup_comment"  placeholder="点此发表评论"></textarea>
                <a href="javascript:void(0)" class="button" onclick="sendComment(<?php echo ($com_pid); ?>)">评论</a>
            </div>
        </div>
        
    </div>
</div>
</body>

<script src="/newface/Public/mobile/js/fastclick.js"></script>
<script src="/newface/Public/mobile/js/zepto.min.js"></script>
<script src="/newface/Public/mobile/js/function.js"></script>
<script src="/newface/Public/mobile/js/detail.js"></script>
<script type="text/javascript">
	var headImg = "/newface/Public/mobile/images/";
	var detailAjax = "/newface/index.php/Mobile/Detail/sendComment";
	var indexUrl = "/newface/index.php/Mobile/index";
</script>
</html>