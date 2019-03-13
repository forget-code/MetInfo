<?php

defined('IN_MET') or exit('No permission');
defined('IN_ADMIN') or exit('No permission');

load::sys_class('common');
load::sys_class('nav');
load::sys_func('admin');

class admin extends common {

	public function __construct() {
		parent::__construct();
		global $_M;
		met_cooike_start();
		$this->load_language();
		$this->check();
		$this->lang_switch();
		load::plugin('doadmin');
		$_M['url']['help_tutorials_url']="http://help.metinfo.cn/help/show.php?langset={$_M['langset']}&helpid=";
		if($_M['user']['cookie'] && $_M['form']['sysui_pack']){
			require PATH_WEB.'public/ui/v2/static/library.php';
			die;
		}
		$_M['config']['m_type']=M_TYPE;
	}

	protected function load_url_site() {
		global $_M;

        if ($_SERVER['SERVER_PORT'] == 443 || $_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1 || $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https' || $_SERVER['HTTP_FROM_HTTPS'] == 'on') {
            $_M['url']['site_admin'] = 'https://'.str_replace(array('/index.php'), '', HTTP_HOST.PHP_SELF).'/';
        }else{
            $_M['url']['site_admin'] = 'http://'.str_replace(array('/index.php'), '', HTTP_HOST.PHP_SELF).'/';
        }
        $_M['url']['site'] = preg_replace('/(\/[^\/]*\/$)/', '', $_M['url']['site_admin']).'/';
        $_M['config']['met_weburl'] = $_M['url']['site'];

    }

	protected function load_url_unique() {
		global $_M;
		$_M['url']['ui'] = $_M['url']['site'].'app/system/include/public/ui/admin/';
		$_M['url']['adminurl'] =  $_M['url']['site_admin']."index.php?lang={$_M['lang']}".'&';
		$_M['url']['own_name'] =  $_M['url']['adminurl'].'anyid='.$_M['form']['anyid'].'&n='.M_NAME.'&';
		$_M['url']['own_form'] = $_M['url']['own_name'].'c='.M_CLASS.'&';
	}

	protected function load_language() {
		global $_M;
		$_M['langset'] = get_met_cookie('languser');
		if(!$_M['langset']){
			$_M['langset'] = $_M['config']['met_admin_type'];
		}
		$this->load_word($_M['langset'], 1);
		$this->load_agent_word($_M['langset']);
	}

	protected function load_agent_word($lang) {
		global $_M;
		if ($_M['config']['met_agents_type'] >= 2) {
			$query = "SELECT * FROM {$_M['table']['config']} WHERE lang='{$lang}-metinfo'";
			$result = DB::query($query);
			while($list_config= DB::fetch_array($result)){
				$lang_agents[$list_config['name']]=$list_config['value'];
			}
			$_M['word']['indexthanks'] = $lang_agents['met_agents_thanks'];
			$_M['word']['metinfo'] = $lang_agents['met_agents_name'];
			$_M['word']['copyright'] = $lang_agents['met_agents_copyright'];
			$_M['word']['oginmetinfo'] = $lang_agents['met_agents_depict_login'];
		}
	}

	protected function filter_config($value) {
		$value = str_replace('"', '&#34;', str_replace("'", "&#39;", $value));
		return $value;
	}

	protected function lang_switch(){
		global $_M;
		if($_M['form']['switch']){
			$url .= "{$_M['url']['site_admin']}index.php?lang={$_M['lang']}";
			if($_M['form']['a'] != 'dohome'){
				$url .= "&anyid={$_M['form']['anyid']}&switchurl=".urlencode(HTTP_REFERER)."#metnav_".$_M['form']['anyid'];
			}
			echo "
			<script>
				window.parent.location.href='{$url}';
			</script>
			";
			die();
		}
	}

