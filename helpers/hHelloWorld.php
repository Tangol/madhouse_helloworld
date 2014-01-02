<?php

/**
 * URL for our "show" view.
 * @since 1.00
 */
function mdh_helloworld_show_url() {
	return osc_ajax_plugin_url(mdh_current_plugin_name() . "/main.php") . "&do=show";
}

/**
 * Gets the exported message to display.
 * @since 1.00
 */
function mdh_helloworld_get_message() {
	return View::newInstance()->_get("mdh_helloworld_message"); 
}

?>