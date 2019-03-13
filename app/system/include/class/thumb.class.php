<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_func('file.func.php');

/** 
 * ����ͼ��
 * @param string $thumb_width 	����ͼ��
 * @param string $thumb_height 	����ͼ��
 * @param string $thumb_savepath	����ͼ�����ַ
 * @param string $thumb_save_type	���淽ʽ��1:������ԭͼ·������Ŀ¼�£�2:����ԭͼƬ��3:�Զ���·��
 * @param string $thumb_bgcolor		����ͼ������ɫ����#��ͷ
 * @param string $thumb_kind		��������ͼ��ʽ��1������2���ף�3�ü�
 * ����·�������������Ǿ���·���������ʹ�����set����
 */
class thumb {
	public $thumb_src_image = ""; 
	public $thumb_width = 350;
	public $thumb_height = 350; 
	public $thumb_savepath = ""; 
	public $thumb_save_type = 1; 
	public $thumb_bgcolor =' ';
	public $thumb_kind = 1;
	
	function __construct() {
		global $_M;
		$this->list_news();
	}
	
	/** 
	 * �����ֶ�
	 * @param string $name  ��Ҫ���õ��ֶ�����Ϊpublic�ֶζ���������
	 * @param string $value ��Ҫ���õ��ֶ�����ֵ	 
	 * thumb_savepath��thumb_save_typeΪ3ʱ�ÿ����Ǿ���·����Ҳ�������վ��̨��Ŀ¼�����·��
	 * thumb_savepath��thumb_save_typeΪ2��������Ч
	 * thumb_savepath��thumb_save_typeΪ1��thumb_savepathΪ���ԭͼ��·��
	 */
	public function set($name, $value) {
		global $_M;
		if ($value === NULL) {
			return false;
		}
		switch ($name) {
			case 'thumb_width';
				$this->thumb_width =  $value;
			break;
			case 'thumb_height';
				$this->thumb_height = $value;
			break;
			case 'thumb_savepath';
				if ($this->thumb_save_type == 3) {
					$this->thumb_savepath = path_absolute($value);
				} else {
					$this->thumb_savepath = $value;
				}
				$this->thumb_savepath = path_standard($this->thumb_savepath);
			break;
			case 'thumb_save_type';
				$this->thumb_save_type = $value;
			break;
			case 'thumb_bgcolor';
				$this->thumb_bgcolor = $value;
			break;
			case 'thumb_kind';
				$this->thumb_kind = $value;
			break;
		}	
	}
	
	/** 
	 * ����վ�б�ҳ����ͼ��ʽ����ͼƬ��2 = ����ģ��, 3 = ��Ʒģ��, 5 = ͼƬģ�飩
	 * @param string $module  2/news:����ģ�飬3/product:��Ʒģ�飬5/img:ͼƬģ�飩
	 */
	public function list_module($module) {
		if ($module == 'news') $module = 2;
		if ($module == 'product') $module = 3;
		if ($module == 'img') $module = 5;
		switch ($module) {
			case 2:
				$this->list_news();
			break;
			case 3:
				$this->list_product();
			break;
			case 5:
				$this->list_img();
			break;		
		}
	}
	
	/** 
	 * ����վ����ҳ����ͼ��ʽ����ͼƬ��3 = ��Ʒģ��, 5 = ͼƬģ�飩
	 * @param string $module 3/product:��Ʒģ�飬5/img:ͼƬģ�飩
	 */
	public function content_module($module) {
		if ($module == 'product') $module = 3;
		if ($module == 'img') $module = 5;
		switch ($module) {
			case 3;
				$this->contents_product();
			break;
			case 5;
				$this->contents_img();
			break;		
		}
	}
	
	/** 
	 * ����վ�����б�ҳ����ͼ��ʽ����ͼƬ
	 */
	public function list_news() {
		global $_M;
		$this->set('thumb_width', $_M['config']['met_newsimg_x']);
		$this->set('thumb_height', $_M['config']['met_newsimg_y']);
		$this->set('thumb_save_type', 1);
		$this->set('thumb_savepath', 'thumb/');
		$this->set('thumb_kind', $_M['config']['met_thumb_kind']);
		$this->set('thumb_bgcolor', '#FFFFFF');
	}
	
