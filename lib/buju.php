<?php 

function buju($text){


$text = preg_replace_callback('#(<p>)?\{grid set="(.*?)"( bili="(.*?)")?\}([\s\S]*?)\{\/grid\}(<\/p>)?#','grid',$text);

$text = preg_replace_callback('#(<p>)?\{card\}([\s\S]*?)\{\/card\}(<\/p>)?#','card',$text);

$text= preg_replace('#\{div(.*?)\}#', '<div$1>', $text);
$text= preg_replace('#\{\/div\}#', '</div>', $text);
$text= preg_replace('#\{br\}#', '<br>', $text);

return $text;
}

function grid($m){
$bj=explode(",", $m[2]);
$size='media';
if(!empty($m[3])){$size=$size.' media-'.$m[4];   }
$text=$m[5];

$text=preg_replace('#<img(.*?)>#', '<div class="'.$size.'"><img$1 class="media-content object-cover w-full h-full cursor-pointer bg-gray-100 dark:bg-gray-800" loading="lazy"></div>', $text);

$text=preg_replace('#<img src="(.*?)"(.*?)>#', '<img referrerpolicy="no-referrer" src="$1"$2>', $text);

        
$class="";
if(!empty($bj[0])){$class=$class.' grid-cols-'.$bj[0];}
if(!empty($bj[1])){$class=$class.' sm:grid-cols-'.$bj[1];}
if(!empty($bj[2])){$class=$class.' md:grid-cols-'.$bj[2];}
if(!empty($bj[3])){$class=$class.' lg:grid-cols-'.$bj[3];}
if(!empty($bj[4])){$class=$class.' xl:grid-cols-'.$bj[4];}
if(!empty($bj[5])){$class=$class.' 2xl:grid-cols-'.$bj[5];}

$text= preg_replace('#<br\s*/?>#', '', $text);
$text= preg_replace('#<p>#', '', $text);
$text= preg_replace('#<\/p>#', '', $text);

$text='<div class="gridx grid'.$class.' gap-2 sm:gap-4 mb-2 sm:mb-4" data-no-instant>'.$text.'</div>';

return $text;
}

function card($m){
$text=$m[2];
$text = preg_replace('#\{title\}(.*?)\{\/title\}#','<h2 class="block mt-2 text-2xl font-semibold text-gray-800">$1</h2>',$text);
$text= preg_replace('#<p>#', '', $text);
$text= preg_replace('#<\/p>#', '', $text);

$text=preg_replace('#<div(.*?)class="(.*?)"(.*?)><img(.*?)><\/div>#', '<div$1class="$2 mb-3"><img$4></div>', $text);

$html=<<<EOF
<div class="shadow border dark:border-gray-800 p-3 pb-0 overflow-hidden bg-white dark:bg-gray-800 rounded-lg">{$text}</div>
EOF;

return $html;
}