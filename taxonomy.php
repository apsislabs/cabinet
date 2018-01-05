<? get_header(); ?>
    <h1 class="page-header"><?= the_archive_title(); ?></h1>
    
    <? if ( have_posts() ) : ?>
    <? else : ?>
        <h2><? _e('No products in this category.', I18N_DOMAIN); ?></h2>
    <? endif; ?>
<? get_footer(); ?>
