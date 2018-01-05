<?php

/**
 * Get path for templates using same structure as `include_template_part`,
 * returns path for use with `include()` to allow for passing variables
 * between templates. If a name parameter is passed but not found, will fall
 * back to using file with just the slug.
 *
 * @param  string $slug Primary name for template part
 * @param  string $name Secondary name for template part
 * @return string       Fully qualified path for relevant template part
 */
function find_template_part($slug, $name = null)
{
    $templates = array();

    if (isset($name)) {
        $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";

    return locate_template($templates);
}

function render($slug, $params = array(), $name = null)
{
    echo get_render($slug, $params, $name);
}

function get_render($slug, $params = array(), $name = null)
{
    $template_part = find_template_part($slug, $name);

    if (!empty($template_part)) {
        ob_start();
        extract($params, EXTR_SKIP);
        include($template_part);
        return ob_get_clean();
    }
}

function post_thumbnail_url($id, $size = 'large')
{
    if (has_post_thumbnail($id)) {
        $thumb_id = get_post_thumbnail_id($id);
        $thumb_url = wp_get_attachment_image_src($thumb_id, $size, true);
        return $thumb_url[0];
    }
}

function all_posts($post_type, $options = array()) {
    $defaults = array(
        'post_type' => $post_type,
        'posts_per_page' => -1
    );

    $args = wp_parse_args($options, $defaults);
    return get_posts($args);
}

function pages_nav() {
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'      => $pagenum_link,
        'format'    => $format,
        'total'     => $GLOBALS['wp_query']->max_num_pages,
        'current'   => $paged,
        'mid_size'  => 1,
        'type'      => 'array',
        'add_args'  => array_map( 'urlencode', $query_args ),
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;'
    ));

    // Output Paging Nav
    if ( count($links) ) {
        echo "<nav class='navigation paging-navigation' role='navigation'>";
            printf('<h4 class="sr-only">%s</h4>', __( 'Posts navigation', I18N_DOMAIN ));

            echo '<ul class="pagination">';
                foreach ( $links as &$link ) {
                    $active = strpos($link, 'current') ? 'active' : '';
                    printf('<li class="%s">%s</li>', $active, $link);
                }
            echo '</ul>';
        echo '</nav>';
    }
}
