<?php 

/**
 * Admin controller, handling all logic for admin (backend).
 * 
 * 	It extends AdminSecBaseModel by default which requires admin to be logged in.
 *
 * @since 1.00
 * @author -
 */
class CAdminHelloWorld extends AdminSecBaseModel {

	function __construct() {
    	parent::__construct();
	}
	
	function doModel() {
		parent::doModel();
		switch(Params::getParam('do')) {
			case "main":
				$this->_exportVariableToView("file", osc_plugins_path() . "madhouse_helloworld/views/admin/main.php");
				$this->doView("plugins/view.php");
			break;
			default:
				$this->redirectTo(osc_admin_base_url());
			break;
		}
	}
	
	/**
	 * Makes the right file be rendered.
	 * 	NB : This function seems to be duplicated everywhere in the controllers.
	 * @param $file relative path of the required file (starting from the current web theme path).
	 * @see oc-includes/osclass/controller.
	 */
	function doView($file) {
	    osc_run_hook("before_admin_html");
	    osc_current_admin_theme_path($file);
	    Session::newInstance()->_clearVariables();
	    osc_run_hook("after_admin_html");
	}
	
	/**
	 * Redirects to login page.
	 * 	Must be overeiden because we use page=ajax to trigger this controller.
	 * @override AdminSecBaseModel::showAuthFailPage()
	 */
	function showAuthFailPage() {
        Session::newInstance()->_setReferer(osc_base_url() . preg_replace('|^' . REL_WEB_URL . '|', '', $_SERVER['REQUEST_URI']));
        header("Location: " . osc_admin_base_url(true)."?page=login" );
        exit;
    }
}