<?php

/**
 * URL for our "show" view.
 * @return String the URL to the show page.
 * @since 1.00
 */
function mdh_helloworld_show_url()
{
	if(osc_version() >= 330) {
		return osc_route_url(mdh_current_plugin_name() . "_show");
	}
	return osc_ajax_plugin_url(mdh_current_plugin_name() . "/main.php") . "&do=show";
}

/**
 * Gets the exported message to display.
 * @return String the message.
 * @since 1.00
 */
function mdh_helloworld_get_message()
{
	return View::newInstance()->_get("mdh_helloworld_message");
}

/**
 * Tells if the current page belongs to HelloWorld.
 * @return Bool true if the current page is helloworld, false otherwise.
 * @since  1.20
 */
function mdh_is_helloworld()
{
	if(preg_match('/^' . mdh_current_plugin_name() . '.*$/', Params::getParam("route"))) {
		return true;
	}
	return false;
}

?>