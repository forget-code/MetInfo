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
        if ($_M['config']['met_online_type'] <> 3) {
            $met_url = $_M['url']['site'] . 'public/';
            $cache_online = met_cache('online_' . $_M['lang'] . '.inc.php');
            if (!$cache_online) {
                $cache_online = cache_online();
            }
            foreach ($cache_online as $key => $list) {
                $online_list[] = $list;
                if ($list['qq'] != "") $qq_list[] = $list;
                if ($list['msn'] != "") $msn_list[] = $list;
                if ($list['taobao'] != "") $taobao_list[] = $list;
                if ($list['alibaba'] != "") $alibaba_list[] = $list;
                if ($list['skype'] != "") $skype_list[] = $list;
            }

            // 在线交流文字
            $query = "select * from {$_M['table']['language']} where name='Online' and lang='{$_M['lang']}'";
            $online_word = DB::get_one($query);

            $metinfo='<div id="onlinebox" class="onlinebox" style="display:none;" m-type="online" m-id="online">';
            $metinfo.='<div class="onlinebox-open" id="onlinebox-open" style="background:'.$_M['config'][met_online_color].';"><i class="fa fa-comments-o"></i></div>';
            $metinfo.='<div class="onlinebox-top" '.$stit.' style="background:'.$_M['config'][met_online_color].';">';
            $metinfo.='<span class="editable-click" met-id="'.$online_word['id'].'" met-table="language" met-field="value">'.$online_word['value'].'</span><a href="javascript:;" class="onlinebox-close" title="'.$lang_Close.'" onclick="return onlineclose();">x</a><a href="javascript:;" class="onlinebox-min" onclick="return onlinemin();">-</a>';
            $metinfo .= '		</div>';
            $metinfo .= '		<div class="onlinebox-center">';
            $metinfo .= '		<div class="onlinebox-center-box list-group">';
            //online content

            foreach ($online_list as $key => $val) {
                $metinfo .= '<li class="list-group-item">';

                if (!$_M['config']['met_onlinenameok']) $metinfo .= '<h4 class="list-group-item-heading">' . $val['name'] . "</h4>";
                if ($val['qq'] != "") {
                    $metinfo .= '<p class="met_qq list-group-item-text"><a href="http://wpa.qq.com/msgrd?v=3&uin=' . $val['qq'] . '&site=qq&menu=yes" target="_blank"><i class="fa fa-qq"></i><span>' .
                        $val['qq'] . '</span></a></p>';
                }
                if ($val['msn'] != "") $metinfo .= '<p class="met_facebook list-group-item-text"><a href="https://www.facebook.com/' . $val['msn'] . '" target="_blank"><i class="fa fa-facebook"></i><span>' .
                    $val['msn'] . '</span></a></p>';
                if ($val['taobao'] != "") $metinfo .= '<p class="met_taobao list-group-item-text"><a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=' . urlencode($val['taobao']) . '&siteid=cntaobao&status=' . $_M['config']['met_taobao_type'] . '&charset=utf-8"><img src="' .
                    $met_url . 'images/taobao/taobao.png' .
                    '" alt=""><span>'
                    . $val['taobao'] . '</span></a></p>';
                if ($val['alibaba'] != "") {
                    $metinfo .= '<p class="met_alibaba list-group-item-text"><a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=' . $val['alibaba'] . '&site=cnalichn&s=' . $_M['comfig']['met_alibaba_type'] . '&charset=UTF-8"><img src="' .
                        $met_url . 'images/taobao/taobao.png' . '" alt=""><span>'
                        . $val['alibaba'] . '</span></a></p>';
                }
                if ($val['skype'] != "") {
                    $metinfo .= '<p class="met_skype list-group-item-text"><a href="callto://' . $val['skype'] . '"><i class="fa fa-skype"></i><span>' . $val['skype'] . '</span></a></p>';
                }
                $metinfo .= "</li>";
            }
            //online over
            $metinfo .= '			</div>';
            $metinfo .= '		</div>';

            if ($_M['config']['met_onlinetel'] != "") {
                $metinfo .= '		<div class="onlinebox-bottom">';
                $metinfo .= '			<div class="onlinebox-bottom-box"><div class="online-tbox list-group-item">';
                $metinfo .= $_M['config']['met_onlinetel'];
                $metinfo .= '			</div></div>';
                $metinfo .= '		</div>';
            }
            $metinfo .= '</div>';

            $tmpincfile = PATH_WEB . "templates/{$_M['config']['met_skin_user']}/metinfo.inc.php";
            if (file_exists($tmpincfile)) {
                require_once $tmpincfile;
            }
            $metinfover = $metinfover_url ? $metinfover_url : $metinfover;

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
                    if(online_type==0 || online_type==1) document.getElementById("onlinebox-open").style.float = "left";
                    if(online_type==1 || online_type==2) document.getElementById("onlinebox").style.position = "absolute";
            	},0)
            });
    		</script>';
            if ($metinfover == 'v1' || $metinfover == 'v2') {// 增加$metinfover判断值（新模板框架v2）
                //处理回传数据(sea.js处理方式)
                $onlinex = $_M['config']['met_online_type'] < 2 ? $_M['config']['met_onlineleft_left'] : $_M['config']['met_onlineright_right'];
                $onliney = $_M['config']['$met_online_type'] < 2 ? $_M['config']['met_onlineleft_top'] : $_M['config']['met_onlineright_top'];
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