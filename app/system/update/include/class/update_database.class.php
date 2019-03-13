<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
load::sys_class('database');
/**
 * 更新迁移数据
 */
class  update_database extends database{

    public function __construct() {
        global $_M;
    }

    public function update_system($version)
    {
        global $_M;
        $this->diff_fields($version);
        $this->temp_data();
        $this->recovery_data();
        $this->recovery_web_lang();
        $this->update_language();
        $this->insert_para();
        $this->update_plist();
    }
    //后改plist
    public function update_plist(){
        $this->many_select();//多选
        $this->single_select();//单选
    }

    //多选
    public function many_select(){
        global $_M;
        $query = "SELECT id FROM {$_M['table']['parameter']} WHERE type=4 AND (module=3 OR module=4 OR module=5)";
        $many_select = DB::get_all($query);
        if($many_select){//有
            foreach ($many_select as $many_select_id){
                $query = "SELECT * FROM {$_M['table']['plist']} WHERE paraid = '{$many_select_id['id']}'";
                $many_rs = DB::get_all($query);
                foreach ($many_rs as $many_val){
                    if(strpos($many_val['info'],'|')){
                        $many_val['info'] =  explode('|',$many_val['info']);
                    }
                    if(is_array($many_val['info'])){//多选添加多个
                        foreach ($many_val['info'] as $info_val){
                            $query = "SELECT id FROM {$_M['table']['para']} WHERE pid = {$many_val['paraid']} AND value ='$info_val' ";
                            $info_rs_one = DB::get_one($query);
                            if($info_rs_one){
                                $query = "INSERT INTO {$_M['table']['plist']} SET listid = {$many_val['listid']},paraid = '{$many_val['paraid']}',info='{$info_rs_one['id']}',lang='{$many_val['lang']}',module={$many_val['module']}";
                                DB::query($query);
                            }
                        }
                        $del_info = implode('|',$many_val['info']);
                        //删除
                        $query = "DELETE FROM {$_M['table']['plist']} WHERE paraid = {$many_val['paraid']} AND info ='$del_info' ";
                        DB::get_one($query);
                    }else{//多选只添加一个
                        $many_val_info = $many_val['info'];
                        $query = "SELECT id FROM {$_M['table']['para']} WHERE pid = {$many_val['paraid']} AND value ='$many_val_info' ";
                        $rs_one = DB::get_one($query);
                        if($rs_one){
                            $query = "UPDATE {$_M['table']['plist']} SET info = {$rs_one['id']} WHERE paraid = {$many_val['paraid']} AND info ='$many_val_info' ";
                            DB::get_one($query);
                        }
                    }
                }
            }
        }
    }

    //单选
    public function single_select(){
        global $_M;
        $query = "SELECT id FROM {$_M['table']['parameter']} WHERE (type=2 OR type=6) AND (module=3 OR module=4 OR module=5)";
        $single_select = DB::get_all($query);
        if($single_select){
            foreach ($single_select as $single_select_id){
                $query = "SELECT * FROM {$_M['table']['plist']} WHERE paraid = '{$single_select_id['id']}'";
                $single_rs = DB::get_all($query);
                foreach ($single_rs as $single_val){
                    $info = $single_val['info'];
                    $query = "SELECT id FROM {$_M['table']['para']} WHERE pid = {$single_val['paraid']} AND value ='$info' ";
                    $rs_one = DB::get_one($query);
                    if($rs_one){
                        $query = "UPDATE {$_M['table']['plist']} SET info = {$rs_one['id']} WHERE paraid = {$single_val['paraid']} AND info ='$info' ";
                        DB::get_one($query);
                    }
                }
            }
        }
    }

    //先处理
    public function insert_para(){
        global $_M;
        $query = "SELECT id,module,type,options,lang FROM {$_M['table']['parameter']} WHERE type=2 OR type=4 OR type=6";
        $rs = DB::get_all($query);
        foreach ($rs as $val){
                if($val['options']){
                    $val['options'] = array_filter(explode('$|$',$val['options']));//变成数组
                    //写para
                    foreach ($val['options'] as $option_val){
                        $query = "SELECT * FROM {$_M['table']['para']} WHERE pid = {$val['id']}  AND module = '{$val['module']}' AND value='{$option_val}' AND  lang='{$val['lang']}'";
                        $rs_one = DB::get_one($query);
                        if(!$rs_one){//没有的数据就写入
                            $query = "INSERT INTO {$_M['table']['para']} SET pid = {$val['id']},module = '{$val['module']}',value='{$option_val}',lang='{$val['lang']}'";
                            DB::query($query);
                        }
                    }
                }
        }
    }

    public function update_language()
    {
        global $_M;

        foreach (array_keys($_M['langlist']['admin']) as $lang) {
            self::recovery_admin_lang($lang);
        }

        $query = "update {$_M['table']['language']} set array=1 where name='unitytxt_39' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='jsx15' and site=1;";
                DB::query($query);
        $query = " update {$_M['table']['language']} set array=1 where name='js55' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='jsok' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='indexbasicinfo' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='physicalfunction4' and site=1;";
        DB::query($query);
        $query = " update {$_M['table']['language']} set array=1 where name='opfailed' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='putIntoRecycle' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='thoroughlyDeleting' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='unselected' and site=1;";
                DB::query($query);
        $query = " update {$_M['table']['language']} set array=1 where name='jslang0' and site=1;";
                DB::query($query);
        $query = "update {$_M['table']['language']} set array=1 where name='jslang1' and site=1;";
                DB::query($query);
        $query = " update {$_M['table']['language']} set array=1 where name='jslang2' and site=1;";
                DB::query($query);
        $query = " update {$_M['table']['language']} set array=1 where name='clearCache' and site=1;";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='jslang3' and site=1;";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='jslang4' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='jslang5' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='jslang6' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='jslang7' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='waptips1' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='unitytxt_1' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='waptype' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='wapfang' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='wapgeturl' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='waplang' and site=1;
                ";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='waptips5' and site=1;";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='waptips6' and site=1;";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='wapsetlang' and site=1;";
                DB::query($query);
        $query = "
                update {$_M['table']['language']} set array=1 where name='wapindextitle' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='waptips9' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='wapfoottext' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='wapdimensionaltitle' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='wapdimensionaltips' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='wapdimensionaldo' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='appinstall' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='indexonlieno' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='indexonlieok' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='be_updated' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='langexplain5' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='opfailed' and site=0;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='latest_version' and site=1;";
                DB::query($query);
    $query = "
                update {$_M['table']['language']} set array=1 where name='content' and site=1;
                ";
                DB::query($query);
    }


    public function add_language($name,$value,$js,$lang)
    {
        global $_M;
        $query = "SELECT id FROM {$_M['table']['language']} WHERE name = '{$name}' AND site = 0  AND lang = '{$lang}'";
        $has = DB::get_one($query);
        if(!$has){
            $query = "INSERT INTO {$_M['table']['language']} SET name = '{$name}',value='{$value}',site = 0,no_order=0,array={$js},app=0,lang='{$lang}'";
            DB::query($query);
        }
    }

    public function update_config($name,$value,$cid,$lang)
    {
        global $_M;
        $query = "SELECT id FROM {$_M['table']['config']} WHERE  name='{$name}'";
        if(!DB::get_one($query)){
            $query = "INSERT INTO {$_M['table']['config']} (name,value,mobile_value,columnid,flashid,lang)VALUES ('{$name}', '{$value}', '', '{$cid}', '0', '{$lang}')";
            DB::query($query);
        }
    }


    public function diff_fields($version)
    {
        global $_M;
        $app = load::sys_class('app','new');
        $app->version = $version;
        $diffs = $app->get_diff_tables(PATH_WEB.'config/v'.$version.'mysql.json');
        if(isset($diffs['table'])){
            foreach ($diffs['table'] as $table => $detail) {
                $sql = "CREATE TABLE IF NOT EXISTS `{$table}` (";
                foreach ($detail as $k => $v) {
                    if(!$v['Default'] && !is_numeric($v['Default'])){
                        $v['Default']= 'NULL';
                    }
                    if($k == 'id'){
                        $sql.= "`{$k}` {$v['Type']} {$v['Extra']} ,";
                    }else{
                        $sql.= "`{$k}` {$v['Type']} DEFAULT {$v['Default']} {$v['Extra']} ,";
                    }
                }
                $sql.="PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
                DB::query($sql);
                add_table(str_replace($_M['config']['tablepre'], '', $table));
            }
        }

        if(isset($diffs['field']))
        {
            foreach ($diffs['field'] as $table => $v) {
                foreach ($v as $field => $f) {
                    $sql = "ALTER TABLE `{$table}` ADD COLUMN `{$field}`  {$f['Type']}";
                    DB::query($sql);
                }
            }
        }

    }

    public function temp_data()
    {
        global $_M;

        $data = array();
        $data['met_secret_key'] = $_M['config']['met_secret_key'];
        $data['last_version'] = $_M['config']['metcms_v'];
        $data['tablename'] = $_M['config']['met_tablename'];
        $query = "SELECT * FROM {$_M['table']['language']} WHERE site = 1";
        $data['admin_lang'] = DB::get_all($query);

        $query = "SELECT * FROM {$_M['table']['applist']}";
        $data['applist'] = DB::get_all($query);
        file_put_contents(PATH_WEB.'cache/temp_data.txt', jsonencode($data));
        return $data;
    }

