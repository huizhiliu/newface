<?php
namespace Admin\Controller;
/**
 * 管理用户 及 其照片
 *
 */

class UserController extends AdminController{
	public function index(){
		$user = M('student');
		/*$arr = $user->limit(5)->select();
		$this->assign("userlist",$arr);*/
		
		$count      = $user->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询
		$list = $user->limit($Page->firstRow.','.$Page->listRows)->select();
		
		//对用户组装图片名
		$img = M('image');
		foreach ($list as $k => &$v){
			$uid = $v['stu_id'];
			$imgName = $img->where("img_uid = '$uid'")->getField('img_name');
			$v['stu_img'] = $imgName;
		}
		
		//var_dump($list);
		$this->assign('userlist',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign("user","active");
		$this->assign('count',$count);
		$this->display();
	}
	
	/**
	 * 显示修改数据页
	 */
	public function changeDetile(){
		$id = I('get.id');
		$user = M('student');
		$arr = $user->where("stu_id = '$id'")->select();

		$this->assign('detile',$arr);
		$this->assign("user","active");
		$this->display();
	}
	
	/**
	 * 修改数据
	 */
	public function doChangeDetile(){
		//获取更新数据
		$oldid = I('post.oldid'); //获取要更改的id
		$data['stu_id'] = I('post.id');
		$data['stu_name'] = I('post.username');
		$data['stu_gender'] = I('post.gender');
		$data['stu_idcard'] = I('post.idcard');
		$data['stu_xuehao'] = I('post.xuehao');
		$data['stu_academy'] = I('post.academy');
		//$data['stu_img'] = I('post.img');
		
		$user = M('student');
		$result = $user->where("stu_id = '$oldid'")->save($data);
		
		if($result){
			//更新成功
			$this->success('修改成功',U('index'));
		}else{
			//更新失败
			$this->error('修改失败');
		}

	}
	
	/**
	 * 删除数据
	 */
	public function deleteUser(){
		$id = I('get.id');
		$user = M('student');
		$result = $user->where("stu_id = '$id'")->delete();
		
		if($result){
			//删除成功
			$this->success('删除成功');
		}else{
			//删除失败
			$this->error('删除失败');
		}
	}
	
	/**
	 * 上传照片
	 */
	public function uploadImg(){
		$id = I('get.id');
		$user = M('student');
		
		$arr = $user->where("stu_id = '$id'")->select();
		
		$this->assign('list',$arr);
		$this->assign("user","active");
		
		$this->display();
	}
	
	/**
	 * 临时上传照片生成缩略图
	 */
	public function doUploadThumbImg(){
		$fileName = I('post.xuehao');
		$config = array(
				'maxSize'    =>    C('maxSize'),	//设置上传大小
				'rootPath'   =>    C('temporary'), //文件上传保存的根路径
				'exts'       =>    C('exts'), //设置附件上传类型
				'autoSub'    =>    false, //不自动生成子目录保存
				'hash'       =>    false, //不自动hash编码
				'replace'    =>    true,  //存在同名文件自动覆盖
				'saveName'   =>    $fileName,
		);
		$upload = new \Think\Upload($config);// 实例化上传类
		$info   =  $upload->uploadOne($_FILES['photo']); //上传成功
		if($info){
			//把图片名保存在Session里
			session("imgname",$info['savename']);
			//把uid保存在session里
			session("imguid",I('post.id'));
			
			$this->success("上传成功",U('cutThumb'),1);
		}else{
			$this->error($upload->getError());
		}
	}
	
	/**
	 * 显示缩略图裁剪页面
	 */
	public function cutThumb(){
		$this->assign("imgname",session("imgname"));
		$this->display();
	}
	
	/**
	 * 根据所选尺寸裁剪
	 */
	public function doCutThumb(){
		//获取原图路径
		$path = C('temporary').session("imgname"); //原图保存位置
		//echo $path;
		//生成相应的裁剪
		$image = new \Think\Image();
		$image->open($path);	   //打开图片
		// 按照原图的比例生成一个裁剪图并保存
		$image->crop(I("post.w"), I("post.h"),I("post.x"),I("post.y"))->save(C('thumbPath').session("imgname"));
		//释放掉原来的对象
		unset($image);
		
		
		//将裁剪的图像生成缩略图
		$path = C('thumbPath').session("imgname");
		$image = new \Think\Image();
		$image->open($path);	   //打开图片
		// 按照原图的比例生成一个裁剪图并保存
		$image->thumb(C('thumbWidth'), C('thumbHeight'))->save(C('thumbPath').session("imgname"));
		//释放掉原来的对象
		unset($image);
		
		
		//缩略图生成完毕 跳转页面生成大图
		$this->success("缩略图生成完毕",U('cutBig'),1);
		
	}
	
	/**
	 * 根据所选尺寸裁剪大图
	 */
	public function cutBig(){
		$this->assign("imgname",session("imgname"));
		$this->display();
		
	}
	
	/**
	 * 裁剪大图
	 */
	public function doCutBig(){
		//获取原图路径
		$path = C('temporary').session("imgname"); //原图保存位置
		//生成相应的裁剪
		$image = new \Think\Image();
		$image->open($path);	   //打开图片
		// 按照原图的比例生成一个裁剪图并保存
		$image->crop(I("post.w"), I("post.h"),I("post.x"),I("post.y"))->save(C('rootPath').session("imgname"));
		//释放掉原来的对象
		unset($image);
		
		//如果图片太小了
		if(I("post.w") < C('imageWidth') && I("post.h") < C('imageHeight')){
			//放大
			$path = C('rootPath').session("imgname");
			$image = new \Think\Image();
			$image->open($path);	   //打开图片
			// 按照原图的比例放大并保存
			$image->thumb(C('imageWidth'), C('imageHeight'),\Think\Image::IMAGE_THUMB_FIXED)->save(C('rootPath').session("imgname"));
			//释放掉原来的对象
			unset($image);
		}
		else{
			//将裁剪的图像生成大图
			$path = C('rootPath').session("imgname");
			$image = new \Think\Image();
			$image->open($path);	   //打开图片
			// 按照原图的比例生成一个裁剪图并保存
			$image->thumb(C('imageWidth'), C('imageHeight'))->save(C('rootPath').session("imgname"));
			//释放掉原来的对象
			unset($image);
		}
		//删除临时文件夹中的图片
		$path = C('temporary').session("imgname");
		unlink($path);
		
		//修改数据库信息,如果已经上传过则修改，否则添加
		$img = M('image');
		
		$uid = session("imguid");
		$isAlive = $img->where("img_uid = '$uid'")->find();
		$data['img_name'] = session("imgname");
		$data['img_uid'] = $uid;
		
		//释放session
		session("imgname",null);
		
		if($isAlive){
			//如果存在数据，则修改
			$is = $img->where("img_uid = '$uid'")->save($data);
			$this->success('上传成功！',U('index'),3);
		}else{
			//否则添加数据
			$is = $img->add($data);
			if($is)
				$this->success("添加成功",U('index'));
			else
				$this->error("添加失败");
		}
		
		
	}
	
	/**
	 * 将照片保存在本地
	 */
	public function doUploadImg(){
		$fileName = I('post.xuehao'); 
		$config = array(
				'maxSize'    =>    C('maxSize'),	//设置上传大小
				'rootPath'   =>    C('rootPath'), //文件上传保存的根路径
				'exts'       =>    C('exts'), //设置附件上传类型
				'autoSub'    =>    false, //不自动生成子目录保存
				'hash'       =>    false, //不自动hash编码
				'replace'    =>    true,  //存在同名文件自动覆盖
				'saveName'   =>    $fileName
		);
		$upload = new \Think\Upload($config);// 实例化上传类
		$info   =  $upload->uploadOne($_FILES['photo']);
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			try {
				//var_dump($info);
				//echo $info['savepath'].$info['savename'];
				
				//生成相应的缩略图
				$image = new \Think\Image();
				$path = C('rootPath').$info['savename']; //原图保存位置
				$image->open($path);	   //打开图片
				// 按照原图的比例生成一个缩略图并保存
				$image->thumb(C('thumbWidth'), C('thumbHeight'))->save(C('thumbPath').$info['savename']);
				//释放掉原来的对象 新建一个对象
				unset($image);
				
				//将原图的大小进行裁剪覆盖原来的原图
				//生成相应的缩略图
				$image = new \Think\Image();
				$path = C('rootPath').$info['savename']; //原图保存位置
				$image->open($path);	   //打开图片
				$image->thumb(C('imageWidth'),C('imageHeight'))->save(C('rootPath').$info['savename']);
				
				//修改数据库信息,如果已经上传过则修改，否则添加
				$img = M('image');

				$uid = I('post.id');
				$isAlive = $img->where("img_uid = '$uid'")->find();
				$data['img_name'] = $info['savename'];
				$data['img_uid'] = $uid;
				if($isAlive){
					//如果存在数据，则修改
					$is = $img->where("img_uid = '$uid'")->save($data);
					$this->success('上传成功！',U('index'),3);
				}else{
					//否则添加数据
					$is = $img->add($data);
					if($is)
						$this->success("添加成功",U('index'));
					else
						$this->error("添加失败");
				}
			}
			catch (Exception $e){
				$this->error("保存发生错误");
			}
		}
		
		
	}
	
	
	/**
	 * 查找信息
	 */
	public function findPeople(){
		$user = M('student');
		$word = I('get.word');
		if(I('get.what') == 1){
			//按学号查找
			$count = $user->where("stu_xuehao LIKE '%$word%'")->count();
			$Page       = new \Think\Page($count,10); // 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();			  // 分页显示输出
			$arr = $user->where("stu_xuehao LIKE '%$word%'")->limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			//按姓名查找
			$count = $user->where("stu_name LIKE '%$word%'")->count();
			$Page       = new \Think\Page($count,10); // 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();			  // 分页显示输出
			$arr = $user->where("stu_name LIKE '%$word%'")->limit($Page->firstRow.','.$Page->listRows)->select();
		}

		
		
		//对用户组装图片名
		$img = M('image');
		foreach ($arr as $k => &$v){
			$uid = $v['stu_id'];
			$imgName = $img->where("img_uid = '$uid'")->getField('img_name');
			$v['stu_img'] = $imgName;
		}
		
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('count',$count);
		$this->assign('userlist',$arr);
		$this->assign("user","active");
		$this->display('index');
		
	}
	/**
	 * 删除照片
	 */
	public function deleteImg(){
		//获取照片名
		$id = I('get.id');
		$imgName = M('image')->where("img_uid = '$id'")->getField('img_name');
		if($imgName){
			//组装照片路径
			//原图路径
			$path_1 = C('rootPath').$imgName;
			//缩略图路径
			$path_2 = C('thumbPath').$imgName;
			if(unlink($path_1) && unlink($path_2)){
				//更改数据库
				M('image')->where("img_uid = '$id'")->delete();
				
				//把点赞数清空
				$data['stu_praise_count'] = 0;
				M('student')->where("stu_id = '$id'")->save($data);
				//把点赞的关系清空
				M('praise')->where("praise_bstu_id = '$id'")->delete();
				$this->success("删除成功",U('index'));
			}
			else{
				$this->error("路径有误，删除失败");
			}
		}else{
			$this->error("没有可以删除的照片");
		}
		
	}
	
	/**
	  * 显示添加用户界面
	  */
	public function addUser(){
		$this->display();
	}
	/**
	  * 添加用户
	  */
	public function doAddUser(){
		$data['stu_name'] = I("post.username");
		$data['stu_gender'] = I("post.gender");
		$data['stu_idcard'] = I("post.idcard");
		$data['stu_xuehao'] = I("post.xuehao");
		$data['stu_academy'] = I("post.academy");
		
		
		$result = M('student')->add($data);
		
		if($result){
			//更新成功
			$this->success('添加成功',U('index'));
		}else{
			//更新失败
			$this->error('添加失败');
		}
		
	}
	
	
}