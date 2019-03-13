<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
$privilege = background_privilege();
$navigation=$privilege['navigation'];
$arrlanguage=explode('|', $navigation);
  if(in_array('metinfo',$arrlanguage)||in_array('1201',$arrlanguage)){
	$langprivelage=1;
  }else{
    $langprivelage=0;
  }
  if(in_array('metinfo',$arrlanguage)||in_array('1007',$arrlanguage)){
	$inforprivelage=1;
  }else{
   $inforprivelage=0;
  }
if(in_array('metinfo',$arrlanguage)||in_array('1301',$arrlanguage)){
	$fubu=1;
  }else{
   $fubu=0;
  }
echo <<<EOT
-->
   <script>
      function valide(){
	      if({$langprivelage}){
            $('#column').attr('href','{$_M['url']['adminurl']}n=column&c=index&anyid=25');
	      }else{
	        alert("{$_M[word][js81]}");
	      }
      }

    function information(){
	    if({$inforprivelage}){
            $('#information').attr('href','{$_M['url']['adminurl']}n=webset&c=webset&a=doindex&anyid=57');
	      }else{
	        alert("{$_M[word][js81]}");
	      }
    }

     function fubu(){
	    if({$fubu}){
            $('#fubu').attr('href','{$_M['url']['adminurl']}n=content&c=content&a=doadd&anyid=68');
	      }else{
	        alert("{$_M[word][js81]}");
	      }
    }
   </script>
<!--
EOT;
require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M['url']['own_tem']}css/metinfo.css?{$jsrand}" />
<script>
var chartdata = '{$chartdata}';
var ownlangtxt = {"installations":"{$_M[word][installations]}"};
</script>
<!--[if lte IE 8]><script src="{$_M['url']['own_tem']}js/excanvas.js"></script><![endif]-->
<input id="met_automatic_upgrade" type="hidden" value="{$_M['config']['met_automatic_upgrade']}" />
<div class="index_box">
	<section class="index_point hidden-xs">
		<h3>{$_M['word']['new_guidelines']}
<!--
EOT;
if(!$_M['config']['met_agents_app_news']){
echo <<<EOT
-->
		<a href="http://help.metinfo.cn/" target="_blank" {$met_agents_display}>{$_M[word][help1]}<i class="fa fa-angle-right"></i></a>
<!--
EOT;
}
echo <<<EOT
-->
		</h3><div class="container-fluid">
		<ul>
			<li>
				<a href="" onclick='information()' id="information">
					<i class="fa fa-newspaper-o"></i>
					{$_M['word']['upfiletips7']}
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="" onclick='valide()' id="column">
					<i class="fa fa-sitemap"></i>
					{$_M['word']['configuration_section']}
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{$_M['url']['adminurl']}n=theme&c=theme&a=doindex&anyid=18" target="_blank">
					<i class="fa fa-tachometer"></i>
					{$_M['word']['debug_appearance']}
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="" onclick='fubu()' id="fubu">
					<i class="fa fa-plus"></i>
					{$_M['word']['publish_content']}
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<div class="bdsharebuttonbox"
					data-bdUrl="{$_M[config][met_weburl]}"
					data-bdText="{$_M['word']['sys_use']} MetInfo {$_M['word']['build_site']} {$_M[config][met_weburl]} {$_M['word']['everyone_see']}"
					data-bdPic="{$_M['url'][site]}templates/{$_M[config][met_skin_user]}/view.jpg"
					data-tag="share_1">
					<a href="#" class="bds_more" data-cmd="more">
						<i class="fa fa-share-alt"></i>{$_M['word']['share_mood']}
					</a>
				</div>
			</li>
		</ul>
	</section>
<!--
EOT;
if(!$_M['config']['met_agents_app_news']){
	if(($privilege['navigation'] == 'metinfo' || strstr($privilege['navigation'], '1507')) && $_M['config']['met_agents_app'] ) {
echo <<<EOT
-->
	<section class="index_hotapp index_hot">
		<h3>{$_M['word']['recommended_tems']}<a href="{$_M['url']['adminurl']}anyid=65&n=appstore&c=appstore&a=doappstore">{$_M['word']['more_applications']}<i class="fa fa-angle-right"></i></a>
		</h3>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="" width="80">
							</a>
						</div>
						<div class="media-body">
							<a href="#">
								<h4 class="media-heading"><span class="text-danger"></span></h4>
								<p></p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="" width="80">
							</a>
						</div>
						<div class="media-body">
							<a href="#">
								<h4 class="media-heading"><span class="text-danger"></span></h4>
								<p></p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="" width="80">
							</a>
						</div>
						<div class="media-body">
							<a href="#">
								<h4 class="media-heading"><span class="text-danger"></span></h4>
								<p></p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="" width="80">
							</a>
						</div>
						<div class="media-body">
							<a href="#">
								<h4 class="media-heading"><span class="text-danger"></span></h4>
								<p></p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="" width="80">
							</a>
						</div>
						<div class="media-body">
							<a href="#">
								<h4 class="media-heading"><span class="text-danger"></span></h4>
								<p></p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object" src="" width="80">
							</a>
						</div>
						<div class="media-body">
							<a href="#">
								<h4 class="media-heading"><span class="text-danger"></span></h4>
								<p></p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade in" id="adpath" tabindex="-1" data={$adflag} role="dialog" aria-labelledby="functionEncy" aria-hidden="false" style="display: none; padding-left: 17px;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                        <h4 class="modal-title" id="exampleModalLabel">{$_M[word][help2]}</h4>
                </div>
                <div class="modal-body">
                        <div class="remodal met_uplaod_remodal" data-remodal-id="modal" style="visibility: visible;text-align: center;padding;">
                            <div style="color: red;padding-bottom: 15px;">
                                {$_M[word][tips8_v6]}
                            </div>
                            <div class="temset_box" style="">
                                <div class="v52fmbx" >
                                    <dl class="noborder">
                                        <dd style="margin-left: 260px;align-content: center;">
                                            <input id="olupdate_type" name="olupdate_type" type="hidden" value="1">
                                            <button id='to_change' data="{$_M['url']['adminurl']}n=safe&c=index&a=doindex&anyid=12"  class="submit" style="max-width: 130px;display: inline-block;">{$_M[word][tochange]}</button>
                                            <div style="width:50px;display: inline-block;"></div>
                                            <button id='no_prompt' data="{$_M['url']['adminurl']}anyid=&n=index&c=index&a=do_no_prompt" class="submit" style="max-width: 130px;display: inline-block;">{$_M[word][nohint]}</button>

                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">{$_M[word][close]}</button>
                </div>
            </div>
        </div>
    </div>
<!--
EOT;
	}
	if ($_M['config']['met_agents_type'] < 2 && !$_M['config']['met_agents_app_news']) {
echo <<<EOT
-->
	<section class="index_news">
		<h3>MetInfo {$_M['word']['upfiletips37']}<a href="https://www.metinfo.cn/" target="_blank">{$_M['word']['columnmore']}<i class="fa fa-angle-right"></i></a></h3>
		<div id="newslist" data-newslisturl="https://www.metinfo.cn/metv5news.php?fromurl={$_M[config][met_weburl]}&action=json&listnum=6">
		</div>
	</section>
<!--
EOT;
	}
}
echo <<<EOT
-->
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>