    <nav class="container relative flex items-center justify-between px-4 py-3 mx-auto sm:px-6" aria-label="Global">
        <div class="flex items-center justify-between w-full lg:w-auto"><a href="<?php $this->options->siteUrl(); ?>"
                class="flex items-center transition-colors duration-200 text-blue-950 dark:hover:text-blue-500 dark:text-white hover:text-blue-800"><span
                    class="sr-only">LOGO</span>
                    <img src="<?php $this->options->themeUrl('img/logo.svg'); ?>" alt="<?php $this->options->title(); ?>" class="w-auto h-7 sm:h-8"><span class="ml-0.5 font-medium"><?php $this->options->title(); ?></span>
                </a>
            <div class="flex items-center -mr-2 lg:hidden">
                <div><button type="button" @click="menu=true"
                        class="inline-flex items-center justify-center p-2 text-gray-700 rounded-lg dark:hover:bg-gray-800 dark:text-gray-200 hover:bg-gray-100 focus:outline-none focus:ring-2 focus-ring-inset dark:focus:ring-gray-700 focus:ring-gray-200"
                        aria-expanded="false"><span class="sr-only">Open main menu</span><svg
                            xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16"></path>
                        </svg></button>
                    <div 
                        class="fixed inset-0 z-10 w-full h-screen transition duration-500 origin-top bg-white/70 backdrop-blur-2xl dark:bg-gray-900/70 lg:hidden" :class="{'scale-y-100':menu,'scale-y-0':!menu}">
                    </div>
                    <div class="fixed inset-0 z-10 p-4 transition origin-top-right transform"
                        style="display: none;" x-show="menu">
                        <div
                            class="overflow-auto max-h-full bg-white border border-gray-100 shadow-md shadow-gray-200/50 dark:shadow-none dark:border-gray-800 rounded-xl dark:bg-gray-900">
                            <div class="flex items-center justify-between px-5 pt-4"><a href="<?php $this->options->siteUrl(); ?>"
                                    class="flex items-center transition-colors duration-200 text-blue-950 dark:hover:text-blue-500 dark:text-white hover:text-blue-800"><span
                                        class="sr-only">LOGO</span>
                    <img src="<?php $this->options->themeUrl('img/logo.svg'); ?>" alt="<?php $this->options->title(); ?>" class="w-auto h-7 sm:h-8"><span class="ml-0.5 font-medium"><?php $this->options->title(); ?></span>
                </a>
                                <div class="-mr-2"><button type="button"  @click="menu=false"
                                        class="inline-flex items-center justify-center p-2 text-gray-700 rounded-lg dark:hover:bg-gray-800 dark:text-gray-200 hover:bg-gray-100 focus:outline-none focus:ring-2 focus-ring-inset dark:focus:ring-gray-700 focus:ring-gray-200"><span
                                            class="sr-only">Close menu</span><svg class="w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg></button></div>
                            </div>
                            <div class="flex flex-col px-5 pt-4 pb-3 space-y-4">
                            
                            <a href="<?php $this->options->siteUrl(); ?>" class="text-sm capitalize transition-colors duration-300 text-blue-950 dark:text-white dark:hover:text-blue-400 hover:text-blue-700">首页</a>
                            <?php \Widget\Metas\Category\Rows::alloc()->to($cates); ?>
                            <?php while ($cates->next()): ?>
                                <a href="<?php $cates->permalink(); ?>" class="text-sm capitalize transition-colors duration-300 text-blue-950 dark:text-white dark:hover:text-blue-400 hover:text-blue-700"><?php $cates->name(); ?></a>
                            <?php endwhile; ?>

                            <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
                            <?php while ($pages->next()): ?>
                                    <a href="<?php $pages->permalink(); ?>"
                                    class="text-sm capitalize transition-colors duration-300 text-blue-950 dark:text-white dark:hover:text-blue-400 hover:text-blue-700"><?php $pages->title(); ?></a>
                            <?php endwhile; ?>

                                    <button aria-label="theme switching" type="button" @click="dark=!dark; if(dark){document.cookie = 'dark=dark;path=/';}else{document.cookie = 'dark=light;path=/';}"
                                    class="group flex max-w-[2.25rem] border border-gray-200/40 dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 rounded-lg h-9 w-9 items-center justify-center"><svg
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="relative hidden w-5 h-5 text-white duration-300 dark:inline-block group-hover:rotate-180">
                                        <path
                                            d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z">
                                        </path>
                                    </svg><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="relative w-4 h-4 text-gray-700 duration-500 group-hover:text-gray-900 group-hover:rotate-[360deg] dark:hidden">
                                        <path fill-rule="evenodd"
                                            d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                                            clip-rule="evenodd"></path>
                                    </svg></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:gap-x-8 lg:flex lg:items-center">
            <div><button @click="search=true"
                    class="flex items-center transition-colors duration-200 text-blue-950 dark:text-white dark:hover:text-blue-400 hover:text-blue-900 focus:outline-none"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg></button>
                <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 transition-opacity bg-gray-600 bg-opacity-50 backdrop-blur-sm"
                        style="display: none;" x-show="search" @click="search=false"></div>
                    <div class="fixed z-50 overflow-hidden overflow-y-auto -translate-x-1/2 rounded-lg left-1/2 top-28">
                        <div class="relative overflow-hidden transition-all rounded-lg" style="display: none;" x-show="search">
                            <div><form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                                <div class="relative flex items-center"><span class="absolute text-gray-400 left-3"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg></span><input type="text" id="s" name="s" placeholder="Search..."
                                        class="block w-[28rem] dark:text-white dark:bg-gray-900 py-4 pl-10 pr-4 text-blue-950 placeholder-gray-400/70 focus:outline-none">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <a href="<?php $this->options->siteUrl(); ?>" class="<?php if ($this->is('index')){echo 'text-blue-500';}else{echo 'text-blue-950 dark:text-white';} ?> text-sm capitalize transition-colors duration-300 dark:hover:text-blue-400 hover:text-blue-700">首页</a>

            <?php \Widget\Metas\Category\Rows::alloc()->to($cates); ?>
