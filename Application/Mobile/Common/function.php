<?php
/*
 *后台公共函数 判断是否登录
 */
 
 
//判断是否登陆

function isLogin(){
	$user = session('uid');
	if(empty($user)){
		return 0;
	}else{
		return 1;
	}
}