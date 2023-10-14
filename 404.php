<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>



<section class="bg-gray-100 dark:bg-gray-800"  style="
    background: #333 url(<?php $this->options->themeUrl('img/banner.jpg'); ?>) no-repeat;
">
<div class="container mx-auto py-12">
    <div class="text-center w-full">
        <h2 class="text-3xl xl:text-4xl font-bold mt-4 text-white capitalize">页面没找到</h2>
        <p class="text-gray-300  mt-4 text-sm">404 error</p>
    </div>
</div>
</section>





<section class="max-w-screen-lg mx-auto my-6 bg-white dark:bg-gray-900">
    <div class="container px-6 py-12 mx-auto lg:flex lg:items-center lg:gap-12">
        <div class="wf-ull lg:w-1/2">
            <p class="text-sm font-medium text-blue-500 dark:text-blue-400">404 error</p>
            <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">页面没找到</h1>
            <p class="mt-4 text-gray-500 dark:text-gray-400">你想查看的页面已被转移或删除了！</p>

            <div class="flex items-center mt-6 gap-x-3">

                <a href="<?php $this->options->siteUrl(); ?>" class="w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                    返回首页
                </a>
            </div>
        </div>

        <div class="relative w-full mt-12 lg:w-1/2 lg:mt-0">
            <img class="w-full max-w-lg lg:mx-auto" src="<?php $this->options->themeUrl('img/404.svg'); ?>" alt="">
        </div>
    </div>
</section>




    <?php $this->need('footer.php'); ?>