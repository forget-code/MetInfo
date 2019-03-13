<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
/**
 * 支付基类
 * 集成支付：微信、财付通、支付宝、网银、PayPal
 */
ini_set('date.timezone','Asia/Shanghai');
load::sys_class('web');
load::sys_func('admin');
load::sys_func('str');
load::sys_func('array');
class pay extends web{

    protected $uid;
    public function __construct() {
        global $_M;
        //定义一些可以预定义的变量值
        parent::__construct();
        $this->uid = get_met_cookie('id') ? : 0;
    }
    
    /**
     * 购物车订单提交入口
     */
    public function doindex(){
        global $_M;

		// $this->check();
       $date = array(
            'body'          =>  $_M['form']['body'],                              //商品描述
            'subject'       =>  $_M['form']['subject'],                           //商品名称
            'out_trade_no'  =>  $_M['form']['out_trade_no'],                      //订单编号
            'attach'        =>  $_M['form']['attach'],                            //附加数据
            'goods_tag'     =>  $_M['form']['goods_tag'],                         //商品标记
            'product_id'    =>  $_M['form']['product_id'],                        //产品编号
            'total_fee'     =>  $_M['form']['total_fee'],                         //订单金额
            'no'            =>  $_M['form']['no'] ? : '1111111111'  //调用接口的应用编号（存在于applist）
        );
        if($date['out_trade_no'] && $date['total_fee'] && $date['subject']) {
            $this->CreateOrder($date);                                          //创建账单 存储订单信息到数据库
            $title = '选择在线支付方式';
            $paymentlist = $this->GetPaymentList();                             //获取处于开启状态的支付接口
            if(in_array('7', $paymentlist))
            {
                $bank_array = load::mod_class('pay/web/include/class/china_bank', 'new')->bank_array();
                /*
                 * 收款支付类型
                 * 1|储蓄卡
                 * 2|信用卡
                 */
                $jd_payment_type = jsondecode($_M['config']['jdpay_config']);
                $jd_payment_type = explode('|', $jd_payment_type['jd_payment_type']);

                
            }
            require_once $this->template('own/index');
        }else{
            echo "<script type=\"text/javascript\">alert(\"订单参数异常！请重新下单\");location.href=\"{$_M['url']['site']}member\"</script>";
        }
		
    }
    /**
     * 订单支付跳转
     */
    public function dopay() {
        global $_M;
        $out_trade_no = $_M['form']['out_trade_no'];
        $type         = $_M['form']['paytype']?$_M['form']['paytype']:(empty($_GET["code"])?'':'6');
        $date         = $this->GetOeder($out_trade_no);
        $status       = $this->CheckOrderPayStatus($out_trade_no);
        $paymentlist  = $this->GetPaymentList();                                //获取处于开启状态的支付接口
        //Paypal回调参数
        if(!$_M['form']['paytype'] && !empty($_GET["token"]) && !empty($_GET["PayerID"])) { $type = '5'; }
        //if(!$_M['form']['paytype'] && !empty($_GET["PayerID"])) { $type = '5'; }

        //京东网银在线
        if(is_numeric($type) && $type > 7)
        {
            $banklist_cash = jsondecode($_M['config']['jdpay_config']);
            $banklist_cash   = explode("|", $banklist_cash['banklist_cash']);
            $banklist_credit = jsondecode($_M['config']['jdpay_config']);
            $banklist_credit = explode("|", $banklist_credit['banklist_credit']);
            if(in_array($type, $banklist_cash) || in_array($type, $banklist_credit))
            {
                $date['bank'] = $type;                                          //选择的银行编码$_M['form']['paytype']:
                $type = '7';
            }
        }
        if(!$this->GetPayOpen()) {
            //获取接口开关状态，关闭时直接跳转至网站首页
            echo "<script type=\"text/javascript\">alert(\"未开启支付接口，请联系网站管理员。\");location.href=\"{$_M['url']['site']}\"</script>"; 
            //header("Location:{$_M['url']['site']}member");
        } else if(!$out_trade_no && $type != '6' && $type != '5') {
            var_dump($_REQUEST);
            die();
            echo "<script type=\"text/javascript\">alert(\"订单异常，请重新下单支付！\");location.href=\"{$_M['url']['site']}member\"</script>";
            //header("Location:{$_M['url']['site']}member");
        } else if(!$status && in_array($type, $paymentlist)) {                  //检测订单支付状态，并检测传入支付方式开启状态
            $this->UpadteOrderPaymentType($type, $out_trade_no);                //更新订单支付类型
            switch ($type) {
                case 1://微信扫码支付
                    $wxpay     = load::mod_class('pay/web/wxpay.class.php', 'new'); //加载微信支付处理类
                    $code_url  = $wxpay->wxpay($date);                          //调用微信支付接口
                    require_once $this->template('own/wxpay');
                    break;
                case 2://财付通支付tenpay
                    $tenpay   = load::mod_class('pay/web/tenpay.class.php', 'new'); //加载财付通支付处理类
                    $code_url = $tenpay->tenpay($date);                         //调用财付通支付接口
                    break;
                case 3://支付宝支付
                    $alipay = load::mod_class('pay/web/alipay.class.php', 'new');   //加载支付宝支付处理类
                    $alipay->alipay($date);                                     //调用支付宝支付接口
                    break;
                case 4://网银支付
                    $unionpay = load::mod_class('pay/web/unionpay.class.php', 'new');  //加载银联支付处理类
                    $unionpay->unionpay($date);                                 //调用银联支付接口
                    break;
                case 5://PayPal支付
                    $paypal = load::mod_class('pay/web/paypal.class.php', 'new');   //加载PayPal支付处理类
                    //没有 PayreID
                    if(!$_GET['PayerID']){
                        $paypal->paypal($date);                                 //调用paypal支付接口
                    }else{
                        $paypal->ConfirmPayment();
                    }
                    break;
                case 6://微信H5-JsApiPay支付
                    $wxpay     = load::mod_class('pay/web/wxpay.class.php', 'new'); //加载微信支付处理类
                    if($_GET['code']){
                        session_start();
                        $date           = $_SESSION["temp"];
                        $date['openId'] = $wxpay->GetOpen_ID();
                        $return         = $wxpay->JsApiPay($date);              //调用微信支付接口
                        require_once $this->template('own/jsapi');
                    }else{
                        //session 存储订单信息，备用
                        session_start();
                        $_SESSION["temp"] = $date;
                        $wxpay->GetOpen_ID();
                    }
                    break;
                case 7://网银在线支付
                    $chinabank = load::mod_class('pay/web/chinabank.class.php', 'new');//加载网银在线支付处理类
                    $chinabank->chinabank($date);                                  //调用网银在线支付接口
                    break;
                default:
                    break;
            }
        } else {
            // echo "<script type=\"text/javascript\">alert(\"非法操作！\");location.href=\"{$_M['url']['site']}member\"</script>";
        }
    }
    
