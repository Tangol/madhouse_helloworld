<?php

/**
 * URL for our "show" view.
 * @return String the URL to the show page.
 * @since 1.00
 */
function mdh_helloworld_show_url($page = "", $length = "")
{
    if (osc_version() >= 330) {
        $params = array();
        if (!empty($page)) {
            $params["iDisplayPage"] = $page;
        }
        if (!empty($length)) {
            $params["iDisplayLength"] = $length;
        }

        return osc_route_url("madhouse_helloworld_show", $params);
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
 * Gets the all messages to display.
 *
 * @return String the message.
 *
 * @since 1.3.0
 */
function mdh_helloworld_get_messages()
{
    return View::newInstance()->_get("mdh_helloworld_messages");
}

/**
 * Total number of messages in database.
 *
 * @return int
 *
 * @since 1.3.0
 */
function mdh_helloworld_count_messages()
{
    return (int) View::newInstance()->_get("mdh_helloworld_messages_count");
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

/**
 * Gets the pagination links of messages pagination
 *
 * @return string pagination links
 *
 * @since  1.3.0
 */
function mdh_helloworld_pagination() {
    if (mdh_helloworld_count_messages() === 0) {
        return '';
    } else {
        $params = array(
            'total'    => ceil(mdh_helloworld_count_messages() / Params::getParam("iDisplayLength")),
            'selected' => Params::getParam("iDisplayPage") - 1, // page 1 is actually 0.
            'url'      => mdh_helloworld_show_url('{PAGE}', Params::getParam("iDisplayLength")),
            'class_prev'         => 'prev',
            'class_next'         => 'next',
            'class_selected'     => 'active',
        );

        $pagination = new Pagination($params);
        return $pagination->doPagination();
    }
}
