<?php
namespace Admin\Controller;

/**
 * 管理评论的控制器
 */
class CommentController extends AdminController{
	public function index(){
		$com = M('comment');
		$count      = $com->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询
		$list = $com->limit($Page->firstRow.','.$Page->listRows)->select();
		
		//将评论人姓名组合进数组
		$user = M('student');
		foreach ($list as $k => &$v){
			$id = $v['com_uid'];
			$name = $user->where("stu_id = '$id'")->getField('stu_name');
			$v['stu_name'] = $name;
		}
		
		$this->assign("comment","active");
		$this->assign('comlist',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('count',$count);
		$this->display();
	}
	
	/**
	 * 显示评论修改详情
	 */
	public function changeDetile(){
		$com = M('comment');
		
		$id = I('get.id');
		$list = $com->where("com_id = '$id'")->select();
		
		//将评论人姓名组合进数组
		$user = M('student');
		foreach ($list as $k => &$v){
			$id = $v['com_uid'];
			$name = $user->where("stu_id = '$id'")->getField('stu_name');
			$v['stu_name'] = $name;
		}
		
		$this->assign('detile',$list);// 赋值数据集
		$this->assign("comment","active");
		$this->display();
	}
	
	/**
	 * 进行修改操作
	 */
	public function doChangeDetile(){
		$com = M('comment');
		$oldid = I('post.oldid');
		
		$data['com_id'] = I('post.id');
		$data['com_uid'] = I('post.uid');
		$data['com_pid'] = I('post.pid');
		$data['com_content'] = I('post.content');
		$data['com_addtime'] = I('post.addtime');
		
		$result = $com->where("com_id = '$oldid'")->save($data);
		
		if($result){
			$this->success('修改成功',U('index'));
		}else{
			$this->error('修改失败');
		}
		
	}
	
	/**
	 * 删除评论
	 */
	public function deleteComment(){
		$id = I('get.id');
		$com = M('comment');
		$result = $com->where("com_id = '$id'")->delete();
		
		if($result){
			$this->success("删除成功",U('index'));
		}else{
			$this->error("删除失败");
		}
	}
	
	/**
	 * 查找评论
	 */
	public function findComment(){
		$what = I('get.what');
		$com = M('comment');
		$word = I('get.word');
		if($what == 1){
			//按姓名查找
			//把名字转化为uid号
			$uid = M('student')->where("stu_name = '$word'")->getField('stu_id');
			
			$count      = $com->where("com_uid = '$uid'")->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询
			$list = $com->where("com_uid = '$uid'")->limit($Page->firstRow.','.$Page->listRows)->select();
			

		}else{
			//按内容查找
			$count = $com->where("com_content LIKE '%$word%'")->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			$list = $com->where("com_content LIKE '%$word%'")->limit($Page->firstRow.','.$Page->listRows)->select();
		}
		
		//将评论人姓名组合进数组
		$user = M('student');
		foreach ($list as $k => &$v){
			$id = $v['com_uid'];
			$name = $user->where("stu_id = '$id'")->getField('stu_name');
			$v['stu_name'] = $name;
		}
		

		$this->assign('comlist',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('count',$count);
		$this->assign("comment","active");
		$this->display('index');
		
	}
	
}