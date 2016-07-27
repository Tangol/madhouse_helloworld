<?php
/*
Plugin Name: Madhouse HelloWorld
Short Name: madhouse_helloworld
Plugin URI: http://wearemadhouse.wordpress.com/2013/10/11/how-to-develop-osclass-plugins/
Description: Example and starter plugin for Osclass, designed by Madhouse.
Version: 1.3.0
Author: Madhouse
Author URI: http://wearemadhouse.wordpress.com/
Plugin update URI: madhouse-helloworld
*/

/*
 * ==========================================================================
 *  LOADING
 * ==========================================================================
 */

require_once __DIR__ . "/oc-load.php";

/*
 * ==========================================================================
 *  INSTALL / UNINSTALL
 * ==========================================================================
 */

/**
 * (hook: install) Make installation operations
 *      It creates the database schema and sets some preferences.
 * @returns void.
 */
function mdh_helloworld_install()
{
    mdh_helloworld_import_sql(__DIR__ . "/assets/model/install.sql");

    osc_set_preference("version", "1.0.0", "plugin_madhouse_helloworld");
    osc_reset_preferences();
}
osc_register_plugin(osc_plugin_path(__FILE__), 'mdh_helloworld_install');

/**
 * (hook: uninstall) Make un-installation operations
 *      It destroys the database schema and unsets some preferences.
 * @returns void.
 */
function mdh_helloworld_uninstall()
{
    mdh_helloworld_import_sql(__DIR__ . "/assets/model/uninstall.sql");

    osc_delete_preference("i_display_length", "plugin_madhouse_helloworld");
    osc_delete_preference("version", "plugin_madhouse_helloworld");
    osc_reset_preferences();
}
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'mdh_helloworld_uninstall');

if (version_compare(osc_get_preference("version", "plugin_madhouse_helloworld"), "1.3.0") < 0) {
    // Set a default value for new settings.
    osc_set_preference("i_display_length", 1, "plugin_madhouse_helloworld");

    // Upgrade the version @ database
    osc_set_preference("version", "1.3.0", "plugin_madhouse_helloworld");
    osc_reset_preferences();
}

/*
 * ==========================================================================
 *  ROUTES
 * ==========================================================================
 */

if (osc_version() >= 330) {
    function mdh_helloworld_controller()
    {
        if (mdh_is_helloworld()) {
            $do = new Madhouse_HelloWorld_Controllers_Web();
            $do->doModel();
        }
    }
    osc_add_hook("custom_controller", "mdh_helloworld_controller");

    function mdh_helloworld_admin_controller()
    {
        if (mdh_is_helloworld()) {
            $filter = function ($string) {
                return __("Madhouse HelloWorld", "madhouse_helloworld");
            };

            // Page title (in <head />)
            osc_add_filter("admin_title", $filter, 10);

            // Page title (in <h1 />)
            osc_add_filter("custom_plugin_title", $filter);

            $do = new Madhouse_HelloWorld_Controllers_Admin();
            $do->doModel();
        }
    }
    osc_add_hook("renderplugin_controller", "mdh_helloworld_admin_controller");

    osc_add_route(
        "madhouse_helloworld_show",
        'helloworld/show/?',
        'helloworld/show/',
        "madhouse_helloworld/views/web/show.php"
    );

    osc_add_route(
        "madhouse_helloworld_admin_settings",
        "madhouse_helloworld/admin_settings/?",
        "madhouse_helloworld/admin_settings/",
        "madhouse_helloworld/views/admin/settings.php"
    );

    osc_add_route(
        "madhouse_helloworld_admin_settings_post",
        "madhouse_helloworld/admin_settings_post/?",
        "madhouse_helloworld/admin_settings_post/",
        "madhouse_helloworld/views/admin/settings.php"
    );
}

/*
 * ==========================================================================
 *  REGISTER & ENQUEUE
 * ==========================================================================
 */


/**
 * (hook: init) Registers scripts and styles.
 * @returns void.
 */
function mdh_helloworld_load()
{
}
osc_add_hook('init', 'mdh_helloworld_load');

/*
 * ==========================================================================
 *  ROUTES
 * ==========================================================================
 */

osc_add_hook('admin_menu_init', function () {
    osc_add_admin_submenu_divider(
        "plugins",
        __("Madhouse HelloWorld", "madhouse_helloworld"),
        "madhouse_helloworld",
        "administrator"
    );

    osc_add_admin_submenu_page(
        "plugins",
        __('Settings', "madhouse_helloworld"),
        mdh_helloworld_admin_settings_url(),
        "madhouse_helloworld_admin_settings",
        "administrator"
    );
});