<?php while ($cates->next()): ?>
   <a href="<?php $cates->permalink(); ?>" 
                class="<?php if ($this->is('category', $cates->slug)){echo 'text-blue-500';}else{echo 'text-blue-950 dark:text-white';} ?> text-sm capitalize transition-colors duration-300 dark:hover:text-blue-400 hover:text-blue-700"><?php $cates->name(); ?></a>
<?php endwhile; ?>

            <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
                   <?php while ($pages->next()): ?>
            <a href="<?php $pages->permalink(); ?>"
                class="<?php if ($this->is('page', $pages->slug)){echo 'text-blue-500';}else{echo 'text-blue-950 dark:text-white';} ?> text-sm capitalize transition-colors duration-300 dark:hover:text-blue-400 hover:text-blue-700"><?php $pages->title(); ?></a>
                   <?php endwhile; ?>
                
                <button aria-label="theme switching" type="button" @click="dark=!dark; if(dark){document.cookie = 'dark=dark;path=/';}else{document.cookie = 'dark=light;path=/';}"
                class="group flex max-w-[2.25rem] border border-gray-200/40 dark:border-gray-700/40 bg-gray-100/20 dark:bg-gray-800/20 rounded-lg h-9 w-9 items-center justify-center"><svg
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="relative hidden w-5 h-5 text-white duration-300 dark:inline-block group-hover:rotate-180">
                    <path
                        d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z">
                    </path>
                </svg><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="relative w-4 h-4 text-gray-700 duration-500 group-hover:text-gray-900 group-hover:rotate-[360deg] dark:hidden">
                    <path fill-rule="evenodd"
                        d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                        clip-rule="evenodd"></path>
                </svg></button>
        </div>
    </nav>
