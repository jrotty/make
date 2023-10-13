<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>



<section class="bg-gray-100 dark:bg-gray-800"  style="
    background: #333 url(<?php $this->options->themeUrl('img/banner.jpg'); ?>) no-repeat;
">
<div class="container mx-auto py-12">
    <div class="text-center w-full">
        <h2 class="text-3xl xl:text-4xl font-bold mt-4 text-white capitalize"><?php $this->title() ?></h2>
        <p class="text-gray-300  mt-4 text-sm"><?php $this->date('Y年m月d日'); ?></p>
    </div>
</div>
</section>



<div class="container px-4 py-6 mx-auto sm:px-6 max-w-screen-lg">




<div class="p-5 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md">
<div class="break-all markdown-section"> 
<?php
$this->content=buju($this->content);
$this->content=createCatalog($this->content);
$this->content=setshortcode($this->content);
$this->content();
?>

</div>
<div class="mt-6 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 p-4 rounded-md text-sm">
    <div>
本站未注明转载的文章均为原创，并采用 <a class="text-blue-500" target="_blank" href="https://creativecommons.org/licenses/by-nc-sa/4.0/legalcode.zh-hans">
    CC BY-NC-SA 4.0</a> 授权协议，转载请注明来源，谢谢！
    </div>
</div>

</div>


<div class="p-5 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md mt-6">
<?php $this->need('comments.php'); ?>
</div>

    </div>

    <?php $this->need('footer.php'); ?>