	protected function check() {
		global $_M;
		$http = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
		$current_url = $http.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$login_url = $_M['url']['site_admin']."index.php?n=login&c=login&a=doindex";
		if (strstr($current_url, $_M['url']['site_admin']."index.php")) {
			$admin_index = 1;
		} else {
			$admin_index = '';
		}
		$met_adminfile = $_M['config']['met_adminfile'];
		$met_admin_table = $_M['table']['admin_table'];
		$metinfo_admin_name = get_met_cookie('metinfo_admin_name');
		$metinfo_admin_pass = get_met_cookie('metinfo_admin_pass');

		if (!$metinfo_admin_name || !$metinfo_admin_pass) {
			if ($admin_index) {
				met_cooike_unset();
				met_setcookie("re_url", $re_url,time()-3600);
				Header("Location: ".$login_url);
			} else {
				if (!$re_url) {
					$re_url = $_SERVER['HTTP_REFERER'];
					$HTTP_REFERERs = explode('?', $_SERVER['HTTP_REFERER']);
					$admin_file_len1 = strlen("/{$met_adminfile}/");
					$admin_file_len2 = strlen("/{$met_adminfile}/index.php");
					if(strrev(substr(strrev($HTTP_REFERERs[0]), 0, $admin_file_len1)) == "/{$met_adminfile}/" || strrev(substr(strrev($HTTP_REFERERs[0]), 0,$admin_file_len2)) == "/{$met_adminfile}/index.php"||!$HTTP_REFERERs[0]) {
						$re_url = "{$http}://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}";
					}
				}
				if (!$_COOKIE[re_url]&&!strstr($re_url, "return.php")) met_setcookie("re_url", $re_url,time()+3600);
				met_cooike_unset();
				Header("Location: ".$login_url);
			}
			exit;
		} else {
			$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id = '{$metinfo_admin_name}' AND admin_pass = '{$metinfo_admin_pass}' AND usertype = '3'";
			$admincp_ok = DB::get_one($query);
			if (!$admincp_ok) {
				if ($admin_index) {
					met_cooike_unset();
					met_setcookie("re_url",$re_url,time()-3600);
					Header("Location: ".$login_url);
				} else {
					if (!$re_url) {
						$re_url = $_SERVER['HTTP_REFERER'];
						$HTTP_REFERERs = explode('?',$_SERVER['HTTP_REFERER']);
						$admin_file_len1 = strlen("/{$met_adminfile}/");
						$admin_file_len2 = strlen("/{$met_adminfile}/index.php");
						if(strrev(substr(strrev($HTTP_REFERERs[0]), 0, $admin_file_len1)) == "/$met_adminfile/" || strrev(substr(strrev($HTTP_REFERERs[0]),0,$admin_file_len2)) == "/{$met_adminfile}/index.php" || !$HTTP_REFERERs[0]){
							$re_url = "{$http}://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}";
						}
					}
					if (!strstr($re_url, "return.php")) {
						if (!$_COOKIE['re_url']) met_setcookie("re_url", $re_url,time()+3600);
					}
					met_cooike_unset();
					Header("Location: ".$login_url);
				}
				exit;
			}
		}
		$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id='{$metinfo_admin_name}' AND admin_pass='{$metinfo_admin_pass}'";
		$membercp_ok = DB::get_one($query);

		if (!strstr($membercp_ok['admin_op'], "metinfo")) {
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
				$return_url = "";
			} else {
				$return_url = "javascript:window.history.back();";
			}

			if (stristr(M_ACTION, 'add')) {
				if (!strstr($membercp_ok['admin_op'], "add")) okinfo($return_url, $_M['word']['loginadd']);
			}
			if (stristr(M_ACTION, 'editor')||stristr($_M['form']['sub_type'], 'editor')) {

				if (!strstr($membercp_ok['admin_op'], "editor")) okinfo($return_url, $_M['word']['loginedit']);
			}
			if(stristr(M_ACTION, 'del')||stristr($_M['form']['submit_type'], 'del')){
				if (!strstr($membercp_ok['admin_op'], "del")) okinfo($return_url, $_M['word']['logindelete']);
			}
			if (stristr(M_ACTION, 'all')) {
				if (!strstr($membercp_ok['admin_op'], "metinfo")) okinfo($return_url, $_M['word']['loginall']);
			}
			if (stristr(M_ACTION, 'table')) {
				if (stristr($_M['form']['submit_type'], 'save')) {
					if ($_M['form']['allid']) {
						$power_ids = explode(',',$_M['form']['allid']);
						$e = 0;
						$a = 0;
						foreach ($power_ids as $val) {
							if($val){
								if (is_numeric($val)) {
									$e++;
								} else {
									$a++;
								}
							}
							if ($e > 0) {
								if (!strstr($membercp_ok['admin_op'], "editor")) okinfo($return_url, $_M['word']['loginedit']);
							}
							if ($a > 0) {
								if (!strstr($membercp_ok['admin_op'], "add")) okinfo($return_url, $_M['word']['loginadd']);
							}
						}
					}
				}

				if (stristr($_M['form']['submit_type'], 'del')) {
					if (!strstr($membercp_ok['admin_op'], "del")) okinfo($return_url, $_M['word']['logindelete']);
				}
			}
		}

/**---**/
		$c = M_CLASS;
		$n = M_NAME;
		if($n == 'index'){
			$n = 'manage';
		}
		$field = '-';
		if(M_TYPE == 'app'){
			$query = "SELECT no FROM {$_M['table']['applist']} WHERE m_name = '{$n}'  AND m_class = '{$c}'";
			$applist = DB::get_one($query);
			if($applist){
				$field = $applist['no'];
			}
		}else{

			$query = "SELECT field FROM {$_M['table']['admin_column']} WHERE url like '%c={$c}%' AND url like '%n={$n}%'";
			$admin_column = DB::get_one($query);
			if($admin_column){
				$field = $admin_column['field'];
			}

		}

