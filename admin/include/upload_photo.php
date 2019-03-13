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
<script type='text/javascript'>js</script>
<script type="text/javascript" src="../include/metinfo.js"></script>
</head>
<body>

<form enctype="multipart/form-data" method="POST" name="myform" onSubmit="return CheckFormupload();" action="upload_save.php?action=add&lang=$lang" target="_self">
<input name="imgurl" type="file" class="input" size="20" maxlength="200"> <input type="submit" name="Submit" value="$lang_upfileName" class="tj">
<input name="returnid" type="hidden" value="$returnid" />
<input name="met_arrayimg" type="hidden" value="$met_arrayimg" />
<input name="create_samll" type="hidden" value="$create_samll" />
<input name="flash" type="hidden" value="$flash" />
</form>
</body>
</html>
EOT;
?>