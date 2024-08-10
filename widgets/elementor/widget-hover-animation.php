<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Hover_Animation extends Widget_Base {

    public function get_name() {
        return 'hover_animation';
    }

    public function get_title() {
        return __('Hover Animation', 'nova-widgets');
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
                'label' => __('Content', 'nova-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Text', 'nova-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Hover over me!', 'nova-widgets'),
                'placeholder' => __('Enter your text', 'nova-widgets'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'nova-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'nova-widgets'),
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'nova-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'nova-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hover-animation-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => __('Hover Color', 'nova-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hover-animation-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $text = $settings['text'];
        $link = $settings['link']['url'];

        echo '<div class="hover-animation-wrapper">';
        if ($link) {
            echo '<a href="' . esc_url($link) . '" class="hover-animation-text">';
            echo esc_html($text);
            echo '</a>';
        } else {
            echo '<span class="hover-animation-text">' . esc_html($text) . '</span>';
        }
        echo '</div>';
    }

    protected function _content_template() {
        ?>
        <#
        var text = settings.text;
        var link = settings.link.url;
        #>
        <div class="hover-animation-wrapper">
            <# if (link) { #>
                <a href="{{ link }}" class="hover-animation-text">
                    {{{ text }}}
                </a>
            <# } else { #>
                <span class="hover-animation-text">{{{ text }}}</span>
            <# } #>
        </div>
        <?php
    }
}
