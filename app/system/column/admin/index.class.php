<?php
defined('IN_MET') or exit('No permission');
load::sys_class('admin');
load::sys_func('file');

class index extends admin {
  public function __construct() {
    global $_M;
    parent::__construct();
    $this->database = load::mod_class('column/class/column_database', 'new');
  }

  public function doindex() {
    global $_M;
    $met_langok = load::mod_class('language/language_op', 'new')->get_lang();
    //$array = column_sorting(2);

    $met_class1 = $met_class1x;
    $met_class2 = $met_class2x;
    $met_class3 = $met_class3x;
    $_M['url']['help_tutorials_helpid']='91';
    require_once $this->template('own/index');
  }

  /**
   * 分页数据
   */
  function dojson_list(){
    global $_M;
    $array = load::mod_class('column/column_op', 'new')->get_sorting_by_lv();
    $met_class1 = $array['class1'];
    $met_class2 = $array['class2'];
    $met_class3 = $array['class3'];
    $img_url = "{$_M[url][site_admin]}/templates/met/images/";
    $column_lv = array();
    foreach ($met_class1 as $key => $val) {
      $columnlist[$key] = $this->handle_show_column($val);
      $column_lv[$val['id']] = 1;
      /*二级栏目处理*/
      foreach ($met_class2[$val['id']] as $key2 => $val2) {
        $columnlist[$key2] = $this->handle_show_column($val2);
        $columnlist[$key]['html'] = $this->lv_html(1, 1, $val['id']);
        $columnlist[$key2]['html'] = $this->lv_html(2, 0, $val2['id']);
        if(!$val2['releclass'] && $column_lv[$val['id']] && $column_lv[$val['id']] < 2){//一级栏目深度
          $column_lv[$val['id']] = 2;
        }
        /*三级栏目处理*/
        foreach ($met_class3[$val2['id']] as $key3 => $val3) {
          $columnlist[$key3] = $this->handle_show_column($val3);
          $columnlist[$key2]['html'] = $this->lv_html(2, 1, $val2['id']);
          $columnlist[$key3]['html'] = $this->lv_html(3, 0, $val3['id']);
          if (!$val2['releclass'] && $column_lv[$val['id']] && $column_lv[$val['id']] < 3) {//一级栏目深度
            $column_lv[$val['id']] = 3;
          }
          $column_lv_2[$val2['id']] = 1;//二级栏目有下级栏目
        }
      }
    }
    foreach($columnlist as $key=>$val){
      $list = array();
      $list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\"><input class=\"bigid\" type=\"hidden\" value=\"{$val['bigclass']}\">";
      $list[] = "<input name=\"no_order-{$val['id']}\" type=\"text\" class=\"ui-input text-center no_order\" value=\"{$val['no_order']}\">";
      $list[] = $val['html']."<input name=\"name-{$val['id']}\" type=\"text\" class=\"ui-input\" value=\"{$val['name']}\" >";
      $list[] = "<select name=\"nav-{$val['id']}\" data-checked=\"{$val['nav']}\">
        <option value='0'>{$_M[word][columnnav1]}</option>
        <option value='1'>{$_M[word][columnnav2]}</option>
        <option value='2'>{$_M[word][columnnav3]}</option>
        <option value='3'>{$_M[word][columnnav4]}</option>
      </select>";
      $list[] = $this->module($val['module']);
      $list[] = "<div class=\"max-150\">".$val['foldername']."</div>";
      $list[] = "<input name=\"index_num-{$val['id']}\" type=\"text\" class=\"ui-input text-center no_order\" value=\"{$val['index_num']}\">";
      // ";
      $str = '';
      $str .= "
        <div>
        <span class=\"padding-right-5\">
        <a class=\"btn m-b-5\" href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&select_class1={$class1}&select_class2={$class2}&select_class3={$class3}\" class=\"edit\">
        {$_M[word][unitytxt_39]}</a>
        </span>
        <span class=\"padding-right-5 dropdown\">
         <a role=\"button\" class=\"btn m-b-5 dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\" data-hover=\"dropdown\">
            {$_M[word][columnmore]}&nbsp;<span class=\"caret\"></a>
        <ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">
      ";
      if($val['classtype'] !=3 && $val['module'] > 0 && $val['module'] <= 5){//可以添加下级栏目
        $str .= "
            <li><a class=\"m-b-5\" data-add-cloumn=\"{$_M[url][own_form]}a=doadd&bigclass={$val['id']}\" href=\"javascript:;\" data-toggle=\"popover\" class=\"delet\">
              {$_M[word][add]}</a>
            </li>
        ";
      }
      if(!($column_lv[$val['id']] == 3 && $val['classtype'])){
        $str .= "
            <li class=\"met-tool dropdown-submenu\">
              <a id=\"move123-{$val['id']}\" role=\"button\" class=\"m-b-5\"  aria-expanded=\"false\">
              {$_M[word][columnmove1]}&nbsp;<span class=\"caret\"></a>
              <ul class=\"dropdown-menu dropdown-menu-left\" role=\"menu\">
        ";
        if($val['classtype'] != 1){//可以升级顶级栏目
          if($val['releclass']){
            $str .= "<li><a href=\"{$_M[url][own_form]}a=domove&uplv=1&nowid={$val['id']}\">{$_M[word][columnerr7]}</a></li>";
          }else{
            $str .= "<li><a class=\"up\" href=\"javascript:;\" data-nowid=\"{$val['id']}\">{$_M[word][columnerr7]}</a></li>";
          }
        }
        if($val['classtype'] == 1){//一级栏目移动
          foreach ($met_class1 as $ckey => $cval) {
            if($cval['module'] > 0 && $cval['module'] <= 5 && $cval['id'] != $val['id']){
              $str .= "<li class=\"met-tool-list\"><a href=\"{$_M[url][own_form]}a=domove&nowid={$val['id']}&toid={$cval['id']}\">{$cval['name']}</a></li>";
              if($cval['moduel'] == $val['module']){
                foreach ($met_class2[$cval['id']] as $c2key => $c2val) {
                  $str .= "<li class=\"met-tool-list\"><a href=\"{$_M[url][own_form]}a=domove&nowid={$val['id']}&toid={$c2val['id']}\">--{$c2val['name']}</a></li>";
                }
              }
            }
          }
        }else{
          //后续细化2，3级栏目的跨栏目移动
          //2级栏目同栏目移动
          foreach ($met_class1 as $ckey => $cval) {
            if($cval['module'] > 0 && $cval['module'] <= 5 && ($cval['module'] == $val['module'] || $val['module'] >5) ) {
              if($cval['id'] == $val['bigclass'] ){//不移动到自己当前的一级栏目
                $str .= "<li class=\"met-tool-list\"><a href=\"javascript:;\">{$cval['name']}</a></li>";
              }else{
                $str .= "<li class=\"met-tool-list\"><a href=\"{$_M[url][own_form]}a=domove&nowid={$val['id']}&toid={$cval['id']}\">{$cval['name']}</a></li>";
              }
              if( ($val['classtype'] == 3 || !$column_lv_2[$val['id']]) && $val['module'] < 5){
                foreach ($met_class2[$cval['id']] as $c2key => $c2val) {
                  if($c2val['id'] != $val['id'] && $c2val['module'] == $val['module']){
                    $str .= "<li class=\"met-tool-list\"><a href=\"{$_M[url][own_form]}a=domove&nowid={$val['id']}&toid={$c2val['id']}\">--{$c2val['name']}</a></li>";
                  }
                }
              }
            }
          }
        }
        $str .= "
              </ul>
            </li>
        ";
      }
      $str .= "
          <li class=\"\">
            <a class=\"m-b-5\" href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\" data-confirm=\"{$_M['word']['js7']}</br>{$_M['word']['jsx39']}\">
              {$_M[word][delete]}</a>
          </li>
          </span>
        </div>
      ";
      $list[] = $str;
      $rarray[] = $list;
    }
    $this->database->table_json_list();
    $this->database->table_return($rarray);

  }

