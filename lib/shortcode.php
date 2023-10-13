<?php 

function setshortcode($con,$type='post'){
$user = Typecho_Widget::widget('Widget_User'); 
$con=preg_replace('#no-zoom="true"#', 'no-view', $con);

$con=preg_replace('#<li>\[[x|X]\](.*?)<\/li>#', '<li class="flex items-center list-none !mt-1"><svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7823"><path d="M864 128H160c-17.6 0-32 14.4-32 32v704c0 17.6 14.4 32 32 32h704c17.6 0 32-14.4 32-32V160c0-17.6-14.4-32-32-32zM428 718.4l-45.6 45.6-45.6-45.6-116-117.6 45.6-45.6L383.2 672l367.2-367.2 45.6 45.6-368 368z" p-id="7824"></path></svg>$1</li>', $con);
$con=preg_replace('#<li>\[ \](.*?)<\/li>#', '<li class="flex items-center list-none !mt-1"><svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7793"><path d="M832 192v640H192V192h640m32-64H160c-17.6 0-32 14.4-32 32v704c0 17.6 14.4 32 32 32h704c17.6 0 32-14.4 32-32V160c0-17.6-14.4-32-32-32z" p-id="7794"></path></svg>️$1</li>', $con);

// 文章内链接新窗口打开
$con=preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" class=\"text-sky-500\" target=\"_blank\" rel=\"nofollow\" data-ajax=\"false\">", $con);
//表格样式追加class
$con=preg_replace("/<table(.*?)>/","<div class=\"mb-5 overflow-x-auto\"><table class=\"table-auto w-full whitespace-nowrap\"$1>", $con);
$con=preg_replace("/<thead(.*?)>/","<xhead$1>", $con);

$con=preg_replace("/<th(.*?)>\{(.*?)\}<\/th>/","<th$1 style=\"width:$2%;padding:0;border:0;\"></th>", $con);

$con=preg_replace("/<th(.*?)>\{(.*?)\}(.*?)<\/th>/","<th$1 style=\"width:$2%\">$3</th>", $con);

$con=preg_replace("/<th(.*?)>/","<th class=\"border border-gray-200 dark:border-gray-700 p-2\"$1>", $con);
$con=preg_replace("/<td(.*?)>/","<td class=\"border border-gray-200 dark:border-gray-700 p-2\"$1>", $con);
$con=preg_replace("/<xhead(.*?)>/","<thead$1 class=\"w-full bg-gray-100 dark:bg-gray-800\">", $con);
$con=preg_replace("/<\/table>/","</table></div>", $con);

//符号转译
$con = preg_replace_callback('#<code(.*?)>([\s\S]*?)<\/code>#','code',$con);
//按钮短代码
$con = preg_replace_callback('#(<br\s*/?>)?\{(btn|button) (url|href)="(.*?)"( type="(.*?)")?\}(.*?)\{\/(btn|button)\}(<br\s*/?>)?#','btn',$con);

$con=preg_replace('#(<p>)?\{center\}(.*?)\{\/center\}(<\/p>)?#', '<center class="mb-3">$2</center>', $con); 
$con=preg_replace('#(<p>)?\{right\}(.*?)\{\/right\}(<\/p>)?#', '<div class="mb-3 text-right">$2</div>', $con); 

