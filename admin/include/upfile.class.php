<?php
class upfile {
  //上传文件信息
  var $filename;
  // 保存名
  var $savename;
  // 原文件保存路径
  var $savepath = '../../upload';
  //水印保存路径
  var $waterpath =  '../../upload/watermark';
  // 文件格式限定，为空时不限制格式
  var $format = "";
  // 覆盖模式
  var $overwrite = 1;
  /* $overwrite = 0 时不覆盖同名文件
   * $overwrite = 1 时覆盖同名文件
   */
  //文件最大字节
  var $maxsize = 210000000;
  //文件扩展名
  var $ext;
  //错误代号
  var $errno = 0;

  /* 构造函数
   * $path 保存路径
   * $format 文件格式(用逗号分开)
   * $maxsize 文件最大限制
   * $over 复盖参数
   */
  function upfile($format = '',$path = '',$maxsize = 0, $over = 0) {
      if (empty($path)) {
          $path = $this->savepath.'/'.date('Ym').'/';
          $water = $this->savepath.'/'.date('Ym').'/watermark/';
          $thumb = $this->savepath.'/'.date('Ym').'/thumb/';
          if (!file_exists($water)){
              !$this->make_dir($water)&& $this->halt('创建水印目录失败');
          }
          if (!file_exists($thumb)) {
              !$this->make_dir($thumb)&&$this->halt('创建缩图目录失败');
          }
          $this->waterpath = $water;
      } else {
      $this->savepath = substr($path,  - 1) == "/" ? $path : $path."/";
    }
    if (!file_exists($path)) {
      if (!$this->make_dir($path)) {
        return $this->halt('创建图片目录失败');
      }
    }
    $this->savepath = $path;
    $this->overwrite = $over; //是否复盖相同名字文件
    $this->maxsize = !$maxsize ? $this->maxsize: $maxsize; //文件最大字节
    $this->format = $format;
  }

  /*
   * 功能：检测并组织文件
   * $form 文件域名称
   * $file 上传文件保存名称，为空或者上传多个文件时由系统自动生成名称
   */
  function upload($form, $file = "") {
    if (is_array($form)) {
      $filear = $form;
    } else {
      $filear = $_FILES[$form];
    }
    if (!is_writable($this->savepath)) {
      $this->halt("指定的路径不可写，或者没有此路径!");
    }
      $this->getext($filear["name"]); //取得扩展名
      $this->set_savename($file); //设置保存文件名
      $this->copyfile($filear);
    return "../upload/".date('Ym').'/'.$this->savename;
  }

  /*
   * 功能：检测并复制上传文件
   * $filear 上传文件资料数组
   */
 
 
  function copyfile($filear) {

    if ($filear["size"] > $this->maxsize) {
      $this->halt("上传文件 ".$filear["name"]." 大小超出系统限定值[".$this->maxsize." 字节]，不能上传。");
    }

    if (!$this->overwrite && file_exists($this->savename)) {
      $this->halt($this->savename." 文件名已经存在。");
    }

    if ($this->format != "" && !in_array(strtolower($this->ext), explode(",",
        strtolower($this->format)))) {    
      $this->halt($this->ext." 文件格式不允许上传。");
    }

    if (!copy($filear["tmp_name"], $this->savepath.$this->savename)) {
      $errors = array(0 => "文件上传成功", 1 =>
                      "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 ", 2 => "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ", 3 => "文件只有部分被上传。 ", 4 => "没有文件被上传。 ");
      $this->halt($errors[$filear["error"]]);
    } else {
      @unlink($filear["tmp_name"]); //删除临时文件
    }
  }

  /*
   * 功能: 取得文件扩展名
   * $filename 为文件名称
   */
  function getext($filename) {
    if ($filename == "") {
      return ;
    }

    $ext = explode(".", $filename);
    return $this->ext = $ext[1];

  }

  /*
   * 功能: 设置文件保存名
   * $savename 保存名，如果为空，则系统自动生成一个随机的文件名
   */
  function set_savename($savename = "") {
    if ($savename == "")
     { // 如果未设置文件名，则生成一个随机文件名
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
   * 功能：错误提示
   * $msg 为输出信息
   */
  function halt($msg) {
    //admin_msg($msg);
    echo"<strong>注意：</strong>".$msg;
    exit;
  }
  /**缩图图片宽高判断处理**/
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
   * 根据来源文件的文件生成缩图
   *
   * @access  public
   * @param   string      $img  原始图片的路径
   * @param   string      $constrainw  缩略图的宽度
   * @param   string      $constrainh  缩略图的高度
   * @return  resource    如果成功则返回完整路径文件名
   */
  function createthumb($img,$constrainw,$constrainh) {
    $oldsize = getimagesize($img);
    $newsize = $this->setWidthHeight($oldsize[0], $oldsize[1], $constrainw,
                                     $constrainh);
    $exp = explode(".", $img);
	$count_exp = count($exp);
	$count_exp = $count_exp-1;
    if ($exp[$count_exp] == "gif") {
      $src = imagecreatefromgif($img);
    } elseif ($exp[$count_exp] == "png") {
      $src = imagecreatefrompng($img);
    } else {
      $src = imagecreatefromjpeg($img);
    }
    $dst = imagecreatetruecolor($newsize[0], $newsize[1]);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newsize[0], $newsize[1],
                       $oldsize[0], $oldsize[1]);
    $path = $this->savepath.'thumb/';
     if (!file_exists($path)) {
        if (!$this->make_dir($path)) {
         return $this->halt('创建目录失败');
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
      return $this->halt('bmp的格式无法自动生成缩图');
    }
    imagedestroy($dst);
    imagedestroy($src);
    return $thumbname;
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
