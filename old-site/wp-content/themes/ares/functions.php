<?php
/**
*	Setup Theme
**/
define("THEMENAME", "Ares");
define("SHORTNAME", "pp");
define("THEMEVERSION", "2.1.1");
define("THEMEDOMAIN", THEMENAME.'Language');

add_filter('intermediate_image_sizes_advanced','stop_thumbs');
function stop_thumbs($sizes){
      return array();
}


/**
*	Setup Translation File
**/
include (TEMPLATEPATH . "/lib/translation.lib.php");

/**
*	Setup Admin Menu
**/
include (TEMPLATEPATH . "/lib/admin.lib.php");

/**
*	Themes API call
**/
include (TEMPLATEPATH . "/lib/api.lib.php");

/**
*	Setup Theme post custom fields
**/
include (TEMPLATEPATH . "/fields/post.fields.php");

/**
*	Setup Theme page custom fields
**/
include (TEMPLATEPATH . "/fields/page.fields.php");

/**
*	Setup Theme thumbnail and image size
**/
include (TEMPLATEPATH . "/lib/images.lib.php");

/**
*	Setup Sidebar
**/
include (TEMPLATEPATH . "/lib/sidebar.lib.php");

/**
*	Get custom function
**/
include (TEMPLATEPATH . "/lib/custom.lib.php");

/**
*	Get custom shortcode
**/
include (TEMPLATEPATH . "/lib/shortcode.lib.php");

/**
*	Get custom widgets
**/
include (TEMPLATEPATH . "/lib/widgets.lib.php");

/**
*	Setup Menu
**/
include (TEMPLATEPATH . "/lib/menu.lib.php");

/**
*	Setup Admin Action
**/
include (TEMPLATEPATH . "/lib/admin-action.lib.php");


/**
*	Setup all theme's plugins
**/
include (TEMPLATEPATH . "/plugins/troubleshooting.php");
include (TEMPLATEPATH . "/plugins/shortcode_generator.php");
include (TEMPLATEPATH . "/plugins/theme_store.php");


/**
* 	Setup Gallery Plugin
**/
include (TEMPLATEPATH . "/plugins/shiba-media-library/shiba-media-library.php");


/**
*	Setup Admin Default Value and Formatter
**/
include (TEMPLATEPATH . "/lib/admin-default.lib.php");
?>