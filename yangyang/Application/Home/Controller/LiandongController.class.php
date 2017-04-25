<?php
namespace Home\Controller;
use Think\Controller;
//省市联动
header("Content-type:text/html;charset=utf8");
class LiandongController extends Controller{
    public function index(){
        $this->display();

    }
	public function getProvince(){
		$model=M('liandong');
        //$sheng=$model->where('pid=0')->field('id,name')->select();
		$sheng=$model->where('pid='.I('ID'))->field('id,name')->select();
        foreach ( $sheng as $key => $value ) {
            $sheng[$key]['name'] = urlencode ( $value['name'] );
        }
        //将数组转为JSON
        $sheng=urldecode(json_encode($sheng));
		echo $sheng;
	}

    public function getCity(){
        $model=M('liandong');
        $shi=$model->where('pid='.I('ID'))->field('id,name')->select();
        foreach ( $shi as $key => $value ) {
            $shi[$key]['name'] = urlencode ( $value['name'] );
        }
        //将数组转为JSON
        $shi=urldecode(json_encode($shi));
        echo $shi;
    }

    public function getCounty(){
        $model=M('liandong');
        $xian=$model->where('pid='.I('ID'))->field('id,name')->select();
        foreach ( $xian as $key => $value ) {
            $xian[$key]['name'] = urlencode ( $value['name'] );
        }
        //将数组转为JSON
        $xian=urldecode(json_encode($xian));
        echo $xian;
    }









	}