     public function recovery_data()
    {
        global $_M;
        if(file_exists(PATH_WEB.'cache/temp_data.txt')){
            $data = json_decode(file_get_contents(PATH_WEB.'cache/temp_data.txt'),true);
            add_table($data['tablename']);

            $query = "SELECT value FROM {$_M['table']['config']} WHERE name = 'met_tablename'";
            $config = DB::get_one($query);
            $_Mettables = explode('|', $config['value']);
            foreach ($_Mettables as $key => $val) {
                $_M['table'][$val] = $_M['config']['tablepre'].$val;
            }

            $query = "UPDATE {$_M['table']['config']} SET value = '{$data['met_secret_key']}' WHERE name = 'met_secret_key'";
            DB::query($query);

            $query = "UPDATE {$_M['table']['config']} SET value = '{$data['last_version']}' WHERE name = 'metcms_v'";
            DB::query($query);

            $query = "DELETE FROM {$_M['table']['language']} WHERE site = 1";
            DB::query($query);
            foreach ($data['admin_lang'] as $l) {
                unset($l['id']);
                $sql = self::get_sql($l);
                $query = "INSERT INTO {$_M['table']['language']} SET {$sql}";
                DB::query($query);
            }

            foreach ($data['applist'] as $app) {
                $query = "SELECT id FROM {$_M['table']['applist']} WHERE m_name='{$app['m_name']}'";
                if(!DB::get_one($query) && file_exists(PATH_WEB.'app/app/'.$app['m_name'])){
                    unset($app['id']);
                    $sql = self::get_sql($app);
                    $query = "INSERT INTO {$_M['table']['applist']} SET {$sql}";
                    DB::query($query);
                }
            }
        }
        @unlink(PATH_WEB.'cache/temp_data.txt');
        foreach (array_keys($_M['langlist']['web']) as $lang) {
            $this->update_config('debug',0,0,$lang);
            $this->update_config('met_mobile_logo','',0,$lang);
            $this->update_config('met_member_idvalidate',0,0,$lang);
            $this->update_config('met_idvalid_key','',0,$lang);
            $this->update_config('met_online_x','10',0,$lang);
            $this->update_config('met_online_y','100',0,$lang);

            $query = "SELECT id FROM {$_M['table']['column']} WHERE lang = '{$lang}' AND module = 6";
            $job = DB::get_one($query);

            if($job){

                $this->update_config('met_cv_showcol','',$job['id'],$lang);
                $query = "SELECT value FROM {$_M['table']['config']} WHERE columnid = {$job['id']} AND name='met_cv_email' AND lang = '{$lang}'";
                $job_config = DB::get_one($query);
                $query = "UPDATE {$_M['table']['parameter']} SET wr_ok = 1 WHERE id = {$job_config['value']}";
                DB::query($query);
            }

            $query = "SELECT id FROM {$_M['table']['column']} WHERE lang = '{$lang}' AND module = 7";
            $message = DB::get_one($query);
            if($message){
                $this->update_config('met_fd_showcol','0',$message['id'],$lang);
                $query = "SELECT value FROM {$_M['table']['config']} WHERE columnid = {$message['id']} AND (name='met_message_fd_class' or name='met_message_fd_content' or name='met_message_fd_email' or name='met_fd_sms_back') AND lang = '{$lang}'";
                $message_config = DB::get_one($query);
                $query = "UPDATE {$_M['table']['parameter']} SET wr_ok = 1 WHERE id = {$message_config['value']}";
                DB::query($query);
            }

            $query = "SELECT id FROM {$_M['table']['column']} WHERE lang = '{$lang}' AND module = 8";
            $feedback = DB::get_all($query);
            if($feedback){
                foreach ($feedback as $f) {
                    $this->update_config('met_fd_showcol','',$f['id'],$lang);
                    $this->update_config('met_fd_inquiry','',$f['id'],$lang);
                    $this->update_config('met_fd_related','',$f['id'],$lang);
                    $query = "SELECT value FROM {$_M['table']['config']} WHERE columnid = {$f['id']} AND (name='met_fd_class' or name='met_fd_email' or name='met_fd_sms_dell') AND lang = '{$lang}'";
                    $feedback_config = DB::get_one($query);
                    $query = "UPDATE {$_M['table']['parameter']} SET wr_ok = 1 WHERE id = {$feedback_config['value']}";
                    DB::query($query);

                }
            }
            $this->recovery_web_lang($lang);
        }


        $columnclass = load::mod_class('column/column_op', 'new');
        $columnclass->do_recover_column_files();
    }


    public function recovery_web_lang($lang)
    {
        global $_M;
        if($lang){
        if($lang != 'en'){
            self::add_language('membererror6', '账号未激活，请联系管理员', 0, $lang);
            self::add_language('opsuccess', '操作成功', 0,$lang);
            self::add_language('accsaftips4', '绑定用户证实身份信息', 0,$lang);
            self::add_language('rnvalidate', '实名认证', 0,$lang);
            self::add_language('notauthen', '未认证', 0,$lang);
            self::add_language('authen', '已认证', 0,$lang);
            self::add_language('realname', '真实姓名', 0,$lang);
            self::add_language('idcode', '身份证号码', 0,$lang);
            self::add_language('idvalidok', '实名认证成功', 0,$lang);
            self::add_language('idvalidfailed', '实名认证失败', 0,$lang);
            self::add_language('systips1', '您没有权限访问这个内容！请登录后访问！', 0,$lang);
            self::add_language('systips2', '您所在用户组没有权限访问这个内容！', 0,$lang);
            self::add_language('usercheckok', '验证成功！', 0,$lang);
            self::add_language('usereadinfo', '阅读权限值必需大于0', 0,$lang);
            self::add_language('usersetprice', '请设置金额', 0,$lang);
            self::add_language('userselectname', '选项卡', 0,$lang);
            self::add_language('userwenxinclose', '微信登录功能已关闭', 0,$lang);
            self::add_language('userwenboclose', '微博登录功能已关闭', 0,$lang);
            self::add_language('userqqclose', 'QQ登录功能已关闭', 0,$lang);
            self::add_language('userbuy', '购买', 0,$lang);
            self::add_language('userbuylist', '订单', 0,$lang);
            self::add_language('usesendcode', '验证码为', 0,$lang);
            self::add_language('usesendcodeinfo', '请及时输入验证', 0,$lang);
            self::add_language('feedbackinquiry', '在线询价', 0,$lang);
            self::add_language('templatesusererror', '当前语言模板未配置或模板文件不存在', 0,$lang);
            self::add_language('phonecode', '获取手机验证码', 0,$lang);
            self::add_language('phonecodeerror', '手机验证码错误', 0,$lang);
            self::add_language('memberbuytitle', '付费升级会员组', 0,$lang);
            self::add_language('idcode', '身份证号码', 1,$lang);
            self::add_language('recoveryisntallinfo', '导入的数据库版本和系统当前版本不一致，导入后可能会存在部分参数及配置数据丢失的情况，请谨慎导入！', 0,$lang);
        }else{
            self::add_language('membererror6', 'The account is not activated. Please contact the administrator', 0,  $lang);
            self::add_language('opsuccess', 'operation success', 0, $lang);
            self::add_language('accsaftips4', 'Binding user confirmation of identity information', 0, $lang);
            self::add_language('rnvalidate', 'Real name authentication', 0, $lang);
            self::add_language('notauthen', 'Uncertified', 0, $lang);
            self::add_language('authen', 'Certified', 0, $lang);
            self::add_language('realname', 'Real name', 0, $lang);
            self::add_language('idcode', 'ID card No.', 0, $lang);
            self::add_language('idvalidok', 'Success of real name authentication', 0, $lang);
            self::add_language('idvalidfailed', 'Real name authentication failure', 0, $lang);
            self::add_language('systips1', 'You do not have permission to access this content! Please login to visit!', 0, $lang);
            self::add_language('systips2', 'Your user group does not have permission to access this content!', 0, $lang);
            self::add_language('usercheckok', 'Verification success!', 0, $lang);
            self::add_language('usereadinfo', 'Reading permission value must be greater than 0', 0, $lang);
            self::add_language('usersetprice', 'Please set the amount', 0, $lang);
            self::add_language('userselectname', 'Tab', 0, $lang);
            self::add_language('userwenxinclose', 'Wechat login is off', 0, $lang);
            self::add_language('userwenboclose', 'Weibo login is turned off', 0, $lang);
            self::add_language('userqqclose', 'QQ login function is closed', 0, $lang);
            self::add_language('userbuy', 'buy', 0, $lang);
            self::add_language('userbuylist', 'Order', 0, $lang);
            self::add_language('usesendcode', 'The verification code is', 0, $lang);
            self::add_language('usesendcodeinfo', 'Please enter the verification in time', 0, $lang);
            self::add_language('feedbackinquiry', 'Online Inquiry', 0, $lang);
            self::add_language('templatesusererror', 'The current language template is not configured or the template file does not exist', 0, $lang);
            self::add_language('phonecode','Get phone verification code', 0, $lang);
            self::add_language('phonecodeerror', 'Mobile phone verification code error', 0, $lang);
            self::add_language('memberbuytitle', 'Paid upgrade member group', 0, $lang);
            self::add_language('idcode', 'ID code', 1, $lang);
            self::add_language('recoveryisntallinfo', 'The imported version of the database is inconsistent with the current version of the system. Some parameters and configuration data may be lost after import. Please import it carefully!', 0,$lang);
        }
        }

    }

    public function add_admin_language($name, $value, $site, $order, $array, $app, $lang)
    {
        global $_M;
        $query = "SELECT id FROM {$_M['table']['language']} WHERE name = '{$name}' AND site = 1  AND lang = '{$lang}'";
        $has = DB::get_one($query);
        if(!$has){
            $query = "INSERT INTO {$_M['table']['language']} SET name = '{$name}',value='{$value}',site = {$site},no_order={$order},array={$array},app={$app},lang='{$lang}'";
            DB::query($query);
        }
    }

