<?php

/**
 * Web controller, handling all logic for web (frontend).
 *
 *  It extends WebSecBaseModel by default which requires user to be logged in.
 *  You could choose to extend BaseModel for non-secure actions (ie. public profile)
 *
 * @since 1.00
 * @author -
 */
class Madhouse_HelloWorld_Controllers_Web extends WebSecBaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

/**
 * Business control for Madhouse HelloWorld Plugin for OSClass.
 */
    public function doModel()
    {
        switch (Params::getParam("route")) {
            case "madhouse_helloworld_show":
                // Get our first message from our model layer.
                $message = Madhouse_HelloWorld_Models_Message::newInstance()->findByPrimaryKey(1);
                // Exports it to make it available to the view.
                View::newInstance()->_exportVariableToView(
                    "mdh_helloworld_message",
                    $message["s_content"]
                );
                break;
            default:
                // Don't know what to do. Pretend not to exist.
                osc_add_flash_error_message(__("Oops! We got confused at some point. Try to refresh the page.", "madhouse_helloworld"));
                $this->redirectTo(osc_base_url());
                break;
        }
    }
}
