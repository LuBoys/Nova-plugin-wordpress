<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Scroll_Animation extends Widget_Base {

    public function get_name() {
        return 'scroll_animation';
    }

    public function get_title() {
        return __('Scroll Animation', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-scroll';
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
                'default' => __('Scroll to see the animation!', 'custom-widgets'),
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
                    '{{WRAPPER}} .scroll-animation-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .scroll-animation-text',
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed (seconds)', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1.5,
                'description' => __('Adjust the speed of the scroll animation', 'custom-widgets'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="scroll-animation-text" data-speed="<?php echo esc_attr($settings['animation_speed']); ?>">
            <?php echo esc_html($settings['text']); ?>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Scroll_Animation());
