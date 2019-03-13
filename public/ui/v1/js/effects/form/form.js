define(function(require, exports, module) {
	var common = require('common');
	require('effects/include/jquery-migrate-1.2.1.min');
	var langtxt = common.langtxt();
	var err = new Array();
	err[1] = langtxt.formerror1;
	err[2] = langtxt.formerror2;
	err[3] = langtxt.formerror3;
	err[4] = langtxt.formerror4;
	err[5] = langtxt.formerror5;
	err[6] = langtxt.formerror6;
	err[7] = langtxt.formerror7;
	err[8] = langtxt.formerror8;
	err[9] = langtxt.js46;
	
	function defaultoption(box){
		function ckchuli(n,v){
			$("input[name='"+n+"'][value='"+v+"']").attr('checked',true);
		}
		var cklist = $("input[data-checked],select[data-checked]");
		if(box)cklist = box.find("input[data-checked],select[data-checked]");
		if(cklist.length>0){
			cklist.each(function(){
				var v = $(this).attr('data-checked'),n=$(this).attr('name'),t=$(this).attr('type');
				if(v!=''){
					if($(this)[0].tagName=='SELECT'){
						$(this).val(v);
					}
					if(t=='radio')ckchuli(n,v);
					if(t=='checkbox'){
						if(v.indexOf("|")==-1){
							ckchuli(n,v);
						}else{
							v = v.split("|");
							for (var i = 0; i < v.length; i++) {
								if(v[i]!=''){
									ckchuli(n,v[i]);
								}
							}
						}
					}
				}
			});
		}	
	}
	function trim(str) {
		return $.trim(str);
	}
	function ftn(m) {
		var f = '';
		m.each(function(i) {
			var d = $(this),
				e = '|*|',
				v = d.attr('data-size'),
				l = trim(d.val()),
				j = 0,
				t = d.attr('type');
			if (v) {
				v = v.split('-');
				if (v[1] == 'min') {
					if (l.length < v[0]) {
						j = 1;
						e += err[6] + '|$|'
					}
				} else if (v[1] == 'max') {
					if (l.length > v[0]) {
						j = 1;
						e += err[7] + '|$|'
					}
				} else {
					if (l.length < v[0] || l.length > v[1]) {
						j = 1;
						e += err[8] + '|$|'
					}
				}
			}
			if (d.attr('data-required')) {
				if (t == 'input' || t == 'text' || t == 'password' || d[0].tagName == 'TEXTAREA' || t == 'file') {
					if (l == '') {
						j = 1;
						e += err[1] + '|$|'
					}
				}
				if (d[0].tagName == 'SELECT') {
					if (l == '') {
						j = 1;
						e += err[2] + '|$|'
					}
				}
				if (t == 'radio') {
					if ($("input[name='" + d.attr('name') + "']:checked").length < 1) {
						j = 1;
						e += err[2] + '|$|'
					}
				}
			}
			if (t == 'checkbox') {
				if (d.parents('div.fbox').find("input").eq(0).attr('data-required')) {
					if (d.parents('div.fbox').find("input:checked").length < 1) {
						j = 1;
						e += err[2] + '|$|'
					}
				}
			}
			if (d.attr('data-mobile')) {
				if (l != '') {
					var regexp = /^1[0-9]{10}$/;
					if (!regexp.test(l)) {
						j = 1;
						e += err[3] + '|$|'
					}
				}
			}
			if (d.attr('data-email')) {
				if (l != '') {
					var regexp = /^[-a-zA-Z0-9_\.]+@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$/;
					if (!regexp.test(l)) {
						j = 1;
						e += err[4] + '|$|'
					}
				}
			}
			if (d.attr('data-custom')) {
				var rok = eval(d.attr('data-custom'));
				if (!rok) {
					j = 1;
					e += 'errortxt' + '|$|'
				}
			}
			if (d.attr("data-password")) {
				var p = $("input[name='" + d.attr("data-password") + "']");
				if ((l == '' && p.val() != '') || (l != '' && l != p.val())) {
					j = 1;
					e += err[5] + '|$|'
				}
			}
			if ($("input[data-password='" + d.attr("name") + "']").length > 0) {
				var p = $("input[data-password='" + d.attr("name") + "']").eq(0);
				fsut(p, 1)
			}
			if (d.attr('data-ajaxcheck-url')) {
				if (l != '') {
					$.ajax({
						type: "GET",
						async: false,
						url: d.attr('data-ajaxcheck-url') + '&' + d.attr('name') + '=' + l,
						success: function(msg) {
							var m = msg.split('|');
							var fa = Number(m[0]) == 0 ? '' : 'fa fa-check';
							if (fa == '') {
								j = 1;
								e += m[1] + '|$|'
							} else {
								zchuli(d, m[1], 0, fa)
							}
						}
					})
				}
			}
			if (d.attr('data-norepeat') && l != '') {
				var r = d.attr('data-norepeat');
				var dr = $("input[data-norepeat='" + r + "']");
				var q = 0;
				dr.each(function() {
					if ($(this).val() == l && $(this).attr('name') != d.attr('name')) q = 1
				});
				if (q == 1) {
					j = 1;
					e += err[9] + '|$|'
				}
			}
			if (j == 1) f += d.attr('name') + e + '|#|'
		});
		return f
	}
	function errtxt(d, fv) {
		var t;
		var f = fv.split("|$|");
		t = f[0];
		return t
	}
	function zchuli(d, txt, g, fa) {
		var o = d.parents('div.fbox'),
			fs = fa ? fa : 'fa fa-times';
		if (o.find(".formerror").length > 0) {
			o.find(".formerror").remove()
		}
		if (d.next(".formerror").length > 0) {
			d.next(".formerror").remove()
		}
		if (o.length > 0) {
			o.append("<div class='formerror'><i class='" + fs + "'></i>" + txt + "</div>")
		} else {
			d.after("<div class='formerror'><i class='" + fs + "'></i>" + txt + "</div>")
		}
		if (d[0].tagName == 'INPUT' || d[0].tagName == 'TEXTAREA') {
			d.addClass("formerrorbox");
			if (fs != 'fa fa-times') d.removeClass('formerrorbox')
		}
		if (g == 1) d.focus()
	}
	function chuli(f, t) {
		f = f.split("|#|");
		var n = '',
			d, txt;
		for (var i = 0; i < f.length; i++) {
			if (f[i] != '') {
				var fv = f[i].split("|*|");
				d = $("*[name='" + fv[0] + "']").eq(0);
				txt = d.attr("data-errortxt") ? d.attr("data-errortxt") : errtxt(d, fv[1]);
				if (txt.indexOf('&metinfo&') != -1 && d.attr("data-size")) {
					var x, v = d.attr("data-size").split('-');
					if (v[1] == 'min' || v[1] == 'max') {
						x = v[0]
					} else {
						x = d.attr("data-size")
					}
					txt = txt.replace("&metinfo&", x)
				}
				var g = 0;
				if (i == 0 && !t) g = 1;
				zchuli(d, txt, g)
			}
		}
	}
	function hfbc(d) {
		d.removeClass('formerrorbox');
		if (!d.attr('data-ajaxcheck-url')) {
			d.parents('div.fbox').find(".formerror").remove();
			if (d.next(".formerror").length > 0) {
				d.next(".formerror").remove()
			}
		}
		d.each(function() {
			var d = $(this),
				l = d.val(),
				t = d.attr('type');
			if (t == 'checkbox') {
				if ($("input[name='" + d.attr('name') + "']").length > 1) {
					var v = '',
						c = d.parents('div.fbox').find("input[name='" + d.attr('name') + "']:checked");
					var z = $("input[data-checkbox='" + d.attr('name') + "']");
					if (c.length == 0) {
						z.remove()
					} else {
						c.each(function(i) {
							v += (i + 1) == c.length ? $(this).val() : $(this).val() + '|'
						});
						if (z.length > 0) {
							z.val(v)
						} else {
							d.parents('div.fbox').append("<input name='" + d.attr('name') + "' data-checkbox='" + d.attr('name') + "' type='hidden' value='" + v + "' />")
						}
					}
				}
			}
		})
	}
	function fsut(d, t, l) {
		if (l) {
			var id = d.parents('form').find("input[name='id']");
			if (id.length > 0 && $(".ui-table").length > 0) {
				if (d.parents('form').find("input[name='allid']").length == 0) {
					d.parents('form').append('<input type="hidden" name="allid" value="" />')
				}
				var allid = $("input[name='allid']"),
					value = '';
				id.each(function() {
					if ($(this).attr("checked")) value += $(this).val() + ','
				});
				allid.val(value);
				if (allid.val() == '') {
					alert(langtxt.js23);
					var issubmit = $("select[data-isubmit='1']");
					if (issubmit.length > 0) {
						issubmit.val('')
					}
					return false
				}
			}
		}
		var f = ftn(d),
			r;
		if (f) {
			chuli(f, t);
			r = false
		} else {
			hfbc(d);
			r = true
		}
		if (!t) return r
	}
	var d = $('form.ui-from');
	defaultoption();
	$(document).on('submit', "form.ui-from", function() {
		return fsut($(this).find("input,textarea,select"), '', 1)
	});
	d.each(function() {
		var t = $(this);
		t.submit(function() {
			return fsut(t.find("input,textarea,select"), '', 1)
		});
		$(document).on('focusout', ".ui-from dd input,.ui-from dd textarea", function() {
			var c = $(this);
			if (c.parents('dd.ftype_day').length == 0) {
				if (!c.attr('type') || c.attr('type') != 'submit') {
					fsut(c, 1)
				}
			}
		});
		$(document).on('focusout', ".ui-from input[type='radio'],.ui-from input[type='checkbox']", function() {
			var d = $("input[name='" + $(this).attr('name') + "']").eq(0);
			fsut(d, 1)
		});
		$(document).on('change', ".ui-from input[type='radio'],.ui-from input[type='checkbox']", function() {
			var d = $("input[name='" + $(this).attr('name') + "']").eq(0);
			fsut(d, 1)
		});
		$(document).on('change', ".ui-from select", function() {
			var d = $(this);
			fsut(d, 1)
		})
	});
	$(document).on('click', "*[data-confirm]", function() {
		var txt = $(this).attr('data-confirm');
		return confirm(txt)
	});
	$(document).ready(function() {
		$(".submit").focus(function() {
			this.blur()
		}).mousedown(function() {
			$(this).addClass("active")
		}).mouseup(function() {
			$(this).removeClass("active")
		}).mouseleave(function() {
			$(this).removeClass("active")
		})
	});
	Array.prototype.unique = function() {
		var o = {};
		for (var i = 0, j = 0; i < this.length; ++i) {
			if (o[this[i]] === undefined) {
				o[this[i]] = j++
			}
		}
		this.length = 0;
		for (var key in o) {
			this[o[key]] = key
		}
		return this
	};
	var keys = [];
	$(document).keydown(function(event) {
		keys.push(event.keyCode);
		keys.unique()
	}).keyup(function(event) {
		if (keys.length > 2) keys = [];
		keys.push(event.keyCode);
		keys.unique();
		if (keys.join('') == '1713') {
			var input = $("input[type='submit']");
			if (input.length == 1) {
				if (!input.attr('disabled')) {
					input.click()
				}
			}
		}
		keys = []
	});

	$(document).on('keyup', ".ftype_code input[name='code']", function() {
		var v = $(this).val();
		v = v.toUpperCase();
		$(this).val(v)
	});
	$(document).on('focus', "input[type='text'],input[type='input'],input[type='password'],textarea", function() {
		$(this).addClass('met-focus')
	});
	$(document).on('focusout', "input[type='text'],input[type='input'],input[type='password'],textarea", function() {
		$(this).removeClass('met-focus')
	});
	var dlp = '';
	if ($.browser.msie || ($.browser.mozilla && $.browser.version == '11.0')) {
		var v = Number($.browser.version);
		if (v < 10) {
			function dlie(dl) {
				dl.each(function() {
					var dt = $(this).find("dt"),
						dd = $(this).find("dd");
					if (dt.length > 0) {
						dt.css({
							"float": "left",
							"overflow": "hidden"
						});
						dd.css({
							"float": "left",
							"overflow": "hidden"
						});
						var wd = $(this).width() - dt.outerWidth() - 17;
						dd.width(wd)
					}
				});
			}
			var dl = $(".v52fmbx dl");
			dlie(dl);
			dlp = 1
		}
		if (v < 12) {
			function searchzdx(dom, label, color1) {
				if (dom.val() == '') label.show();
				dom.keyup(function() {
					if ($(this).val() == '') {
						label.show()
					} else {
						label.hide()
					}
				});
				label.click(function() {
					$(this).next().focus()
				})
			}
			var pd = $("input[placeholder],textarea[placeholder]");
			pd.each(function() {
				var t = $(this).attr("placeholder");
				$(this).removeAttr("placeholder");
				$(this).wrap("<div class='placeholder-ie'></div>");
				$(this).before("<label>" + t + "</label>");
				searchzdx($(this), $(this).prev("label"), "#999")
			})
		}
	}
});