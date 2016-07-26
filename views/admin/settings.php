<p><?php echo "Welcome to Madhouse HelloWorld settings!"; ?></p>

<form class="form-horizontal" method="POST" action="<?php echo mdh_helloworld_admin_settings_post_url(); ?>">
    <div class="form-row">
        <div class="form-label">
            <?php _e("Messages per page", "madhouse_helloworld"); ?>
        </div>
        <div class="form-controls">
            <input type="text" class="" name="i_display_length" value="<?php echo osc_get_preference("i_display_length", "plugin_madhouse_helloworld"); ?>">
        </div>
    </div>

    <button class="btn btn-submit" type="submit">
        <?php _e("Save settings", "madhouse_helloworld");?>
    </button>
</form>