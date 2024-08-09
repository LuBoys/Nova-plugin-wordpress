<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Glitch_Text extends Widget_Base {

    public function get_name() {
        return 'glitch_text';
    }

    public function get_title() {
        return __('Glitch Text with Rotation', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-animated-headline';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        // Section de contenu
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'texts',
            [
                'label' => __('Textes à faire défiler', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Premier texte, Deuxième texte, Troisième texte', 'custom-widgets'),
                'description' => __('Entrez les textes séparés par des virgules.', 'custom-widgets'),
            ]
        );

        $this->add_control(
            'rotation_speed',
            [
                'label' => __('Vitesse de rotation (secondes)', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->end_controls_section();

        // Section de style
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .glitch-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .glitch-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $texts = explode(',', $settings['texts']);
        $rotation_speed = $settings['rotation_speed'];

        echo '<div class="glitch-text-container">';
        foreach ($texts as $index => $text) {
            echo '<span class="glitch-text" data-index="' . $index . '" data-speed="' . esc_attr($rotation_speed) . '">' . esc_html($text) . '</span>';
        }
        echo '</div>';
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Glitch_Text());
