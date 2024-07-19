<div class="wrap">
    <h1>Best Widget for elementor</h1>
    <form method="post" action="">
        <?php wp_nonce_field('draggable_widget_save_settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Enable Draggable Widget</th>
                <td>
                    <input type="checkbox" name="draggable_widget_enabled" value="yes" <?php checked(get_option('draggable_widget_enabled'), 'yes'); ?> />
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
