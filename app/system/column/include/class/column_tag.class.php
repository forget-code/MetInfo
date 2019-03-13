<?php

class column_tag extends tag {
    // 必须包含Tag属性 不可修改
    public $config = array(
        '_category'         => array( 'block' => 1, 'level' => 4 ),
        '_list'             => array( 'block' => 1, 'level' => 4 ),
    );


    public function _category( $attr, $content ) {
        global $_M;
        $type = isset( $attr['type'] ) ? $attr['type'] : "current";
        $cid = isset( $attr['cid'] ) ? ( $attr['cid'][0] == '$' ? $attr['cid']
            : "'{$attr['cid']}'" ) : 0;
        //当前栏目的class样式
        $class = isset( $attr['class'] ) ? $attr['class'] : '';

        $hide = isset($attr['hide']) ? ( $attr['hide'][0] == '$' ? $attr['hide']
            : "'{$attr['hide']}'" ) : '1';

        $name = isset($attr['name']) ? $attr['name'] : '$m';
        $php = <<<str
<?php
    \$type=strtolower(trim('$type'));
    \$cid=$cid;
    \$column = load::sys_class('label', 'new')->get('column');

    unset(\$result);
    switch (\$type) {
            case 'son':
                \$result = \$column->get_column_son(\$cid);
                break;
            case 'current':
                \$result[0] = \$column->get_column_id(\$cid);
                break;
            case 'head':
                \$result = \$column->get_column_head();
                break;
            case 'foot':
                \$result = \$column->get_column_foot();
                break;
            default:
                \$result[0] = \$column->get_column_id(\$cid);
                break;
        }
    \$sub = count(\$result);
    foreach(\$result as \$index=>\$m):
        \$hides = $hide;
        \$hide = explode("|",\$hides);
        \$m['_index']= \$index;
        if(\$data['classnow']==\$m['id'] || \$data['class1']==\$m['id'] || \$data['class2']==\$m['id']){
            \$m['class']="$class";
        }else{
            \$m['class'] = '';
        }
        if(in_array(\$m['name'],\$hide)){
            unset(\$m['id']);
            unset(\$m['class']);
            \$m['hide'] = \$hide;
            \$m['sub'] = 0;
        }


        if(substr(trim(\$m['icon']),0,1) == 'm' || substr(trim(\$m['icon']),0,1) == ''){
            \$m['icon'] = 'icon fa-pencil-square-o '.\$m['icon'];
        }
        \$m['urlnew'] = \$m['new_windows'] ? "target='_blank'" :"target='_self'";
        \$m['urlnew'] = \$m['nofollow'] ? \$m['urlnew']." rel='nofollow'" :\$m['urlnew'];
        \$m['_first']=\$index==0 ? true:false;
        \$m['_last']=\$index==(count(\$result)-1)?true:false;
        \$$name = \$m;
?>
str;
        $php .= $content;
        $php .= '<?php endforeach;?>';
        return $php;

    }


    public function _list( $attr, $content ) {
        global $_M;
        $module = isset( $attr['module'] ) ? $attr['module'] : "";
        $cid = isset( $attr['cid'] ) ? ( $attr['cid'][0] == '$' ? $attr['cid']
            : "'{$attr['cid']}'" ) : 0;
        $order = isset($attr['order']) ? $attr['order'] : "'no_order asc'";
        $num = isset($attr['num']) ? $attr['num'] :10;
        $name = isset($attr['name']) ? $attr['name'] : '$v';
        $type = isset($attr['type']) ? $attr['type'][0] == '$' ? $attr['type']
            : "'{$attr['type']}'"  :'all';
        $para = isset($attr['para']) ? $attr['para'] : false;
        if(trim($type) == ''){$type = 'all';}
        $php = <<<str
<?php
    \$cid=$cid;

    \$num = $num;
    \$module = "$module";
    \$type = $type;
    \$order = $order;
    \$para = "$para";
    if(!\$module){
        if(!\$cid){
            \$value = \$m['classnow'];
        }else{
            \$value = \$cid;
        }
    }else{
        \$value = \$module;
    }

    \$result = load::sys_class('label', 'new')->get('tag')->get_list(\$value, \$num, \$type, \$order, \$para);
    \$sub = count(\$result);
    foreach(\$result as \$index=>\$v):
        \$id = \$v['id'];
        \$v['sub'] = \$sub;
        \$v['_index']= \$index;
        \$v['_first']= \$index==0 ? true:false;
        \$v['_last']=\$index==(count(\$result)-1)?true:false;
        \$$name = \$v;
?>
str;
        $php .= $content;
        $php .= '<?php endforeach;?>';
        return $php;

    }


}