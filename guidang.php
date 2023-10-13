<?php 
/**
 * 文章归档
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
Typecho_Widget::widget('Widget_Stat')->to($stat);
?>








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
    
<?php $archives = archives($this); $index = 0; foreach ($archives as $year => $posts): ?>

<div class="border-2 border-gray-100 rounded-lg dark:border-gray-700" x-data="{faq:<?php if($index==0){echo 'true';}else{echo 'false';} ?>}">
    <button @click="faq=!faq" class="flex items-center justify-between w-full p-4">
        <span class="font-semibold text-xl text-gray-900 dark:text-white"><?php echo $year; $index++; ?>年</span>

        <span class="text-gray-400 bg-gray-200 rounded-full" x-show="faq">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
            </svg>
        </span>
        <span class="text-white bg-sky-500 rounded-full" x-show="!faq">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </span>
    </button>

    <hr class="border-gray-200 dark:border-gray-700" x-show="faq">

    <div class="transition-all p-4 text-base space-y-2" :class="{'max-h-0 py-0 px-5 overflow-y-hidden':!faq,'p-4':faq}">
             <?php foreach($posts as $created => $post ): ?>
             <div class="flex justify-between items-center">
                       <div class="ml-5 flex items-center"><span class="bg-sky-500 w-2 h-2 rounded-full mr-2"></span><a class="line-1" href="<?php echo $post['permalink']; ?>" ><?php echo $post['title']; ?></a>
                        </div>
                <div class="text-sm hidden sm:block"><?php echo date('m月d日',$created); ?></div>
            </div>
<?php endforeach; ?>
      </div>
</div>

<?php endforeach; ?>


</div>


<div class="p-5 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md mt-6">
<?php $this->need('comments.php'); ?>
</div>

    </div>

    <?php $this->need('footer.php'); ?>
