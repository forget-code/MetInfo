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
define(function(require,exports,module){
	var common=require('common');
	function navfucn(d,m){
		if(d.is(":hidden")){
			$(".tem_head .tem_langlist:visible,.tem_head nav:visible").collapse('close');
			$(".tem_top i").removeClass('met_now');
			d.collapse('open');
			m.addClass('met_now');
		}else{
			d.collapse('close');
			m.removeClass('met_now');
		}
	}
	$(".tem_top i.am-icon-bars").on("click",function(){
		navfucn($(".tem_head nav"),$(this));
	});
	$(".tem_top i.am-icon-globe").on("click",function(){
		navfucn($(".tem_head .tem_langlist"),$(this));
	});
	
	$('.tem_banner').flexslider({directionNav: false});
	
	if ($(".tem_index_product").length > 0) {
		common.metHeight($(".tem_index_product ul li h2"));
	}
	
	if ($(".tem_index_news_slides").length > 0) {
		$('.tem_index_news_slides').flexslider({
			directionNav: false,
			controlNav: true,
			manualControls: $(".tem_index_news_tab li"),
			touch: false,
			slideshow: false,
			pauseOnHover: true
		})
	}
	
	$('.tem_index_case_list').flexslider({
		directionNav: false
	})
});