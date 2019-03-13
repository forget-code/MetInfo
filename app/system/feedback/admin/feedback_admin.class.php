<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('message/admin/message_admin');

class feedback_admin extends message_admin {
  public $moduleclass;
  public $module;
  public $database;
  /**
   * 初始化
   */

  function __construct() {
    global $_M;
    parent::__construct();
      $fname = DB::get_one("SELECT * FROM {$_M['table']['column']} WHERE id='{$_M['form']['class1']}'");
      nav::set_nav(1, $fname[name].$_M[word][msgmanager], "{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1']}");
      nav::set_nav(2, $fname[name].$_M[word][feedback_formset_v6], "{$_M[url][adminurl]}anyid={$_M['form']['anyid']}&n=parameter&c=parameter_admin&a=doparaset&module=8&class1={$_M['form']['class1']}");
      nav::set_nav(3, $fname[name].$_M[word][syssetting], "{$_M[url][own_form]}a=dosyset&class1={$_M['form']['class1']}");
    $this->module = 8;
    $this->database = load::mod_class('feedback/feedback_database', 'new');
    $this->tabledata = load::sys_class('tabledata', 'new');
    $this->xls = load::mod_class('feedback/PHP_XLS', 'new');
    //$this->database->construct('new');
  }

  /**
   * 新增内容
   */
  public function doadd() {
    global $_M;
    $list = $this->add();
    $a = 'doaddsave';
    $access_option = $this->access_option('access');
    require $this->template('own/article_add');
  }

  function add() {
    global $_M;
    $list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : 0;
    $list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : 0;
    $list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : 0;
    $list['displaytype'] = 1;
    $list['addtype'] = 1;
    $list['updatetime'] = date("Y-m-d H:i:s");
    $list['issue'] = get_met_cookie('metinfo_admin_name');
    return $list;
  }

  /**
   * 添加数据保存
   */
  public function doaddsave() {
    global $_M;
    $_M['form']['addtime'] = $_M['form']['addtype'] == 2 ? $_M['form']['addtime'] : date("Y-m-d H:i:s");
    if ($this->insert_list($_M['form'])) {
      if (1) {
        turnover("./content/article/save.php?lang={$_M['lang']}&action=html&select_class1={$_M['form']['select_class1']}&select_class2={$_M['form']['select_class2']}&select_class3={$_M['form']['select_class3']}");
      } else {
        turnover("{$_M[url][own_form]}a=doindex");
      }
    } else {
      turnover("{$_M[url][own_form]}a=doindex", $_M[word][dataerror]);
    }
  }

  /**
   * 新增内容插入数据处理
   * @param  前台提交的表单数组 $list
   * @return $pid  新增的ID 失败返回FALSE
   */
  public function insert_list($list) {
    global $_M;
    $list['addtime'] = $list['addtime'] ? $list['addtime'] : $list['updatetime'];
    if ($list['imgurl'] == '') {
      if (preg_match('/<img.*src=\\\\"(.*?)\\\\".*?>/i', $list['content'], $out)) {
        $imgurl = explode("upload/", $out[1]);
        if (count($imgurl) < 2) {
          $list['imgurl'] = $_M['config']['met_agents_img'];
        } else {
          $list['imgurl'] = '../upload/' . str_replace('watermark/', '', $imgurl[1]);
        }

      } else {
        $list['imgurl'] = $_M['config']['met_agents_img'];
      }
    }
    $list = $this->form_imglist($list, 2);

    $pid = $this->insert_list_sql($list);
    if ($pid) {
      return $pid;
    } else {
      return false;
    }
  }

  /**
   * 插入sql
   * @param  array   $list   插入的数组
   * @return number           插入后的数据ID
   */
  public function insert_list_sql($list) {
    global $_M;
    if (!$list['title']) {
      return false;
    }
    if (!$this->check_filename($list['filename'], '', $this->module)) {
      return false;
    }
    if ($list['links']) {
      $list['links'] = url_standard($list['links']);
    }
    if (!$list['description']) {
      $list['description'] = $this->description($list['content']);
    }

    // $query = "INSERT INTO {$this->tablename} SET
    //   title              = '{$list['title']}',
    //   ctitle             = '{$list['ctitle']}',
    //   keywords           = '{$list['keywords']}',
    //   description        = '{$list['description']}',
    //   content            = '{$list['content']}',
    //   class1             = '{$list['class1']}',
    //   class2             = '{$list['class2']}',
    //   class3             = '{$list['class3']}',
    //   imgurl             = '{$list['imgurl']}',
    //   imgurls            = '{$list['imgurls']}',
    //   com_ok             = '{$list['com_ok']}',
    //   wap_ok             = '{$list['wap_ok']}',
    //   issue              = '{$list['issue']}',
    //   hits               = '{$list['hits']}',
    //   addtime            = '{$list['addtime']}',
    //   updatetime         = '{$list['updatetime']}',
    //   access             = '{$list['access']}',
    //   filename           = '{$list['filename']}',
    //   no_order            = '{$list['no_order']}',
    //   lang               = '{$_M['lang']}',
    //   displaytype        = '{$list['displaytype']}',
    //   tag                = '{$list['tag']}',
    //   links              = '{$list['links']}',
    //   top_ok             = '{$list['top_ok']}'
    // ";
    // DB::query($query);
    // return DB::insert_id();
    $list['lang'] = $this->lang;
    return $this->database->update_by_id($list);
  }

