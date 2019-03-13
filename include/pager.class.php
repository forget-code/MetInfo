<?php

    class Pager
    {
      var   $_total;                          //记录总数
      var  $pagesize;                       //每一页显示的记录数
      var     $pages;                         //总页数
      var   $_cur_page;                    //当前页码
      var  $offset;                      //记录偏移量
      var  $pernum = 10;                //页码偏移量，这里可随意更改
    
      function Pager($total,$pagesize,$_cur_page)
        {   
        $this->_total=$total;
        $this->pagesize=$pagesize;
        $this->_offset();
        $this->_pager();
        $this->cur_page($_cur_page);
    }
    
    function _pager()//计算总页数
    { 
    return $this->pages = ceil($this->_total/$this->pagesize);
    }
   
   
     function cur_page($_cur_page) //设置页数
    {     
   	    if (isset($_cur_page)&&$_cur_page!=0)
           {
           $this->_cur_page=intval($_cur_page);
           }
           else
           {
            $this->_cur_page=1; //设置为第一页
           }
        return  $this->_cur_page;
   }
   
 //数据库记录偏移量
  function _offset()
   {
   return $this->offset=$this->pagesize*($this->_cur_page-1);
   }
      //html数字连接的标签
 function num_link($tex='?',$url='')
  {
       $setpage  = $this->_cur_page ? ceil($this->_cur_page/$this->pernum) : 1;
        $pagenum   = ($this->pages > $this->pernum) ? $this->pernum : $this->pages;
        if ($this->_total  <= $this->pagesize) {
            $text  = '';
        } else {
            $text = '<span class=list_total>'.$this->_cur_page.'/'.$this->pages.'&nbsp;</span>';
            if ($setpage > 1) {
                $lastsetid = ($setpage-1)*$this->pernum;
                $text .= '<a  class=webdings href='.$tex.'pager='.$lastsetid.$url.'> 8 </a>';
            }
            if ($this->_cur_page > 1) {
                $pre = $this->_cur_page-1;
                $text .= '<a    class=webdings  href='.$tex.'pager='.$pre.$url.'>3</a>';
            }
            $i = ($setpage-1)*$this->pernum;
            for($j=$i; $j<($i+$pagenum) && $j<$this->pages; $j++) {
                $newpage = $j+1;
                if ($this->_cur_page == $j+1) {
                    $text .= '<span>'.($j+1).'</span>';
                } else {
                    $text .= '<a href='.$tex.'pager='.$newpage.$url.'>'.($j+1).'</a>';
                }
            }            
            if ($this->_cur_page < $this->pages){
                $next = $this->_cur_page+1;
                $text .= '<a  class=webdings href='.$tex.'pager='.$next.$url.'>4</a>';
            }
            if ($setpage < $this->_total) {
                $nextpre = $setpage*($this->pernum+1);
                if($nextpre<$this->pages)
                $text .= '<a  class=webdings  href='.$tex.'pager='.$nextpre.$url.'>7</a>';
            }
         }
            return $text;
         }
 //html连接的标签 
function link($url, $exc='')
  {
      global $lang;
	 $text="<form method='POST' name='page1'  action='".$url."' target='_self'>";
     $text.= "$lang[pag_total]<span>$this->pages</span>$lang[pags] $lang[pag_loction]<span>$this->_cur_page</span>$lang[pags] ";
      if ($this->_cur_page == 1 && $this->pages>1) 
        {
            //第一页
            $text.= "$lang[pag_home] $lang[pag_return] <a href=".$url.($this->_cur_page+1).$exc.">$lang[pag_next]</a>  <a href=".$url.$this->pages.$exc.">$lang[pag_end]</a>";
        } 
        elseif($this->_cur_page == $this->pages && $this->pages>1) 
        {
            //最后一页
             $text.= "<a href=".$url.'1'.$exc.">$lang[pag_home]</a> <a href=".$url.($this->_cur_page-1).$exc.">$lang[pag_return]</a> $lang[pag_next] $lang[pag_end]";
        } 
        elseif ($this->_cur_page > 1 && $this->_cur_page <= $this->pages) 
        {
            //中间
             $text.= "<a href=".$url.'1'.$exc.">$lang[pag_home]</a> <a href=".$url.($this->_cur_page-1).$exc.">$lang[pag_return]</a> <a href=".$url.($this->_cur_page+1).$exc.">$lang[pag_next]</a>  <a href=".$url.$this->pages.$exc.">$lang[pag_end]</a>";
        }
$text.=" $lang[pag_go]<INPUT size='1' name='page_input'>$lang[pags] ";
$text.="<input type='submit' name='Submit3' value=' GO ' class='tj'>  </form>";
        return $text;
  }
 }
 
   