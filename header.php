<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!doctype html>
<html lang="zh-CN" x-data="{search:false,menu:false,dark:<?php if(isset($_COOKIE['dark'])&&$_COOKIE['dark']=='dark'){echo 'true';}else{echo 'false';} ?>}" :class="{'dark':dark}" class="<?php if(isset($_COOKIE['dark'])&&$_COOKIE['dark']=='dark'){echo 'dark';} ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,user-scalable=no,viewport-fit=cover,initial-scale=1">
  <title><?php if($this->_currentPage>1) echo '第'.$this->_currentPage.'页 - '; ?>
<?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?><?php if($this->options->subtitle&&$this->is('index')){echo ' - '.$this->options->subtitle;} ?></title>

<link rel="apple-touch-icon" href="<?php $this->options->themeUrl('img/logo.svg'); ?>">
<link rel="icon" href="<?php $this->options->themeUrl('img/logo.svg'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css?11'); ?>">
    
<!--<script src="https://cdn.tailwindcss.com"></script>
     <script>
tailwind.config = {
  darkMode: 'class',
}
</script>-->
     <link href="<?php $this->options->themeUrl('src/output.css?20231013'); ?>" rel="stylesheet">
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('generator=&template=&commentReply='); ?>
</head>

<body class="bg-gray-50 dark:bg-gray-900" :class="{'overflow-hidden':search}">
<main class="relative flex flex-col min-h-screen">
<header class="bg-white dark:bg-gray-950 sticky inset-x-0 top-0 z-40 w-full">
<?php $this->need('navbars/nav1.php'); ?>
</header>
<div class="flex-1">