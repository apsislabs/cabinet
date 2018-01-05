<?php

$theme = null;

// Constants
defined('I18N_DOMAIN') or define('I18N_DOMAIN', 'apsis_wp');

// Includes
include('inc/navwalker.php');
include('inc/template_tags.php');
include('inc/themebuilder.php');
include('inc/pagebuilder.php');

// Launch Theme
if ( class_exists('ThemeBuilder') && $theme === null ) {
    $theme = new ThemeBuilder();
}
