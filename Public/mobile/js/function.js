/**
 * Created by Observernotes on 2014/9/2.
 */
$(function(){
	var __aid__ = 0;
    $(function() {
        FastClick.attach(document.body);
    });
    function scroll(scrollTo, time) {
        var scrollFrom = parseInt(document.body.scrollTop),
            i = 0,
            runEvery = 5; // run every 5ms

        scrollTo = parseInt(scrollTo);
        time /= runEvery;

        var interval = setInterval(function () {
            i++;

            document.body.scrollTop = (scrollTo - scrollFrom) / time * i + scrollFrom;

            if (i >= time) {
                clearInterval(interval);
            }
        }, runEvery);
    }

    var flag = true;

    $(".wrapper").click(function(ev){
        ev.stopPropagation()
        if(!flag){
            $(".return").animate({opacity:0},600,'linear',function(){
                flag = true;
                $(".return").css({display:"none"});
            });
        }else{
            $(".return").css({display:"block"}).animate({opacity:1},600);
            flag = false;
        }
    });

    $(".classify_click2").click(function(ev){
        ev.stopPropagation();
        $('.coverflow').show();
        $(".classify_select").css({display:"block"}).animate({opacity:1},600);
    });
    $(".classify_select li").click(function(ev){
        ev.stopPropagation()
        $(".classify_select").animate({opacity:0},200,'linear',function(ev){
            $(".classify_select").css({display:"none"});
            $('.classify_click2').css({color:"#f9fb32",background:"url('"+zanUrl+"click2_after.png') no-repeat"})
            $('.classify_click1').css({color:"#9b7601",background:"url('"+zanUrl+"click1.png') no-repeat"})
        });
    });

    $(document).ready(function(){
        var range = 0;             //距下边界长度/单位px
        var totalheight = 0;
        var main = $(".face ul");                     //主体元素
        $(window).scroll(function(e){
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)

            totalheight = parseFloat($(window).height()) + parseFloat(srollPos);

            if(($(document).height()-range) <= totalheight ) {
            	
            	nextClickHandler(e, 'scroll');
            	

             
            	
            }
        });
    });
    
    


   
   $(".face").delegate(".face_info","click",function(ev){
	   ev.stopPropagation();
    	var stu_id = $(this).next("input").attr("value");   
    	//alert(stu_id);
    	//查看详情
    	window.location.href = detailUrl+'detail?id='+stu_id;
   });

   $(".face").delegate(".face_a","click",function(ev){
       ev.stopPropagation();
        var stu_id = $(this).parent().next().next("input").attr("value");   
        //alert(stu_id);
        //查看详情
        window.location.href = detailUrl+'detail?id='+stu_id;
   });
    

    
    
    
    $(".face").delegate(".face_heart img","click",function(ev){
    	ev.stopPropagation();
        var self = this;
        var zan = $(this).attr("src");
        if(zan == zanUrl + "Heart.png"){
        	//no ctrl+z
        }else{

            //点赞ajax
            //获取被点赞人id
          // console.log($(this).parent().siblings("input").attr("value"));
           var stu_id = $(this).parent().siblings("input").attr("value"); 
           var self= $(this);
            $.post(doZanUrl,{praise_bstu_id : stu_id},function(data){
            	//将被赞数+1
//            	alert(stu_id);
				if(data == 4){
					//一天点赞超过30个
					alert("您今天点赞超过了30个，请爱惜身体");
				}
				else if(data == 3){
					alert("请先登录");
				}else{
					$praise_count = ($(".zan_"+stu_id+" span").text())*1 + 1*1;
					$(".zan_"+stu_id+" span").text($praise_count);
					//修改点赞的图标
					
					//console.log($(this));
					self.attr("src" , zanUrl + "Heart.png");
				}
            });
            
        }
    });
    
    $(".return_top").click(function (ev){
        ev.stopPropagation()
        scroll('0', 200);
    });

    $('.classify_click1').click(function(ev){
        ev.stopPropagation()
        var button = $(".classify_click1").css("color");

        if(button == "rgb(249, 251, 50)"){
        }else{
            $('.classify_click2').css({color:"#b97601",background:"url('"+zanUrl+"click2.png') no-repeat"})
            $('.classify_click1').css({color:"#f9fb32",background:"url('"+zanUrl+"click1_after.png') no-repeat"})
        }
    })

    
    
    
    var nextClickHandlerLock = false;
    var liContainer = $(".face ul");
	function nextClickHandler(e, type) {
		if(nextClickHandlerLock) return;
		nextClickHandlerLock = true;
		
		if($(this).attr("data-id")){
			var _id = $(this).attr("data-id") || 0; 
		}else{
			var _id = __aid__;
		}
		
		if(type == 'scroll'){ var flag = false}else{
			
			var flag = true;
			
			
			
		}

		
		var data = {
				aid: _id,
				page: parseInt(liContainer.attr('data-page')) + 1 || 1
			};
		if(flag){
			 liContainer.attr('data-page', 1);
			 data.page = 1;
			 __aid__ = _id;
			// alert(_id);
			 liContainer.empty();
		}
		
		$.ajax({
			url:moreUrl ,
			type: "POST",
			data: data,
            beforeSend: function(){
                $('.coverflow').hide();
                zerolingloadingstart();
            },
			success: function(data) {
				
				var info = JSON.parse(data);
				//alert(info.data[0].isPraise);

				if(!flag){
					liContainer.attr('data-page', info.page);
				}
				// unlock
				nextClickHandlerLock = false;

			    if(!info.data){
                    return zerolingnodata();
                }

                zerolingloadingend();

				for(var i = 0; i < info.data.length; i++) {
					var li = '<li><div class="face_wrapper"><div class="face_pic"><a href="##" class="face_a"><img src="'+publicUrl+'thumb/'+info.data[i].img_name+'"></a>';
					    li+= '</div><button class="face_info">查看详细</button><input type="hidden" value="'+info.data[i].stu_id+'"/>';
					    li+= '<div class="face_heart zan_'+info.data[i].stu_id+'">';
					    if(info.data[i].isPraise == 0)
					    	li+= '<img src="'+publicUrl+'mobile/images/non_Heart.png">';
					    else
					    	li+= '<img src="'+publicUrl+'mobile/images/Heart.png">';
					    li+= '<span>'+info.data[i].stu_praise_count+'</span></div></div></li>';
					liContainer.append(li);
				}
				$(".face ul").attr('data-page',info.page);
			}
		});
	}

	$(".classify_select li,.classify_click1").click(nextClickHandler);
   
	//TODO:BUG
    $(".return h3").click(function(ev){
        ev.stopPropagation();
        history.back();
    });
    var face = ['(´・ω・`)', '(●′ω`●)', '(´,,•ω•,,‘)', '(´；ω；‘)', '(´・н・‘)', '(›´ω`‹ )', '(●´ϖ`●)'], faceNum = 0;
    var zerolingtimer;
    $('.load').hide();
    function zerolingloadingstart(){
        $('.load').show();
        zerolingtimer = setInterval(function(){
            $('.load span').text(face[faceNum % face.length]);
            faceNum++;
        }, 300);
    }

    function zerolingloadingend(){
        $('.load').hide();
        clearInterval(zerolingtimer);
    }

    function zerolingnodata(){
        $('.load').show();
        $('.load h6').text('到底了呢> <.');
    }

    $('.coverflow').click(function(e){
        $('.exit').click();
        $('.classify_select').css({display: 'none', opacity: 0});
        $('.coverflow').hide();
        $('.login_bar').hide();
        e.stopPropagation();
    });



})