  /**
   * ajax检测静态文件是否重名
   */
  function docheck_filename() {
    global $_M;
    if (!$this->moduleclass->check_filename($_M['form']['filename'], $_M['form']['id'], $this->module)) {
      $errorno = $this->moduleclass->errorno == 'error_filename_cha' ? $_M[word][js74] : $_M[word][js73];
      echo '0|' . $errorno;
    } else {
      echo '1|' . $_M[word][js75];
    }
  }

  /**
   * 编辑文章页面
   */
  function doeditor() {
    global $_M;
    nav::select_nav(1);
    $a = 'doeditorsave';
    $class1 = $_M[form][class1];
	$feedbackcfg= load::mod_class('feedback/feedback_handle','new')->get_feedback_config($class1);
    $met_fd_email=$feedbackcfg[met_fd_email][value];
    $id = $_M[form][id];
    $query = "UPDATE {$_M[table][feedback]} SET readok='1' WHERE id='{$_M['form']['id']}'";
    DB::query($query);
    $feedback_list = DB::get_one("select * from {$_M[table][feedback]} where id='$id' and class1 = '$class1'");
    $feedback_list['customerid'] = $feedback_list['customerid'] ? $feedback_list['customerid'] : $_M['word']['feedbackAccess0'];
    $query = "SELECT * FROM  {$_M[table][parameter]} where lang='{$this->lang}' and ((module='{$this->module}' and class1 = '0') or (module='{$this->module}' and class1 = '$class1')) order by no_order";
    $result = DB::query($query);
    $weburl = $_M[config][weburl];
    $parameter_database = load::mod_class('parameter/parameter_database', 'new');
    while ($list = DB::fetch_array($result)) {
        $info_list = DB::get_one("select * from {$_M[table][flist]} where listid='$id' and paraid='$list[id]' and lang='{$this->lang}'");
        $list[content] = $list[type] == 5 ? (($info_list[info] != '../upload/file/') ? "<a href='{$weburl}" . $info_list[info] . "' target='_blank'>{$_M[word][clickview]}</a>" : $_M[word][filenomor]) :$info_list[info];

      $feedback_para[] = $list;
    }
    $fnam = DB::get_one("SELECT * FROM {$_M[table][column]} WHERE id='$class1' and lang='{$this->lang}'");
    require $this->template('own/article_add');
  }

  /**
   * 修改保存页面
   * @param  array   $list   插入的数组
   * @return number           插入后的数据ID
   */
  function doeditorsave() {
    global $_M;

    $_M['form']['addtime'] = $_M['form']['addtype'] == 2 ? $_M['form']['addtime'] : date("Y-m-d H:i:s");
    if ($this->update_list($_M['form'], $_M['form']['id'])) {
        turnover("{$_M[url][own_form]}a=doindex");
    } else {
      turnover("{$_M[url][own_form]}a=doindex", $_M[word][dataerror]);
    }

  }

  /**
   * 保存修改
   * @param  array   $list   修改的数组
   * @return bool              修改是否成功
   */
  public function update_list($list, $id) {
    global $_M;
    //$list['updatetime'] = date("Y-m-d H:i:s");

    if ($list['imgurl'] == '') {
      if (preg_match('/<img.*?src=\\\\"(.*?)\\\\".*?>/i', $list['content'], $out)) {
        $imgurl = explode("upload/", $out[1]);
        $list['imgurl'] = '../upload/' . str_replace('watermark/', '', $imgurl[1]);
      }
    }

    $list = $this->form_imglist($list, 2);

    if ($this->update_list_sql($list, $id)) {
      return true;
    } else {
      return false;
    }

  }

