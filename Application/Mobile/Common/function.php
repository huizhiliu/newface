<?php
/*
 *��̨�������� �ж��Ƿ��¼
 */
 
 
//�ж��Ƿ��½

function isLogin(){
	$user = session('uid');
	if(empty($user)){
		return 0;
	}else{
		return 1;
	}
}