//登录可见
if($user->hasLogin()){
$con=preg_replace('#\{login\}(.*?)\{\/login\}#', '$1', $con); 
}else{
$con=preg_replace('#\{login\}(.*?)\{\/login\}#', '{tip type="error"}抱歉，隐藏内容
<a class="text-sky-500" data-ajax="false" href="'.Helper::options()->adminUrl.'" target="_blank">登陆</a> 后可见{/tip}', $con); 
}

// 视频比例优化
$con=preg_replace('/<xiframe(.*?)<\/xiframe>/i', '<div class="media media-16x9 mb-5"><iframe$1</iframe></div>', $con);

//允许使用span标签，支持使用class

$con=preg_replace('#\{(red|green|blue|yellow|purple)}(.*?){\/(red|green|blue|yellow|purple)}#', '{span class="text-$1-600"}$2{/span}', $con);
$con=preg_replace('#\~(.*?)\~#', '{span class="underline"}$1{/span}', $con);
$con=preg_replace('#\-\+(.*?)\-\+#', '{span class="underline decoration-double"}$1{/span}', $con);

$con=preg_replace('#\{span class="(.*?)"\}#', '<span class="$1">', $con);
$con=preg_replace('#\{\/span\}#', '</span>', $con);

//下载按钮
$con = preg_replace('#\{file (url|href)="(.*?)"( type="(.*?)")?\}(.*?)\{\/file\}#','<div class="flex items-center w-full rounded bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-3 py-2.5">
  <div class="flex-grow">
    <a href="$2" data-ajax="false" target="_blank" class="flex items-center"><svg class="w-8 h-8 inline dark:text-blue-400 mr-3" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="22725"><path d="M678.64064 514.00704a168.448 168.448 0 1 0-168.448 167.7056 168.06912 168.06912 0 0 0 168.448-167.7056z" fill="#F4CA1C" p-id="22726"></path><path d="M983.04 603.41248a242.48832 242.48832 0 0 0-280.39168-238.40768 253.32224 253.32224 0 0 0-446.42816-77.824 249.13408 249.13408 0 0 0-48.95744 153.38496A203.39712 203.39712 0 0 0 240.18944 844.8h527.77472a31.98976 31.98976 0 0 0 14.75072-3.71712A242.03776 242.03776 0 0 0 983.04 603.41248z m-242.432 177.30048H240.18944a139.38688 139.38688 0 1 1 0-278.76864 31.96928 31.96928 0 0 0 8.704-1.34144 31.96416 31.96416 0 0 0 24.84736-35.99872 187.81184 187.81184 0 0 1 157.74208-214.016A188.46208 188.46208 0 0 1 641.024 383.42656a241.62816 241.62816 0 0 0-142.848 219.98592 32.1792 32.1792 0 0 0 64.3584 0 178.06848 178.06848 0 1 1 178.0736 177.30048z" fill="#595BB3" p-id="22727"></path></svg><div class="flex flex-col font-mono"><div class="text-gray-900 font-medium dark:text-white text-sm line-1">$5</div></div></a>
  </div>
  <div class="flex-none ml-3">
    <a href="$2" data-ajax="false" target="_blank" class="flex shadow text-white p-2 bg-indigo-600 rounded-full hover:bg-indigo-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
</a>
  </div>
</div>
',$con);

//复制文本
$con = preg_replace('#\{copy text="(.*?)"(.*?)?\}(.*?){\/copy\}#','<button data-clipboard-action="copy" data-clipboard-text="$1" class="copybtn">$3</button>',$con);

//bilibili小窗
$con = preg_replace('#(<p>)?\{bilibili (av|bv)="(.*?)"\}(<\/p>)?#','<iframe src="https://api.paugram.com/bili?$2=$3" style="height:162px;" class="bg-white shadow border rounded-lg dark:bg-gray-300 dark:border-gray-700"></iframe>',$con);

//相册排版短代码
$con = preg_replace_callback('#(<p>)?\{photo(.*?)}([\s\S]*?)\{\/photo\}(<\/p>)?#','photo',$con);
//折叠
$con = preg_replace_callback('#\{collapse title="(.*?)"( show="(true|false)?")?\}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/collapse\}#','collapse',$con);


//提示标签
$con = preg_replace_callback('#\{tip( type="(.*?)")?( title="(.*?)")?\}([\s\S]*?)\{\/tip\}#','tip',$con);

//tab标签短代码
$con = preg_replace_callback('#(<p>)?\{tabs( selected="(.*?)")?\}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/tabs\}(<\/p>)?#','tabitems',$con);
$con = preg_replace('#\{tabs selected="(.*?)"\}([\s\S]*?)\{\/tabs\}#','<div class="tabs rounded shadow bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-2 mb-5" x-data="{ tab: \'$1\' }">$2</div>',$con);

//调用站内文章
$con = preg_replace_callback('#(<p>)?\{post cid="(.*?)"\}(<\/p>)?#','post',$con);

//时间轴
$con = preg_replace_callback('#(<p>)?\{timeline}(<p>)?(<br>)?(.*?)(<br>)?(<p>)?\{\/timeline\}(<\/p>)?#','timeline',$con);
//链接模块
$con = preg_replace_callback('#(<p>)?\{link}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/link\}(<\/p>)?#','links',$con);

//影视卡片
$con = preg_replace_callback('#(<p>)?\{video( title="(.*?)")?( pic="(.*?)")?\}(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)?\{\/video\}(<\/p>)?#','video',$con);

if($type=='post'){
if(!empty(Helper::options()->tools)&&in_array('postindex', Helper::options()->tools)){
   $con = preg_replace('#(<p>)?\{postindex\}(<\/p>)?#','',$con);
   $con = $con.'{postindex}';
}
   $con = preg_replace_callback('#(<p>)?\{postindex\}(<\/p>)?#','getCatalog',$con); 
}


if (!empty(Helper::options()->tools) && in_array('nocaiji', Helper::options()->tools)){
// 使用正则表达式匹配每个数字
$pattern = '/\d(?![^<]*>)/';
// 使用 preg_replace 函数替换每个匹配项
$con = preg_replace($pattern, '<x class="num$0"></x>', $con);
$patterna = '/[a-z](?![^<]*>)/';
$con = preg_replace($patterna, '<x class="az-$0"></x>', $con);

$con = preg_replace_callback('#<code(.*?)>([\s\S]*?)<\/code>#','relife',$con);
$con = preg_replace_callback('#<script(.*?)>([\s\S]*?)<\/script>#','relifex',$con);
$con = preg_replace_callback('#<style(.*?)>([\s\S]*?)<\/style>#','relifey',$con);
}

return $con;
}


function createCatalog($obj) {    //为文章标题添加锚点
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h([1-6])>/i', function($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count ++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);//存储目录信息，内容，登记与数
        return '<h'.$obj[1].$obj[2].'>'.$obj[3].'<div id="cl-'.$catalog_count.'" class="h-24 -mt-24 block invisible"></div></h'.$obj[1].'>';
    }, $obj);
    return $obj;
}
function getCatalog() {    //输出文章目录容器
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul class="!m-0">'."\n";
        $prev_depth = '';
        $to_depth = 0;
        foreach($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>'."\n";
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul class="!m-0">'."\n";
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i=0; $i<$to_depth2; $i++) {
                            $index .= '</li>'."\n".'</ul>'."\n";
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li class="list-none"><a href="#cl-'.$catalog_item['count'].'" class="!text-gray-900 dark:!text-gray-200 text-left block px-8 py-1 hover:bg-slate-100 dark:hover:bg-slate-600/30 line-1" data-no-instant>'.$catalog_item['text'].'</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i=0; $i<=$to_depth; $i++) {
            $index .= '</li>'."\n".'</ul>'."\n";
        }
    $index = '<div id="postindex" class="transition-all max-w-xs fixed inset-y-0 right-0 bg-gray-50 translate-x-full shadow-md dark:bg-gray-800 dark:text-white z-40" x-data="{indexopen:false}" :class="{\'translate-x-full\':!indexopen}">'."\n".'<div id="toc" class="overflow-y-auto h-full">'."\n".'<div class="mt-20 mb-5 text-xl font-semibold text-gray-800 dark:text-white px-8">文章目录</div>'."\n".$index.'</div>'."\n".'<div class="absolute -left-8 inset-y-0 flex items-center"><button @click="indexopen=!indexopen" class="transition-all rounded-full h-16 w-16 bg-white border border-gray-100 dark:border-gray-800 shadow-md dark:bg-gray-800 flex items-center p-2" :class="{\'justify-center\':indexopen}"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-show="!indexopen"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-show="indexopen"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></button></div></div>'."\n";
    }
    return $index;
}


	
//转译避免代码块与短代码嵌套冲突	
function code($m){
$con = str_replace('/','&#47;',$m[2]); 
$con = str_replace('{','&#123;',$con); 
$con = str_replace('~','&#126;',$con); 
$con = str_replace('-','&#45;',$con); 
return '<code>'.$con.'</code>';    
}
function relife($m){
    $con=preg_replace('/<x class="num(.*?)"><\/x>/i','$1', $m[2]);
    $con=preg_replace('/<x class="az-(.*?)"><\/x>/i','$1', $con);
return '<code>'.$con.'</code>';  
}
function relifex($m){
    $con=preg_replace('/<x class="num(.*?)"><\/x>/i','$1', $m[2]);
    $con=preg_replace('/<x class="az-(.*?)"><\/x>/i','$1', $con);
return '<script'.$m[1].'>'.$con.'</script>';  
}
function relifey($m){
    $con=preg_replace('/<x class="num(.*?)"><\/x>/i','$1', $m[2]);
    $con=preg_replace('/<x class="az-(.*?)"><\/x>/i','$1', $con);
return '<style>'.$con.'</style>';  
}

