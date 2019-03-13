<?php

include('mail/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
if ( ! function_exists('jmailsend'))
{
	function jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp,$repto,$repname)
	{
		$mail             = new PHPMailer();
		//$mail->SMTPDebug  = 3;
		
		$mail->CharSet    = "UTF-8"; // charset
		$mail->Encoding   = "base64";

		$mail->IsSMTP(); // telling the class to use SMTP

		//邮件系统配置
		$mail->SMTPAuth   = true;
		$mail->Host       = $smtp; // SMTP server
		$mail->Username   = $usename; // SMTP account username
		$mail->Password   = $usepassword;        // SMTP account password

		$mail->From       = $from;//必填，发件人Email 
		$mail->FromName   = $fromname; //必填，发件人昵称或姓名 

		//回复
		if($repto!=""){
			$name = isset($repname)?$repname:$repto;
			$mail->AddReplyTo($repto, $name);
		}
		$mail->WordWrap   = 50; // 自动换行的字数
		
		//主题
		$mail->Subject		= (isset($title)) ? $title : '';//必填，邮件标题（主题）

		
		//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // 可选，纯文本形势下用户看到的内容

		//邮件主体
		$body             = eregi_replace("[\]",'',$body);
		$mail->MsgHTML($body);
        
		
		//发送地址
		if($to)
		{
			$address = explode("|",$to);
			foreach($address AS $key => $val)
			{
				$mail->AddAddress($val, "");
			}
		}
		//发送附件
		//if(isset($data['attach']))
		//{
			//$attach = explode("|",$data['attach']);
			//foreach($attach AS $key => $val)
			//{
				//$mail->AddAttachment($val,"");             // 附件
			//}			
		//}
		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		 // echo "Message sent!";
		}
	}
}
?>
