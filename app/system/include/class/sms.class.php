<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/**
 * 短信发送类
 * @param string $errorcode  出错信息	
 */
load::sys_class('curl');
class sms extends curl{	
	public $errorcode; 	
	/**
	 * 短信发送
	 * @param string $phone     手机号码
	 * @param string $message   要发送的内容
	 * @param integer $type     发送类型
	 * 0 = 其他
	 * 1 = 短信群发
	 * 2 = 站长统计
	 * 3 = 访问监测
	 * 4 = 访客操作提醒
	 * 5 = 密码找回	
	 * 6 = 用户通知	
	 * @rerutn array            返回发送是否成功信息
	 */
	public function sendsms($phone, $message, $type = 6){
		global $_M;
		//验证商业用户
		$varcode = $this->varcodeb('sms');
		$varcode = $varcode['re'] == 'SUC' ? $varcode['md5'] : '';
		//发送短信
		$total_pass = DB::get_one("SELECT * FROM {$_M['table']['otherinfo']} WHERE lang='met_sms'");
		if($total_pass){
			$this -> set('host', 'http://api.metinfo.cn/');
			$this->set('file', '/sms/sendsms.php');
			$post = array(
				'total_pass'=>$total_pass['authpass'],
				'phone'=>$phone,
				'message'=>$message,
				'type'=>$type,
				'varcode'=>$varcode,
				'code'=>$code
			);
			$sms = $this->curl_post($post, 30);
			$sms = trim($sms);
			$time=time();
			switch($sms){
				case 'SUCCESS': $qey = 1;break;
				case 'ERR_10' : $qey = $type == 1 ? 0 : 1;break;
				case 'ERR_11' : $qey = 0;break;
				case 'ERR_12' : $qey = 0;break;
				case 'ERR_13' : $qey = $type == 1 ? 0 : 1;break;
				case 'ERR_14' : $qey = $type == 1 ? 0 : 1;break;
				case 'ERR_15' : $qey = 0;break;
				case 'ERR_16' : $qey = $type == 1 ? 0 : 1;break;
				case 'ERR_17' : $qey = $type == 1 ? 0 : 1;break;
				case 'ERR_17' : $qey = 0;break;
			}
			$metinfo = $type == 1 ? $this->sedsmserrtype($sms) : $sms;
			if($qey){
				$query = "INSERT INTO {$_M['table']['sms']} SET
					time     ='{$time}',
					type     ='{$type}',
					content  ='{$message}',
					tel      ='{$phone}',
					remark   ='{$sms}'";
				DB::query($query);
			}
		}else{
			$metinfo = $_M['word']['smstips66'];
		}
		//删除验证文件
		if($varcode != '')$this->delcodeb($varcode);
		$this->errorcode = $metinfo;
		return $sms;
		
	}
	
	/**
	 * 权限验证
	 * @param string $type:	应用类型;
	 * @return  array 		返回值（re:返回状态;md5:验证码）
	 */
	protected function varcodeb($type){
		global $_M;
		$blcode = DB::get_one("SELECT * FROM {$_M['table']['otherinfo']} where id='1'");
		$authcode = $blcode['authcode'];
		$authpass = $blcode['authpass'];
		$this->set('file', '/test/varcode.php');
		if($authcode&&$authpass){
			$post=array('code'=>$authcode, 'pass'=>$authpass, 'type'=>$type);
			$md5 = $this->curl_post($post, 30);
			if(preg_match("/^[a-zA-Z0-9]{32}$/", $md5)){
				if(!is_dir(PATH_WEB.'cache/'))mkdir(PATH_WEB.'cache/','0755');
				if(file_put_contents(PATH_WEB."cache/$md5.txt", $md5)){			
					$this->set('file', '/test/check.php');
					$post = array('md5'=>$md5);
					$result = $this->curl_post($post, 30);
					if($result == 'SUC'){
						return array('re'=>'SUC', 'md5'=>$md5);
					}else{
						$this->delcodeb($md5);
						return array('re'=>$result, 'md5'=>'');
					}
				}else{
					$this->delcodeb($md5);
					return array('re'=>'DISREAD', 'md5'=>'');
				}
			}
			else{
				return array('re'=>$md5, 'md5'=>'');
			}
		}else{
			return array('re'=>'DISBUS', 'md5'=>'');
		}		
	}
	
	/**
	 * 删除验证文件
	 */
	protected function delcodeb($varcode){
		$this->set('file', '/test/delvarcode.php');
		unlink(PATH_WEB."/cache/$varcode.txt");
		$post=array('varcode'=>$varcode);
		$this->curl_post($post, 30);
	}
	
	/**
	 * 发送成功或错误的返回值
	 */ 
	protected function sedsmserrtype($err, $type){
		global $_M;
		switch($err){
			case 'SUCCESS':$metinfo = $_M['word']['getOK'];break;		//	发送成功
			case 'ERR_10' :$metinfo = $_M['word']['smstips66'];break;	//	余额不足
			case 'ERR_11' :$metinfo = $_M['word']['smstips67'];break;	//	短信内容太长，最多350个字
			case 'ERR_12' :$metinfo = $_M['word']['smstips68'];break;	//	手机号码太多，最多800个号码
			case 'ERR_13' :$metinfo = $_M['word']['smstips69'];break;	//	号码不符合规则
			case 'ERR_14' :$metinfo = $type ? $_M['word']['smstips70'] : $_M['word']['smstips76'];break;// 发送成功(有延迟) :  服务器无响应
			case 'ERR_15' :$metinfo = $_M['word']['smstips71'];break;	//	异常操作，余额不足
			case 'ERR_16' :$metinfo = $_M['word']['smstips72'];break;	//	余额不足
			case 'ERR_17' :$metinfo = $_M['word']['smstips73'];break;	//	短信内容和手机号码不能为空
			case 'ERR_18' :$metinfo = $_M['word']['smstips74'];break;	//	发送密码错误
			case 'ERR_19' :$metinfo = $_M['word']['smstips75'];break;	//	网站无法访问
		}
		return $metinfo;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>