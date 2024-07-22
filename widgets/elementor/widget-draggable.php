<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Draggable extends Widget_Base {

    public function get_name() {
        return 'draggable';
    }

    public function get_title() {
        return __('Draggable', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-drag-n-drop';
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
            'content_type',
            [
                'label' => __('Type de Contenu', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'text' => __('Texte', 'custom-widgets'),
                    'image' => __('Image', 'custom-widgets'),
                    'icon' => __('Icône', 'custom-widgets'),
                ],
                'default' => 'text',
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Texte', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Draggable Element', 'custom-widgets'),
                'condition' => [
                    'content_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => __('HTML Tag', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'P',
                    'div' => 'DIV',
                ],
                'default' => 'div',
                'condition' => [
                    'content_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choisir une Image', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'content_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icône', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'content_type' => 'icon',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_text_section',
            [
                'label' => __('Text', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Alignment', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'custom-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'custom-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'custom-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justify', 'custom-widgets'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .draggable-element' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .draggable-element' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .draggable-element',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .draggable-element',
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label' => __('Blend Mode', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal' => __('Normal', 'custom-widgets'),
                    'multiply' => __('Multiply', 'custom-widgets'),
                    'screen' => __('Screen', 'custom-widgets'),
                    'overlay' => __('Overlay', 'custom-widgets'),
                    'darken' => __('Darken', 'custom-widgets'),
                    'lighten' => __('Lighten', 'custom-widgets'),
                    'color-dodge' => __('Color Dodge', 'custom-widgets'),
                    'color-burn' => __('Color Burn', 'custom-widgets'),
                    'hard-light' => __('Hard Light', 'custom-widgets'),
                    'soft-light' => __('Soft Light', 'custom-widgets'),
                    'difference' => __('Difference', 'custom-widgets'),
                    'exclusion' => __('Exclusion', 'custom-widgets'),
                    'hue' => __('Hue', 'custom-widgets'),
                    'saturation' => __('Saturation', 'custom-widgets'),
                    'color' => __('Color', 'custom-widgets'),
                    'luminosity' => __('Luminosity', 'custom-widgets'),
                ],
                'default' => 'normal',
                'selectors' => [
                    '{{WRAPPER}} .draggable-element' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Image', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_align',
            [
                'label' => __('Alignment', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'custom-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'custom-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'custom-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .draggable-element' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_max_width',
            [
                'label' => __('Max Width', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Height', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_opacity',
            [
                'label' => __('Opacity', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .draggable-element img',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .draggable-element img',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element img' => 'border-radius: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .draggable-element img',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Icon', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => __('Alignment', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'custom-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'custom-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'custom-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .draggable-element i' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Primary Color', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .draggable-element i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Size', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_rotate',
            [
                'label' => __('Rotation', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .draggable-element i' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $content = '<div class="draggable-container">'; // Container

        if ($settings['content_type'] == 'text') {
            $tag = $settings['html_tag'];
            $content .= '<' . $tag . ' class="draggable-element">' . esc_html($settings['text']) . '</' . $tag . '>';
        } elseif ($settings['content_type'] == 'image') {
            $content .= '<div class="draggable-element"><img src="' . esc_url($settings['image']['url']) . '" alt=""></div>';
        } elseif ($settings['content_type'] == 'icon') {
            $icon_html = \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
            $content .= '<div class="draggable-element">' . $icon_html . '</div>';
        }

        $content .= '</div>';
        echo $content;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Draggable());
