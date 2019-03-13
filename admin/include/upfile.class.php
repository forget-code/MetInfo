<?php
class upfile {
  var $filename;
  // name
  var $savename;
  // Path
  var $savepath = '../../upload';
  //Watermark Save Path
  var $waterpath =  '../../upload/watermark';
  // File format defined for the space-time format does not limit
  var $format = "";
  // Overwrite mode
  var $overwrite = 1;
  /* $overwrite = 0 not Overwrite
   * $overwrite = 1 Overwrite
   */
  //Maximum file size bytes
  var $maxsize = 210000000;
  //File extension
  var $ext;
  //error
  var $errno = 0;

  /* function
   * $path save path
   * $format file fromat
   * $maxsize file max size
   * $over Overwrite parameter
   */
  function upfile($format = '',$path = '',$maxsize = 0, $over = 0) {
	global $lang_upfileFail,$lang_upfileFail1,$lang_upfileFail2;
      if (empty($path)) {
          $path = $this->savepath.'/'.date('Ym').'/';
          $water = $this->savepath.'/'.date('Ym').'/watermark/';
          $thumb = $this->savepath.'/'.date('Ym').'/thumb/';
          if (!file_exists($water)){
              !$this->make_dir($water)&& $this->halt($lang_upfileFail);
          }
          if (!file_exists($thumb)) {
              !$this->make_dir($thumb)&&$this->halt($lang_upfileFail1);
          }
          $this->waterpath = $water;
      } else {
      $this->savepath = substr($path,  - 1) == "/" ? $path : $path."/";
    }
    if (!file_exists($path)) {
      if (!$this->make_dir($path)) {
        return $this->halt($lang_upfileFail2);
      }
    }
    $this->savepath = $path;
    $this->overwrite = $over; //Whether it covers the same name file
    $this->maxsize = !$maxsize ? $this->maxsize: $maxsize; //Maximum file size bytes
    $this->format = $format;
  }

  /*
   * Functions: to detect and organize your files
   * $form file name
   * $file fave file name
   */
  function upload($form, $file = "") {
	global $lang_upfileFail3;
    if (is_array($form)) {
      $filear = $form;
    } else {
      $filear = $_FILES[$form];
    }
    if (!is_writable($this->savepath)) {
      $this->halt($lang_upfileFail3);
    }
      $this->getext($filear["name"]); //Get extension
      $this->set_savename($file); //Save the settings file name
      $this->copyfile($filear);
    return "../upload/".date('Ym').'/'.$this->savename;
  }

  /*
   * Function: To detect and copy uploaded file
   * $filear Upload an array of documents
   */
 
 
  function copyfile($filear) {
	global $lang_upfileFile,$lang_upfileMax,$lang_upfileByte,$lang_upfileTip1,$lang_upfileTip2,$lang_upfileTip3,
			$lang_upfileOK,$lang_upfileOver,$lang_upfileOver1,$lang_upfileOver2,$lang_upfileOver3;
    if ($filear["size"] > $this->maxsize) {
      $this->halt("$lang_upfileFile ".$filear["name"]." $lang_upfileMax [".$this->maxsize." $lang_upfileByte] $lang_upfileTip1");
    }

    if (!$this->overwrite && file_exists($this->savename)) {
      $this->halt($this->savename." $lang_upfileTip2");
    }
    $this->format=str_replace("php","",strtolower($this->format));
	$this->format=str_replace("aspx","",strtolower($this->format));
    $this->format=str_replace("asp","",strtolower($this->format));
    $this->format=str_replace("jsp","",strtolower($this->format));
    $this->format=str_replace("js","",strtolower($this->format));
    if ($this->format != "" && !in_array(strtolower($this->ext), explode(",",
        strtolower($this->format)))) {    
      $this->halt($this->ext." $lang_upfileTip3");
    }

    if (!copy($filear["tmp_name"], $this->savepath.$this->savename)) {
      $errors = array(0 => $lang_upfileOK, 1 =>
                      $lang_upfileOver, 2 => $lang_upfileOver1, 3 => $lang_upfileOver2, 4 => $lang_upfileOver3);
      $this->halt($errors[$filear["error"]]);
    } else {
      @unlink($filear["tmp_name"]); //Delete temporary files
    }
  }

