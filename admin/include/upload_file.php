<?php
require_once '../login/login_check.php';
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="<?echo $img_url;?>/metinfo.css">
<title><? echo $lang_upfileName; ?></title>
<script type='text/javascript'><? echo $js;?></script>
<script type="text/javascript" src="../include/metinfo.js"></script>
</head>
<body>

<form enctype="multipart/form-data" method="POST" name="myform" onSubmit="return CheckFormupload();" action="uploadfile_save.php?action=add" target="_self">
<input name="imgurl" type="file" class="input" size="20" maxlength="200">
<input name="returnid" type="hidden" value="<? echo $returnid; ?>" />
<input name="uploadtype" type="hidden" value="<? echo $uploadtype; ?>" />
<input type="submit" name="Submit" value="<? echo $lang_upfileName;?>" class="tj">
</form>
</body>
</html>