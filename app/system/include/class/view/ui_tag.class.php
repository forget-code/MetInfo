<?php

class ui_tag extends tag {
    // 必须包含config属性 不可修改
    public $config = array(
        'ui'  => array( 'block' => 0, 'level' => 0 ),
        'met_meta'  => array( 'block' => 0, 'level' => 0 ),
        'met_foot'  => array( 'block' => 0, 'level' => 0 ),
    );

    public function _ui($attr, $content, &$met)
    {

        $name = isset($attr['name']) ? $attr['name'] : '';
        $style = isset($attr['style']) ? $attr['style'] : 'met-1';
        $id = isset($attr['id']) ? $attr['id'] : 0;
        load::sys_class('view/ui_compile');
        $ui_compile = new ui_compile();
        $ui = $ui_compile->list_local_config($id);

        if(!$ui['ui_show']){
            global $_M;
            if($_M['form']['pageset'] != 1){
                return;
            }
        }
        $file = PATH_TEM."ui/{$name}/{$style}/index.php";
        if(!is_file($file)){
            $file = PATH_ALL_APP."met_ui/admin/ui/{$name}/{$style}/index.php";

            if(!is_file($file)){
                return;
            }
        }
        $view = new met_view();
        $parent_name = $name;
        $view->fetch($file);
        $cache =  file_get_contents($view->compileFile);
        $php = "
        <?php
            \$id = {$id};
            \$style = \"{$style}\";
            if(!isset(\$ui_compile)){
                load::sys_class('view/ui_compile');
                \$ui_compile = new ui_compile();
            }
            \$ui = \$ui_compile->list_local_config(\$id);
            \$ui['has'] =\$ui_compile->list_page_config(\$met_page);
            ?>";
            $cache = $php.$cache;
            $cache = str_replace("<?php defined('IN_MET') or exit('No permission'); ?>", '', $cache);
            $cache = str_replace('$uicss', $parent_name.'_'.$style, $cache);

        return $cache;
    }


    public function _met_meta($attr, $content, &$met)
    {
        global $_M;
        require PATH_WEB."templates/".$_M['config']['met_skin_user'].'/metinfo.inc.php';
        $_M['config']['template_type']=$template_type;
        $user_name=$_M['user']?" data-user_name='{$_M['user']['username']}'":'';
        $isLteIe9=strpos($_SERVER["HTTP_USER_AGENT"],'MSIE 9')!==false || strpos($_SERVER["HTTP_USER_AGENT"],'MSIE 8')!==false;
        if($isLteIe9){
            $basic_css_link="\n<link href='{$_M['url']['site']}app/system/include/static2/css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
<link href='{$_M['url']['site']}app/system/include/static2/css/bootstrap-extend.min.css' rel='stylesheet' type='text/css'/>
<link href='{$_M['url']['site']}app/system/include/static2/assets/css/site.min.css' rel='stylesheet' type='text/css'/>
<link href='{$_M['url']['site']}public/ui/v2/static/css/common-lteie9-1.css' rel='stylesheet' type='text/css'/>\n";
        }else{
            $basic_css_link="\n<link rel='stylesheet' type='text/css' href='{$_M['url']['site']}public/ui/v2/static/css/basic.css'>\n";
        }
        $php = '<!DOCTYPE HTML>
<html>
<head>
<title>{$data.page_title}</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0,minimal-ui">
<meta name="format-detection" content="telephone=no" />
<meta name="description" content="{$data.page_description}" />
<meta name="keywords" content="{$data.page_keywords}" />
<meta name="generator" content="MetInfo {$c.metcms_v}" data-variable="{$c.met_weburl}|{$data.lang}|{$data.classnow}|{$data.id}|{$data.module}|{$c.met_skin_user}"'.$user_name.'/>
<link href="{$c.met_weburl}favicon.ico" rel="shortcut icon" type="image/x-icon" />'.$basic_css_link.
'<?php if(file_exists(PATH_TEM."cache/common.css")){
$common_css_time = filemtime(PATH_TEM."cache/common.css");
    ?>
<link rel="stylesheet" type="text/css" href="{$c.met_weburl}templates/{$c.met_skin_user}/cache/common.css?{$common_css_time}">
<?php } ?>
<?php if(!isset($met_page) && $_M[config][template_type]=="ui") $met_page = 404;if($met_page){ if($met_page == 404){$met_page = "show";}  $page_css_time = filemtime(PATH_TEM."cache/".$met_page."_".$_M[lang].".css");?>
<link rel="stylesheet" type="text/css" href="{$c.met_weburl}templates/{$c.met_skin_user}/cache/{$met_page}_{$_M[lang]}.css?{$page_css_time}"/>
<?php }?>

{$_M[html_plugin][head_script]}
<style>
body{background-image: url({$g.bodybgimg});background-position: center;background-repeat: no-repeat;background-color: {$g.bodybgcolor};font-family:{$g.met_font};}
</style>
<?php if(is_mobile()){ ?>
{$c.met_headstat_mobile}
<?php }else{?>
{$c.met_headstat}
<?php }?>
<!--[if lte IE 9]>
<script src="{$_M[url][site]}public/ui/v2/static/js/lteie9.js"></script>
<![endif]-->
</head>
<!--[if lte IE 8]>
<div class="text-xs-center m-b-0 bg-blue-grey-100 alert">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    {$_M[word][browserupdatetips]}
</div>
<![endif]-->
<body>';

    return $php;
    }

    public function _met_foot($attr,$content,&$met)
    {
        global $_M;
        $php = '<input type="hidden" name="met_lazyloadbg" value="{$g.lazyloadbg}">
<?php if($c["shopv2_open"]){ $shop_lang_time = filemtime(PATH_WEB."app/app/shop/lang/shop_lang_'.$_M['lang'].'.js"); ?>
<script>
var jsonurl="{$url.shop_cart_jsonlist}",
    totalurl="{$url.shop_cart_modify}",
    delurl="{$url.shop_cart_del}",
    price_prefix="{$c.shopv2_price_str_prefix}",
    price_suffix="{$c.shopv2_price_str_suffix}";
</script>
<?php }?>
<script src="{$c.met_weburl}public/ui/v2/static/js/basic.js"></script>
<?php if(file_exists(PATH_TEM."cache/common.js")){ $common_js_time = filemtime(PATH_TEM."cache/common.js");?>
<script src="{$c.met_weburl}templates/{$c.met_skin_user}/cache/common.js?{$common_js_time}"></script>
<?php } ?>
<?php if($met_page){ $page_js_time = filemtime(PATH_TEM."cache/".$met_page."_".$_M[lang].".js");?>
<script src="{$c.met_weburl}templates/{$c.met_skin_user}/cache/{$met_page}_{$_M[lang]}.js?{$page_js_time}"></script>
<?php }?>
<?php if($c["shopv2_open"]){ ?>
<script src="{$c.met_weburl}app/app/shop/lang/shop_lang_{$data.lang}.js?{$shop_lang_time}"></script>
<script src="{$c.met_weburl}app/app/shop/web/templates/met/static/js/shop_own.js"></script>
<?php }?>
</body>
<?php if(is_mobile()){ ?>
{$c.met_footstat_mobile}
<?php }else{?>
{$c.met_footstat}
<?php }?>
{$_M[html_plugin][foot_script]}
</html>';

    return $php;
    }

}