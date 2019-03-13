<?php
defined('IN_MET') or exit('No permission');
load::mod_class('base/admin/base_admin');
class index extends base_admin {
  public function __construct() {
    global $_M;
    parent::__construct();
    $_M['url']['help_tutorials_helpid']='99';
  }

  public function doindex() {
    global $_M;
    $class1 = $_M[form][class1];
    $class2 = $_M[form][class2];
    $module = $_M[form][module];
    $anyid = $_M[form][anyid];
    $met_class[$class1] = load::mod_class('column/column_database', 'new')->get_column_by_id($class1, $this->lang);
    $met_class[$class2] = load::mod_class('column/column_database', 'new')->get_column_by_id($class2, $this->lang);
    $met_class[$class3] = load::mod_class('column/column_database', 'new')->get_column_by_id($class3, $this->lang);
    $array = column_sorting(2);
    $lang = $this->lang;
    $metinfo_admin_name = get_met_cookie('metinfo_admin_name');
    $metinfo_admin_pop = get_met_cookie('metinfo_admin_pop');
    $met_class1 = $array['class1'];
    $met_class2 = $array['class2'];
    $met_class3 = $array['class3'];
    $met_skin = 'met';
    $query = "select * from {$_M[table][column]} where lang='$lang' order by no_order";
    $result = DB::query($query);
    $power = background_privilege();
    while ($list = DB::fetch_array($result)) {
      if (!is_have_power('c'. $list['id']) && ($list[classtype] == 1 || $list[releclass] != 0)) {
        continue;
      }
      if ($list[classtype] == 1) {
        $met_class1[$list['id']] = $list;
      }
      if (($list[classtype] == 1 or ($list[releclass] > 0 and ($list[module] <= 7 || $list[module] == 8))) and $list[if_in] == 0) {
        $met_classindex[$list[module]][] = $list;
      }

    }
    $css_url = "templates/" . $met_skin . "/css";
    $img_url = "templates/" . $met_skin . "/images";
    $new_news_module_url = "index.php?n=news&c=news_admin&a=doindex";
    $new_product_module_url = "index.php?n=product&c=product_admin&a=doindex";
    if ($topara) {
      $toparas = explode('|', $topara);
      Header("Location: ../column/parameter/parameter.php?module={$topara[0]}&anyid=29&lang={$lang}&class1={$toparas[1]}");
      met_setcookie("topara", '', time() - 3600);
    }


    $admin = admin_information();
    $met_content_type = $admin['content_type'];
    if ($met_content_type == 0) {
      $query = "select content_type from {$_M[table][admin_table]} where admin_id='{$metinfo_admin_name}'";
      $met_content_type1 = DB::get_one($query);
      $met_content_type = $met_content_type1['content_type'];
    }
    $query = "update {$_M[table][admin_table]} set content_type='1' where admin_id='{$metinfo_admin_name}'";
    DB::query($query);

    if ($met_content_type != 2) {
      if ($action == 'search' && $program) {
        foreach ($met_class1 as $key => $val) {
          if ($val['module'] < 9 && !$val['if_in']) {
            $contentlistes[] = $val;
          }
        }
        foreach ($contentlistes as $key => $val) {
          switch ($val['module']) {
          case '1':
            $val['url'] = 'about/content.php?id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '2':
            $val['url'] = 'article/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = $new_news_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '3':
            $val['url'] = 'product/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = $new_product_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '4':
            $val['url'] = 'download/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'download/index.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '5':
            $val['url'] = 'img/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'img/index.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '6':
            $val['url'] = 'job/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'job/index.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['incurl'] = 'job/inc.php?lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['cvurl'] = 'job/cv.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[cvurl]}'>{$_M[word][cveditorTitle]}</a></p>
                  </div>
                  ";
            break;
          case '7':
            $val['incurl'] = 'message/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'message/index.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
            break;
          case '8':
            $val['url'] = 'feedback/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'feedback/index.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
            break;
          }
          $contentlist[] = $val;

        }

        foreach ($met_class2 as $key => $val) {
          foreach ($met_class2[$key] as $key1 => $val1) {
            if ($val['module'] < 9 && !$val['if_in']) {
              $contentlistes1[] = $val1;
            }
          }
        }

        foreach ($contentlistes1 as $key => $val) {
          switch ($val['module']) {
          case '1':
            $val['url'] = 'about/content.php?id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '2':
            if (!$val[releclass]) {
              $val['url'] = 'article/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_news_module_url . '&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            } else {
              $val['url'] = 'article/content.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_news_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            }

            break;
          case '3':
            if (!$val[releclass]) {
              $val['url'] = 'product/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_product_module_url . '&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            } else {
              $val['url'] = 'product/content.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_product_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            }
            break;
          case '4':
            if (!$val[releclass]) {
              $val['url'] = 'download/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'download/index.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            } else {
              $val['url'] = 'download/content.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'download/index.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            }
            break;
          case '5':
            if (!$val[releclass]) {
              $val['url'] = 'img/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'img/index.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            } else {
              $val['url'] = 'img/content.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=img&c=img_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            }
            break;
          case '6':
            $val['url'] = 'job/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'index.php?n=job&c=job_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['incurl'] = 'job/inc.php?lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['cvurl'] = 'job/cv.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[cvurl]}'>{$_M[word][cveditorTitle]}</a></p>
                  </div>
                  ";
            break;
          case '7':
            if (!$val[releclass]) {
              $val['incurl'] = 'message/inc.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=message&c=message_admin&a=doindex&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
            } else {
              $val['incurl'] = 'message/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=message&c=message_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
            }
            break;
          case '8':
            if (!$val[releclass]) {
              $val['url'] = 'feedback/inc.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=feedback&c=feedback_admin&a=doindex&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
            } else {
              $val['url'] = 'feedback/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=feedback&c=feedback_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
            }
            break;
          }
          $contentlist[] = $val;
        }

        foreach ($met_class3 as $key => $val) {
          foreach ($met_class3[$key] as $key1 => $val1) {
            if ($val['module'] < 9 && !$val['if_in']) {
              $contentlistes2[] = $val1;
            }
          }
        }
        foreach ($contentlistes2 as $key => $val) {
          switch ($val['module']) {
          case '1':
            $val['url'] = 'about/content.php?id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            break;
          case '2':
            $column_types2 = array();
            foreach ($met_class2 as $key1 => $val1) {
              foreach ($val1 as $key11 => $val11) {
                if ($val11[id] == $val[bigclass]) {
                  $column_types2 = $met_class1[$key1];
                }
              }
            }
            if ($column_types2['module'] != $val['module']) {
              $val['url'] = 'article/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_news_module_url . '&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            } else {
              $val['url'] = 'article/content.php?class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_news_module_url . '&class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
            }

            break;
          case '3':
            $column_types2 = array();
            foreach ($met_class2 as $key1 => $val1) {
              foreach ($val1 as $key11 => $val11) {
                if ($val11[id] == $val[bigclass]) {
                  $column_types2 = $met_class1[$key1];
                }
              }
            }
            if ($column_types2['module'] != $val['module']) {
              $val['url'] = 'product/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_product_module_url . '&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            } else {
              $val['url'] = 'product/content.php?class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_product_module_url . '&class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            }
            break;
          case '4':
            $column_types2 = array();
            foreach ($met_class2 as $key1 => $val1) {
              foreach ($val1 as $key11 => $val11) {
                if ($val11[id] == $val[bigclass]) {
                  $column_types2 = $met_class1[$key1];
                }
              }
            }
            if ($column_types2['module'] != $val['module']) {
              $val['url'] = 'download/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=download&c=download_admin&a=doindex&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            } else {
              $val['url'] = 'download/content.php?class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=download&c=download_admin&a=doindex&class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            }
            break;
          case '5':
            $column_types2 = array();
            foreach ($met_class2 as $key1 => $val1) {
              foreach ($val1 as $key11 => $val11) {
                if ($val11[id] == $val[bigclass]) {
                  $column_types2 = $met_class1[$key1];
                }
              }
            }
            if ($column_types2['module'] != $val['module']) {
              $val['url'] = 'img/content.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=img&c=img_admin&a=doindex&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            } else {
              $val['url'] = 'img/content.php?class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=img&c=img_admin&a=doindex&class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
                    <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                    <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                    </div>";
            }
            break;
          case '6':
            $val['url'] = 'job/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['conturl'] = 'index.php?n=job&c=job_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['incurl'] = 'job/inc.php?lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['cvurl'] = 'job/cv.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div>
                  <p class='lt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[cvurl]}'>{$_M[word][cveditorTitle]}</a></p>
                  </div>
                  ";
            break;
          case '7':
            $column_types2 = array();
            foreach ($met_class2 as $key1 => $val1) {
              foreach ($val1 as $key11 => $val11) {
                if ($val11[id] == $val[bigclass]) {
                  $column_types2 = $met_class1[$key1];
                }
              }
            }
            if ($column_types2['module'] != $val['module']) {
              $val['incurl'] = 'message/inc.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=message&c=message_admin&a=doindex&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
            } else {
              $val['incurl'] = 'message/inc.php?class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=message&c=message_admin&a=doindex&class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
            }
            break;
          case '8':
            $column_types1 = array();
            $column_types2 = array();
            foreach ($met_class2 as $key1 => $val1) {
              foreach ($val1 as $key11 => $val11) {
                if ($val11[id] == $val[bigclass]) {
                  $column_types2 = $met_class1[$key1];
                }
              }
            }
            if ($column_types2['module'] != $val['module']) {
              $val['url'] = 'feedback/inc.php?class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=feedback&c=feedback_admin&a=doindex&class1=' . $val[bigclass] . '&class2=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
            } else {
              $val['url'] = 'feedback/inc.php?class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=feedback&c=feedback_admin&a=doindex&class1=' . $column_types2[id] . '&class2=' . $val[bigclass] . '&class3=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
            }
            break;
          }
          $contentlist[] = $val;
        }

      } else {
        if ($class1) {

          if ($met_class[$class1]['isshow']) {
            $contentlistes[] = $met_class[$class1];
          }

          foreach ($met_class2[$class1] as $key => $val2) {
            $contentlistes[] = $val2;
          }

          //dump($contentlistes);
          foreach ($contentlistes as $key => $val) {
            if ($val['module'] == 1) {
              $c2 = count($met_class3[$val['id']]);
              $classname = $c2 ? "class='lt'" : '';

              $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
              $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&module=1&class2={$val['id']}" : $val[url];
              $val['set'] = "<div>";
              if ($val['isshow']) {
                $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
              }

              if ($val['isshow'] && $c2) {
                $val['set'] .= '<span>-</span>';
              }

              if ($c2) {
                $val['set'] .= "<p {$classname1}><a href='?anyid={$anyid}&lang={$lang}&module=1&class2={$val['id']}'>{$_M[word][subpart]}</a></p>";
              }

              $val['set'] .= '</div>';
              $contentlist[] = $val;
            }

            $column_types5 = array();
            $column_types5 = DB::get_one("select * from {$_M[table][column]} where id='$val[bigclass]'");
            if ($val['module'] == 2) {
              // dump($val);
              // dump($column_types5);

            }
            if (($val['module'] == 2 && $val['bigclass'] == '0') || ($val['module'] == 2 && $column_types5[module] != 2 && $val['bigclass'] != '0')) {
              $val['url'] = 'article/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];

              $val['conturl'] = $new_news_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
            <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
            </div>";
              $contentlist[] = $val;
            } else {
              if ($val['module'] == 2 && $val['bigclass'] != '0') {

                if ($val['classtype'] == 2) {
                  $val['url'] = 'article/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = $new_news_module_url . '&class1=' . $val['bigclass'] . '&class2=' . $val['id'] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                </div>";
                  $contentlist[] = $val;
                }
              }
            }
            $column_types5 = array();
            $column_types5 = DB::get_one("select * from {$_M[table][column]} where id='$val[bigclass]'");
            if (($val['module'] == 3 && $val['bigclass'] == '0') || ($val['module'] == 3 && $column_types5[module] != 3 && $val['bigclass'] != '0')) {
              $val['url'] = 'product/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = $new_product_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
              <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
              </div>";
              $contentlist[] = $val;
            } else {
              if ($val['module'] == 3 && $val['bigclass'] != '0') {
                if ($val['classtype'] == 2) {
                  $val['url'] = 'product/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = $new_product_module_url . '&class1=' . $val['bigclass'] . '&class2=' . $val['id'] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
                  $contentlist[] = $val;
                }
              }
            }
            $column_types5 = array();
            $column_types5 = DB::get_one("select * from {$_M[table][column]} where id='$val[bigclass]'");
            if (($val['module'] == 4 && $val['bigclass'] == '0') || ($val['module'] == 4 && $column_types5[module] != 4 && $val['bigclass'] != '0')) {
              $val['url'] = 'download/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=download&c=download_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
              <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
              <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
              $contentlist[] = $val;
            }
            $column_types5 = array();
            $column_types5 = DB::get_one("select * from {$_M[table][column]} where id='$val[bigclass]'");
            if (($val['module'] == 5 && $val['bigclass'] == '0') || ($val['module'] == 5 && $val['module'] == $class1 && $val['bigclass'] == '0') || ($val['module'] == 5 && $column_types5[module] != 5 && $val['bigclass'] != '0') || ($val['module'] == 5 && $val['bigclass'] != '0' && $column_types5[foldername] != $val[foldername])) {
              $val['url'] = 'img/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=img&c=img_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
              <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
              <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
              </div>";
              $contentlist[] = $val;
            }
            if ($val['module'] == 6) {
              $val['url'] = 'job/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=job&c=job_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['incurl'] = 'job/inc.php?lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['cvurl'] = 'job/cv.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div>
              <p class='lt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p><span>-</span>
              <p class='rt'><a href='{$val[cvurl]}'>{$_M[word][cveditorTitle]}</a></p>
              </div>
              ";
              $sum1 = '';
              $sums = array();
              $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
              $sum1 = $sums['count(*)'];
              if ($sum1 > 99) {
                $sum1 = "99+";
              }
              $val['sum'] = $sum1;
              $contentlist[] = $val;
            }
            if ($val['module'] == 7) {
              $val['incurl'] = 'message/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=message&c=message_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
              $sum1 = '';
              $sums = array();
              $sums = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
              $sum1 = $sums['count(*)'];
              if ($sum1 > 99) {
                $sum1 = "99+";
              }
              $val['sum'] = $sum1;
              $contentlist[] = $val;
            }
            if ($val['module'] == 8) {
              $val['url'] = 'feedback/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['conturl'] = 'index.php?n=feedback&c=feedback_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
              $sum1 = '';
              $sums = array();
              $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val[id]' and lang='$lang' and readok='0'");
              $sum1 = $sums['count(*)'];
              if ($sum1 > 99) {
                $sum1 = "99+";
              }
              $val['sum'] = $sum1;
              $contentlist[] = $val;
            }
            //exit;
          }
        } elseif ($class2) {
          $class1 = $met_class[$class2]['bigclass'];
          if ($met_class[$class2]['isshow']) {
            $contentlistes[] = $met_class[$class2];
          }

          foreach ($met_class3[$class2] as $key => $val2) {
            if (!$val2['releclass'] && !$val2['if_in']) {
              $contentlistes[] = $val2;
            }

          }
          foreach ($contentlistes as $key => $val) {
            $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $val['set'] = "<div><p><a href='{$val[conturl]}'>{$_M[word][eidtcont]}</a></p></div>";
            $contentlist[] = $val;
          }
        } else {
          foreach ($met_class1 as $key => $val) {
            if ($val['module'] < 9 && !$val['if_in']) {
              $contentlistes[] = $val;
            }
          }
          foreach ($contentlistes as $key => $val) {
            $purview = 'admin_popc' . $val['id'];
            $purview = $$purview;
            $metcmspr = is_have_power('c'. $val['id']) ? 1 : 0;
            $metcmspr1 = $val[classtype] == 1 || $val[releclass] ? 1 : 0;
            $metcmspr = $metcmspr1 ? $metcmspr : 1;
            if ($metcmspr) {
              $sum = '';
              $sum1 = '';
              $sum2 = '';
              $sum3 = '';
              $sum_count = array();
              switch ($val['module']) {
              case '1':
                $c2 = count($met_class2[$val['id']]);

                if ($val['releclass']) {
                  $c2 = count($met_class3[$val['id']]);
                }

                $classname = $c2 ? "class='lt'" : '';
                $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                $val['url'] = '?n=about&c=about_admin&a=doindex&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                $val['set'] = "<div>";
                if ($val['isshow']) {
                  $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                }

                $classx = 'class1';
                if ($val['releclass'] && $c2) {
                  $classx = 'class2';
                }

                $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&lang={$lang}&module=1&{$classx}={$val['id']}&anyid={$anyid}" : $val[url];
                if ($val['isshow'] && $c2) {
                  $val['set'] .= '<span>-</span>';
                }

                if ($c2) {
                  $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                }

                $val['set'] .= '</div>';
                $sum_count = DB::get_all("select * from {$_M[table][column]} where lang='$lang' and bigclass='$val[id]'");
                foreach ($sum_count as $key => $val5) {
                  if ($val5[module] == 6) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
                    $sum1 = $sums['count(*)'];
                  }
                  if ($val5[module] == 7) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
                    $sum2 = $sums['count(*)'];
                  }
                  if ($val5[module] == 8) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val5[id]' and lang='$lang' and readok='0'");
                    $sum3 = $sums['count(*)'];
                  }
                  $sum = $sum1 + $sum2 + $sum3;
                  if ($sum > 99) {
                    $sum = "99+";
                  }
                }

                $val['sum'] = $sum;

                break;
              case '2':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  if ($val3[module] != 2 && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);
                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['url'] = 'article/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = $new_news_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
                }
                $sum_count = DB::get_all("select * from {$_M[table][column]} where lang='$lang' and bigclass='$val[id]'");
                foreach ($sum_count1 as $key => $val5) {
                  if ($val5[module] == 6) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
                    $sum1 = $sums['count(*)'];
                  }
                  if ($val5[module] == 7) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from  {$_M[table][message]} where lang='$lang' and readok='0'");
                    $sum2 = $sums['count(*)'];
                  }
                  if ($val5[module] == 8) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val5[id]' and lang='$lang' and readok='0'");
                    $sum3 = $sums['count(*)'];
                  }
                  $sum = $sum1 + $sum2 + $sum3;
                  if ($sum > 99) {
                    $sum = "99+";
                  }
                }

                $val['sum'] = $sum;
                break;
              case '3':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  if ($val3[module] != 3 && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);
                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['url'] = 'product/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = $new_product_module_url . '&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
                }
                $sum_count = DB::get_all("select * from {$_M[table][column]} where lang='$lang' and bigclass='$val[id]'");
                foreach ($sum_count as $key => $val5) {
                  if ($val5[module] == 6) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
                    $sum1 = $sums['count(*)'];
                  }
                  if ($val5[module] == 7) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
                    $sum2 = $sums['count(*)'];
                  }
                  if ($val5[module] == 8) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val5[id]' and lang='$lang' and readok='0'");
                    $sum3 = $sums['count(*)'];
                  }
                  $sum = $sum1 + $sum2 + $sum3;
                  if ($sum > 99) {
                    $sum = "99+";
                  }
                }

                $val['sum'] = $sum;
                break;
              case '4':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  if ($val3[module] != 4 && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);

                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['url'] = 'download/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = 'index.php?n=download&c=download_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
                }
                $sum_count = DB::get_all("select * from {$_M[table][column]} where lang='$lang' and bigclass='$val[id]'");
                foreach ($sum_count as $key => $val5) {
                  if ($val5[module] == 6) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
                    $sum1 = $sums['count(*)'];
                  }
                  if ($val5[module] == 7) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
                    $sum2 = $sums['count(*)'];
                  }
                  if ($val5[module] == 8) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val5[id]' and lang='$lang' and readok='0'");
                    $sum3 = $sums['count(*)'];
                  }
                  $sum = $sum1 + $sum2 + $sum3;
                  if ($sum > 99) {
                    $sum = "99+";
                  }
                }

                $val['sum'] = $sum;
                break;
              case '5':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  $column_types5 = array();
                  $column_types5 = DB::get_one("select * from {$_M[table][column]} where id='$val3[bigclass]'");
                  if (($val3[module] != 5 || $val3[foldername] != $column_types5[foldername]) && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);
                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['url'] = 'img/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = 'index.php?n=img&c=img_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                  <p class='lt'><a href='{$val[url]}'>{$_M[word][addinfo]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p>
                  </div>";
                }
                $sum_count = DB::get_all("select * from {$_M[table][column]} where lang='$lang' and bigclass='$val[id]'");
                foreach ($sum_count as $key => $val5) {
                  if ($val5[module] == 6) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
                    $sum1 = $sums['count(*)'];
                  }
                  if ($val5[module] == 7) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
                    $sum2 = $sums['count(*)'];
                  }
                  if ($val5[module] == 8) {
                    $sums = array();
                    $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val5[id]' and lang='$lang' and readok='0'");
                    $sum3 = $sums['count(*)'];
                  }
                  $sum = $sum1 + $sum2 + $sum3;
                  if ($sum > 99) {
                    $sum = "99+";
                  }
                }

                $val['sum'] = $sum;
                break;
              case '6':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  if ($val3[module] != 6 && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);
                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['url'] = 'job/content.php?class1=' . $val[id] . '&action=add&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = 'index.php?n=job&c=job_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['incurl'] = 'job/inc.php?lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['cvurl'] = 'job/cv.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>
                  <p class='lt'><a href='{$val[conturl]}'>{$_M[word][manager]}</a></p><span>-</span>
                  <p class='rt'><a href='{$val[cvurl]}'>{$_M[word][cveditorTitle]}</a></p>
                  </div>
                  ";
                }
                $sums = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
                $sum1 = $sums['count(*)'];
                if ($sum1 > 99) {
                  $sum1 = "99+";
                }
                $val['sum'] = $sum1;

                break;
              case '7':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  if ($val3[module] != 7 && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);
                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['incurl'] = 'message/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = 'index.php?n=message&c=message_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtmsg]}</a></div>";
                }
                $sums = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
                $sum1 = $sums['count(*)'];
                if ($sum1 > 99) {
                  $sum1 = "99+";
                }
                $val['sum'] = $sum1;
                break;
              case '8':
                $contentlistes1 = array();
                $content_type = 0;
                foreach ($met_class2[$val[id]] as $key => $val2) {
                  $contentlistes1[] = $val2;
                }
                foreach ($contentlistes1 as $key => $val3) {
                  if ($val3[module] != 8 && $val3[module] != 0 && $val3[module] < 100) {
                    $content_type++;
                  }
                }
                if ($content_type > 0) {
                  $c2 = count($met_class2[$val['id']]);
                  if ($val['releclass']) {
                    $c2 = count($met_class3[$val['id']]);
                  }

                  $classname = $c2 ? "class='lt'" : '';
                  $classname1 = $c2 && $val['isshow'] ? "class='rt'" : '';
                  $val['url'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div>";
                  if ($val['isshow']) {
                    $val['set'] .= "<p {$classname}><a href='{$val[url]}'>{$_M[word][eidtcont]}</a></p>";
                  }

                  $classx = 'class1';
                  if ($val['releclass'] && $c2) {
                    $classx = 'class2';
                  }

                  $val['conturl'] = $c2 ? "?n=manage&c=index&a=doindex&anyid={$anyid}&lang={$lang}&{$classx}={$val['id']}" : $val[url];
                  if ($val['isshow'] && $c2) {
                    $val['set'] .= '<span>-</span>';
                  }

                  if ($c2) {
                    $val['set'] .= "<p {$classname1}><a href='{$val[conturl]}'>{$_M[word][subpart]}</a></p>";
                  }

                  $val['set'] .= '</div>';
                } else {
                  $val['url'] = 'feedback/inc.php?class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['conturl'] = 'index.php?n=feedback&c=feedback_admin&a=doindex&class1=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                  $val['set'] = "<div><a href='{$val[conturl]}'>{$_M[word][eidtfed]}</a></div>";
                }
                $sums = DB::get_one("select count(*) from {$_M[table][feedback]} where class1='$val[id]' and lang='$lang' and readok='0'");
                $sum1 = $sums['count(*)'];
                if ($sum1 > 99) {
                  $sum1 = "99+";
                }
                $val['sum'] = $sum1;
                break;
              }
              $contentlist[] = $val;
            }
          }
        }
      }
    } else {
      if ($module) {
        if ($class1) {
          if ($met_class1[$class1]['isshow']) {
            $met_class1[$class1]['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $met_class1[$class1][id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $contentlist[0] = $met_class1[$class1];
          }
          foreach ($met_class2[$class1] as $key => $val) {
            if ($val['module'] == $module) {
              $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              if (count($met_class3[$val['id']])) {
                $val['conturl'] = "?anyid={$anyid}&lang={$lang}&module=1&class2={$val['id']}";
              }

              $contentlist[] = $val;
            }
          }
        } elseif ($class2) {
          if ($met_class[$class2]['isshow']) {
            $met_class[$class2]['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $met_class[$class2][id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $contentlist[0] = $met_class[$class2];
          }
          foreach ($met_class3[$class2] as $key => $val) {
            if ($val['module'] == $module) {
              $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              $contentlist[] = $val;
            }
          }
        } else {
          switch ($module) {
          case 1:
            foreach ($met_class1 as $key => $val) {
              if ($val['module'] == 1) {
                $val['conturl'] = '?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
                if (count($met_class2[$val['id']])) {
                  $val['conturl'] = "?anyid={$anyid}&lang={$lang}&module=1&class1={$val['id']}";
                }

                $contentlist[] = $val;
              }
            }
            break;
          }
        }
      } else {
        foreach ($met_class1 as $key => $val) {
          if ($val['module'] == 1) {
            $md1[] = $val;
          }
        }
        $query = "select * from {$_M[table][column]} where lang='$lang' order by no_order";
        $result = DB::query($query);
        while ($list = DB::fetch_array($result)) {
          if (!is_have_power('c'. $list['id']) && ($list[classtype] == 1 || $list[releclass] != 0)) {
            continue;
          }

          if ($list[classtype] == 1) {
            $met_class1[$list['id']] = $list;
          }
          if (($list[classtype] == 1 or ($list[releclass] > 0 and ($list[module] <= 7 || $list[module] == 8))) and $list[if_in] == 0) {
            $met_classindex[$list[module]][] = $list;
          }

        }
        if (count($met_classindex[1]) != 0) {
          $contentlist[1]['name'] = $_M[word][modulemanagement1];
          $contentlist[1]['module'] = '1';
          $contentlist[1]['conturl'] = "index.php?n=about&c=about_admin&a=doeditor&module=1&lang=$lang&anyid={$anyid}";
        }
        if (count($met_classindex[2]) != 0) {
          $contentlist[2]['name'] = $_M[word][modulemanagement2];
          $contentlist[2]['module'] = '2';
          $contentlist[2]['conturl'] = $new_news_module_url . "&module=2&lang=$lang&anyid=$anyid";
          $contentlist[2]['url'] = "article/content.php?action=add&lang=$lang&anyid=$anyid";
          $contentlist[2]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[2][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[2][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
        }
        if (count($met_classindex[3]) != 0) {
          $contentlist[3]['name'] = $_M[word][modulemanagement3];
          $contentlist[3]['module'] = '3';
          $contentlist[3]['conturl'] = $new_product_module_url . "&module=3&lang=$lang&anyid=$anyid";
          $contentlist[3]['url'] = "product/content.php?action=add&lang=$lang&anyid=$anyid";
          $contentlist[3]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[3][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[3][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
        }
        if (count($met_classindex[4]) != 0) {
          $contentlist[4]['name'] = $_M[word][modulemanagement4];
          $contentlist[4]['module'] = '4';
          $contentlist[4]['conturl'] = "index.php?n=download&c=download_admin&a=doindex&module=4&lang=$lang&anyid=$anyid";
          $contentlist[4]['url'] = "download/content.php?action=add&lang=$lang&anyid=$anyid";
          $contentlist[4]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[4][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[4][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
        }
        if (count($met_classindex[5]) != 0) {
          $contentlist[5]['name'] = $_M[word][modulemanagement5];
          $contentlist[5]['module'] = '5';
          $contentlist[5]['conturl'] = "index.php?n=img&c=img_admin&a=doindex&module=5&lang=$lang&anyid=$anyid";
          $contentlist[5]['url'] = "img/content.php?action=add&lang=$lang&anyid=$anyid";
          $contentlist[5]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[5][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[5][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
        }
        if (count($met_classindex[6]) != 0) {
          $sum = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
          if ($sum['count(*)'] > 99) {
            $sum['count(*)'] = "99+";
          }
          $contentlist[6]['sum'] = $sum['count(*)'];
          $contentlist[6]['name'] = $_M[word][modulemanagement6];
          $contentlist[6]['module'] = '6';
          $contentlist[6]['conturl'] = "index.php?n=job&c=job_admin&a=doindex&class1={$met_classindex[6][0][id]}&lang={$lang}&anyid={$anyid}";
          $contentlist[6]['cvurl'] = "job/cv.php?class1={$met_classindex[6][0][id]}&lang={$lang}&anyid={$anyid}";
          $contentlist[6]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[6]['conturl']}'>{$_M[word][manager]}</a></p><span>-</span>
        <p class='rt'><a href='{$contentlist[6]['cvurl']}'>{$_M[word][cveditorTitle]}</a></p>
        </div>
        ";
        }
        if (count($met_classindex[7]) != 0) {
          $sum = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
          if ($sum['count(*)'] > 99) {
            $sum['count(*)'] = "99+";
          }
          $contentlist[7]['sum'] = $sum['count(*)'];
          $contentlist[7]['name'] = $_M[word][modulemanagement7];
          $contentlist[7]['module'] = '7';
          $contentlist[7]['conturl'] = "index.php?n=message&c=message_admin&a=doindex&class1={$met_classindex[7][0][id]}&lang={$lang}&anyid={$anyid}";
        }
        if (count($met_classindex[8]) != 0) {
          $sum = DB::get_one("select count(*) from {$_M[table][feedback]} where lang='$lang' and readok='0'");
          if ($sum['count(*)'] > 99) {
            $sum['count(*)'] = "99+";
          }
          $contentlist[8]['sum'] = $sum['count(*)'];
          $contentlist[8]['name'] = $_M[word][modulemanagement8];
          $contentlist[8]['module'] = '8';
          $contentlist[8]['conturl'] = "index.php?n=feedback&c=feedback_admin&a=doindex&class1={$met_classindex[8][0][id]}&lang={$lang}&anyid={$anyid}";
        }

      }

    }

    require_once $this->template('own/index');
  }

  public function doceshi() {
    global $_M;
    $array = column_sorting(2);
    $lang = $this->lang;
    $anyid = $_M[form][anyid];
    $metinfo_admin_name = get_met_cookie('metinfo_admin_name');
    $metinfo_admin_pop = get_met_cookie('metinfo_admin_pop');
    $met_class1 = $array['class1'];
    $met_class2 = $array['class2'];
    $met_class3 = $array['class3'];
    foreach ($met_class1 as $key => $val) {
      if ($val['module'] == 1) {
        $md1[] = $val;
      }
    }
    $query = "select * from {$_M[table][column]} where lang='$lang' order by no_order";
    $result = DB::query($query);
    while ($list = DB::fetch_array($result)) {
      $admin_column_power = "admin_popc" . $list[id];
      if (!is_have_power('c'. $list['id']) && ($list[classtype] == 1 || $list[releclass] != 0)) {
        continue;
      }

      if ($list[classtype] == 1) {
        $met_class1[$list['id']] = $list;
      }
      if (($list[classtype] == 1 or ($list[releclass] > 0 and ($list[module] <= 7 || $list[module] == 8))) and $list[if_in] == 0) {
        $met_classindex[$list[module]][] = $list;
      }

    }
    if (count($met_classindex[1]) != 0) {
      $contentlist[1]['name'] = $_M[word][modulemanagement1];
      $contentlist[1]['module'] = '1';
      $contentlist[1]['conturl'] = "index.php?n=about&c=about_admin&a=doeditor&module=1&lang=$lang&anyid={$anyid}";
    }
    if (count($met_classindex[2]) != 0) {
      $contentlist[2]['name'] = $_M[word][modulemanagement2];
      $contentlist[2]['module'] = '2';
      $contentlist[2]['conturl'] = $new_news_module_url . "&module=2&lang=$lang&anyid=$anyid";
      $contentlist[2]['url'] = "article/content.php?action=add&lang=$lang&anyid=$anyid";
      $contentlist[2]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[2][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[2][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
    }
    if (count($met_classindex[3]) != 0) {
      $contentlist[3]['name'] = $_M[word][modulemanagement3];
      $contentlist[3]['module'] = '3';
      $contentlist[3]['conturl'] = $new_product_module_url . "&module=3&lang=$lang&anyid=$anyid";
      $contentlist[3]['url'] = "product/content.php?action=add&lang=$lang&anyid=$anyid";
      $contentlist[3]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[3][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[3][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
    }
    if (count($met_classindex[4]) != 0) {
      $contentlist[4]['name'] = $_M[word][modulemanagement4];
      $contentlist[4]['module'] = '4';
      $contentlist[4]['conturl'] = "index.php?n=download&c=download_admin&a=doindex&module=4&lang=$lang&anyid=$anyid";
      $contentlist[4]['url'] = "download/content.php?action=add&lang=$lang&anyid=$anyid";
      $contentlist[4]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[4][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[4][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
    }
    if (count($met_classindex[5]) != 0) {
      $contentlist[5]['name'] = $_M[word][modulemanagement5];
      $contentlist[5]['module'] = '5';
      $contentlist[5]['conturl'] = "index.php?n=img&c=img_admin&a=doindex&module=5&lang=$lang&anyid=$anyid";
      $contentlist[5]['url'] = "img/content.php?action=add&lang=$lang&anyid=$anyid";
      $contentlist[5]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[5][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[5][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
    }
    if (count($met_classindex[6]) != 0) {
      $sum = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
      if ($sum['count(*)'] > 99) {
        $sum['count(*)'] = "99+";
      }
      $contentlist[6]['sum'] = $sum['count(*)'];
      $contentlist[6]['name'] = $_M[word][modulemanagement6];
      $contentlist[6]['module'] = '6';
      $contentlist[6]['conturl'] = "index.php?n=job&c=job_admin&a=doindex&class1={$met_classindex[6][0][id]}&lang={$lang}&anyid={$anyid}";
      $contentlist[6]['cvurl'] = "job/cv.php?class1={$met_classindex[6][0][id]}&lang={$lang}&anyid={$anyid}";
      $contentlist[6]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[6]['conturl']}'>{$_M[word][manager]}</a></p><span>-</span>
        <p class='rt'><a href='{$contentlist[6]['cvurl']}'>{$_M[word][cveditorTitle]}</a></p>
        </div>
        ";
    }
    if (count($met_classindex[7]) != 0) {
      $sum = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
      if ($sum['count(*)'] > 99) {
        $sum['count(*)'] = "99+";
      }
      $contentlist[7]['sum'] = $sum['count(*)'];
      $contentlist[7]['name'] = $_M[word][modulemanagement7];
      $contentlist[7]['module'] = '7';
      $contentlist[7]['conturl'] = "index.php?n=message&c=message_admin&a=doindex&class1={$met_classindex[7][0][id]}&lang={$lang}&anyid={$anyid}";
    }
    if (count($met_classindex[8]) != 0) {
      $sum = DB::get_one("select count(*) from {$_M[table][feedback]} where lang='$lang' and readok='0'");
      if ($sum['count(*)'] > 99) {
        $sum['count(*)'] = "99+";
      }
      $contentlist[8]['sum'] = $sum['count(*)'];
      $contentlist[8]['name'] = $_M[word][modulemanagement8];
      $contentlist[8]['module'] = '8';
      $contentlist[8]['conturl'] = "index.php?n=feedback&c=feedback_admin&a=doindex&class1={$met_classindex[8][0][id]}&lang={$lang}&anyid={$anyid}";
    }

    return $contentlist;

  }

  public function domodule() {
    global $_M;
    $array = column_sorting(2);
    $lang = $this->lang;
    $anyid = $_M[form][anyid];
    $metinfo_admin_name = get_met_cookie('metinfo_admin_name');
    $metinfo_admin_pop = get_met_cookie('metinfo_admin_pop');
    $met_content_type = 2;
    $met_class1 = $array['class1'];
    $met_class2 = $array['class2'];
    $met_class3 = $array['class3'];
    $query = "select * from {$_M[table][column]} where lang='$lang' order by no_order";
    $result = DB::query($query);
    $power = background_privilege();
    while ($list = DB::fetch_array($result)) {
      if (!is_have_power('c'. $list['id']) && ($list[classtype] == 1 || $list[releclass] != 0)) {
        continue;
      }

      if ($list[classtype] == 1) {
        $met_class1[$list['id']] = $list;
      }
      if (($list[classtype] == 1 or ($list[releclass] > 0 and ($list[module] <= 7 || $list[module] == 8))) and $list[if_in] == 0) {
        $met_classindex[$list[module]][] = $list;
      }

    }
    if ($module) {
      if ($class1) {
        if ($met_class1[$class1]['isshow']) {
          $met_class1[$class1]['conturl'] = 'index.php?n=about&c=about_admin&a=doeditor&id=' . $met_class1[$class1][id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
          $contentlist[0] = $met_class1[$class1];
        }
        foreach ($met_class2[$class1] as $key => $val) {
          if ($val['module'] == $module) {
            $val['conturl'] = 'index.php?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            if (count($met_class3[$val['id']])) {
              $val['conturl'] = "?anyid={$anyid}&lang={$lang}&module=1&class2={$val['id']}";
            }

            $contentlist[] = $val;
          }
        }
      } elseif ($class2) {
        if ($met_class[$class2]['isshow']) {
          $met_class[$class2]['conturl'] = 'index.php?n=about&c=about_admin&a=doeditor&id=' . $met_class[$class2][id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
          $contentlist[0] = $met_class[$class2];
        }
        foreach ($met_class3[$class2] as $key => $val) {
          if ($val['module'] == $module) {
            $val['conturl'] = 'index.php?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
            $contentlist[] = $val;
          }
        }
      } else {
        switch ($module) {
        case 1:
          foreach ($met_class1 as $key => $val) {
            if ($val['module'] == 1) {
              $val['conturl'] = 'index.php?n=about&c=about_admin&a=doeditor&id=' . $val[id] . '&lang=' . $lang . '&anyid=' . $_M[form][anyid];
              if (count($met_class2[$val['id']])) {
                $val['conturl'] = "?anyid={$anyid}&lang={$lang}&module=1&class1={$val['id']}";
              }

              $contentlist[] = $val;
            }
          }
          break;
        }
      }
    } else {
      foreach ($met_class1 as $key => $val) {
        if ($val['module'] == 1) {
          $md1[] = $val;
        }
      }
      if (count($met_classindex[1]) != 0) {
        $contentlist[1]['name'] = $_M[word][modulemanagement1];
        $contentlist[1]['module'] = '1';
        $contentlist[1]['conturl'] = "index.php?n=about&c=about_admin&a=doeditor&lang=$lang";
        $contentlist[1]['conturl'] = "index.php?n=about&c=about_admin&a=doindex&lang=$lang&anyid=$anyid";
      }
      if (count($met_classindex[2]) != 0) {
        $contentlist[2]['name'] = $_M[word][modulemanagement2];
        $contentlist[2]['module'] = '2';
        $contentlist[2]['conturl'] = "index.php?n=news&c=news_admin&a=doindex&module=2&lang=$lang&anyid=$anyid";
        $contentlist[2]['url'] = $_M[url][site_admin] . "index.php?n=news&c=news_admin&a=doindex&lang=$lang&anyid=$anyid";
        $contentlist[2]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[2][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[2][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
      }
      if (count($met_classindex[3]) != 0) {
        $contentlist[3]['name'] = $_M[word][modulemanagement3];
        $contentlist[3]['module'] = '3';
        $contentlist[3]['conturl'] = "index.php?n=product&c=product_admin&a=doindex&module=3&lang=$lang&anyid=$anyid";
        $contentlist[3]['url'] = "product/content.php?action=add&lang=$lang&anyid=$anyid";
        $contentlist[3]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[3][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[3][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
      }
      if (count($met_classindex[4]) != 0) {
        $contentlist[4]['name'] = $_M[word][modulemanagement4];
        $contentlist[4]['module'] = '4';
        $contentlist[4]['conturl'] = "index.php?n=download&c=download_admin&a=doindex&lang=$lang&anyid=$anyid";
        $contentlist[4]['url'] = "download/content.php?action=add&lang=$lang&anyid=$anyid";
        $contentlist[4]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[4][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[4][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
      }
      if (count($met_classindex[5]) != 0) {
        $contentlist[5]['name'] = $_M[word][modulemanagement5];
        $contentlist[5]['module'] = '5';
        $contentlist[5]['conturl'] = "index.php?n=img&c=img_admin&a=doindex&module=5&lang=$lang&anyid=$anyid";
        $contentlist[5]['url'] = "img/content.php?action=add&lang=$lang&anyid=$anyid";
        $contentlist[5]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[5][url]}'>{$_M[word][addinfo]}</a></p><span>-</span><p class='rt'><a href='{$contentlist[5][conturl]}'>{$_M[word][manager]}</a></p>
        </div>";
      }
      if (count($met_classindex[6]) != 0) {
        $sum = DB::get_one("select count(*) from {$_M[table][cv]} where lang='$lang' and readok='0'");
        if ($sum['count(*)'] > 99) {
          $sum['count(*)'] = "99+";
        }
        $contentlist[6]['sum'] = $sum['count(*)'];
        $contentlist[6]['name'] = $_M[word][modulemanagement6];
        $contentlist[6]['module'] = '6';
        $contentlist[6]['conturl'] = "index.php?n=job&c=job_admin&a=doindex&class1={$met_classindex[6][0][id]}&lang={$lang}&anyid=$anyid";
        $contentlist[6]['cvurl'] = "job/cv.php?class1={$met_classindex[6][0][id]}&lang={$lang}&anyid={$anyid}";
        $contentlist[6]['set'] = "<div>
        <p class='lt'><a href='{$contentlist[6]['conturl']}'>{$_M[word][manager]}</a></p><span>-</span>
        <p class='rt'><a href='{$contentlist[6]['cvurl']}'>{$_M[word][cveditorTitle]}</a></p>
        </div>
        ";
      }
      if (count($met_classindex[7]) != 0) {
        $sum = DB::get_one("select count(*) from {$_M[table][message]} where lang='$lang' and readok='0'");
        if ($sum['count(*)'] > 99) {
          $sum['count(*)'] = "99+";
        }
        $contentlist[7]['sum'] = $sum['count(*)'];
        $contentlist[7]['name'] = $_M[word][modulemanagement7];
        $contentlist[7]['module'] = '7';
        $contentlist[7]['conturl'] = "index.php?n=message&c=message_admin&a=doindex&class1={$met_classindex[7][0][id]}&lang={$lang}&anyid={$anyid}";
      }
      if (count($met_classindex[8]) != 0) {
        $sum = DB::get_one("select count(*) from {$_M[table][feedback]} where lang='$lang' and readok='0'");
        if ($sum['count(*)'] > 99) {
          $sum['count(*)'] = "99+";
        }
        $contentlist[8]['sum'] = $sum['count(*)'];
        $contentlist[8]['name'] = $_M[word][modulemanagement8];
        $contentlist[8]['module'] = '8';
        $contentlist[8]['conturl'] = "index.php?n=feedback&c=feedback_admin&a=doindex&class1={$met_classindex[8][0][id]}&lang={$lang}&anyid=$anyid";
      }

    }
    $css_url = "templates/" . $met_skin . "/css";
    $img_url = "templates/met/" . $met_skin . "images";
    require_once $this->template('own/index');
  }

/*栏目搜索*/
  public function dosearch() {
    global $_M;
    $id = unescape($_M[form][id]);
    $img_url = "templates/met/" . $met_skin . "images";
    $query = "select * from {$_M[table][column]} where name like '%{$id}%' and lang='{$this->lang}'";
    $contentlist = DB::get_all($query);
    foreach ($contentlist as $key => $val) {
      $vimgurl = 'tubiao_' . $val[module] . '.png';
      $metinfo .= "<li class='contlist'>
      <div class='box'>
        <a href='{$val[conturl]}'>
          <img src='{$img_url}/metv5/{$vimgurl}?new' width='70' height='70' />";
      if ($val[sum]) {
        $metinfo .= "<span class='cloumn_num'>{$val[sum]}</span>";
      }
      $metinfo .= "<h2>{$val['name']}</h2>
        </a>
      </div>
    </li>";
    }
    if ($id != null) {
      echo "<script language='JavaScript'>
    document.getElementById('loading').style.display='none';
    </script> ";
      if ($metinfo) {
        echo $metinfo;
      } else {
        echo "<div class='proccess1' ><img src='../../upload/image/Noresults.png' width='150' height='150' /><br>{$lang_search_Noresults}</div>";
      }
    } else {
      echo "<script language='JavaScript'>
    document.getElementById('loading').style.display='none';
    </script> ";
      echo $metinfo1;
    }

  }

}