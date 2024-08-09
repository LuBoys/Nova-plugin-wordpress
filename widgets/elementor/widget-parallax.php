<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Parallax extends Widget_Base {

    public function get_name() {
        return 'parallax';
    }

    public function get_title() {
        return __('Parallax', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-scroll';
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
            'image',
            [
                'label' => __('Image', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __('Speed', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
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
            'image_opacity',
            [
                'label' => __('Opacity', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .parallax-element' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .parallax-element',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .parallax-element',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .parallax-element' => 'border-radius: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .parallax-element',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<div class="parallax-wrapper" data-speed="' . esc_attr($settings['speed']['size']) . '">';
        echo '<img src="' . esc_url($settings['image']['url']) . '" alt="" class="parallax-element">';
        echo '</div>';
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Parallax());
