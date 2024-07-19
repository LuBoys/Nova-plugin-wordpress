<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Animated_Image_Gallery extends Widget_Base {

    public function get_name() {
        return 'animated_image_gallery';
    }

    public function get_title() {
        return __('Animated Image Gallery', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
            'gallery_images',
            [
                'label' => __('Add Images', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
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

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'default' => '4',
            ]
        );

        $this->add_control(
            'gap',
            [
                'label' => __('Gap', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-gallery-item' => 'margin: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns = $settings['columns'];

        if (!empty($settings['gallery_images'])) {
            echo '<div class="custom-gallery" style="display: grid; grid-template-columns: repeat(' . esc_attr($columns) . ', 1fr); gap: ' . esc_attr($settings['gap']['size']) . 'px;">';
            foreach ($settings['gallery_images'] as $image) {
                echo '<div class="custom-gallery-item">';
                echo '<img src="' . esc_url($image['url']) . '" alt="" />';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Animated_Image_Gallery());
