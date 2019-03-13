define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	var metcst=document.querySelector('meta[name="generator"]').getAttribute('data-variable'),
		DataStr=metcst.split("|"),
		met_weburl=DataStr[0],
		lang=DataStr[1],
		classnow=parseInt(DataStr[2]),
		id=parseInt(DataStr[3]),
		met_module=parseInt(DataStr[4]),
		met_skin_user=DataStr[5];
		
		window.met_weburl 		= met_weburl;	//��ַ
		window.lang 			= lang;	 		//����
		window.classnow		    = classnow;		//��ǰ��ĿID
		window.id 				= id;			//��ǰҳ��ID
		window.met_module 		= met_module;	//����ģ��
		window.met_skin_user 	= met_skin_user;//����ģ��
	
	/*��������*/
	var StranBody = $(".StranBody");        	
	if(StranBody.length>0){
		require.async('pub/weboverall/ch/ch');
	}
	
	/*���߽��� - վ��ͳ�� */
	var url=met_weburl+'include/interface/uidata.php?lang='+lang,h = window.location.href;
	if(h.indexOf("preview=1")!=-1)url = url + '&theme_preview=1';
	$.ajax({
		type: "POST",
		url: url,
		dataType:"json",
		success: function(msg){
			var c = msg.config;
			if(c.met_online_type!=3){	  //���߽���
				require.async('pub/weboverall/online/online');
			}
			if(c.met_stat==1){			  //վ��ͳ��
				var navurl=classnow==10001?'':'../';
				var	stat_d=classnow+'-'+id+'-'+lang;
				var	url = met_weburl+'include/stat/stat.php?type=para&u='+navurl+'&d='+stat_d;
				$.getScript(url);
			}
		}
	});
	
});