  /*
   * Function: get the file extension
   * $filename file name
   */
  function getext($filename) {
    if ($filename == "") {
      return ;
    }

    $ext = explode(".", $filename);
    return $this->ext = $ext[1];

  }

  /*
   * Function: Set the file name
   * $savename Save the name, if it is empty, then the system automatically generates a random file name
   */
  function set_savename($savename = "") {
    if ($savename == "")
     { // If you do not set the file name, then generate a random file name
      srand((double)microtime() * 1000000);
      $rnd = rand(100, 999);
      $name = date('U') + $rnd;
      $name = $name.".".$this->ext;
    } else {
      $name = $savename.".".$this->ext;
    }
    return $this->savename = $name;
  }

  /*
   * Function: error
   * $msg output
   */
  function halt($msg) {
	global $lang_upfileNotice;
    //admin_msg($msg);
    echo"<strong>$lang_upfileNotice</strong>".$msg;
    exit;
  }
  /**Thumbnail image width and height to determine treatment**/
  function setWidthHeight($width, $height, $maxwidth, $maxheight) {
    if ($width > $height) {
      if ($width > $maxwidth) {
        $difinwidth = $width / $maxwidth;
        $height = intval($height / $difinwidth);
        $width = $maxwidth;
        if ($height > $maxheight) {
          $difinheight = $height / $maxheight;
          $width = intval($width / $difinheight);
          $height = $maxheight;

        }
      } else {
        if ($height > $maxheight) {
          $difinheight = $height / $maxheight;
          $width = intval($width / $difinheight);
          $height = $maxheight;

        }
      }
    } else {
      if ($height > $maxheight) {
        $difinheight = $height / $maxheight;

        $width = intval($width / $difinheight);

        $height = $maxheight;
        if ($width > $maxwidth) {
          $difinwidth = $width / $maxwidth;

          $height = intval($height / $difinwidth);

          $width = $maxwidth;

        }
      } else {
        if ($width > $maxwidth) {
          //Rescale it.
          $difinwidth = $width / $maxwidth;

          $height = intval($height / $difinwidth);
          $width = $maxwidth;
        }
      }
    }
    $widthheightarr = array("$width", "$height");
    return $widthheightarr;
  }
  /**
   * According to the source file is generated thumbnails
   *
   * @access  public
   * @param   string      $img  The path of the original image
   * @param   string      $constrainw  Thumbnail width
   * @param   string      $constrainh  Thumbnail height
   * @return  resource    If successful, returns the full path to the file name
   */
  function createthumb1($img,$constrainw,$constrainh) {
    global $met_img_x,$met_img_y,$lang_upfileFail4,$lang_upfileFail5;
    $oldsize = getimagesize($img);	
    //$newsize = $this->setWidthHeight($oldsize[0], $oldsize[1], $constrainw,$constrainh);
	$newsize=array(0=>intval($met_img_x),1=>intval($met_img_y));
    $exp = explode(".", $img);
	$count_exp = count($exp);
	$count_exp = $count_exp-1;
	$exp[$count_exp]=strtolower($exp[$count_exp]);
    if ($exp[$count_exp] == "gif") {
      $src = imagecreatefromgif($img);
    } elseif ($exp[$count_exp] == "png") {
      $src = imagecreatefrompng($img);
    } else {
      $src = imagecreatefromjpeg($img);
    }
    $dst = imagecreatetruecolor($newsize[0], $newsize[1]);	 
	$black = imagecolorallocate ($dst,255,0,0);
	imagecolortransparent($dst,$black);	
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newsize[0], $newsize[1],
                       $oldsize[0], $oldsize[1]);			
    $path = $this->savepath.'thumb/';
     if (!file_exists($path)) {
        if (!$this->make_dir($path)) {
         return $this->halt($lang_upfileFail4);
         }
    }