  /**
   * 保存修改sql
   * @param  array   $list   修改的数组
   * @return bool              修改是否成功
   */
  public function update_list_sql($list, $id) {
    global $_M;
    $list['id'] = $id;
    return $this->database->update_by_id($list);
  }

  /**
   * 首页页面
   */
  function doindex() {
    global $_M;
    nav::select_nav(1);
    $column = $this->column(1, $this->module);
    $selectlist = $this->database->get_select_list($_M[form][class1]);
    if ($_M[form][ajax]) {
      $metinfo = '<select name="met_fd_export"  class="met_fd_export">
				   <option value="-1">' . $_M[word][feedbackTip4] . '</option>';

      foreach ($selectlist as $key => $val) {
        $metinfo .= '<option value="' . $val[info] . '">' . $val[info] . '</option>';
      }

      $metinfo .= '</select>';

      echo $metinfo;
      die;
    }
      $query = "select * from {$_M[table][feedback]} where lang='{$this->lang}' AND class1 = {$_M['form']['class1']}";
      $class = DB::get_one($query);
      $met_fd_showcol = DB::get_one("select * from {$_M[table][config]} where name='met_fd_showcol' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
      $met_fd_class = DB::get_one("select * from {$_M[table][config]} where name='met_fd_class' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
      $met_fd_showcol = explode('|', $met_fd_showcol['value']);
      $query = "SELECT * FROM {$_M[table][parameter]} where  lang='{$_M[form][lang]}' and ((module='{$this->module}' and class1='{$_M[form][class1]}') or (module='{$this->module}' and class1='0')) order by no_order";
      $result = DB::get_all($query);
      $showcol = array();
      $met_fd_related = load::mod_class('config/config_database','new')->get_value_by_classid($_M['form']['class1'],'met_fd_related');
      $parameter_handle = load::mod_class('parameter/parameter_handle','new');

      //循环显示列表项
      foreach ($met_fd_showcol as $paraid){
          foreach ($result as $val ){
              if($paraid==$val['id']){
                  //表单分类字段下拉列表
                  if($val['type'] == 2 || $val['type'] == 6){
                    if($met_fd_related == $val['id']){
                      // 如果有产品关联，筛选就用产品
                      $options = $parameter_handle->related_product($val['related']);
                    }else{
                       $options = jsondecode($val['options']);
                    }

                      $options_item = "<option value=''>{$_M['word']['cvall']}</option>";
                      foreach ($options as $item) {
                          $options_item .= "<option value='{$item['value']}'>{$item['value']}</option>";
                      }

                      $option_str = "<select name='para_{$val['id']}' data-table-search='1'>";
                      $option_str .= $options_item;
                      $option_str .= "</select>";
                      $val['name'] = $val['name'] ."&nbsp;&nbsp;&nbsp;". $option_str;

                      $showcol[] = $val;
                  }else{
                      $showcol[] = $val;
                  }
              }
          }
      }
      $colnum = count($showcol) + 4 ;
    $_M['url']['help_tutorials_helpid']='101#3、反馈信息管理';
    require $this->template('own/article_index');
  }

  /**
   * 栏目json
   */
  function docolumnjson() {
    global $_M;
    $this->column_json($this->module, $_M['form']['type']);
  }

  /**
   * 分页数据
   */
  function dojson_list() {
    global $_M;
    $parameter_database = load::mod_class('parameter/parameter_database', 'new');
    $lang = $_M[form][lang];
    $where = "lang='{$lang}' AND class1 = {$_M['form']['class1']} ";
    $met_fd_showcol = DB::get_one("select * from {$_M[table][config]} where name='met_fd_showcol' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
      if ($met_fd_showcol['value']) {
          $met_fd_showcol = explode('|', $met_fd_showcol['value']);
      }else{
          $met_fd_showcol = '';
      }
    $userlist = $this->json_list('', '');

      $class1 = $_M['form']['class1'];
      $class2 = $_M['form']['class2'];
      $class3 = $_M['form']['class3'];
      $keyword = $_M['form']['keyword'];
      $classify = $_M['form']['search_fd_class'];
      $class1 = $class1 == ' ' ? 'null' : $class1;
      $class2 = $class2 == ' ' ? 'null' : $class2;
      $class3 = $class3 == ' ' ? 'null' : $class3;
      #$where.= $class1&&$class1!='所有栏目'&&$class1!='null'?"and class1 = '{$class1}'":'';
      $where .= $class1 && $class1 != $_M[word][allcategory] && $class1 != 'null' ? "and class1 = '{$class1}'" : '';
      $where .= $class2 && $class2 != 'null' ? "and class2 = '{$class2}'" : '';
      $where .= $class3 && $class3 != 'null' ? "and class3 = '{$class3}'" : '';
      $where .= $keyword ? "and fdtitle like '%{$keyword}%'" : '';
      switch ($_M[form][search_type]) {
        case 0:break;
        case 1:
          $where .= "and readok = '0'";
          break;
        case 2:
          $where .= "and readok = '1'";
          break;
      }
      $where .= 'order by addtime desc';
      $result = $this->tabledata->getdata($_M[table][feedback], '*', $where);
      $parameters = $parameter_database->get_parameter($this->module,$class1,$class2,$class3);


      $query  ="SELECT * FROM {$_M[table][feedback]} WHERE class1={$class1} AND lang = '{$_M['lang']}' order by  addtime desc";
      $feedbacks = $this->tabledata->getdata($_M[table][feedback], '*', $where, '', $query);

      $is_select = 0;
      foreach ($feedbacks as $key =>$val) {
        $query = "SELECT * FROM {$_M['table']['flist']} WHERE listid = {$val['id']}";
        $flist = DB::get_all($query);
        $false = array();
        foreach ($flist as $f) {

            if($_M['form']['para_'.$f['paraid']] != $f['info'] && $_M['form']['para_'.$f['paraid']]){
                $false[] = $f;
            }

            if($_M['form']['keyword'] && !strstr($f['info'], $_M['form']['keyword'])){
                $false[] = $f;
            }
            if($_M['form']['para_'.$f['paraid']]){
                $is_select = 1;
            }
        }
        if(!$false){
            $res[] = $val;
        }
    }

    if($is_select){
        $result = $res;
    }

      // if ($_M['form']['search_fd_class']) {
      //     $met_fd_class = DB::get_one("select * from {$_M[table][config]} where name='met_fd_class' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
      //     $met_fd_class = $met_fd_class['value'];
      //     $search = "info = '{$_M['form']['search_fd_class']}' AND paraid = {$met_fd_class}";
      //     $query = "SELECT * FROM {$_M[table][flist]} WHERE {$search}";
      //     $res = DB::get_all($query);
      //     $insql = array();
      //     foreach ($res as $val) {
      //         $insql[] = $val['listid'];
      //     }
      //     $insql = implode(',', $insql);

      //     $query  ="SELECT * FROM {$_M[table][feedback]} WHERE id IN ({$insql}) order by addtime desc";

      //     $result = $this->tabledata->getdata($_M[table][feedback], '*', $where, '', $query);
      // }


    foreach ($result as $key => $list) {
      $list['customerid'] = $list['customerid'] == '0' ? $_M[word][feedbackAccess0] : $list['customerid'];
      if ($_M[config][met_member_use]) {
        switch ($list['access']) {
        case '1':$list['access'] = $_M[word][access1];
          break;
        case '2':$list['access'] = $_M[word][access2];
          break;
        case '3':$list['access'] = $_M[word][access3];
          break;
        default:$list['access'] = $_M[word][access0];
          break;
        }
      }
      $list[readok] = $list[readok] ? $_M[word][yes] : $_M[word][no];
      $feedback_list[] = $list;
    }
    $admininfo = admin_information();
    foreach ($feedback_list as $key => $val) {
      $val['url'] = $this->url($val, $this->module);
      if ($val[readok] == $_M[word][yes]) {
        $val['state'] = '<span class="label label-default">' . $_M[word][read] . '</span>';
      } else {
        $val['state'] = '<span class="label label-default">' . $_M[word][unread] . '</span>';
      }
        $list = array();
        $list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
        $list[] = $val['id'];
        $list[] = $val['state'];
        //$list[] = $val['fdtitle'];
        //$list[] = $val['readok'];
        //$list[] = $val['customerid'];

        if($_M['form']['class1']){
            foreach ($met_fd_showcol as $paraid) {
                $info_list = DB::get_one("select * from {$_M[table][flist]} where listid='{$val['id']}' and paraid='{$paraid}' and lang='{$this->lang}'");
                $list[] =$info_list['info'];
            }
        }

      $list[] = $val['addtime'];
      $list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&class1={$val['class1']}&class2={$val['class2']}&class3={$val['class3']}\" class=\"edit\">{$_M[word][View]}</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\">{$_M[word][delete]}</a>
			";
      $rarray[] = $list;
    }
    $this->json_return($rarray);

  }

  /**
   * 列表操作保存
   */
  function dolistsave() {
    global $_M;
    $list = explode(",", $_M['form']['allid']);
    foreach ($list as $id) {
      if ($id) {
        switch ($_M['form']['submit_type']) {
        case 'save':
          $list['no_order'] = $_M['form']['no_order-' . $id];
          $this->list_no_order($id, $list['no_order']);
          break;
        case 'del':
          $this->del_list($id, $_M['form']['recycle']);
          break;
        case 'comok':
          $this->list_com($id, 1);
          break;
        case 'comno':
          $this->list_com($id, 0);
          break;
        case 'topok':
          $this->list_top($id, 1);
          break;
        case 'topno':
          $this->list_top($id, 0);
          break;
        case 'displayok':
          $this->list_display($id, 1);
          break;
        case 'displayno':
          $this->list_display($id, 0);
          break;
        case 'move':
          $class = explode("-", $_M['form']['columnid']);
          $class1 = $class[0];
          $class2 = $class[1];
          $class3 = $class[2];
          $this->list_move($id, $class1, $class2, $class3);
          break;
        case 'copy':
          $class = explode("-", $_M['form']['columnid']);
          $class1 = $class[0];
          $class2 = $class[1];
          $class3 = $class[2];
          $newid = $this->list_copy($id, $class1, $class2, $class3);
          break;
        }
      }
    }
    if ($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0) {
      turnover("./content/article/save.php?lang={$_M['lang']}&action=html");
    } else {
      turnover("{$_M[url][own_form]}a=doindex");
    }

  }

  /*复制*/
  public function list_copy($id, $class1, $class2, $class3) {
    global $_M;
    $list = $this->database->get_list_one_by_id($id);
    $list['filename'] = '';
    $list['class1'] = $class1;
    $list['class2'] = $class2;
    $list['class3'] = $class3;
    $list['updatetime'] = date("Y-m-d H:i:s");
    $list['addtime'] = date("Y-m-d H:i:s");
    $list['content'] = str_replace('\'', '\'\'', $list['content']);
    return $this->insert_list_sql($list);
  }

  /*移动产品*/
  public function list_move($id, $class1, $class2, $class3) {
    $list['id'] = $id;
    $list['$class1'] = $class1;
    $list['$class2'] = $class2;
    $list['$class3'] = $class3;
    return $this->database->update_by_id($list);
  }

  /*修改排序*/
  public function list_no_order($id, $no_order) {
    $list['id'] = $id;
    $list['no_order'] = $no_order;
    return $this->database->update_by_id($list);
  }

  /*上架下架*/
  public function list_display($id, $display) {
    $list['id'] = $id;
    $list['displaytype'] = $display;
    return $this->database->update_by_id($list);
  }

  /*置顶*/
  public function list_top($id, $top) {
    $list['id'] = $id;
    $list['top_ok'] = $top;
    return $this->database->update_by_id($list);
  }

  /*推荐*/
  public function list_com($id, $com) {
    $list['id'] = $id;
    $list['com_ok'] = $com;
    return $this->database->update_by_id($list);
  }

  /*删除*/
  public function del_list($id, $recycle) {
    global $_M;
    if ($recycle) {
      $list['id'] = $id;
      $list['recycle'] = 2;
      return $this->database->update_by_id($list);
    } else {
      if ($this->database->del_by_id($id) && $this->database->del_flist_by_id($id)) {
        return true;
      } else {
        return false;
      }
    }
  }

  /*保存配置*/
  public function dosaveinc() {
    global $_M;
    // $_M['form']['met_fd_showcol'] = implode('|', $_M['form']['met_fd_showcol']);

    $list = $_M[form];
    $query = "select * from {$_M[table][config]} where (lang ='{$this->lang}' or lang ='metinfo') and columnid='{$_M[form][class1]}'";
    $res = DB::get_all($query);
    foreach ($res as $key => $value) {

      if ($value['value'] != $_M[form][$value['name']] && isset($_M[form][$value['name']])) {
        $query = "UPDATE {$_M[table][config]} SET value='{$_M[form][$value['name']]}' WHERE name='{$value['name']}' and columnid='{$_M[form][class1]}' and lang='{$_M[lang]}'";
        DB::query($query);
      }elseif($value['name']=='met_fd_showcol'){
          $query = "UPDATE {$_M[table][config]} SET value='{$_M[form][$value['name']]}' WHERE name='{$value['name']}' and columnid='{$_M[form][class1]}' and lang='{$_M[lang]}'";
          DB::query($query);
      }
		}

    if($_M['form']['met_fd_related']){
        $query = "UPDATE {$_M['table']['parameter']} SET related = '' WHERE id != {$_M['form']['met_fd_related']} AND lang = '{$_M['lang']}' AND module = 8";
        DB::query($query);
    }


		$query = "UPDATE {$_M['table']['list']} SET info = '{$_M['form']['metlistrele']}' WHERE bigid='{$_M[form][class1]}' AND no_order='99999' AND lang='{$_M['lang']}'";
		DB::query($query);

    turnover("{$_M[url][own_form]}a=dosyset&class1={$_M[form][class1]}", '');
  }

  /*系统参数设置*/

  public function dosyset() {
    global $_M;
    nav::select_nav(3);
    $fnam = DB::get_one("SELECT * FROM {$_M[table][column]} WHERE id='{$_M[form][class1]}' and lang='{$_M[form][lang]}' ");
    $query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
    $result = DB::query($query);
    while ($list_config = DB::fetch_array($result)) {
      $settings_arr[] = $list_config;
      $_M[config][$list_config['name']] = $list_config['value'];
      if ($metinfoadminok) {
        $list_config['value'] = str_replace('"', '&#34;', str_replace("'", '&#39;', $list_config['value']));
      }

    }

    $met_fd_back = DB::get_one("select * from {$_M[table][config]} where name='met_fd_back' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_back] = $met_fd_back[value];
    $met_fd_ok = DB::get_one("select * from {$_M[table][config]} where name='met_fd_ok' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_ok] = $met_fd_ok[value];
    $met_fd_type = DB::get_one("select * from {$_M[table][config]} where name='met_fd_type' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_type] = $met_fd_type[value];
    $met_fd_sms_back = DB::get_one("select * from {$_M[table][config]} where name='met_fd_sms_back' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $met_fd_showcol = DB::get_one("select * from {$_M[table][config]} where name='met_fd_showcol' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $met_fd_inquiry = DB::get_one("select * from {$_M[table][config]} where name='met_fd_inquiry' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_sms_back] = $met_fd_sms_back[value];
    $met_sms_back = DB::get_one("select * from {$_M[table][config]} where name='met_sms_back' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_sms_back] = $met_sms_back[value];
    $met_fd_class = DB::get_one("select * from {$_M[table][config]} where name='met_fd_class' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
      $met_fd_class = DB::get_one("select * from {$_M[table][config]} where name='met_fd_related' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
      $met_fd_related = $met_fd_class['value'];

    $met_fd_class=$met_fd_class[value];
    // $met_fd_inquiry1 = $_M[config][met_fd_inquiry] ? "checked='checked'" : "";
    $met_fd_back1 = ($_M[config][met_fd_back]) ? "checked='checked'" : "";
    $met_fd_ok1[$_M[config][met_fd_ok]] = "checked='checked'";
    $met_fd_type1[$_M[config][met_fd_type]] = "checked=checked";
    $met_fd_sms_back1 = ($_M[config][met_fd_sms_back]) ? "checked='checked'" : "";
    $met_sms_back1 = ($_M[config][met_sms_back]) ? "checked='checked'" : "";
    $_met_fd_content = DB::get_one("select * from {$_M[table][config]} where name='met_fd_content' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_content] = $_met_fd_content[value];
    $_met_fd_title = DB::get_one("select * from {$_M[table][config]} where name='met_fd_title' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_title] = $_met_fd_title[value];
    $_met_fd_to = DB::get_one("select * from {$_M[table][config]} where name='met_fd_to' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_to] = $_met_fd_to[value];
    $_met_fd_sms_content = DB::get_one("select * from {$_M[table][config]} where name='met_fd_sms_content' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
    $_M[config][met_fd_sms_content] = $_met_fd_sms_content[value];
    foreach ($settings_arr as $key => $val) {
      if ($val['columnid'] == $fnam['id']) {
        ${$val['name']} = $val['value'];
      }

    }
    // $met_fd_showcol = explode( '|',$met_fd_showcol);
    $query = "select * from {$_M[table][column]} where id={$_M[form][class1]} and lang='{$_M[form][lang]}'";
    $columnna = DB::get_one($query);
    $columnname = $columnna[name];

    $query = "SELECT * FROM {$_M[table][parameter]} where  lang='{$_M[form][lang]}' and ((module='{$this->module}' and class1='{$_M[form][class1]}') or (module='{$this->module}' and class1='0')) order by no_order";
    $result = DB::get_all($query);
    $fbcol = $result;

      foreach ($result as $list) {
          $fd_para[$list[type]][] = $list;
          //信息分類字段
          if ($list[type] == 2|| $list[type] == 4 || $list[type] == 6) {
              $fd_paraall[] = $list;
          }
          //关联产品字段
          if ($list[type] == 2 || $list[type] == 4 || $list[type] == 6) {
              $fd_related[] = $list;
          }
      }

    if ($columnname) {
      $fdname = $columnname . $_M[word][syssetting];
    } else {
      $fdname = $_M[word][fdincTitle];
		}

		$query = "SELECT * FROM {$_M['table']['list']} WHERE bigid='{$_M[form][class1]}' AND no_order='99999' AND lang='{$_M['lang']}'";
		$metlistrele = DB::get_one($query);
		if(!$metlistrele['id']){
			$query = "INSERT INTO {$_M['table']['list']} SET bigid='{$_M[form][class1]}', info='0', no_order='99999',lang='{$_M['lang']}'";
			DB::query($query);
			$metlistrele = '0';
		}else{
			$metlistrele = $metlistrele['info'];
		}
    $_M['url']['help_tutorials_helpid']='101#2、反馈系统设置';
    $met_fd_inquiry = intval($met_fd_inquiry);
    require $this->template('own/set');
  }

  /*导出EXCEL表*/
  public function doexport() {
    global $_M;
    $class1 = $_M[form][class1];
    $met_fd_export = $_M[form][met_fd_export];
    $query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
    $result = DB::query($query);
    while ($list_config = DB::fetch_array($result)) {
      $settings_arr[] = $list_config;
      $_M[config][$list_config['name']] = $list_config['value'];
      if ($metinfoadminok) {
        $list_config['value'] = str_replace('"', '&#34;', str_replace("'", '&#39;', $list_config['value']));
      }

    }
    foreach ($settings_arr as $key => $val) {
      if ($val['columnid'] == $class1) {
        $tingname = $val['name'] . '_' . $val['columnid'];
        $$val['name'] = $$tingname;
      }
    }
    $query = "SELECT * FROM {$_M[table][parameter]} where module='{$this->module}' and lang='{$this->lang}' order by no_order";
      if ($_M['form']['custom']) {
          $met_fd_showcol = DB::get_one("select * from {$_M[table][config]} where name='met_fd_showcol' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
          $met_fd_showcol = str_replace('|',',', $met_fd_showcol['value']);
          $query = "SELECT * FROM {$_M[table][parameter]} where module='{$this->module}' and lang='{$this->lang}' and id in($met_fd_showcol) order by no_order";
      }
    $result = DB::query($query);
    while ($list = DB::fetch_array($result)) {
      $feedbackpara[$list['id']] = $list;
      $feedback_para[] = $list;
    }
    $query = "SELECT * FROM {$_M[table][flist]} where module='{$this->module}' and lang='{$this->lang}'";
    $result = DB::query($query);
    while ($list = DB::fetch_array($result)) {
      if ($feedbackpara[$list['paraid']]['type'] == 5 and $list[info] != "") {
        $list[info] = str_replace('../', '', $list[info]);
        $list[info] = $_M[config][met_weburl] . $list[info];
      }
      $paravalue[$list[listid]][$list[paraid]] = $list;
    }

    if ($class1) {
      $where .= "AND class1='$class1'";
    }

    if ($met_fd_export == -1) {
      $where = " ";
    } else {
      $feedcfg = DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}'and name='met_fd_class' and columnid ='{$_M[form][class1]}'");
      $_M[config][met_fd_class] = $feedcfg[value];
      $where = "and exists(select info from {$_M[table][flist]} where listid={$_M[table][feedback]}.id and paraid='{$_M[config][met_fd_class]}' and info='$met_fd_export')";
    }
    if ($_M['form']['check_id'] != "") {
      $where .= " AND id in ({$_M['form']['check_id']})";
    }
    $query = "SELECT * FROM {$_M[table][feedback]} where lang='{$this->lang}' " . $where;
    $result = DB::query($query);
    while ($list = DB::fetch_array($result)) {
      $list['customerid'] = $list['customerid'] == '0' ? $_M[word][feedbackAccess0] : $list['customerid'];
      foreach ($feedback_para as $key => $val) {
        $para = 'para' . $val[id];
        $list[$para] = $paravalue[$list[id]][$val[id]][info];
      }
      $feedback_list[] = $list;
    }

    /*set xls*/

   if($_M['form']['custom']){
       $column = array("");
       $param = array();
       foreach ($feedback_para as $key => $val) {
           $column[] = $val['name'];
           $param[] = "para" . $val[id];
       }
   }else{
       $column = array("", $_M[word][fdeditorInterest]);
       $param = array('fdtitle');
       foreach ($feedback_para as $key => $val) {
           $column[] = $val['name'];
           $param[] = "para" . $val[id];
       }
       $column[] = $_M[word][fdeditorTime];
       $column[] = $_M[word][fdeditorFrom];
       $column[] = $_M[word][feedbackID];
       $column[] = $_M[word][fdeditorRecord];
       $param[] = 'addtime';
       $param[] = 'fromurl';
       $param[] = 'customerid';
       $param[] = 'useinfo';
   }
    //$xls=new PHP_XLS();
    $this->xls->AddSheet($_M[word][editor]);
    $this->xls->NewStyle('hd_t');

    $this->xls->StyleSetFont(0, 10, 0, 1, 0, 0);

    $this->xls->StyleSetAlignment(0, 0);
    $this->xls->StyleAddBorder("Top", '#000000', 2);
    $this->xls->StyleAddBorder("Right", '#000000', 1);

    $this->xls->CopyStyle('hd_t', 'hd_l');
    $this->xls->StyleAddBorder("Left", '#000000', 2);

    $this->xls->CopyStyle('hd_t', 'hd_r');
    $this->xls->StyleAddBorder("Right", '#000000', 2);

    $this->xls->SetRowHeight(1, 30);

    for ($i = 1; $i < count($column); $i++) {
      $this->xls->SetColWidth($i, 80);
    }

    $this->xls->SetActiveStyle('hd_l');
    $this->xls->SetActiveStyle('hd_t');
    $this->xls->SetActiveStyle('hd_r');
    for ($i = 1; $i < count($column); $i++) {
      $this->xls->Textc(1, $i, $column[$i]);
    }

    $this->xls->NewStyle('center');
    $this->xls->StyleSetAlignment(0, 0);
    $this->xls->StyleAddBorder("Top", '#000000', 1);
    $this->xls->StyleAddBorder("Right", '#000000', 1);

    $this->xls->CopyStyle('center', 'center_l');
    $this->xls->StyleAddBorder("Left", '#000000', 2);

    $this->xls->CopyStyle('center', 'center_r');
    $this->xls->StyleAddBorder("Right", '#000000', 2);

    /*get feedback infomation *export xls */

    for ($i = 0; $i < count($feedback_list); $i++) {

      for ($j = 0; $j < count($column) - 1; $j++) {
        $this->xls->SetActiveStyle('center');
        $this->xls->Textc($i + 2, $j + 1, $feedback_list[$i][$param[$j]]);
      }
    }
    $feedname = DB::get_one("SELECT name FROM {$_M[table][column]} WHERE id=$class1");
    if ($feedname) {
      $excelname = $feedname['name'];
    } else {
      $excelname = $_M[word][allcategory];
    }
    $this->xls->Output($excelname . ".xls");

  }
  public function doreplyemail(){
    global $_M;
   require $this->template('own/replyemail');
  }

  public function dosendemail(){
    global $_M;
    $mail=load::sys_class('jmail','new');
    $_M[form][contents]=str_replace('\\', '', $_M[form][contents]);
    $time="<p>".$_M['word']['feedbackrinfotime'].date('Y-m-d H:i:s')."</p>";
    $title=$_M['word']['feedbackrinfotitle'].$_M[form][title];
    $query="select * from {$_M[table][feedback]} where id={$_M[form][id]}";
    $feedbackinfo=DB::get_one($query);
    $contentinfo=$feedbackinfo['useinfo'];
    $content='<p>'.$_M['word']['feedbackrinfocontent'].$_M[word][marks].$_M[form][contents];
    $content=str_replace($_M[word][setbasicmainbody].$_M[word][marks],'',$content);
    $useinfo=$title.$content.$time."<br>".$contentinfo;
    $query="update {$_M[table][feedback]} set useinfo='$useinfo' where id={$_M[form][id]}";
    DB::query($query);
    $mail->send_email($_M[form][addressee],$_M[form][title],$_M[form][contents]);
    turnover("{$_M[url][own_form]}a=doeditor&id={$_M[form][id]}&class1={$_M[form][class1]}&class2={$_M[form][class2]}&class3={$_M[form][class3]}",'');
  }

}; # This program is an open source system, commercial use, please consciously to purchase commercial license.; # Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