function btn($m){
    
if(empty($m[6])){$m[6]='blue';}  
    
return '<a href="'.$m[4].'" data-ajax="false" class="shortcode inline-block inline-flex mx-1 justify-center rounded border border-transparent shadow-sm px-4 py-2 bg-'.$m[6].'-600 text-base font-medium text-white hover:bg-'.$m[6].'-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-'.$m[6].'-500 sm:w-auto sm:text-sm mb-2" target="_blank"><span class="text-gray-100">'.$m[7].'</span></a>';    
    
}


function timeline($m){
  $con=$m[4];$n=1;
  
  
  $con = preg_replace('#<p><strong>(.*?)<\/strong>(<br>)?(.*?)<\/p>#','<div class="flex relative pb-5"><div class="h-full w-4 absolute inset-0 flex items-center justify-center"><div class="h-full w-1 bg-gray-200 dark:bg-gray-500 pointer-events-none"></div></div><div class="flex-shrink-0 w-4 h-4 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative"></div><div class="flex-grow pl-4"><div class="font-semibold text-base text-gray-900 dark:text-gray-200 mb-1 tracking-wider">$1</div><div>$3</div></div></div>',$con);
  
  $con = preg_replace('#(<p>)?{p}(<br>)?<strong>(.*?)<\/strong>(<br>)?(.*?)(<br>)?{\/p}(<\/p>)?#','<div class="flex relative pb-5"><div class="h-full w-4 absolute inset-0 flex items-center justify-center"><div class="h-full w-1 bg-gray-200 dark:bg-gray-500 pointer-events-none"></div></div><div class="flex-shrink-0 w-4 h-4 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative"></div><div class="flex-grow pl-4"><div class="font-semibold text-base text-gray-900 dark:text-gray-200 mb-1 tracking-wider">$3</div><div>$5</div></div></div>',$con);  
   
    return '<div class="timeline">'.$con.'<div class="flex relative pb-5"><div class="flex-shrink-0 w-4 h-4 rounded-full bg-red-500 inline-flex items-center justify-center text-white relative"></div></div></div>';
}

