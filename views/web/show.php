<p>
    <?php _e("Here's your message :", "madhouse_helloworld"); ?>&nbsp;
    &laquo;<?php echo mdh_helloworld_get_message(); ?>&raquo;
</p>

<h3><?php _e("All messages", "madhouse_helloworld"); ?>:</h3>
<?php $allMessages = mdh_helloworld_get_messages(); ?>
<ul>
<?php foreach ($allMessages as $currentMessage) : ?>
    <li><?php echo $currentMessage['s_content']; ?></li>
<?php endforeach; ?>

<div class="paginate">
    <?php echo mdh_helloworld_pagination(); ?>
</div>