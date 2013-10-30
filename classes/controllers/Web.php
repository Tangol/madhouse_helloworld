<?php 

/**
 * Web controller, handling all logic for web (frontend).
 *
 * 	It extends SecBaseModel by default which requires user to be logged in.
 *	You could choose to extend BaseModel for non-secure actions (ie. public profile)
 *	
 * @since 1.00
 * @author -
 */
class Madhouse_HelloWorld_Controllers_Web extends WebSecBaseModel {

	public function __construct() {
		parent::__construct();
		$this->ajax = true;
	}
	
	/**
	 * Business control for Madhouse HelloWorld Plugin for OSClass.
	 */
	public function doModel() {
		switch(Params::getParam("do")) {
			case "show":
				// Get our first message from our model layer.
				$message = Madhouse_HelloWorld_Model_Message::newInstance()->findByPrimaryKey(1);
				// Exports it to make it available to the view.
				View::newInstance()->_exportVariableToView(
					"mdh_helloworld_message",
					$message["s_content"]
				);
				
				// Call the view.
				$this->doView("plugins/madhouse_helloworld/show.php");
			break;
			default:
				// Don't know what to do. Pretend not to exist.
				osc_add_flash_error_message(__("Oops! We got confused at some point. Try to refresh the page.", "madhouse_helloworld"));
				$this->redirectTo(osc_base_url());
			break;
		}
	}
	
	/**
	 * Makes the right file be rendered.
	 * 	This function seems to be duplicated everywhere in the controllers.
	 * @param $file relative path of the required file (starting from the current web theme path).
	 * @see oc-includes/osclass/controller.
	 */
	public function doView($file) {
		osc_run_hook("before_html");
		osc_current_web_theme_path($file);
		Session::newInstance()->_clearVariables();
		osc_run_hook("after_html");
	}
}

?>