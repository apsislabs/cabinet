<? get_header(); ?>
    <? if ( have_posts() ) : ?>
        <? while ( have_posts() ) : the_post(); ?>
            <article <? post_class(); ?>>
                <div class="page-content">
                    <? the_content(); ?>
                </div>
            </article>
        <? endwhile; ?>
    <? endif; ?>
<? get_footer(); ?>
