<?php
/**
 * Plugin Name: Nova Widgets
 * Description: Une collection de widgets Elementor personnalisés, y compris des éléments modernes avec GSAP et plus encore, créés par <a href="https://nova-on.com" target="_blank">Nova web agency</a>.
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
    // Common styles and scripts for Elementor
    wp_enqueue_style('custom-widgets-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', array(), null, true);
    wp_enqueue_script('custom-widgets-draggable-script', plugin_dir_url(__FILE__) . 'js/draggable.js', array('jquery', 'gsap-js'), null, true);
    wp_enqueue_script('custom-widgets-bouncing-text-script', plugin_dir_url(__FILE__) . 'js/bouncing-text.js', array('gsap-js'), null, true);
    wp_enqueue_script('custom-widgets-split-text-script', plugin_dir_url(__FILE__) . 'js/split-text.js', array('gsap-js'), null, true);

    // Enqueue scripts and styles for the Slide Fade widget
    wp_enqueue_style('custom-widgets-slide-fade-style', plugin_dir_url(__FILE__) . 'css/slide-fade.css');
    wp_enqueue_script('custom-widgets-slide-fade-script', plugin_dir_url(__FILE__) . 'js/slide-fade.js', array('gsap-js'), null, true);

    wp_enqueue_style('custom-widgets-scroll-animation-style', plugin_dir_url(__FILE__) . 'css/scroll-animation.css');
    wp_enqueue_script('scrolltrigger-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js', array('gsap-js'), null, true);
    wp_enqueue_script('custom-widgets-scroll-animation-script', plugin_dir_url(__FILE__) . 'js/scroll-animation.js', array('gsap-js', 'scrolltrigger-js'), null, true);

    // Enqueue scripts and styles for the Parallax widget
    wp_enqueue_style('custom-widgets-parallax-style', plugin_dir_url(__FILE__) . 'css/parallax.css');
    wp_enqueue_script('custom-widgets-parallax-script', plugin_dir_url(__FILE__) . 'js/parallax.js', array('jquery'), null, true);

    // Enqueue scripts and styles for the Reveal Blur widget
    wp_enqueue_style('custom-widgets-reveal-blur-style', plugin_dir_url(__FILE__) . 'css/reveal-blur.css');
    wp_enqueue_script('custom-widgets-reveal-blur-script', plugin_dir_url(__FILE__) . 'js/reveal-blur.js', array('gsap-js', 'scrolltrigger-js'), null, true);
}
add_action('wp_enqueue_scripts', 'custom_widgets_enqueue_assets');

// Register the widgets for Elementor
function register_custom_elementor_widgets($widgets_manager) {
    require_once(__DIR__ . '/widgets/elementor/widget-draggable.php');
    $widgets_manager->register(new \Elementor\Widget_Draggable());

    require_once(__DIR__ . '/widgets/elementor/widget-bouncing-text.php');
    $widgets_manager->register(new \Elementor\Widget_Bouncing_Text());

    require_once(__DIR__ . '/widgets/elementor/widget-split-text.php');
    $widgets_manager->register(new \Elementor\Widget_Split_Text());

    require_once(__DIR__ . '/widgets/elementor/widget-slide-fade.php');
    $widgets_manager->register(new \Elementor\Widget_Slide_Fade());

    require_once(__DIR__ . '/widgets/elementor/widget-scroll-animation.php');
    $widgets_manager->register(new \Elementor\Widget_Scroll_Animation());

    require_once(__DIR__ . '/widgets/elementor/widget-parallax.php');
    $widgets_manager->register(new \Elementor\Widget_Parallax());

    require_once(__DIR__ . '/widgets/elementor/widget-reveal-blur.php');
    $widgets_manager->register(new \Elementor\Widget_Reveal_Blur());
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

        $bouncing_text_enabled = isset($_POST['custom_widgets_bouncing_text_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_bouncing_text_enabled', $bouncing_text_enabled);

        $split_text_enabled = isset($_POST['custom_widgets_split_text_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_split_text_enabled', $split_text_enabled);

        $slide_fade_enabled = isset($_POST['custom_widgets_slide_fade_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_slide_fade_enabled', $slide_fade_enabled);

        $scroll_animation_enabled = isset($_POST['custom_widgets_scroll_animation_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_scroll_animation_enabled', $scroll_animation_enabled);

        $parallax_enabled = isset($_POST['custom_widgets_parallax_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_parallax_enabled', $parallax_enabled);

        $reveal_blur_enabled = isset($_POST['custom_widgets_reveal_blur_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_reveal_blur_enabled', $reveal_blur_enabled);

        $elementor_enabled = isset($_POST['custom_widgets_elementor_enabled']) ? 'yes' : 'no';
        update_option('custom_widgets_elementor_enabled', $elementor_enabled);
    }

    $draggable_enabled = get_option('custom_widgets_draggable_enabled', 'no');
    $bouncing_text_enabled = get_option('custom_widgets_bouncing_text_enabled', 'no');
    $split_text_enabled = get_option('custom_widgets_split_text_enabled', 'no');
    $slide_fade_enabled = get_option('custom_widgets_slide_fade_enabled', 'no');
    $scroll_animation_enabled = get_option('custom_widgets_scroll_animation_enabled', 'no');
    $parallax_enabled = get_option('custom_widgets_parallax_enabled', 'no');
    $reveal_blur_enabled = get_option('custom_widgets_reveal_blur_enabled', 'no');
    $elementor_enabled = get_option('custom_widgets_elementor_enabled', 'no');
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
                    <th scope="row">Widget Slide Fade (Slide Fade)</th>
                    <td>
                        <label for="custom_widgets_slide_fade_enabled">
                            <input type="checkbox" name="custom_widgets_slide_fade_enabled" id="custom_widgets_slide_fade_enabled" value="yes" <?php checked($slide_fade_enabled, 'yes'); ?> />
                            Anime le texte avec un effet de fondu glissé.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Scroll Animation (Scroll Animation)</th>
                    <td>
                        <label for="custom_widgets_scroll_animation_enabled">
                            <input type="checkbox" name="custom_widgets_scroll_animation_enabled" id="custom_widgets_scroll_animation_enabled" value="yes" <?php checked($scroll_animation_enabled, 'yes'); ?> />
                            Anime les éléments au défilement.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Parallax (Parallax)</th>
                    <td>
                        <label for="custom_widgets_parallax_enabled">
                            <input type="checkbox" name="custom_widgets_parallax_enabled" id="custom_widgets_parallax_enabled" value="yes" <?php checked($parallax_enabled, 'yes'); ?> />
                            Crée un effet de parallaxe sur les éléments.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Widget Reveal Blur (Reveal Blur)</th>
                    <td>
                        <label for="custom_widgets_reveal_blur_enabled">
                            <input type="checkbox" name="custom_widgets_reveal_blur_enabled" id="custom_widgets_reveal_blur_enabled" value="yes" <?php checked($reveal_blur_enabled, 'yes'); ?> />
                            Crée un effet de révélation avec flou.
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Activer pour Elementor</th>
                    <td>
                        <label for="custom_widgets_elementor_enabled">
                            <input type="checkbox" name="custom_widgets_elementor_enabled" id="custom_widgets_elementor_enabled" value="yes" <?php checked($elementor_enabled, 'yes'); ?> />
                            Activer les widgets pour Elementor.
                        </label>
                    </td>
                </tr>
            </table>
            <div class="submit">
                <?php submit_button('Enregistrer les paramètres'); ?>
            </div>
        </form>
        <hr>
        <h2>Feedback</h2>
        <form method="post" action="">
            <?php wp_nonce_field('custom_widgets_save_feedback', 'custom_widgets_feedback_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Votre avis</th>
                    <td>
                        <textarea name="custom_widgets_feedback" rows="5" cols="50"></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Votre email</th>
                    <td>
                        <input type="email" name="custom_widgets_user_email" value="" class="regular-text" />
                    </td>
                </tr>
            </table>
            <div class="submit">
                <?php submit_button('Envoyer'); ?>
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
    wp_enqueue_style('custom-widgets-admin-style', plugin_dir_url(__FILE__) . 'admin/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'custom_widgets_admin_assets');

// Handle feedback form submission
function custom_widgets_handle_feedback_submission() {
    if (isset($_POST['custom_widgets_feedback_nonce']) && wp_verify_nonce($_POST['custom_widgets_feedback_nonce'], 'custom_widgets_save_feedback')) {
        $feedback = sanitize_textarea_field($_POST['custom_widgets_feedback']);
        $user_email = sanitize_email($_POST['custom_widgets_user_email']);

        // Send email
        $to = 'votre.email@exemple.com';
        $subject = 'Nouveau Feedback sur Nova Widgets';
        $message = 'Feedback: ' . $feedback . "\nEmail: " . $user_email;
        $headers = ['Content-Type: text/plain; charset=UTF-8'];

        wp_mail($to, $subject, $message, $headers);
    }
}
add_action('admin_post_custom_widgets_handle_feedback', 'custom_widgets_handle_feedback_submission');
?>