	/** 
	 * ����վ��Ʒ�б�ҳ����ͼ��ʽ����ͼƬ
	 */
	public function list_product() {
		global $_M;
		$this->set('thumb_width', $_M['config']['met_productimg_x']);
		$this->set('thumb_height', $_M['config']['met_productimg_y']);
		$this->set('thumb_save_type', 1);
		$this->set('thumb_savepath', 'thumb/');
		$this->set('thumb_kind', $_M['config']['met_thumb_kind']);
		$this->set('thumb_bgcolor', '#FFFFFF');
	}
	
	/** 
	 * ����վͼƬ�б�ҳ����ͼ��ʽ����ͼƬ
	 */
	public function list_img() {
		global $_M;
		$this->set('thumb_width', $_M['config']['met_imgs_x']);
		$this->set('thumb_height', $_M['config']['met_imgs_y']);
		$this->set('thumb_save_type', 1);	
		$this->set('thumb_savepath', 'thumb/');
		$this->set('thumb_kind', $_M['config']['met_thumb_kind']);
		$this->set('thumb_bgcolor', '#FFFFFF');
	}
	
	/** 
	 * ����վͼƬ����ҳ����ͼ��ʽ����ͼƬ
	 */
	public function contents_img() {
		global $_M;
		$this->set('thumb_width', $_M['config']['met_imgdetail_x']);
		$this->set('thumb_height', $_M['config']['met_imgdetail_y']);
		$this->set('thumb_save_type', 1);	
		$this->set('thumb_savepath', 'thumb_dis/');
		$this->set('thumb_kind', $_M['config']['met_thumb_kind']);
		$this->set('thumb_bgcolor', '#FFFFFF');
	}
	
	/** 
	 * ����վ��Ʒ����ҳ����ͼ��ʽ����ͼƬ
	 */
	public function contents_product() {
		global $_M;
		$this->set('thumb_width', $_M['config']['met_productdetail_x']);
		$this->set('thumb_height', $_M['config']['met_productdetail_y']);
		$this->set('thumb_kind', $_M['config']['met_thumb_kind']);
		$this->set('thumb_save_type', 1);
		$this->set('thumb_savepath', 'thumb_dis/');
		$this->set('thumb_bgcolor', '#FFFFFF');
	}
	
