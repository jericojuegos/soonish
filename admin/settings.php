<?php
// Settings page template placeholder
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('soonish_options');
        do_settings_sections('soonish');
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="soonish_enabled"><?php _e('Enable Coming Soon Mode', 'soonish'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="soonish_enabled" name="soonish_enabled" value="1" <?php checked(get_option('soonish_enabled'), 1); ?>>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="soonish_title"><?php _e('Page Title', 'soonish'); ?></label>
                </th>
                <td>
                    <input type="text" id="soonish_title" name="soonish_title" value="<?php echo esc_attr(get_option('soonish_title', 'Coming Soon')); ?>" class="regular-text">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="soonish_description"><?php _e('Description', 'soonish'); ?></label>
                </th>
                <td>
                    <textarea id="soonish_description" name="soonish_description" rows="5" class="large-text"><?php echo esc_textarea(get_option('soonish_description', 'We are working on something awesome. Stay tuned!')); ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="soonish_background"><?php _e('Background Style', 'soonish'); ?></label>
                </th>
                <td>
                    <select id="soonish_background" name="soonish_background">
                        <option value="gradient-purple" <?php selected(get_option('soonish_background', 'gradient-purple'), 'gradient-purple'); ?>><?php _e('Purple Gradient', 'soonish'); ?></option>
                        <option value="gradient-blue" <?php selected(get_option('soonish_background', 'gradient-purple'), 'gradient-blue'); ?>><?php _e('Blue Gradient', 'soonish'); ?></option>
                        <option value="gradient-green" <?php selected(get_option('soonish_background', 'gradient-purple'), 'gradient-green'); ?>><?php _e('Green Gradient', 'soonish'); ?></option>
                        <option value="solid-dark" <?php selected(get_option('soonish_background', 'gradient-purple'), 'solid-dark'); ?>><?php _e('Solid Dark', 'soonish'); ?></option>
                        <option value="solid-light" <?php selected(get_option('soonish_background', 'gradient-purple'), 'solid-light'); ?>><?php _e('Solid Light', 'soonish'); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="soonish_launch_date"><?php _e('Launch Date', 'soonish'); ?></label>
                </th>
                <td>
                    <input type="datetime-local" id="soonish_launch_date" name="soonish_launch_date" value="<?php echo esc_attr(get_option('soonish_launch_date')); ?>">
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <span id="soonish-toggle-status">
        Status: <strong><?php echo get_option('soonish_enabled', false) ? 'Enabled' : 'Disabled'; ?></strong>
    </span>
</div>
