<?php
namespace Mobile\Controller;
use Think\Controller;
class DetailController extends Controller {
    public function detail(){
    	//获取传过来的stu_id-
    	$id = I("get.id");
    	//查出点赞
    	$praise_count = M('student')->where("stu_id = '$id'")->getField("stu_praise_count");
    	//查出图片
    	$img = M('image')->where("img_uid = '$id'")->getField("img_name");;
    	//查出评论
    	$list = M('comment')->join("student on student.stu_id = comment.com_uid")
    						->where("com_pid = '$id'")
    						->select();
    	//查出评论�?
    	$comment_count = M('comment')->where("com_pid = '$id'")->count();
    	//var_dump($list);
    	
    	$this->assign("praise_count",$praise_count);
    	$this->assign("comment_count",$comment_count);
    	$this->assign("img",$img);
    	$this->assign("list",$list);
    	$this->assign("com_pid",$id);
    	
    	$this->display();
    }
    
    /**
     * 发送Ajax请求 将评论储存在数据库中 并返回结果集
     */
    public function sendComment(){
			
			if(isLogin()){

				$data['com_pid'] = I("post.com_pid");
				$data['com_content'] = I("post.com_content");
				$data['com_uid'] = session("uid");
				$data['com_addtime'] = time();
				$id = M("comment")->add($data);
				
				//返回数据
				$result = M("comment")
						  ->join("student on student.stu_id = comment.com_uid")
						  ->where("com_id = '$id'")->select();
				
				//将时间改写为规定模式
				foreach ($result as $k => &$v){
					$v['com_addtime'] = date("n月j日",$v['com_addtime']);
				}
				
				
				echo json_encode($result);
			}else{
				//没有登陆 不能发送信�?
				echo 1;
			}
    }
    
}