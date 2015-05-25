<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
    public function index(){    	
    	$field = 'stu_id,stu_praise_count,img_name';
    	$m = M('Student');
    	$res = $m
    	->join("JOIN image ON student.stu_id=image.img_uid")
    	->limit(0,11)->select();
    	$this->assign('popface',$res);
    	//echo ceil(7/11);
    	$this->display();
    	
    	
    }

    /**
     * [academy for ajax]
     * @author zeroling
     * modify by heshaokang 
     */
    public function academy(){
        $academyId = (int)I('post.aid');
        $academyPage = (int)I('post.page');
        $academyPage = $academyPage > 0 ? $academyPage : 1;
//         if($academyId<1 || $academyId>14) {
//         	$academyId = 1;
//         }
        
        $academyId = $academyId >= 1 && $academyId <=14 ? $academyId : 0;
        $academyHash = array(
            '1' => '通信与信息工程学院',
            '2' => '计算机科学与技术学院',
            '3' => '自动化学院',
            '4' => '国际学院',
            '5' => '生物信息学院',
            '6' => '体育学院',
            '7' => '经管学院',
            '8' => '传媒学院',
            '9' => '光电学院',
            '10' => '国际半导体学院',
            '11' => '外国语学院',
            '12' => '软件学院',
            '13' => '法学院',
            '14' => '理学院'
        );
        $m = M('Student');
        $field = 'stu_id,stu_praise_count,img_name';
		$_aca = $academyHash[$academyId];
		$first = ($academyPage - 1) * 11;
        if($academyId == 0){
        	$count =  $m->field($field)->
	        	join("JOIN image ON student.stu_id=image.img_uid")->
	        	//order('stu_praise_count desc')->
	        	count();
        	$_count = ceil($count/11)+1;
        	if($academyPage==$_count) {
        		$academyPage=1;
        		$first=0;
        	}
          $data = $m->field($field)->
            join("JOIN image ON student.stu_id=image.img_uid")->
          	order('stu_praise_count desc')->limit($first.','. '11')->select();	
          
        }
        else{
        	
        	$count = $m->field($field)->
        	join("JOIN image ON student.stu_id=image.img_uid")->
        	where("stu_academy='$_aca'")->
        	count();
        	//无线循环 当没有数据时 初始化为第一页数据
        	$_count = ceil($count/11)+1;
        	if($academyPage==$_count) {
        		$academyPage=1;
        		$first=0;
        	}
        	
        	$data = $m->field($field)->
			    	join("JOIN image ON student.stu_id=image.img_uid")->
			    	where("stu_academy='$_aca'")->
			    	limit($first.','. '11')->
			    	select();
        }
        	$result = array(
        			"status" => 200,
        			"page" => $academyPage,
        			"data" => $data
        	);
      
        echo json_encode($result);
    }

    /**
     * 发表评论
     */
    public function sendCom() {
    	$m = M('Comment');
    	if($_SESSION['login']!=1) {
    		echo 0;
    		exit(0);
    	}
 		if(I('post.stu_id')!="") {
 			$data['com_pid']=I('post.stu_id');
 		}
    	$data['com_content'] = I('post.content');
    	$data['com_uid'] = $_SESSION['stu_id'];
    	$data['com_addtime'] = time();
    	$m->add($data);
    	$info['com_content'] = I('post.content');
    	if($_SESSION['stu_name'])
    		$info['stu_name'] = $_SESSION['stu_name'];
    	else 
    		$info['stu_name']="";
    	echo json_encode($info);
    }
    /**
     * 查看详情
     */
    public function detail() {
    	
    	$stu_id = (int)I('post.stu_id');
    	$m = M('Student');
    	$res = $m->
    	field('stu_id,img_name,stu_praise_count')
    	->join("JOIN image ON student.stu_id=image.img_uid")
    	->where("stu_id=$stu_id")->find();
    	$arr[]=$res;
    	$com = M('Comment');
    	$data['com_pid']=$stu_id;
    	
    	$com_info = $com->
    		where($data)
    		->select();
    	foreach ($com_info as $k => &$v) {
    		$uid = $v['com_uid'];
    		if($uid)
    			$v['stu_name'] = M('student')->where("stu_id = '$uid'")->getField("stu_name");
    		else 
    			$v['stu_name'] = "";
    	}
    	$arr[]= $com_info;
    	echo json_encode($arr);
    }
  
    
    
    
    /**
     * 登陆检查 用户名错误返回0，密码错误返回1，正确返回2
     */
    public function check_login() {
    	$user = M('Student');
    	//学号
    	$stu_num = I('post.stu_num');
    	//身份证号
    	$stu_id=  strtoupper(I('post.stu_id'));
    	$data['stu_xuehao'] = $stu_num;
    	$res = $user->where($data)->find();
    	if(!$res) {
    		echo 0;
    	}else {
    		$data['stu_idcard'] = $stu_id;
    		$res = $user->where($data)->find();
    		if(!$res) {
    			echo 1;
    		}else {
    			$m = M('Student');
    			$res = $m->where("stu_xuehao=$stu_num")->find();
    			$_SESSION['stu_name']=$res['stu_name'];
    			$_SESSION['stu_id'] = $res['stu_id'];
    			$_SESSION['login']=1;
    			echo 2;
    		}
    	}
	}
	/**
	 * 用户退出
	 */
	public function logout() {
		session_destroy();
		$this->redirect('index');
	}
}