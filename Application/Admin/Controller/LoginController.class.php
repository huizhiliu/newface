<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
	public function index(){
		$this->display();
	}
	public function login(){
		/**
		 *验证登陆
		 */
		$admin = M("admin");
		
		$where['adm_name'] = I("post.username");
		$where['adm_pass'] = md5(I("post.password"));
		
		if(!$admin->where($where)->find()){
			//登陆失败 跳回登陆页面
			$this->error("用户名或密码错误","index");	
		}
		else{
			//登陆成功 设置Session 跳到管理页面
			session("user",I('post.username'));
			$this->success("登陆成功",U("Index/index"),2);
		}
	}
	
	public function exitLogin(){
		//注销session
		session(null);
		$this->success('注销成功',U('index'));
	}
	
}