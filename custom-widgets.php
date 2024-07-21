<?php
/**
 * Plugin Name: Nova Widgets
 * Description: Une collection de widgets Elementor personnalisés, y compris des éléments glissants avec GSAP et plus encore, créés par <a href="https://nova-on.com" target="_blank">Nova web agency</a>.
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
    wp_enqueue_script('custom-widgets-bouncing-text-script', plugin_dir_url(__FILE__) . 'js/bouncing-text.js', array('gsap-js'), null, true);
    wp_enqueue_script('custom-widgets-split-text-script', plugin_dir_url(__FILE__) . 'js/split-text.js', array('gsap-js'), null, true);
    wp_enqueue_style('custom-widgets-animated-text-style', plugin_dir_url(__FILE__) . 'css/animated-text.css');
    wp_enqueue_style('custom-widgets-split-text-style', plugin_dir_url(__FILE__) . 'css/split-text.css');
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

    require_once(__DIR__ . '/widgets/widget-bouncing-text.php');
    $widgets_manager->register(new \Widget_Bouncing_Text());

    require_once(__DIR__ . '/widgets/widget-split-text.php');
    $widgets_manager->register(new \Widget_Split_Text());

    require_once(__DIR__ . '/widgets/widget-3d-map.php');
    $widgets_manager->register(new \Widget_3D_Map());
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
        plugin_dir_url(__FILE__) . 'img/logo.png'
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

        $bouncing_text_enabled = isset($_POST['custom_widgets_bouncing_text_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_bouncing_text_enabled', $bouncing_text_enabled);

        $split_text_enabled = isset($_POST['custom_widgets_split_text_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_split_text_enabled', $split_text_enabled);

        $map_3d_enabled = isset($_POST['custom_widgets_map_3d_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_map_3d_enabled', $map_3d_enabled);

        handle_feedback_submission();
    }

    $draggable_enabled = get_option('custom_widgets_draggable_enabled', 'no');
    $animated_image_gallery_enabled = get_option('custom_widgets_animated_image_gallery_enabled', 'no');
    $animated_text_enabled = get_option('custom_widgets_animated_text_enabled', 'no');
    $bouncing_text_enabled = get_option('custom_widgets_bouncing_text_enabled', 'no');
    $split_text_enabled = get_option('custom_widgets_split_text_enabled', 'no');
    $map_3d_enabled = get_option('custom_widgets_map_3d_enabled', 'no');
    ?>
    <div class="wrap custom-nova-settings">
        <h1>Paramètres de Nova Widgets</h1>
        <form method="post" action="">
            <?php wp_nonce_field('custom_widgets_save_settings', 'custom_widgets_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Widget Draggable (Draggable)</th>
                    <td>
                        <label for="custom_widgets_draggable_enabled">
                            <input type="checkbox" name="custom_widgets_draggable_enabled" id="custom_widgets_draggable_enabled" value="yes" <?php checked($draggable_enabled, 'yes'); ?> />
                            Permet de déplacer des éléments sur la page.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Galerie d'images animées (Animated Image Gallery)</th>
                    <td>
                        <label for="custom_widgets_animated_image_gallery_enabled">
                            <input type="checkbox" name="custom_widgets_animated_image_gallery_enabled" id="custom_widgets_animated_image_gallery_enabled" value="yes" <?php checked($animated_image_gallery_enabled, 'yes'); ?> />
                            Crée une galerie d'images animée avec divers effets.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Texte animé (Animated Text)</th>
                    <td>
                        <label for="custom_widgets_animated_text_enabled">
                            <input type="checkbox" name="custom_widgets_animated_text_enabled" id="custom_widgets_animated_text_enabled" value="yes" <?php checked($animated_text_enabled, 'yes'); ?> />
                            Ajoute un texte animé à votre page avec divers effets.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Texte rebondissant (Bouncing Text)</th>
                    <td>
                        <label for="custom_widgets_bouncing_text_enabled">
                            <input type="checkbox" name="custom_widgets_bouncing_text_enabled" id="custom_widgets_bouncing_text_enabled" value="yes" <?php checked($bouncing_text_enabled, 'yes'); ?> />
                            Crée un texte qui rebondit avec une hauteur et une vitesse personnalisables.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Texte fractionné (Split Text)</th>
                    <td>
                        <label for="custom_widgets_split_text_enabled">
                            <input type="checkbox" name="custom_widgets_split_text_enabled" id="custom_widgets_split_text_enabled" value="yes" <?php checked($split_text_enabled, 'yes'); ?> />
                            Fractionne le texte en caractères individuels et les anime.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Carte 3D (3D Map)</th>
                    <td>
                        <label for="custom_widgets_map_3d_enabled">
                            <input type="checkbox" name="custom_widgets_map_3d_enabled" id="custom_widgets_map_3d_enabled" value="yes" <?php checked($map_3d_enabled, 'yes'); ?> />
                            Affiche une carte 3D interactive.
                        </label>
                    </td>
                </tr>
            </table>
            <div class="submit">
                <?php submit_button('Enregistrer les paramètres'); ?>
            </div>
        </form>

        <h2>Votre Feedback</h2>
        <form method="post" action="">
            <?php wp_nonce_field('custom_widgets_save_feedback', 'custom_widgets_feedback_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Votre Feedback</th>
                    <td>
                        <textarea name="feedback" rows="5" cols="50"></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Votre Email</th>
                    <td>
                        <input type="email" name="user_email" />
                    </td>
                </tr>
            </table>
            <div class="submit">
                <?php submit_button('Envoyer le Feedback'); ?>
            </div>
        </form>
    </div>
    <?php
}

function handle_feedback_submission() {
    if (isset($_POST['custom_widgets_feedback_nonce']) && wp_verify_nonce($_POST['custom_widgets_feedback_nonce'], 'custom_widgets_save_feedback')) {
        $feedback = sanitize_text_field($_POST['feedback']);
        $user_email = sanitize_email($_POST['user_email']);

        if (!empty($feedback) && !empty($user_email)) {
            $to = 'nova.on.pro@gmail.com';
            $subject = 'Nouveau feedback de Nova Widgets';
            $message = "Feedback: $feedback\n\nEmail: $user_email";
            $headers = ['Content-Type: text/plain; charset=UTF-8'];

            wp_mail($to, $subject, $message, $headers);
        }
    }
}

// Enqueue admin styles and scripts
function custom_widgets_admin_assets($hook) {
    if ($hook != 'toplevel_page_custom-widgets') {
        return;
    }
    wp_enqueue_style('custom-widgets-admin-style', plugin_dir_url(__FILE__) . 'admin/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'custom_widgets_admin_assets');
