$(function(){
	
	$(".login").click(function(){
		$(".login_outer").show(500);
		$(".bg").show(500);
	})
	$(".exit").click(function(){
		$(".login_outer").hide(500);
		$(".bg").hide(500);
	})
	$(".help_exit").click(function(){
//		$(".help_exit").fadeIn(500);
		$(".bg").hide(500);
		$(".help").hide(500);
		
	})

	$(".bg").click(function(){
		$(".popup").hide(500);
		$(".login_outer").hide(500);
		$(".bg").hide(500);
		$(".help").hide(500);
		$(".popup_list").empty();
		$(".stu_input").remove();

	})
	// $(".most").click(function(){
	// 	liContainer.attr('data-page', 1);
	// })
	$(".popup_close").click(function(){
		$(".popup").hide(500);
		$(".bg").hide(500);
		$(".popup_list").empty();
		$(".stu_input").remove();
	})
	//登陆框xx
	$(".stu_number+span").css('display','none');
 	$(".stu_id+span").css('display','none');
	    var comment = $(".popup_comment"),
                carry = $(".popup_carry");

        comment.focus(function(){
            carry.css({display:'block'})
        })
})



$(function(){
	$(".fot").mouseover(function(){
		$(".dl_list").css("display","block");
	})
	$(".fot").mouseout(function(){
		$(".dl_list").css("display","none");
	})
	$(".dl_list").mouseenter(function(){
		$(".dl_list").css("display","block");
	})
	$(".dl_list").mouseleave(function(){
		$(".dl_list").css("display","none");
	})
   
  $(".heart").click(support);
	function support(){
		$(".help").show(500);
		$(".bg").show(500);
	}

	
	var stu_id = $(".stu_id");
	var stu_num = $(".stu_number");


    stu_id.bindEv = {
        'focus':function(){
            stu_id.focus(function(){
                $(this).val('');
                $(this).attr({
                    'type':'password'
                });
            })
        }
    }
    
     stu_id.bindEv.focus();

    stu_num.focus(function(){
    	$(this).val('');
    })


    var nextClickHandlerLock = false;
    var liContainer = $(".middle ul");
	function nextClickHandler(e) {
		if(nextClickHandlerLock) return;
		nextClickHandlerLock = true;
		var _id = $(this).attr("data-id") || 0;

       if($('dd').filter(e.currentTarget).length !==0){   //点击变化样式
       	
       	 $('.fot').css("color","#f9fb32");
       	 $('.fot').css ("background","url("+img_url+"kind1.png)");
       	 $('.most').css("color","#9b7601")
       	 $('.most').css("background","url("+img_url+"kind1_before.png) no-repeat");
       }

       if($('.most').filter(e.currentTarget).length !== 0){

       	 $('.most').css("color","#f9fb32");
       	 $('.most').css ("background","url("+img_url+"img/kind1.png)");
       	 $('.fot').css("color","#9b7601")
       	 $('.fot').css("background","url("+img_url+"kind1_before.png) no-repeat");
       }
		var flag = $('dd, .most').filter(e.currentTarget).length !== 0;
		

		$(".dl_list").css("display","none");
		var data = {
				aid: _id,
				page: parseInt(liContainer.attr('data-page')) + 1 || 1
			};
		if(flag){
			 liContainer.attr('data-page', 1);
			 data.page = 1;
		}
		
		$.ajax({
			url: academy_url,
			type: "POST",
			data: data,
			success: function(data) {

				var info = JSON.parse(data);
				if(!flag){
					liContainer.attr('data-page', info.page);
				}
				
				// unlock
				nextClickHandlerLock = false;

			    liContainer.empty();
				for(var i = 0; i < info.data.length; i++) {
					var li = $('<li class="info"><div class="face"><img id="face_img" src="'+img_thumb+info.data[i]['img_name'] + '"></div><button class="face_button">查看详细</button><input type="hidden" id="stu_id" value="' + info.data[i]['stu_id'] + '"><div class="face_pic"><img class="heart" src="'+img_url+'no_click.png"></div><span class="face_zan">' + info.data[i]['stu_praise_count'] + '</span></li>');					
					liContainer.append(li);
				}
				liContainer.append('<li class="face_last"><a href="javascript:void(0)" class="face_next">NEXT</a><h2>换一批</h2></li>');
				$(".face_last").click(nextClickHandler).attr("data-id",_id);
                 $(".face_button").click(more_details);
                  $(".heart").click(support);
			}
		});
	}

	$("dd, .most, .face_last").click(nextClickHandler);

	 		//查看详情
 		function   more_details() {
 			var stu = $(this).next("input").attr("value");
 			
 			$.ajax({
 				url:detail_url,
 				type:"POST",
 				data:
 				{
 					stu_id:stu,
 					
 				},
 				success:function(response) {
 							
 					$(".popup").show(500);
 					$(".bg").show(500);
 						var detail= $.parseJSON(response);
 	 					console.log(detail);
 	 					$(".detail_img").attr("src",img_detail+detail[0].img_name);
 	 					$(".popup_zan").text(detail[0].stu_praise_count);
 	 					var stu_id = document.createElement("input");
 	 					$(stu_id).attr("type","hidden");
 	 					$(stu_id).attr("value",detail[0].stu_id);
 	 					$(stu_id).attr("class","stu_input");
 	 					$(".popup_face").append(stu_id);
 	 					
 	 					if(detail[1].length !== null) {
 	 						for(var i=0 ;i<detail[1].length;i++) {
 	 						  var userDiv = document.createElement("div");
 	 						  $(userDiv).attr("class", "user");
 	 						  var userimg = document.createElement("img");
 	 						  $(userimg).attr("src", img_url+"user_img.png");
 	 						 var username = document.createElement("span");
 	 						 $(username).attr("class","username");
 	 						 if(detail[1][i].stu_name=="") {
 	 							 $(username).text("匿名同学:");
 	 						 }else {
 	 							 $(username).text(detail[1][i].stu_name+"同学:");
 	 						 }
 	 						 
 	 						
 	 						 var uservalue = document.createElement("span");
 	 						 $(uservalue).attr("class","uservalue");
 	 						  $(uservalue).text(detail[1][i].com_content);
 	 						 $(userDiv).append(userimg,username,uservalue);
 	 						 $(".popup_list").append(userDiv);
 	 					    }
 	 					}
 	 					
 					
 				}
 			});
 		}

 		$(".face_button").click(more_details);

	
});







