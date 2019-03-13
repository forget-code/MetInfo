<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/*兼容标签*/

require_once PATH_WEB.'app/system/include/compatible/metv5_top.php';

if($control['left'] >= 1){
	if(is_letf_exists('sidebar')){
		require_once $this->template('tem/head');
		require_once $this->template('tem/sidebar');
echo <<<EOT
-->

        <div>
<!--
EOT;
		require_once $this->template($control['content']);
echo <<<EOT
-->

		</div>
    </div>
<!--
EOT;
echo <<<EOT
-->
    <div style="clear:both;"></div>
</div>
<!--
EOT;
		require_once $this->template('ui/gap');
		require_once $this->template('tem/foot');
	}else if(is_letf_exists('web')){
		require_once $this->template('tem/head');
		require_once $this->template('tem/webtop');
echo <<<EOT
-->

        <div>
<!--
EOT;
		require_once $this->template($control['content']);
echo <<<EOT
-->

		</div>
    </div>
<!--
EOT;
		require_once $this->template('tem/web');
echo <<<EOT
-->
    <div style="clear:both;"></div>
</div>
<!--
EOT;
		require_once $this->template('tem/foot');
	}else if(is_letf_exists('webright')){
		require_once $this->template('tem/head');
echo <<<EOT
-->
<div id="web">
<div class="left">
	    <h3 class="title"><span>{$class_list[$classnow][name]}</span></h3>
   <div class="webcontent editor">
<!--
EOT;
		require_once $this->template($control['content']);
echo <<<EOT
-->
   </div>
</div>

<!--
EOT;
		require_once $this->template('tem/webright');
echo <<<EOT
-->
<div style="clear:both;"></div>
</div>
<!--
EOT;
		require_once $this->template('tem/foot');
	}else if(is_letf_exists('webleft')){
		require_once $this->template('tem/head');
echo <<<EOT
-->
<div id="web">
<div class="right">
   <h3 class="title"><span>{$class_list[$classnow][name]}</span></h3>
   <div class="webcontent">
<!--
EOT;
		require_once $this->template($control['content']);
echo <<<EOT
-->
   </div>
   </div>
<!--
EOT;
		require_once $this->template('tem/webleft');
echo <<<EOT
-->
<div style="clear:both;"></div>
</div>
<!--
EOT;
		require_once $this->template('tem/foot');
	}else{
		require_once $this->template('tem/head');

        $file=PATH_TEM.'min/config.php';
        if($metinfover=='v1' && !file_exists($file)){//修改判断(新模板框架v2)
              require_once $this->template('ui/sidebar');
        }

        require_once $this->template($control['content']);

        if($metinfover=='v1' && !file_exists($file)){//修改判断(新模板框架v2)
		require_once $this->template('ui/gap');
         }



		require_once $this->template('tem/foot');
	}
}else{
	require_once $this->template('tem/head');
echo <<<EOT
-->

        <div>
<!--
EOT;
	require_once $this->template($control['content']);
echo <<<EOT
-->


<!--
EOT;
echo <<<EOT
-->
    <div style="clear:both;"></div>
</div>
<!--
EOT;
	require_once $this->template('tem/foot');
}


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>