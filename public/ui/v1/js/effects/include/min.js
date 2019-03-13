define(function(require, exports, module) {
	var common = require('common');   			//全局库
	
	require('effects/font-awesome/css/font-awesome.min.css');
	if(met_mobile=='mobile'){
		require.async('effects/include/ini_mobile');
	}else{
		require.async('effects/include/ini');   			//系统功能
	}
	require('tem/js/own');			            //模板JS文件
});