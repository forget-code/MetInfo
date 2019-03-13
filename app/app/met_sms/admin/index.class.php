<?php
defined('IN_MET') or exit('No permission');
load::sys_class('admin');
class index extends admin {

    public $sms;
    public function __construct() {
        global $_M;

        parent::__construct();
        nav::set_nav(1, "短信配置", $_M['url']['own_form']."a=doindex");
        nav::set_nav(2, "短信群发", $_M['url']['own_form']."a=domass");
        nav::set_nav(3, "财务记录", $_M['url']['own_form']."a=dofinance");
        nav::set_nav(4, "发送记录", $_M['url']['own_form']."a=dolog");
        $this->sms = load::own_class('met_sms','new');
    }

    public function doindex() {
        global $_M;

        nav::select_nav(1);

        $status = load::mod_class('appstore/include/inapp', 'new')->get_appstore_status();

        if($status['state'] == 0){
          header("location:".$status['loginurl'].urlencode($_M['url']['own_form']."a=doindex"));die;
        }
        $total  = $this->sms->get_total();

        $res    = $this->sms->sms_sign($_M['form']['sms_sign']);

        $old    = $this->sms->get_old();


        if($res['status'] == 0){
            turnover("{$_M['url']['own_form']}a=doindex",$res['msg']);
        }else{
            if($res['verify'] == 1){
                $msg = '审核通过';
            }else{
                $msg = '审核中';
            }
        }

        require_once $this->template('own/index');
    }

    public function domass()
    {
        global $_M;
        nav::select_nav(2);
        require_once $this->template('own/mass');
    }

    public function dofinance() {
        global $_M;
        nav::select_nav(3);
        require_once $this->template('own/finance');
    }

    public function dolog() {
        global $_M;
        nav::select_nav(4);
        require_once $this->template('own/sms_log');
    }

    public function dolist_finance() {
        global $_M;
        $table  = load::sys_class('tabledata', 'new');
        $res    = $this->sms->get_finance($_M['form']['start'],$_M['form']['length']);
        foreach ($res['data']['data'] as $key => $val) {
            $list   = array();
            $list[]     = $val['user_name'];
            $list[]     = $val['domain'];
            $list[]     = $val['price'];
            $list[]     = $val['number'];
            $list[]     = date('Y-m-d H:i:s',$val['add_time']);
            $rarray[]   = $list;
        }

        $table->rarray['recordsTotal'] = $table->rarray['recordsFiltered'] = $res['data']['total'];
        $table->rdata($rarray);
    }


    public function dolog_list() {
        global $_M;

        $table = load::sys_class('tabledata', 'new');
        $where = " 1 = 1 ";
        $order = "add_time DESC";

        $array = $this->sms->get_logs($_M['form']['start'],$_M['form']['length']);

        foreach($array['data']['data'] as $key => $val){
            $list   = array();
            $list[] ="<input name=\"id\" id=\"{$val[id]}\" type=\"checkbox\" value=\"{$val[id]}\">";//第一列
            $list[] = date('Y-m-d H:i:s',$val['add_time']);
            $list[] = $val['type'] == 1 ? '用户通知' : '营销短信';
            $list[] = $val['content'];
            $list[] = $val['phone'];
            $list[] = $val['description'];
            $rarray[] = $list;
        }
        $table->rarray['recordsTotal'] = $table->rarray['recordsFiltered'] = $array['data']['total'];
        $table->rdata($rarray);
    }



    public function dobuy(){
        global $_M;
        $balance = $this->sms->get_balance();
        require_once $this->template('own/recharge');
    }

    public function domigrate() {
        global $_M;
        $res = $this->sms->migrate();
        if($res['status'] == 0){
            turnover("{$_M['url']['own_form']}a=doindex",$res['msg']);
        }else{
            turnover("{$_M['url']['own_form']}a=doindex",$res['data']);
        }
    }

    public function doadd_buy() {
        global $_M;
        $package    = intval($_M['form']['package']);
        $buy        = $this->sms->buy($package);
        echo json_encode($buy);die;
    }

    // 短信套餐
    public function dopackage() {
        global $_M;
        $table      = load::sys_class('tabledata', 'new');
        $package    = $this->sms->get_package();
        $rarray     = array();
        $balance    = $this->sms->get_balance();
        foreach ($package['data'] as $key => $val) {

            $text = $recharge = '';
            if($balance < $key){
                $text       = 'disabled';
                $recharge   = "<a href={$_M['url']['site_admin']}index.php?lang={$_M['lang']}&anyid=65&n=appstore&c=appstore&c=member&a=dorecharge&return_this=1>充值</a>";
            }
            $list   = array();
            $list[] = "￥ ".number_format($key,2);
            $list[] = $val;
            $buy    = "<button class='btn btn-danger metwindow' data-type={$key} {$text}>购买</button> {$recharge}";
            $list[] = $buy;
            $rarray[]   = $list;
        }

        $table->rarray['recordsTotal'] = $table->rarray['recordsFiltered'] = count($package['data']);

        $table->rdata($rarray);
    }


    public function dosend()
    {
        global $_M;
        $sms_content    = $_M['form']['sms_content'];
        $sms_phone      = $_M['form']['sms_phone'];
        $res = $this->sms->custom_send($sms_phone,$sms_content);
        echo json_encode($res);die;
    }
}