	$thumbname = $path.$this->savename;
	
    if ($exp[$count_exp] == "gif") {
      imagegif($dst, $thumbname);
    }else if ($exp[$count_exp] == "png") {
      imagepng($dst, $thumbname);
    }else if ($exp[$count_exp] == "jpg") {
      imagejpeg($dst, $thumbname);
    } else {
      return $this->halt($lang_upfileFail5);
    }
    imagedestroy($dst);
    imagedestroy($src);
    return $thumbname;
  }

    /**
  
     *
     * @access  public
     * @param   string      $img    Path
     * @param   int         $thumb_width  
     * @param   int         $thumb_height 
     * @param   strint      $path         
     * @return  mix        
     */
    function createthumb($img, $thumb_width = 0, $thumb_height = 0, $path = '', $bgcolor='')
    {
	     global $met_img_x,$met_img_y,$lang_upfileFail4,$lang_upfileFail5;
		 $thumb_width=$thumb_width?$thumb_width:$met_img_x;
		 $thumb_height=$thumb_height?$thumb_height:$met_img_y;
         $gd = $this->gd_version(); 
         if ($gd == 0)
         {   
             return $this->createthumb1($img,$thumb_width,$thumb_height);
         }

        /* Check the original file exists and get the original file information */
        $org_info = @getimagesize($img);
		
        if (!$org_info)
        {   
		   return $this->halt($lang_upfileFail5);
        }

        if (!$this->check_img_function($org_info[2]))
        {
		   return $this->halt($lang_upfileFail5);
        }

        $img_org = $this->img_resource($img, $org_info[2]);

        /* The original image and the thumbnail size ratio */
        $scale_org      = $org_info[0] / $org_info[1];
        /* Processing only the thumbnail width and height have a case for the 0, then as large as the background and thumbnail */
        if ($thumb_width == 0)
        {
            $thumb_width = $thumb_height * $scale_org;
        }
        if ($thumb_height == 0)
        {
            $thumb_height = $thumb_width / $scale_org;
        }

        /* Identifier to create thumbnails */
        if ($gd == 2)
        {
            $img_thumb  = imagecreatetruecolor($thumb_width, $thumb_height);
        }
        else
        {
            $img_thumb  = imagecreate($thumb_width, $thumb_height);
        }

        /* Background Color */
        if (empty($bgcolor))$bgcolor = "#FFFFFF";
        $bgcolor = trim($bgcolor,"#");
        sscanf($bgcolor, "%2x%2x%2x", $red, $green, $blue);
        $clr = imagecolorallocate($img_thumb, $red, $green, $blue);
        imagefilledrectangle($img_thumb, 0, 0, $thumb_width, $thumb_height, $clr);

        if ($org_info[0] / $thumb_width > $org_info[1] / $thumb_height)
        {
            $lessen_width  = $thumb_width;
            $lessen_height  = $thumb_width / $scale_org;
        }
        else
        {
            /* Original image is relatively high, with a high degree of subject */
            $lessen_width  = $thumb_height * $scale_org;
            $lessen_height = $thumb_height;
        }

        $dst_x = ($thumb_width  - $lessen_width)  / 2;
        $dst_y = ($thumb_height - $lessen_height) / 2;

        /* Processing the original image to zoom */
        if ($gd == 2)
        {
            imagecopyresampled($img_thumb, $img_org, $dst_x, $dst_y, 0, 0, $lessen_width, $lessen_height, $org_info[0], $org_info[1]);
        }
        else
        {
            imagecopyresized($img_thumb, $img_org, $dst_x, $dst_y, 0, 0, $lessen_width, $lessen_height, $org_info[0], $org_info[1]);
        }
		
		$path = $this->savepath.'thumb/';
        if (!file_exists($path)) {
        if (!$this->make_dir($path)) {
         return $this->halt($lang_upfileFail4);
         }
        }

        $thumbname = $path.$this->savename;
        /* Create */
        if (function_exists('imagejpeg'))
        {
            $filename .= '.jpg';
            imagejpeg($img_thumb, $thumbname);
        }
        elseif (function_exists('imagegif'))
        {
            $filename .= '.gif';
            imagegif($img_thumb, $thumbname);
        }
        elseif (function_exists('imagepng'))
        {
            $filename .= '.png';
            imagepng($img_thumb, $thumbname);
        }
        else
        {
            return $this->halt($lang_upfileFail5);
        }
 
        imagedestroy($img_thumb);
        imagedestroy($img_org);

        return $thumbname;
    }

     /**
     * According to the source file type identifier to create an image manipulation
     *
     * @access  public
     * @param   string      $img_file   path of images
     * @param   string      $mime_type  tyoe of images
     * @return  resource    
     */
    function img_resource($img_file, $mime_type)
    {
        switch ($mime_type)
        {
            case 1:
            case 'image/gif':
                $res = imagecreatefromgif($img_file);
                break;

            case 2:
            case 'image/pjpeg':
            case 'image/jpeg':
                $res = imagecreatefromjpeg($img_file);
                break;

            case 3:
            case 'image/x-png':
            case 'image/png':
                $res = imagecreatefrompng($img_file);
                break;

            default:
                return false;
        }

        return $res;
    }	
 /**
     * Get the server version of GD
     *
     * @access      public
     * @return      int         Value may be 0£¬1£¬2
     */
    function gd_version()
    {
        static $version = -1;

        if ($version >= 0)
        {
            return $version;
        }

        if (!extension_loaded('gd'))
        {
            $version = 0;
        }
        else
        {
            // Try gd_info function
            if (PHP_VERSION >= '4.3')
            {
                if (function_exists('gd_info'))
                {
                    $ver_info = gd_info();
                    preg_match('/\d/', $ver_info['GD Version'], $match);
                    $version = $match[0];
                }
                else
                {
                    if (function_exists('imagecreatetruecolor'))
                    {
                        $version = 2;
                    }
                    elseif (function_exists('imagecreate'))
                    {
                        $version = 1;
                    }
                }
            }
            else
            {
                if (preg_match('/phpinfo/', ini_get('disable_functions')))
                {
        
                    $version = 1;
                }
                else
                {
                  // use phpinfo function
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
     * Check image processing
     *
     * @access  public
     * @param   string  $img_type   type of image
     * @return  void
     */
    function check_img_function($img_type)
    {
        switch ($img_type)
        {
            case 'image/gif':
            case 1:

                if (PHP_VERSION >= '4.3')
                {
                    return function_exists('imagecreatefromgif');
                }
                else
                {
                    return (imagetypes() & IMG_GIF) > 0;
                }
            break;

            case 'image/pjpeg':
            case 'image/jpeg':
            case 2:
                if (PHP_VERSION >= '4.3')
                {
                    return function_exists('imagecreatefromjpeg');
                }
                else
                {
                    return (imagetypes() & IMG_JPG) > 0;
                }
            break;

            case 'image/x-png':
            case 'image/png':
            case 3:
                if (PHP_VERSION >= '4.3')
                {
                     return function_exists('imagecreatefrompng');
                }
                else
                {
                    return (imagetypes() & IMG_PNG) > 0;
                }
            break;

            default:
                return false;
        }
    }	 
  
  function make_dir($folder) {
    $reval = false;
    if (!file_exists($folder)) {
      @umask(0);
      preg_match_all('/([^\/]*)\/?/i', $folder, $atmp);
      $base = ($atmp[0][0] == '/') ? '/' : '';
      foreach($atmp[1]AS $val) {
        if ('' != $val) {
          $base .= $val;

          if ('..' == $val || '.' == $val) {
            $base .= '/';

            continue;
          }
        } else {
          continue;
        }

        $base .= '/';

        if (!file_exists($base)) {
          if (@mkdir($base, 0777)) {
            @chmod($base, 0777);
            $reval = true;
          }
        }
      }
    } else {
      $reval = is_dir($folder);
    }
    clearstatcache();
    return $reval;
  }

}

?>