		if(!stristr($membercp_ok['admin_type'], $field) && $membercp_ok['admin_type'] != 'metinfo'){
			echo("<script type='text/javascript'> alert('{$_M['word']['js81']}');window.history.back();</script>");
			exit;
		}

/**---**/
		if(stristr(M_NAME, 'appstore')) {
			if(!stristr($membercp_ok['admin_type'], '1507') && $membercp_ok['admin_type'] != 'metinfo') {
				echo("<script type='text/javascript'> alert('{$_M['word']['appmarket_jurisdiction']}');window.history.back();</script>");
				exit;
			}
		}
		if(stristr(M_NAME, 'theme')) {
			if($_M['form']['mobile']) {
				if(!stristr($membercp_ok['admin_type'], '1102') && $membercp_ok['admin_type'] != 'metinfo') {
					echo("<script type='text/javascript'> alert('{$_M['word']['setup_permissions']}');window.history.back();</script>");
					exit;
				}
			} else {
				if(!stristr($membercp_ok['admin_type'], '1101') && $membercp_ok['admin_type'] != 'metinfo') {
					echo("<script type='text/javascript'> alert('{$_M['word']['setup_permissions']}');window.history.back();</script>");
					exit;
				}
			}
		}
        if(stristr(M_NAME, 'column') && M_ACTION == 'doadd') {
            if(!stristr($membercp_ok['admin_type'], 's9999') && $membercp_ok['admin_type'] != 'metinfo') {
                echo("<script type='text/javascript'> alert('{$_M['word']['js81']}');location.reload()</script>");
                exit;
            }
        }
	}

	public function access_option($name='',$value=''){
		global $_M;
		$group = load::sys_class('group', 'new')->get_group_list();
		$re = "<select name=\"{$name}\" data-checked=\"{$value}\">";
		$re.= "<option value=\"0\">{$_M['word']['unrestricted']}</option>";
		foreach($group as $val){
			$re.= "<option value=\"{$val['id']}\">{$val['name']}</option>";
		}
		$val['id']=$val['id']+1;
		$re.= "<option value=\"{$val['id']}\">{$_M['word']['metadmin']}</option>";
		$re.= "</select>";
		return $re;
	}

}

?>
