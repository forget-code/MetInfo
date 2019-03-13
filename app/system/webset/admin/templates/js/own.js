define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var doa = getQueryString('a');

	if(doa=='doindex'){
		(function($){
			$.fn.artTxtCount = function(tipWrap, maxNumber){
				var count = function(){
					var val = $(this).val().length;
					tipWrap.html(val);
				};
				$(this).bind('keyup change', count);
				tipWrap.html($(this).val().length);
				return this;
			};
		})(jQuery);

		$("textarea[name='met_description']").artTxtCount($('.met_description_tips'), 10);
		
		$(document).ready(function() {
			var gent = $(".v52fmbx[data-gent]");
			if(gent.length>0 && gent.attr("data-gent")!=''){
				$.post(gent.attr("data-gent"));
			}
			var record = $(".v52fmbx[data-webset-record]");
			if(record.length>0 && record.attr("data-webset-record")!=''){
				$.post(record.attr("data-webset-record"));
			}
		});
	}
	
	if(doa=='doemailset'){
		$("a.morodllist").click(function(){
			var d = $("dl.morodllist");
			if(d.is(":hidden")){
				d.slideDown();
			}else{
				d.slideUp();
			}
			return false;
		});
		
		$("a.emailtest").click(function(){
			var langtxt = ownlangtxt;
			var d = $(this);
			d.next('span').html(langtxt.jsx18);
			$.ajax({
				url: d.attr('href'),
				type: "POST",
				data: $(".ui-from").serialize(),
				timeout: 30000,
				error: function(dom, text, errors) {
					if (text == 'timeout'){
						d.next('span').html(langtxt.jsx19);
					}
				},
				success: function(data) {
					d.next('span').html(data);
				}
			});
			return false;
		});
	}

});