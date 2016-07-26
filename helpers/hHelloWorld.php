<?php

/**
 * URL for our "show" view.
 * @return String the URL to the show page.
 * @since 1.00
 */
function mdh_helloworld_show_url()
{
    if (osc_version() >= 330) {
        return osc_route_url("madhouse_helloworld_show");
    }
    return osc_ajax_plugin_url("madhouse_helloworld/main.php") . "&do=show";
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
    if (preg_match('/^madhouse_helloworld.*$/', Params::getParam("route"))) {
        return true;
    }
    return false;
}

/**
 * Get the admin settings route URL.
 *
 * @return string
 *
 * @since  1.3.0
 */
function mdh_helloworld_admin_settings_url()
{
    return osc_route_admin_url("madhouse_helloworld_admin_settings");
}

/**
 * Get the admin settings form action route URL.
 *
 * @return string
 *
 * @since 1.3.0
 */
function mdh_helloworld_admin_settings_post_url()
{
    return osc_route_admin_url("madhouse_helloworld_admin_settings_post");
}
