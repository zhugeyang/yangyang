<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/4/24
 * Time: 16:50
 */
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8");
class EmailtestController  extends Controller
{
    public function index()
    {
        if(!IS_POST){
            $this->display();
        }
        if(IS_POST){
            //验证为空
            if( empty($_POST['username']) || empty($_POST['passwd']) || empty($_POST['repasswd']) || empty($_POST['email']) )
            {
                echo "<script>alert('不能为空，请重新输入');</script>";
                echo "<script>javescripy:history.back(-1)</script>";
            }

            $data['username'] = trim(I('username'));
            $data['passwd'] = trim(I('passwd'));
            $data['repasswd'] = trim(I('repasswd'));
            $data['email'] = trim(I('email'));
            $email=$data['email'];
            $data['status']='0';

            //验证密码
            if( $data['passwd'] !== $data['repasswd']){
                echo "<script>alert('密码不一致，请重新输入');</script>";
                echo "<script>javescripy:history.back(-1)</script>";
            }
            $model = M('user');
            $add = $model->add($data);
            p($add);
            p($data['email']);
            $bl=$this->send_email($email,'账号激活',
                'http://123.207.117.148/yangyang/Emailtest/alive/id/'.$add);
            p($bl);
        }

    }

    public function alive(){
        $where['id']=I('get.id');
        $model=M('user');
        $user=$model->where($where)->find();
        if($user){
            if(strcmp($user['status'],0)==0){
                $save['status']='1';
                $save=$model->where($where)->save($save);
                if($save){
                    echo "激活此账号成功";
                }else{
                    echo "激活失败";
                }
            }else{
                echo "你已经成功激活此账号，请不要重新操作";
            }
        }else{
            echo "请重新注册";
        }
    }


    function send_email($address,$subject,$content){
        $email_smtp=C('EMAIL_SMTP');
        $email_username=C('EMAIL_USERNAME');
        $email_password=C('EMAIL_PASSWORD');
        $email_from_name=C('EMAIL_FROM_NAME');
        $email_smtp_secure=C('EMAIL_SMTP_SECURE');
        $email_port=C('EMAIL_PORT');
        if(empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)){
            return array("error"=>1,"message"=>'邮箱配置不完整');
        }
        require_once './ThinkPHP/Library/Org/Nx/class.phpmailer.php';
        require_once './ThinkPHP/Library/Org/Nx/class.smtp.php';
        $phpmailer=new \Phpmailer();
        // 设置PHPMailer使用SMTP服务器发送Email
        $phpmailer->IsSMTP();
        // 设置设置smtp_secure
        $phpmailer->SMTPSecure=$email_smtp_secure;
        // 设置port
        $phpmailer->Port=$email_port;
        // 设置为html格式
        $phpmailer->IsHTML(true);
        // 设置邮件的字符编码'
        $phpmailer->CharSet='UTF-8';
        // 设置SMTP服务器。
        $phpmailer->Host=$email_smtp;
        // 设置为"需要验证"
        $phpmailer->SMTPAuth=true;
        // 设置用户名
        $phpmailer->Username=$email_username;
        // 设置密码
        $phpmailer->Password=$email_password;
        // 设置邮件头的From字段。
        $phpmailer->From=$email_username;
        // 设置发件人名字
        $phpmailer->FromName=$email_from_name;
        // 添加收件人地址，可以多次使用来添加多个收件人
        if(is_array($address)){
            foreach($address as $addressv){
                $phpmailer->AddAddress($addressv);
            }
        }else{
            $phpmailer->AddAddress($address);
        }
        // 设置邮件标题
        $phpmailer->Subject=$subject;
        // 设置邮件正文
        $phpmailer->Body=$content;
        // 发送邮件。
        if(!$phpmailer->Send()) {
            $phpmailererror=$phpmailer->ErrorInfo;
            return array("error"=>1,"message"=>$phpmailererror);
        }else{
            return array("error"=>0);
        }
    }

}