<?php
/**
 * 后台公共函数库
 */

function isLogin(){
	$user = session('user');
	if(empty($user)){
		return 0;
	}else{
		return 1;
	}
}