<!--<?php
$met_flasharray[$classnow][type] = 0;
require_once template('head');
$met_mapcontents=str_replace(array("\r","\n","\t"),'',$met_mapcontents);
echo <<<EOT
-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=fYI33qTijqASUAGSYS1gc3GD"></script>
<!--百度地图-->
<style type="text/css">
#allmap {width: 100%;height: 500px;overflow: hidden;margin:0;}
</style>
	<div id="allmap" ></div>
<script type="text/javascript">
// 百度地图API功能
var mapopts = {
	enableMapClick:false
}
var map = new BMap.Map("allmap",mapopts);
map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_ZOOM}));
map.disableDoubleClickZoom();
var point = new BMap.Point({$met_maplng},{$met_maplat});
map.centerAndZoom(point, {$met_mapzoom});
var marker = new BMap.Marker(point);  // 创建标注
var offset=new BMap.Size(10,-20);
map.addOverlay(marker);

var opts = {
  //width : 200,     // 信息窗口宽度
  //height: 60,     // 信息窗口高度
  title : '<b>{$met_maptitle}</b>' , // 信息窗口标题
  enableMessage:false,//设置允许信息窗发送短息
  enableCloseOnClick:false,
  message:'{$met_maptitle}',
  offset:offset
}
var infoWindow = new BMap.InfoWindow('<div style="border-top:1px solid #999; margin:5px 0px 0px; padding-top:5px;">{$met_mapcontents}</div>', opts);  // 创建信息窗口对象
map.openInfoWindow(infoWindow,point); //开启信息窗口
function showInfo(e){
	map.openInfoWindow(infoWindow,point);
}
marker.addEventListener("click", showInfo);
</script>
<!--
EOT;
require_once template('foot');
?>