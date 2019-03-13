<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
if($_M['form']['a']!='dofunction_ency'){
echo <<<EOT
-->
<div class="modal fade" id="functionEncy" tabindex="-1" role="dialog" aria-labelledby="functionEncy">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">{$_M[word][funcCollection]}</h4>
            </div>
            <div class="modal-body">
<!--
EOT;
}
echo <<<EOT
-->
                <div class="list-group clearfix">
                    <a href="#" class="list-group-item disabled">{$_M[word][websiteSet]}</a>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=manage&c=index&a=doindex&anyid=29&lang={$_M[lang]}" class="center-block">{$_M[word][indexcontent]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=column&c=index&a=doindex&anyid=25&lang={$_M[lang]}" class="center-block">{$_M[word][columumanage]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=29&n=manage&c=index&&a=domodule" class="center-block">{$_M[word][systemModule]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=theme&c=theme&a=doindex&anyid=18&lang={$_M[lang]}" target="_blank" class="center-block">{$_M[word][appearanceSetting]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=webset&c=webset&a=doindex&anyid=57&lang={$_M[lang]}" class="center-block">{$_M[word][basicInfoSet]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=language&c=language_admin&a=doindex&anyid=10&lang={$_M[lang]}" class="center-block">{$_M[word][multilingual]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=57&n=webset&c=webset&&a=doemailset" class="center-block">{$_M[word][mailSetting]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=57&n=webset&c=webset&&a=dothirdparty" class="center-block">{$_M[word][thirdCode]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=11&n=imgmanager&c=imgmanager&&a=dowatermark" class="center-block">{$_M[word][watermarkThumbnail]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=online&c=online&a=doindex&anyid=71&lang={$_M[lang]}" class="center-block">{$_M[word][customerService]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=banner&c=banner_admin&a=domanage&anyid=18&lang={$_M[lang]}" class="center-block">{$_M[word][indexflash]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang=cn&n=recycle&c=recycle&a=doindex" class="center-block">{$_M[word][recycleBin]}</a>
                    </div>
                </div>
                <div class="list-group clearfix">
                    <a href="#" class="list-group-item disabled">{$_M[word][securityTools]}</a>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=update&c=about&a=doindex&anyid=75&lang={$_M[lang]}" class="center-block">{$_M[word][checkupdate]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=safe&c=index&a=doindex&anyid=12&lang={$_M[lang]}" class="center-block">{$_M[word][safety_efficiency]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=databack&c=index&a=doindex&anyid=13&lang={$_M[lang]}" class="center-block">{$_M[word][updaterr4]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang=tc&anyid=13&n=databack&c=index&a=dorecovery" class="center-block">{$_M[word][dataRecovery]}</a>
                    </div>
                </div>
                <div class="list-group clearfix">
                    <a href="#" class="list-group-item disabled">{$_M[word][searchEngineOptimization]}</a>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=37&n=seo&c=seo&&a=doindex" class="center-block">{$_M[word][seoSetting]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=37&n=seo&c=seo&&a=dourl" class="center-block">{$_M[word][pseudostatic]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=&n=html&c=html&&a=doset" class="center-block">{$_M[word][indexhtmset]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=37&n=seo&c=seo&&a=doanchor" class="center-block">{$_M[word][anchor_text]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=37&n=seo&c=seo&&a=dositemap" class="center-block">{$_M[word][htmsitemap]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href=" index.php?n=link&c=link_admin&a=doindex&anyid=39&lang={$_M[lang]}" class="center-block">{$_M[word][indexlink]}</a>
                    </div>
                </div>
                <div class="list-group clearfix">
                    <a href="#" class="list-group-item disabled">{$_M[word][indexuser]}</a>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=73&n=user&c=admin_user&a=doindex" class="center-block">{$_M[word][memberist]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=73&n=user&c=admin_set&a=doindex" class="center-block">{$_M[word][memberfunc]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&anyid=73&n=user&c=admin_set&a=doopen" class="center-block">{$_M[word][thirdPartyLogin]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=admin&c=admin_admin&a=doindex&anyid=47&lang={$_M[lang]}" class="center-block">{$_M[word][metadmin]}</a>
                    </div>
                </div>
                <div class="list-group clearfix">
                    <a href="#" class="list-group-item disabled">{$_M[word][appAndPlugin]}</a>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=appstore&c=appstore&a=doindex&anyid=65&lang={$_M[lang]}" class="center-block">{$_M[word][metShop]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=myapp&c=myapp&&a=doindex&anyid=44&lang={$_M[lang]}" class="center-block">{$_M[word][myapp]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?lang={$_M[lang]}&&n=system&c=authcode&a=doindex" class="center-block">{$_M[word][commercialAuthorizationCode]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="https://www.metinfo.cn/bangzhu/index.php?ver=metinfo" target="_blank" class="center-block">{$_M[word][indexbbs]}</a>
                    </div>
                </div>
                <div class="list-group clearfix">
                    <a href="#" class="list-group-item disabled">{$_M[word][systips13]}</a>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="app/wap/wap.php?anyid=77&lang={$_M[lang]}" class="center-block">{$_M[word][mobileSetting]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="index.php?n=theme&c=theme&a=doindex&mobile=1&anyid=70&lang={$_M[lang]}" target="_blank"  class="center-block">{$_M[word][mobileVersion]}</a>
                    </div>
                    <div class="col-xs-4 col-sm-3 col-md-2 list-group-item text-center">
                        <a href="app/stat/index.php?anyid=34&lang={$_M[lang]}" class="center-block">{$_M[word][indexwebcount]}</a>
                    </div>
                </div>
<!--
EOT;
if($_M['form']['a']!='dofunction_ency'){
echo <<<EOT
-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{$_M[word][close]}</button>
            </div>
        </div>
    </div>
</div>
<!--
EOT;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>