<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
load::mod_class('pay/web/include/class/mcode_shop');

class interface_pay {
	public function data_decode($data) {
		global $_M;
		$mocde = new mcode_shop($_M['config']['met_webkeys']);
		return $mocde->de_code($data);
	}

	public function data_encode($data) {
		global $_M;
		$mocde = new mcode_shop($_M['config']['met_webkeys']);
		return $mocde->en_code($data);
	}

  public function get_pay_list() {
    global $_M;
		$return = array();
		$query = "SELECT * FROM {$_M['table'][pay_config]} WHERE name='payment_type' and lang='{$_M['lang']}'";
		$payment_type = DB::get_one($query);
		$list = explode('|', $payment_type['value']);
		$url = "{$_M['url']['site']}pay/app.php?paytype=";
		if($this->is_weixin()){
			if(strstr($payment_type['value'], '6')){
				$openId = $this->weixinopenId();
				$return['weixin_h5']['have'] = 1;
				$return['weixin_h5']['url'] = $url.'6';
				$return['weixin_h5']['check_url'] = "{$_M['url']['site']}pay/orderquery.php?paytype=1&out_trade_no=";
			}
		}else if($this->is_mobile()){
			if(strstr($payment_type['value'], '3')){
				$return['alipay']['have'] = 1;
				$return['alipay']['url'] = $url.'3';
			}

			if(strstr($payment_type['value'], '4')){
				$return['upay']['have'] = 1;
				$return['upay']['url'] = $url.'4';
			}
		}else{
			if(strstr($payment_type['value'], '1')){
				$return['weixin']['have'] = 1;
				$return['weixin']['url'] = $url.'1';
				$return['weixin']['check_url'] = "{$_M['url']['site']}pay/orderquery.php?paytype=1&out_trade_no=";
			}

			if(strstr($payment_type['value'], '2')){
				$return['tenpay']['have'] = 1;
				$return['tenpay']['url'] = $url.'2';
			}

			if(strstr($payment_type['value'], '3')){
				$return['alipay']['have'] = 1;
				$return['alipay']['url'] = $url.'3';
			}

			if(strstr($payment_type['value'], '5')){
				$return['paypal']['have'] = 1;
				$return['paypal']['url'] = $url.'5';
			}

			if(strstr($payment_type['value'], '4')){
				$return['upay']['have'] = 1;
				$return['upay']['url'] = $url.'4';
			}

			/*if(strstr($payment_type['value'], '7')){
				$return['jd']['have'] = 1;
				$return['jd']['url'] = $url.'7';
			}*/
		}
		return $return;
    }

	function is_weixin(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
			return true;
		}
		return false;
	}

	function is_mobile(){
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if($_SERVER['HTTP_USER_AGENT']){
			$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
			if(preg_match($uachar, $ua)){
				return true;
			}
		}
		return false;
	}

	public function weixinopenId() {
		global $_M;
		if(!$_M['form']['openId']){
			$wxpay = load::mod_class('pay/web/wxpay.class.php', 'new');                 //加载微信支付处理类
			$openId = $wxpay->GetOpen_ID();
			met_setcookie('openId', $openId);
			return $openId;
		}

	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
