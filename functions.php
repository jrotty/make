<?php

define("rooturl",Helper::options()->rootUrl.'/');//获取首页地址
define("thename",Helper::options()->theme);//定义模板名字
define("theurl",Helper::options()->rootUrl.__TYPECHO_THEME_DIR__ . '/' . Helper::options()->theme.'/');//多域名跨域问题解决方案

include("lib/shortcode.php");
include("lib/buju.php");


function themeConfig($form)
{
$subtitle = new Typecho_Widget_Helper_Form_Element_Text('subtitle', NULL,NULL, _t('副标题'), _t('据说填写了有利于seo'));
$form->addInput($subtitle); 
}


function themeInit($archive)
{
// 强制用户文章最新评论显示在文章首页
 Helper::options()->commentsPageDisplay = 'first';
// 将较新的评论显示在前面
 Helper::options()->commentsOrder= 'DESC';
// 突破评论回复楼层限制
 Helper::options()->commentsMaxNestingLevels = 999;
 
 Helper::options()->commentsAntiSpam = false;
}
//评论@函数
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
                                 ->where('coid = ?', $coid));
    $parent = $prow['parent'];
    if (!empty($parent)) {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
if(!empty($arow['author'])){ $author = $arow['author'];
        $href   = '<a href="#comment-' . $parent . '">@' . $author . '</a> ';
        return $href;
}else { return '';}
    } else {
        return '';
    }
}


//归档函数
function archives($widget, $excerpt = false) {
    $db = Typecho_Db::get();
    $rows = $db->fetchAll($db->select()
                        ->from('table.contents')
                        ->order('table.contents.created', Typecho_Db::SORT_DESC)
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.created < ?', time()));
    $stat = array();
    foreach ($rows as $row) {
        $row = $widget->filter($row);
        $arr = array(
                        'title' => $row['title'],
                        'permalink' => $row['permalink'],
                        'commentsNum' => $row['commentsNum'],
                        'views' => $row['views'],
                    );
        if($excerpt) {
            $arr['excerpt'] = substr($row['content'], 30);
        }
        $stat[date('Y', $row['created'])][$row['created']] = $arr;
    }
    return $stat;
}

//文章缩略图函数
function showThumbnail($widget,$type=0)
{ 
    $random = theurl.'img/mr.jpg';//这里时默认缩略图
    $pattern = '/\<img.*?\ssrc\=\"(.*?)\"[^>]*>/i';
    $attach = $widget->widget('Widget_Contents_Attachment_Related@' . $widget->cid . '-' . uniqid(), array(
            'parentId'  => $widget->cid,'limit'     => 1,'offset'    => 0))->attachment;
    $t=preg_match_all($pattern, $widget->content, $thumbUrl);
    if(!$t){
    $pattern = '/\<a.*?data\-xurl\=\"(.*?)\"[^>]*>/i';
    $t=preg_match_all($pattern, $widget->content, $thumbUrl);
    }
   $img=$random;
    
if($widget->fields->img){$img=$widget->fields->img;}
elseif ($t && strpos($thumbUrl[1][0],'icon.png') == false && strpos($thumbUrl[1][0],'alipay') == false && strpos($thumbUrl[1][0],'wechat') == false) {$img = $thumbUrl[1][0];}//从文章中获取封面
elseif($widget->fields->thumb){$img=$widget->fields->thumb;}//自定义字段设置封面
  elseif (@$attach->isImage) {$img=$attach->url;}//从附件中获取封面

  if($type==0){
  if($img==$random){echo $img;}else{echo $img.Helper::options()->thumbnail;}//输出封面图
  }else{
   if($img==$random){return $img;}else{return $img.Helper::options()->thumbnail;}//输出封面图     
  }
  
}

//自定义缩略内容
function excerpt($obj,int $length = 100, string $trim = '...',$type='echo')
    {
    $text=$obj->excerpt;
    $text=preg_replace('#\{video(.*?)?}(.*?){\/video}#', '', $text);
    $text=preg_replace('#\{login}(.*?){\/login}#', '', $text);
    $text=preg_replace('#\{(.*?)\}#', '', $text);
    $text=preg_replace('#　#', '', $text);

    if($type=='echo'){
    echo Typecho_Common::subStr(strip_tags($text), 0, $length, $trim);
    }else{
    return Typecho_Common::subStr(strip_tags($text), 0, $length, $trim);
    }
}
//文章阅读数
function get_post_view($archive,$r=0)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')->page(1,1)))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
       if($r==0){ echo 1;}
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
if($r==0){
    echo $row['views'];
}else{
    return $row['views'];
}
}
?>