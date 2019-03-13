<?php defined('IN_MET') or exit('No permission'); ?>
<if value="$c['shopv2_open']">
<div class="shop-product-intro grey-500">
    <div class="p-20 bg-grey-100 red-600 price">
        <span class='font-size-18'>{$c.shopv2_price_str_prefix}</span> <span id="price" class="font-size-30">{$data.price_str_number_format}</span>
        <if value="$data['original']">
        <del class='m-l-20'>{$word.app_shop_original}{$data.original_str}</del>
        </if>
    </div>
    <div class="shoppro-discount row" hidden>
        <label class='col-sm-2'>{$word.app_shop_discount}</label>
        <div class='shoppro-discount-body col-sm-10'>
            <div class='shoppro-discount-list inline-block' data-state='0'></div>
            <div class='shoppro-discount-list inline-block' data-state='1'></div>
            <a href="{$url.shop_discount}#state_1" target='_blank' class="btn btn-default btn-outline btn-xs">{$word.app_shop_morediscount}</a>
        </div>
    </div>
    <div class="modal modal-fade-in-scale-up modal-danger" id="discount-received-modal" aria-hidden="true" aria-labelledby="discount-received-modal" role="dialog" tabindex="-1">
        <button type="button" class="close font-size-40" style='position:fixed;top: 0;right: 20px;' data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="modal-dialog modal-center modal-sm">
            <div class="modal-content">
                <div class="pricing-list border-none text-xs-left m-b-0">
                    <div class="pricing-header">
                        <div class="pricing-title p-x-30 p-t-30 p-b-0 font-size-20 font-weight-300"></div>
                        <div class="pricing-price p-y-10 p-x-30 font-size-50 font-weight-300">
                            <span class="pricing-currency font-size-30">{$c.shopv2_price_str_prefix}</span>
                            <span class="pricing-amount"></span>
                        </div>
                        <div class="pricing-tips p-x-30 p-b-30">
                            <p class="m-b-0 pricing-par">{$word.app_shop_order}{$word.app_shop_order_achieve} {$c.shopv2_price_str_prefix}<strong class='font-size-16'></strong> {$word.app_shop_canuser}</p>
                            <p class="m-b-0 pricing-time">{$word.app_shop_period_validity}：<span></span></p>
                            <p class="m-b-0 pricing-inst">{$word.app_shop_instructions}：<span></span></p>
                        </div>
                    </div>
                    <div class="pricing-footer p-30 text-xs-center bg-blue-grey-100">
                        <a class="btn btn-lg btn-squared ladda-button" href='javascript:;' data-id="" data-timeout='200' data-style="slide-right" data-plugin="ladda">
                            <span class="ladda-label"><i class="icon wb-arrow-right" aria-hidden="true"></i><font class='btn-text'></font></span>
                        </a>
                    </div>
                </div>
                <div class='discount-received-success p-x-20 p-y-30 bg-white' style='display:none;'>
                    <div class="row m-0">
                        <i class="icon pe-cash pull-xs-left font-size-60" aria-hidden="true"></i>
                        <div class='row pull-xs-left m-l-20 m-r-50'>
                            <h4 class="media-heading font-size-16"></h4>
                            <p class="font-size-20 green-800 m-b-0">{$word.app_shop_receiveok}</p>
                        </div>
                    </div>
                    <div class="m-t-20 discount-received-success-btn">
                        <a class="btn btn-default btn-squared font-size-16" href="{$url.shop_discount}#state_1">{$word.app_shop_morediscount}</a>
                        <a class="btn btn-danger btn-squared m-l-10 font-size-16 btn-use" href='javascript:;'>{$word.app_shop_immediate_use}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <if value="$data['paralist']">
    <div class="shop-product-para">
        <list data="$data['paralist']" name="$p">
        <div class="row m-t-15">
            <label class='form-control-label col-sm-2'>{$p.value}</label>
            <div class="selectpara-list col-sm-10">
                <?php foreach ($p['valuelist'] as $value) {?>
                <a href="javascript:;" title='{$value}' data-val="{$value}" class="selectpara text-truncate btn btn-squared btn-outline btn-default m-r-10{$para_class}">{$value}</a>
                 <?php } ?>
            </div>
        </div>
        </list>
    </div>
    </if>
    <div class="row m-t-15">
        <label class='form-control-label col-sm-2'>{$word.app_shop_number}</label>
        <div class="col-sm-10">
            <div class="w-150 inline-block m-r-10">
                <input type="text" class="form-control text-xs-center" data-min="{$data.shopmin}" data-max="{$data.shopmax}" data-plugin="touchSpin" name="buynum" id="buynum" autocomplete="off" value="{$data.shopmin}">
            </div>
            <if value="$data['stock_show'] || $data['purchase']">
            <div class='m-t-5 stock-purchase'>
                <if value="$data['stock_show']">
                <div class='inline-block m-r-10'>{$word.app_shop_stock} <span id='stock-num' data-stock='{$data.stock}'>{$data.stock}</span> {$word.app_shop_piece}</div>
                </if>
                <if value="$data['purchase']">
                <span class="tag tag-round tag-default m-r-10">{$word.app_shop_purchase}{$data.purchase}{$word.app_shop_piece}</span>
                </if>
            </div>
            </if>
        </div>
    </div>
    <div class="m-t-20 clearfix cart-favorite">
        <a href="{$data.favorite_href}" data-pid='{$data.pid}' class='btn btn-squared btn-lg
        <if value="$data['is_favorite']">
        btn-success
        <else/>
        btn-warning
        </if>
        pull-sm-right product-favorite'>
            <i class="icon
            <if value="$data['is_favorite']">
            fa-heart
            <else/>
            fa-heart-o
            </if>
            m-r-5"></i>
            <span>
            <if value="$data['is_favorite']">
            {$word.app_shop_favorited}
            <else/>
            {$word.app_shop_favorite_add}
            </if>
            </span>
        </a>
        <a href="{$url.shop_tocart}&pid={$data.pid}" data-pid='{$data.pid}' class="btn btn-lg btn-squared btn-danger m-r-20 text-md product-tocart"><i class="icon fa-cart-plus m-r-5 font-size-20" aria-hidden="true"></i>{$word.app_shop_tocart}</a>
    </div>
</div>
<script>
var stockjson = {$data.stockjson},
    discount_json_url = '{$url.shop_discount_my}',
    discount_listjson_url = '{$url.shop_discount}&a=dodiscount_list',
    discount_receive_url = '{$url.shop_discount_receive}';
</script>
</if>