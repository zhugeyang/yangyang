<?php
namespace Home\Controller;
use Think\Controller;
//学习Ajax
class AjaxController extends Controller{
	public function index(){
        $this->display();
    }
    //ajax查找原生
    public function search(){
        $model=M('ajax');
        $where['num']=I('num');
        $user=$model->where($where)->find();
        if($user){
            echo "找到此员工,姓名:".$user['name'];
        }else{
            echo "没有找到此员工";
        }

    }
    //ajax插入原生
    public function  create(){
        var_dump($_POST);
        $model=M('ajax');
        $data['num']=I('num');
        $data['name']=I('name');
        $data['sex']=I('sex');
        var_dump($data);
        $user=$model->add($data);
        var_dump($user);
        if($user){
            echo "员工信息插入成功";
        }else{
            echo "员工信息插入失败";
        }
    }


    //ajax查找JQ
    public function searchjq(){
        $model=M('ajax');
        $where['num']=I('num');
        $user=$model->where($where)->find();
        if($user){
            echo "找到此员工,姓名:".$user['name'];
        }else{
            echo "没有找到此员工";
        }

    }
    //ajax插入JQ
    public function  createjq(){
        var_dump($_POST);
        $model=M('ajax');
        $data['num']=I('num');
        $data['name']=I('name');
        $data['sex']=I('sex');
        var_dump($data);
        $user=$model->add($data);
        var_dump($user);
        if($user){
            echo "员工信息插入成功";
        }else{
            echo "员工信息插入失败";
        }
    }












	}


