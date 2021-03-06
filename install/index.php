<?php
# MetInfo Enterprise Content Management System ceshi
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
if (!defined('IN_MET')) {
    define('IN_MET', true);
}
require_once '../app/system/include/function/web.func.php';

class install
{
    public $install_url;
    public $error;

    public function __construct()
    {
        global $_M, $install_url;
        header("Content-type: text/html;charset=utf-8");
        error_reporting(E_ERROR | E_PARSE);
        @set_time_limit(0);
        ini_set("magic_quotes_runtime", 0);
        session_start();

        self::deldir_in('../cache', 1);
        $localurl = "http://";
        $localurl .= $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"];
        $install_url = $localurl;

        self::getFormData();
        $this->error = array();
        self::checkInstallLock();
    }

    private function checkInstallLock()
    {
        if (file_exists('../config/install.lock')) {
            exit('对不起，该程序已经安装过了。<br/>
	      如你要重新安装，请手动删除config/install.lock文件。');
        }
    }

    public function doInstall()
    {
        $action = $_GET['action'];
        switch ($action) {
            case 'apitest':
                $post = array('domain' => $_SERVER['HTTP_HOST']);
                self::curl_post($post, 15);
                break;
            default:
                $_SESSION['install'] = 'metinfo';
                $m_now_time = time();
                $m_now_date = date('Y-m-d H:i:s', $m_now_time);
                $nowyear = date('Y', $m_now_time);
                include $this->template('index');
                break;
        }
    }

    /**
     * 系统环境检测
     */
    private function inspect()
    {
        global $url_static_new;
        if ($_SERVER['SERVER_PORT'] == 443 || $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 || $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https' || $_SERVER['HTTP_FROM_HTTPS'] == 'on' || $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $http = 'https://';
        } else {
            $http = 'http://';
        }

        $site_url = str_ireplace('/index.php', '', $http . $_SERVER['HTTP_HOST'] . preg_replace("/[0-9A-Za-z-_]+\/\w+\.php$/", '', $_SERVER['PHP_SELF']));
        require_once '../app/system/include/class/handle.class.php';
        $handle = new handle();
        $data = $handle->checkFunction($site_url);
        $dirs = $handle->checkDirs();

        include $this->template('inspect');
    }

    /**
     * 检查米拓API
     * @param $post
     * @param $timeout
     * @return bool|string
     */
    private function curl_post($post, $timeout)
    {
        global $met_weburl, $met_host, $met_file;
        $host = 'u.mituo.cn';
        $file = '/api/client';
        if (get_extension_funcs('curl') && function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec') && function_exists('curl_close')) {
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, 'https://' . $host . $file);
            curl_setopt($curlHandle, CURLOPT_REFERER, $met_weburl);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curlHandle, CURLOPT_POST, 1);
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, false);
            $result = curl_exec($curlHandle);

