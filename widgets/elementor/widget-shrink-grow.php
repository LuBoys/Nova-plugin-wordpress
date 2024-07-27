<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Shrink_Grow extends Widget_Base {

    public function get_name() {
        return 'shrink_grow';
    }

    public function get_title() {
        return __('Shrink and Grow', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-resize-horizontal';
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
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Shrink and Grow', 'custom-widgets'),
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
                    '{{WRAPPER}} .shrink-grow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .shrink-grow',
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
                    '{{WRAPPER}} .shrink-grow-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="shrink-grow-container">
            <div class="shrink-grow"><?php echo $settings['text']; ?></div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var text = settings.text;
        #>
        <div class="shrink-grow-container">
            <div class="shrink-grow">{{{ text }}}</div>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Shrink_Grow());
