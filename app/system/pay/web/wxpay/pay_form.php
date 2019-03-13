<form class="form-horizontal col-sm-8" action="<?php echo $action ?>" method="POST" target="_blank">
    <div class="h4 text-left"><strong>订单支付页面-Demo</strong></div>
    <!-- 商户订单号 -->
    <div class="form-group">
        <label class="col-sm-6 control-label">商户订单号</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $date["out_trade_no"] ?></p>
        </div>
    </div>
    <!-- 商品描述 -->
    <div class="form-group">
        <label class="col-sm-6 control-label">商品描述</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $date["body"] ?></p>
        </div>
    </div>
    <!-- 商品ID -->
    <div class="form-group">
        <label class="col-sm-6 control-label">商品ID</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $date["product_id"] ?></p>
        </div>
    </div>
    <!-- 商品标记 -->
    <div class="form-group">
        <label class="col-sm-6 control-label">商品标记</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $date["goods_tag"] ?></p>
        </div>
    </div>
    <!-- 附加数据 -->
    <div class="form-group">
        <label class="col-sm-6 control-label">附加数据</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $date["attach"] ?></p>
        </div>
    </div>
    <!-- 总金额 -->
    <div class="form-group">
        <label class="col-sm-6 control-label">总金额</label>
        <div class="col-sm-6">
            <p class="form-control-static">￥<?php echo $date["total_fee"]/=100 ?>元</p>
        </div>
    </div>
    <!-- 支付类型 -->
    <div class="form-group">
        <label class="col-sm-6 control-label">支付订单</label>
        <div class="col-sm-6">
            <?php echo $img_html ?>
        </div>
    </div>
    
    <!-- 确认支付 -->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <button type="submit" class="btn btn-info">支付完成</button>
        </div>
    </div>
</form>