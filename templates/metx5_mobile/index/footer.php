<!--<?php
echo <<<EOT
-->
<section class="tem_index_footer">
	<div class="tem_inner">
		<dl class="tem_index_footer_contact">
			<dt><span>{$lang_indexfooter_contact}</span></dt>
			<dd>
				<ul>
					<li><i class="fa fa-map-marker"></i>{$lang_contact_position}</li>
					<li><i class="fa fa-phone"></i>{$lang_contact_phone}</li>
					<li><i class="fa fa-envelope-o"></i>{$lang_contact_email}</li>
				</ul>
			</dd>
		</dl>
		<dl class="tem_index_footer_attention">
			<dt><span>{$lang_indexfooter_attention}</span></dt>
			<dd>
				<p>{$lang_attention_weibo}</p>
				<ul>
					<li class="xinlan"><a href="{$lang_weibo_sina}" target="_blank" title="{$lang_weibo_sina_title}">{$lang_weibo_sina_title}</a></li>
					<li class="tenxun"><a href="{$lang_weibo_tqq}" target="_blank" title="{$lang_weibo_tqq_title}">{$lang_weibo_tqq_title}</a></li>
					<li class="qq"><a href="http://wpa.qq.com/msgrd?v=3&uin={$lang_weibo_qq}&site=qq&menu=yes" target="_blank" title="{$lang_weibo_qq_title}">{$lang_weibo_qq_title}</a></li>
				</ul>
				<p>{$lang_attention_weixin}</p>
				<img src="{$lang_weixin_img}" />
			</dd>
		</dl>
		<dl class="tem_index_footer_link">
			<dt><span>{$lang_linkstitle}</span></dt>
			<dd>
<!--
EOT;
if(count($link_img)>0){
echo <<<EOT
-->
        <div class="tem_img">
<!--
EOT;
foreach($link_img as $key=>$val){
echo <<<EOT
-->
          <a href="{$val[weburl]}" title="{$val[webname]}" target="_blank"><img src="{$val[weblogo]}" title="{$val[webname]}" alt="{$val[webname]}"></a>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
<!--
EOT;
}
if(count($link_text)>0){
echo <<<EOT
-->
        <div class="tem_txt">
<!--
EOT;
foreach($link_text as $key=>$val){
echo <<<EOT
-->
          <a href="{$val[weburl]}" title="{$val[info]}" target="_blank">{$val[webname]}</a>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
<!--
EOT;
}
echo <<<EOT
-->
			</dd>
		</dl>
		<div class="met_clear"></div>
	</div>
</section>
<!--
EOT;
?>