<?php
/*
Plugin Name: Madhouse HelloWorld
Short Name: madhouse_helloworld
Plugin URI: http://wearemadhouse.wordpress.com/2013/10/11/how-to-develop-osclass-plugins/
Description: A dummy plugin which is meant to be used as template.
Version: 1.20
Author: Madhouse
Author URI: http://wearemadhouse.wordpress.com/
*/

mdh_current_plugin_path("oc-load.php");

/**
 * (hook: install) Make installation operations
 * 		It creates the database schema and sets some preferences.
 * @returns void.
 */
function mdh_helloworld_install() {
	mdh_import_sql(mdh_current_plugin_path("assets/model/install.sql", false));
}
osc_register_plugin(osc_plugin_path(__FILE__), 'mdh_helloworld_install');

/**
 * (hook: uninstall) Make un-installation operations
 * 		It destroys the database schema and unsets some preferences.
 * @returns void.
 */
function mdh_helloworld_uninstall() {
	mdh_import_sql(mdh_current_plugin_path("assets/model/uninstall.sql", false));
}
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'mdh_helloworld_uninstall');

/**
 * (hook: init) Registers scripts and styles.
 * @returns void.
 */
function mdh_helloworld_load() {
}
osc_add_hook('init', 'mdh_helloworld_load');

?>