function post($m){
$cid=$m[2];
$f=Typecho_Widget::widget('Widget_Archive@'.$cid,'pageSize=1&type=post', 'cid='.$cid);
if($f->have()){
if($f->categories){
            foreach ($f->categories as $category) {
                $result[] = $category['name'];
            }
            $cate=implode(' , ', $result);
    }else{$cate='none';}
    
return '<a href="'.$f->permalink.'" class="shadow post-item flex rounded mb-5 overflow-hidden p-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-left">
<div class="media media-3x2 w-1/3 md:w-1/4 lg:w-1/3 rounded overflow-hidden" style="max-width: 12.5rem;">
        <img src="'.showThumbnail($f,1).'" class="media-content h-full w-full object-cover" referrerpolicy="no-referrer" no-view>
    </div>
    <div class="flex flex-col w-full text-gray-700 pl-2 sm:pl-3.5 md:pl-4 py-0.5 dark:text-white">
    <div class="flex-1">
    <div class="text-lg xl:text-xl font-semibold line-2">'.$f->title.'</div>
     <div class="hidden md:block"><div class="mt-2 text-sm xl:text-base text-gray-500 dark:text-gray-200 line-2">'.excerpt($f,150, '...','return').'</div></div>
   </div>
   <div class="flex items-center justify-between w-full text-xs">
      <div class="flex items-center mr-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"></path></svg>'.$cate.'</div>
      <div class="flex items-center">
    <span class="items-center mr-2 hidden sm:flex">'.date('Y年m月d日' , $f->created).'</span>
    <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-2 w-3.5 h-3.5 mr-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path> <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path> </svg>'.get_post_view($f,1).'</span>
      </div>
   </div>
 </div></a>';    
}else{
    return '<div class="tips rounded w-full text-white bg-red-500"><div class="container flex items-center px-6 py-4 mx-auto">
<div><svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg></div><div class="mx-3">引用的文章不存在或已被删除</div></div></div>';
}
    
    
}

