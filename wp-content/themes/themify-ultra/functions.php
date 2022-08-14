<?php


/***************************************************************************
 *
 * 	----------------------------------------------------------------------
 * 						DO NOT EDIT THIS FILE
 *	----------------------------------------------------------------------
 * 
 *  					Copyright (C) Themify
 * 						https://themify.me
 *
 ***************************************************************************/

$theme_includes = apply_filters( 'themify_theme_includes',
	array(	'themify/themify-database.php',
			'themify/themify-utils.php',
			'themify/themify-config.php',
			'theme-options.php',
			'theme-modules.php',
			'theme-functions.php',
			'custom-modules.php',
			'custom-functions.php',
			'themify/themify-widgets.php' ));
			
foreach ( $theme_includes as $include ) { locate_template( $include, true ); }

/**********************************************************************************************************
 * 
 * Do not edit this file.
 * To add custom PHP functions to the theme, create a child theme (https://themify.me/docs/child-theme) and add it to the child theme functions.php file.
 * 
***********************************************************************************************************/