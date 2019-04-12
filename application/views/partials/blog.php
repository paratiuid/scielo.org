<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php if(isset($blog_posts->channel)): ?>
<div class="row slider-blog">
    <?php foreach ($blog_posts->channel->item as $post) : ?>
    <?php 
    $content = $post->children("content", true);
    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $img);
    preg_match("'<p><strong>Por(.*?)<\/strong><\/p>'", $content, $author);

    // @TODO - Feed RSS em inglês e espanhol não possui imagens de conteúdo.
    $img = array_key_exists('src', $img) ?  $img['src'] : get_static_image_path('placeholder.jpg');

    ?>
    <div class="col-xs-12 col-md-4">
        <div class="card">
            <div class="card-header" style="background-image:url('<?= $img ?>')">
            </div>
            <div class="card-body">
                <div class="card-title">
                    <a href="<?= $post->link ?>">
                        <?php if (is_array($author) && count($author) > 0) : ?>
                        <span><?= strip_tags($author[0]) ?></span>
                        <?php else : ?>	
                        <span>Por SciELO</span>
                        <?php endif; ?>	
                        <h3><?= character_limiter($post->title, 100) ?></h3>
                    </a>
                </div>
                <p><?= character_limiter(str_replace('Read More &#8594;', '', strip_tags($post->description)), 400) ?></p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <span><?= date('d M Y', strtotime($post->pubDate)) ?></span>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <a href="<?= $post->link ?>" class="btn-arrow arrow-blue"><?= lang('read_more_text') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="card card-no-content">
            <?= lang('content_error'); ?>
        </div>
    </div>
<?php endif; ?>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8">
        <a href="<?= $tab->get_link() ?>" class="btn btn-default btn-arrow arrow-blue btn-link-blog"><?= $tab->get_link_text() ?></a>
    </div>
</div>
