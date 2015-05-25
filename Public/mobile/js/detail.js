/**
 * Created by Observernotes on 2014/9/2.
 */
$(".header h3").click(function(ev){
    console.log(1)
    ev.stopPropagation();
    if(location.pathname.match('detail')){
        location.href = document.referrer;
    }else
    history.back();

})

/**
 * 发送评论的Ajax
 */

function sendComment(com_pid){
	//获取评论内容
	var content = $(".popup_comment").val();
	if(content=="") {
		alert('亲，填写评论哦');
		return ;
	}


	if($('.review_list').length == 0){
		$('.popup_list').empty();
	}


	$.post(detailAjax,{com_pid : com_pid,com_content : content},function(data){
		//没有登陆
		if(data == 1){
			alert("请先登录");
		}
		//登陆了
		else{
			var res = eval("("+data+")");
			
			var str = '<div class="review_list">';	
			str+= '<img src="'+headImg+'user_img.png">';
			str+= '<div class="speaker_wrapper">';
			str+= '<p class="speaker"><span class="username">'+res[0].stu_name+'</span>评论</p>';
			str+= '<span class="speak_time">'+res[0].com_addtime+'</span>';
			str+= '<p class="speak_content">'+content+'</p>';
			str+= '</div>';
			str+= '</div>';
			
		  //显示评论内容
			$(".popup_list").append(str);
			
		  //得到评论数
			$praise_count = $(".popup_review").text();
		  //评论数+1
			$praise_count = $praise_count*1 + 1*1;
			
		  //显示评论数
			$(".popup_review").html($praise_count); 
			$(".popup_comment").val("");
			alert("评论成功");
		}
       
    	
	});
	       
}


window.onload = function(){
	if($('.review_list').length == 0){
		$('.popup_list').html('<div class="no-one-comment">这里的海水静悄悄的~</div>');
	}
}