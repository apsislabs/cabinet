<? get_header(); ?>
    <? if ( have_posts() ) : ?>
        <? while ( have_posts() ) : the_post(); ?>
            <?= render('components/shared/post_content'); ?>
        <? endwhile; ?>
    <? endif; ?>
<? get_footer(); ?>