function collapse($m){$style='p-4';
if(empty($m[3])){$m[3]='false';}
if($m[3]=='false'){$style='max-h-0 py-0 px-4 overflow-y-hidden';}
$con = '<div x-data="{ collapseopen: '.$m[3].' }" class="rounded overflow-hidden border border-gray-300 dark:border-gray-700">
    <div @click="collapseopen=!collapseopen"class="flex bg-gray-100 justify-between text-sm dark:bg-gray-700 cursor-pointer p-4"><div>'.$m[1].'</div><div class="transform duration-300" :class="{\'rotate-180\':collapseopen}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-3.5 h-3.5">
  <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"></path>
</svg></div></div><div class="transition-all '.$style.'"
        :class="{\'max-h-0 py-0 px-4 overflow-y-hidden\':!collapseopen,\'p-4\':collapseopen}"
    >'.$m[5].'</div>
</div>';

return $con;
    
}

function tip($m){
$type=$m[2];
$title=$m[4];
$con=$m[5];
if(empty($type)){$type="info";}
if(!empty($title)){$title='<span class="font-semibold text-blue-500 dark:text-blue-400">'.$title.'</span>';}
switch ($type) {
case "info":
   $color="bg-blue-500";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>';
    break;
case "warn":
case "warning":
   $color="bg-yellow-400";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>';
    break;
case "danger":
case "error":
   $color="bg-red-500";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                </svg>';
    break;
case "success":
   $color="bg-green-500";$icon='<svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path>
                </svg>';
    break;
}

$con='<div class="tips rounded w-full text-white '.$color.'"><div class="container flex items-center px-6 py-4 mx-auto">
<div>'.$icon.'</div><div class="mx-3">'.$con.'</div></div></div>';

return $con;    
}
	

