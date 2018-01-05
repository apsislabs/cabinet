<?

class PagebuilderWidgets {
    public static function allWidgets()
    {
        return scandir(get_template_directory() . '/components/page-builder/');
    }

    public static function register()
    {
        add_filter('siteorigin_widgets_widget_folders', array(static::class, 'registerWidgetFolder'));
        add_action('admin_init', array(static::class, 'enableAllWidgets'));
    }

    public static function registerWidgetFolder($folders)
    {
        $folders[] = get_template_directory() . '/components/page-builder/';
        return $folders;
    }

    public static function enableAllWidgets()
    {
        if( !get_theme_mod('bundled_widgets_activated') ) {
            $widgets = static::allWidgets();

            foreach ($widgets as $key => $widget) {
                SiteOrigin_Widgets_Bundle::single()->activate_widget( $widget );
            }

            set_theme_mod( 'bundled_widgets_activated', true );
        }
    }
}


// Only register the widgets if we have SiteOrigin installed
if ( class_exists("SiteOrigin_Widget") ) {
    PagebuilderWidgets::register();
}
