/*
����SeaJSģ�黯�ܹ������ļ�Ϊ���ģ�顣
require        |��������JS��CSS�ļ�,����������·��"tem"(��ǰģ��Ŀ¼·��)
-------------------------------
��Ĭ������Jquery 1.11.1
-------------------------------
����ȫ�ֱ�����
met_weburl     |��վ��ַ
lang           |��ǰ����
classnow       |��ǰҳ��������ĿID
id             |��ǰҳ��ID��������ҳ�У�
met_module     |��ǰҳ������ģ��
met_skin_user  |��ǰ����ģ��Ŀ¼����
MetpageType    |ҳ��λ�ã�1Ϊ��ҳ��2Ϊ�б�ҳ��3Ϊ����ҳ
-------------------------------
var common = require('common'); //���ÿ⣬���غ��֧��JQuery�Լ�һЩ����
common.listpun(����Ԫ��,�б�Ԫ��,��С���);//����Ӧ�Ű�
common.metHeight(Ԫ��);//�ȸ�
*/
define(function(require, exports, module) {
	var common = require('common');
	if ($(".tem_top_nav dl").length > 0) {
		var times;
		$(".tem_top_nav dl").hover(function() {
			var dl = $(this),
				dd = $(this).find("dd");
			if (dd.is(":hidden")) {
				times = setTimeout(function() {
					dd.show()
				}, 300)
			}
		}, function() {
			clearTimeout(times);
			$(this).find("dd").hide()
		})
	}
	var timesnav;
	$(".tem_head nav li").hover(function() {
		var li = $(this),
			dl = $(this).find("dl");
		if (dl.length > 0) {
			clearTimeout(timesnav);
			if (dl.is(":hidden")) {
				$(".tem_head nav li dl").hide();
				dl.show();
				if (dl.attr("data-postinok") == null) {
					if (dl.find("dt").length == 0) {
						if (li.find('dl dd h3').length > 0) {
							dl.addClass('tem_pronoaw');
							$('.tem_head nav ul li dl.tem_pronoaw').width(function() {
								var rt = $(this).find('dd h3').length * 140;
								return rt > $(".tem_head").width() ? $(".tem_head").width() : rt
							})
						} else {
							li.find('dl').css("width","auto");
							li.find('dl').css("white-space","nowrap");
							li.find('dl dd').css("width","auto");
							li.find('dl dd').css("min-width","100px");
							li.find('dl').css("min-width","100px");
						}
					}
					li.find("dl dd i").css('left', (li.width() / 2 - 6) + 'px');
					var a = dl.offset().left - $(".tem_head").offset().left,
						b = dl.outerWidth(),
						z = $(".tem_head").outerWidth();
					if (a + b > z) {
						var py = b - (z - a);
						dl.css({
							'left': -(py) + 'px'
						});
						li.find("dl dd i").css('left', py + (li.width() / 2 - 6) + 'px')
					}
					dl.attr("data-postinok", 1)
				}
			}
		}
	}, function() {
		var dl = $(this).find("dl");
		timesnav = setTimeout(function() {
			dl.hide()
		}, 300)
	});
	if ($('.tem_banner .flash').length == 0 && $('.tem_banner li').length > 0) {
	
		require.async('tem/js/flexslider/flexslider.css');
		require.async('tem/js/flexslider/jquery.flexslider', function() {
			$('.tem_banner').flexslider({
				animation: "slide",
				directionNav: false,
				controlNav: true,
				touch: true,
				pauseOnHover: true
			})
		})
	}
	if ($(".tem_banner li").length == 0 && $('.tem_banner .flash').length == 0) {
		$("header").addClass('tem_headborder')
	}
	if (MetpageType == 1) {
		var waypointsok = $("header[data-waypointsok]").attr("data-waypointsok");
		$(document).ready(function() {
			$('.tem_wp2,.tem_wp4').css({
				'animation-delay': function() {
					return $(this).index() * 0.3 + 's'
				},
				'-webkit-animation-delay': function() {
					return $(this).index() * 0.3 + 's'
				}
			});
			if(waypointsok==1){
				require.async('tem/js/waypoints/animate.css');
				require.async('tem/js/waypoints/waypoints.min', function() {
					$('.tem_wp1').waypoint(function() {
						$('.tem_wp1').addClass('animated fadeInLeft')
					}, {
						offset: '75%'
					});
					$('.tem_wp2').waypoint(function() {
						$('.tem_wp2').addClass('animated fadeInUp')
					}, {
						offset: '75%'
					});
					$('.tem_wp3').waypoint(function() {
						$('.tem_wp3').addClass('animated fadeInRight')
					}, {
						offset: '70%'
					});
					$('.tem_wp4').waypoint(function() {
						$('.tem_wp4').addClass('animated fadeInDown')
					}, {
						offset: '75%'
					})
				})
			}
		});
		if ($(".tem_index_about").length > 0) {
			var times2;
			$(".tem_index_about_img ol li").hover(function() {
				var m = $(this);
				times2 = setTimeout(function() {
					$(".tem_index_about_img ul li").hide();
					$(".tem_index_about_img ol li").removeClass("tem_now");
					$(".tem_index_about_img ul li").eq(m.index()).show();
					m.addClass("tem_now")
				}, 300)
			}, function() {
				clearTimeout(times2)
			})
		}
		if ($(".tem_index_product").length > 0) {
			var minwidth = parseInt($('.tem_index_product ul').attr("data-product_x")) + 20;
			$(".tem_index_product ul li a").width($('.tem_index_product ul').attr("data-product_x"));
			common.listpun($(".tem_index_product ul"), $(".tem_index_product ul li"), minwidth)
			common.metHeight($(".tem_index_product ul li h2"))
		}
		var tem_news = $(".tem_index_news"),
			tem_case = $(".tem_index_case");
		if (tem_case.length > 0 || tem_news.length > 0) {
			require.async('tem/js/flexslider/flexslider.css');
			require.async('tem/js/flexslider/jquery.flexslider', function() {
				if (tem_news.length > 0) {
					$('.tem_index_news_slides').flexslider({
						animation: "slide",
						selector: ".slides > ul",
						directionNav: false,
						controlNav: true,
						manualControls: $(".tem_index_news_tab li"),
						touch: true,
						slideshow: false,
						pauseOnHover: true,
						start: function() {
							if(waypointsok==1){
								require.async('tem/js/waypoints/waypoints.min', function() {
									$.waypoints('refresh')
								})
							}
						}
					})
				}
				if (tem_case.length > 0) {
					var img = $('.tem_index_case_list .tem_list dt img');
					$('.tem_index_case_list .tem_list dt a').css({
						"width": img.attr('width'),
						"height": img.attr('height')
					});
					$('.tem_index_case_list .tem_list dd h3').css({
						"width": img.attr('width')
					});
					$('.tem_index_case_list').flexslider({
						animation: "slide",
						directionNav: false,
						controlNav: true,
						touch: true,
						pauseOnHover: true,
						start: function() {
							if(waypointsok==1){
								require.async('tem/js/waypoints/waypoints.min', function() {
									$.waypoints('refresh')
								})
							}
						}
					})
				}
			})
		}
	}
});