<?php

if ( ! defined( 'BWM_VERSION' ) ) {
	define( 'BWM_VERSION', '1.0.1' );
}

if ( ! defined( 'BWM_ABS_PATH' ) ) {
	define( 'BWM_ABS_PATH', dirname( __FILE__ ) );
}

if ( ! defined( 'BWM_REL_PATH' ) ) {
	define( 'BWM_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
}

if ( ! defined( 'BWM_URL_PATH' ) ) {
	define( 'BWM_URL_PATH', plugin_dir_url( __FILE__ ) );
}
