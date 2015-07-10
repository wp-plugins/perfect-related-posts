<div class="wrap">

<h2>Perfect Related Posts Admin Interface</h2>
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
<?php } ?>

<form method="post" action="options.php">

<?php settings_fields( 'super-settings-group' ); ?>

<?php do_settings_sections( 'super-settings-group' ); ?>

<table class="form-table">

<tr valign="top">

<th scope="row">Number of Posts to Show</th>

<td><input type="text" name="dsense_number_posts" value="<?php echo get_option('dsense_number_posts'); ?>" /></td>

</tr>

<!--<tr valign="top">

<th scope="row">Some Other Option</th>

<td><input type="text" name="some_other_option" value="<?php //echo get_option('some_other_option'); ?>" /></td>

</tr>

<tr valign="top">

<th scope="row">Options, Etc.</th>

<td><input type="text" name="option_etc" value="<?php //echo get_option('option_etc'); ?>" /></td>

</tr>-->

</table>

<?php submit_button(); ?>

</form>

</div>