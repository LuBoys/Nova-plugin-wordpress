<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Split_Text extends Widget_Base {

    public function get_name() {
        return 'split_text';
    }

    public function get_title() {
        return __('Split Text Animation', 'custom-widgets');
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
                'default' => __('Split Text Animation', 'custom-widgets'),
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
            'split_link',
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
                    '{{WRAPPER}} .split-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .split-text',
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
                    '{{WRAPPER}} .split-text-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tag = $settings['header_tag'];
        $text = $settings['text'];
        $link = $settings['split_link']['url'];
        ?>
        <div class="split-text-container" style="text-align: <?php echo esc_attr($settings['text_align']); ?>;">
            <<?php echo $tag; ?> class="split-text">
                <?php foreach (str_split($text) as $char): ?>
                    <span class="char"><?php echo esc_html($char); ?></span>
                <?php endforeach; ?>
                <?php if (!empty($link)) : ?>
                    <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($text); ?></a>
                <?php endif; ?>
            </<?php echo $tag; ?>>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var tag = settings.header_tag;
        var text = settings.text;
        var chars = text.split('');
        var link = settings.split_link.url;
        #>
        <div class="split-text-container" style="text-align: {{{ settings.text_align }}};">
            <{{{ tag }}} class="split-text">
                <# chars.forEach(function(char) { #>
                    <span class="char">{{{ char }}}</span>
                <# }); #>
                <# if (link) { #>
                    <a href="{{{ link }}}">{{{ text }}}</a>
                <# } #>
            </{{{ tag }}}>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Split_Text());