    /**
	 * ��������ͼ�ķ���
	 * @param  strint	ԭͼ��ַ       
	 * @return array	���سɹ��������Ϣ
	 * ����ֵΪ������ֶκ��壬error:�Ƿ����1����0������errorcode:������룬path:����ͼƬ·��
     */
    public function createthumb($thumb_src_image) {
		global $_M;
		$thumb_src_image = path_absolute($thumb_src_image);		
		if ($this->thumb_save_type == 1) {		
			$thumb_savepath = dirname($thumb_src_image).'/'.$this->thumb_savepath;
		}
		if ($this->thumb_save_type == 2) {
			$thumb_savepath = dirname($thumb_src_image).'/';			
		}
		if ($this->thumb_save_type == 3) {
			$thumb_savepath = $this->thumb_savepath;
		}
		if (stristr(PHP_OS,"WIN")) {
			$thumb_src_image = @iconv("utf-8","GBK",$thumb_src_image);
		}
		if(!file_exists($thumb_src_image) || is_dir($thumb_src_image)){
			return $this->error($_M['word']['batchtips30']);
		}
		
		$this->thumb_width=$this->thumb_width?$this->thumb_width:100;
		$this->thumb_height=$this->thumb_height?$this->thumb_height:100;
		$gd = $this->gd_version(); 

        //���ԭʼ�Ƿ��ļ����ڲ��ҵõ�ԭͼ��Ϣ
        $org_info = @getimagesize($thumb_src_image);//����ͼƬ��С
        if ($org_info[mime]=='image/bmp') {//bmpͼ�޷�ѹ��   
		   return $this->error($_M['word']['upfileFail5']);
        }
        if (!$this->check_img_function($org_info[2])) {
		   return $this->error($_M['word']['upfileFail6']);
        }

        $img_org = $this->img_resource($thumb_src_image, $org_info[2]);

        //ԭʼͼ�������ͼ�ߴ�Ա�
        $scale_org      = $org_info[0] / $org_info[1];
		$scale_tumnb    = $this->thumb_width / $this->thumb_height;
		
        //��������ͼ��Ⱥ͸߶�Ϊ0�����������������ͼһ����
        if ($this->thumb_width == 0) {
            $this->thumb_width = $this->thumb_height * $scale_org;
        }
        if ($this->thumb_height == 0) {
            $this->thumb_height = $this->thumb_width / $scale_org;
        }

        //��������ͼ
        if ($gd == 2) {//����һ������ͼ����ɫ��
            $img_thumb  = imagecreatetruecolor($this->thumb_width, $this->thumb_height);
        } else {
            $img_thumb  = imagecreate($this->thumb_width, $this->thumb_height);
        }

        //����ͼ������ɫ
        if (empty($this->thumb_bgcolor)) $this->thumb_bgcolor = "#FFFFFF";
        $this->thumb_bgcolor = trim($this->thumb_bgcolor, "#");
        sscanf($this->thumb_bgcolor, "%2x%2x%2x", $red, $green, $blue);
        $clr = imagecolorallocate($img_thumb, $red, $green, $blue);
        imagefilledrectangle($img_thumb, 0, 0, $this->thumb_width, $this->thumb_height, $clr);//��������ɫ��Ĭ��Ϊ��ɫ
		switch ($this->thumb_kind) {
			case 1:
				$dst_x=0;
				$dst_y=0;
				$lessen_width=$this->thumb_width;
				$lessen_height=$this->thumb_height;
				$scr_x=0;
				$scr_y=0;
				$scr_w=$org_info[0];
				$scr_h=$org_info[1];
			break;
			case 2:
			  if ($org_info[0] / $this->thumb_width > $org_info[1] / $this->thumb_height){//��������
					$lessen_width  = $this->thumb_width;
					$lessen_height  = $this->thumb_width / $scale_org;
				}
				else{//��������
					$lessen_width  = $this->thumb_height * $scale_org;
					$lessen_height = $this->thumb_height;
				}
				$dst_x = ($this->thumb_width  - $lessen_width)  / 2;
				$dst_y = ($this->thumb_height - $lessen_height) / 2;
				$scr_x=0;
				$scr_y=0;
				$scr_w=$org_info[0];
				$scr_h=$org_info[1];
			break;
			case 3:
				$dst_x=0;
				$dst_y=0;
				$lessen_width=$this->thumb_width;
				$lessen_height=$this->thumb_height;
				if ($org_info[0] / $this->thumb_width > $org_info[1] / $this->thumb_height) {//��������,������
					$scr_w  = $org_info[1] * $scale_tumnb;
					$scr_h = $org_info[1];
				} else {//��������,������
					$scr_w  = $org_info[0];
					$scr_h  = $org_info[0] / $scale_tumnb;
				}
				$scr_x = ($org_info[0]  - $scr_w)  / 2;
				$scr_y = ($org_info[1] - $scr_h) / 2;
			break;			
		}
       //�Ŵ�ԭʼͼƬ
        if ($gd == 2) {
            imagecopyresampled($img_thumb, $img_org, $dst_x, $dst_y, $scr_x, $scr_y, $lessen_width, $lessen_height, $scr_w, $scr_h);
        } else {
            imagecopyresized($img_thumb, $img_org, $dst_x, $dst_y, $scr_x, $scr_y, $lessen_width, $lessen_height, $scr_w, $scr_h);
        }
        if (!makedir($thumb_savepath)) {
			return $this->error($_M['word']['upfileFail4']);
        }
	
        $thumbname = $thumb_savepath.basename($thumb_src_image);;
        //Create
		switch ($org_info[mime]) {
            case 'image/gif':
				if (function_exists('imagegif')) {
					$re=imagegif($img_thumb, $thumbname);
				} else {
					return $this->error($_M['word']['upfileFail9']);
				}
                break;
            case 'image/pjpeg':
            case 'image/jpeg':
				if (function_exists('imagejpeg')) {
					$re=imagejpeg($img_thumb, $thumbname,100);
				} else {
					return $this->error($_M['word']['upfileFail10']);
				}
                break;
            case 'image/x-png':
            case 'image/png':
				if (function_exists('imagejpeg')) {
					$re=imagepng($img_thumb, $thumbname);
				} else {
					return $this->error($_M['word']['upfileFail11']);
				}
                break;
            default:
               return $this->error($_M['word']['upfileFail7']);
        }
		if (!$re) {
			return $this->error($_M['word']['upfileFail8']);
		}
		if (stristr(PHP_OS,"WIN")) {
			$thumbname = @iconv("GBK","utf-8",$thumbname);
		}
		$thumbname='../'.str_replace(PATH_WEB, '', $thumbname);
        imagedestroy($img_thumb);
        imagedestroy($img_org);
        return $this->sucess($thumbname);
    }

