<?php defined('IN_MET') or exit('No permission'); ?>
<div class="met-footnav p-y-20 border-top1">
    <div class="container">
        <ul class="blocks-2 blocks-sm-3 blocks-md-4 blocks-lg-5 blocks-xl-6 text-xs-center">
            <tag action='category' type='foot'>
            <if value="$m['_index'] lt 6">
            <li class="list m-y-5">
                <h4 class='m-0 font-size-16'><a href="{$m.url}" {$m.new_windows} title="{$m.name}">{$m.name}</a></h4>
            </li>
            </if>
            </tag>
        </ul>
    </div>
</div>
<footer class='p-y-20 border-top1'>
    <div class="container text-xs-center">
        <if value="$c['met_footright'] || $c['met_footstat']">
        <div>{$c.met_footright}</div>
        </if>
        <if value="$c['met_footaddress']">
        <div>{$c.met_footaddress}</div>
        </if>
        <if value="$c['met_foottel']">
        <div>{$c.met_foottel}</div>
        </if>
        <if value="$c['met_footother']">
        <div>{$c.met_footother}</div>
        </if>
    </div>
</footer>
<button type="button" class="btn btn-icon btn-primary btn-squared met-scroll-top" hidden><i class="icon wb-chevron-up" aria-hidden="true"></i></button>
<script>
var MET=[];
MET['url']=[];
MET['langtxt'] = {
    "jsx15":"{$_M['word']['jsx15']}",
    "js35":"{$_M['word']['js35']}",
    "jsx17":"{$_M['word']['jsx17']}",
    "formerror1":"{$_M['word']['formerror1']}",
    "formerror2":"{$_M['word']['formerror2']}",
    "formerror3":"{$_M['word']['formerror3']}",
    "formerror4":"{$_M['word']['formerror4']}",
    "formerror5":"{$_M['word']['formerror5']}",
    "formerror6":"{$_M['word']['formerror6']}",
    "formerror7":"{$_M['word']['formerror7']}",
    "formerror8":"{$_M['word']['formerror8']}",
    "js46":"{$_M['word']['js46']}",
    "js23":"{$_M['word']['js23']}",
    "checkupdatetips":"{$_M['word']['checkupdatetips']}",
    "detection":"{$_M['word']['detection']}",
    "try_again":"{$_M['word']['try_again']}",
    "fileOK":"{$_M['word']['fileOK']}",
};
MET['met_editor']="{$_M['config']['met_editor']}";
MET['met_keywords']="{$_M['config']['met_keywords']}";
MET['url']['ui']="{$_M['url']['ui']}";
MET['url']['own']="{$_M['url']['own']}";
MET['url']['own_tem']="{$_M['url']['own_tem']}";
MET['url']['api']="{$_M['url']['api']}";
</script>
<met_foot />
<if value="!$c['shopv2_open']">
<?php $app_js_time = filemtime(PATH_WEB.'public/ui/v2/static/js/app.js'); ?>
<script src="{$_M['url']['site']}public/ui/v2/static/js/app.js?{$app_js_time}"></script>
</if>
<?php if(file_exists(PATH_OWN_FILE."templates/met/js/own.js") && !((M_NAME=='product' || M_NAME=='shop') && $_M['config']['shopv2_open'])){
    $own_js_time = filemtime(PATH_OWN_FILE.'templates/met/js/own.js');
?>
<script src="{$_M['url']['own_tem']}js/own.js?{$own_js_time}"></script><?php } ?>