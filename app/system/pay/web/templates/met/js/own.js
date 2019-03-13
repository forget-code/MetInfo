/* global self */
define(function(require, exports, module) {
    var $ = jQuery = require('jquery');
    require('pub/bootstrap/js/bootstrap.min');
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    /* ajax 支付状态查询 跳转 */
    $(document).ready(function() {
        $out_trade_no = document.getElementById("out_trade_no").innerHTML;
        if($out_trade_no) {
            t = setInterval(function() {    
                $.ajax({
                    type: "POST",
                    url: "orderquery.php",
                    data: "paytype=1&out_trade_no="+$out_trade_no,
                    success: function(date){
                        if(date==="SUCCESS"){
                            /* alert('支付成功'); */
                            self.location.href='return.php?out_trade_no='+$out_trade_no;
                        }
                    }
                });
            }, 5000);  
        }  
    });
	
});