$(function() {


	
	//发表评论
		$(".popup_carry").click(function() {
			if($(".popup_comment").val()=="") {
				alert('亲,评论为空就没意思了哦');
				return false;
			}
			
			$.ajax({
				url:sendCom_url,
				type:"POST",
				data:
				{
					content:$(".popup_comment").val(),
					stu_id:$(".stu_input").attr("value"),
				},
				success:function(response,xhr) {
					if(response==0) {
						alert('请先登录');
						return ;
					}
					alert('评论成功');
					var response = $.parseJSON(response);
			
					var userDiv = document.createElement("div");
						$(userDiv).attr("class", "user");
						var userimg = document.createElement("img");
						$(userimg).attr("src", img_url+"user_img.png");
						var username = document.createElement("span");
						$(username).attr("class","username");
						if(response.stu_name=="") {
							$(username).text("匿名同学:");
						}else{
							$(username).text(response.stu_name+"同学:");
						}
						
						
						var uservalue = document.createElement("span");
						$(uservalue).attr("class","uservalue");
						$(uservalue).text(response.com_content);
						$(userDiv).append(userimg,username,uservalue);
						$(".popup_list").append(userDiv);
						$(".popup_comment").val("");
				},
				error:function() {
					alert('error');
				},
				
			});
		});
		//登陆
 		$("#login").click(function() {
 			$.ajax({
 				url:login_url,
 				type:'POST',
 				data:
 				{
 					stu_num:$(".stu_number").val(),
 					stu_id:$(".stu_id").val(),
 				},
 				success:function(response,status,xhr) {
 					if(response==0) {
 						$(".stu_number+span").css('display','inline');
 						$(".stu_id+span").css('display','none');
 						//return false;
 					}else if(response==1) {
 						$(".stu_number+span").css('display','none');
 						$(".stu_id+span").css('display','inline');
 					}else {
 						//隐藏登陆框后面的x图标
 						$(".stu_number+span").css('display','none');
 						$(".stu_id+span").css('display','none');
 						 	//alert('登陆成功!');
 		                    location.reload && location.reload();
 		                    location.href = location.href;
 					}
 				
 				},
 				error:function() {
 					alert('error');
 				}
 			});
 		});

 	})