	/**
	 * ����ͼƬ��Դ
	 * @param string $img:	     ����ͼƬ��·��
	 * @param string $mime_type: ͼƬ����
	 * @return                   ���ش�����ͼƬ��Դ
	 */
    protected function img_resource($img, $mime_type) {
        switch ($mime_type) {
            case 1:
            case 'image/gif':
                $res = imagecreatefromgif($img);
                break;

            case 2:
            case 'image/pjpeg':
            case 'image/jpeg':
                $res = imagecreatefromjpeg($img);
                break;

            case 3:
            case 'image/x-png':
            case 'image/png':
                $res = imagecreatefrompng($img);
                break;

            default:
                return false;
        }
        return $res;
    }	
	
	/**
	 * �õ���Gd�������汾
	 * @return int ����Gd�������汾
     */
    protected function gd_version() {
        static $version = -1;
        if ($version >= 0) {
            return $version;
        }
        if (!extension_loaded('gd')) {
            $version = 0;
        } else {
            // ʹ�� gd_info() ����ȡ�õ�ǰ��װ�� GD �����Ϣ
            if (PHP_VERSION >= '4.3') {
                if (function_exists('gd_info')) {
                    $ver_info = gd_info();
                    preg_match('/\d/', $ver_info['GD Version'], $match);
                    $version = $match[0];
                } else {
                    if (function_exists('imagecreatetruecolor')) {
                        $version = 2;
                    } else if (function_exists('imagecreate')) {
                        $version = 1;
                    }
                }
            }else{
                if (preg_match('/phpinfo/', ini_get('disable_functions'))) {     
                    $version = 1;
                } else {
                  // ʹ�� phpinfo() ����
                   ob_start();
                   phpinfo(8);
                   $info = ob_get_contents();
                   ob_end_clean();
                   $info = stristr($info, 'gd version');
                   preg_match('/\d/', $info, $match);
                   $version = $match[0];
                }
            }
        }
        return $version;
    }
	
    /**
	 * ���PHP�汾�Լ��������Ƿ����
	 * @return buttton ���ؿ��û򲻿�����Ϣ
     */
    protected function check_img_function($img) {
        switch ($img){
            case 'image/gif':
            case 1:
                if (PHP_VERSION >= '4.3') {
                    return function_exists('imagecreatefromgif');
                } else {
                    return (imagetypes() & IMG_GIF) > 0;
                }
            break;

            case 'image/pjpeg':
            case 'image/jpeg':
            case 2:
                if (PHP_VERSION >= '4.3') {
                    return function_exists('imagecreatefromjpeg');
                } else {
                    return (imagetypes() & IMG_JPG) > 0;
                }
            break;

            case 'image/x-png':
            case 'image/png':
            case 3:
                if (PHP_VERSION >= '4.3') {
                     return function_exists('imagecreatefrompng');
                } else {
                    return (imagetypes() & IMG_PNG) > 0;
                }
            break;
			
            default:
                return false;
        }
    }
	
	/**
	 * ����ͼ������÷���		
	 * @param string $error ������Ϣ
	 * @return array ���ش�����Ϣ
	 */
	protected function error($error) {
		$back['error'] = 1;
		$back['errorcode'] = $error;
		return $back;
	}
	
	/**
	 * ����ͼ�ɹ����÷���
	 * @param string $path ·��
	 * @return array ���سɹ�·��(����ڵ�ǰ·��)
	 */
	protected function sucess($path) {
		$back['error']=0;
		$back['path']=$path;
		return $back;
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>