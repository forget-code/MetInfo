<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');
load::sys_func('file');

class html extends admin {

	public function __construct() {
		global $_M;
		parent::__construct();
		nav::set_nav(1, $_M['word']['article6'], $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=doindex');
		nav::set_nav(2, $_M['word']['pseudostatic'], $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=dourl');
		nav::set_nav(3, $_M['word']['staticpage'], $_M['url']['own_form'].'a=doset');
		if($_M['config']['met_webhtm'] != 0)nav::set_nav(4, $_M['word']['createstatic'], $_M['url']['own_form'].'a=dohtml');
		nav::set_nav(5, $_M['word']['anchor_text'], $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=doanchor');
		nav::set_nav(6, 'SiteMap', $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=dositemap');
		nav::set_nav(7, $_M['word']['indexlink'], $_M['url']['adminurl'].'n=link&c=link_admin&a=doindex&anyid=39');
	}

	public function doset() {
		global $_M;
		nav::select_nav(3);
		$_M['url']['help_tutorials_helpid']='110';
		require $this->template('own/set');
	}

	public function dosaveset(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_webhtm';
		$configlist[] = 'met_htmway';
		$configlist[] = 'met_htmlurl';
		$configlist[] = 'met_htmtype';
		$configlist[] = 'met_htmpagename';
		$configlist[] = 'met_listhtmltype';
		$configlist[] = 'met_htmlistname';
		if($_M['form']['met_webhtm'] == 0 && $_M['form']['op'] == 1){
			$module = load::mod_class('column/column_op', 'new')->get_sorting_by_module(false);
			foreach($module as $key => $val){
				if($key >= 1){
					foreach($val['class1'] as $keycalss1 => $valclass1){
						$files = traversal($valclass1['foldername'], 'html|htm');
						foreach($files as $fkey => $fval){
							delfile($fval);
						}
					}
				}
			}
			$lang = load::mod_class('language/language_op', 'new')->get_lang();
			foreach ($lang as $key => $val) {
				delfile("index_{$val['mark']}.html");
				delfile("index_{$val['mark']}.htm");
			}
			delfile('index.html');
			delfile('index.htm');
		}
		$_M['form']['met_htmtype'] = $_M['form']['met_htmtype'] == 'htm' ? $_M['form']['met_htmtype'] : 'html';
		configsave($configlist);/*保存系统配置*/

		if($_M['form']['met_webhtm'] != 0 && $_M['form']['op'] == 1){
			turnover("{$_M[url][own_form]}a=dohtml&auto=1", $_M['word']['jsok']);
		}else{
			turnover("{$_M[url][own_form]}a=doset", $_M['word']['jsok']);
		}

	}

	public function dohtml() {
		global $_M;
		nav::select_nav(4);
		$module = load::mod_class('column/column_op', 'new')->get_sorting_by_module(false, $_M['mark']);
		$list = array();
		$list['name'] = $_M[word][htmAll];
		$list['content']['name'] = $_M[word][htmCreateAll];
		$list['content']['url'] = "{$_M[url][own_form]}&a=doget_html&all=1";
		$class1[] = $list;
		$list['name'] =$_M[word][seotips6];
		$list['content']['name'] = $_M[word][htmTip3];
		$list['content']['url'] = "{$_M[url][own_form]}&a=doget_html&index=1";
		$class1[] = $list;
		foreach($module as $keym => $valm) {
			if(($keym >=1 && $keym <= 8) || $keym == 12){
				foreach($valm['class1'] as $keyc1 => $valc1) {
					$list = array();
					$list['name'] = $valc1['name'];
					$list['content']['name'] = $_M[word][htmTip1];
					$list['content']['url'] = "{$_M[url][own_form]}&a=doget_html&type=content&module={$valc1['module']}&class1={$valc1['id']}";
					if($valc1['module'] >= 2 && $valc1['module'] <= 7 && $_M['config']['met_webhtm'] == 2){
						$list['column']['name']  = $_M[word][htmTip2];
						$list['column']['url'] = "{$_M[url][own_form]}&a=doget_html&type=column&module={$valc1['module']}&class1={$valc1['id']}";
					}
					$class1[] = $list;
				}
			}
		}
		require $this->template('own/html');
	}

	//用于其他模块调用
	public function dogenerate(){
		global $_M;
		nav::set_nav(1, '', '');
		nav::set_nav(2, '', '');
		$c = load::sys_class('label', 'new')->get('column')->get_column_id($_M['form']['column_list']);
		$url = "{$_M[url][own_form]}a=doget_html&type=column&module={$c['module']}&class1={$_M['form']['column_list']}&content={$_M['form']['id_list']}&index=1";
		$_M['form']['reurl'] = urldecode($_M['form']['reurl']);
		require $this->template('own/generate');
	}

	//生成静态页面列表
	public function doget_html(){
		global $_M;
		if($_M['form']['all'] == 1 || $_M['form']['index'] == 1){
			$pageinfo[] = $this->homepage();
		}
		$module = load::mod_class('column/column_op', 'new')->get_sorting_by_module(false, $_M['mark']);
		//dump($module[2]);
		foreach($module as $keym=>$valm){
			if( ($_M['form']['all'] == 1 || $keym == $_M['form']['module']) && ( ($keym >=1 && $keym <= 8) || $keym == 12) ){
				//列表页面
				if($_M['config']['met_webhtm'] == 2 && ($_M['form']['type'] == 'column' || ($_M['form']['all'] == 1 && $_M['config']['met_webhtm'] == 2)  ) && $keym>=2 && $keym<=7){
					foreach($valm['class1'] as $keyc1=>$valc1) {
						if($_M['form']['all'] == 1 || $valc1['id'] == $_M['form']['class1']){
							$pageinfo[] = $this->getpage($valc1['id'], $valc1['module']);
							foreach($valm['class2'] as $keyc2=>$valc2) {
								if($valc2['bigclass'] == $valc1['id']){
									$pageinfo[] = $this->getpage($valc2['id'], $valc2['module']);
								}
								foreach($valm['class3'] as $keyc3=>$valc3) {
									if($valc3['bigclass'] == $valc2['id']){
										$pageinfo[] = $this->getpage($valc3['id'], $valc3['module']);
									}
								}
							}
						}
					}
				}
				//内容页面
				if($_M['form']['type'] == 'content' || $_M['form']['all'] == 1){
					foreach($valm['class1'] as $keyc1=>$valc1) {
						if($_M['form']['class1'] && $_M['form']['class1'] != $valc1['id']){
							continue;
						}
						if($keym>=2 && $keym<=6){
							$pageinfo = array_merge((array)$pageinfo, (array)$this->getlist($valc1['id'], $valc1['module']));
						}else{
							//$pageinfo[] = $this->getindex($valc1['id'], $valc1['module']);
							if($_M['form']['class1'] == $valc1['id'] || $_M['form']['all'] == 1){
								$pageinfo = array_merge((array)$pageinfo, (array)$this->indexpage($valc1));
								if($keym == 1){
									foreach($valm['class2'] as $keyc2=>$valc2) {
										if($valc2['bigclass'] == $valc1['id']){
											$pageinfo = array_merge((array)$pageinfo, (array)$this->indexpage($valc2));
										}
										foreach($valm['class3'] as $keyc3=>$valc3) {
											if($valc3['bigclass'] == $valc2['id']){
												$pageinfo = array_merge((array)$pageinfo, (array)$this->indexpage($valc3));
											}
										}
									}
								}
							}
						}
					}
				}
				//内容页面生成，其他模块编辑添加的时候使用
				if($_M['form']['content']){
					if($keym>=2 && $keym<=6){
						$pageinfo = array_merge((array)$pageinfo, (array)$this->getlist($_M['form']['class1'], $_M['form']['module']));
					}
				}
			}
		}
		$pages = array();
		foreach($pageinfo as $key=>$val){
			$mod = load::sys_class('handle', 'new')->mod_to_file($val['module']);
			if($val['type'] == 'column'){
				$path = pathinfo($val['filename']);
				$html_dir = str_replace($_M['config']['met_weburl'], PATH_WEB, $path['dirname']);
				if(!file_exists($html_dir)){
					mkdir($html_dir,0777,true);
				}
				$page = 1;
				while ($page <= $val['count']) {
					$p = array();
					$p['url'] = load::sys_class('label', 'new')->get($mod)->handle->replace_list_page_url($val['url'], $page, $val['id'], 1)."&metinfonow={$_M['config']['met_member_force']}";
					$p['filename'] = urlencode(
						str_replace(
							$_M['url']['site'],
							'',
							load::sys_class('label', 'new')->get($mod)->handle->replace_list_page_url($val['filename'], $page, $val['id'], 3)
						)
					);
					$p['url'] .= "&html_filename={$p['filename']}";
					$p['url'] = str_replace('.php&', '.php?', $p['url']);
					$page++;
					$pages[] = $p;
				}
			}else{
				$p = array();
				$p['filename'] = urlencode(
					str_replace(
						$_M['url']['site'],
						'',
						$val['filename']
					)
				);
				$p['url'] .= $val['url']."&metinfonow={$_M['config']['met_member_force']}"."&html_filename={$p['filename']}";
				$p['url'] = str_replace('.php&', '.php?', $p['url']);
				$pages[] = $p;
			}
		}
		$all = count($pages);
		foreach($pages as $key =>$val){
			$now = $key + 1;
			$f = urldecode($val['filename']);
			$pages[$key]['suc'] = "<span style=\"color:green\">($now/$all)</span> <a target=\"_blank\" href=\"{$_M['url']['site']}{$f}\">{$f}{$_M[word][physicalgenok]}</a>";
			$pages[$key]['fail'] = "<span style=\"color:green\">($now/$all)</span> <a target=\"_blank\" href=\"{$_M['url']['site']}{$f}\" style=\"color:red\">{$f}{$_M[word][html_createfail_v6]}</a>";
		}
		jsoncallback(array('suc'=>1, 'json'=>$pages));
	}

	public function geturlinfo($val) {

	}

	public function getpage($id, $module) {
		$mod = load::sys_class('handle', 'new')->mod_to_file($module);
		$list = load::sys_class('label', 'new')->get($mod)->get_page_info_by_class($id, 1);
		$page['id'] = $id;
		$page['url'] = $list['url'];
		$page['count'] = $list['count'];
		$h = load::sys_class('label', 'new')->get($mod)->get_page_info_by_class($id, 3);
		$page['filename'] = $h['url'];
		$page['module'] = $module;
		$page['type'] = 'column';
		return $page;
	}

	public function getlist($id, $module) {
		$mod = load::sys_class('handle', 'new')->mod_to_file($module);
		$list = load::sys_class('label', 'new')->get($mod)->get_module_list($id);
		foreach($list as $key=>$val){
			if($val['links']){
				continue;
			}
			$page = array();
			$page['url'] = load::sys_class('label', 'new')->get($mod)->handle->get_content_url($val, 1);
			$page['filename'] = load::sys_class('label', 'new')->get($mod)->handle->get_content_url($val, 3);
			$page['module'] = $module;
			$page['count'] = 0;
			$page['type'] = 'content';
			$re[] = $page;
		}
		//dump($re);
		return $re;
	}

	public function indexpage($content) {
		if($content['module'] == 0 || $content['isshow'] == 0){
			return NULL;
		}else{
			$page['url'] = load::mod_class('column/column_handle', 'new')->url_full($content, 1);
			$page['count'] = 0;
			$page['filename'] = load::mod_class('column/column_handle', 'new')->url_full($content, 3);
			$page['module'] = $content['module'];
			$page['type'] = 'content';
			$re[] = $page;
			return $re;
		}
	}

	public function homepage() {
		global $_M;
		$page['url'] = $_M['url']['site'].'index.php?lang='.$_M['lang'];
		$page['count'] = 0;
		$page['filename'] = 'index';
		if($_M['config']['met_index_type'] != $_M['lang']){
      $page['filename'] .= '_'.$_M['lang'];
    }
		$page['filename'] .= '.'.$_M['config']['met_htmtype'];
		$page['module'] = 0;
		$page['type'] = 'content';
		return $page;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