    public function recovery_admin_lang($lang)
    {
        global $_M;
        if($lang){

        if($lang != 'en'){
        self::add_admin_language('cancel', '取消', 1, 0, 1, 0, $lang);
        self::add_admin_language('sys_group_bayable', '允许单独购买', 1, 0, 0, 50002, $lang);
        self::add_admin_language('sys_group_set_price', '请设置金额', 1, 0, 0, 50002, $lang);
        self::add_admin_language('savefail', '保存失败', 1, 238, 1, 0, $lang);
        self::add_admin_language('backlastpage_v6', '返回上一页', 1, 53, 1, 0, $lang);
        self::add_admin_language('uiset_descript_v6', '勾选的应用将出现在导航栏【常用功能】下拉列表中', 1, 0, 0, 0, $lang);
        self::add_admin_language('parameter8', '电话', 1, 9, 2, 0, $lang);
        self::add_admin_language('parameter9', '邮箱', 1, 9, 2, 0, $lang);
        self::add_admin_language('setskinOnline10', '前台定位', 1, 96, 23, 0, $lang);
        self::add_admin_language('anchor_textadd', '添加锚文本', 1, 0, 11, 0, $lang);
        self::add_admin_language('upload_local_v6', '本地上传', 1, 0, 1, 0, $lang);
        self::add_admin_language('upload_addoutimg_v6', '添加外部图片', 1, 0, 1, 0, $lang);
        self::add_admin_language('upload_progress_v6', '上传中', 1, 0, 1, 0, $lang);
        self::add_admin_language('upload_selectimg_v6', '选择图片', 1, 0, 1, 0, $lang);
        self::add_admin_language('upload_pselectimg_v6', '请选择图片', 1, 0, 1, 0, $lang);
        self::add_admin_language('upload_libraryimg_v6', '从图片库选择', 1, 0, 1, 0, $lang);
        self::add_admin_language('upload_extraimglink_v6', '外部图片链接', 1, 0, 1, 0, $lang);
        self::add_admin_language('banner_setmobileImgUrl_v6', '手机端图片地址', 1, 0, 4, 0, $lang);
        self::add_admin_language('opsuccess', '操作成功', 1, 0, 1, 0, $lang);
        self::add_admin_language('seotipssitemap1', '过滤不显示在导航的一级栏目', 1, 0, 32, 0, $lang);
        self::add_admin_language('user_tips5_v6', '可用参数，下列参数在邮件内容中会被转意为可变参数。', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Registeredmail_v6', '注册邮件', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips6_v6', '邮件下一操作的URL地址，必填项。比如找回密码邮件，这个地址就是找回密码的链接。', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips7_v6', '密码找回邮件', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips8_v6', '需要到', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_QQinterconnect_v6', 'QQ互联', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips9_v6', '申请 （管理中心-登录-创建引用-网站）', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_backurl_v6', '回调地址', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips10_v6', '微信开放平台', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Apply_v6', '申请', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips11_v6', '用于PC端会员登录', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Openplatform_v6', '开放平台', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_publicplatform_v6', '微信公众平台', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips12_v6', '用于微信端会员登录，移动端非微信的其他浏览器访问暂不支持微信登录', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips13_v6', '需要获取网页授权功能，并设置授权域名为您的网站域名。', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips14_v6', '并且将此微信公众号添加至开放平台账号下。', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips15_v6', '新浪微博', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips16_v6', '微博开放平台', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips17_v6', '（注意：请申请网站不要申请应用）', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_accsafe_v6', '账号安全', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_PasswordReset_v6', '密码重置', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips18_v6', '6 - 30 位字符 留空则不修改', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_emailuse_v6', '邮箱已被绑定', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_phoneuse_v6', '手机已被绑定', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Accountstatus_v6', '账号状态', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips19_v6', '不勾选则注册页面不显示，但是可以在用户个人资料中修改', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Regdisplay_v6', '注册时显示', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_must_v6', '必填', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips20_v6', '提示文字在注册页面不显示，仅修改个人资料处显示', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Hintext_v6', '提示文字', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips21_v6', '值越大阅读权限越高', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips22_v6', '下载CSV文件', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Exportmember_v6', '下载CSV文件', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Registratset_v6', '注册设置', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Regverificat_v6', '注册验证', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips23_v6', '邮箱为用户名', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Mailvalidat_v6', '邮件验证', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips24_v6', '（需设置系统发件箱（设置-基本信息-邮件发送设置）', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips25_v6', '后台审核', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips26_v6', '手机号码为用户名', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips27_v6', '手机短信验证', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips28_v6', '需开通短信服务（我的应用-短信功能）', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Notverifying_v6', '不验证', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips29_v6', '中间横屏背景颜色', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_Backgroundpicture_v6', '背景图片', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips30_v6', '登录界面中间横屏背景（建议尺寸 1920 * 800 宽 * 高 ）', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips31_v6', '会员分组设置', 1, 0, 38, 0, $lang);
        self::add_admin_language('user_tips32_v6', '会员邮件内容设置', 1, 0, 38, 0, $lang);
        self::add_admin_language('purchase_notice', '购买须知', 1, 0, 0, 0, $lang);
        self::add_admin_language('wap_descript1_v6', '名称最多支持4个汉字字符（英文字符算半个汉字字符）', 1, 439, 44, 0, $lang);
        self::add_admin_language('wap_descript2_v6', '最多只能添加4个菜单', 1, 440, 41, 0, $lang);
        self::add_admin_language('wap_Prohibit_deleting_v6', '禁止删除', 1, 441, 41, 0, $lang);
        self::add_admin_language('wap_meunSetting_v6', '菜单设置', 1, 442, 41, 0, $lang);
        self::add_admin_language('wap_descript3_v6', '请添加公司地址信息', 1, 443, 41, 0, $lang);
        self::add_admin_language('wap_nottel_v6', '电话号码不能为空', 1, 444, 41, 0, $lang);
        self::add_admin_language('wap_notqq_v6', 'QQ号不能为空', 1, 445, 41, 0, $lang);
        self::add_admin_language('wap_notmap_v6', '地图信息不能为空', 1, 446, 41, 0, $lang);
        self::add_admin_language('wap_notcolumn_v6', '栏目不能为空', 1, 447, 41, 0, $lang);
        self::add_admin_language('wap_descript4_v6', '名称的字符数不能超过8个！', 1, 448, 41, 0, $lang);
        self::add_admin_language('wap_descript8_v6', '名称的字符数不能超过6个！', 1, 449, 41, 0, $lang);
        self::add_admin_language('wap_descript5_v6', '名称不能为空！', 1, 450, 41, 0, $lang);
        self::add_admin_language('wap_descript6_v6', '点击该菜单跳转到网站首页', 1, 451, 41, 0, $lang);
        self::add_admin_language('wap_descript7_v6', '点击该菜单跳转到对应的栏目页面', 1, 452, 41, 0, $lang);
        self::add_admin_language('wap_meuntag_v6', '菜单图标', 1, 453, 41, 0, $lang);
        self::add_admin_language('wap_charover_v6', '字符数过多！', 1, 454, 41, 0, $lang);
        self::add_admin_language('AllBigclass_v6', '所有一级栏目', 1, 455, 0, 0, $lang);
        self::add_admin_language('AllSmallclass_v6', '所有二级栏目', 1, 456, 0, 0, $lang);
        self::add_admin_language('AllThirdclass_v6', '所有三级栏目', 1, 457, 0, 0, $lang);
        self::add_admin_language('wap_descript9_v6', '注意：您开启了静态页面功能！修改此页面设置后，需要到【优化推广—静态页面】重新生成所有静态页面后才能生效。', 1, 458, 44, 0, $lang);
        self::add_admin_language('wap_webhost_v6', ' 手机网站域名', 1, 459, 41, 0, $lang);
        self::add_admin_language('wap_descript10_v6', '设置一个域名（如 m.abcd.com ），访问该域名的时候将自动跳转到手机网站页面（先要做好解析绑定）', 1, 460, 41, 0, $lang);
        self::add_admin_language('wap_keepcomputer_v6', '与电脑版一致', 1, 461, 41, 0, $lang);
        self::add_admin_language('wap_descript11_v6', '以下为自定义需设置的选项', 1, 462, 41, 0, $lang);
        self::add_admin_language('wap_descript12_v6', '请设置允许显示在WAP中的栏目', 1, 463, 41, 0, $lang);
        self::add_admin_language('wap_descript13_v6', '请设置主导航栏目（先勾选左边栏目）', 1, 464, 41, 0, $lang);
        self::add_admin_language('wap_descript14_v6', '为空将显示网站首页标题，此标题一般显示在浏览器顶部', 1, 465, 41, 0, $lang);
        self::add_admin_language('wap_setbasicInfo_v6', '基本信息设置', 1, 466, 41, 0, $lang);
        self::add_admin_language('upload_descript2_v6', '含有危险函数，禁止上传！！', 1, 467, 0, 0, $lang);
        self::add_admin_language('upload_descript1_v6', '上传的压缩包含有非sql文件', 1, 468, 0, 0, $lang);
        self::add_admin_language('allapp_v6', '全部应用', 1, 469, 21, 0, $lang);
        self::add_admin_language('freeapp_v6', '免费应用', 1, 470, 21, 0, $lang);
        self::add_admin_language('Business_membersapp_v6', '商业会员应用', 1, 471, 21, 0, $lang);
        self::add_admin_language('payapp', '收费应用', 1, 472, 21, 0, $lang);
        self::add_admin_language('servicename_v6', '服务名称', 1, 473, 21, 0, $lang);
        self::add_admin_language('appstore_descript1_v6', '技术支持 服务开通/续费', 1, 474, 21, 0, $lang);
        self::add_admin_language('appstore_Servicescope_v6', '服务范围', 1, 475, 21, 0, $lang);
        self::add_admin_language('appstore_descript2_v6', 'MetInfo产品服务（安装、升级、搬家、故障排查与处理、服务器调试', 1, 476, 21, 0, $lang);
        self::add_admin_language('appstore_descript3_v6', '直接帮忙操作。', 1, 477, 21, 0, $lang);
        self::add_admin_language('appstore_descript4_v6', '服务器调试：首次搭建服务器环境以及与MetInfo故障有关的服务器环境问题处理。', 1, 478, 21, 0, $lang);
        self::add_admin_language('appstore_descript5_v6', '专业解答（产品使用/技巧、SEO优化、网络营销）', 1, 479, 21, 0, $lang);
        self::add_admin_language('appstore_descript6_v6', '帮助分析，提供解决方案和指导，不提供操作服务。', 1, 480, 21, 0, $lang);
        self::add_admin_language('appstore_descript7_v6', '服务范围谨遵上述内容，如未标明则说明不提供相应服务。', 1, 481, 21, 0, $lang);
        self::add_admin_language('appstore_descript8_v6', '以下情况无法提供服务', 1, 482, 21, 0, $lang);
        self::add_admin_language('appstore_descript9_v6', '自行修改或使用非原始 MetInfo 程序代码产生的问题', 1, 483, 21, 0, $lang);
        self::add_admin_language('appstore_descript10_v6', '非官方开发的应用插件、制作的模板造成的问题（应用商店上架的第三方应用/模板属于服务范围）', 1, 484, 21, 0, $lang);
        self::add_admin_language('appstore_descript11_v6', '服务器、虚拟主机原因造成的系统故障', 1, 485, 21, 0, $lang);
        self::add_admin_language('appstore_descript12_v6', '未购买商业授权非法去除版权信息', 1, 486, 21, 0, $lang);
        self::add_admin_language('appstore_descript13_v6', '不含网站内容维护、图片处理、源码修改。', 1, 487, 21, 0, $lang);
        self::add_admin_language('appstore_servicemode_v6', '服务方式', 1, 488, 21, 0, $lang);
        self::add_admin_language('appstore_descript14_v6', '提交工单：故障处理、问题咨询（每天）', 1, 489, 21, 0, $lang);
        self::add_admin_language('appstore_descript15_v6', '在线咨询：问题咨询（仅工作日在线，在线时间：08:30 - 17:30）', 1, 490, 21, 0, $lang);
        self::add_admin_language('appstore_descript16_v6', '应用商店账号登录MetInfo官网也可以获得工单、在线咨询服务（无法访问网站后台的情况下推荐使用）。', 1, 491, 21, 0, $lang);
        self::add_admin_language('appstore_descript17_v6', '选择服务时长', 1, 492, 21, 0, $lang);
        self::add_admin_language('appstore_descript18_v6', '一个月 (300元)', 1, 493, 21, 0, $lang);
        self::add_admin_language('appstore_descript19_v6', '三个月 (500元)', 1, 494, 21, 0, $lang);
        self::add_admin_language('appstore_descript20_v6', '一年 (1000元)', 1, 495, 21, 0, $lang);
        self::add_admin_language('appstore_QQsalesconsulting_v6', 'QQ销售咨询', 1, 496, 21, 0, $lang);
        self::add_admin_language('appstore_descript21_v6', '可咨询QQ了解服务详情', 1, 497, 21, 0, $lang);
        self::add_admin_language('appstore_descript22_v6', '单次服务价格：网站搬家200元/次，网站安装100元/次，网站升级100元起，故障处理100元起', 1, 498, 21, 0, $lang);
        self::add_admin_language('appstore_descript23_v6', '应用商店账号的登录密码', 1, 499, 21, 0, $lang);
        self::add_admin_language('appstore_descript24_v6', '清楚且遵守上述服务范围与服务方式', 1, 500, 21, 0, $lang);
        self::add_admin_language('appstore_descript25_v6', '立即开通/续费', 1, 501, 21, 0, $lang);
        self::add_admin_language('appstore_descript26_v6', '模板制作/修改服务商', 1, 502, 21, 0, $lang);
        self::add_admin_language('appstore_sign_v6', '标志', 1, 503, 21, 0, $lang);
        self::add_admin_language('appstore_name_v6', '名称', 1, 504, 21, 0, $lang);
        self::add_admin_language('appstore_type_v6', '类型', 1, 505, 21, 0, $lang);
        self::add_admin_language('appstore_place_v6', '地区', 1, 506, 21, 0, $lang);
        self::add_admin_language('appstore_Abilityvalue_v6', '能力值', 1, 507, 21, 0, $lang);
        self::add_admin_language('appstore_descript27_v6', '商家如何入驻？', 1, 508, 21, 0, $lang);
        self::add_admin_language('appstore_descript28_v6', '商家入驻说明', 1, 509, 21, 0, $lang);
        self::add_admin_language('appstore_Admissionrequirements_v6', '入驻要求', 1, 510, 21, 0, $lang);
        self::add_admin_language('appstore_descript29_v6', '商家入驻说明获得“官方认证模板设计师”称号。', 1, 511, 21, 0, $lang);
        self::add_admin_language('appstore_descript30_v6', '完成官方模板制作培训并顺利结业', 1, 512, 21, 0, $lang);
        self::add_admin_language('appstore_descript31_v6', '点此报名培训', 1, 513, 21, 0, $lang);
        self::add_admin_language('appstore_descript32_v6', '上线一套收费模板至应用商店。', 1, 514, 21, 0, $lang);
        self::add_admin_language('appstore_Admissionprocess_v6', '入驻流程', 1, 515, 21, 0, $lang);
        self::add_admin_language('appstore_descript33_v6', '1、联系官方商家合作专员：', 1, 516, 21, 0, $lang);
        self::add_admin_language('appstore_descript34_v6', 'QQ招商加盟', 1, 517, 21, 0, $lang);
        self::add_admin_language('appstore_descript35_v6', 'QQ招商加盟2、报名参加官方模板制作培训并获得“官方认证模板设计师”称号。', 1, 518, 21, 0, $lang);
        self::add_admin_language('appstore_descript36_v6', '3、通过官网审核并顺利上线一套收费模板至应用商店。', 1, 519, 21, 0, $lang);
        self::add_admin_language('appstore_descript37_v6', '4、提供商家入驻所需资料，官方进行核实。', 1, 520, 21, 0, $lang);
        self::add_admin_language('appstore_descript38_v6', '5、正式入驻。', 1, 521, 21, 0, $lang);
        self::add_admin_language('appstore_descript39_v6', '上线一套作品至应用商店其标准和审核将会非常严格，因为我们需要确保最终用户能够得到足够专业的技术服务。', 1, 522, 21, 0, $lang);
        self::add_admin_language('appstore_service_v6', '服务', 1, 523, 21, 0, $lang);
        self::add_admin_language('appstore_Spacedomain_name_v6', '空间域名', 1, 524, 21, 0, $lang);
        self::add_admin_language('appstore_Worryfree_service_v6', '无忧服务', 1, 525, 21, 0, $lang);
        self::add_admin_language('appstore_buildweb_v6', '建站套餐', 1, 526, 21, 0, $lang);
        self::add_admin_language('appstore_Thirdcooperation_v6', '第三方合作', 1, 527, 21, 0, $lang);
        self::add_admin_language('appstore_downshowdata_v6', '下载演示数据', 1, 528, 21, 0, $lang);
        self::add_admin_language('banner_Mobilegoods_v6', '移动商品', 1, 529, 4, 0, $lang);
        self::add_admin_language('banner_column1_v6', '栏目一', 1, 530, 4, 0, $lang);
        self::add_admin_language('banner_column2_v6', '栏目二', 1, 531, 4, 0, $lang);
        self::add_admin_language('banner_column3_v6', '栏目三', 1, 532, 4, 0, $lang);
        self::add_admin_language('banner_column_v6', '栏目', 1, 533, 4, 0, $lang);
        self::add_admin_language('copyproduct', '复制商品', 1, 534, 28, 0, $lang);
        self::add_admin_language('batch_descript1_v6', '生成水印，已更新', 1, 535, 5, 0, $lang);
        self::add_admin_language('batch_descript2_v6', '取消水印，已更新', 1, 536, 5, 0, $lang);
        self::add_admin_language('batch_descript3_v6', '缩略图生产，已更新', 1, 537, 5, 0, $lang);
        self::add_admin_language('batch_watermarking_v6', '批量水印操作', 1, 538, 5, 0, $lang);
        self::add_admin_language('records', '条记录', 1, 539, 5, 0, $lang);
        self::add_admin_language('close_allchildcolumn_v6', '关闭所有子栏目', 1, 540, 7, 0, $lang);
        self::add_admin_language('open_allchildcolumn_v6', '展开所有子栏目', 1, 541, 7, 0, $lang);
        self::add_admin_language('column_descript1_v6', '目录名称只能为小写字母或者数子，且不能和其他栏目重名！', 1, 542, 7, 0, $lang);
        self::add_admin_language('add_to_v6', '添加至', 1, 543, 7, 0, $lang);
        self::add_admin_language('seo_set_v6', 'SEO设置', 1, 544, 7, 0, $lang);
        self::add_admin_language('content_descript1_v6', '多个关键词请用 , 或 | 隔开', 1, 545, 7, 0, $lang);
        self::add_admin_language('content_descript2_v6', '为空则系统自动抓取详情', 1, 546, 7, 0, $lang);
        self::add_admin_language('content_descript3_v6', '请输入要链接到的网址，设置后访问该信息将直接跳转到设置的网址。', 1, 547, 7, 0, $lang);
        self::add_admin_language('content_descript4_v6', '当没有手动上传图片时候，会自动提取您内容第一张图片作为封面（此功能需要模板支持）', 1, 548, 7, 0, $lang);
        self::add_admin_language('content_descript5_v6', '为空则系统自动抓取商品详情', 1, 549, 7, 0, $lang);
        self::add_admin_language('content_descript6_v6', '访问权限、定时发布等', 1, 550, 7, 0, $lang);
        self::add_admin_language('content_descript7_v6', '请输入要链接到的网址，设置后访问该商品将直接跳转到设置的网址。', 1, 551, 7, 0, $lang);
        self::add_admin_language('content_name_v6 ', '名称', 1, 553, 7, 0, $lang);
        self::add_admin_language('content_Soldout_v6', '已售罄', 1, 554, 7, 0, $lang);
        self::add_admin_language('publish_articles_v6', '发布文章', 1, 555, 7, 0, $lang);
        self::add_admin_language('move_product_v6', '移动商品', 1, 556, 7, 0, $lang);
        self::add_admin_language('product_img_v6', '商品图', 1, 557, 7, 0, $lang);
        self::add_admin_language('feedback_formset_v6', '表单设置', 1, 558, 9, 0, $lang);
        self::add_admin_language('html_createend_v6', '生成完毕', 1, 559, 1, 0, $lang);
        self::add_admin_language('html_createfail_v6', '生成失败', 1, 560, 11, 0, $lang);
        self::add_admin_language('online_addkefu_v6', '添加客服', 1, 561, 23, 0, $lang);
        self::add_admin_language('pay_WeChat_v6 ', '微信', 1, 628, 26, 0, $lang);
        self::add_admin_language('notauthen', '未认证', 1, 9, 2, 0, $lang);
        self::add_admin_language('rnvalidate', '实名认证', 1, 9, 2, 0, $lang);
        self::add_admin_language('timesofuse', '可用查询次数', 1, 9, 2, 0, $lang);
        self::add_admin_language('price_yuan', '价格/元', 1, 9, 2, 0, $lang);
        self::add_admin_language('useables_times', '消费次数/次', 1, 9, 2, 0, $lang);
        self::add_admin_language('mobile_logo', '手机站LOGO', 1, 9, 2, 0, $lang);
        self::add_admin_language('mobile_banner_tips1', '(不上传手机图片时，手机访问的banner图和电脑端保持一致，手机图片不支持全站静态。)', 1, 9, 2, 0, $lang);
        self::add_admin_language('langexisted', '语言已存在', 1, 9, 2, 0, $lang);
        self::add_admin_language('fdincTip12', '后台显示列表项', 1, 49, 0, 0, $lang);
        self::add_admin_language('msgmanager', '信息管理', 1, 49, 0, 0, $lang);
        self::add_admin_language('fdincTip13', '仅在信息分类字段类型为下拉、单选、多选时生效', 1, 559, 1, 0, $lang);
        self::add_admin_language('show_contents', '展示内容', 1, 0, 1, 0, $lang);
        self::add_admin_language('enter_folder', '双击文件夹图标，进入文件夹选择图片', 1, 0, 1, 0, $lang);
        self::add_admin_language('price', '价格', 1, 0, 11, 0, $lang);
        self::add_admin_language('thumbs_tips1_v6', '修改保存后请到可视化界面导航点击【常用功能】-【清空缓存】，以使本次保存生效。', 1, 0, 0, 0, $lang);
        self::add_admin_language('recahrge_tips', '充值后如需退款须扣除 2% 的手续费，充值后 60 天内可以在“用户中心-财务中心-发票申请”提交发票申请。', 1, 0, 0, 0, $lang);
        self::add_admin_language('sys_lang_operate', '系统语言操作', 1, 0, 0, 0, $lang);
        self::add_admin_language('app_lang_operate', '应用语言操作', 1, 0, 0, 0, $lang);
        self::add_admin_language('appname_appno', '应用名称 / 编号', 1, 0, 0, 0, $lang);
        self::add_admin_language('edit_app_lang', '编辑应用语言', 1, 0, 0, 0, $lang);
        self::add_admin_language('product_para_tips', '链接字段类型需要前台模板支持，如模板不支持则可用附件类型进行功能替代', 1, 0, 0, 0, $lang);
        self::add_admin_language('feedbackrinfotime', '回复时间:', 1, 0, 0, 0, $lang);
        self::add_admin_language('feedbackrinfotitle', '回复标题:', 1, 0, 0, 0, $lang);
        self::add_admin_language('feedbackrinfocontent', '回复内容', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoapp3', '官方声明', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoapptext3', '第三方商家涵盖MetInfo应用及模板开发、中小企业信息化服务领域等，但MetInfo官方均未参与其相关产品和服务的营运及分成，请广大用户自行选择辨认并承担由此产生的一切后果，如发现商家存在违法或不诚信行为，欢迎向MetInfo官方举报，我们将对其进行下架处理。', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoapplogininfo', '可用 www.metinfo.cn 官网用户中心账号登录，无需重复注册', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoappinstallinfo', '应用首次安装将自动绑定域名', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoappinstallinfo1', '你可以在', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoappinstallinfo2', '测试安装应用，上线到正式网站后应用将自动绑定正式域名', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoappinstallinfo3', '且只能在此绑定域名的网站中使用，是否确认安装？', 1, 0, 0, 0, $lang);
        self::add_admin_language('metinfoappinstallinfo4', '安装提示', 1, 0, 1, 0, $lang);
        self::add_admin_language('metinfoappinstallinfojs1', '余额不足请先充值', 1, 0, 1, 0, $lang);
        self::add_admin_language('metinfoappinstallinfojs2', '请查看技术支持服务范围与服务方式，并勾选对应选项。', 1, 0, 1, 0, $lang);
        self::add_admin_language('metinfoappinstallinfojs3', '请输入登录密码！', 1, 0, 1, 0, $lang);
        self::add_admin_language('metinfoappinstallinfojs4', '请选择时长', 1, 0, 1, 0, $lang);
        self::add_admin_language('columnselect1', '选择栏目', 1, 0, 0, 0, $lang);
        self::add_admin_language('columnnofollow', 'nofollow属性', 1, 0, 0, 0, $lang);
        self::add_admin_language('columnnofollowinfo', '勾选后网站不向链接网址传递权重', 1, 0, 0, 0, $lang);
        self::add_admin_language('feedbackinquiry', '在线询价', 1, 0, 0, 0, $lang);
        self::add_admin_language('feedbackinquiryinfo', '当前网站语言下有多个反馈栏目时只能选定一个开启此功能', 1, 0, 0, 0, $lang);
        self::add_admin_language('columnupdatejs1', '升级失败', 1, 0, 1, 0, $lang);
        self::add_admin_language('columnupdatejs2', '重试', 1, 0, 1, 0, $lang);
        self::add_admin_language('columnupdatejs3', '退出', 1, 0, 1, 0, $lang);
        self::add_admin_language('webupate1', '网站备份', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate2', '恢复数据', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate3', '解压成功', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate4', '解压失败', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate5', '压缩包不存在', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate6', '文件类型', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate7', '解压', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate8', '提示', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate9', '使用备份管理员账号', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate10', '不覆盖管理员账号', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupate11', '取消本次导入', 1, 0, 0, 0, $lang);
        self::add_admin_language('webupatejs1', '确定要删除压缩包吗?', 1, 0, 1, 0, $lang);
        self::add_admin_language('webupatejs2', '点击取消', 1, 0, 1, 0, $lang);
        self::add_admin_language('webupatejs3', '导入中...', 1, 0, 1, 0, $lang);
        self::add_admin_language('feedbackselecttext', '按分类筛选', 1, 0, 1, 0, $lang);
        self::add_admin_language('seohtaccess1', '是否显示根目录下文件列表', 1, 0, 1, 0, $lang);
        self::add_admin_language('seohtaccess2', '系统规则请勿修改', 1, 0, 1, 0, $lang);
        self::add_admin_language('uisetappinfo', '当前应用', 1, 0, 1, 0, $lang);
        self::add_admin_language('updatenofile', '安装包不存在', 1, 0, 0, 0, $lang);
        self::add_admin_language('updateupzipfileno', '解压数据失败', 1, 0, 0, 0, $lang);
        self::add_admin_language('updatefileexist', '存在手动升级包', 1, 0, 1, 0, $lang);
        self::add_admin_language('updatephpver', '当前PHP版权不支持升级到', 1, 0, 1, 0, $lang);
        self::add_admin_language('updatedownloadnow', '下载中...', 1, 0, 1, 0, $lang);
        self::add_admin_language('updatedownloadover', '下载完成点击安装', 1, 0, 1, 0, $lang);
        self::add_admin_language('updateinstallnow', '安装中...', 1, 0, 1, 0, $lang);
        self::add_admin_language('useinfopay', '此功能需要先安装支付接口管理应用才能开启。', 1, 0, 0, 0, $lang);
        self::add_admin_language('usegroupauto1', '充值满金额自动升级', 1, 0, 0, 0, $lang);
        self::add_admin_language('usegroupbuy', '付费购买会员组', 1, 0, 0, 0, $lang);
        self::add_admin_language('usegroupprice', '价格', 1, 0, 0, 0, $lang);
        self::add_admin_language('usereadinfo', '阅读权限值必需大于0', 1, 0, 0, 0, $lang);
        self::add_admin_language('usersetprice', '请设置金额', 1, 0, 0, 0, $lang);
        self::add_admin_language('userselectname', '选项卡', 1, 0, 0, 0, $lang);
        self::add_admin_language('msmnoifno', '短信功能未开通', 1, 0, 0, 0, $lang);
        self::add_admin_language('templateseditfalse', '修改失败', 1, 0, 0, 0, $lang);
        self::add_admin_language('templatefilewritno', '目录不可写', 1, 0, 0, 0, $lang);
        self::add_admin_language('times1', '秒前', 1, 0, 0, 0, $lang);
        self::add_admin_language('times2', '分钟前', 1, 0, 0, 0, $lang);
        self::add_admin_language('times3', '小时前', 1, 0, 0, 0, $lang);
        self::add_admin_language('times4', '天前', 1, 0, 0, 0, $lang);
        self::add_admin_language('uploadfilenop', '无权限上传', 1, 0, 0, 0, $lang);
        self::add_admin_language('rurlerror', '请求地址出错', 1, 0, 0, 0, $lang);
        self::add_admin_language('paranouse', '参数不合法', 1, 0, 0, 0, $lang);
        self::add_admin_language('linkmetinfoerror', '您的服务器链接不上Met用户中心，请联系官网客服人员对服务器进行检测！！！', 1, 0, 0, 0, $lang);
        self::add_admin_language('appusererror', '后台登录账号密码错误，请在Met用户中心重新设置账号密码！！！', 1, 0, 0, 0, $lang);
        self::add_admin_language('parameter10', '链接', 1, 0, 0, 0, $lang);
        self::add_admin_language('parametervalueinfo', '值', 1, 0, 0, 0, $lang);
        self::add_admin_language('langappinfotext', '此处只显示支持多语言的应用', 1, 0, 0, 0, $lang);
        self::add_admin_language('indexmobilelogoinfo', '模板有手机LOGO设置时，此处设置失效，开启静态页面时设置无效，留空手机端使用默认LOGO', 1, 0, 0, 0, $lang);
        self::add_admin_language('columndeffflor', '你使用的栏目文件名称和系统默认模块文件夹名称冲突，请重新命名', 1, 0, 0, 0, $lang);
        self::add_admin_language('columndefallinfo', '删除语言系统会自动删除当前语言下的所有内容和图片，且不可恢复，你是否确定删除？', 1, 0, 1, 0, $lang);
        self::add_admin_language('met_template_nofile', '模板文件夹不存在', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_fileexist', '模板已经存在', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_noconfigfile', '模板配置文件不存在', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_falsedelui', '删除UI失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_falsedeluiconfig', '删除UI配置失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_falsedelconfig', '删除全局配置失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_downloadfalse', '下载失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_downloadok', '下载成功', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_temnoexist', '模板不存在', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_demonoexist', '演示数据不存在', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_upzipdemofalse', '解压演示数据失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_upzipok', '解压成功', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_installok', '安装成功', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_templates', 'UI商业模板', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_othertemplates', '其他模板', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_installdemo', '安装演示数据', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_deletteminfo', '您确定要删除该模板吗？删除之后无法再恢复。', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_nodelet', '系统应用不允许删除', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_filesavef', '文件保存失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_installuierr', '导入UI时出错', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_installuiparaerr', '导入UI参数时出错', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_updateok', '升级成功', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_updatefalse', '更新失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_updatedatafalse', '数据更新失败', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_donotinfo', '不需要操作或没有权限', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_langinfotext', '开启多语言时，必须先切换到对应语言的可视化管理或传统后台，然后在此启用一套模板；不同的语言可以启用不同的模板。', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_metinfouserinfo', '米拓官网用户中心账号可同步安装已购买且绑定域名为本站的商业模板，购买后60天内可以在米拓用户中心绑定域名', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_buytemplates', '购买新模板', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_delettemplatesinfo', '列表中删除模板并不会删除 网站根目录/templates/ 下的模板文件夹', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_demoinstalltitle', '演示数据安装提示！！！', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_demoinstallsel', '请选择合适你的安装方式：', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_demoinstallt1', '恢复出厂设置：系统将清空网站所有已有数据，将网站恢复至模板演示数据状态；', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_demoinstallt2', '备份已有数据并安装：系统将先自动备份网站现有数据库及图片，然后将网站恢复至模板演示数据状态，日后可以通过恢复备份数据将网站还原至演示数据安装前的状态；', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_demoinstallt3', '取消：如果你的网站已经添加了内容，我们建议你不要安装演示数据，安装模板后直接在可视化中设置相关区块内容即可。', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_saveinstall', '备份已有数据并安装', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_installnewmetinfo', '恢复出厂设置', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_downloadtemjs', '正在下载模板...', 1, 0, 1, 50002, $lang);
        self::add_admin_language('met_template_downloadtemokjs', '下载模板成功', 1, 0, 1, 50002, $lang);
        self::add_admin_language('met_template_downloaduijs', '正在下载UI', 1, 0, 1, 50002, $lang);
        self::add_admin_language('met_template_setmarktext', '点击展开高级设置', 1, 0, 0, 50002, $lang);
        self::add_admin_language('met_template_setmarktexth', '隐藏高级设置', 1, 0, 0, 50002, $lang);
    }else{
        self::add_admin_language('sys_group_bayable', 'Allow separate purchases', 1, 0, 0, 50002, $lang);
self::add_admin_language('sys_group_set_price', 'Please set the amount', 1, 0, 0, 50002, $lang);
self::add_admin_language('banner_setmobileImgUrl_v6', 'Mobile phone end picture address', 1, 0, 4, 0, $lang);
self::add_admin_language('savefail', 'Save failure', 1, 238, 1, 0, $lang);
self::add_admin_language('backlastpage_v6', 'Return to the last page', 1, 53, 1, 0, $lang);
self::add_admin_language('user_tips30_v6', 'Middle cross screen background of login interface (recommended size 1920 * 800 width * high)', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips31_v6', 'Member group setting', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips32_v6', 'Member mail content settings', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips29_v6', 'Background color of middle horizontal screen', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips5_v6', 'The parameters are available, and the following parameters are referred to as variable parameters in the content of the mail.', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips6_v6', 'Mail address URL the next operation, required. For example, retrieve the password mail, this address is the link to retrieve the password.', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Registeredmail_v6', 'Registered mail', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips7_v6', 'Password retrieving mail', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips8_v6', 'Need to be', 1, 0, 38, 0, $lang);
self::add_admin_language('user_QQinterconnect_v6', 'QQ interconnection', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips9_v6', 'Application (Management Center - login - create reference - Web site)', 1, 0, 38, 0, $lang);
self::add_admin_language('user_backurl_v6', 'token url', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips10_v6', 'WeChat open platform', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Apply_v6', 'Apply', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips11_v6', 'Member logon for PC side', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Openplatform_v6', 'Open platform', 1, 0, 38, 0, $lang);
self::add_admin_language('user_publicplatform_v6', 'WeChat public platform', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips12_v6', 'WeChat terminal members are used for login, and other browser access on the mobile end is not supported by WeChat, and the WeChat landings are not supported.', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips13_v6', 'You need to get the web authorization function and set up the authorized domain name for your website domain name.', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips14_v6', 'And add this WeChat public number to the open platform account.', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips15_v6', 'Sina micro-blog', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips16_v6', 'Micro-blog open platform', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips17_v6', '(Note: please apply for a web site not to apply for application)', 1, 0, 38, 0, $lang);
self::add_admin_language('user_accsafe_v6', 'Account security', 1, 0, 38, 0, $lang);
self::add_admin_language('user_PasswordReset_v6', 'Password Reset', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips18_v6', '6-30 character spacing is not modified', 1, 0, 38, 0, $lang);
self::add_admin_language('user_emailuse_v6', 'Mailbox has been bound', 1, 0, 38, 0, $lang);
self::add_admin_language('user_phoneuse_v6', 'The cell phone has been bound', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Accountstatus_v6', 'Account status', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips19_v6', 'Unchecked, the registration page does not display, but can be modified in the users personal data', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Regdisplay_v6', 'Registration display', 1, 0, 38, 0, $lang);
self::add_admin_language('user_must_v6', 'Required', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Hintext_v6', 'Hint text', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips21_v6', 'The higher the value, the higher the reading authority', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips22_v6', 'Download the CSV file', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Exportmember_v6', 'Export membership', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Registratset_v6', 'Registration settings', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Regverificat_v6', 'Registration verification', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips23_v6', 'Mailbox is a username', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Mailvalidat_v6', 'Mail validation', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips24_v6', '(set up the system server box (settings - basic information - mail sending settings)', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips25_v6', 'Backstage review', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips26_v6', 'Mobile phone number is username', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips27_v6', 'Mobile phone short message verification', 1, 0, 38, 0, $lang);
self::add_admin_language('user_tips28_v6', 'Short message service (my application - SMS)', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Notverifying_v6', 'Not verifying', 1, 0, 38, 0, $lang);
self::add_admin_language('user_Backgroundpicture_v6', 'Background picture', 1, 0, 38, 0, $lang);
self::add_admin_language('parameter8', 'tel', 1, 9, 2, 0, $lang);
self::add_admin_language('parameter9', 'email', 1, 9, 2, 0, $lang);
self::add_admin_language('setskinOnline10', 'Location', 1, 96, 23, 0, $lang);
self::add_admin_language('anchor_textadd', 'Add anchor text', 1, 0, 11, 0, $lang);
self::add_admin_language('opsuccess', 'operation success', 1, 0, 1, 0, $lang);
self::add_admin_language('seotipssitemap1', 'Filtering does not appear in the first level of navigation', 1, 0, 32, 0, $lang);
self::add_admin_language('upload_addoutimg_v6', 'Add an external picture', 1, 0, 1, 0, $lang);
self::add_admin_language('upload_progress_v6', 'Uploading', 1, 0, 1, 0, $lang);
self::add_admin_language('upload_local_v6', 'Local upload', 1, 0, 1, 0, $lang);
self::add_admin_language('upload_selectimg_v6', 'Select a picture', 1, 0, 1, 0, $lang);
self::add_admin_language('upload_pselectimg_v6', 'Please select the picture', 1, 0, 1, 0, $lang);
self::add_admin_language('upload_libraryimg_v6', 'Select from the picture library', 1, 0, 1, 0, $lang);
self::add_admin_language('upload_extraimglink_v6', 'External picture link', 1, 0, 1, 0, $lang);
self::add_admin_language('purchase_notice', 'Purchase Notice', 1, 0, 0, 0, $lang);
self::add_admin_language('uiset_descript_v6', 'The selected application will appear in the navigation bar [common function] drop-down list', 1, 0, 0, 0, $lang);
self::add_admin_language('wap_descript1_v6', 'The name supports up to 4 Chinese characters (English characters are half Chinese characters).', 1, 439, 44, 0, $lang);
self::add_admin_language('wap_descript2_v6', 'Only 4 menus can be added at most', 1, 440, 41, 0, $lang);
self::add_admin_language('wap_Prohibit_deleting_v6', 'Prohibit deleting', 1, 441, 41, 0, $lang);
self::add_admin_language('wap_meunSetting_v6', 'Menu settings', 1, 442, 41, 0, $lang);
self::add_admin_language('wap_descript3_v6', 'Please add the company address information', 1, 443, 41, 0, $lang);
self::add_admin_language('wap_nottel_v6', 'The phone number can not be empty', 1, 444, 41, 0, $lang);
self::add_admin_language('wap_notqq_v6', 'QQ can not be empty', 1, 445, 41, 0, $lang);
self::add_admin_language('wap_notmap_v6', 'Map information can not be empty', 1, 446, 41, 0, $lang);
self::add_admin_language('wap_notcolumn_v6', 'Column can not be empty', 1, 447, 41, 0, $lang);
self::add_admin_language('wap_descript4_v6', 'The number of characters of the name cannot exceed 8!', 1, 448, 41, 0, $lang);
self::add_admin_language('wap_descript8_v6', 'The number of characters of the name cannot exceed 6!', 1, 449, 41, 0, $lang);
self::add_admin_language('wap_descript5_v6', 'The name cannot be empty!', 1, 450, 41, 0, $lang);
self::add_admin_language('wap_descript6_v6', 'Click the menu to jump to the home page', 1, 451, 41, 0, $lang);
self::add_admin_language('wap_descript7_v6', 'Click the menu to jump to the corresponding column page', 1, 452, 41, 0, $lang);
self::add_admin_language('wap_meuntag_v6', 'Menu icon', 1, 453, 41, 0, $lang);
self::add_admin_language('wap_charover_v6', 'Too many characters!', 1, 454, 41, 0, $lang);
self::add_admin_language('AllBigclass_v6', 'All grade column', 1, 455, 0, 0, $lang);
self::add_admin_language('AllSmallclass_v6', 'All two level columns', 1, 456, 0, 0, $lang);
self::add_admin_language('AllThirdclass_v6', 'All three level columns', 1, 457, 0, 0, $lang);
self::add_admin_language('wap_descript9_v6', 'Note: you have opened the static page function! After modifying this page setting, it needs to be effective when all static pages are regenerated by the optimized - static page.', 1, 458, 44, 0, $lang);
self::add_admin_language('wap_webhost_v6', 'Domain name of mobile site', 1, 459, 41, 0, $lang);
self::add_admin_language('wap_descript10_v6', 'Set up a domain name (such as m.abcd.com); which will automatically jump to the mobile site page (first parse binding) when accessing the domain name.', 1, 460, 41, 0, $lang);
self::add_admin_language('wap_keepcomputer_v6', 'Consistent with the computer edition', 1, 461, 41, 0, $lang);
self::add_admin_language('wap_descript11_v6', 'The following are the options for custom settings', 1, 462, 41, 0, $lang);
self::add_admin_language('wap_descript12_v6', 'Please set up columns that are allowed to be displayed in WAP', 1, 463, 41, 0, $lang);
self::add_admin_language('wap_descript13_v6', 'Please set up the main navigation column (first check the left column)', 1, 464, 41, 0, $lang);
self::add_admin_language('wap_descript14_v6', 'The title of the home page is displayed on the top of the web site. This title is generally displayed at the top of the browser', 1, 465, 41, 0, $lang);
self::add_admin_language('wap_setbasicInfo_v6', 'Basic information setting', 1, 466, 41, 0, $lang);
self::add_admin_language('upload_descript2_v6', 'Contain dangerous function, no upload!', 1, 467, 0, 0, $lang);
self::add_admin_language('upload_descript1_v6', 'Uploaded compression contains non - SQL files', 1, 468, 0, 0, $lang);
self::add_admin_language('allapp_v6', 'All applications', 1, 469, 21, 0, $lang);
self::add_admin_language('freeapp_v6', 'Free application', 1, 470, 21, 0, $lang);
self::add_admin_language('Business_membersapp_v6', 'Commercial Membership Application', 1, 471, 21, 0, $lang);
self::add_admin_language('payapp', 'Charge application', 1, 472, 21, 0, $lang);
self::add_admin_language('servicename_v6', 'Service name', 1, 473, 21, 0, $lang);
self::add_admin_language('appstore_descript1_v6', 'Technical support service / Renewal', 1, 474, 21, 0, $lang);
self::add_admin_language('appstore_Servicescope_v6', 'Service scope', 1, 475, 21, 0, $lang);
self::add_admin_language('appstore_descript2_v6', 'MetInfo product service (installation, upgrading, moving, troubleshooting and processing, server debugging', 1, 476, 21, 0, $lang);
self::add_admin_language('appstore_descript3_v6', 'Direct help.', 1, 477, 21, 0, $lang);
self::add_admin_language('appstore_descript4_v6', 'Server debugging: setting up the server environment for the first time and handling the server environment problems related to the MetInfo failure.', 1, 478, 21, 0, $lang);
self::add_admin_language('appstore_descript5_v6', 'Professional solutions (product use / skill, SEO optimization, network marketing)', 1, 479, 21, 0, $lang);
self::add_admin_language('appstore_descript6_v6', 'Help analysis, provide solutions and guidance, and do not provide operational services.', 1, 480, 21, 0, $lang);
self::add_admin_language('appstore_descript7_v6', 'The scope of service is subject to the above content. If unmarked, the service is not provided.', 1, 481, 21, 0, $lang);
self::add_admin_language('appstore_descript8_v6', 'There is no service provided in the following case', 1, 482, 21, 0, $lang);
self::add_admin_language('appstore_descript9_v6', 'Problems generated by self modification or use of non original MetInfo code', 1, 483, 21, 0, $lang);
self::add_admin_language('appstore_descript10_v6', 'Problems caused by unofficially developed application plug-ins and made templates (the third party application / template on the application store is a service range)', 1, 484, 21, 0, $lang);
self::add_admin_language('appstore_descript11_v6', 'System failures caused by server and virtual host causes', 1, 485, 21, 0, $lang);
self::add_admin_language('appstore_descript12_v6', 'Unauthorized removal of copyright information without a commercial authorization', 1, 486, 21, 0, $lang);
self::add_admin_language('appstore_descript13_v6', 'Does not contain website content maintenance, picture processing, source code modification.', 1, 487, 21, 0, $lang);
self::add_admin_language('appstore_servicemode_v6', 'service mode', 1, 488, 21, 0, $lang);
self::add_admin_language('appstore_descript14_v6', 'Submission of work list: troubleshooting, problem consulting (daily)', 1, 489, 21, 0, $lang);
self::add_admin_language('appstore_descript15_v6', 'Online consulting: problem consulting (only working day online, online time: 08:30 - 17:30)', 1, 490, 21, 0, $lang);
self::add_admin_language('appstore_descript16_v6', 'Application store account login MetInfo official network can also obtain work list, online consulting services (not to access the background of the site of the recommended use).', 1, 491, 21, 0, $lang);
self::add_admin_language('appstore_descript17_v6', 'Select service length', 1, 492, 21, 0, $lang);
self::add_admin_language('appstore_descript18_v6', 'One month (300 yuan)', 1, 493, 21, 0, $lang);
self::add_admin_language('appstore_descript19_v6', 'Three months (500 yuan)', 1, 494, 21, 0, $lang);
self::add_admin_language('appstore_descript20_v6', 'One year (1000 yuan)', 1, 495, 21, 0, $lang);
self::add_admin_language('appstore_QQsalesconsulting_v6', 'QQ sales consulting', 1, 496, 21, 0, $lang);
self::add_admin_language('appstore_descript21_v6', 'Consult QQ for details of service', 1, 497, 21, 0, $lang);
self::add_admin_language('appstore_descript22_v6', 'Single service price: the website moves 200 yuan / times, the website installs 100 yuan / times, the website upgrade 100 yuan, the malfunction processing 100 yuan', 1, 498, 21, 0, $lang);
self::add_admin_language('appstore_descript23_v6', 'The login password of the application store account', 1, 499, 21, 0, $lang);
self::add_admin_language('appstore_descript24_v6', 'Clear and comply with the above service scope and service mode', 1, 500, 21, 0, $lang);
self::add_admin_language('appstore_descript25_v6', 'Immediately open / renew', 1, 501, 21, 0, $lang);
self::add_admin_language('appstore_descript26_v6', 'Template making / modifying service provider', 1, 502, 21, 0, $lang);
self::add_admin_language('appstore_sign_v6', 'sign', 1, 503, 21, 0, $lang);
self::add_admin_language('appstore_name_v6', 'Name', 1, 504, 21, 0, $lang);
self::add_admin_language('appstore_type_v6', 'type', 1, 505, 21, 0, $lang);
self::add_admin_language('appstore_place_v6', 'region', 1, 506, 21, 0, $lang);
self::add_admin_language('appstore_Abilityvalue_v6', 'Ability value', 1, 507, 21, 0, $lang);
self::add_admin_language('appstore_descript27_v6', 'How do businesses enter?', 1, 508, 21, 0, $lang);
self::add_admin_language('appstore_descript28_v6', 'Description of business entry', 1, 509, 21, 0, $lang);
self::add_admin_language('appstore_Admissionrequirements_v6', 'Admission requirements', 1, 510, 21, 0, $lang);
self::add_admin_language('appstore_descript29_v6', 'Business entry instructions have been awarded the title of "official certification template designer".', 1, 511, 21, 0, $lang);
self::add_admin_language('appstore_descript30_v6', 'Completion of official template training and successful completion', 1, 512, 21, 0, $lang);
self::add_admin_language('appstore_descript31_v6', 'Order this registration training', 1, 513, 21, 0, $lang);
self::add_admin_language('appstore_descript32_v6', 'Line a set of charge templates to the application store.', 1, 514, 21, 0, $lang);
self::add_admin_language('appstore_Admissionprocess_v6', 'Admission process', 1, 515, 21, 0, $lang);
self::add_admin_language('appstore_descript33_v6', '1. Contact the official business co - operation Commissioner:', 1, 516, 21, 0, $lang);
self::add_admin_language('appstore_descript34_v6', 'QQ inviting investment', 1, 517, 21, 0, $lang);
self::add_admin_language('appstore_descript35_v6', 'QQ joined 2, registered to participate in the official template production training and won the title of "official certification template designer".', 1, 518, 21, 0, $lang);
self::add_admin_language('appstore_descript36_v6', '3, through the official network audit and the smooth line of a set of charging templates to the application store.', 1, 519, 21, 0, $lang);
self::add_admin_language('appstore_descript37_v6', '4, provide the information required by the merchants to enter, and the official verification.', 1, 520, 21, 0, $lang);
self::add_admin_language('appstore_descript38_v6', '5, formally entered.', 1, 521, 21, 0, $lang);
self::add_admin_language('appstore_descript39_v6', 'The standard and audit of a set of works to the application store will be very strict, because we need to ensure that the end users can get enough professional technical services.', 1, 522, 21, 0, $lang);
self::add_admin_language('appstore_service_v6', 'service', 1, 523, 21, 0, $lang);
self::add_admin_language('appstore_Spacedomain_name_v6', 'Space domain name', 1, 524, 21, 0, $lang);
self::add_admin_language('appstore_Worryfree_service_v6', 'Worry free service', 1, 525, 21, 0, $lang);
self::add_admin_language('appstore_buildweb_v6', 'Set up dinner set', 1, 526, 21, 0, $lang);
self::add_admin_language('appstore_Thirdcooperation_v6', 'Third party cooperation', 1, 527, 21, 0, $lang);
self::add_admin_language('appstore_downshowdata_v6', 'Downloading demo data', 1, 528, 21, 0, $lang);
self::add_admin_language('banner_Mobilegoods_v6', 'Mobile goods', 1, 529, 4, 0, $lang);
self::add_admin_language('banner_column1_v6', 'Column 1', 1, 530, 4, 0, $lang);
self::add_admin_language('banner_column2_v6', 'Column two', 1, 531, 4, 0, $lang);
self::add_admin_language('banner_column3_v6', 'Column three', 1, 532, 4, 0, $lang);
self::add_admin_language('banner_column_v6', 'column', 1, 533, 4, 0, $lang);
self::add_admin_language('copyproduct', 'Replicating goods', 1, 534, 28, 0, $lang);
self::add_admin_language('batch_descript1_v6', 'Generated watermark, updated', 1, 535, 5, 0, $lang);
self::add_admin_language('batch_descript2_v6', 'Cancel the watermark and update it', 1, 536, 5, 0, $lang);
self::add_admin_language('batch_descript3_v6', 'Thumbnail production has been updated', 1, 537, 5, 0, $lang);
self::add_admin_language('batch_watermarking_v6', 'Batch watermarking operation', 1, 538, 5, 0, $lang);
self::add_admin_language('records', 'Bar record', 1, 539, 5, 0, $lang);
self::add_admin_language('close_allchildcolumn_v6', 'Close all subsections', 1, 540, 7, 0, $lang);
self::add_admin_language('open_allchildcolumn_v6', 'Unfold all the subsections', 1, 541, 7, 0, $lang);
self::add_admin_language('column_descript1_v6', 'The directory name only lowercase letters or numbers, and can not duplicate and other columns!', 1, 542, 7, 0, $lang);
self::add_admin_language('add_to_v6', 'Add to', 1, 543, 7, 0, $lang);
self::add_admin_language('seo_set_v6', 'SEO settings', 1, 544, 7, 0, $lang);
self::add_admin_language('content_descript1_v6', 'Please use multiple keywords, or | separated', 1, 545, 7, 0, $lang);
self::add_admin_language('content_descript2_v6', 'Automatic capture of details for the null system', 1, 546, 7, 0, $lang);
self::add_admin_language('content_descript3_v6', 'Please enter the URL that you want to link to, and the access to this information will jump directly to the set URL.', 1, 547, 7, 0, $lang);
self::add_admin_language('content_descript4_v6', 'When no pictures are uploaded manually, the first picture of your content is automatically extracted as a cover (this feature needs template support).', 1, 548, 7, 0, $lang);
self::add_admin_language('content_descript5_v6', 'Automatic capture of the details of the goods by the null system', 1, 549, 7, 0, $lang);
self::add_admin_language('content_descript6_v6', 'Access, timing, etc', 1, 550, 7, 0, $lang);
self::add_admin_language('content_descript7_v6', 'Please enter the URL that you want to link to. After setting, access the product will jump directly to the set URL.', 1, 551, 7, 0, $lang);
self::add_admin_language('content_name_v6 ', 'Name', 1, 553, 7, 0, $lang);
self::add_admin_language('content_Soldout_v6', 'Sold out', 1, 554, 7, 0, $lang);
self::add_admin_language('publish_articles_v6', 'Publish articles', 1, 555, 7, 0, $lang);
self::add_admin_language('move_product_v6', 'Mobile goods', 1, 556, 7, 0, $lang);
self::add_admin_language('product_img_v6', 'Commodity map', 1, 557, 7, 0, $lang);
self::add_admin_language('feedback_formset_v6', 'Form setting', 1, 558, 9, 0, $lang);
self::add_admin_language('html_createend_v6', 'Completion', 1, 559, 1, 0, $lang);
self::add_admin_language('html_createfail_v6', 'Generation failure', 1, 560, 11, 0, $lang);
self::add_admin_language('online_addkefu_v6 ', 'Add customer service', 1, 561, 23, 0, $lang);
self::add_admin_language('pay_WeChat_v6 ', 'WeChat', 1, 628, 26, 0, $lang);
self::add_admin_language('notauthen', 'Uncertified', 1, 9, 2, 0, $lang);
self::add_admin_language('rnvalidate', 'Real name authentication', 1, 9, 2, 0, $lang);
self::add_admin_language('timesofuse', 'Number of available queries', 1, 9, 2, 0, $lang);
self::add_admin_language('price_yuan', 'Price / yuan', 1, 9, 2, 0, $lang);
self::add_admin_language('useables_times', 'Consumption times / times', 1, 9, 2, 0, $lang);
self::add_admin_language('mobile_logo', 'Wapsite LOGO', 1, 9, 2, 0, $lang);
self::add_admin_language('mobile_banner_tips1', '(When you do not upload pictures of mobile phones, the banner diagrams of mobile hones are consistent with the computer terminals.)', 1, 9, 2, 0, $lang);
self::add_admin_language('langexisted', 'Lang Existed', 1, 9, 2, 0, $lang);
self::add_admin_language('fdincTip12', 'Backstage display list item', 1, 49, 0, 0, $lang);
self::add_admin_language('msgmanager', 'Message management', 1, 49, 0, 0, $lang);
self::add_admin_language('fdincTip13', 'Only valid when the information classification field type is drop-down, single-select, multi-select', 1, 559, 1, 0, $lang);
self::add_admin_language('show_contents', 'Show Contents', 1, 0, 1, 0, $lang);
self::add_admin_language('enter_folder', 'Double click the folder icon and enter the folder to select the picture.', 1, 0, 1, 0, $lang);
self::add_admin_language('price', 'Price', 1, 0, 11, 0, $lang);
self::add_admin_language('thumbs_tips1_v6', 'After saving and modifying, please navigate to the visual interface and click the common function - empty cache to make this save effective.', 1, 0, 0, 0, $lang);
self::add_admin_language('recahrge_tips', 'After recharging, a refund of 2% will be deducted, and within 60 days after the recharge, the invoice application can be submitted in the "user center financial center invoice application".', 1, 0, 0, 0, $lang);
self::add_admin_language('sys_lang_operate', 'system languag opreate', 1, 0, 0, 0, $lang);
self::add_admin_language('app_lang_operate', 'app languag opreate', 1, 0, 0, 0, $lang);
self::add_admin_language('appname_appno', 'appname / appcode', 1, 0, 0, 0, $lang);
self::add_admin_language('edit_app_lang', 'edit app language', 1, 0, 0, 0, $lang);
self::add_admin_language('product_para_tips', 'The link field type requires foreground template support. If the template is not supported, the attachment type can be used for function substitution.', 1, 0, 0, 0, $lang);
self::add_admin_language('feedbackrinfotime', 'Reply Time:', 1, 0, 0, 0, $lang);
self::add_admin_language('feedbackrinfotitle', 'Reply title:', 1, 0, 0, 0, $lang);
self::add_admin_language('feedbackrinfocontent', 'Reply content', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoapp3', 'Official statement', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoapptext3', 'Third-party merchants cover MetInfo application and template development, and SME information services. However, MetInfo officials are not involved in the operation and division of related products and services. Users are requested to identify and bear all the consequences. If you find that the business is illegal or dishonest, you are welcome to report it to MetInfo, and we will remove it.', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoapplogininfo', 'You can log in to the official website user center of www.metinfo.cn without repeating registration.', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoappinstallinfo', 'Application first install will automatically bind the domain name', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoappinstallinfo1', 'You can be at', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoappinstallinfo2', 'Test the installation application, the application will automatically bind the official domain name after going online to the official website.', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoappinstallinfo3', 'And can only be used in the website that binds the domain name. Do you confirm the installation?', 1, 0, 0, 0, $lang);
self::add_admin_language('metinfoappinstallinfo4', 'installation tips', 1, 0, 1, 0, $lang);
self::add_admin_language('metinfoappinstallinfojs1', 'If the balance is insufficient, please recharge first.', 1, 0, 1, 0, $lang);
self::add_admin_language('metinfoappinstallinfojs2', 'Please check the technical support service range and service method, and check the corresponding options.', 1, 0, 1, 0, $lang);
self::add_admin_language('metinfoappinstallinfojs3', 'Please enter your password!', 1, 0, 1, 0, $lang);
self::add_admin_language('metinfoappinstallinfojs4', 'Please select the length of time', 1, 0, 1, 0, $lang);
self::add_admin_language('columnselect1', 'Select Category', 1, 0, 0, 0, $lang);
self::add_admin_language('columnnofollow', 'Nofollow attribute', 1, 0, 0, 0, $lang);
self::add_admin_language('columnnofollowinfo', 'After checking, the website does not pass weights to the link URL.', 1, 0, 0, 0, $lang);
self::add_admin_language('feedbackinquiry', 'Online Inquiry', 1, 0, 0, 0, $lang);
self::add_admin_language('feedbackinquiryinfo', 'Only one of the feedback sections in the current website language can be selected to enable this feature.', 1, 0, 0, 0, $lang);
self::add_admin_language('columnupdatejs1', 'Upgrade failed', 1, 0, 1, 0, $lang);
self::add_admin_language('columnupdatejs2', 'Retry', 1, 0, 1, 0, $lang);
self::add_admin_language('columnupdatejs3', 'drop out', 1, 0, 1, 0, $lang);
self::add_admin_language('webupate1', 'Website backup', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate2', 'Data recovery', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate3', 'Decompression succeeded', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate4', 'Unpacking failed', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate5', 'Compressed package does not exist', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate6', 'file type', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate7', 'Decompression', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate8', 'prompt', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate9', 'Use backup administrator account', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate10', 'Do not override the administrator account', 1, 0, 0, 0, $lang);
self::add_admin_language('webupate11', 'Cancel this import', 1, 0, 0, 0, $lang);
self::add_admin_language('webupatejs1', 'Are you sure you want to delete the zip?', 1, 0, 1, 0, $lang);
self::add_admin_language('webupatejs2', 'Click cancel', 1, 0, 1, 0, $lang);
self::add_admin_language('webupatejs3', 'Importing...', 1, 0, 1, 0, $lang);
self::add_admin_language('feedbackselecttext', 'Filter by category', 1, 0, 1, 0, $lang);
self::add_admin_language('seohtaccess1', 'Whether to display the file list in the root directory', 1, 0, 1, 0, $lang);
self::add_admin_language('seohtaccess2', 'Do not modify system rules', 1, 0, 1, 0, $lang);
self::add_admin_language('uisetappinfo', 'Current application', 1, 0, 1, 0, $lang);
self::add_admin_language('updatenofile', 'The installation package does not exist', 1, 0, 0, 0, $lang);
self::add_admin_language('updateupzipfileno', 'Unpacking data failed', 1, 0, 0, 0, $lang);
self::add_admin_language('updatefileexist', 'Manual upgrade package exists', 1, 0, 1, 0, $lang);
self::add_admin_language('updatephpver', 'Current PHP copyright does not support upgrading to', 1, 0, 1, 0, $lang);
self::add_admin_language('updatedownloadnow', 'downloading...', 1, 0, 1, 0, $lang);
self::add_admin_language('updatedownloadover', 'Download completed click to install', 1, 0, 1, 0, $lang);
self::add_admin_language('updateinstallnow', 'installing...', 1, 0, 1, 0, $lang);
self::add_admin_language('useinfopay', 'This feature requires the payment interface management application to be enabled before it can be enabled.', 1, 0, 0, 0, $lang);
self::add_admin_language('usegroupauto1', 'Automatically upgrade the full amount of recharge', 1, 0, 0, 0, $lang);
self::add_admin_language('usegroupbuy', 'Paid purchase member group', 1, 0, 0, 0, $lang);
self::add_admin_language('usegroupprice', 'price', 1, 0, 0, 0, $lang);
self::add_admin_language('usereadinfo', 'Reading permission value must be greater than 0', 1, 0, 0, 0, $lang);
self::add_admin_language('usersetprice', 'Please set the amount', 1, 0, 0, 0, $lang);
self::add_admin_language('userselectname', 'Tab', 1, 0, 0, 0, $lang);
self::add_admin_language('msmnoifno', 'SMS function has not been activated', 1, 0, 0, 0, $lang);
self::add_admin_language('templateseditfalse', 'fail to edit', 1, 0, 0, 0, $lang);
self::add_admin_language('templatefilewritno', 'Directory is not writable', 1, 0, 0, 0, $lang);
self::add_admin_language('times1', 'Seconds ago', 1, 0, 0, 0, $lang);
self::add_admin_language('times2', 'minutes ago', 1, 0, 0, 0, $lang);
self::add_admin_language('times3', 'hour ago', 1, 0, 0, 0, $lang);
self::add_admin_language('times4', 'Days ago', 1, 0, 0, 0, $lang);
self::add_admin_language('uploadfilenop', 'No permission to upload', 1, 0, 0, 0, $lang);
self::add_admin_language('rurlerror', 'Request address error', 1, 0, 0, 0, $lang);
self::add_admin_language('paranouse', 'The parameter is invalid', 1, 0, 0, 0, $lang);
self::add_admin_language('linkmetinfoerror', 'Your server is not connected to the Net User Center, please contact the official website customer service staff to detect the server!!!', 1, 0, 0, 0, $lang);
self::add_admin_language('appusererror', 'The login password in the background is incorrect. Please reset the account password in the Met User Center! ! !', 1, 0, 0, 0, $lang);
self::add_admin_language('parameter10', 'link', 1, 0, 0, 0, $lang);
self::add_admin_language('parametervalueinfo', 'value', 1, 0, 0, 0, $lang);
self::add_admin_language('langappinfotext', 'Only apps that support multiple languages are shown here', 1, 0, 0, 0, $lang);
self::add_admin_language('indexmobilelogoinfo', 'When the template has the mobile phone LOGO setting, the setting here is invalid. When the static page is opened, the setting is invalid. Leave the mobile terminal to use the default LOGO.', 1, 0, 0, 0, $lang);
self::add_admin_language('columndeffflor', 'The name of the column file you are using conflicts with the system default module folder name. Please rename it.', 1, 0, 0, 0, $lang);
self::add_admin_language('user_tips20_v6', 'The prompt text is not displayed on the registration page, only the personal information is displayed.', 1, 0, 38, 0, $lang);
self::add_admin_language('met_template_nofile', 'Template folder does not exist', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_fileexist', 'Template already exists', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_noconfigfile', 'Template profile does not exist', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_falsedelui', 'Failed to delete UI', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_falsedeluiconfig', 'Deleting UI configuration failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_falsedelconfig', 'Delete global configuration failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_downloadfalse', 'download failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_downloadok', 'download successful', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_temnoexist', 'Template does not exist', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_demonoexist', 'Demo data does not exist', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_upzipdemofalse', 'Unpacking demo data failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_upzipok', 'Decompression succeeded', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_installok', 'Successful installation', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_templates', 'UI business template', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_othertemplates', 'Other templates', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_installdemo', 'Install demo data', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_deletteminfo', 'Are you sure you want to delete this template? Cannot be restored after deletion.', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_nodelet', 'System app does not allow deletion', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_filesavef', 'File save failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_installuierr', 'Error importing UI', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_installuiparaerr', 'Error importing UI parameters', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_updateok', 'update successed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_updatefalse', 'Update failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_updatedatafalse', 'Data update failed', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_donotinfo', 'No action or no permission', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_langinfotext', 'When multi-language is turned on, you must first switch to the visual management of the corresponding language or the traditional background, and then enable a set of templates here; different languages can enable different templates.', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_metinfouserinfo', 'The Mito official website user center account can simultaneously install the purchased and bound domain name as the business template of the website. You can bind the domain name in the Mituo user center within 60 days after purchase.', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_buytemplates', 'Purchase new template', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_delettemplatesinfo', 'Deleting a template from the list does not delete the template folder under the website root /templates/', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_demoinstalltitle', 'Demo data installation tips! ! !', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_demoinstallsel', 'Please choose the appropriate installation method for you:', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_demoinstallt1', 'Restore factory settings: The system will clear all existing data of the website and restore the website to the template demo data status;', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_demoinstallt2', 'Back up existing data and install it: the system will automatically back up the existing database and image of the website, and then restore the website to the template demo data status. In the future, you can restore the website to the state before the demo data is installed by restoring the backup data.', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_demoinstallt3', 'Cancel: If your website has already added content, we recommend that you do not install demo data. After installing the template, you can set the relevant block content directly in the visualization.', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_saveinstall', 'Back up existing data and install it', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_installnewmetinfo', 'reset', 1, 0, 0, 50002, $lang);
self::add_admin_language('met_template_downloadtemjs', 'Downloading template...', 1, 0, 1, 50002, $lang);
self::add_admin_language('met_template_downloadtemokjs', 'Download template successfully', 1, 0, 1, 50002, $lang);
self::add_admin_language('met_template_downloaduijs', 'Downloading UI', 1, 0, 1, 50002, $lang);
self::add_admin_language('columndefallinfo', 'Deleting the language system will automatically delete all content and images in the current language, and it is not recoverable. Are you sure to delete?', 1, 0, 1, 0, $lang);
self::add_admin_language('cancel', 'cancel', 1, 0, 1, 0, $lang);
        }
    }
    }


    public function update_shop()
    {
        global $_M;

        if($_M['table']['shopv2_product']){
            $shop_update = load::mod_class('update/admin/update','new');
            $shop_update->update();

            $pay_update = load::mod_class('update/admin/updatepay','new');
            $pay_update->update();

            self::check_shop();
        }
    }

    public function check_shop()
    {
        global $_M;
        if(!file_exists(PATH_WEB.'shop')){
            $query = "DELETE FROM {$_M['table']['applist']} WHERE no = '10043'";
            DB::query($query);

            $query = "DELETE FROM {$_M['table']['app_config']} WHERE appno = 10043";
            DB::query($query);

            $query = "DELETE FROM {$_M['table']['app_plugin']} WHERE no = 10043";
            DB::query($query);
        }

        if(!file_exists(PATH_WEB.'pay')){
            $query = "DELETE FROM {$_M['table']['applist']} WHERE no = 10080";
            DB::query($query);
            $query = "DELETE FROM {$_M['table']['app_config']} WHERE appno = 10080";
            DB::query($query);
            $query = "DELETE FROM {$_M['table']['pay_config']}";
            DB::query($query);
        }
    }

    public function get_sql($data) {
        global $_M;
        $sql = "";
        foreach ($data as $key => $value) {
            if(strstr($value, "'")){
                $value = str_replace("'", "\'", $value);
            }
            $sql .= " {$key} = '{$value}',";
        }
        return trim($sql,',');
    }
}