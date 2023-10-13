<?php
/**
 * 泽泽出品，make系列0号试验品
 *
 * @package make
 * @author 泽泽社长
 * @version 20231013
 * @link https://typecho.work
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<section class="h-[20rem] 2xl:h-[28rem] bg-gray-100 dark:bg-gray-800">
<div class="container mx-auto px-4 sm:px-6 flex h-full py-6 items-center">
    <div class="max-w-xl">
        <p class="text-sky-500 uppercase tracking-wider">书写</p>
        <h2 class="text-3xl xl:text-4xl font-bold mt-4 text-gray-800 dark:text-white capitalize">记录生活创作内容</h2>
        <p class="text-gray-500  mt-4 text-lg">书写的热忱，大多也就那么几年，希望能在这里留下点痕迹</p>
    </div>
</div>
</section>





<div class="container px-4 py-6 mx-auto sm:px-6">
    <div class="font-mono grid grid-cols-12 gap-4 mt-6">

        <div class="col-span-12 sm:col-span-2">
        <div class="sticky top-16 p-5 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md">
                <?php \Widget\Metas\Category\Rows::alloc()->to($cates); ?>
                <?php while ($cates->next()): ?>
                <a href="<?php $cates->permalink(); ?>"
                    class="sm:block p-1 my-1 hover:bg-gray-200 dark:hover:bg-gray-600<?php if($this->is('category', $cates->slug)): ?> text-blue<?php endif; ?>""><?php $cates->name(); ?><span class="text-gray-300 dark:text-gray-500">x</span><?php $cates->count(); ?></a>
<?php endwhile; ?>
</div>
</div>

<div class=" col-span-12 sm:col-span-10">
<div class="p-5 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md">
                    <?php while ($this->next()): ?>
                    <div class="p-1 my-1 border-b hover:bg-gray-200 dark:hover:bg-gray-600">
                        <a href="<?php $this->permalink() ?>" class="flex justify-between">
                            <span class="line-1"><?php $this->title() ?></span>

                            <span class=""><?php $this->date('Y-m-d') ?></span>
                        </a>
                    </div>
                    <?php endwhile; ?>
            </div>



            <div class="flex items-center justify-between my-5">

<?php 
$pattern = '/\<a.*?\shref\=\"(.*?)\"[^>]*>/i';
ob_start();
$this->pageLink('下一页','next');
$nextlink = ob_get_clean();
$t=preg_match_all($pattern, $nextlink, $nextlink);
if($t){
$nextlink=$nextlink[1][0];
}else{
$nextlink=false;
}
?>
<?php 
ob_start();
$this->pageLink('上一页');
$prevlink = ob_get_clean();
$t=preg_match_all($pattern, $prevlink, $prevlink);
if($t){
$prevlink=$prevlink[1][0];
}else{
$prevlink=false;
}

?>

<?php if($prevlink): ?>
    <a href="<?php echo $prevlink; ?>" class="shadow-md px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
        <div class="flex items-center -mx-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>

            <span class="mx-1">
                上一页
            </span>
        </div>
    </a>
<?php else: ?>
<div></div>
<?php endif; ?>
<?php if($nextlink): ?>
    <a href="<?php echo $nextlink; ?>" class="shadow-md px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
        <div class="flex items-center -mx-1">
            <span class="mx-1">
                下一页
            </span>

            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </div>
    </a>
<?php endif; ?>

</div>


        </div>
</div>



    </div>

    <?php $this->need('footer.php'); ?>