    /**
     * 订单查询
     */
    public function doquery() {
        global $_M;
        $pay_type = $_M['form']['paytype'];
        switch ($pay_type) {
            case 1://微信订单查询
                $wxpay  = load::mod_class('pay/web/wxpay.class.php', 'new');
                $pay    = $wxpay->wxpayQuery();
				echo json_encode($pay);
                break;
            case 2://财付通订单查询
                $pay = $this->tenpayQuery(); 
                break;
            case 3://支付宝订单查询
                $pay = $this->alipayQuery(); 
                break;
            case 4://网银订单查询
                $pay = $this->unionpayQuery(); 
                break;
            case 5://PayPal订单查询
                $pay = $this->paypalQuery(); 
                break;
            default:
                break;
        }
    }
    
    /**
     * 创建订单存储至数据库
     */
    public function CreateOrder($date) {
        global $_M;
        //根据订单号进行重复订单查询
        if(!$order = $this->GetOeder($date['out_trade_no'])) {//订单不存在且订单数据不为空时进行订单信息存储，并返回订单号
            $date['order_time']   = date("YmdHis");
            $query = "INSERT INTO {$_M['table']['pay_order']} SET no={$date['no']},callback_url='{$date['return_url']}',out_trade_no='{$date['out_trade_no']}',subject='{$date['subject']}',product_id='{$date['product_id']}',body='{$date['body']}',goods_tag='{$date['goods_tag']}',attach='{$date['attach']}',show_url='{$date['show_url']}',total_fee='{$date['total_fee']}',order_time='{$date['order_time']}',pay_time='',pay_type='',callback='0',status='0',uid={$this->uid}";
           if(DB::query($query)){
                return DB::insert_id();
           }else{
                return false;
           }
        }
    }
    /**
     * 异步通知 处理
     */
    public function donotify() {
        global $_M;
        //=======【微信异步通知验证】==========================
        $xml   = $GLOBALS['HTTP_RAW_POST_DATA'];
        $array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        if($array && $array['out_trade_no']) {
            $date = $this->GetOeder($array['out_trade_no']);
                 $this->doNotify_wxpay($date);
           
        }

        $out_trade_no = $_M['form']['out_trade_no'] ? : $_POST['orderId'];
        if($_POST['remark1' ])
        {
            $out_trade_no = trim($_POST['remark1']);
        }
        if($out_trade_no) {
            $date = $this->GetOeder($out_trade_no);
            //=======【支付宝异步通知验证】==========================
            if($date['pay_type'] === '3') {
                $this->doNotify_alipay($date);
            }
            //=======【银联异步通知验证】==========================
            if($date['pay_type'] === '4') {
                $this->doNotify_unionpay($date);
            }

            //=======【财付通异步通知验证】==========================
            if($date['pay_type'] === '2') {
                $this->doNotify_tenpay($date);
            }
            //=======【网银在线异步通知验证】==========================
            if($date['pay_type'] === '7') {
                $this->doNotify_chinabank($date);
            }
            //=======【paypal支付验证】 by:rabbbbit 20171103===============
            if($date['pay_type'] === '5') {
                $this->doNotify_paypal($date);
            }
        }
    }
    
