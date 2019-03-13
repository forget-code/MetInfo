define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	$('.send_email').click(function(){
		var li = $(this).parent("li");
		li.addClass("loading");
		$.ajax({
		   type: "POST",
		   url: $(this).attr("href"),
		   success: function(msg){
				require.async('pub/bootstrap/modal/alert',function(event){
					event.malert(msg);
					li.removeClass("loading");
				});
		   }
		});
		return false;
	});
		
});