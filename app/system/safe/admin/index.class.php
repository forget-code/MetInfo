<?php
defined('IN_MET') or exit('No permission');
load::sys_class('admin');
load::sys_func('file');
/** 安全与效率 */
class index extends admin
{
    public function __construct()
    {
        global $_M;
        parent::__construct();
    }

    //获取设置
    public function doGetSetup()
    {
        global $_M;
        $admin = admin_information();
        $query = "DELETE FROM {$_M['table']['config']} name='met_fd_word' and columnid != 0";
        DB::query($query);

        $feedcfg = DB::get_one("SELECT value FROM {$_M['table']['config']} WHERE lang ='{$_M['lang']}' AND name='met_fd_word' AND columnid = 0");
        $met_fd_word = $feedcfg['value'];

        $list = array();
        $list['met_login_code'] = isset($_M['config']['met_login_code']) ? $_M['config']['met_login_code'] : '';
        $list['met_memberlogin_code'] = isset($_M['config']['met_memberlogin_code']) ? $_M['config']['met_memberlogin_code'] : '';
        $list['met_img_rename'] = isset($_M['config']['met_img_rename']) ? $_M['config']['met_img_rename'] : '';
        $list['met_file_maxsize'] = isset($_M['config']['met_file_maxsize']) ? $_M['config']['met_file_maxsize'] : '';
        $list['met_file_format'] = isset($_M['config']['met_file_format']) ? $_M['config']['met_file_format'] : '';
        $list['met_logs'] = isset($_M['config']['met_logs']) ? $_M['config']['met_logs'] : 0;
        $list['met_fd_word'] = $met_fd_word;
        $list['disable_cssjs'] = isset($_M['config']['disable_cssjs'])?$_M['config']['disable_cssjs']:'';
        if ($admin['admin_group'] == 10000) {
            //管理与为创始人才显示后台地址设置
            $list['met_adminfile'] = $_M['config']['met_adminfile'];
        }
        $list['install'] = 0;

        if(is_dir(PATH_WEB.'install')) {
            $list['install'] = 1;
        }

        $this->success($list);
    }

    //删除安装文件
    public function doDelInstallFile()
    {
        global $_M;
        $dir = PATH_WEB . 'install';
        if (is_dir($dir)) {
            deldir($dir);
            //写日志
            logs::addAdminLog('safety_efficiency','setsafeupdate','jsok','doDelAdmin');
            $this->success($dir, $_M['word']['jsok']);
        };
        //写日志
        logs::addAdminLog('safety_efficiency','setsafeupdate','opfailed','doDelAdmin');
        $this->error();

    }

    //请除模板缓存
    function clear_cache()
    {
        global $_M;
        if (file_exists(PATH_WEB . 'cache')) {
            deldir(PATH_WEB . 'cache', 1);
        }
        $no = $_M['config']['met_skin_user'];
        $inc_file = PATH_WEB . "templates/{$no}/metinfo.inc.php";
        if (file_exists($inc_file)) {
            require $inc_file;
            if (isset($template_type) && $template_type) {
                deldir(PATH_WEB . 'templates/' . $no . '/cache', 1);
            }
        }
    }


    //保存设置
    public function doSaveSetup()
    {
        global $_M;
        $config_list = array();
        $config_list[] = 'met_img_rename';
        $config_list[] = 'met_login_code';
        $config_list[] = 'met_memberlogin_code';
        $config_list[] = 'met_file_maxsize';
        $config_list[] = 'met_file_format';
        $config_list[] = 'met_fd_word';
        $config_list[] = 'met_logs';
        $config_list[] = 'disable_cssjs';

        configsave($config_list);

        $current_admin = str_replace($_M['url']['site'], '', trim($_M['url']['site_admin'], '/'));
        $old_admin = $_M['config']['met_adminfile'];
        $new_admin = isset($_M['form']['met_adminfile']) ? $_M['form']['met_adminfile'] : '';
        //目录名解密
        $new_admin_url = '';
        if (is_string($new_admin) && $new_admin != $old_admin && $current_admin == $old_admin) {
            $new_admin_url = $_M['url']['site'].$_M['form']['met_adminfile'];
            //中文和特殊字符判断
            if (preg_match("/[\x{4e00}-\x{9fa5}]+/u", $new_admin)) {
                //写日志
                logs::addAdminLog('safety_efficiency','save','js77','doSaveSetup');
                $this->error($_M['word']['js77']);
            } elseif (!preg_match("/^\w+$/u", $new_admin)) {
                //写日志
                logs::addAdminLog('safety_efficiency','save','js77','doSaveSetup');
                $this->error($_M['word']['js77']);
            }

            if (!is_dir(PATH_WEB . $old_admin)) {
                //写日志
                logs::addAdminLog('safety_efficiency','save','setdbNotExist','doSaveSetup');
                $this->error($old_admin . $_M['word']['setdbNotExist']);
            }
            if (is_dir(PATH_WEB . $new_admin)) {
                //写日志
                logs::addAdminLog('safety_efficiency','save','columnerr4','doSaveSetup');
                $this->error($new_admin . $_M['word']['columnerr4']);
            }
            $res = rename(PATH_WEB . $old_admin, PATH_WEB . $new_admin);
            if (!$res) {
                //写日志
                movedir(PATH_WEB . $old_admin, PATH_WEB . $new_admin);
                if (!is_dir(PATH_WEB . $new_admin)){
                    logs::addAdminLog('safety_efficiency','save','authTip12','doSaveSetup');
                    $this->error($_M['word']['rename_admin_dir']);
                }
            }else{
                //后台地址加密字段
                $met_adminfile_code = authcode($new_admin, 'ENCODE', $_M['config']['met_webkeys']);
                $_M['form']['met_adminfile'] = $met_adminfile_code;
                configsave(array('met_adminfile'));
            }
        }


        //写日志
        logs::addAdminLog('safety_efficiency','save','jsok','doSaveSetup');
        $return_data = array();
        if ($new_admin_url) {
            $return_data['url'] = str_replace($old_admin,$new_admin,$_SERVER['HTTP_REFERER']);
        }

        deldir(PATH_WEB . 'cache/templates/',1);

        $this->success($return_data,$_M['word']['jsok']);
    }
}