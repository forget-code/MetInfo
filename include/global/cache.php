<?php
	if(!$cache_column){
		$query="select * from $met_column where lang='$lang' order by no_order";
		if($met_member_use==2)$query="select * from $met_column where lang='$lang' and access<=$metinfo_member_type order by no_order";
		$result= $db->query($query);
		while($list = $db->fetch_array($result)){
			$cache_column[]=$list;
		}
		cache_page('column_'.$lang.'.php',$cache_column);
	}
	$cache_online = met_cache('online_'.$lang.'.php');
?>