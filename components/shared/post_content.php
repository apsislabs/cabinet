<article <? post_class(); ?>>
    <header>
        <h1 class="page-header">
            <?= get_the_title($post->ID); ?>
        </h1>
    </header>

    <?= the_content(); ?>
</article>
