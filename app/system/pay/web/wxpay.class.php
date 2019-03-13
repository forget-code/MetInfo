<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
ini_set('date.timezone','Asia/Shanghai');
require_once "wxpay/WxPay.Api.php";
require_once "wxpay/WxPay.NativePay.php";
require_once "wxpay/WxPay.JsApiPay.php";
require_once 'wxpay/WxPay.Notify.php';
require_once 'wxpay/log.php';
load::mod_class('pay/web/pay');
class wxpay extends pay {
    public function __construct() {
        global $_M;
        parent::__construct();
    }
    /**
     * 微信扫码支付
     * @param String(128) body           商品描述（商品或支付单简要描述）
     * @param String(127) attach         附加数据（在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据）
     * @param String(32)  out_trade_no   商户订单号（商户支付的订单号由商户自定义生成，长度不大于32位、可包含字母）
     * @param Int         total_fee      总金额（订单总金额，原始单位为分，只能为整数。可后台处理为“元”为单位）
     * @param String(32)  goods_tag      商品标记（商品标记，代金券或立减优惠功能的参数）
     * @param String(32)  product_id     商品ID（trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义）
     */
    public static function wxpay($date) {
        global $_M;
        $notify_url = is_strinclude($_M['url']['pay_notify'], 'localhost')?'http://mall.kisbox.com/paytool/alipay/notify_url.php':$_M['url']['pay_notify'];
        $notify     = new NativePay();
        $input      = new WxPayUnifiedOrder();
        
        $input->SetBody($date['body']);
        $input->SetAttach($date['attach']);
        $input->SetOut_trade_no($date['out_trade_no']);
        $input->SetTotal_fee($date['total_fee']*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($date['goods_tag']);
        $input->SetNotify_url($notify_url);
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($date['product_id']);
        
        $result    = $notify->GetPayUrl($input);
        $url       = $result["code_url"];
        $urlencode = urlencode($url);
        
        return $urlencode;
    }
    /**
     * JsApiPay
     */
    public function JsApiPay($date,$openId) {
        global $_M;
        $tools = new JsApiPay();
		
        $notify_url = is_strinclude($_M['url']['pay_notify'], 'localhost')?'http://mall.kisbox.com/paytool/alipay/notify_url.php':$_M['url']['pay_notify'];
        $input = new WxPayUnifiedOrder();
        $input->SetBody($date['body']);
        $input->SetAttach($date['attach']);
        $input->SetOut_trade_no($date['out_trade_no']);
        $input->SetTotal_fee($date['total_fee']*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($date['goods_tag']);
        $input->SetNotify_url($notify_url);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($date['openId']);
        $order = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();
        $result['Parameters'] = $jsApiParameters;
        $result['Address']    = $editAddress;
        return $result;
    }
	
    public function GetOpen_ID() {
        $tools = new JsApiPay();
        $code  = $tools->GetOpenid();
        return $code;
    }
    /**
     * 根据传递的订单号向微信服务器主动发送订单查询请求，获取订单支付状态
     */
    public function wxpayQuery() {
        global $_M;
        $out_trade_no = $_M['form']['out_trade_no'];
        $input = new WxPayOrderQuery();
        $input->SetOut_trade_no($out_trade_no);
        $result = WxPayApi::orderQuery($input);
        if($result['trade_state']==='SUCCESS') {                            //微信返回订单未支付且系统订单状态为未支付时更新系统订单状态
            // $this->UpadteOrder('1',$out_trade_no);
        }
        return $result; 
    }
    /**
     * 异步通知
     */
    public function donotify($out_trade_no) {
        $input = new WxPayOrderQuery();
        $input->SetOut_trade_no($out_trade_no);
        $result = WxPayApi::orderQuery($input);
        if($result['trade_state'] === 'SUCCESS') {
            $xml = '<xml>
                        <return_code><![CDATA[SUCCESS]]></return_code>
                        <return_msg><![CDATA[OK]]></return_msg>
                    </xml>';
            echo $xml;
            return TRUE;
        }
    }
    /**
     * 
     */
    public function OrderQuery($out_trade_no) {
        $input = new WxPayOrderQuery();
        $input->SetOut_trade_no($out_trade_no);
        $result = WxPayApi::orderQuery($input);
        return $result;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>