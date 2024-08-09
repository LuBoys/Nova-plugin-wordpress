<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Reveal_Blur extends Widget_Base {

    public function get_name() {
        return 'reveal_blur';
    }

    public function get_title() {
        return __('Reveal and Blur', 'custom-widgets');
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
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Reveal and Blur Effect', 'custom-widgets'),
            ]
        );

        $this->add_control(
            'blur_amount',
            [
                'label' => __('Blur Amount (px)', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
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
                    '{{WRAPPER}} .reveal-blur-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .reveal-blur-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="reveal-blur-text" data-blur-amount="<?php echo esc_attr($settings['blur_amount']['size']); ?>">
            <?php echo esc_html($settings['text']); ?>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Reveal_Blur());
