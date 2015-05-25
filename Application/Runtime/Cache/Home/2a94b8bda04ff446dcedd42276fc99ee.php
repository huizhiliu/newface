<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
 <html>
 <head>
 	<title>新生笑脸</title>
 	<meta  charset="utf-8">
 	<link rel="stylesheet" type="text/css" href="/newface/Public/home/css/mystyle.css">
 	<link rel="stylesheet" type="text/css" href="/newface/Public/home/css/reset.css">
 	<script type="text/javascript" src="/newface/Public/home/js/jquery-1.9.1.min.js"></script>
 	<script type="text/javascript">
 		//登陆ajax url
		var login_url = "/newface/index.php/Home/Index/check_login";
 		//查看详情ajax URL
		var detail_url = "/newface/index.php/Home/Index/detail";
 		//发表评论ajax url
 		var sendCom_url = "/newface/index.php/Home/Index/sendCom";
 		//换一批ajax url
 		var next_url ="/newface/index.php/Home/Index/popface";
 		//图片地址
 		var img_url = "/newface/Public/home/img/";
		var img_detail = "/newface/Public/images/";
		var img_thumb = "/newface/Public/thumb/";
    //学院分类ajax  url
    var academy_url="/newface/index.php/Home/Index/academy";
 	</script>
 </head>
 <body>
    <div class="container_wrapper">
    	<div class="container">
    		<div class="header">
    			<img src="/newface/Public/home/img/school_logo.png"/>
    			
    			<span class="header_right">
    			<?php if($_SESSION['login'] == 1): echo (session('stu_name')); ?> <a href="/newface/index.php/Home/Index/logout">退出</a>
    				 <?php else: ?> <a class="login" href="#">登录</a><?php endif; ?>
    			</span>
    		</div>
            

            <div class="login_outer">
    		   <div class="login_wrapper">
    		    <form >
    		        <div class="a_wrapper">
                       <a class="exit" href="javascript:void(0)"></a>
                    </div>
                    <div class="input_wrap clear">
                         <input class="stu_number" name="stu_number" type="text" value="学号">
                         <span></span>
                    </div>
                    <div class="input_wrap clear">
                       <input class="stu_id" name="stu_id" type="text" value="身份证后6位">
                       <span></span>
                    </div>
                   
                    <input id="login"  type="button" value="登录">
                </form>	
    		   </div>
    		</div>
			
			<div class="help">
                <div class="help_wrapper">
                    <div class="exit_wrapper">
                        <a class="help_exit" href="javascript:void(0)"></a>
                    </div>
                    <div class="help_code">
                        <img src="/newface/Public/home/img/hele.png">
                    </div>
                    <h1>请关注并使用重邮小帮手</h1>
                    <h1>进行投票</h1>
                </div>
            </div>
			
    		<div class="container_line1">
    			<p>9月10号到12号，新同学们可以在风红莲和风雨操场参加活动，也可以微信发送照片到重邮小帮手参与活动哦~</p>
    			<p>9月14号晚7点新生笑脸见面会，带你游戏带你飞~</p>
    			<p>9月10号到20号，每人每天有30次投票机会，<br/>为你喜欢的笑脸投票，选出重邮最受欢迎的新生笑脸！</p>
    		</div>

    		<div class="container_line2">
    			<a href="/newface/index.php/Home/Index" class="most" data-id="0">人气笑脸</a>
    			<div class="dl_outer">
    			   <div class="dl_wrapper">
    			       <div>
                           <dl>

                               <dt><a href="#" class="fot">学院分类</a></dt>
                               <div class="dl_list">
                                   <dd data-id="1">通信与信息工程学院</dd>
                                   <dd data-id="2">计算机科学与技术学院</dd>
                                   <dd data-id="3">自动化学院</dd>
                                   <dd data-id="4">国际学院</dd>
                                   <dd data-id="5">生物信息学院</dd>
                                   <dd data-id="6">体育学院</dd>
                                   <dd data-id="7">经管学院</dd>
                                   <dd data-id="8">传媒学院</dd>         
                                   <dd data-id="9">光电学院</dd>
                                   <dd data-id="10">国际半导体学院</dd>
                                   <dd data-id="11">外国语学院</dd>
                                   <dd data-id="12">软件学院</dd>
                                   <dd data-id="13">法学院</dd>
                                   <dd data-id="14">理学院</dd>                                                          
                               </div>


                           </dl>
    			       </div>

    			   </div>
    			</div>
    		</div>	


    		<div class="container_line3">
    			    <div class="middle">
                         <ul data-page='1'>
                         	<?php if(is_array($popface)): $i = 0; $__LIST__ = $popface;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="info" >
                                     <div class="face">
                                        <img id="face_img" src="/newface/Public/thumb/<?php echo ($vo["img_name"]); ?>">
                                     </div>
                            		
                                     <button class="face_button">查看详细</button>
                                     <input type="hidden" id="stu_id" value="<?php echo ($vo["stu_id"]); ?>" />
                                     <div class="face_pic"><img class="heart" src="/newface/Public/home/img/no_click.png"></div>
                                    <span class="face_zan"><?php echo ($vo["stu_praise_count"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                             
                            
                            <li class="face_last">
                               <a href="javascript:void(0)" class="face_next">
                               NEXT
                               </a>
                               <h2>
                               换一批
                               </h2>
                            </li>
                   </ul>
            </div>
    		
      
            <div class="popup">
               <div class="popup_close"></div>
               <div class="popup_face">
                  <img class="detail_img"src="/newface/Public/home/img/user_img.png">
                  <!--  
                  <span class="popup_zan">0</span>
                  <div class="popup_pic"><img src="/newface/Public/home/img/no_click.png"></div>-->
                </div>
                <div class="popup_box">
                   <textarea class="popup_comment"  placeholder="点此发表评论"></textarea>
                   <button class="popup_carry">发表</button>
                   
               </div>
               <div class="popup_list">
                  
                 </div>
               </div>
    	    
            <div class="bg">
            	
            </div>


    	<div class="footer">
    	    <a href="/aboutus">关于红岩网校</a>
          <a href="/web">网站地图</a>
          <a href="javascript:void(0)">指出错误</a>
          <a  href="javascript:void(0)">管理入口</a>
            <p>本网站由红岩网校工作站负责开发，管理，不经红岩网校委员会书面同意，不得进行转载</p>
             <p>地址：重庆市南岸区崇文路2号（重庆邮电大学内）400065  E-mail:redrock@cqupt.edu.cn(023-62461084)</p>
        </div>
    </div>
</div>
    <script type="text/javascript" src="/newface/Public/home/js/js.js"></script>
<!--[if IE 6]>
<script src="/newface/Public/home/pngBugJs/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('*');
</script>
<![endif]-->
 </body>
 </html>