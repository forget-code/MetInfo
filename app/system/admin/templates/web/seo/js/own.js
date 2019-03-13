define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');

	$(document).ready(function() {
		var gent = $(".v52fmbx[data-gent]");
		if(gent.length>0 && gent.attr("data-gent")!=''){
			var langtxt = ownlangtxt;
			$('.returnover').html(langtxt.being_generated+"SiteMap...");
			var sti = setInterval(function(){ $('.returnover').show(); }, "300"); 
			$.post(gent.attr("data-gent"), function(data){
				$('.returnover').html("SiteMap"+langtxt.physicalgenok);
				clearInterval(sti);
				setTimeout(function(){ $('.returnover').hide(); }, 5000 );
			});
		}
	});

});