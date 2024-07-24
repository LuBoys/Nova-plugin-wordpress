<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Bouncing_Text extends Widget_Base {

    public function get_name() {
        return 'bouncing_text';
    }

    public function get_title() {
        return __('Bouncing Text', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-animation-text';
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
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Bouncing Text', 'custom-widgets'),
            ]
        );

        $this->add_control(
            'header_tag',
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
                ],
                'default' => 'h1',
            ]
        );

        $this->add_control(
            'bounce_link',
            [
                'label' => __( 'Link', 'custom-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'custom-widgets' ),
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
                'label' => __('Text Alignment', 'custom-widgets'),
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
                    '{{WRAPPER}} .bouncing-text-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bounce_height',
            [
                'label' => __('Bounce Height', 'custom-widgets'),
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
                'label' => __('Bounce Speed', 'custom-widgets'),
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
        $link = $settings['bounce_link']['url'];
        ?>
        <div class="bouncing-text-container" style="text-align: <?php echo esc_attr($settings['text_align']); ?>;" data-bounce-height="<?php echo esc_attr($settings['bounce_height']['size']); ?>" data-bounce-speed="<?php echo esc_attr($settings['bounce_speed']['size']); ?>">
            <?php if (!empty($link)) : ?>
                <<?php echo $tag; ?> class="bouncing-text"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($settings['text']); ?></a></<?php echo $tag; ?>>
            <?php else : ?>
                <<?php echo $tag; ?> class="bouncing-text"><?php echo esc_html($settings['text']); ?></<?php echo $tag; ?>>
            <?php endif; ?>
        </div>
        <?php
    }
    

    protected function _content_template() {
        ?>
        <#
        var tag = settings.header_tag;
        var bounce_height = settings.bounce_height.size;
        var bounce_speed = settings.bounce_speed.size;
        var link = settings.bounce_link.url;
        #>
        <div class="bouncing-text-container" style="text-align: {{{ settings.text_align }}};" data-bounce-height="{{ bounce_height }}" data-bounce-speed="{{ bounce_speed }}">
            <# if (link) { #>
                <{{{ tag }}} class="bouncing-text"><a href="{{{ link }}}">{{{ settings.text }}}</a></{{{ tag }}}>
            <# } else { #>
                <{{{ tag }}} class="bouncing-text">{{{ settings.text }}}</{{{ tag }}}>
            <# } #>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Bouncing_Text());