    public function doNotify_wxpay($date) {
        $wxpay = load::mod_class('pay/web/wxpay.class.php', 'new');
        if($wxpay->donotify($date['out_trade_no'])) {                           //异步通知验证
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    public function doNotify_alipay($date) {
        global $_M;
        $alipay = load::mod_class('pay/web/alipay.class.php', 'new');
        //异步通知验证
        if($alipay->donotify()&&!$date['status']&&($_M['form']['trade_status']==='TRADE_SUCCESS'||$_M['form']['trade_status']==='TRADE_FINISHED')) {
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    public function doNotify_unionpay($date) {
        $unionpay = load::mod_class('pay/web/unionpay.class.php', 'new');   //同步通知验证
        if($unionpay->donotify($date)) {
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }

     public function doNotify_tenpay($date) {
        $tenpay = load::mod_class('pay/web/tenpay.class.php', 'new');               //异步通知验证
        if($tenpay->donotify($date)) {
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    public function doNotify_chinabank($date) {
        $chinabank = load::mod_class('pay/web/chinabank.class.php', 'new');               //异步通知验证
        if($chinabank->donotify($date)) {
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    public function doNotify_paypal($date){
        global $_M;
        $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);        //paypal同步通知
        header("Location:{$_M['url']['site']}shop/order.php");
    }



    /**
     * 同步通知 处理
     */
    public function doreturn() {
        global $_M;
        $out_trade_no = $_M['form']['out_trade_no'] ? : ($_POST['orderId']?:($_POST['remark1']?trim($_POST['remark1']):''));
        $date         = $this->GetOeder($out_trade_no);
        $title        = '订单支付成功';
        $this->UpadteOrderReturnType($out_trade_no);                            //接收到同步通知后根据订单号更改【同步通知】状态
        $return_url   = $date['callback_url']?:$this->template('own/return');
                //获取自定义同步通知返回地址，为自定义则使用默认地址
        if($date['pay_type']==='1' || $date['pay_type']==='6') {
            $wxpay = load::mod_class('pay/web/wxpay.class.php', 'new');
            if($wxpay->OrderQuery($out_trade_no)) {
				if($date['callback_url']){
					header("Location: {$date['callback_url']}");
					die();
				}else{
					require_once $return_url;
				}
            }
        }
        if($date['pay_type'] === '3' && $_M['form']['total_fee'] === $date['total_fee']) {
            $alipay = load::mod_class('pay/web/alipay.class.php', 'new');           //同步通知验证
            if($alipay->doreturn()&&($_GET['trade_status']==='TRADE_SUCCESS'||$_GET['trade_status']==='TRADE_FINISHED')) {
				if($date['callback_url']){
					header("Location: {$date['callback_url']}");
					die();
				}else{
					require_once $return_url;
				}
            }
        }
        if($date['pay_type']==='4') {
            $unionpay = load::mod_class('pay/web/unionpay.class.php', 'new');       //同步通知验证
            if($unionpay->donotify($date)) {
                if($date['callback_url']){
					header("Location: {$date['callback_url']}");
					die();
				}else{
					require_once $return_url;
				}
            }
        }

         if($date['pay_type']==='2') {
            $unionpay = load::mod_class('pay/web/tempay.class.php', 'new');         //同步通知验证
            if($unionpay->doreturn($date)) {
                if($date['callback_url']){
                    header("Location: {$date['callback_url']}");
                    die();
                }else{
                    require_once $return_url;
                }
            }
        }
        if($date['pay_type']==='5') {
            $paypal = load::mod_class('pay/web/paypal.class.php', 'new');           //同步通知验证
             
            if($_GET['token'])
            {
                //if($paypal->doreturn($_GET['token'])) {
                $payerid = $paypal->doreturn($_GET['token']);
                if($payerid) {
                       if($date['callback_url']){
                    header("Location: {$date['callback_url']}.PayerID={$payerid}");
                    die();
                    }else{
                        require_once $return_url;
                    }
                }
            }
        }
        if($date['pay_type']==='7') {
            $chinabank = load::mod_class('pay/web/chinabank.class.php', 'new');           //同步通知验证
            if($chinabank->doreturn($date)) {
                if($date['callback_url']){
                    header("Location: {$date['callback_url']}");
                    die();
                }else{
                    require_once $return_url;
                }
            }
        }
    }
    /**
     * 根据订单号out_trade_no更新订单【支付状态】
     */
    public function UpadteOrder($pay_type,$out_trade_no) {
        global $_M;
        $pay_time = date("YmdHis");
        $query    = "UPDATE {$_M['table']['pay_order']} SET pay_time='{$pay_time}',pay_type='{$pay_type}',status='1' WHERE out_trade_no='{$out_trade_no}'";
        DB::query($query);
       
        $this->toapp($out_trade_no);
    }
	
    public function toapp($out_trade_no) {	
        global $_M;
        $query = "SELECT * FROM {$_M['table']['pay_order']} WHERE out_trade_no='{$out_trade_no}'";
        $pay   = DB::get_one($query);

        load::plugin('dopay', 0, array('pay'=>$pay));//加载插件
        
    }
	
    /**
     * 根据订单号out_trade_no更新订单【开始时间】、【支付类型】
     */
    public function UpadteOrderPaymentType($pay_type,$out_trade_no) {
        global $_M;
        $pay_time = date("YmdHis");
        $query    = "UPDATE {$_M['table']['pay_order']} SET pay_time='{$pay_time}',pay_type='{$pay_type}' WHERE out_trade_no='{$out_trade_no}'";
        DB::query($query);
    }
    /**
     * 根据订单号out_trade_no更新订单【同步通知状态】
     * 1|已接收到通知
     * 0|默认为未接收到通知
     */
    public function UpadteOrderReturnType($out_trade_no) {
        global $_M;
        $query    = "UPDATE {$_M['table']['pay_order']} SET callback='1' WHERE out_trade_no='{$out_trade_no}' AND uid={$this->uid}";
        DB::query($query);
    }
    /**
     * 根据订单号out_trade_no获取订单支付状态
	 *  TRUE|已支付
	 * FALSE|未支付
     */
    public function CheckOrderPayStatus($out_trade_no) {
        $order = $this->GetOeder($out_trade_no);
        if($order['status']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * 根据out_trade_no查询订单
     * 返回订单信息
     */
    public function GetOeder($out_trade_no) {
        global $_M;
        if($out_trade_no) {
            $query = "SELECT * FROM {$_M['table']['pay_order']} WHERE out_trade_no='{$out_trade_no}' ";
            $array = DB::get_one($query);
            return $array;
        } else {
            return FALSE;
        }
    }
    /**
     * 根据接口类型获取接口参数
     */
    public function GetAPI($type, $name) {
        global $_M;
        if($type&&$name) {
            $table = $_M['config']['tablepre'].'pay_api';
            $query = "SELECT value FROM {$table} WHERE name='{$name}'AND paytype='{$type}';";
            $arr   = DB::get_one($query);
            $value = $arr['value'];
        }else{
            $value = 'Fail!';
        }
        return $value;
    }
    /**
     * 获取接口开关
     */
    public function GetPayOpen() {
        global $_M;
        $table = $_M['config']['tablepre'].'pay_config';
        $query = "SELECT value FROM {$table} WHERE name='payment_open'";
        $arr   = DB::get_one($query);
        $value = $arr['value'];
        return $value;
    }
    /**
     * 获取已开启的支付接口
     */
    public function GetPaymentList() {
        global $_M;
        $table = $_M['config']['tablepre'].'pay_config';
        $query = "SELECT value FROM {$table} WHERE name='payment_type'";
        $arr   = DB::get_one($query);
        $value = stringto_array($arr['value'],'|');
        return $value;
    }
    protected function template($path){
        global $_M;
        list($postion, $file) = explode('/',$path);
        if ($postion == 'own') {
            return PATH_OWN_FILE."templates/met/{$file}.php";
        }
        if ($postion == 'ui') {
            return PATH_SYS."include/public/ui/web/{$file}.php";
        }
        if($postion == 'tem'){
            if($_M['custom_template']['sys_content']){
                $flag = 1;
            }else{
                $flag = 0;
            }
            if (file_exists(PATH_TEM."pay/{$file}.php")) {
                $_M['custom_template']['sys_content'] = PATH_TEM."pay/{$file}.php";
            }else{	
                if (file_exists(PATH_SYS."web/pay/templates/met/{$file}.php")) {
                    $_M['custom_template']['sys_content'] = PATH_SYS."web/pay/templates/met/{$file}.php";
                }
            }
            if($flag == 1){
                return $_M['custom_template']['sys_content'];
            }else{
                return $this->template('ui/compatible');
            }
			
        }			
    }
    
    


    
    /**
      * 重写web类的load_url_unique方法，获取前台特有URL
      */
    protected function load_url_unique() {
        global $_M;
        parent::load_url_unique();
        $_M['url']['own_func'] = $_M['url']['site'].'app/system/web/pay/include/function/';
        $_M['url']['own_class'] = $_M['url']['site'].'app/system/web/pay/include/class/';
        $_M['url']['pay_notify'] = $_M['url']['site'].'pay/notify.php';
        $_M['url']['pay_return'] = $_M['url']['site'].'pay/return.php';
        
        $_M['url']['tem'] = $_M['url']['site'].'app/system/web/pay/templates/met/';
        if($_M['lang'] != $_M['config']['met_index_type']){
            $lang = "?lang={$_M['lang']}";
        }
        $lang = "?lang={$_M['lang']}";
        $_M['url']['login'] = $_M['url']['site']."member/login.php{$lang}";
        $_M['url']['register'] = $_M['url']['site']."member/register_include.php{$lang}";
        $_M['url']['register_userok'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=douserok";
        $_M['url']['getpassword'] = $_M['url']['site']."member/getpassword.php";
        $_M['url']['profile'] = $_M['url']['site']."member/basic.php{$lang}"; 
        $_M['url']['profile_safety'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety"; 
        $_M['url']['pass_save'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dopasssave"; 
        $_M['url']['mailedit'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doemailedit"; 
        $_M['url']['maileditok'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doemailok"; 
        $_M['url']['profile_safety_emailadd'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_emailadd"; 
        $_M['url']['profile_safety_telok'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_telok"; 
        $_M['url']['profile_safety_telvalid'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_telvalid"; 
        $_M['url']['profile_safety_teladd'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_teladd"; 
        $_M['url']['profile_safety_teledit'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_teledit"; 
        $_M['url']['info_save'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doinfosave";
        $_M['url']['valid_email_repeat'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dovalid_email"; 
        $_M['url']['valid_email'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=doemailvild"; 
        $_M['url']['valid_phone'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=dophonecode"; 
        $_M['url']['login_check'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin";	
        $_M['url']['register_save'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=dosave";	
        $_M['url']['password_email'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=doemail";
        $_M['url']['password_valid'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dovalid";
        $_M['url']['password_telvalid'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dotelvalid";
        $_M['url']['password_valid_phone'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dophonecode";
        $_M['url']['login_out'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologout";	
        $_M['url']['login_other'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=doother";	
        $_M['url']['login_other_register'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin_other_register";	
        $_M['url']['login_other_info'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin_other_info";	
    }
    
}
?>