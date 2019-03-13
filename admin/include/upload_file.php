<?php
require_once '../login/login_check.php';
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
echo <<<EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="$img_url/metinfo.css">
<title>$lang_upfileName</title>
<script type="text/javascript"src="../include/metvar.js"></script>
<script type="text/javascript" src="../include/metinfo.js"></script>
<script type="text/javascript" src="../../public/js/metinfo-min.js"></script>
<link href="$img_url/css/reset.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="$img_url/css/metinfo.css" />
</head>
<body>
<form enctype="multipart/form-data" method="POST" name="myform" onSubmit="return CheckFormupload();" action="uploadfile_save.php?action=add" target="_self">
	<input type="text" style="width:105px; padding:1px; margin-right:5px;" id="imgurl" /><input type="button" id="liulang" value="浏览" />&nbsp;<input type="submit" name="Submit" value="$lang_upfileName" onclick="return checkload();" />
    <input name="imgurl" type="file" onchange="$('#imgurl').val($(this).val());" style="position:relative; bottom:23px; right:45px; right:25px\9; height:22px; width:170px;" id="onimgurl" />
<input name="returnid" type="hidden" value="$returnid" />
<input name="uploadtype" type="hidden" value="$uploadtype" />
</form>
<script type="text/javascript">
$("#onimgurl").css("opacity","0.0"); 
$("#onimgurl").hover(function(hv){
	$('#liulang').focus();
},function(){
	$('#liulang').blur();
}); 
function checkload(){
	if($('#imgurl').val()==''){
		alert(user_msg['js15']);
		return false;
	}
}
</script>
</body>
</html>
EOT;
?>