<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Widget_Bouncing_Text extends \Elementor\Widget_Base {

    public function get_name() {
        return 'bouncing_text';
    }

    public function get_title() {
        return __('Bouncing Text', 'nova-widgets');
    }

    public function get_icon() {
        return 'eicon-animation-text';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'nova-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Text', 'nova-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Bouncing Text', 'nova-widgets'),
            ]
        );

        $this->add_control(
            'header_tag',
            [
                'label' => __('HTML Tag', 'nova-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'Paragraph',
                ],
                'default' => 'h1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'nova-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'nova-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .bouncing-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .bouncing-text',
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Text Alignment', 'nova-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'nova-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'nova-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'nova-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .bouncing-text-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bounce_height',
            [
                'label' => __('Bounce Height', 'nova-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'size' => 150,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'bounce_speed',
            [
                'label' => __('Bounce Speed', 'nova-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.5,
                    'unit' => 's',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tag = $settings['header_tag'];
        ?>
        <div class="bouncing-text-container">
            <<?php echo $tag; ?> class="bouncing-text" data-bounce-height="<?php echo esc_attr($settings['bounce_height']['size']); ?>" data-bounce-speed="<?php echo esc_attr($settings['bounce_speed']['size']); ?>">
                <?php echo esc_html($settings['text']); ?>
            </<?php echo $tag; ?>>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var tag = settings.header_tag;
        var bounce_height = settings.bounce_height.size;
        var bounce_speed = settings.bounce_speed.size;
        #>
        <div class="bouncing-text-container">
            <{{{ tag }}} class="bouncing-text" data-bounce-height="{{ bounce_height }}" data-bounce-speed="{{ bounce_speed }}">
                {{{ settings.text }}}
            </{{{ tag }}}>
        </div>
        <?php
    }
}
