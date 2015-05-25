<?php
namespace Admin\Controller;
use Think\Controller;

class WechatController extends Controller{
	public function downloadImg($filename=""){
		//url为微信端的图片地址
		$url = "https://mp.weixin.qq.com/cgi-bin/getimgdata?token=901138951&msgid=201083557&mode=large&source=&fileld=0&ow=-567040041";
		//$url = I('get.url');
		$content=file_get_contents($url);
		file_put_contents('000.jpg', $content,true);

		/*
		//允许保存的图片类型
		$extsArr = C("exts"); 
		//该图片的类型
		$ext = strtolower(end(explode('.',$url)));
		//判断该类型是否符合要求
		if(!in_array($ext,$extsArr)) 
			$this->error("图片不符合要求");
		else{
			$curl = curl_init($url);
			//保存的文件名,以学号命名
			$filename = C('wechat').'/'.date("Ymdhis").'.'.$ext;
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			$imageData = curl_exec($curl);
			curl_close($curl); 
			
			$tp = @fopen($filename, 'a');
			$result = fwrite($tp, $imageData);
			fclose($tp);
			
			//如果文件保存到本地
			if($result){
				//将数据加入到数据库，在后台中添加入审核队列
				
				//将学号转换为人的id保存
				
				//保存图片的名字
				
				
				
			}
		}
		 */
		
	}
	
	/**
	 * 微信图片审核
	 */
	
	public function index(){
		//从数据库里取出等待队列
		$result = M('wait')->select();
		
		//将uid转化为人名
		foreach ($result as $k => &$v){
			
			$uid = $v['wait_uid'];
			$v['stu_name'] = M("student")->where("stu_id = '$uid'")->getField("stu_name");
			
		}
		
		$count = M('wait')->count();
		
		$this->assign("count",$count);
		$this->assign("userlist",$result);
		$this->assign("wechat","active");
		$this->display();
		
	}
	
	/**
	 * 显示缩略图裁剪页面
	 */
	public function cutThumb(){
		//根据id查询图片名
		$wid = I('get.wid');
		$imgname = M("wait")->where("wait_id = '$wid'")->getField("wait_image_name");
		
		//将图片名存在session中
		session("imgname",$imgname);
		//将wid存在session中
		session("wid",$wid);
		//把uid保存在session里
		session("imguid",I('get.id'));
		
		
		$this->assign("imgname",$imgname);
		$this->display();
	}
	
	/**
	 * 根据所选尺寸裁剪
	 */
	public function doCutThumb(){
		//获取原图路径
		$path = C('wechat').session("imgname"); //原图保存位置
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
		$path = C('wechat').session("imgname"); //原图保存位置
		//生成相应的裁剪
		$image = new \Think\Image();
		$image->open($path);	   //打开图片
		// 按照原图的比例生成一个裁剪图并保存
		$image->crop(I("post.w"), I("post.h"),I("post.x"),I("post.y"))->save(C('rootPath').session("imgname"));
		//释放掉原来的对象
		unset($image);
	
	
		//将裁剪的图像生成缩略图
		$path = C('rootPath').session("imgname");
		$image = new \Think\Image();
		$image->open($path);	   //打开图片
		// 按照原图的比例生成一个裁剪图并保存
		$image->thumb(C('imageWidth'), C('imageHeight'))->save(C('rootPath').session("imgname"));
		//释放掉原来的对象
		unset($image);
	
		//删除微信文件夹中的图片
		$path = C('wechat').session("imgname");
		unlink($path);
	
		//修改数据库信息,如果已经上传过则修改，否则添加
		$img = M('image');
	
		$uid = session("imguid");
		$isAlive = $img->where("img_uid = '$uid'")->find();
		$data['img_name'] = session("imgname");
		$data['img_uid'] = $uid;
		
		//清除wait队列
		$wid = session("wid");
		M('wait')->where("wait_id = '$wid'")->delete();
	
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
	 * 删除队列
	 */
	public function deleteImg(){
		$wid = I("get.wid");
		//获取图片名
		$img_name = M('wait')->where("wait_id = '$wid'")->getField("wait_image_name");
		$result = M('wait')->where("wait_id = '$wid'")->delete();
		
		//删除图片
		$path = C('wechat').$img_name;
		if(unlink($path))
			$this->success("删除成功",U('index'));
		else
			$this->error("删除失败");
		
	}
	
	
}