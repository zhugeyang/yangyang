<?php

namespace Home\Controller;
use Think\Controller;

header("Content-type: text/html; charset=utf-8");

class IndexController extends BaseController{
   public function _initialize()
    {
        vendor('WxPayPubHelper.WxPayPubHelper');
    }

    public function index(){
        $openid = $_SESSION['openId'];
        //var_dump($openid);
        $id='434343';
        $model=M('User');
        $model=$model->where('openid='.$id)
                 ->field('vipmember')
                 ->find();

        $this->assign('model',$model);
        $this->display();
    }

    public function money(){
        $openid = $_SESSION['openId'];
        //var_dump($openid);
        $id='4';
        $model=M('Money');
        $model=$model->where('userid='.$id)
                 ->field('money')
                 ->find();
        $this->assign('model',$model); 
         
        $this->display(); 
    }

    /*public function pay(){
        $model=$_GET['money'];

        $this->assign('model',$model);

        $this->display();
    }*/

    

    public function personalData(){
        $openid = $_SESSION['openId'];
        $sid='434343';
        if (!IS_POST) {   
            $this->display();
        }
        if (IS_POST) {
            $model = M("Person");
            $m=M('User');
            $m=$m->where('openid='.$sid)
                 ->field('id')
                 ->find();
            $data['tel']=$_POST['tel'];
            $data['name']=$_POST['name'];
            $data['sex']=$_POST['sex'];
            $data['userid']=$m['id'];
            if ($model->add($data)){
                  $this->success("添加成功", U('Index/index'));
              } else {
                  $this->error("添加失败");
              }
        }

    }

      public function consume(){
          $userid = session('openId');
          //$sql = 'SELECT * From consume WHERE useid ='.$openid;//妈的，php原声where条件放变量有毒啊
          $model = M('consume');
          $consume=$model->where($userid)->select();
          $this->assign('consume',$consume);
          $this->display();

    }
    public function intro(){
         $this->display();

    }
    public function paid(){
      $this->display();
    }


    public function pay()
    {=
      if (!IS_POST) {   
            $this->display();
        }
        if (IS_POST) {

        $model=$_GET['money'];
       
        //使用jsapi接口
        $jsApi = new \JsApi_pub();
        
        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        if (!isset($_GET['code']))
        {  
            //触发微信返回code码
            $url = $jsApi->createOauthUrlForCode(C('WxPayConf_pub.JS_API_CALL_URL'));
           
            Header("Location: $url");
        }else{
            //获取code码，以获取openid
            $code = $_GET['code'];
            $jsApi->setCode($code);
            $openid = $jsApi->getOpenId();
            session("openId",$openid);
        }

        //=========步骤2：使用统一支付接口，获取prepay_id============
        //使用统一支付接口
        $unifiedOrder = new  \UnifiedOrder_pub();
        
        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        $unifiedOrder->setParameter("openid",$openid);//商品描述
        $unifiedOrder->setParameter("body","贡献一分钱");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = C('WxPayConf_pub.APPID').$timeStamp;
        $unifiedOrder->setParameter("out_trade_no",$out_trade_no);//商户订单号
        $unifiedOrder->setParameter("total_fee","100");//总金额
        $unifiedOrder->setParameter("notify_url",C('WxPayConf_pub.NOTIFY_URL'));//通知地址
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID
        
        $prepay_id = $unifiedOrder->getPrepayId();


        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);
        
        $jsApiParameters = $jsApi->getParameters();
        
        $this->assign('jsApiParameters',$jsApiParameters);
        var_dump($jsApiParameters);
        exit;
         $this->assign('model',$model);
        $this->display();
      }
        
    }



    public function notify()
     {
        //使用通用通知接口
        $notify = new Notify_pub();
        
        //存储微信的回调
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $notify->saveData($xml);
        
        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;
        
        //==商户根据实际情况设置相应的处理流程，此处仅作举例=======
        
        //以log文件形式记录回调信息
//         $log_ = new Log_();
        $log_name= __ROOT__."/Public/notify_url.log";//log文件路径
        
        log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");
        
        if($notify->checkSign() == TRUE)
        {
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【通信出错】:\n".$xml."\n");
            }
            elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【业务出错】:\n".$xml."\n");
            }
            else{
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【支付成功】:\n".$xml."\n");
            }
        
            //商户自行增加处理流程,
            //例如：更新订单状态
            //例如：数据库操作
            //例如：推送支付完成信息
        }
    }

}
