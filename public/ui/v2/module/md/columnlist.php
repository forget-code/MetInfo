<?php
$sidebar_allcolumn=$sidebar_allcolumn?$sidebar_allcolumn:$class1_info[name];
$active = $classnow==$class1?' class="active"':'';
echo <<<EOT
-->
<ul class="sidebar-column list-icons">
    <li><a href="{$class1_info['url']}" title="{$sidebar_allcolumn}"{$active} {$metblank}>{$sidebar_allcolumn}</a></li>
<!--
EOT;
foreach($nav_list2[$navdown] as $key => $val){
    if($key<$sidebar_column_num){
        $active = $val['id']==$class2?' class="active"':'';
echo <<<EOT
-->
    <li>
<!--
EOT;
        $dropok=count($nav_list3[$val['id']]) && $lang_sidebar_column3_ok;
        $data_toggle=$data_icon='';
        $val_url=$val[url];
        if($dropok){
            $val_url="javascript:;";
            $data_toggle=' data-toggle="collapses"';
            $data_icon=' <i class="wb-chevron-right-mini"></i>';
        }
echo <<<EOT
-->
        <a href="{$val_url}" title="{$val[name]}"{$active}{$data_toggle}>
            {$val[name]}{$data_icon}
        </a>
<!--
EOT;
        if($dropok){
echo <<<EOT
-->
        <div class="collapse">
            <ul>
<!--
EOT;
            if($val['isshow']){
                $navname = $val['module']==1?$val['name']:$lang_all;
                $active = $val['id']==$classnow?' class="active"':'';
echo <<<EOT
-->
                <li><a href="{$val[url]}" {$val[new_windows]} title="{$navname}"{$active}>{$navname}</a></li>
<!--
EOT;
            }
            foreach($nav_list3[$val['id']] as $key=>$val2){
                $active = $val2['id'] == $classnow?' class="active"':'';
echo <<<EOT
-->
                <li><a href="{$val2[url]}" title="{$val2[name]}"{$active}>{$val2[name]}</a></li>
<!--
EOT;
            }
echo <<<EOT
-->
            </ul>
        </div>
<!--
EOT;
        }
echo <<<EOT
-->
    </li>
<!--
EOT;
    }
}
echo <<<EOT
-->
</ul>
<!--
EOT;
?>