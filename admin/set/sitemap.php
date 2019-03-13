<?php
require_once '../login/login_check.php';
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name'");
$metinfo_admin_pop=admin_popes($admin_list['admin_type'],$lang);
if(	$metinfo_admin_pop!="metinfo"){
$admin_pop=explode('-',$metinfo_admin_pop);
$admin_poptext="admin_pop";
foreach($admin_pop as $key=>$val){
$admin_poptext1=$admin_poptext.$val=$val;
$$admin_poptext1="metinfo";
}
}
	$sitemap = "<div class='sitemap-top'>{$lang_adminstmptext}</div>";
	$sitemap.= "<div class='nav'>";
	$sitemap.= "<ul>
					<li class='top'>{$lang_indexbasic}</li>
					<li><a href='site/sysadmin.php?lang=$lang' title='{$lang_indexsysteminfo}'>{$lang_indexsysteminfo}</a></li>
				";
//系统配置
if($metinfo_admin_pop=="metinfo" || $admin_pop1001=="metinfo"){
    $sitemap.= "<li><a href='set/basic.php?lang=$lang' title='{$lang_indexbasicinfo}'>{$lang_indexbasicinfo}</a></li>";
}
if($metinfo_admin_pop=="metinfo" || $admin_pop1002=="metinfo"){
    $sitemap.= "<li><a href='set/lang.php?lang=$lang' title='{$lang_indexlang}'>{$lang_indexlang}</a></li>";
}
if($metinfo_admin_pop=="metinfo" || $admin_pop1003=="metinfo"){ 
    $sitemap.= "<li><a href='set/foot.php?lang=$lang' title='{$lang_indexfoot}'>{$lang_indexfoot}</a></li>";
}
if($metinfo_admin_pop=="metinfo" || $admin_pop1004=="metinfo"){
    $sitemap.= "<li><a href='set/other_info.php?lang=$lang' title='{$lang_indexotherinfo}'>{$lang_indexotherinfo}</a></li>"; 
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1405=='metinfo'){ 
	$sitemap.= "<li><a href='set/wap.php?lang=$lang' title='{$lang_indexwap}'>{$lang_indexwap}</a></li>";
}
if($metinfo_admin_pop=="metinfo" || $admin_pop1005=="metinfo"){
    $sitemap.= "<li><a href='set/database.php?lang=$lang' title='{$lang_indexdataback}'>{$lang_indexdataback}</a></li>"; 
}
if($metinfo_admin_pop=="metinfo" || $admin_pop1006=="metinfo"){
    $sitemap.= "<li><a href='set/safe.php?lang=$lang' title='{$lang_indexsafe}'>{$lang_indexsafe}</a></li>"; 
}
if($metinfo_admin_pop=="metinfo" || $admin_pop1007=="metinfo"){
    $sitemap.= "<li><a href='set/uploadfile.php?lang=$lang' title='{$lang_indexupload}'>{$lang_indexupload}</a></li>"; 
} 
	$sitemap.= "<li><a href='set/authcode.php?lang=$lang' title='{$lang_indexcode}'>{$lang_indexcode}</a></li>";
	$sitemap.= "<li><a target='_blank' href='http://www.metinfo.cn/ebook' title='{$lang_indexebook}'>{$lang_indexebook}</a></li>";
	$sitemap.= "<li><a target='_blank' href='http://bbs.metinfo.cn/' title='{$lang_indexbbs}'>{$lang_indexbbs}</a></li>";
	$sitemap.= "</ul>";
//界面风格
	$sitemap.= "<ul><li class='top'>{$lang_indexskin}</li>";
if($metinfo_admin_pop=='metinfo' || $admin_pop1101=='metinfo'){
	$sitemap.= "<li><a href='set/skin.php?lang=$lang' title='{$lang_indexskin}'>{$lang_indexskin}</a></li>";
    $sitemap.= "<li><a href='set/skin_manager.php?lang=$lang' title='{$lang_indexskinmanager}'>{$lang_indexskinmanager}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1102=='metinfo'){
    $sitemap.= "<li><a href='set/img.php?lang=$lang' title='{$lang_indexpic}'>{$lang_indexpic}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1103=='metinfo'){
    $sitemap.= "<li><a href='set/index_set.php?lang=$lang' titlte='{$lang_indexhomeset}'>{$lang_indexhomeset}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1104=='metinfo'){
    $sitemap.= "<li><a href='flash/setflash.php?lang=$lang' title='{$lang_indexflashset}'>{$lang_indexflashset}</a></li>";
    $sitemap.= "<li><a href='flash/flash.php?lang=$lang' title='{$lang_indexflash}'>{$lang_indexflash}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1105=='metinfo'){
    $sitemap.= "<li><a href='set/online.php?lang=$lang' title='{$lang_indexonlineset}'>{$lang_indexonlineset}</a></li>";
    $sitemap.= "<li><a href='online/index.php?lang=$lang' title='{$lang_indexonline}'>{$lang_indexonline}</a></li>";
}
	$sitemap.= "<li><a href='set/info.php?lang=$lang' title='{$lang_indexskinset}'>{$lang_indexskinset}</a></li>";
	$sitemap.= "</ul>";