function links($m){
$con = preg_replace('#(<br\s*/?>)?{(.*?),(.*?),<a.*?>(.*?)<\/a>(,)?}(<br\s*/?>)?#','<div class="group lg:flex items-center p-4 bg-white rounded border border-gray-100 text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600  transition-all duration-300 transform shadow hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden"><a href="$4" title="$2" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0"><img class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" src="'.api().'$4"></a><div class="w-full mt-2 lg:mt-0 lg:pl-4"><div class="text-base font-medium line-1 transition-all duration-300 transform dark:text-gray-50 group-hover:text-red-500 dark:hover:text-red-500"><a href="$4" target="_blank" data-ajax="false" rel="noopener" title="$2" class="block">$2</a></div><div class="text-xs text-gray-400 line-1 mt-1">$3</div></div>
</div>',$m[3]);
$con = preg_replace('#(<br\s*/?>)?{(.*?),(.*?),<a.*?>(.*?)<\/a>,(.*?)}(<br\s*/?>)?#','<div class="group lg:flex items-center p-4 bg-white rounded border border-gray-100 text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600  transition-all duration-300 transform shadow hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden"><a href="$4" title="$2" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0"><img class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" 
src="$5"></a><div class="w-full mt-2 lg:mt-0 lg:pl-4"><div class="text-base font-medium line-1 transition-all duration-300 transform dark:text-gray-50 group-hover:text-red-500 dark:hover:text-red-500"><a href="$4" target="_blank" data-ajax="false" rel="noopener" title="$2" class="block">$2</a></div><div class="text-xs text-gray-400 line-1 mt-1">$3</div></div>
</div>',$con);

$con = preg_replace('#(<br\s*/?>)?{(.*?),(.*?),<a.*?>(.*?)<\/a>,<a.*?>(.*?)<\/a>}(<br\s*/?>)?#','<div class="group lg:flex items-center p-4 bg-white rounded border border-gray-100 text-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600  transition-all duration-300 transform shadow hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden"><a href="$4" title="$2" target="_blank" data-ajax="false" rel="noopener" class="flex flex-shrink-0"><img class="w-11 h-11 lg:w-14 lg:h-14 object-cover rounded-full scrollLoading" src="$5"></a><div class="w-full mt-2 lg:mt-0 lg:pl-4"><div class="text-base font-medium line-1 transition-all duration-300 transform dark:text-gray-50 group-hover:text-red-500 dark:hover:text-red-500"><a href="$4" target="_blank" data-ajax="false" rel="noopener" title="$2" class="block">$2</a></div><div class="text-xs text-gray-400 line-1 mt-1">$3</div></div>
</div>',$con);

$con='<div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-3">'.$con.'</div>';
return $con;    
    
}



function video($m){
  $title='';$juji='';$info=array();$length=0;$pic=$m[5];
  if(strpos($m[7],'(') !== false){//内部包含小括号则为多线路模式
  $xianlu='';
  $juji = preg_replace_callback('#(<p>)?(<br\s*/?>)?\((.*?)\)(<br\s*/?>)?\{(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)\}(<br\s*/?>)?(<\/p>)?#','xianlu',$m[7]);
  preg_match_all( "/\((.*?)\)/", $m[7], $name);
  foreach ($name[1] as $val){
      $xianlu=$xianlu.'<button class="block" @click="xianlu=\''.$val.'\'">'.$val.'</button>';
  }
  
  
  $juji='<div class="m-2" x-data="{xianlu:\''.$name[1][0].'\',qiehuan:false}"><div class="relative text-sky-500 text-sm text-right mb-2"><button @click="qiehuan=!qiehuan" @click.outside="qiehuan=false"><span class="mr-1">切换线路</span><i class="sui-forward-down"></i></button><template x-if="qiehuan"><div class="absolute mt-1 right-0 p-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700">'.$xianlu.'</div></template></div><div class="overflow-y-auto m-2">'.$juji.'</div></div>';
  $vurl=preg_replace('#(.*?)\{(<br\s*/?>)?([\s\S]*?)(<br\s*/?>)\}(.*?)#','$3',$m[7]);
  $info=qiege($vurl,$pic);$length=count($info);
  $info[0]['jishu']=$name[1][0].$info[0]['jishu'];
  }else{
    if(strpos($m[7],'$') === false){$m[7]='占位$'.$m[7];}
    $info=qiege($m[7],$pic);$length=count($info);
if($length>1){
$k=0;
foreach($info as $ji) {$k++;
$juji=$juji.'<button x-ref="jinum'.$k.'" @click="videourl=\''.$ji['url'].'\';ji=\''.$ji['jishu'].'\';$dispatch(\'createiframe\');" class="shortcode inline-flex mx-1 justify-center px-3.5 py-2 text-sm rounded text-white mb-2" :class="{\'bg-blue-600\':ji==\''.$ji['jishu'].'\',\'bg-gray-600\':ji!=\''.$ji['jishu'].'\'}"><span class="text-gray-100">'.$ji['jishu'].'</span></button>';
}
$juji='<template x-if="videourl">
<div class="overflow-y-auto m-2 max-h-72">'.$juji.'<div x-init="$refs.jinum1.click();" class="hidden"></div></div></template>
';
}
}

$player='<div class="media media-16x9" x-html="html"></div>';

if(!empty($m[3])){
$title=$m[3];  
}
if(!empty($title)){
$title='<div class="m-2 text-base font-semibold text-gray-800 border-b-2 border-gray-200 py-2 flex items-center dark:text-white dark:border-gray-700"><svg class="w-5 h-5 mr-1 inline text-sky-500" viewBox="0 0 20 20" fill="currentColor"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
</svg>'.$title.'</div>';
}

if($length>1){
$buju='
<div class="mb-3 border dark:border-gray-700 dark:bg-gray-800" x-data="{videourl:\''.$info[0]['url'].'\',ji:\''.$info[0]['jishu'].'\',html:false}"
@createiframe="html=false;
html=\'&lt;iframe src=&quot;\'+videourl+\'&quot; scrolling=&quot;no&quot; border=&quot;0&quot; frameborder=&quot;no&quot; framespacing=&quot;0&quot; allowfullscreen=&quot;true&quot;&gt;&lt;/iframe&gt;\';">
<div>'.$player.'</div>
<div>'.$title.$juji.'</div>
</div>
';
}else{
$buju='
<div class="mb-3 border dark:border-gray-700 dark:bg-gray-800" x-data="{videourl:\''.$info[0]['url'].'\',ji:\''.$info[0]['jishu'].'\',html:false}"
@createiframe="html=false;
html=\'&lt;iframe src=&quot;\'+videourl+\'&quot; scrolling=&quot;no&quot; border=&quot;0&quot; frameborder=&quot;no&quot; framespacing=&quot;0&quot; allowfullscreen=&quot;true&quot;&gt;&lt;/iframe&gt;\';">
<div x-init="$dispatch(\'createiframe\');">'.$player.'</div>
<div>'.$title.$juji.'</div>
</div>
';   
    
    
}


    return $buju;
}




function xianlu($m){
   $info=qiege($m[6]);
   $name=$m[3];
   $juji='';
 $k=0;
foreach($info as $ji) {$k++;
$juji=$juji.'<button  x-ref="jinum'.$k.'" @click="videourl=\''.$ji['url'].'\';ji=\''.$name.$ji['jishu'].'\';$dispatch(\'createiframe\');" class="shortcode inline-flex mx-1 justify-center px-3.5 py-2 text-sm rounded text-white mb-2" :class="{\'bg-blue-600\':ji==\''.$name.$ji['jishu'].'\',\'bg-gray-600\':ji!=\''.$name.$ji['jishu'].'\'}"><span class="text-gray-100">'.$ji['jishu'].'</span></button>';
}
$juji='<template x-if="xianlu==\''.$name.'\'"><div>'.$juji.'<div x-init="$refs.jinum1.click();" class="hidden"></div></div></template>';

   return $juji;
}


function qiege($txt,$pic=''){
if(!empty($txt)){
$info=array();
$string_arr = explode("<br>", $txt);
$long=count($string_arr);
for($i=0;$i<$long;$i++){
$jishu=@explode("$",$string_arr[$i])[0];
$url=@explode("$",$string_arr[$i])[1];
$url=preg_replace('/<a(.*?)>(.*?)<\/a>/i', '$2', $url);
if(strpos($url,'www.bilibili.com/video') !== false){//调用哔哩哔哩iframe
    $bv=preg_replace('/(.*?)www.bilibili.com\/video\/(.*?)(\/)?/i', '$2', $url);
    $bv=str_ireplace('/', '', $bv);
    $url='https://www.bilibili.com/blackboard/html5mobileplayer.html?bvid='.$bv.'&page=1&as_wide=1&danmaku=0&hasMuteButton=1&fjw=0';
}elseif(strpos($url,'live.bilibili.com/') !== false){//哔哩哔哩直播
    $bilive=preg_replace('/(.*?)live.bilibili.com\/(.*?)(\/)?/i', '$2', $url);
    $url='//www.bilibili.com/blackboard/live/live-activity-player.html?cid='.$bilive;
}elseif(strpos($url,'www.acfun.cn/v/') !== false){//acfun
    $ac=preg_replace('/(.*?)www.acfun.cn\/v\/(.*?)(\/)?/i', '$2', $url);
    $url='//www.acfun.cn/player/'.$ac;
}elseif(strpos($url,'www.ixigua.com/') !== false){//西瓜视频
    $xg=preg_replace('/(.*?)www.ixigua.com\/(.*?)(\?)?/i', '$2', $url);
    $url='//www.ixigua.com/iframe/'.$xg.'?autoplay=0';
}elseif(strpos($url,'v.qq.com/') !== false){//腾讯视频
    $vid=preg_replace('/(.*?)v.qq.com\/x\/page\/(.*?).html/i', '$2', $url);
    $url='https://v.qq.com/txp/iframe/player.html?vid='.$vid;
}elseif(strpos($url,'v.douyu.com/') !== false){//斗鱼视频不是直播
    $vid=preg_replace('/(.*?)v.douyu.com\/show\/(.*?)(\/)?/i', '$2', $url);
    $url='https://v.douyu.com/video/videoshare/index?vid='.$vid;
}else{//调用内置播放器
        $k='';
    if (strpos($url, '{no}') !== false) {
        $k='&no=true';
        $url=str_replace("{no}","",$url);
    }
    $url=theurl.'lib/player.php?url='.$url.'&pic='.$pic.$k;
}

$info[]=array('jishu'=>$jishu,'url'=>$url);
}
}
return $info;
}
    
function tabitems($m){
$a = '';$b='';$n=1;
	preg_match_all('#\{tab name="(.*?)"\}(<br\s*/?>)?(<\/p>)?([\s\S]*?)(<br\s*/?>)?(<p>)?\{\/tab\}(<br\s*/?>)?#', $m[5], $matches);

if(empty($m[3])){
$c = 1;
}else{
$c = $m[3];   
}


for($i = 0; $i < count($matches[1]); $i++) {
//print_r($matches[1]);  

if($c==$n){
$hidden='';
}else{
$hidden=' x-cloak';    
}

$a=$a.'<button @click="tab = \''.$n.'\'" class="h-10 px-4 py-2 -mb-px text-sm text-center bg-transparent border-b-2 sm:text-base  whitespace-nowrap focus:outline-none" :class="{\'text-blue-600 border-blue-500\':tab==\''.$n.'\',\'text-gray-700 dark:text-gray-300 border-transparent\':tab!=\''.$n.'\'}">'.$matches[1][$i].'</button>';
$b = $b.'<div class="px-4 pt-4 pb-2 hidden" :class="{\'hidden\':tab!=\''.$n.'\'}">'.$matches[4][$i].'</div>';
$n++;
}



return '{tabs selected="'.$c.'"}'.'<div class="flex border-b border-gray-200 dark:border-gray-700">'.$a.'</div>'.$b.'{/tabs}';
}	

function getImg($obj) {
	preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?alt=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj, $matches);
	$atts = array();
	if(isset($matches[1][0])) {
		for($i = 0; $i < count($matches[1]); $i++) {
			$atts[] = array('name' => ' ['.($i + 1).']', 'url' => $matches[1][$i],'title' => $matches[2][$i]);
		}
    }
	return  count($atts) ? $atts : NULL;
}



function photo($m){

$imgs = getImg($m[3]);
$imgtext='';

if(!empty($imgs)){
foreach($imgs as $img) {
$imgtext=$imgtext.'<div class="w-full mb-4 2xl:mb-6"><img class="w-full rounded-lg" referrerpolicy="no-referrer" src="'.$img['url'].'"></div>';

}
}

$con='<div class="columns-2 sm:columns-3 lg:columns-4 xl:columns-5 gap-4 2xl:gap-6" data-no-instant>'.$imgtext.'</div>';
return $con;
    
}


function api($type='ico'){
$api['ico']='https://favicon.yandex.net/favicon/v2/';
return $api[$type];
}


//后台标签文本
class EchoHtml extends Typecho_Widget_Helper_Layout {
	public function __construct($html) {
		$this->html($html);
		$this->start();
		$this->end();
	}
	public function start() {
	}
	public function end() {
	}
}
?>