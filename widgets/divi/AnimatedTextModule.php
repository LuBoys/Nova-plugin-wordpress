<?php

class AnimatedTextModule extends ET_Builder_Module {
    public $slug = 'animated_text';
    public $vb_support = 'on';

    public function init() {
        $this->name = esc_html__('Animated Text', 'custom-widgets');
    }

    public function get_fields() {
        return array(
            'animated_text' => array(
                'label'           => esc_html__('Text', 'custom-widgets'),
                'type'            => 'text',
                'default'         => esc_html__('Your animated text here', 'custom-widgets'),
            ),
            'html_tag' => array(
                'label'           => esc_html__('HTML Tag', 'custom-widgets'),
                'type'            => 'select',
                'options'         => array(
                    'h1'  => 'H1',
                    'h2'  => 'H2',
                    'h3'  => 'H3',
                    'h4'  => 'H4',
                    'h5'  => 'H5',
                    'h6'  => 'H6',
                    'p'   => 'P',
                    'div' => 'DIV',
                ),
                'default'         => 'div',
            ),
            'text_color' => array(
                'label'           => esc_html__('Text Color', 'custom-widgets'),
                'type'            => 'color',
                'default'         => '#000000',
            ),
            'text_align' => array(
                'label'           => esc_html__('Text Alignment', 'custom-widgets'),
                'type'            => 'select',
                'options'         => array(
                    'left'   => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right',
                ),
                'default'         => 'left',
            ),
        );
    }

    public function render($attrs, $content = null, $render_slug) {
        $animated_text = $this->props['animated_text'];
        $html_tag = $this->props['html_tag'];
        $text_color = $this->props['text_color'];
        $text_align = $this->props['text_align'];

        $style = sprintf('color: %1$s; text-align: %2$s;', esc_attr($text_color), esc_attr($text_align));

        return sprintf(
            '<%1$s class="animated-text" style="%3$s">%2$s</%1$s>',
            esc_html($html_tag),
            esc_html($animated_text),
            esc_attr($style)
        );
    }

    public function render_visual_builder_content() {
        return $this->render();
    }
}

new AnimatedTextModule;