            curl_close($curlHandle);
        } else {
            if (function_exists('fsockopen') || function_exists('pfsockopen')) {
                $post_data = $post;
                $post = '';
                @ini_set("default_socket_timeout", $timeout);
                while (list($k, $v) = each($post_data)) {
                    $post .= rawurlencode($k) . "=" . rawurlencode($v) . "&";
                }
                $post = substr($post, 0, -1);
                $len = strlen($post);
                if (function_exists(fsockopen)) {
                    $fp = @fsockopen($host, 80, $errno, $errstr, $timeout);
                } else {
                    $fp = @pfsockopen($host, 80, $errno, $errstr, $timeout);
                }
                if (!$fp) {
                    $result = '';
                } else {
                    $result = '';
                    $out = "POST $file HTTP/1.0\r\n";
                    $out .= "Host: $host\r\n";
                    $out .= "Referer: $met_weburl\r\n";
                    $out .= "Content-type: application/x-www-form-urlencoded\r\n";
                    $out .= "Connection: Close\r\n";
                    $out .= "Content-Length: $len\r\n";
                    $out .= "\r\n";
                    $out .= $post . "\r\n";
                    fwrite($fp, $out);
                    $inheader = 1;
                    while (!feof($fp)) {
                        $line = fgets($fp, 1024);
                        if ($inheader == 0) {
                            $result .= $line;
                        }
                        if ($inheader && ($line == "\n" || $line == "\r\n")) {
                            $inheader = 0;
                        }
                    }

                    while (!feof($fp)) {
                        $result .= fgets($fp, 1024);
                    }
                    fclose($fp);
                    str_replace($out, '', $result);
                }
            } else {
                $result = '';
            }
        }
        $result = trim($result);
        $res = json_decode($result, true);
        if (isset($res['status'])) {
            echo 'ok';die;
        } else {
            echo 'nohost';die;
        }
    }

    private function db_setup()
    {
        global $_M, $db_prefix;
        $setup = $_M['form']['setup'];
        $db_prefix = $_M['form']['db_prefix'];
        $db_host = $_M['form']['db_host'];
        $db_username = $_M['form']['db_username'];
        $db_pass = $_M['form']['db_pass'];
        $db_name = $_M['form']['db_name'];
        $cndata = $_M['form']['cndata'];
        $endata = $_M['form']['endata'];
        $showdata = $_M['form']['showdata'];
        $admin_cndata = $_M['form']['admin_cndata'];
        $admin_endata = $_M['form']['admin_endata'];
        $lang = $_M['form']['lang'];

        if ($setup == 1) {
            $db_prefix = trim($db_prefix);
            $this->db_prefix = $db_prefix;
            if (strstr($db_host, ":")) {
                $arr = explode(":", $db_host);
                $db_host = $arr[0];
                $db_port = $arr[1];
            } else {
                $db_host = trim($db_host);
                $db_port = "3306";
            }
            $db_username = trim($db_username);
            $db_pass = trim($db_pass);
            $db_name = trim($db_name);
            $db_port = trim($db_port);
            $config = "<?php
                   /*
                   con_db_host = \"$db_host\"
                   con_db_port = \"$db_port\"
                   con_db_id   = \"$db_username\"
                   con_db_pass	= \"$db_pass\"
                   con_db_name = \"$db_name\"
                   tablepre    =  \"$db_prefix\"
                   db_charset  =  \"utf8\";
                  */
                  ?>";

            $fp = fopen("../config/config_db.php", 'w+');
            fputs($fp, $config);
            fclose($fp);
            $db = mysqli_connect($db_host, $db_username, $db_pass, '', $db_port);
            if (!$db) {
                $this->error[] = '连接数据库失败: ' . mysqli_connect_error();
                $this->error();
            }
            if (!@mysqli_select_db($db, $db_name)) {
                $res = mysqli_query($db, "CREATE DATABASE $db_name ");
                if (!$res) {
                    $this->error[] = '创建数据库失败: ' . mysqli_error($db);
                    $this->error();
                }
            }
            mysqli_select_db($db, $db_name);
            if (mysqli_get_server_info($db) > 4.1) {
                mysqli_query($db, "set names utf8");
            }
            if (mysqli_get_server_info($db) > '5.0.1') {
                mysqli_query($db, "SET sql_mode=''");
            }
            if (mysqli_get_server_info($db) >= '4.1') {
                mysqli_query($db, "set names utf8");
                $content = self::readover("sql.sql");
                #$content=preg_replace("/{#(.+?)}/eis",'$lang[\\1]',$content);
                $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                    return $lang[$r[1]];
                }, $content);
                $installinfo = self::creat_table($content, $db);
            } else {
                echo "<SCRIPT language=JavaScript>alert('你的mysql版本过低，请确保你的数据库编码为utf-8,官方建议你升级到mysql4.1.0以上');</SCRIPT>";
                $content = self::readover("sql.sql");
                $content = str_replace('ENGINE=MyISAM DEFAULT CHARSET=utf8', 'TYPE=MyISAM', $content);
            }

            //前台语言及配置
            if ($cndata == "yes") {
                $content = self::readover("config_cn.sql");
                #$content=preg_replace("/{#(.+?)}/eis",'$lang[\\1]',$content);
                $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                    return $lang[$r[1]];
                }, $content);
                $installinfo .= self::creat_table($content, $db);
            }
            if ($endata == "yes") {
                $content = self::readover("config_en.sql");
                #$content=preg_replace("/{#(.+?)}/eis",'$lang[\\1]',$content);
                $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                    return $lang[$r[1]];
                }, $content);
                $installinfo .= self::creat_table($content, $db);

            }

            //演示数据
            if ($showdata == 'yes') {
                if ($cndata == "yes") {
                    $content = self::readover("demo_cn.sql");
                    #$content=preg_replace("/{#(.+?)}/eis",'$lang[\\1]',$content);
                    $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                        return $lang[$r[1]];
                    }, $content);
                    $installinfo .= self::creat_table($content, $db);

                    #self::doInitialize('cn',$db);
                }
                if ($endata == "yes") {
                    $content = self::readover("demo_en.sql");
                    #$content=preg_replace("/{#(.+?)}/eis",'$lang[\\1]',$content);
                    $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                        return $lang[$r[1]];
                    }, $content);
                    $installinfo .= self::creat_table($content, $db);

                    #self::doInitialize('en',$db);
                }
            }

            if ($admin_cndata == "yes") {
                $content = self::readover("lang_cn.sql");
                $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                    return $lang[$r[1]];
                }, $content);
                $installinfo .= self::creat_table($content, $db);
            }
            if ($admin_endata == "yes") {
                $content = self::readover("lang_en.sql");
                $content = preg_replace_callback("/{#(.+?)}/is", function ($r) use ($lang) {
                    return $lang[$r[1]];
                }, $content);
                $installinfo .= self::creat_table($content, $db);
            }
            if ($this->error) {
                $this->error();
            }
            $rand_i = self::met_rand_i(32);
            file_put_contents('../config/config_safe.php', '<?php/* ' . $rand_i . '*/?>');
            echo "--><script>location.href=\"index.php?action=adminsetup&cndata={$cndata}&endata={$endata}&showdata={$showdata}\";</script>";
            exit;
        } else {
            include $this->template('databasesetup');
        }
    }

    /**
     * 创建数据表
     * @param $content
     * @param $link
     * @return string
     */
    private function creat_table($content, $link)
    {
        global $installinfo, $db_prefix, $db_setup, $install_url;
        $install_url2 = str_replace("install/index.php", "", $install_url);
        $sql = explode("\n", $content);
        $query = '';
        $j = 0;
        $i = 0;
        foreach ($sql as $key => $value) {
            $value = trim($value);
            if (!$value || $value[0] == '#') {
                continue;
            }

            if (preg_match("/\;$/", $value)) {
                $query .= $value;
                if (preg_match("/^CREATE/", $query)) {
                    $name = substr($query, 13, strpos($query, '(') - 13);
                    $c_name = str_replace('met_', $db_prefix, $name);
                    $i++;
                }
                $query = str_replace('met_', $db_prefix, $query);
                $query = str_replace('metconfig_', 'met_', $query);
                $query = str_replace('web_metinfo_url', $install_url2, $query);
                if (!mysqli_query($link, $query) && !mysqli_error($link)) {
                    $db_setup = 0;
                    if ($j != '0') {
                        $this->error[] = '<li class="danger">出错：' . mysqli_error($link) . '<br/>sql:' . $query . '</li>';
                        #echo '<li class="danger">出错：' . mysqli_error($link) . '<br/>sql:' . $query . '</li>';
                    }
                } else {
                    #var_dump($query);
                    if (preg_match("/^CREATE/", $query)) {
                        $installinfo = $installinfo . '<li class="success"><font color="#0000EE">建立数据表' . $i . '</font>' . $c_name . ' ... <font color="#0000EE">完成</font></li>';
                    }
                    $db_setup = 1;
                }
                $query = '';
            } else {
                $query .= $value;
            }
            $j++;
        }
        return $installinfo;
    }

    private function adminsetup()
    {
        global $_M, $url_static_new;
        $setup = $_M['form']['setup'];
        $showdata = $_M['form']['showdata'];
        $regname = $_M['form']['regname'];
        $regpwd = $_M['form']['regpwd'];
        $email = $_M['form']['email'];
        $email_scribe = $_M['form']['email_scribe'];
        $tel = $_M['form']['tel'];
        $m_now_date = $_M['form']['m_now_date'];
        $cndata = $_M['form']['cndata'];
        $endata = $_M['form']['endata'];


        if ($setup == 1) {
            if ($regname == '' || $regpwd == '' /*|| $email==''*/) {
                echo ("<script type='text/javascript'> alert('请填写管理员信息！'); history.go(-1); </script>");
            }

            if ($email_scribe == 1) {
                $post = array(
                    'id' => '67d6b20a0ee8352affc40bd275b55299df2e04aded66c4e4',
                    't' => 'qf_booked_feedback',
                    'to' => "$email",
                );
                $yj = curl_post1($post, 45);
            }
            $regname = trim($regname);
            $regpwd = md5(trim($regpwd));
            $email = trim($email);

            $m_now_time = time();
            $config = parse_ini_file('../config/config_db.php', 'ture');
            @extract($config);
            $con_db_host = $config['con_db_host'];
            $con_db_id = $config['con_db_id'];
            $con_db_pass = $config['con_db_pass'];
            $con_db_name = $config['con_db_name'];
            $con_db_port = $config['con_db_port'];
            $tablepre = $config['tablepre'];

            $webname_cn = $_M['form']['webname_cn'];
            $webkeywords_cn = $_M['form']['webkeywords_cn'];
            $webname_en = $_M['form']['webname_en'];
            $webkeywords_en = $_M['form']['webkeywords_en'];
            $cndata = $_M['form']['cndata'];
            $endata = $_M['form']['endata'];
            $lang_index_type = $_M['form']['lang_index_type'];
            $se360 = $_M['form']['se360'];

            $link = mysqli_connect($con_db_host, $con_db_id, $con_db_pass, $con_db_name, $con_db_port);
            if (!$link) {
                $this->error[] = '连接数据库失败: ' . mysqli_connect_error();
                $this->error();
            }
            mysqli_select_db($link, $con_db_name);
            if (mysqli_get_server_info($link) > 4.1) {
                mysqli_query($link, "set names utf8");
            }
            if (mysqli_get_server_info($link) > '5.0.1') {
                mysqli_query($link, "SET sql_mode=''");
            }
            $met_admin_table = "{$tablepre}admin_table";
            $met_config = "{$tablepre}config";
            $met_column = "{$tablepre}column";
            $met_lang = "{$tablepre}lang";
            $met_templates = "{$tablepre}templates";
            $met_style_list = "{$tablepre}style_list";
            $met_style_config = "{$tablepre}style_config";

            $query = " INSERT INTO {$met_admin_table} set
                      admin_id           = '{$regname}',
                      admin_pass         = '{$regpwd}',
					  admin_introduction = '创始人',
					  admin_group        = '10000',
				      admin_type         = 'metinfo',
					  admin_email        = '{$email}',
					  admin_mobile       = '{$tel}',
					  admin_register_date= '{$m_now_date}',
					  admin_shortcut     = '[{\"name\":\"lang_skinbaseset\",\"url\":\"system/basic.php?anyid=9&lang=cn\",\"bigclass\":\"1\",\"field\":\"s1001\",\"type\":\"2\",\"list_order\":\"10\",\"protect\":\"1\",\"hidden\":\"0\",\"lang\":\"lang_skinbaseset\"},{\"name\":\"lang_indexcolumn\",\"url\":\"column/index.php?anyid=25&lang=cn\",\"bigclass\":\"1\",\"field\":\"s1201\",\"type\":\"2\",\"list_order\":\"0\",\"protect\":\"1\",\"hidden\":\"0\",\"lang\":\"lang_indexcolumn\"},{\"name\":\"lang_unitytxt_75\",\"url\":\"interface/skin_editor.php?anyid=18&lang=cn\",\"bigclass\":\"1\",\"field\":\"s1101\",\"type\":\"2\",\"list_order\":\"0\",\"protect\":\"1\",\"hidden\":\"0\",\"lang\":\"lang_unitytxt_75\"},{\"name\":\"lang_tmptips\",\"url\":\"interface/info.php?anyid=24&lang=cn\",\"bigclass\":\"1\",\"field\":\"\",\"type\":\"2\",\"list_order\":\"0\",\"protect\":\"1\",\"hidden\":\"0\",\"lang\":\"lang_tmptips\"},{\"name\":\"lang_mod2add\",\"url\":\"content/article/content.php?action=add&lang=cn\",\"bigclass\":\"1\",\"field\":\"\",\"type\":\"2\",\"list_order\":\"0\",\"protect\":\"0\",\"hidden\":\"0\",\"lang\":\"lang_mod2add\"},{\"name\":\"lang_mod3add\",\"url\":\"content/product/content.php?action=add&lang=cn\",\"bigclass\":\"1\",\"field\":\"\",\"type\":2,\"list_order\":\"0\",\"protect\":0}]',
					  usertype       = '3',
					  content_type   = '1',
					  admin_ok       = '1'";

            mysqli_query($link, $query) or die('写入数据库失败XXX: ' . mysqli_error($link));
            $query = " UPDATE {$met_config} set value='{$webname_cn}' where name='met_webname' and lang='cn'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            $met_skin_table = "{$tablepre}skin_table";
            $query = " UPDATE {$met_config} set value='{$webkeywords_cn}' where name='met_keywords' and lang='cn'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            $query = " UPDATE {$met_config} set value='{$webname_en}' where name='met_webname' and lang='en'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            $query = " UPDATE {$met_config} set value='{$webkeywords_en}' where name='met_keywords' and lang='en'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));

            $force = self::randStr(7);
            $query = " UPDATE {$met_config} set value='{$force}' where name='met_member_force'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            $install_url = str_replace("install/index.php", "", $install_url);
            $query = " UPDATE {$met_config} set value='{$install_url}' where name='met_weburl'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            $query = " UPDATE {$met_lang} set met_weburl='{$install_url}' where lang!='metinfo'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            $adminurl = $install_url . 'admin/';
            $query = " UPDATE {$met_column} set out_url='{$adminurl}' where module='0'";
            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));

            $SQL = "SELECT * FROM {$met_skin_table}";
            $query = mysqli_query($link, $SQL);
            #while($row=mysql_fetch_array($query)){
            while ($row = mysqli_fetch_array($query)) {
                $destination = "../templates/" . $row['skin_file'] . "/lang/language_tc.ini";
                if (!file_exists($destination)) {
                    $fp = fopen("$destination", "w+");
                    fclose($fp);
                    $source = "../templates/" . $row['skin_file'] . "/lang/language_cn.ini";
                    copy($source, $destination);
                }
            }

            if ($cndata == "yes" && $endata == "yes") {
                $query = "UPDATE {$met_config} set value='{$lang_index_type}' where name='met_index_type' and lang='metinfo'";
            } else {
                if ($cndata == "yes" or ($cndata != "yes" and $endata != "yes")) {
                    $query = "UPDATE {$met_config} set value='cn' where name='met_index_type' and lang='metinfo'";
                } else {
                    if ($endata == "yes") {
                        $query = "UPDATE {$met_config} set value='en' where name='met_index_type' and lang='metinfo'";
                    }
                }
            }

            mysqli_query($link, $query) or die('写入数据库失败: ' . mysqli_error($link));
            // @chmod('../config/config_db.php',0554);
            /*require_once '../include/mysql_class.php';
            $db = new dbmysql()*/;

            define('IN_MET', true);
            require_once '../app/system/include/class/mysql.class.php';
            $db = new DB();

            $db->dbconn($con_db_host, $con_db_id, $con_db_pass, $con_db_name, $con_db_port);

            //不安装演示数据时安装空模板
            if (!$showdata) {
                if ($cndata == 'yes') {
                    self::install_tag_templates($db, $met_templates, 'metv7', 'cn');
                }

                if ($endata == 'yes') {
                    self::install_tag_templates($db, $met_templates, 'metv7', 'en');
                }
            }

            //只安装英文时切换默认语言
            $admin_langnow = $db->get_one("SELECT * FROM {$tablepre}lang_admin where lang='cn'");
            if (!$admin_langnow) {
                $query = "update {$met_config} set value='en' where name='met_admin_type'";
                $db->query($query);
            }

            $conlist = $db->get_one("SELECT * FROM {$met_config} WHERE name='met_weburl'");
            $met_weburl = $conlist['value'];
            $indexcont = $db->get_one("SELECT * FROM {$met_config} WHERE name='met_index_content' and lang='cn'");
            if ($indexcont) {
                $index_content = str_replace("#metinfo#", $met_weburl, $indexcont['value']);
                $query = "update {$met_config} SET value = '{$index_content}' where name='met_index_content' and lang='cn'";
                $db->query($query);
            }
            $showlist = $db->get_all("SELECT * FROM {$met_column} WHERE module='1'");
            if ($showlist) {
                foreach ($showlist as $key => $val) {
                    $contentx = str_replace("#metinfo#", $met_weburl, $val['content']);
                    $query = "update {$met_column} SET content = '{$contentx}' where id='{$val['id']}'";
                    $db->query($query);
                }
            }

            $agents = '';
            if (file_exists('./agents.php')) {
                include './agents.php';
                unlink('./agents.php');
            }
            unlink('../cache/langadmin_cn.php');
            unlink('../cache/langadmin_en.php');
            unlink('../cache/lang_cn.php');
            unlink('../cache/lang_en.php');
            $query = "select * from $met_config where name='metcms_v'";
            $ver = $db->get_one($query);
            $webname = $webname_cn ? $webname_cn : ($webname_en ? $webname_en : '');
            $webkeywords = $webkeywords_cn ? $webkeywords_cn : ($webkeywords_en ? $webkeywords_en : '');
            $spt = '<script type="text/javascript" src="http://api.metinfo.cn/record_install.php?';
            $spt .= "url=" . $install_url;
            $spt .= "&email=" . $email . "&installtime=" . $m_now_date . "&softtype=1";
            $spt .= "&webname=" . $webname . "&webkeywords=" . $webkeywords . "&tel=" . $tel;
            $spt .= "&version=" . $ver['value'] . "&php_ver=" . PHP_VERSION . "&mysql_ver=" . mysqli_get_server_info($link) . "&browser=" . $_SERVER['HTTP_USER_AGENT'] . '|' . $se360;
            $spt .= "&agents=" . $agents;
            $spt .= '"></script>';
            echo $spt;
            $fp = @fopen('../config/install.lock', 'w');
            @fwrite($fp, " ");
            @fclose($fp);
            $metHOST = $_SERVER['HTTP_HOST'];
            $m_now_year = date('Y');
            $metcms_v = $ver['value'];
            @chmod('../config/install.lock', 0554);

            include $this->template('finished');
        } else {
            $langnum = ($cndata == "yes" || $endata == "yes") ? 2 : 1;
            $lang = $langnum == 2 ? '中文' : ($endata == "yes" && $cndata != "yes" ? '英文' : '中文');
            include $this->template('adminsetup');
        }
    }

    /***************/
    /**
     * 报错
     */
    public function error()
    {
        global $_M;
        $error_data = '';
        foreach ($this->error as $row) {
            $error_data .= '<li class="danger">' . $row . '</li>';
        }
        include $this->template('error');
        die();
    }

    /**
     * 获取表单内容
     */
    private function getFormData()
    {
        global $_M;
        $_M['form'];
        define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
        isset($_REQUEST['GLOBALS']) && exit('Access Error');
        foreach ($_COOKIE as $key => $val) {
            $_M['form'][$key] = $val;
        }
        foreach ($_GET as $key => $val) {
            $_M['form'][$key] = $val;
        }
        foreach ($_POST as $key => $val) {
            $_M['form'][$key] = $val;
        }
    }

    private function install_tag_templates($db, $templates, $skin_name, $lang)
    {
        $template_json = "../templates/{$skin_name}/install/template.json";

        if (file_exists($template_json)) {
            $configs = json_decode(file_get_contents($template_json), true);
            $query = "DELETE FROM {$templates} WHERE no = '{$skin_name}' AND lang = '{$lang}'";

            $db->query($query);
            foreach ($configs as $k => $v) {
                $cid = $v['id'];
                $sub = $v['sub'];
                $v['lang'] = $lang;
                unset($v['id'], $v['sub']);
                $v['no'] = $skin_name;
                $area_sql = $this->get_sql($v);
                $query = "INSERT INTO {$templates} SET {$area_sql}";
                $db->query($query);
                $area_id = $db->insert_id();
                foreach ($sub as $m => $s) {
                    unset($s['id']);
                    $s['lang'] = $lang;
                    $s['bigclass'] = $area_id;
                    $s['no'] = $skin_name;
                    $sub_sql = $this->get_sql($s);
                    $sub_query = "INSERT INTO {$templates} SET {$sub_sql}";

                    $db->query($sub_query);
                }
            }
        }
    }

    /**
     * 初始化系统UI配置
     */
    private function doInitialize($lang = '', $link = '')
    {
        echo "-->";
        $style_list = $this->db_prefix . 'style_list';
        $style_config = $this->db_prefix . 'style_config';
        $metui_dir = '';
        define('PATH_WEB', substr(dirname(__FILE__), 0, -7));
        define('IN_MET', 1);

        $query = "DELETE FROM {$style_list} WHERE lang='{$lang}'";
        mysqli_query($link, $query);
        $query = "DELETE FROM {$style_config} WHERE lang='{$lang}'";
        mysqli_query($link, $query);

        require_once '../app/system/style/include/class/style_op.class.php';
        $style_op = new style_op();

        $block_list = $list = array(
            'head_nav',
            'banner',
            'online',
            'head_nav',
            'mobile_menu',
            'page_list',
            'page_detail',
            'product_list_page',
            'news_list_page',
        );
        foreach ($block_list as $key => $block) {
            $ui_block = "$metui_dir/{$block}";
            $type_list = scandir($ui_block);
            foreach ($type_list as $k => $type) {
                if ($type != '.' && $type != '..' && is_numeric($type)) {
                    $install_res = $style_op->installMetui($block, $type, $lang);
                }
            }
        }

        $query = "UPDATE {$style_list} SET `effect` = 0 ";
        DB::query($query);
        $query = "UPDATE {$style_list} SET `effect` = 1 WHERE pid = 1";
        DB::query($query);
        die("OK");
    }
    /***************/
    /**
     * 加载模板
     * @param $template
     * @param string $ext
     * @return string
     */
    public function template($template, $ext = "php")
    {
        global $met_skin_user, $skin;
        unset($GLOBALS['con_db_id'], $GLOBALS['con_db_pass'], $GLOBALS['con_db_name']);
        $path = "templates/$template.$ext";
        return $path;
    }

    /**
     * 参数过滤转义
     * @param $string
     * @param int $force
     * @return array|string
     */
    public function daddslashes($string, $force = 0)
    {
        !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
        if (!MAGIC_QUOTES_GPC || $force) {
            if (is_array($string)) {
                foreach ($string as $key => $val) {
                    $string[$key] = daddslashes($val, $force);
                }
            } else {
                $string = addslashes($string);
            }
        }
        return $string;
    }

    private function readover($filename, $method = "rb")
    {
        if ($handle = @fopen($filename, $method)) {
            flock($handle, LOCK_SH);
            $filedata = @fread($handle, filesize($filename));
            fclose($handle);
        }
        return $filedata;
    }

    /**
     * @param $length
     * @return string
     */
    private function met_rand_i($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    /**
     * @param $i
     * @return string
     */
    private function randStr($i)
    {
        $str = "abcdefghijklmnopqrstuvwxyz";
        $finalStr = "";
        for ($j = 0; $j < $i; $j++) {
            $finalStr .= substr($str, mt_rand(0, 25), 1);
        }
        return $finalStr;
    }

    private function deldir_in($fileDir, $type = 0)
    {
        @clearstatcache();
        $fileDir = substr($fileDir, -1) == '/' ? $fileDir : $fileDir . '/';
        if (!is_dir($fileDir)) {
            return false;
        }
        $resource = opendir($fileDir);
        @clearstatcache();
        while (($file = readdir($resource)) !== false) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            if (!is_dir($fileDir . $file)) {
                self::delfile_in($fileDir . $file);
            } else {
                self::deldir_in($fileDir . $file);
            }
        }
        closedir($resource);
        @clearstatcache();
        if ($type == 0) {
            rmdir($fileDir);
        }

        return true;
    }

    private function delfile_in($fileUrl)
    {
        @clearstatcache();
        if (file_exists($fileUrl)) {
            unlink($fileUrl);
            return true;
        } else {
            return false;
        }
        @clearstatcache();
    }

   public function get_sql($data)
    {
        $sql = "";
        foreach ($data as $key => $value) {
            if (strstr($value, "'")) {
                $value = str_replace("'", "\'", $value);
            }
            $sql .= " {$key} = '{$value}',";
        }
        return trim($sql, ',');
    }

}

date_default_timezone_set('UTC');
$m_now_time = time();
$m_now_date = date('Y-m-d H:i:s', $m_now_time);
$nowyear = date('Y', $m_now_time);
$localurl = "http://";
$localurl .= $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"];
$install_url = $localurl;

$install = new install();
$install->doInstall();

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
