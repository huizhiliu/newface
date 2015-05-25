<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	/**
	 * 后台控制器初始化
	 */
	public function _initialize(){
		//判断是否登陆，如果没有登陆跳回登陆页面
		if(isLogin()){
			//登陆则跳转至管理页面
			
		}else{
			//未登录跳回登陆页面
			$this->redirect("Login/index");
		}
		
	}
}
