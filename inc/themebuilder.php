<?php

class ThemeBuilder {

    /**
     * Queue all theme setup using appropriate hooks
     */
    function __construct() {
        // Run standard theme setup
        add_action( 'after_setup_theme', array(&$this, 'setupTheme') );
        add_action( 'widgets_init', array(&$this, 'setupWidgets') );

        add_action( 'wp_enqueue_scripts', array(&$this, 'enqueueScripts') );
        add_action( 'wp_enqueue_scripts', array(&$this, 'enqueueStyles') );
    }

    /**
     * Handle all basic theme setup
     */
    public function setupTheme() {
        // Translation Support
        load_theme_textdomain( I18N_DOMAIN, get_template_directory() . '/languages' );

        // Theme Support
        add_theme_support( 'custom-header' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );

        // Sidebar Widgets
        add_filter( 'widget_text', 'do_shortcode');

        // Editor Style
        add_editor_style('assets/editor-style.css');

        // Register Nav
        register_nav_menus( array(
            'primary'   => __('Primary Menu', 'apsis-wp'),
            'footer'    => __('Footer Menu', 'apsis-wp'),
            'copyright' => __('Copyright Menu', 'apsis-wp')
        ));

        // Image Sizes
        // add_image_size( 'custom_image_size', 160, 120, true );
    }

    /**
     * Register sidebar with widget definitions
     */
    public function setupWidgets() {
        register_sidebar( array(
            'name'          => __( 'Primary Footer Widgets', 'apsis-wp' ),
            'id'            => 'footer-widgets',
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));

        register_sidebar( array(
            'name'          => __( 'Secondary Footer Widgets', 'apsis-wp' ),
            'id'            => 'secondary-footer-widgets',
            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }

    /**
     * Enqueue front-end scripts
     */
    public function enqueueScripts() {
        wp_enqueue_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');
        wp_enqueue_script('theme_scripts', get_template_directory_uri() . '/assets/bundle.js', array('jquery'), get_bloginfo('version'), true);

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Enqueue front-end styles
     */
    public function enqueueStyles() {
        wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_register_style( 'theme_definition', get_stylesheet_uri());
        wp_register_style( 'theme_styles', get_bloginfo('template_directory') . '/assets/main.min.css');

        wp_enqueue_style( 'fontawesome' );
        wp_enqueue_style( 'theme_definition' );
        wp_enqueue_style( 'theme_styles' );
    }
}
