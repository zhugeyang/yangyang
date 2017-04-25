<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    protected $_validate = array(
        array('name','require','请填写管理员名称！'), //默认情况下用正则进行验证
        array('name','','管理员名称已经存在！',0,'unique',self::MODEL_BOTH), // 在新增的时候验证name字段是否唯一
        array('password','require','请填写密码！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
    );
   /* protected $_auto = array(
    	array('password','md5',1,'function') , //添加时用md5函数处理 
        array('update_at','time',2,'function'), //更新时
        array('create_at','time',1,'function'), //新增时
        array('login_ip','get_client_ip',3,'function'), //新增时
      //  array('password','',2,'ignore')   //怎么不能用？
    );*/

}