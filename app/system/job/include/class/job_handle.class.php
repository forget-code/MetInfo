<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/news_handle');

/**
 * 招聘处理类
 */

class job_handle extends news_handle {

	public function __construct() {
		global $_M;
		$this->construct('job');
	}

	/**
	 * 处理招聘简历字段
	 * @param  string  $job_list 招聘岗位数组
	 * @return array             处理过后的招聘岗位数组
	 */
	public function para_handle($job_list){
		global $_M;
		foreach ($job_list as $key => $val) {
			$job_list[$key] = $this->one_para_handle($val);
		}
		return $job_list;
  }

	/**
	 * 处理设置字段
	 * @param  string  $banner 设置数组
	 * @return array           处理过后的栏目图片数组
	 */
	public function one_para_handle($content = array())
    {
        global $_M;
        $content['title'] = $content['position'];
        $content['url'] = $this->url_add_contents_filename('job', $this->contents_page_name, $content['id'], $content['filename'], $content['lang'], $content['addtime']);
        $content['addtime'] = date($_M['config']['met_listtime'], strtotime($content['addtime']));
        $content['cv'] = $this->url_transform('job/cv.php?lang=' . $content['lang'] . '&selectedjob=' . $content['id']);
        if ($content['new_windows']) {
            $content['target'] = 'target="_blank"';
        } else {
            $content['target'] = '';
        }

        $content = self::addStyle($content);
        return $content;
    }

    /**
     * 添加系统样式
     * @param array $content
     * @return array
     */
    public function addStyle($content = array())
    {
        global $_M;
        //title
        $title = "<span style='";
        if ($content['text_size']) {
            $title .= "font-size:{$content['text_size']}px ;";
        }
        if ($content['text_color']) {
            $title .= "color:{$content['text_color']} ;";
        }
        $title .= "'>" . $content['title'] . "</span>";
        $content['_title'] = $title;

        //position
        $position = "<span style='";
        if ($content['text_size']) {
            $position .= "font-size:{$content['text_size']}px ;";
        }
        if ($content['text_color']) {
            $position .= "color:{$content['text_color']} ;";
        }
        $position .= "'>" . $content['position'] . "</span>";
        $content['_position'] = $position;

        return $content;
    }

	/**
	 * 返回分页url
	 * @param  string  $id 栏目id
	 * @return string
	 */
	public function get_content_url($content, $type){
		return $this->url_add_contents_filename('job', $this->contents_page_name, $content['id'], $content['filename'], $content['lang'], $content['addtime'], $type);
	}

	/**
	 * 处理招聘简历字段
	 * @param  string  $para 招聘简历字段
	 * @return array         处理后的简历字段数组
	 */
	public function job_para_handle($para){
		global $_M;
		foreach ($para as $key => $val) {

		}
	}

	/**
	 * 处理设置字段
	 * @param  string  $id     反馈栏目id
	 * @return array           提交表单地址
	 */
	public function module_form_url($id) {
		global $_M;
		$c = load::sys_class('label', 'new')->get('column')->get_column_id($id);
		return $this->url_transform('job/save.php');
	}

	/**
	 * 处理设置字段
	 * @param  string  $id     反馈栏目id
	 * @return array           提交表单地址
	 */
	// public function get_page_url($id) {
  //   $c = load::sys_class('label', 'new')->get('column')->get_column_id($id);
	// 	return $this->url_transform('job/index.php?lang='.$c['lang']);
	// }


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