//栏目配置
	$sitemap.= "<ul><li class='top'>{$lang_indexcolumn}</li>";
if($metinfo_admin_pop=='metinfo' || $admin_pop1201=='metinfo'){         	
	$sitemap.= "<li><a href='column/index.php?lang=$lang' title='{$lang_indexcolumn}'>{$lang_indexcolumn}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1202=='metinfo'){    
    $sitemap.= "<li><a href='parameter/parameter.php?module=3&lang=$lang' title='{$lang_mod3}{$lang_parameter}'>{$lang_mod3}{$lang_parameter}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1203=='metinfo'){
    $sitemap.= "<li><a href='parameter/parameter.php?module=4&lang=$lang' title='{$lang_mod4}{$lang_parameter}'>{$lang_mod4}{$lang_parameter}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1204=='metinfo'){
    $sitemap.= "<li><a href='parameter/parameter.php?module=5&lang=$lang' title='{$lang_mod5}{$lang_parameter}'>{$lang_mod5}{$lang_parameter}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1205=='metinfo'){
    $sitemap.= "<li><a href='parameter/parameter.php?module=6&lang=$lang' title='{$lang_indexcv}'>{$lang_indexcv}</a></li>";
}
	$sitemap.= "</ul>";
//内容管理
	$sitemap.= "<ul><li class='top'>{$lang_indexcontent}</li><li class='ddcs'>";
if($metadmin[homecontent]){
if($metinfo_admin_pop=='metinfo' || $admin_pop1301=='metinfo'){
    $sitemap.= "<dl>  
                    <dt><a target='_self' href='javascript:;' title='{$lang_indexsetcontent}'>{$lang_indexsetcontent}</a></dt>
                    <dd style='display:none;'>
					    <p><a href='set/index_content.php?lang=$lang' title='{$lang_indexsetcontent}'>{$lang_indexsetcontent}</a></p>
					</dd>
				</dl>";
}}
foreach($met_classindex[1] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>";
if($val[isshow]==1){
	$sitemap.= "	    <p><a href='about/about.php?id=$val[id]&lang=$lang' title='$val[name]'>$val[name]</a></p>";
}
foreach($met_class22[$val[id]] as $key=>$val1){
if($val1[releclass]==0){
	$sitemap.= "        <p><a href='about/about.php?id=$val1[id]&lang=$lang' title='$val1[name]'>$val1[name]</a></p>";
foreach($met_class3[$val1[id]] as $key=>$val2){
if($val2[releclass]==0){
    $sitemap.= "        <p class='list3'><a href='about/about.php?id=$val2[id]&lang=$lang' title='$val2[name]'>$val2[name]</a></p>";
}}}}
	$sitemap.= "    </dd>
				</dl>";
}}
foreach($met_classindex[2] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					    <p><a href='article/content.php?lang=$lang&action=add&class1=$val[id]' title='{$lang_addinfo}'>{$lang_addinfo}</a></p>
					    <p><a href='article/index.php?class1=$val[id]&lang=$lang' title='{$lang_manager}'>{$lang_manager}</a></p>
		            </dd>
			    </dl>";
}}
foreach($met_classindex[3] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					   	<p><a href='product/content.php?lang=$lang&action=add&class1=$val[id]' title='{$lang_addinfo}'>{$lang_addinfo}</a></p>
		                <p><a href='product/index.php?class1=$val[id]&lang=$lang' title='{$lang_manager}'>{$lang_manager}</a></p>
                    </dd>
				</dl>";
}}
foreach($met_classindex[4] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					   	<p><a href='download/content.php?class1=$val[id]&lang=$lang&action=add' title='{$lang_addinfo}'>{$lang_addinfo}</a></p>
		                <p><a href='download/index.php?class1=$val[id]&lang=$lang' title='{$lang_manager}'>{$lang_manager}</a></p>
                    </dd>
				</dl>";
}}
foreach($met_classindex[5] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					   	<p><a href='img/content.php?class1=$val[id]&lang=$lang&action=add' title='{$lang_addinfo}'>{$lang_addinfo}</a></p>
		                <p><a href='img/index.php?class1=$val[id]&lang=$lang' title='{$lang_manager}'>{$lang_manager}</a></p>
                    </dd>
				</dl>";
}}
foreach($met_classindex[6] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					   	<p><a href='job/content.php?class1=$val[id]&lang=$lang&action=add' title='{$lang_addinfo}'>{$lang_addinfo}</a></p>
		                <p><a href='job/index.php?class1=$val[id]&lang=$lang' title='{$lang_manager}'>{$lang_manager}</a></p>
		                <p><a href='job/cv.php?class1=$val[id]&lang=$lang' title='{$lang_indexCv}'>{$lang_indexCv}</a></p>
		                <p><a href='job/inc.php?lang=$lang' title='{$lang_set}'>{$lang_set}</a></p>
                    </dd>
				</dl>";
}}
	$sitemap.= "</li></ul>";
