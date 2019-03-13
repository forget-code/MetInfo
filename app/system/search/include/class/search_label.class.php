<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/base_label');

/**
 * 搜索模块标签类
 */

class search_label extends base_label{

	public $lang;//语言
	public $search_page;//语言
	/**
	 * 初始化
	 */
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
		$this->construct('search', $_M['config']['met_search_list']);
	}

  /**
	 * 获取全局搜索标签数组
	 * @return array         搜索标签数组
	 */
	public function get_search_form(){
		global $_M;
		$search['url'] = $_M[url][site].'search/index.php?lang='.$this->lang;
		$search['para']['class1'] = 'class1';
		$search['para']['class2'] = 'class2';
		$search['para']['class3'] = 'class3';
		$search['para']['module'] = 'module';
		$search['para']['searchword'] = 'searchword';

		$search['lang']['searchword'] = $_M['form']['searchword'];
		$search['lang']['SearchInfo1'] = $_M['word']['SearchInfo1'];
		$search['lang']['SearchInfo2'] = $_M['word']['SearchInfo2'];
		$search['lang']['SearchInfo3'] = $_M['word']['SearchInfo3'];
		$search['lang']['SearchInfo4'] = $_M['word']['SearchInfo4'];
		$search['lang']['Empty'] = $_M['word']['Empty'];
		return $search;
  }

	/**
	 * 获取详细搜索选项
	 * @return array         搜索标签数组
	 */
	public function get_search_opotion($type, $classnow, $page){
		global $_M;
		if($type == 'page'){//模块列表页面搜索
			$url = load::sys_class('label', 'new')->get('tag')->get_list_page_url($classnow, $page).'&search=search';
			//模糊搜索框
			$search['form']['action'] = $url.'&search=search&order=com';
			$search['form']['input_name'] = "content";
			$search['form']['input_name_all'] = "all";
			$search['form']['content'] = $_M['form']['content'];

			//排序
			$order_url = $url;
			if($_M['form']['content']){
				$order_url .= "&content={$_M['form']['content']}";
			}
			if($_M['form']['para']){
				$para=urlencode($_M['form']['para']);
				$order_url .= "&para=".$para;
			}
			$search['order']['com']['name'] = $_M[word][listcom];
			$search['order']['com']['url']  = $order_url.'&order=com';
			$search['order']['hit']['name'] = $_M[word][listhot];
			$search['order']['hit']['url']  = $order_url.'&order=hit';
			$search['order']['new']['name'] = $_M[word][listnew];
			$search['order']['new']['url']  = $order_url.'&order=new';
			$order_para['order'] = $search['order'];
			$search['order'] = load::plugin('search_order', 1 , $order_para);//加载插件
			//字段搜索选项
            #dump($_M['form']);
            #dump($_M['form']['para']);
			$para_url = $url;
			if($_M['form']['order']){
				$para_url = $url."&order={$_M['form']['order']}";
			}
			$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);
			$paras = load::sys_class('label', 'new')->get('parameter')->get_para($class123['class1']['module'], $class123['class1']['id'],$class123['class2']['id']);
            #dump($paras);

			$paraurl = json_decode(load::sys_class('auth', 'new')->decode($_M['form']['para']), true);


			if(!$_M['config']['shopv2_para']){
			$parameter_database = load::mod_class('parameter_database','new');
			foreach($paras as $key => $val){
				if($val['type'] != 2 && $val['type'] != 4 && $val['type'] != 6 ){
					continue;
				}
				$id = $val['id'];
				$urlnow 	= $paraurl;
				$urlnow[$id] = '';
				$search['para'][$key]['name'] = $val['name'];
				$search['para'][$key]['id'] = $id;
				$p['name'] = $_M[word][weball];
				$p['url'] = $para_url."&para=".urlencode(load::sys_class('auth', 'new')->encode(json_encode($urlnow)));
				$p['id'] = 0;
				$search['para'][$key]['list'][] = $p;

				$parameters = $parameter_database->get_parameters($class123['class1']['module'],$val['id']);
				foreach($parameters as $v){
					$urlnow 		= $paraurl;
					$urlnow[$id] 	= $v['id'];
					$p['name'] 		= $v['value'];
					$p['id'] 		= $v['id'];
                    $p['url'] 		= $para_url."&para=".urlencode(load::sys_class('auth', 'new')->encode(json_encode($urlnow)));
                    $search['para'][$key]['list'][] = $p;
				}
			}

                //选中
                foreach($search['para'] as $pkey => $pval){
                    if($paraurl[$pval['id']]){
                        foreach($pval['list'] as $skey => $sval){
                            if($sval['id'] == $paraurl[$pval['id']]){
                                $search['para'][$pkey]['list'][$skey]['check'] = 'para_select_option';
                            }
                        }
                    }else{
                        $search['para'][$pkey]['list'][0]['check'] = 'para_select_option';
                    }
                }

			//shop
                #dump($search['para']);
                #$search['para'] = load::app_class('shop/include/class/shop_search','new')->getSpeclist($type, $classnow, $page);
                #dump($search['para']);

			}else{
                $search['para'] = load::app_class('shop/include/class/shop_search','new')->getSpeclist($type, $classnow, $page);
			}



			//dump($search['para']);
			//语言
			$search['lang']['searchword'] = $_M['form']['searchword'];
			$search['lang']['SearchInfo1'] = $_M['word']['SearchInfo1'];
			$search['lang']['SearchInfo2'] = $_M['word']['SearchInfo2'];
			$search['lang']['SearchInfo3'] = $_M['word']['SearchInfo3'];
			$search['lang']['SearchInfo4'] = $_M['word']['SearchInfo4'];
			$search['lang']['Empty'] = $_M['word']['Empty'];



			foreach($search['para'] as $val){
				$para_array[] = $val;
			}
			$search['para'] = $para_array;
		}

       /* dump($search);
        die();*/
        #dump($search['para']);
		return $search;
	}

	public function get_search_opotion_html($type, $classnow, $page){
		$info = $this->get_search_opotion($type, $classnow, $page);
$str .= <<<EOT

EOT;
		return $str;
	}
	/**
	 * 获取搜索form html
	 * @return array         搜索标签数组
	 */
	public function get_search_form_html(){
		global $_M;
		$searchword=$_M['form']['searchword'];
		$search = $this->get_search_form($searchword);
$str .= <<<EOT
		<form method='get' class="page-search-form form-group" role="search" action='{$search['url']}'>
			<input type='hidden' name='lang' value='{$this->lang}' />
			<div class="input-search input-search-dark">
				<button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
				<input
				type="text"
				class="form-control input-lg"
				name="{$search['para']['searchword']}"
				value="{$searchword}"
				placeholder="{$search['lang']['SearchInfo1']}"
				required
				data-fv-message = "{$search['lang']['Empty']}"
				>
			</div>
		</form>
EOT;
		return $str;
	}

	/**
	 * 获取搜索form html
	 * @return array         搜索标签数组
	 */
	public function get_search_list($str) {
		global $_M;
		$page = $_M['form']['page'] > 0 ? $_M['form']['page'] : 1;
		$page = $page - 1;
		$start = $this->page_num*$page;
		$end  = $start + $this->page_num;
		// return load::mod_class('search/search_handle', 'new')->para_handle(
		// load::mod_class('search/search_database', 'new')->get_search_list($this->lang, $title, $contents, $paras, $moudel, $class1, $class2, $class3, $start, $rows)
		// );
		$id = $_M['form']['class3'] ? $_M['form']['class3'] : ( $_M['form']['class2'] ? $_M['form']['class2'] : $_M['form']['class1'] );
		$type = array(
			'type' => 'array',
			'title'=> array (
				'status' => 1,//开启搜索
				'info' => $_M['form']['searchword'],
			),
			'content'=> array (
				'status' => 1,//开启搜索
				'info' => $_M['form']['searchword'],
			),
			'tag'=> array (
				'status' => 1,//开启搜索
				'info' => $_M['form']['searchword'],
			),
		);
		$order = array (
			'type' => 'array',
			'status'=> '1',
		);
		if($_M['form']['searchword']){

			$module = intval($_M['form']['module']);
			$table = load::sys_class('handle','new')->mod_to_name($module);
			if($table){
				if($module != 1){
					$content = load::sys_class('label', 'new')->get($table)->get_module_list($id, '', $type, $order);
					$all = $content;
				}else{
					$about = load::sys_class('label', 'new')->get('about')->search_about($_M['form']['searchword']);
					foreach ($about as $key => $val) {
						$about[$key]['title'] = $val['name'];
					}

					$all = $about;
				}

			}else{
				$about = load::sys_class('label', 'new')->get('about')->search_about($_M['form']['searchword']);
				foreach ($about as $key => $val) {
					$about[$key]['title'] = $val['name'];
				}
				$news = load::sys_class('label', 'new')->get('news')->get_module_list($id, '', $type, $order);
				$product = load::sys_class('label', 'new')->get('product')->get_module_list($id, '', $type, $order);
				$img = load::sys_class('label', 'new')->get('img')->get_module_list($id, '', $type, $order);
				$download = load::sys_class('label', 'new')->get('download')->get_module_list($id, '', $type, $order);
				$job = load::sys_class('label', 'new')->get('job')->get_module_list($id, '', $type, $order);
				$all = array_merge((array)$about, (array)$news, (array)$product, (array)$img, (array)$download, (array)$job);
			}

			$this->search_page = count($all);
			foreach($all as $key=>$val){
				if($key >= $start && $key < $end){
					$search[] = $val;
				}
			}
		}

		foreach($search as $key => $val){
			$list = array();
			$list['title'] = $this->handle->get_keyword_str($val['title'], $str, 50, 0, 1);
			$list['ctitle'] = $val['title'];
			$list['content'] = $this->handle->get_keyword_str(html_entity_decode(strip_tags($val['content']),ENT_QUOTES,'UTF-8') ,$str, 75, 0);
			$list['url'] = $val['url'];
			$list['updatetime'] = $val['updatetime'];
			$list['imgurl'] = $val['imgurl'];
			$return[] = $list;
		}
		if(count($return) == 0 && $str){
			$list = array();
			$list['title'] = "{$_M['word']['SearchInfo3']}[<em style='font-style:normal;'>$str</em>]{$_M['word']['SearchInfo4']}";
			$list['content'] = '';
			$list['url'] = '';
			$list['updatetime'] = date('Y-m-d H:i:s');
			$return[] = $list;
		}
		return $return;
	}

	/**
	 * 获取列表分页数据
	 * @param  string  $class1  一级栏目id
	 * @param  string  $page    当前分页
	 * @return array        		news数组
	 */
	public function get_page_info_by_class($id, $type) {
		global $_M;
		$info['url'] = $this->handle->url_transform("search/?class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}&search=search&searchword={$_M['form']['searchword']}&lang={$_M['lang']}&page=#page#");
		$info['count'] = ceil($this->search_page/$this->page_num);;
		return $info;
	}

	//搜索排序标签
	public function get_order(){
		global $_M;
		$order['type'] = 'array';
		switch ($_M['form']['order']) {
			case 'com':
				$order['status']  = '';
			break;
			case 'new':
				$order['status']  = '1';
			break;
			case 'hit':
				$order['status']  = '3';
			break;
			default:
				$order['status']  = '';
			break;
		}
		return $order;
	}

	public function search_info(){
		global $_M;
		$list = array();
		if($_M['form']['search']) {
			$type['type'] = 'array';
			if($_M['form']['title'] || $_M['form']['content']){
				return $type = array(
					'type' => 'array',
					'title'=> array (
						'status' => 1,//开启搜索
						'info' => $_M['form']['title'] ? $_M['form']['title'] : $_M['form']['content'],
					),
					'content'=> array (
						'status' => 1,//开启搜索
						'info' => $_M['form']['content'],
					),
                    'tag'=> array (
                        'status' => 1,//开启搜索
                        'info' => $_M['form']['content'],
                    ),
                    'para'=> array (
                        'status' => 1,//开启搜索
                        'precision' => 0,
                        'info' => $_M['form']['content'],
                    ),
					'specv'=> array (
						'status' => 0,//关闭商品规格搜索
						'precision' => 0,
						'info' => $_M['form']['content'],
					)
				);
			}elseif($_M['form']['para']){
				$paratmp = json_decode(load::sys_class('auth', 'new')->decode($_M['form']['para']), true);
				foreach($paratmp as $key => $val){
					$para[] = array(
						'id' => $key,
						'info' => $val,
					);
				}
				return $type = array(
					'type' => 'array',
					'title'=> array (
						'status' => 0,//开启搜索
					),
					'content'=> array (
						'status' => 0,//开启搜索
					),
                    'tag'=> array (
                        'status' => 0,//开启搜索
                    ),
					'specv'=> array (
                        'status' => 0,//开启搜索
                    ),
					'para'=> array (
						'status' => 1,//开启搜索
						'precision' => 0,
						'info' => $para,
					),
				);
			} elseif ($_M['form']['specv'] || $_M['form']['price_low'] || $_M['form']['price_top'] ) {
                $paratmp = json_decode(load::sys_class('auth', 'new')->decode($_M['form']['specv']),true);
                foreach($paratmp as $key => $val){
                    /*$specv[] = array(
                        #'spec_id' => $key,
                        'info' => $val,
                    );*/
                    $specv[$key] = $val;
                }
                return $type = array(
                    'type' => 'array',
                    'title'=> array (
                        'status' => 1,//开启搜索
                    ),
                    'content'=> array (
                        'status' => 0,//开启搜索
                    ),
                    'tag'=> array (
                        'status' => 0,//开启搜索
                    ),
                    'para'=> array (
                        'status' => 0,//开启搜索
                    ),
                    'specv'=> array (
                        'status' => 1,//开启搜索
                        'precision' => 0,
                        'info' => $specv
                    )
                );
            }
		}
		// else{
		// 	foreach ($_M['form'] as $key => $val) {
		// 		preg_match('/^para([0-9]+)/', $key, $out);
		// 		if ($out[1]) {

		// 			$str .= "paras LIKE '%[-S-]{$out}[1][-M-]{$val}[-S-]%'";
		// 		}
		// 	}
		// }

		// if($_M['form']['para']) {

		// }
	}

	//添加搜索选项，当前只能向动态页面添加
	public function add_search_url(){
		global $_M;
		if($_M['form']['search']){
			$str .= "&search=search";
			if($_M['form']['order']){
				$str .= "&order={$_M['form']['order']}";
			}
			if($_M['form']['title']){
				$str .= "&title={$_M['form']['title']}";
			}
			if($_M['form']['content']){
				$str .= "&content={$_M['form']['content']}";
			}
			if($_M['form']['para']){
				$para = rawurlencode($_M['form']['para']);
				$str .= "&para={$para}";
			}
			if($_M['form']['specv']){
				$specv = rawurlencode($_M['form']['specv']);
				$str .= "&specv={$specv}";
			}
		}
		return $str;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
