<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27
 * Time: 15:31
 */

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class online extends web
{
    public function __construct()
    {
        global $_M;
        parent::__construct();
    }

    public function do_online()
    {
        global $_M,$metinfover;
        if ($_M['config']['met_online_type'] != 0 ) {
            $met_url = $_M['url']['site'] . 'public/';
            $cache_online = met_cache('online_' . $_M['lang'] . '.inc.php');
            if (!$cache_online) {
                $cache_online = cache_online();
            }

            // 在线客服文字
            $query = "select * from {$_M['table']['language']} where name='Online' and lang='{$_M['lang']}'";
            $online_word = DB::get_one($query);

            $metinfo="<div id='onlinebox' class='onlinebox' style='display:none;' m-type='online' m-id='online'>
                        <div class='onlinebox-open' id='onlinebox-open' style='background:{$_M['config']['met_online_color']};'><i class='fa fa-comments-o'></i></div>
                        <div class='onlinebox-box'>
                            <div class='onlinebox-top' style='background:{$_M['config']['met_online_color']};'>
                                <div class='onlinebox-top-btn'>
                                    <a href='javascript:;' class='onlinebox-close' title='{$lang_Close}' onclick='return onlineclose();'>x</a>
                                    <a href='javascript:;' class='onlinebox-min' onclick='return onlinemin();'>-</a>
                                </div>
                                <h4 class='editable-click' met-id='{$online_word['id']}' met-table='language' met-field='value'>{$online_word['value']}</h4>
                            </div>
                            <div class='onlinebox-center list-group'>";
            //online content
            $qq_url1='http://wpa.qq.com/msgrd?v=3&uin=';
            $qq_url2='&site=qq&menu=yes';
            if(!met_useragent('desktop') && strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false){
                $qq_url1='mqqwpa://im/chat?chat_type=wpa&uin=';
                $qq_url2='&version=1&src_type=web';
            }
            foreach ($cache_online as $key => $val) {
                $metinfo .= '<li class="list-group-item">';
                $val['show_name']=$val['name'];
                if ($val['qq'] != '') {
                    if($_M['config']['met_onlinenameok']) $val['show_name']=$val['qq'];
                    $metinfo .= "<p class='met_qq list-group-item-text'><a href='{$qq_url1}{$val['qq']}{$qq_url2}' target='_blank'><i class='fa fa-qq'></i><span>{$val['show_name']}</span></a></p>";
                }
                if ($val['msn'] != ''){
                    if($_M['config']['met_onlinenameok']) $val['show_name']=$val['msn'];
                    $metinfo .= "<p class='met_facebook list-group-item-text'><a href='https://www.facebook.com/{$val['msn']}' target='_blank'><i class='fa fa-facebook'></i><span>{$val['show_name']}</span></a></p>";
                }
                if ($val['taobao'] != ''){
                    if($_M['config']['met_onlinenameok']) $val['show_name']=$val['taobao'];
                    $metinfo .= "<p class='met_taobao list-group-item-text'><a href='http://www.taobao.com/webww/ww.php?ver=3&touid=".urlencode($val['taobao']) ."&siteid=cntaobao&status={$_M['config']['met_taobao_type']}&charset=utf-8' target='_blank'><img src='{$met_url}images/taobao/taobao.png'><span>{$val['show_name']}</span></a></p>";
                }
                if ($val['alibaba'] != '') {
                    if($_M['config']['met_onlinenameok']) $val['show_name']=$val['alibaba'];
                    $metinfo .= "<p class='met_alibaba list-group-item-text'><a href='http://amos.alicdn.com/msg.aw?v=2&uid={$val['alibaba']}&site=cnalichn&s={$_M['comfig']['met_alibaba_type']}&charset=UTF-8' target='_blank'><img src='{$met_url}images/taobao/taobao.png'><span>{$val['show_name']}</span></a></p>";
                }
                if ($val['skype'] != '') {
                    if($_M['config']['met_onlinenameok']) $val['show_name']=$val['skype'];
                    $metinfo .= "<p class='met_skype list-group-item-text'><a href='callto://{$val['skype']}'><i class='fa fa-skype'></i><span>{$val['show_name']}</span></a></p>";
                }
                $metinfo .= '</li>';
            }
            //online over
            $metinfo .= '</div>';

            if ($_M['config']['met_onlinetel'] != "") {
                $metinfo .= "<div class='onlinebox-bottom'>{$_M['config']['met_onlinetel']}</div>";
            }
            $metinfo .= '</div></div>';

            $tmpincfile = PATH_WEB . "templates/{$_M['config']['met_skin_user']}/metinfo.inc.php";
            if (file_exists($tmpincfile)) require_once $tmpincfile;

            if ($metinfover == 'v1') $metinfo .= '<script>
            function onlinemin(){
                $("#onlinebox").addClass("min");
                return false;
            }
            $(document).on("click",".onlinebox-open",function(){
                $("#onlinebox").removeClass("min");
            })
            $(function() {
                setTimeout(function(){
                    var online_type="'.$_M['config']['met_online_type'].'";
                    if(document.documentElement.clientWidth<768) $("#onlinebox").addClass("min");
                    if(online_type==3 || online_type==1) document.getElementById("onlinebox-open").style.float = "left";
                    if(online_type==1 || online_type==2) document.getElementById("onlinebox").style.position = "absolute";
                },0)
            });
            </script>';
            if ($metinfover == 'v1' || $metinfover == 'v2') {// 增加$metinfover判断值（新模板框架v2）
                //处理回传数据(sea.js处理方式)
                $onlinex = $_M['config']['met_online_x'] ? $_M['config']['met_online_x'] : "10";
                $onliney = $_M['config']['met_online_y'] ? $_M['config']['met_online_y'] : "100";
                $data['html'] = $metinfo;
                $data['t'] = $_M['config']['met_online_type'];
                $data['x'] = $onlinex;
                $data['y'] = $onliney;
                echo json_encode($data);
            } else {
                //处理回传数据(老模板处理方式)
                $_REQUEST['jsoncallback'] = strip_tags($_REQUEST['jsoncallback']);
                if ($_REQUEST['jsoncallback']) {
                    $metinfo = str_replace("'", "\'", $metinfo);
                    $metinfo = str_replace('"', '\"', $metinfo);
                    $metinfo = preg_replace("'([\r\n])[\s]+'", "", $metinfo);
                    echo $_REQUEST['jsoncallback'] . '({"metcms":"' . $metinfo . '"})';
                } else {
                    echo $metinfo;
                }
                die();
            }

        }
    }
}