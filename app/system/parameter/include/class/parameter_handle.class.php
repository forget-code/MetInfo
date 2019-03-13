<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('handle');

/**
 * 字段处理类
 */

class parameter_handle extends handle {

	/**
	 * 字段表单处理
	 * @param  string  $banner   设置数组
	 * @param  string  $simplify 之前res013响应模板有这个参数，不知道什么情况会使用，后续如果没有用可以删除（该参数为是否显示选项名称的参数，true为简化不显示名称只显示选项控件）
	 * @return array             处理过后的栏目配置数组
	 */
 	public function para_handle_formation($para, $simplify = true) {
 		global $paravalue,$_M;
 		$module=$para[0]['module'];
 		switch ($module) {
 			case 6:
 				$para_need[$_M['config']['met_message_fd_class']]='1';
 				$para_need[$_M['config']['met_cv_email']]='email';
 				break;
 			case 7:
 			    $_M['config']['met_fd_back']=load::mod_class('message/message_database','new')->get_config_val('met_fd_back',7);
 			    $_M['config']['met_fd_sms_back']=load::mod_class('message/message_database','new')->get_config_val('met_fd_sms_back',7);
 				$para_need[$_M['config']['met_message_fd_class']]='1';
 				$para_need[$_M['config']['met_message_fd_content']]='1';
 				if($_M['config']['met_fd_back']) $para_need[$_M['config']['met_message_fd_email']]='email';
 				if($_M['config']['met_fd_sms_back']) $para_need[$_M['config']['met_message_fd_sms']]='tel';
 				break;
 			case 8:
 				$para_need[$_M['config']['met_fd_class']]='1';
 				$_M['config']['met_fd_back']=load::mod_class('message/message_database','new')->get_config_val('met_fd_back',8);
 			    $_M['config']['met_fd_sms_back']=load::mod_class('message/message_database','new')->get_config_val('met_fd_sms_back',8);
 				if($_M['config']['met_fd_back']) $para_need[$_M['config']['met_fd_email']]='email';
 				if($_M['config']['met_fd_sms_back']) $para_need[$_M['config']['met_fd_sms_dell']]='tel';
 				break;
 		}
 		foreach ($para as $key=>$val) {
 			if ($val['type_class'] != 'ftype_input ftype_code') {
        		$val['para'] = "para{$val[id]}";// 兼容v5模板
 				$val['dataname'] = "para{$val[id]}";
 				$val['placeholder'] = $val['description'];
 				$val['simplify'] = 0;
 				$val['type_html'] = '';
 				$val['wr_ok']=$para_need[$val['id']]?1:0;
 				if ($simplify && $val['type']<4) {
 					$val['simplify'] = 1;
 					$val['placeholder'] = $val['name'].' '.$val['description'];
 				}else{
 					$val['type_html'] = "<label class='control-label'>{$val['name']}</label>";
 				}
 				if($val['wr_ok'] && $para_need[$val['id']]!='1'){
 					switch ($para_need[$val['id']]) {
 						case 'email':
 							$fv_type=" data-fv-emailAddress='true' data-fv-emailaddress-message='{$val['name']}{$_M['word']['formaterror']}'";
 							break;
						case 'tel':
 							$fv_type=" data-fv-numeric='true' data-fv-numeric-message='{$val['name']}{$_M['word']['formaterror']}'";
 							break;
 						default:
 							$fv_type='';
 							break;
 					}
 				}else{
 					$fv_type='';
 				}
 				$wr_ok = $val['wr_ok']?"data-fv-notempty=\"true\" data-fv-message=\"{$_M['word']['Empty']}\"{$fv_type}":'';
 				switch($val['type']){
 					case 1:
 						$val['type_html'].="<input name='{$val[dataname]}' class='form-control' type='text' placeholder='{$val['placeholder']}' {$wr_ok} />";
 					break;
					 case 2:
					 	if($val['productlist']){
							$val['type_html'] .= "<select name='{$val['dataname']}' class='form-control' {$wr_ok}>";
							$val['type_html'] .= "<option value=''>{$val[name]}</option>";
							if( is_numeric($val['productlist']) ){
								$product = load::sys_class('label', 'new')->get('product')->get_module_list($val['productlist']);
							}else{
								$product = load::sys_class('label', 'new')->get('product')->get_module_list();
							}

							foreach($product as $pv){
								if($_M['form']['title'] == $pv['title']){
									$selected = "selected='selected'";
								}else{
									$selected = "";
								}
								$val['type_html'] .= "<option value='".$pv['title']."' {$selected}>".$pv['title']."</option>";
							}
							$val['type_html'].="</select>";
						}else{
							$val['type_html'].="<select name='{$val['dataname']}' class='form-control' {$wr_ok}>";
							$val['type_html'].="<option value=''>{$val[name]}</option>";
							foreach($val['para_list'] as $key=>$pv){
								if(is_array($pv)){
									$val['type_html'].="<option value='".$pv[info]."'>".$pv[info]."</option>";
								}else{
									$val['type_html'].="<option value='".$pv."'>".$pv."</option>";
								}

							}
							$val['type_html'].="</select>";
						}
 					break;
 					case 3:
 						$val['type_html'].="<textarea name='{$val[dataname]}' class='form-control' {$wr_ok} placeholder='{$val['placeholder']}' rows='5'></textarea>";
 					break;
 					case 4:
 						$i=0;
 						foreach($val['para_list'] as $key=>$pv){
 							$i++;
 							if(is_array($pv)){
                               $val['type_html'].="
 								<div class=\"checkbox-custom checkbox-primary\">
 									<input
 										name='para{$val[id]}_{$i}'
 										type=\"checkbox\"
 										value='{$pv[info]}'
 										id=\"para{$val[id]}_{$i}\"
 									>
 									<label for=\"para{$val[id]}_{$i}\">{$pv[info]}</label>
 								</div>";
 							}else{
 								$val['type_html'].="
 								<div class=\"checkbox-custom checkbox-primary\">
 									<input
 										name='para{$val[id]}_{$i}'
 										type=\"checkbox\"
 										value='{$pv}'
 										id=\"para{$val[id]}_{$i}\"
 									>
 									<label for=\"para{$val[id]}_{$i}\">{$pv}</label>
 								</div>";
 							}

 						}
 						if($val['description']){
 							$val['type_html'].="<span class=\"help-block\">{$val['description']}</span>";
 						}
 					break;
 					case 5:
 						$val['type_html'].="
 						<div class='input-group input-group-file'>
 							<span class='input-group-btn'>
 								<span class='btn btn-primary btn-file'>
 									<i class='icon wb-upload' aria-hidden='true'></i>
 									<input type='file' name='{$val[dataname]}' {$wr_ok} multiple=''>
 								</span>
 							</span>
 							<input type='text' class='form-control' readonly=''>
 						</div>";
 					break;
 					case 6:
 						$i=0;
 						foreach($val['para_list'] as $pv){
 							$i++;
 							$checked=$i==1?'checked':'';
 							if(is_array($pv)){
 								$val['type_html'].="
 								<div class=\"radio-custom radio-primary\">
 									<input
 										name='para{$val[id]}'
 										type=\"radio\"
 										{$checked}
 										value='{$pv[info]}'
 										id=\"para{$val[id]}_{$i}\"
 									>
 									<label for=\"para{$val[id]}_{$i}\">{$pv[info]}</label>
 								</div>";
 							}else{
 								$val['type_html'].="
 								<div class=\"radio-custom radio-primary\">
 									<input
 										name='para{$val[id]}'
 										type=\"radio\"
 										{$checked}
 										value='{$pv}'
 										id=\"para{$val[id]}_{$i}\"
 									>
 									<label for=\"para{$val[id]}_{$i}\">{$pv}</label>
 								</div>";
 							}

 						}
 						if($val['description']){
 							$val['type_html'].="<span class=\"help-block\">{$val['description']}</span>";
 						}
 					break;
 				}
 				$val['type_html']="<div class='form-group'>{$val['type_html']}</div>";
 				$list[] = $val;
 			}
 		}
 		if ($_M['config']['met_memberlogin_code']) {
 			$memberlogin_code['type_html'] = "<div class='form-group'>";
 			if(!$simplify){
 				$memberlogin_code['type_html'].="<label class='control-label'>{$_M['word']['memberImgCode']}</label>";
 			}
 			$memberlogin_code['type_html'].="<div class='input-group input-group-icon'>
					<input name='code' type='text' class='form-control input-codeimg' placeholder='{$_M['word']['memberImgCode']}' required data-fv-message='{$_M['word']['Empty']}'>
					<span class='input-group-addon p-5'>
					<img src='{$_M[url][entrance]}?m=include&c=ajax_pin&a=dogetpin' id='getcode' title='{$_M['word']['memberTip1']}' align='absmiddle' role='button'>
					</span>
				</div>
			</div>";
      $memberlogin_code['type'] = 100;
			$list[] = $memberlogin_code;
 		}
 		return $list;
 	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