  public function handle_show_column($c){
    global $_M;
    if ($c['if_in'] && $c['module'] < 1000) {
      $c['foldername'] = $c['out_url'];
    }
    $c['name'] = str_replace('"', '&#34;', str_replace("'", '&#39;', $c['name']));
    return $c;
  }

  public function lv_html($classtype, $next, $myid){
    global $_M;
    $class1info = "<span class=\"next-column\" data-my-id=\"{$myid}\" data-status=\"0\"><i class=\"fa fa-caret-right\"></i></span>";
    $class2info = "<div class=\"min-input\"><span class=\"w40\"></span>";
    $class2info_next = "
    <div class=\"min-input\">
    <span class=\"w40\"></span>
    <span class=\"next-column\" data-my-id=\"{$myid}\" data-status=\"0\"><i class=\"fa fa-caret-right\"></i></span>
    ";
    $class3info = "<div class=\"min-input\"><span class=\"w80\"></span>";
    if($classtype == 1){
      if($next == 1){
        return $class1info;
      }else{
        return "";
      }
    }
    if($classtype == 2){
      if($next == 1){
        return $class2info_next;
      }else{
        return $class2info;
      }
    }
    if($classtype == 3){
      return $class3info;
    }
    return $c;
  }

  /*栏目添加*/
  public function doadd() {
    global $_M;
    $id = 'new-'.$_M[form][ai];
    $bigclass = $this->database->get_column_by_id($_M['form']['bigclass']);
    $b = $_M['form']['bigclass'];
    $moduelist = $this->module_list();
    $smodule = load::mod_class('column/column_op', 'new')->get_sorting_by_module(false, $langval['mark']);

    if(!$bigclass['classtype'] == 3){
      $hide = "";
    }else{
      $foldername .= "<span id=\"span-{$id}\">{$bigclass['foldername']}</span>";
      $hide = "style=\"display:none;\"";
    }
    // if($bigclass['foldername'] && $bigclass['bigclass']){
    //   $hide = "";
    // }else{

    // }

    $foldername .= "
    <input name=\"foldername-{$id}\" type=\"text\" class=\"ui-input text-center\" value=\"{$bigclass['foldername']}\" {$hide}>
    <input name=\"out_url-{$id}\" type=\"text\" class=\"ui-input text-center\" value=\"\" style=\"display:none;\">
    ";
    if($bigclass['classtype'] == 1 && !$bigclass['bigclass']){
    $columntype.="<div class=\"min-input\"><span class=\"w40\"></span>";
    }elseif($bigclass['classtype'] == 2){
    $columntype.="<div class=\"min-input\"><span class=\"w80\"></span>";
    }
    foreach($moduelist as $key=>$val){
      $foldername_class = "b_foldername";
      switch ($key) {
        case '0':
          $option .= "<option value=\"{$key}\">{$val}</option>";
          break;
        case '1':
          if(!$b || $bigclass['module'] == 1 || ($bigclass['module']>=1 && $bigclass['module']<=5 && $bigclass['classtype'] == 1)){
            $option .= "<option value=\"{$key}\" >{$val}</option>";
          }
          break;
        case '2':
          if(!$b || $bigclass['module'] == 2|| ($bigclass['module']>=1 && $bigclass['module']<=5 && $bigclass['classtype'] == 1)){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '3':
          if(!$b || $bigclass['module'] == 3|| ($bigclass['module']>=1 && $bigclass['module']<=5 && $bigclass['classtype'] == 1)){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '4':
          if(!$b || $bigclass['module'] == 4|| ($bigclass['module']>=1 && $bigclass['module']<=5 && $bigclass['classtype'] == 1)){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '5';
          if(!$b || $bigclass['module'] == 5|| ($bigclass['module']>=1 && $bigclass['module']<=5 && $bigclass['classtype'] == 1)){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '6':
          if($bigclass['classtype']!=2 && !$smodule[6]){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '7':
          if($bigclass['classtype']!=2 && !$smodule[7]){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '8':
          if($bigclass['classtype']!=2){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '9':
            // if(!$b && !$smodule[9]){
            //   $option .= "<option value=\"{$key}\">{$val}</option>";
            // }
          break;
        case '10':
          if($bigclass['classtype']!=2 && !$smodule[10]){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '11':
          if($bigclass['classtype']!=2 && !$smodule[11]){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        case '12':
          if($bigclass['classtype']!=2 && !$smodule[12]){
            $option .= "<option value=\"{$key}\">{$val}</option>";
          }
          break;
        default :
          $option .= "<option value=\"{$key}\">{$val}</option>";
          break;
        }
    }
    $metinfo ="<tr class=\"even newlist\">
          <td class=\"met-center\">
            <input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked>
            <input name=\"bigclass-{$id}\" type=\"hidden\" value=\"{$_M['form']['bigclass']}\" checked>
          </td>
          <td><input name=\"no_order-{$id}\" type=\"text\" class=\"ui-input text-center\" value=\"0\"></td>
          <td>{$columntype}<input name=\"name-{$id}\" type=\"text\" class=\"ui-input\" value=\"\"></td>
          <td>
            <select name=\"nav-{$id}\">
              <option value='0'>{$_M[word][columnnav1]}</option>
              <option value='1'>{$_M[word][columnnav2]}</option>
              <option value='2'>{$_M[word][columnnav3]}</option>
              <option value='3'>{$_M[word][columnnav4]}</option>
            </select>
          </td>
          <td>
            <select name=\"module-{$id}\" class=\"module-select\" data-checked=\"{$bigclass['module']}\" data-id=\"{$id}\" >
            {$option}
            </select>
          </td>
          <td class=\"met-center\">
            {$foldername}
          </td>
          <td>
            <input name=\"index_num-{$id}\" type=\"text\" class=\"ui-input text-center\" value=\"0\">
          </td>
          <td><a href=\"\" class=\"delet btn\">{$_M['word']['js49']}</a></td>
        </tr>";
    echo $metinfo;
  }

  public function module_list() {
    global $_M;
    $array[1] = $_M['word']['mod1'];
    $array[2] = $_M['word']['mod2'];
    $array[3] = $_M['word']['mod3'];
    $array[4] = $_M['word']['mod4'];
    $array[5] = $_M['word']['mod5'];
    $array[6] = $_M['word']['mod6'];
    $array[7] = $_M['word']['mod7'];
    $array[8] = $_M['word']['mod8'];
    $array[9] = $_M['word']['mod9'];
    $array[10] = $_M['word']['mod10'];
    $array[11] = $_M['word']['mod11'];
    $array[12] = $_M['word']['mod12'];
    $array[0] = $_M['word']['modout'];
    // $array[100] = $_M['word']['mod101'];
    // $array[101] = $_M['word']['mod102'];
    $ifcolumn = load::mod_class('column/ifcolumn_database', 'new')->get_all();
    foreach($ifcolumn as $key=>$val){
      $array[$val['no']] = $val['name'];
    }
    return $array;
  }
  public function doeditor() {
    global $_M;

    //YTODO:测试时使用，上线前提取出来
    $query = "ALTER TABLE `{$_M['table']['column']}` ADD COLUMN `nofollow`  varchar(100) NULL DEFAULT NULL";
    DB::query($query);

    $column_list = $this->database->get_list_one_by_id($_M['form']['id']);
    $column_list['new_windows'] = $column_list['new_windows'] ? 1 : 0;
    $access = $this->access_option('access', $column_list['access']);
    $column_list['list_order'] = $column_list['list_order'] ? $column_list['list_order'] : 1;
    $_M['url']['help_tutorials_helpid']='90';
    require_once $this->template('own/editor');
  }

  //编辑页面保存
  public function doeditorsave() {
    global $_M;
    $list['id'] = $_M['form']['id'];
    $list['name'] = $_M['form']['name'];
    $list['no_order'] = $_M['form']['no_order'];
    $list['nav'] = $_M['form']['nav'];
    $list['new_windows'] = $_M['form']['new_windows'];
    $list['isshow'] = $_M['form']['isshow'];
    $list['wap_ok'] = $_M['form']['wap_ok'];
    $list['ctitle'] = $_M['form']['ctitle'];
    $list['keywords'] = $_M['form']['keywords'];
    $list['description'] = $_M['form']['description'];
    if(isset($_M['form']['content']))$list['content'] = $_M['form']['content'];
    $list['filename'] = $_M['form']['filename'];
    $list['index_num'] = $_M['form']['index_num'];
    $list['namemark'] = $_M['form']['namemark'];
    $list['indeximg'] = $_M['form']['indeximg'];
    $list['filename'] = $_M['form']['filename'];
    $list['outside_img'] = $_M['form']['outside_img'];
    $list['imgsizes'] = $_M['form']['imgsizes'];
    $list['columnimg'] = $_M['form']['columnimg'];
    $list['access'] = $_M['form']['access'];
    $list['display'] = $_M['form']['display'];
    $list['icon'] = $_M['form']['icon'];
    $list['out_url'] = $_M['form']['out_url'];
    $list['list_order'] = $_M['form']['list_order'];
    $list['nofollow'] = $_M['form']['nofollow'];

    if($list['filename']){
      $filenames = $this->database->get_column_by_filename($list['filename']);
      if($filenames && $filenames['id'] != $list['id']){
        turnover("{$_M[url][own_form]}&a=doeditor&id={$list['id']}", $_M['word']['jsx27'],0);

      }
    }

    $this->database->update_by_id($list);
    turnover("{$_M[url][own_form]}&a=doindex");
  }

  public function list_editor($id, $list){
    global $_M;
    $alist['id'] = $id;
    $alist['name'] = $list['name-'.$id];
    $alist['no_order'] = $list['no_order-'.$id];
    $alist['nav'] = $list['nav-'.$id];
    $alist['index_num'] = $list['index_num-'.$id];
    $this->database->update_by_id($alist);
  }

  public function list_add($id, $list){
    global $_M;;
    //$list['id'] = $id;
    $if_in = $_M['form']['module-'.$id] ? 0 : 1;
    $bigclass = $this->database->get_column_by_id($_M['form']['bigclass-'.$id]);
    if($bigclass){
      $classtype = $bigclass['classtype'] + 1;
      $releclass = $bigclass['module'] == $_M['form']['module-'.$id] ? 0 : $list['bigclass-'.$id];
    }else{
      $classtype = 1;
      $releclass = 0;
    }
    $alist['name'] = $list['name-'.$id];
    if(!trim($alist['name'])){
      turnover("{$_M[url][own_form]}&a=doindex", "{$_M[word][column_descript1_v6]}",0);
    }
    $mod = load::sys_class('handle', 'new')->file_to_mod($_M['form']['foldername-'.$id]);

    if($mod && $mod!=$_M['form']['module-'.$id]){
      turnover("{$_M[url][own_form]}&a=doindex", "{$_M['word']['columndeffflor']}",0);
    }
    if($bigclass['module'] == $_M['form']['module-'.$id]){
      $alist['foldername'] = $bigclass['foldername'];
    }else{
        //验证模块是否可以用
        if(!$if_in){
            #die($_M['form']['foldername-' . $id]);
            if(!$this->is_foldername_ok($_M['form']['foldername-'.$id], $_M['form']['module-'.$id])){
                turnover("{$_M[url][own_form]}&a=doindex", "{$_M[word][column_descript1_v6]}",0);
        }
      }
      $alist['foldername'] = $list['foldername-'.$id];
    }
    $alist['filename'] = '';
    $alist['bigclass'] = $list['bigclass-'.$id];
    $alist['samefile'] = 0;
    $alist['module'] = $list['module-'.$id];
    $alist['no_order'] = $list['no_order-'.$id];
    $alist['wap_ok'] = 0;
    $alist['wap_nav_ok'] = 0;
    $alist['if_in'] = $if_in;
    $alist['nav'] = $list['nav-'.$id];
    $alist['ctitle'] = '';
    $alist['keywords'] = '';
    $alist['content'] = '';
    $alist['description'] = '';
    $alist['list_order'] = 1;
    $alist['new_windows'] = 0;
    $alist['classtype'] = $classtype;//可以用bigclass计算得出
    $alist['out_url'] = $list['out_url-'.$id];
    $alist['index_num'] = $list['index_num-'.$id];
    $alist['indeximg'] = '';
    $alist['columnimg'] = '';
    $alist['isshow'] = 1;
    $alist['lang'] = $_M['lang'];
    $alist['namemark'] = '';
    $alist['releclass'] = $releclass;//可以用bigclass计算得出
    $alist['display'] = 0;
    $alist['icon'] = '';
    $alist['foldername'] = $list['foldername-'.$id];
    if($if_in){
      $alist['foldername'] = '';
    }else{
      $alist['out_url'] = '';
    }
    if($list['filename']){
      $filenames = $this->database->get_column_by_filename($list['filename']);
      if($filenames && $filenames['id'] != $list['id']){
        turnover("{$_M[url][own_form]}}&a=doindex", $_M['word']['jsx27'],0);
      }
    }
    $id = $this->database->insert($alist);
    if($id)$this->columnCopyconfig($alist['foldername'], $alist['module'], $id);
    return $id;
  }

  /*栏目移动*/
  public function domove() {
    global $_M;
    $now_column = $this->database->get_list_one_by_id($_M['form']['nowid']);
    $now_column_class123 = load::sys_class('label', 'new')->get('column')->get_class123_reclass($_M['form']['nowid']);
    $to_column = $this->database->get_list_one_by_id($_M['form']['toid']);
    $to_column_class123 = load::sys_class('label', 'new')->get('column')->get_class123_reclass($_M['form']['toid']);
    //重写
    if($_M['form']['uplv']){//升为一级栏目
      //移动内容
      if($now_column['module'] >= 2 && $now_column['module'] <= 5){
        $module = load::sys_class('handle', 'new')->mod_to_name($now_column['module']);
        load::mod_class("{$module}/{$module}_op", 'new')->list_move($now_column_class123['class1'],$now_column_class123['class2'],$now_column_class123['class3'],$now_column['id'],0,0);
        if($now_column['classtype'] == 2){
          $son = load::sys_class('label', 'new')->get('column')->get_column_son($_M['form']['nowid']);
          foreach($son as $key=>$val){
            $son123 = load::sys_class('label', 'new')->get('column')->get_class123_reclass($val);
            load::mod_class("{$module}/{$module}_op", 'new')->list_move($son['class1'], $son['class2'],$son['class3'],$now_column['id'],$val['id'],0);
          }
        }
      }
      //移动栏目
      $list = array();
      $list['id']       = $now_column['id'];
      $list['bigclass'] = 0;
      $list['classtype'] = 1;
      $list['releclass'] = 0;
      if($_M['form']['foldername'])$list['foldername'] = $_M['form']['foldername'];
      $this->database->update_by_id($list);
      //给下级栏目classtype减1
      $list = array();
      $list['classtype']= 2;
      $list['bigclass'] = $now_column['id'];
      $list['foldername'] = $_M['form']['foldername'];
      $this->database->update_column_by_bigclass($list);
      //新增文件夹
      $this->columnCopyconfig($list['foldername'], $now_column['module'], $now_column['id']);
    }else{
      if($now_column['module'] == $to_column['module']){//同模块移动
        //移动内容
        if($now_column['module'] >= 2 && $now_column['module'] <= 5){
          $module = load::sys_class('handle', 'new')->mod_to_name($now_column['module']);
          load::mod_class("{$module}/{$module}_op", 'new')->list_move($now_column_class123['class1'],$now_column_class123['class2'],$now_column_class123['class3'],$now_column['id'],0,0);
          if($now_column['classtype'] == 2){
            $son = load::sys_class('label', 'new')->get('column')->get_column_son($_M['form']['nowid']);
            foreach($son as $key=>$val){
              $son123 = load::sys_class('label', 'new')->get('column')->get_class123_reclass($son123);
              load::mod_load("{$module}/op_{$module}", 'news')->list_move($son['class1'], $son['class2'],$son['class3'],$to_column_class123['class1'],$now_column['id'],$val['id']);
            }
          }
        }
        //移动栏目
        $list = array();
        $list['id']       = $now_column['id'];
        $list['bigclass'] = $to_column['id'];
        $list['classtype'] = $to_column['classtype'] + 1;
        $list['foldername'] = $to_column['foldername'];
        $list['releclass'] = 0;
        $this->database->update_by_id($list);
        //删除多余文件夹
        $this->del_column_file($now_column);
      }else{
        $list = array();
        $list['id']       = $now_column['id'];
        $list['bigclass'] = $to_column['id'];
        $list['classtype'] = $to_column['classtype'] + 1;
        $list['releclass'] = $to_column['id'];
        $this->database->update_by_id($list);
      }
      //给下级栏目classtype加1
      $list = array();
      $list['classtype']= 3;
      $list['bigclass'] = $now_column['id'];
      if($now_column['module'] == $to_column['module'])$list['foldername'] = $to_column['foldername'];
      $this->database->update_column_by_bigclass($list);
    }
    turnover("{$_M[url][own_form]}&a=doindex", '');
  }

  /*栏目表格插件*/
  public function dolistsave() {
    global $_M;
    $list = explode(",",$_M['form']['allid']) ;
    foreach($list as $id){
      if($id){
        switch($_M['form']['submit_type']){
          case 'save':
            if(is_number($id)){
                $this->list_editor($id, $_M['form']);
            }else{
              $this->list_add($id, $_M['form']);
            }
          break;
          case 'del':
            //$this->del_list($id);
            $this->delcolumn($id);
          break;
          case 'copy':

            $c = load::sys_class('label', 'new')->get('column')->get_column_id($id);
            if($c['classtype'] != 1){
              $class123 = load::sys_class('label', 'new')->get('column')->get_class123_reclass($val['id']);
              if(!$classlist[$class123['class1']['id']]){
                turnover("{$_M[url][own_form]}a=doindex", $_M['word']['copyotherlang5'],0);
              }else{
                continue;
              }

            }else{
              $classlist[$c['id']] = 1;
            }
		   $columninfo=$this->database->get_column_by_foldername($c['foldername'], $_M['form']['to_lang']);
            if($columninfo['0']['id']){
              turnover("{$_M[url][own_form]}a=doindex", $_M['word']['copyotherlang4'],0);
            }

            $son_class2 = load::sys_class('label', 'new')->get('column')->get_column_son($c['id']);
            foreach($son_class2 as $key=>$val){
              if($val['module'] != $c['module']){
				$columninfo=$this->database->get_column_by_foldername($c['foldername'], $_M['form']['to_lang']);
                if($columninfo['0']['id']){
                  turnover("{$_M[url][own_form]}a=doindex", $_M['word']['ssss'],0);
                }
              }
            }

            load::mod_class('column/column_op', 'new')->copy_column($id, $_M['form']['to_lang'], $_M['form']['is_contents']);

          break;
        }
      }
    }

    turnover("{$_M[url][own_form]}a=doindex");
  }

/*重新生成网站地图*/
  public function docreatemap() {
    global $_M;
    header("Expires: Mon, 26 Jul 1970 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    if (($_M[config][met_sitemap_html] || $_M[config][met_sitemap_xml] || $_M[config][met_sitemap_txt])) {
      if ($_M[config][met_sitemap_lang]) {
        $lang_now = $_M[form][lang];
        $met_weburl_now = $_M[config][met_weburl];
        $met_webname_now = $_M[config][met_webname];
        $sitemaplist = array();
        $met_langok = load::mod_class('language/language_op', 'new')->get_lang();
        foreach ($met_langok as $key => $val) {
          $lang = $val[mark];
          $sitemaplist_temp = $this->dogetmaplist($lang);
          $sitemaplist = array_merge($sitemaplist, $sitemaplist_temp);
        }
        $lang = $lang_now;
        $met_weburl = $_M[config][met_weburl_now];
        $met_webname = $_M[config][met_webname_now];
      } else {
        $sitemaplist = $this->dogetmaplist($_M[form][lang]);
      }
      $sitemaplist = array_unique($sitemaplist);
      // dump($sitemaplist);
      // exit;
      $met_sitemap_max = 50000;
      if ($_M[config][met_sitemap_html]) {
        $config_save = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $config_save .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $config_save .= "<head>\n";
        $config_save .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
        $config_save .= "<title>{$met_title}</title>\n";
        $config_save .= "</head>\n";
        $config_save .= "<body>\n";
        $config_save .= "<ul>\n";
        $i = 0;
        foreach ($sitemaplist as $key => $val) {
          $i++;
          $val[updatetime] = date("Y-m-d", strtotime($val[updatetime]));
          $config_save .= "<li><a href='" . $val[url] . "' title='" . $val[title] . "' target='_blank'>" . $val[title] . "</a><span>" . $val[updatetime] . "</span></li>\n";
          if ($i >= $met_sitemap_max) {
            break;
          }

        }
        $config_save .= "</ul>\n</body>";
        $sitemap_hz = '.html';
        $sitemapname = PATH_WEB . 'sitemap' . $sitemap_hz;
        $fp = fopen($sitemapname, w);
        fputs($fp, $config_save);
        fclose($fp);
      }
      if ($_M[config][met_sitemap_xml]) {
        $i = 0;
        foreach ($sitemaplist as $key => $val) {
          $val[url] = str_replace('../', '', $val[url]);
          $val[url] = str_replace('&', '&amp;', $val[url]);
          $val[url] = str_replace("'", '&apos;', $val[url]);
          $val[url] = str_replace('"', '&quot;', $val[url]);
          $val[url] = str_replace('>', '&gt;', $val[url]);
          $val[url] = str_replace('<', '&lt;', $val[url]);
          $val[url] = str_replace('..html', '.html', $val[url]);
          $val[url] = str_replace('..htm', '.htm', $val[url]);
          $i++;
          $val[updatetime] = date("Y-m-d", strtotime($val[updatetime]));
          $val[priority] = $val[priority] ? $val[priority] : '0.5';
          $sitemaptext .= "<url>\n";
          $sitemaptext .= "<loc>$val[url]</loc>\n";
          $sitemaptext .= "<priority>$val[priority]</priority>\n";
          $sitemaptext .= "<lastmod>$val[updatetime]</lastmod>\n";
          $sitemaptext .= "<changefreq>weekly</changefreq>\n";
          $sitemaptext .= "<title>$val[title]</title>\n";
          $sitemaptext .= "</url>\n";
          if ($i >= $met_sitemap_max) {
            break;
          }

        }
        $config_save = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $config_save .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $config_save .= $sitemaptext;
        $config_save .= "</urlset>";
        $sitemap_hz = '.xml';
        $sitemapname = PATH_WEB . 'sitemap' . $sitemap_hz;
        $fp = fopen($sitemapname, w);
        fputs($fp, $config_save);
        fclose($fp);
      }
      if ($_M[config][met_sitemap_txt]) {
        $config_save = "";
        $i = 0;
        foreach ($sitemaplist as $key => $val) {
          $i++;
          if ($val[url]) {
            $val[url] = str_replace('..html', '.html', $val[url]);
            $val[url] = str_replace('..htm', '.htm', $val[url]);
            $config_save .= "{$val[url]}" . "\r\n";
          }
          if ($i >= $met_sitemap_max) {
            break;
          }

        }
        $sitemap_hz = '.txt';
        $sitemapname = PATH_WEB . 'sitemap' . $sitemap_hz;
        if (stristr(PHP_OS, "WIN")) {
          $config_save = @iconv("utf-8", "GBK", $config_save);
        }
        $fp = fopen($sitemapname, w);
        fputs($fp, $config_save);
        fclose($fp);
      }
      turnover("{$_M[url][own_form]}&a=doindex");
      die();
    }
    turnover("{$_M[url][own_form]}&a=doindex");
  }
/*获取网站地图列表*/
  public function dogetmaplist($lang) {
    global $_M;
    $val[url] = $_M[config][met_weburl];
    $val[title] = $_M[config][met_webname];
    $val[priority] = 1;
    $val[updatetime] = date('Y-m-d', time());
    $sitemaplist[] = $val;
    $nav_listall = load::sys_class('label', 'new')->get('column')->get_column();
    foreach ($nav_listall as $key => $val) {
      $no1ok = $val[nav] ? 1 : ($_M[config][met_sitemap_not1] && !$val['bigclass'] ? 0 : 1);
      $no2ok = $val[if_in] == 0 ? 1 : ($_M[config][met_sitemap_not2] ? 0 : 1);
      if ($val[module] != 10 && $val[module] != 11 && $no1ok && $no2ok && $val[isshow] == 1) {
        $val[updatetime] = date("Y-m-d", strtotime($m_now_date));
        $val[title] = $val[name];
        $val[url] = str_replace('../', '', $val[url]);
        $val[url] = $val[if_in] ? $val[url] : $_M[config][met_weburl] . $val[url];
        $sitemaplist[] = $val;
      }
    }
    //$where="where isshow='1' and lang='{$lang}'";
    $result = $this->database->get_all_column_by_lang();
    $val = array();
    foreach ($result as $key => $value) {
      if ($val['isshow'] != 1) {
        continue;
      }

      if ($value[module] != 10 && $value[module] != 11 && $no1ok && $no2ok) {
        if ($value[classtype] == 1) {
          $val[url] = $_M[config][met_weburl] . $value[foldername] . '/';
          $val[updatetime] = date('Y-m-d', time());
        } elseif ($value[module] == 2) {
          $val[url] = $_M[config][met_weburl] . $value[foldername] . "/show.php?lang={$lang}&id=" . $value[id];
          $val[updatetime] = date('Y-m-d', time());
        } elseif ($value[module] == 3) {
          $val[url] = $_M[config][met_weburl] . $value[foldername] . "/product.php?lang={$lang}&class" . $value[classtype] . "=" . $value[id];
          $val[updatetime] = date('Y-m-d', time());
        } elseif ($value[module] == 4) {
          $val[url] = $_M[config][met_weburl] . $value[foldername] . "/download.php?lang={$lang}&class" . $value[classtype] . "=" . $value[id];
          $val[updatetime] = date('Y-m-d', time());
        } elseif ($value[module] == 5) {
          $val[url] = $_M[config][met_weburl] . $value[foldername] . "/img.php?lang={$lang}&class" . $value[classtype] . "=" . $value[id];
          $val[updatetime] = date('Y-m-d', time());
        } else {

        }
        $sitemaplist[] = $val;
      }
    }
    $where = "where lang='{$lang}'";
    $res = $this->database->getdata($_M[table][news], $where, '0');
    foreach ($res as $key => $val) {
      if ($_M[config][met_sitemap_not2] == 1 && $val[links]) {
        continue;
      }

      //$where="where id='{$val[class1]}' and lang='{$lang}'";
      $re = $this->database->get_column_by_id($val[class1]);
      $val[url] = $_M[config][met_weburl] . $re[foldername] . "/shownews.php?lang={$lang}&id={$val[id]}";
      $sitemaplist[] = $val;
    }
    $where = "where lang='{$lang}'";
    $res = $this->database->getdata($_M[table][product], $where, '0');
    foreach ($res as $key => $val) {
      if ($_M[config][met_sitemap_not2] == 1 && $val[links]) {
        continue;
      }

      //$where="where id='{$val[class1]}' and lang='{$lang}'";
      $re = $this->database->get_column_by_id($val[class1]);
      $val[url] = $_M[config][met_weburl] . $re[foldername] . "/showproduct.php?lang={$lang}&id={$val[id]}";
      $sitemaplist[] = $val;
    }
    $where = "where lang='{$lang}'";
    $res = $this->database->getdata($_M[table][download], $where, '0');
    foreach ($res as $key => $val) {
      if ($_M[config][met_sitemap_not2] == 1 && $val[links]) {
        continue;
      }

      //$where="where id='{$val[class1]}' and lang='{$lang}'";
      $re = $this->database->get_column_by_id($val[class1]);
      $val[url] = $_M[config][met_weburl] . $re[foldername] . "/showdownload.php?lang={$lang}&id={$val[id]}";
      $sitemaplist[] = $val;
    }
    $where = "where lang='{$lang}'";
    $res = $this->database->getdata($_M[table][job], $where, '0');
    foreach ($res as $key => $val) {
      if ($_M[config][met_sitemap_not2] == 1 && $val[links]) {
        continue;
      }

      $val[url] = $_M[config][met_weburl] . "job/showjob.php?lang={$lang}&id={$val[id]}";
      $sitemaplist[] = $val;
    }

    $where = "where lang='{$lang}'";
    $res = $this->database->getdata($_M[table][img], $where, '0');
    foreach ($res as $key => $val) {
      if ($_M[config][met_sitemap_not2] == 1 && $val[links]) {
        continue;
      }

      //$where="where id='{$val[class1]}' and lang='{$lang}'";
      $re = $this->database->get_column_by_id($val[class1]);
      $val[url] = $_M[config][met_weburl] . $re[foldername] . "/showimg.php?lang={$lang}&id={$val[id]}";
      $sitemaplist[] = $val;
    }

    return $sitemaplist;
  }

/////内置函数
  public function module($module) {
    global $_M;
    switch ($module) {
    case '0':
      $module = "<font color=red>{$_M[word][modout]}</font>";
      break;
    case '1':
      $module = $_M[word][mod1];
      break;
    case '2':
      $module = $_M[word][mod2];
      break;
    case '3':
      $module = $_M[word][mod3];
      break;
    case '4':
      $module = $_M[word][mod4];
      break;
    case '5';
      $module = $_M[word][mod5];
      break;
    case '6':
      $module = $_M[word][mod6];
      break;
    case '7':
      $module = $_M[word][mod7];
      break;
    case '8':
      $module = $_M[word][mod8];
      break;
    case '9':
      $module = $_M[word][mod9];
      break;
    case '10':
      $module = $_M[word][mod10];
      break;
    case '11':
      $module = $_M[word][mod11];
      break;
    case '12':
      $module = $_M[word][mod12];
      break;
    case '100':
      $module = $_M[word][mod100];
      break;
    case '101':
      $module = $_M[word][mod101];
      break;
    }

    return $module;
  }

  /**
   *主导航显示
   * @param  int $nav 导航标识
   * @return string   导航类型返回代码
   */
  public function navdisplay($nav) {
    global $_M;
    switch ($nav) {
    case '0':$nav = $_M[word][funNav1];
      break;
    case '1':$nav = "<font class='red'>{$_M[word][funNav2]}</font>";
      break;
    case '2':$nav = "<font class='blue'>{$_M[word][funNav3]}</font>";
      break;
    case '3':$nav = "<font class='green'>{$_M[word][funNav4]}</font>";
      break;
    }
    return $nav;
  }

  public function metdetrim($str) {
    $str = trim($str);
    $str = preg_replace("\t", "", $str);
    $str = preg_replace("\r\n", "", $str);
    $str = preg_replace("\r", "", $str);
    $str = preg_replace("\n", "", $str);
    $str = preg_replace(" ", "", $str);
    $str = strtolower($str);
    return trim($str);
  }

/*删除文件*/
  public function fileUnlink($file_name) {
    if (stristr(PHP_OS, "WIN")) {
      $file_name = @iconv("utf-8", "gbk", $file_name);
    }
    if (file_exists($file_name)) {
      //@chmod($file_name,0777);
      $area_lord = @unlink($file_name);
    }
    return $area_lord;
  }

  public function columnCopyconfig($foldername, $module, $id) {
    global $_M;
    if(!$foldername) return false;
    switch ($module) {
    case 1:
      $indexaddress = "../about/index.php";
      $newfile = PATH_WEB . $foldername . "/show.php";
      $address = "../about/show.php";
      $this->Copyfile($address, $newfile);
      break;
    case 2:
      $indexaddress = "../news/index.php";
      $newfile = PATH_WEB . $foldername . "/news.php";
      $address = "../news/news.php";
      $this->Copyfile($address, $newfile);
      $newfile = PATH_WEB . $foldername . "/shownews.php";
      $address = "../news/shownews.php";
      $this->Copyfile($address, $newfile);
      break;
    case 3:
      $indexaddress = "../product/index.php";
      $newfile = PATH_WEB . $foldername . "/product.php";
      $address = "../product/product.php";
      $this->Copyfile($address, $newfile);
      $newfile = PATH_WEB . $foldername . "/showproduct.php";
      $address = "../product/showproduct.php";
      $this->Copyfile($address, $newfile);
      break;
    case 4:
      $indexaddress = "../download/index.php";
      $newfile = PATH_WEB . $foldername . "/download.php";
      $address = "../download/download.php";
      $this->Copyfile($address, $newfile);
      $newfile = PATH_WEB . $foldername . "/showdownload.php";
      $address = "../download/showdownload.php";
      $this->Copyfile($address, $newfile);
      // $newfile = PATH_WEB . $foldername . "/down.php";
      // $address = "../download/down.php";
      // $this->Copyfile($address, $newfile);
      break;
    case 5:
      $indexaddress = "../img/index.php";
      $newfile = PATH_WEB . $foldername . "/img.php";
      $address = "../img/img.php";
      $this->Copyfile($address, $newfile);
      $newfile = PATH_WEB . $foldername . "/showimg.php";
      $address = "../img/showimg.php";
      $this->Copyfile($address, $newfile);
      break;
    case 6:
        $array[1][0] = 'met_cv_showcol';
        $array[1][1] = '';
        $this->verbconfig($array, $id);
        break;
    case 7:
      $array[1][0] = 'met_fd_time';
      $array[1][1] = '120';
      $array[2][0] = 'met_fd_word';
      $array[2][1] = '';
      $array[3][0] = 'met_fd_email';
      $array[3][1] = '0';
      $array[4][0] = 'met_fd_type';
      $array[4][1] = '1';
      $array[5][0] = 'met_fd_to';
      $array[5][1] = '';
      $array[6][0] = 'met_fd_back';
      $array[6][1] = '0';
      $array[7][0] = 'met_fd_title';
      $array[7][1] = '';
      $array[8][0] = 'met_fd_content';
      $array[8][1] = '';
      $array[9][0] = 'met_fd_ok';
      $array[9][1] = '1';
      $array[10][0] = 'met_fd_sms_back';
      $array[10][1] = '';
      $array[11][0] = 'met_fd_sms_content';
      $array[11][1] = '';
      $array[12][0] = 'met_fd_sms_dell';
      $array[12][1] = '';
      $array[13][0] = 'met_message_fd_class';
      $array[13][1] = '';
      $array[14][0] = 'met_message_fd_content';
      $array[14][1] = '';
      $array[15][0] = 'met_message_fd_email';
      $array[15][1] = '';
      $array[16][0] = 'met_message_fd_sms';
      $array[16][1] = '';
      $this->verbconfig($array, $id);
      break;
    case 8:
      $indexaddress = "../feedback/index.php";
      $newfile = PATH_WEB . $foldername . "/feedback.php";
      $address = "../feedback/feedback.php";
      $this->Copyfile($address, $newfile);
      $array[1][0] = 'met_fd_time';
      $array[1][1] = '120';
      $array[2][0] = 'met_fd_word';
      $array[2][1] = '';
      $array[3][0] = 'met_fd_type';
      $array[3][1] = '1';
      $array[4][0] = 'met_fd_to';
      $array[4][1] = '';
      $array[5][0] = 'met_fd_back';
      $array[5][1] = '0';
      $array[6][0] = 'met_fd_email';
      $array[6][1] = '1';
      $array[7][0] = 'met_fd_title';
      $array[7][1] = '';
      $array[8][0] = 'met_fd_content';
      $array[8][1] = '';
      $array[9][0] = 'met_fdtable';
      $fd_title = $this->database->get_list_one_by_id($id);
      $array[9][1] = $fd_title['name'];
      $array[10][0] = 'met_fd_class';
      $array[10][1] = '1';
      $array[11][0] = 'met_fd_ok';
      $array[11][1] = '1';
      $array[12][0] = 'met_fd_sms_back';
      $array[12][1] = '';
      $array[13][0] = 'met_fd_sms_content';
      $array[13][1] = '';
      $array[14][0] = 'met_fd_sms_dell';
      $array[14][1] = '';
      $array[15][0] = 'met_fd_showcol';
      $array[15][1] = '';
      $array[16][0] = 'met_fd_inquiry';
      $array[16][1] = '';
      $array[17][0] = 'met_fd_related';
      $array[17][1] = '';
      $this->verbconfig($array, $id);
      break;
      default :
        if($module > 2000)$this->establishAppmodule($foldername, $module);
      break;
    }
    $this->Copyfile($indexaddress, PATH_WEB . $foldername . '/index.php');
  }

  public function Copyfile($address, $newfile) {
    $oldcont = "<?php\n# MetInfo Enterprise Content Management System \n# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. \nrequire_once '$address';\n# This program is an open source system, commercial use, please consciously to purchase commercial license.\n# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.\n?>";
      $filename = str_replace(PATH_WEB,'',$newfile);
      $filename = preg_replace("/\/\w+\.php/",'',$filename);
      if(!file_exists($newfile) && !$this->unkmodule($filename)){
      makefile($newfile);
      return file_put_contents($newfile, $oldcont);
    }
  }

  /*是否是系统模块*/
  public function unkmodule($filename) {
    $modfile = array('app','admin','about', 'news', 'product', 'download', 'img', 'job', 'cache', 'config', 'install', 'feedback', 'include', 'lang', 'link', 'member', 'message', 'public', 'search', 'sitemap', 'templates', 'upload', 'wap', 'online', 'hits', 'shop', 'pay', '');
    $ok = 0;
    foreach ($modfile as $key => $val) {
      if ($filename == $val) {
        $ok = 1;
      }

    }
    return $ok;
  }

  /*文件夹名称事都可以用*/
  public function is_foldername_ok($foldername, $module) {
    global $_M;
    if(!$foldername){
      return false;
    }

    $other = array('shop','pay');
    if(in_array($foldername, $other)){
      return false;
    }
    $langs = load::mod_class('language/language_op', 'new')->get_lang();
    foreach ($langs as $langkey => $langval) {
      $smodule = load::mod_class('column/column_op', 'new')->get_sorting_by_module(false, $langval['mark']);
      foreach($smodule as $mkey => $mval){
        foreach($mval['class1'] as $c1key => $c1val){
          if($c1val['lang'] == $_M['lang']){
            if($c1val['foldername'] == $foldername){
              return false;
            }
          }else{
            if($c1val['foldername'] == $foldername && $c1val['module'] != $module){
              return false;
            }
          }
        }
      }
    }


    return true;
  }

  public function delcolumn($id) {
    global $_M;
    $config = load::mod_class('config/config_database', 'new');
    $column = $this->database->get_list_one_by_id($id);
    //删除下级不同模块文件夹
    $lv = load::mod_class('column/column_op', 'new')->get_sorting_by_lv();
    $module = load::sys_class('handle', 'new')->mod_to_name($column['module']);

    self::del_column_content($column['module'],$id,$column['classtype']);
    $classtype = $column['classtype'] + 1 ;
    foreach($lv['class'.$classtype][$id] as $key=>$val){
      $this->delcolumn($val['id']);
    }
    switch ($column['module']) {
      default:
        //$where="where id='$column[id]'";
        //$this->database->del_by_id($column['id']);
      break;
      case 2:
      case 3:
      case 4:
      case 5:
      case 6:
      case 7:
      $config->del_value_by_columnid($id);
      break;
      case 8:

        load::mod_class("{$module}/{$module}_op", 'new')->del_by_class($column['id']);
      break;
    }

    /*删除文件*/
    $this->del_column_file($column);

    /*删除栏目图片*/
    $this->fileUnlink($adminurl . $column[indeximg]);
    $this->fileUnlink($adminurl . $column[columnimg]);
    /*删除栏目*/
    $this->database->del_by_id($column['id']);


     if(intval($id) > 0){
       $config->del_value_by_columnid($id);
       $config->del_value_by_flashid($id);
    }
    load::mod_class('banner/banner_database', 'new')->update_flash_by_cid($id,$_M['lang']);
  }

  /*删除栏目文件*/
  public function del_column_file($column){
    $admin_lists = $this->database->get_column_by_foldername($column[foldername]);
    if (!$admin_lists['id'] && ($column['classtype'] == 1 || $column['releclass'])) {
      if ($column['foldername'] != '' && ($column['module'] < 6 || $column['module'] == 8) && $column['if_in'] != 1) {
        if (!$this->unkmodule($column['foldername'])) {
          $foldername = PATH_WEB . $column['foldername'];
          $this->deldir($foldername);
        }
      }
    }
  }

  public function delimg($del, $type, $module = 0, $para_list = null) {
    global $_M;
    $lang = $_M['form']['lang'];
    $table = $module == 8 ? $_M[table][feedback] : $_M[table][plist];
    if ($para_list == null && $module != 2) {
      $where = "where lang='$lang' and module='$module' and (class1='$del[class1]' or class1=0) and type='5'";
      $para_list = $this->database->getdata($_M[table][parameter], $where, '0');
    }
    if ($type == 1) {
      $delnow[] = $del;
    } else if ($type == 2) {
      $delnow = $del;
    } else {
      $table = $this->moduledb($module);
      $where = "where id='$id'";
      $del = $this->database->getdata($table, $where, '1');
      $delnow[] = $del;
    }
    foreach ($delnow as $key => $val) {
      if ($val['recycle'] != 2 || $module != 2) {
        foreach ($para_list as $key1 => $val1) {
          if (($module == $val1['module'] || $val['recycle'] == $val1['module']) && ($val1['class1'] == 0 || $val1['class1'] == $val['class1'])) {
            $where = "where lang='$lang' and  paraid='$val1[id]' and listid='$val[id]'";
            $imagelist = $this->database->getdata($table, $where, '1');
            $this->fileUnlink($adminurl . $imagelist['info']);
            $imagelist['info'] = str_replace('watermark/', '', $imagelist['info']);
            $this->fileUnlink($adminurl . $imagelist['info']);
          }
        }
      }
      if ($module == 6 || $module == 8) {
        continue;
      }

      if ($val['displayimg'] != null) {
        $displayimg = explode('|', $val['displayimg']);
        foreach ($displayimg as $key2 => $val2) {
          $display_val = explode('*', $val2);
          $this->fileUnlink($adminurl . $display_val[1]);
          $display_val[1] = str_replace('watermark/', '', $display_val[1]);
          $this->fileUnlink($adminurl . $display_val[1]);
          $imgurl_diss = explode('/', $display_val[1]);
          $this->fileUnlink($adminurl . $imgurl_diss[0] . '/' . $imgurl_diss[1] . '/' . $imgurl_diss[2] . '/thumb_dis/' . $imgurl_diss[count($imgurl_diss) - 1]);

        }
      }
      if ($val['downloadurl'] == null) {
        $this->fileUnlink($adminurl . $val['imgurl']);
        $this->fileUnlink($adminurl . $val['imgurls']);
        $val['imgurlbig'] = str_replace('watermark/', '', $val['imgurl']);
        $this->fileUnlink($adminurl . $val['imgurlbig']);
        $imgurl_diss = explode('/', $val['imgurlbig']);
        $this->fileUnlink($adminurl . $imgurl_diss[0] . '/' . $imgurl_diss[1] . '/' . $imgurl_diss[2] . '/thumb_dis/' . $imgurl_diss[count($imgurl_diss) - 1]);
      } else {
        $this->fileUnlink($adminurl . $val['downloadurl']);
      }

      $content[0] = $val[content];
      $content[1] = $val[content1];
      $content[2] = $val[content2];
      $content[3] = $val[content3];
      $content[4] = $val[content4];
      foreach ($content as $contentkey => $contentval) {
        if ($contentval) {
          $tmp1 = explode("<", $contentval);
          foreach ($tmp1 as $key => $val) {
            $tmp2 = explode(">", $val);
            if (strcasecmp(substr(trim($tmp2[0]), 0, 3), 'img') == 0) {
              preg_match('/http:\/\/([^\"]*)/i', $tmp2[0], $out);
              $imgs[] = $out[1];
            }
          }
        }
      }
      foreach ($imgs as $key => $val) {
        $vals = explode('/', $val);
        $this->fileUnlink(PATH_WEB . "upload/images/" . $vals[count($vals) - 1]);
        $this->fileUnlink(PATH_WEB . "upload/images/watermark/" . $vals[count($vals) - 1]);
      }
    }

  }

  public function morenfod($foldername, $module) {
    $metinfo = 1;
    switch ($foldername) {
    case 'about':
      $metinfo = $module == 1 ? 0 : 1;
      break;
    case 'news':
      $metinfo = $module == 2 ? 0 : 1;
      break;
    case 'product':
      $metinfo = $module == 3 ? 0 : 1;
      break;
    case 'download':
      $metinfo = $module == 4 ? 0 : 1;
      break;
    case 'img':
      $metinfo = $module == 5 ? 0 : 1;
      break;
    case 'feedback':
      $metinfo = $module == 8 ? 0 : 1;
      break;
    }
    return $metinfo;
  }

  /*应用模块创建时生成相应文件*/
  public function establishAppmodule($foldername, $no) {
    global $_M;
    $where = "where no='$no'";
    $addfile_type = $this->database->getdata($_M[table][ifcolumn], $where, '1');
    if ($addfile_type[addfile] == 1) {
      $path = PATH_WEB . $foldername;
      mkdir($path, 0777);
      $where = "where no='$no'";
      $structure = $this->database->getdata($_M[table][ifcolumn_addfile], $where, '0');
      foreach ($structure as $key => $val) {
        $path = PATH_WEB . $foldername . '/' . $val[filename];
        $fp = fopen($path, "w+");
        $str = "<?php
  # MetInfo Enterprise Content Management System
  # Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
  " . "\n";
        fputs($fp, $str);
        fclose($fp);
      }
      $where = "where no='$no'";
      $structure1 = $this->database->getdata($_M[table][ifcolumn_addfile], $where, '0');
      foreach ($structure1 as $key => $val) {
        $straction[$val[filename]] .= "define('M_NAME', '" . $val['m_name'] . "');\ndefine('M_MODULE', '" . $val['m_module'] . "');\ndefine('M_CLASS', '" . $val['m_class'] . "');\n";
        if (substr($val['m_action'], 0, 1) == '$' || substr($val['m_action'], 0, 1) == '@') {
          $straction[$val[filename]] .= "define('M_ACTION', " . $val['m_action'] . ");\n";
        } else {
          $straction[$val[filename]] .= "define('M_ACTION', '" . $val['m_action'] . "');\n";
        }
        $straction[$val[filename]] .= "require_once '../app/app/entrance.php';\n";
      }
      foreach ($structure as $key => $val) {
        $path = PATH_WEB . $foldername . '/' . $val[filename];
        $fp = fopen($path, "r");
        $read = fread($fp, filesize($path));
        fclose($fp);
        $fp = fopen($path, "w");
        $str = $read . $straction[$val[filename]] . "# This program is an open source system, commercial use, please consciously to purchase commercial license.
  # Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
  ?>";
        fputs($fp, $str);
        fclose($fp);
      }
    }
  }

  /*生成反馈配置文件*/
  public function verbconfig($array, $id) {
    global $_M;
    $query = "where columnid='$id' and lang='$lang'";
    DB::counter($_M[table][config], $query, "*");
    if (DB::counter($_M[table][config], $query, "*") == 0) {
      foreach ($array as $key => $val) {
        $list = array();
        $list['name'] = $val[0];
        $list['value'] = $val[1];
        $list['columnid'] = $id;
        $list['flashid'] = 0;
        $list['lang'] = $_M[form][lang];
        load::mod_class('config/config_database', 'new')->insert($list);
      }
    }
  }

  public function deldir($dir, $dk = 1) {
    global $_M;
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
      if ($file != "." && $file != "..") {
        $fullpath = $dir . "/" . $file;
        if (!is_dir($fullpath)) {
          unlink($fullpath);
        } else {
          deldir($fullpath);
        }
      }
    }
    closedir($dh);
    if ($dk == 0 && $dir != PATH_WEB . 'upload') {
      $dk = 1;
    }

    if ($dk == 1) {
      if (rmdir($dir)) {
        return true;
      } else {
        return false;
      }
    }
  }

  public function doset_icon() {
    global $_M;
    require_once $this->view('app/set_icon');
  }

  public function del_column_content($module,$cid, $classtype)
  {
      global $_M;
      if($module >1 && $module < 10){
         $module_name = load::sys_class('handle', 'new')->mod_to_file($module);
          $name = load::sys_class('label', 'new')->get($module_name);
          $database = load::mod_class("{$module_name}/{$module_name}_database",'new');

          if($classtype == 1){

              $list = $database->del_list_by_class($cid, null, null);

          }elseif($classtype == 2){
               $list = $database->del_list_by_class(null, $cid, null);
          }else{
              $list = $database->del_list_by_class(null, null,$cid);
          }

          $para_list = load::mod_class('parameter/parameter_list_database', 'new');
          $para_list->construct($module);
          $para_list->del_parameter_by_class($classtype,$cid);

          foreach ($list as $c) {
              $para_list->del_by_listid($c['id']);
          }
      }
  }

}
