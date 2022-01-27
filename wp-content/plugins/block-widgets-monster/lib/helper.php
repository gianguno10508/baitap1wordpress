<?php

if ( ! function_exists( 'bwm_var_dump' ) ) {
	/**
	 * formatted var dump function
	 *
	 * @param mixed $data
	 *
	 * @since 1.0.0
	 */
	function bwm_var_dump( $data ) {
		echo '<pre>';
		var_dump( $data );
		echo '</pre>';
	}
}
