<?php
global $navurl,$is_shopv3,$metresclass,$nav_list,$navfoot_list,$nav_list2,$nav_list3,$class_list,$class1_list,$class2_list,$class3_list,$classphp;
// 友情链接模块不显示
if($class_list[$class1]['module']==9){
	echo '-->'.'非常抱歉！友情链接栏目无实际用途，本模板废除该模块。';
	die();
}
// 自定义方法类
class MetResClass{
    public function __construct() {
        global $_M,$navurl,$is_shopv3,$nav_list,$navfoot_list,$nav_list2,$nav_list3,$class_list,$class1_list,$class2_list,$class3_list,$classphp,$class1,$class2,$class3,$class1_info;
        $_M['url']['static'] = $_M['url']['static']?$_M['url']['static']:$_M['url']['sta'];
        if(!isset($navurl)){
            // 网站首页相对当前页面的路径
            $navurl='../';
            // 栏目绝对路径转相对路径
            // $nav_list=$this->strReplace($_M['url']['site'],$navurl,$nav_list);
            // $navfoot_list=$this->strReplace($_M['url']['site'],$navurl,$navfoot_list);
            // $nav_list2=$this->strReplace($_M['url']['site'],$navurl,$nav_list2);
            // $nav_list3=$this->strReplace($_M['url']['site'],$navurl,$nav_list3);
            // $class_list=$this->strReplace($_M['url']['site'],$navurl,$class_list);
            // $class1_list=$this->strReplace($_M['url']['site'],$navurl,$class1_list);
            // $class2_list=$this->strReplace($_M['url']['site'],$navurl,$class2_list);
            // $class3_list=$this->strReplace($_M['url']['site'],$navurl,$class3_list);
        }
        $is_shopv3=isset($_M['config']['shopv2_logistics_open']);// 商城v3版本判断
        // 翻页、搜索的栏目id（当前栏目模块与一级栏目模块不一致时，翻页、搜索的栏目id改变）
        // if($class_list[$classnow]['module']==$class1_info['module']){
        //     $classphp['class1']=$class1;
        //     $classphp['class2']=$class2;
        //     $classphp['class3']=$class3;
        // }else {
        //     $classphp['class1']=$class2;
        //     $classphp['class2']=$class3;
        // }
    }
	// 内容中图片路径lazyload预处理
	public function lazyload($str){
		$str = preg_replace_callback('/(<img[^>]*)src(=[^>]*>)/', function($match){
            return $match['1']."data-original".$match['2'];
        }, $str);
		return $str;
	}
	/**
     * formSwitch 表单html转换
     * @param  array $data     表单数据
     * @param  Boolean $simplify 表单html是否需要转化成新UI
     * @return array $list     转换后的表单数据
     */
	public function formSwitch($data,$simplify){
		global $paravalue,$lang_Empty,$class_list,$class1;
		$type = $class_list[$class1]['module'] == 6?true:false;
		foreach($data as $key=>$val){
			if($val['type_class']!='ftype_input ftype_code'){
				$val['dataname'] = $type?$val['para']:"para{$val['id']}";
                if($val['description']) $val['des']=$val['description'];
				$val['placeholder'] = $val['name'];
				$val['simplify'] = 0;
				$val['type_html'] = '';
				if($simplify&&$val['type']<4){
					$val['simplify'] = 1;
					if($val['des']) $val['placeholder']= $val['des'];
				}
				$wr_ok = $val['wr_ok']?"required data-fv-message=\"{$lang_Empty}\"":'';
				switch($val['type']){
					case 1:
						$val['type_html']="<input name='{$val['dataname']}' class='form-control' type='text' placeholder='{$val['placeholder']}' {$wr_ok} />";
					break;
					case 2:
						$val['type_html'] ="<select name='{$val['dataname']}' class='form-control' {$wr_ok}>";
						$val['type_html'].="<option value=''>{$val['name']}</option>";
						foreach($paravalue[$val['id']] as $key=>$pv){
							$val['type_html'].="<option value='{$pv['info']}'>{$pv['info']}</option>";
						}
						$val['type_html'].="</select>";
					break;
					case 3:
						$val['type_html']="<textarea name='{$val['dataname']}' class='form-control' {$wr_ok} placeholder='{$val['placeholder']}' rows='5'></textarea>";
					break;
					case 4:
						$i=0;
						foreach($paravalue[$val['id']] as $key=>$pv){
							$i++;
							$val['type_html'].="
								<div class=\"checkbox-custom checkbox-primary\">
									<input
										name='para{$val['id']}_{$i}'
										type=\"checkbox\"
										value='{$pv['info']}'
										id=\"para{$val['id']}_{$i}\"
									>
									<label for=\"para{$val['id']}_{$i}\">{$pv['info']}</label>
								</div>";
						}
						if($val['des']) $val['type_html'].="<span class=\"text-help\">{$val['des']}</span>";
					break;
					case 5:
						$val['type_html']="
						<div class='input-group input-group-file'>
							<span class='input-group-btn'>
								<span class='btn btn-primary btn-file'>
									<i class='icon wb-upload' aria-hidden='true'></i>
									<input type='file' name='{$val['dataname']}' {$wr_ok} multiple=''>
								</span>
		                    </span>
		                    <input type='text' class='form-control' readonly='' placeholder='{$val['placeholder']}'>
	                  	</div>";
					break;
					case 6:
						$i=0;
						foreach($paravalue[$val['id']] as $pv){
							$i++;
							$checked=$i==1?'checked':'';
							$val['type_html'].="
								<div class=\"radio-custom radio-primary\">
									<input
										name='para{$val['id']}'
										type=\"radio\"
										{$checked}
										value='{$pv['info']}'
										id=\"para{$val['id']}_{$i}\"
									>
									<label for=\"para{$val['id']}_{$i}\">{$pv['info']}</label>
								</div>";
						}
						if($val['des']) $val['type_html'].="<span class=\"text-help\">{$val['des']}</span>";
					break;
				}
				$list[] = $val;
			}
		}
		return $list;
	}
	/**
     * flagSwitch 语言包名称转国旗图标名称
     * @param  String $synchronous 语言包名称
     * @return String $flag  国旗图标名称
     */
	public function flagSwitch($synchronous){
		switch($synchronous){
			case 'sq':$flag='al';break;
			case 'ar':$flag='sa';break;
			case 'az':$flag='az';break;
			case 'ga':$flag='ie';break;
			case 'et':$flag='ee';break;
			case 'be':$flag='by';break;
			case 'bg':$flag='bg';break;
			case 'pl':$flag='pl';break;
			case 'fa':$flag='ir';break;
			case 'af':$flag='za';break;
			case 'da':$flag='dk';break;
			case 'de':$flag='de';break;
			case 'ru':$flag='ru';break;
			case 'fr':$flag='fr';break;
			case 'tl':$flag='ph';break;
			case 'fi':$flag='fi';break;
			case 'ht':$flag='ht';break;
			case 'ko':$flag='kr';break;
			case 'nl':$flag='nl';break;
			case 'gl':$flag='es';break;
			case 'ca':$flag='es';break;
			case 'cs':$flag='cz';break;
			case 'hr':$flag='hr';break;
			case 'la':$flag='it';break;
			case 'lv':$flag='lv';break;
			case 'lt':$flag='lt';break;
			case 'ro':$flag='ro';break;
			case 'mt':$flag='mt';break;
			case 'ms':$flag='id';break;
			case 'mk':$flag='mk';break;
			case 'no':$flag='no';break;
			case 'pt':$flag='pt';break;
			case 'ja':$flag='jp';break;
			case 'sv':$flag='se';break;
			case 'sr':$flag='rs';break;
			case 'sk':$flag='sk';break;
			case 'sl':$flag='si';break;
			case 'sw':$flag='tz';break;
			case 'th':$flag='th';break;
			case 'cy':$flag='wls';break;
			case 'uk':$flag='ua';break;
			case 'iw':$flag='';break;
			case 'el':$flag='gr';break;
			case 'eu':$flag='es';break;
			case 'es':$flag='es';break;
			case 'hu':$flag='hu';break;
			case 'it':$flag='it';break;
			case 'yi':$flag='de';break;
			case 'ur':$flag='pk';break;
			case 'id':$flag='id';break;
			case 'en':$flag='gb';break;
			case 'vi':$flag='vn';break;
			case 'tc':$flag='cn';break;
			case 'cn':$flag='cn';break;
		}
		return $flag;
	}
    /**
     * listColumnRes 列表页响应显示列数
     * @param  Number $columnXs  手机端列数
     * @param  Number $columnMd  平板端列数
     * @param  Number $columnLg  普通电脑端列数
     * @param  Number $columnXxl 大屏电脑端列数
     * @return String $listColumnRes 响应式列数样式
     */
    public function listColumnRes($columnXs,$columnMd,$columnLg,$columnXxl){
        $column = array($columnXs,$columnMd,$columnLg,$columnXxl);
        $listcolumn = array(
            $listcolumn['0']=$column['0']?'blocks-'.($column['0']==1?100:$column['0']):'',
            $listcolumn['1']=$column['1']?'blocks-md-'.$column['1']:'',
            $listcolumn['2']=$column['2']?'blocks-lg-'.$column['2']:'',
            $listcolumn['3']=$column['3']?'blocks-xxl-'.$column['3']:'',
        );
        for ($i=0; $i < 4; $i++) {
            if($column[$i]) $listColumnRes.=$listcolumn[$i].' ';
        }
        return $listColumnRes;
    }
    /**
     * modulenameToModule 模块名称转模块标识
     * @param  String $module_name 模块名称
     * @return Number $module 模块标识
     */
    public function modulenameToModule($module_name){
        switch ($module_name) {
            case '简介模块':$module=1;break;
            case '文章模块':$module=2;break;
            case '产品模块':$module=3;break;
            case '下载模块':$module=4;break;
            case '图片模块':$module=5;break;
            case '招聘模块':$module=6;break;
            case '留言模块':$module=7;break;
            case '反馈模块':$module=8;break;
            case '友情链接':$module=9;break;
            case '会员中心':$module=10;break;
            case '全站搜索':$module=11;break;
            case '网站地图':$module=12;break;
        }
        return $module;
    }
    // 模块标识转模块列表图片尺寸
    public function moduleImgSize($module){
        global $_M;
        switch (intval($module)) {
            case 2:
                $module_img_size['x']=$_M['config']['met_newsimg_x'];
                $module_img_size['y']=$_M['config']['met_newsimg_y'];
                break;
            case 5:
                $module_img_size['x']=$_M['config']['met_imgs_x'];
                $module_img_size['y']=$_M['config']['met_imgs_y'];
                break;
            case 3:
                $module_img_size['x']=$_M['config']['met_productimg_x'];
                $module_img_size['y']=$_M['config']['met_productimg_y'];
                break;
        }
        return $module_img_size;
    }
    /**
     * getRelativePath 计算path2 相对于 $path1 的路径,即在path1引用paht2的相对路径
     * @param String $path1
     * @param String $path2
     * @return String $relapath 相对路径
     */
    public function getRelativePath($path1,$path2){
        global $_M;
        if(defined('PATH_WEB')){
            $path1=str_replace(PATH_WEB, '', $path1);
            $path2=str_replace(PATH_WEB, '', $path2);
        }
        if($_M['url']['site']){
            $path1=str_replace($_M['url']['site'], '', $path1);
            $path2=str_replace($_M['url']['site'], '', $path2);
        }
        $arr1 = explode('/', $path1) ;
        $arr2 = explode('/', $path2);
        if(end($arr1)!='' && !strpos(end($arr1), '.')) $arr1[]='';
        if(end($arr2)!='' && !strpos(end($arr2), '.')) $arr2[]='';
        $c = array_values(array_diff_assoc($arr1, $arr2));
        $d = array_values(array_diff_assoc($arr2, $arr1));
        array_pop($c);
        foreach($c as & $v) {
            $v = '..';
        }
        $arr = array_merge($c, $d);
        $relativePath = implode("/", $arr);
        return $relativePath;
    }
    /**
     * useragent 客户端类型判断、客户端验证
     * @param  String $isClient 需要验证的客户端类型
     * @return String/Boolean $client 为空时返回当前客户端类型，输入tablet、mobile、desktop则返回当前客户端是否为该类型的判断值
     */
    public function useragent($isClient){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $iphone = strpos($agent, 'mobile');
        $android = strpos($agent, 'android');
        $windowsPhone = strpos($agent, 'phone');
        $androidTablet=$android && !$iphone?true:false;
        $ipad = strpos($agent, 'ipad');
        //客户端类型判断
        if($androidTablet || $ipad){
            $client='tablet';
        }elseif($iphone && !$ipad || $android && !$androidTablet || $windowsPhone){
            $client='mobile';
        }else{
            $client='desktop';
        }
        if($isClient){
            return $client==$isClient?true:false;// 客户端验证
        }else{
            return $client;
        }
    }
    // 获取浏览器类型
    public function getBrowser(){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (strpos($agent, 'Maxthon')) {
            $browser = 'Maxthon';
        } elseif(strpos($agent, 'MSIE 12.0')) {
            $browser = 'IE12.0';
        } elseif(strpos($agent, 'MSIE 11.0')) {
            $browser = 'IE11.0';
        } elseif(strpos($agent, 'MSIE 10.0')) {
            $browser = 'IE10.0';
        } elseif(strpos($agent, 'MSIE 9.0')) {
            $browser = 'IE9.0';
        } elseif(strpos($agent, 'MSIE 8.0')) {
            $browser = 'IE8.0';
        } elseif(strpos($agent, 'MSIE 7.0')) {
            $browser = 'IE7.0';
        } elseif(strpos($agent, 'MSIE 6.0')) {
            $browser = 'IE6.0';
        } elseif(strpos($agent, 'NetCaptor')) {
            $browser = 'NetCaptor';
        } elseif(strpos($agent, 'Netscape')) {
            $browser = 'Netscape';
        } elseif(strpos($agent, 'Lynx')) {
            $browser = 'Lynx';
        } elseif(strpos($agent, 'Opera')) {
            $browser = 'Opera';
        } elseif(strpos($agent, 'Chrome')) {
            $browser = 'Google';
        } elseif(strpos($agent, 'Firefox')) {
            $browser = 'Firefox';
        } elseif(strpos($agent, 'Safari')) {
            $browser = 'Safari';
        } elseif(strpos($agent, 'iphone') || strpos($agent, 'ipod')) {
            $browser = 'iphone';
        } elseif(strpos($agent, 'ipad')) {
            $browser = 'iphone';
        } elseif(strpos($agent, 'android')) {
            $browser = 'android';
        } else {
            $browser = 'other';
        }
        return $browser;
    }
    /**
     * strReplace 多维数组或字符串值字符替换
     * @param  String $find    查找的字符
     * @param  String $replace 替换的字符
     * @param  String $array   数组或者字符串
     * @return array/String $array 数组或者字符串
     */
    public function strReplace($find,$replace,$array){
        if(is_array($array)){
            $array=str_replace($find,$replace,$array);
            foreach ($array as $key => $val) {
                if (is_array($val)) $array[$key]=$this->strReplace($find,$replace,$array[$key]);
            }
        }else{
            $array=str_replace($find,$replace,$array);
        }
        return $array;
    }
}
$metresclass=new MetResClass();
?>