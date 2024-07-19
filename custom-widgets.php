<?php
/**
 * Plugin Name: Nova Widgets
 * Description: A collection of custom Elementor widgets including draggable elements with GSAP.
 * Version: 1.0
 * Author: Nova
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue scripts and styles
function custom_widgets_enqueue_assets() {
    wp_enqueue_style('custom-widgets-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), null, true);
    wp_enqueue_script('gsap-draggable', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Draggable.min.js', array('gsap-js'), null, true);
    wp_enqueue_script('custom-widgets-draggable-script', plugin_dir_url(__FILE__) . 'js/draggable.js', array('jquery', 'gsap-js', 'gsap-draggable'), null, true);
    wp_enqueue_script('custom-widgets-animated-image-gallery-script', plugin_dir_url(__FILE__) . 'js/animated-image-gallery.js', array('jquery', 'gsap-js'), null, true);
    wp_enqueue_script('custom-widgets-animated-text-script', plugin_dir_url(__FILE__) . 'js/animated-text.js', array('jquery', 'gsap-js'), null, true);
    wp_enqueue_script('gradient-follower', plugin_dir_url(__FILE__) . 'js/gradient-follow.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_widgets_enqueue_assets');

// Register the widgets
function register_custom_elementor_widgets($widgets_manager) {
    require_once(__DIR__ . '/widgets/widget-draggable.php');
    $widgets_manager->register(new \Elementor\Widget_Draggable());
    
    require_once(__DIR__ . '/widgets/widget-animated-image-gallery.php');
    $widgets_manager->register(new \Elementor\Widget_Animated_Image_Gallery());
    
    require_once(__DIR__ . '/widgets/widget-animated-text.php');
    $widgets_manager->register(new \Elementor\Widget_Animated_Text());
}
add_action('elementor/widgets/register', 'register_custom_elementor_widgets');

// Add admin menu
function custom_widgets_add_admin_menu() {
    add_menu_page(
        'Nova Widgets',
        'Nova Widgets',
        'manage_options',
        'custom-widgets',
        'custom_widgets_admin_page',
        'dashicons-admin-generic'
    );
}
add_action('admin_menu', 'custom_widgets_add_admin_menu');

// Admin page content
function custom_widgets_admin_page() {
    if (isset($_POST['custom_widgets_nonce']) && wp_verify_nonce($_POST['custom_widgets_nonce'], 'custom_widgets_save_settings')) {
        $draggable_enabled = isset($_POST['custom_widgets_draggable_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_draggable_enabled', $draggable_enabled);

        $animated_image_gallery_enabled = isset($_POST['custom_widgets_animated_image_gallery_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_animated_image_gallery_enabled', $animated_image_gallery_enabled);

        $animated_text_enabled = isset($_POST['custom_widgets_animated_text_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_animated_text_enabled', $animated_text_enabled);

        $gradient_follower_enabled = isset($_POST['custom_widgets_gradient_follower_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_gradient_follower_enabled', $gradient_follower_enabled);

        $gradient_color = sanitize_text_field($_POST['custom_widgets_gradient_color']);
        update_option('custom_widgets_gradient_color', $gradient_color);

        $gradient_size = sanitize_text_field($_POST['custom_widgets_gradient_size']);
        update_option('custom_widgets_gradient_size', $gradient_size);
    }

    $draggable_enabled = get_option('custom_widgets_draggable_enabled', 'no');
    $animated_image_gallery_enabled = get_option('custom_widgets_animated_image_gallery_enabled', 'no');
    $animated_text_enabled = get_option('custom_widgets_animated_text_enabled', 'no');
    $gradient_follower_enabled = get_option('custom_widgets_gradient_follower_enabled', 'no');
    $gradient_color = get_option('custom_widgets_gradient_color', '#9548e2');
    $gradient_size = get_option('custom_widgets_gradient_size', '100px');
    ?>
    <div class="wrap">
        <h1>Nova Widgets Settings</h1>
        <form method="post" action="">
            <?php wp_nonce_field('custom_widgets_save_settings', 'custom_widgets_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Draggable Widget</th>
                    <td>
                        <label for="custom_widgets_draggable_enabled">
                            <input type="checkbox" name="custom_widgets_draggable_enabled" id="custom_widgets_draggable_enabled" value="yes" <?php checked($draggable_enabled, 'yes'); ?> />
                            Enable
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Animated Image Gallery Widget</th>
                    <td>
                        <label for="custom_widgets_animated_image_gallery_enabled">
                            <input type="checkbox" name="custom_widgets_animated_image_gallery_enabled" id="custom_widgets_animated_image_gallery_enabled" value="yes" <?php checked($animated_image_gallery_enabled, 'yes'); ?> />
                            Enable
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Animated Text Widget</th>
                    <td>
                        <label for="custom_widgets_animated_text_enabled">
                            <input type="checkbox" name="custom_widgets_animated_text_enabled" id="custom_widgets_animated_text_enabled" value="yes" <?php checked($animated_text_enabled, 'yes'); ?> />
                            Enable
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Gradient Follower</th>
                    <td>
                        <label for="custom_widgets_gradient_follower_enabled">
                            <input type="checkbox" name="custom_widgets_gradient_follower_enabled" id="custom_widgets_gradient_follower_enabled" value="yes" <?php checked($gradient_follower_enabled, 'yes'); ?> />
                            Enable
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Gradient Color</th>
                    <td>
                        <input type="text" name="custom_widgets_gradient_color" value="<?php echo esc_attr($gradient_color); ?>" class="custom-widgets-color-field" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Gradient Size</th>
                    <td>
                        <input type="range" name="custom_widgets_gradient_size" min="50" max="300" value="<?php echo esc_attr($gradient_size); ?>" class="slider" />
                        <span id="gradient-size-value"><?php echo esc_attr($gradient_size); ?>px</span>
                    </td>
                </tr>
            </table>
            <div class="submit">
                <?php submit_button('Save Settings'); ?>
            </div>
        </form>
    </div>
    <?php
}

// Enqueue admin styles and scripts
function custom_widgets_admin_assets($hook) {
    if ($hook != 'toplevel_page_custom-widgets') {
        return;
    }
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('custom-widgets-admin-script', plugin_dir_url(__FILE__) . 'admin/js/admin-script.js', array('wp-color-picker'), null, true);
    wp_enqueue_style('custom-widgets-admin-style', plugin_dir_url(__FILE__) . 'admin/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'custom_widgets_admin_assets');

// Enqueue the gradient follower styles dynamically
function custom_widgets_enqueue_dynamic_styles() {
    $gradient_color = get_option('custom_widgets_gradient_color', '#9548e2');
    $gradient_size = get_option('custom_widgets_gradient_size', '100px');
    $gradient_follower_enabled = get_option('custom_widgets_gradient_follower_enabled', 'no');

    if ($gradient_follower_enabled === 'yes') {
        ?>
        <style>
        .gradient-follower {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10000;
        }
        .gradient-follower::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle <?php echo esc_attr($gradient_size); ?> at var(--x, 50%) var(--y, 50%), <?php echo esc_attr($gradient_color); ?> 0%, transparent 100%);
            opacity: 0.4;
        }
        </style>
        <div class="gradient-follower"></div>
        <?php
    }
}
add_action('wp_footer', 'custom_widgets_enqueue_dynamic_styles');
