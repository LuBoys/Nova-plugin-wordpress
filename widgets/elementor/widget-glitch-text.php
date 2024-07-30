<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Glitch_Text extends Widget_Base {

    public function get_name() {
        return 'glitch_text';
    }

    public function get_title() {
        return __('Glitch Text', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Text', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Glitch Text Effect', 'custom-widgets'),
            ]
        );

        $this->end_controls_section();

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
                    '{{WRAPPER}} .glitch-text-element' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="glitch-text-element">' . $settings['text'] . '</div>';
    }
}
