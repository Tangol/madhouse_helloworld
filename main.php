<?php

/**
 * @deprecated Use routes instead. The file is kept for legacy purpose.
 */

if(! mdh_plugin_is_ready("madhouse_helloworld")) {
	mdh_handle_error_ugly();
}

switch(Params::getParam("page")) {
	case "ajax":
		$do = new Madhouse_HelloWorld_Controllers_WebLegacy();
		$do->doModel();
	break;
	default:
		mdh_handle_error_ugly();
	break;
}

?>