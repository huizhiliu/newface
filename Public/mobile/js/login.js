$('.login_btn').click(function(e){
    $('.login_bar').show();
    $('.coverflow').show();
    e.stopPropagation();
});

$('.exit').click(function(e){
    $('.login_bar').hide();
    e.stopPropagation();
    $('.coverflow').hide();
});

$('#login').click(function(){
	//学号
    var user = $('.stu_number').val();
	//身份证后六位
    var pwd = $('.stu_id').val();
	
	//Ajax登陆
    $.post(loginUrl, {stu_xuehao : user , stu_idcard : pwd}, function(data){
		if(data == 1){
			//登陆成功
			//跳转页面
			window.location.href = indexUrl;
		}
		else{
			alert("账号或密码错误");
		}
    });
});
//TODO!?


$('.login_bar').on('click',function(e){
  e.stopPropagation();
  
})