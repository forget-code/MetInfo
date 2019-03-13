<?php 

defined('IN_MET') or exit('No permission');

class met_sms {
	/**
	 * 获取总条数
	 * @DateTime 2017-07-26
	 * @return   int
	 */
	public function get_total() {
		global $_M;
		if(!$this->get_token()){
			return false;
		}	

		$data = array(
			'user_key' 	=> $_M['config']['met_secret_key'],
			'token'		=> $_M['config']['met_sms_token'],
			'url'		=> $_M['config']['met_weburl'],
			'type' 		=> 'total'
			);
		$res =  $this->curl($_M['config']['met_sms_url'], $data);
		return $res ? $res['status'] == 1 ? $res['data'] : 0 : 0;
	}

	/**
	 * 获取账户余额
	 * @DateTime 2017-07-26
	 * @return   int
	 */
	public function get_balance() {
		global $_M;
		$data = array(
			'user_key' 	=> $_M['config']['met_secret_key'],
			'url'		=> $_M['config']['met_weburl'],
			'type' 		=> 'balance'
			);
		$res = $this->curl($_M['config']['met_sms_url'],$data);
		return $res ? $res['data']['money'] ? $res['data']['money'] : 0 : 0;
	}

	/**
	 * 获取老短信接口的剩余条数
	 * @DateTime 2017-07-26
	 * @return  array
	 */
	public function get_old() {
		global $_M;
		$old = DB::get_one("SELECT authpass FROM {$_M['table']['otherinfo']} WHERE lang = 'met_sms'");
		if($old){
			$old_token = $old['authpass'];
			$data = array(
			'user_key' 	=> 	$_M['config']['met_secret_key'],
			'url'		=> 	$_M['config']['met_weburl'],
			'token'		=>	$_M['config']['met_sms_token'],
			'old_token'	=>  $old_token,
			'type' 		=> 	'old'
			);
			$res = $this->curl($_M['config']['met_sms_url'],$data);
			if($res['status'] ==  1){
				return $res['data']['balance'];
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}


	/**
	 * 如果是第一次打开应用，会生成一个token
	 * @DateTime 2017-07-26
	 * @return   boolean 
	 */
	public function get_token() {
		global $_M;

		// 不存在token 用户未登录 返回false
		if(!$_M['config']['met_secret_key'] && trim($_M['config']['met_sms_token']) == ''){
			return false;
		}else{
			// 用户已登录 向服务端请求token
			$data = array(
			'user_key' => $_M['config']['met_secret_key'],
			'url'	=> $_M['config']['met_weburl'],
			'type' => 'token'
			);

			$res = $this->curl($_M['config']['met_sms_url'],$data);
			
			// 服务端请求失败
			if(!$res){
				return false;
			}

			// 服务端返回带错误
			if($res['status'] == 0){
				return false;
			}

			$query = "UPDATE {$_M['table']['config']} SET value = '{$res['data']}' WHERE name = 'met_sms_token'";
			$addtoken =DB::query($query);

			if(!$addtoken){
				return false;
			}
			return true;
		}
	}


	/**
	 * 短信套餐列表
	 */
	public function get_package() {
		global $_M;
		$data = array(
			'user_key' 	=> $_M['config']['met_secret_key'],
			'url'		=> $_M['config']['met_weburl'],
			'type' 		=> 'package'
			);
		return $this->curl($_M['config']['met_sms_url'],$data);

	}

	/**
	 * 购买短信
	 * @DateTime 2017-07-26
	 * @param    integer    $package 短信套餐编号
	 */
	public function buy($package=1){
		global $_M;
		$data = array(
			'user_key' 	=> 	$_M['config']['met_secret_key'],
			'url'		=> 	$_M['config']['met_weburl'],
			'type' 		=> 	'buy',
			'token'		=>	$_M['config']['met_sms_token'],
			'package'	=>	$package
			);
		return $this->curl($_M['config']['met_sms_url'],$data);
	}

	/**
	 * 迁移老接口剩余条数到新接口
	 */
	public function migrate(){
		global $_M;
		$old = DB::get_one("SELECT authpass FROM {$_M['table']['otherinfo']} WHERE lang = 'met_sms'");
		if($old){
			$old_token = $old['authpass'];
			$data = array(
			'user_key' 	=> 	$_M['config']['met_secret_key'],
			'url'		=> 	$_M['config']['met_weburl'],
			'token'		=>	$_M['config']['met_sms_token'],
			'old_token'	=>  $old_token,
			'type' 		=> 	'migrate'
			);
			return $this->curl($_M['config']['met_sms_url'],$data);
		}else{
			return array('status'=>0,'msg'=>'');
		}
		
	}

	/**
	 * 财务记录
	 * @DateTime 2017-07-26
	 * @param    [type]     $start  offset
	 * @param    [type]     $length limit
	 */
	public function get_finance($start,$length) {
		global $_M;
		$data = array(
			'user_key' 	=> 	$_M['config']['met_secret_key'],
			'url'		=> 	$_M['config']['met_weburl'],
			'type' 		=> 	'finance',
			'token'		=>	$_M['config']['met_sms_token'],
			'start'		=>	$start,
			'length'	=>	$length
			);
		return $this->curl($_M['config']['met_sms_url'],$data);
	}

	/**
	 * 短信发送记录
	 * @DateTime 2017-07-26
	 * @param    [type]     $start  offset
	 * @param    [type]     $length limit
	 */
	public function get_logs($start,$length) {
		global $_M;
		$data = array(
			'user_key' 	=> 	$_M['config']['met_secret_key'],
			'url'		=> 	$_M['config']['met_weburl'],
			'type' 		=> 	'logs',
			'token'		=>	$_M['config']['met_sms_token'],
			'start'		=>	$start,
			'length'	=>	$length
			);
		return $this->curl($_M['config']['met_sms_url'],$data);
	}

	/**
	 * 设置短信签名
	 * @DateTime 2017-07-26
	 * @param    string     $sign 短信签名
	 * @return   [type]           [description]
	 */
	public function sms_sign($sign='') {
		global $_M;
		$data = array(
			'user_key' 	=> $_M['config']['met_secret_key'],
			'url'		=> $_M['config']['met_weburl'],
			'type' 		=> 'sign',
			'sign' 		=> $sign
			);
		return $this->curl($_M['config']['met_sms_url'],$data);
	}



    /**
     * 营销类短信
     * @DateTime 2017-07-26
     * @param    [type]     $sms_phone   
     * @param    [type]     $sms_content 
     */
    public function custom_send($sms_phone,$sms_content) {
    	global $_M;
    	$this->get_token();
    		$data = array(
			'user_key' 		=> $_M['config']['met_secret_key'],
			'token'			=> $_M['config']['met_sms_token'],
			'sms_phone'		=> $sms_phone,
			'sms_content'	=> $sms_content,
			'url'			=> $_M['config']['met_weburl'],
			'type' 			=> 'custom_send'
			);
		return $this->curl($_M['config']['met_sms_url'],$data);
    }

    /**
     * 通知类短信
     * @DateTime 2017-07-26
     * @param    [type]     $sms_phone  
     * @param    [type]     $sms_content
     */
    public function auto_send($sms_phone,$sms_content) {
    	global $_M;
    	if($sms_phone == ''){
    		return false;
    	}
    	$this->get_token();
    	$data = array(
			'token'			=> $this->get_token(),
			'sms_phone'		=> $sms_phone,
			'sms_content'	=> $sms_content,
			'token'			=> $_M['config']['met_sms_token'],
			'url'			=> $_M['config']['met_weburl'],
			'type' 			=> 'auto_send'
			);
		return $this->curl($_M['config']['met_sms_url'],$data);
    }

    public function addConfig($name,$value) {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['config']} WHERE  name='{$name}'";
        if(!DB::get_one($query))
        {
            $query = "INSERT INTO {$_M['table']['config']} (name,value,mobile_value,columnid,flashid,lang)VALUES ('{$name}', '{$value}', '', '0', '0', 'metinfo')";
            DB::query($query);
        }
    }

	public function curl($url,$data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $result = curl_exec($ch);
        // echo $result;
        curl_close($ch);
        if($result){
        	return json_decode($result,true);
        }else{
        	return false;
        }
    }

}