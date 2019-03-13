<?php
if($lang_placeholder){
echo <<<EOT
-->
<input type="hidden" name='met_placeholder' value='{$lang_placeholder}'>
<!--
EOT;
}
if($lang_lazyloadbg){
echo <<<EOT
-->
<input type="hidden" name='met_lazyloadbg_set' value='{$lang_lazyloadbg}'>
<!--
EOT;
}
if($_M['url']['shop']){
echo <<<EOT
--><script>
var jsonurl='{$_M['url']['shop_cart_jsonlist']}',
    totalurl='{$_M['url']['shop_cart_modify']}',
    delurl='{$_M['url']['shop_cart_del']}',
    price_prefix='{$_M['config']['shopv2_price_str_prefix']}',
    price_suffix='{$_M['config']['shopv2_price_str_suffix']}';
</script>
<!--
EOT;
}
foreach ($resui[js] as $value) {
echo <<<EOT
-->
<script src="{$value}"></script>
<!--
EOT;
}
echo <<<EOT
-->
</body>
</html>
<!--
EOT;
?>-->