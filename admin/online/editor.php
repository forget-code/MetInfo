<?php
# �ļ�����:editor.php 2009-08-15 14:34:57
# MetInfo��ҵ��վ����ϵͳ 
# Copyright (C) ��ɳ������Ϣ�������޹�˾ (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$online_list=$db->get_one("select * from $met_online where id='$id'");
if(!$online_list){
okinfo('index.php',$lang_loginNoid);
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('online_editor');
footer();
# ��������һ����Դϵͳ,ʹ��ʱ������ϸ�Ķ�ʹ��Э��,��ҵ��;���Ծ�������ҵ��Ȩ.
# Copyright (C) ��ɳ������Ϣ�������޹�˾ (http://www.metinfo.cn). All rights reserved.
?>