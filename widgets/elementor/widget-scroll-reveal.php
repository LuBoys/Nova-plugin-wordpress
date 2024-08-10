<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Scroll_Reveal extends Widget_Base {

    public function get_name() {
        return 'scroll-reveal';
    }

    public function get_title() {
        return __('Scroll Reveal Animation', 'nova-widgets');
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
                'default' => __('Scroll Reveal Text', 'nova-widgets'),
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
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
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
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .scroll-reveal' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_hover_color',
            [
                'label' => __('Hover Text Color', 'nova-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .scroll-reveal:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'scroll-reveal');

        if ($settings['link']['url']) {
            $this->add_link_attributes('link', $settings['link']);
            echo '<a ' . $this->get_render_attribute_string('link') . '>';
        }

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';
        echo esc_html($settings['text']);
        echo '</div>';

        if ($settings['link']['url']) {
            echo '</a>';
        }
    }

    protected function _content_template() {
        ?>
        <#
        var link = settings.link.url ? '<a href="' + settings.link.url + '">' : '';
        var link_close = settings.link.url ? '</a>' : '';
        #>
        {{{ link }}}
        <div class="scroll-reveal">
            {{{ settings.text }}}
        </div>
        {{{ link_close }}}
        <?php
    }
}
