<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
	//自动验证
	protected $_validate = array(
			array("username","require","用户名不能为空"),
			array("password","require","密码不能为空"),
			array("username","checkUsername","用户名错误","1","callback"),
			array("password","checkPassword","密码错误","1","callback")
	);
	public function checkUsername(){
		$username = I("post.username");
		if(M('Admin')->where("username = '$username'")->find())
			return true;
		else
			return false;
	}
	
	public function checkPassword(){
		$post = I("post.password");
		$password = md5($post);
		$where['pass'] = "admin";
		if(M('admin')->where($where)->find())
			return true;
		else
			return false;
	}
}