//优化推广
	$sitemap.= "<ul><li class='top'>{$lang_indexseo}</li>";
if($metinfo_admin_pop=='metinfo' || $admin_pop1401=='metinfo'){
if($met_webhtm){
    $sitemap.= "<li><a href='set/htm.php?lang=$lang' title='{$lang_indexhtm}'>{$lang_indexhtm}</a></li>";	
    $sitemap.= "<li><a href='set/sethtm.php?lang=$lang' title='{$lang_indexhtmset}'>{$lang_indexhtmset}</a></li>";
}else{ 
    $sitemap.= "<li><a href='set/sethtm.php?lang=$lang' title='{$lang_indexhtmset}'>{$lang_indexhtmset}</a></li>";		
    $sitemap.= "<li><a href='set/htm.php?lang=$lang' title='{$lang_indexhtm}'>{$lang_indexhtm}</a></li>";
}
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1402=='metinfo'){
    $sitemap.= "<li><a href='set/seo.php?lang=$lang' title='{$lang_indexseoset}'>{$lang_indexseoset}</a></li>";
}
jmali_start();
if($metinfo_admin_pop=='metinfo' || $admin_pop1403=='metinfo'){
    $sitemap.= "<li><a href='set/strcontent.php?lang=$lang' title='{$lang_indexhot}'>{$lang_indexhot}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1404=='metinfo'){
    $sitemap.= "<li><a href='link/index.php?lang=$lang' title='{$lang_indexlink}'>{$lang_indexlink}</a></li>";
}
	$sitemap.= "</ul>";
//反馈留言
	$sitemap.= "<ul><li class='top'>{$lang_indexfeedback}</li><li class='ddcs'>";
foreach($met_module[8] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					   	<p><a href='feedback/inc.php?lang=$lang&class1=$val[id]' title='{$lang_set}'>{$lang_set}</a></p>
		                <p><a href='feedback/parameter.php?lang=$lang&class1=$val[id]' title='{$lang_indexfeedbackp}'>{$lang_indexfeedbackp}</a></p>
		                <p><a href='feedback/index.php?lang=$lang&class1=$val[id]' title='{$lang_indexfeedbackm}'>{$lang_indexfeedbackm}</a></p>
                    </dd>
				</dl>";
}}
foreach($met_module[7] as $key=>$val){
$admin_pop='admin_pop'.$val[id];
if($metinfo_admin_pop=='metinfo' || $$admin_pop=='metinfo'){
	$sitemap.= "<dl>
				    <dt class='sitemapdt'><a target='_self' href='javascript:;' title='$val[name]'>$val[name]</a></dt>
					<dd style='display:none;'>
					   	<p><a href='message/inc.php?lang=$lang' title='{$lang_set}'>{$lang_set}</a></p>
		                <p><a href='message/index.php?lang=$lang' title='{$lang_indexmessage}'>{$lang_indexmessage}</a></p>
                    </dd>
				</dl>";
}}
	$sitemap.= "</li></ul>";
//用户管理
	$sitemap.= "<ul class='rul'><li class='top'>{$lang_indexuser}</li>";
if($metinfo_admin_pop=='metinfo' || $admin_pop1603=='metinfo'){
    $sitemap.= "<li><a href='member/index.php?lang=$lang' title='{$lang_memberManage}'>{$lang_memberManage}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1602=='metinfo'){
    $sitemap.= "<li><a href='set/member.php?lang=$lang' title='{$lang_memberset}'>{$lang_memberset}</a></li>";
}
if($metinfo_admin_pop=='metinfo' || $admin_pop1601=='metinfo'){
    $sitemap.= "<li><a href='admin/index.php?lang=$lang' title='{$lang_indexadminname}'>{$lang_indexadminname}</a></li>";
}
else{
    $sitemap.= "<li><a href='admin/editor_pass.php?id=$admin_list[id]&lang=$lang' title='{$lang_indexperson}'>{$lang_indexperson}</a></li>";
}
	$sitemap.= "</ul>";
	$sitemap.= "<div class='clear'></div></div>";
	echo $sitemap;
?>