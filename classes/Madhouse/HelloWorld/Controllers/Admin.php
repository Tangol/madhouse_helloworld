<?php

class Madhouse_HelloWorld_Controllers_Admin extends AdminSecBaseModel
{
    /**
     * Load the settings view.
     */
    private function doSettingsAction()
    {
    }

    /**
     * Updates settings.
     *
     * @return
     */
    private function doSettingsPostAction()
    {
        // Get parameter.
        $numberOfMessagesPerPage = Params::getParam("i_display_length");

        // Save settings @ database.
        osc_set_preference("i_display_length", $numberOfMessagesPerPage, "plugin_madhouse_helloworld", "INTEGER");

        // Redirect and display a nice message!
        osc_add_flash_ok_message(__("Successfully updated settings!", "madhouse_helloworld"), "admin");
        $this->redirectTo(mdh_helloworld_admin_settings_url());
    }

    /**
     * Do model, catch all cases of madhouse user resoures for admin
     */
    public function doModel()
    {
        parent::doModel();

        switch (Params::getParam("route")) {
            case "madhouse_helloworld_admin_settings_post":
                $this->doSettingsPostAction();
                break;
            case "madhouse_helloworld_admin_settings":
            default:
                $this->doSettingsAction();
                break;
        }
    }
}
