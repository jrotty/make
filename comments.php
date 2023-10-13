<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
//如果你想使用其他评论头像插件，请注释下面这行代码！
define('__TYPECHO_GRAVATAR_PREFIX__', 'https://cravatar.cn/avatar/');
?>
<?php function threadedComments($comments, $options){
 $commentClass = '';
        if ($comments->authorId) {
            if ($comments->authorId == $comments->ownerId) {
                $commentClass .= ' comment-by-author';
            } else {
                $commentClass .= ' comment-by-user';
            }
        }

   if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
        ?>
        <li itemscope itemtype="http://schema.org/UserComments" class="comment-body<?php
        if ($comments->levels > 0) {
            echo ' comment-child';
            $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
        } else {
            echo ' comment-parent';
        }
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
            <div class="comment-col" id="<?php $comments->theId(); ?>">
            <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
                <span
                    itemprop="image">
                    <?php $comments->gravatar(50); ?>
                </span>
                <cite class="fn" itemprop="name"><?php echo $author; ?></cite>
                <div class="comment-reply">
                <button onclick="return TypechoComment.reply('comment-<?php $comments->coid(); ?>', <?php $comments->coid(); ?>);">回复</button>
                </div>
            </div>
            <div class="comment-meta">
                <a href="<?php $comments->permalink(); ?>">
                    <time itemprop="commentTime"
                          datetime="<?php $comments->date('c'); ?>">
                          <?php $comments->date('Y年m月d日'); ?></time>
                </a>
                <?php if ('waiting' == $comments->status) { ?>
                    <em class="comment-awaiting-moderation">您的评论正等待审核!</em>
                <?php } ?>
            </div>
            <div class="comment-content" itemprop="commentText">
<?php
    $content = preg_replace('/<p>(.*)/', '<p>'.get_comment_at($comments->coid).'$1', $comments->content);
    echo $content;
?>
            </div>
            </div>
            <?php if ($comments->children) { ?>
                <div class="comment-children" itemprop="discusses">
                    <?php $comments->threadedComments(); ?>
                </div>
            <?php } ?>
        </li>
        <?php
    }
?>

<div id="comments" data-no-instant>
    <?php $this->comments()->to($comments); ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <button id="cancel-comment-reply-link" style="display:none" data-no-instant onclick="return TypechoComment.cancelReply();">取消回复</button>
            </div>

            <h3 id="response"><?php _e('添加新评论'); ?></h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
                    <p><?php _e('登录身份: '); ?><a
                            href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a
                            href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
                    </p>
                <?php else: ?>
                <div class="inputgrap">
                    <p>
                        <label for="author" class="required"><?php _e('称呼'); ?></label>
                        <input type="text" name="author" id="author" class="text"
                               value="<?php $this->remember('author'); ?>" required/>
                    </p>
                    <p>
                        <label
                            for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('Email'); ?></label>
                        <input type="email" name="mail" id="mail" class="text"
                               value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </p>
                    <p>
                        <label
                            for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
                        <input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>"
                               value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </p>
                </div>
                <?php endif; ?>
                <p>
                    <label for="textarea" class="required"><?php _e('内容'); ?></label>
                    <textarea rows="8" cols="50" name="text" id="textarea" class="textarea"
                              required><?php $this->remember('text'); ?></textarea>
                </p>
                <p>
                    <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
                    <div class="comment-clear"></div>
                </p>
            </form>
        </div>
    <?php else: ?>
        <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    
<?php if ($comments->have()): ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>

<?php $comments->listComments(); ?>
        <div class="comment-pagegroup">
<?php

$npattern = '/\<li.*?class=\"next\"><a.*?\shref\=\"(.*?)\"[^>]*>/i';
$ppattern = '/\<li.*?class=\"prev\"><a.*?\shref\=\"(.*?)\"[^>]*>/i';
ob_start();
$comments->pageNav();
$con = ob_get_clean();
$n=preg_match_all($npattern, $con, $nextlink);
$p=preg_match_all($ppattern, $con, $prevlink);
if($n){
$nextlink=$nextlink[1][0];
$nextlink=str_replace("#comments","?type=comments",$nextlink);
}else{
$nextlink=false;
}

if($p){
$prevlink=$prevlink[1][0];
$prevlink=str_replace("#comments","?type=comments",$prevlink);
}else{
$prevlink=false;
}
?>
<?php if($prevlink): ?>
    <a href="<?php echo $prevlink; ?>" class="content-page">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            <span>
                上一页
            </span>
    </a>
<?php else: ?>
<div></div>
<?php endif; ?>
<?php if($nextlink): ?>
    <a href="<?php echo $nextlink; ?>" class="content-page">
            <span>
                下一页
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
    </a>
<?php endif; ?>

    </div>
<?php endif; ?>

</div>

<script type="text/javascript">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php $this->respondId(); ?>'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('<?php $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>
