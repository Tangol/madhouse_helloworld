<?php
/*
Plugin Name: Madhouse HelloWorld
Short Name: madhouse_helloworld
Plugin URI: http://wearemadhouse.wordpress.com/2013/10/11/how-to-develop-osclass-plugins/
Description: Example and starter plugin for Osclass, designed by Madhouse.
Version: 1.2.0
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
    mdh_import_sql(__DIR__ . "/assets/model/install.sql");
}
osc_register_plugin(osc_plugin_path(__FILE__), 'mdh_helloworld_install');

/**
 * (hook: uninstall) Make un-installation operations
 *      It destroys the database schema and unsets some preferences.
 * @returns void.
 */
function mdh_helloworld_uninstall()
{
    mdh_import_sql(__DIR__ . "/assets/model/uninstall.sql");
}
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'mdh_helloworld_uninstall');

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

    osc_add_route(
        "madhouse_helloworld_show",
        'helloworld/show/?',
        'helloworld/show/',
        "madhouse_helloworld/views/web/show.php"
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
