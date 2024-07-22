<?php

class ET_Builder_Module_Split_Text extends ET_Builder_Module {
    public $slug       = 'et_pb_split_text';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => 'https://example.com',
        'author'     => 'Your Name',
        'author_uri' => 'https://example.com',
    );

    public function init() {
        $this->name = esc_html__( 'Split Text Animation', 'custom-widgets' );
    }

    public function get_fields() {
        return array(
            'text' => array(
                'label'           => esc_html__( 'Text', 'custom-widgets' ),
                'type'            => 'text',
                'default'         => 'Split Text Animation',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Input your text here.', 'custom-widgets' ),
            ),
            'header_tag' => array(
                'label'           => esc_html__( 'HTML Tag', 'custom-widgets' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p'  => 'P',
                ),
                'default' => 'h1',
            ),
            'split_link' => array(
                'label'           => esc_html__( 'Link', 'custom-widgets' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'URL for the text link.', 'custom-widgets' ),
            ),
            'text_color' => array(
                'label'           => esc_html__( 'Text Color', 'custom-widgets' ),
                'type'            => 'color',
                'option_category' => 'basic_option',
                'default'         => '#000000',
            ),
            'text_align' => array(
                'label'           => esc_html__( 'Text Alignment', 'custom-widgets' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    'left'   => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right',
                ),
                'default' => 'center',
            ),
        );
    }

    public function render($attrs, $content = null, $render_slug) {
        $text       = $this->props['text'];
        $header_tag = $this->props['header_tag'];
        $link       = $this->props['split_link'];
        $text_color = $this->props['text_color'];
        $text_align = $this->props['text_align'];

        $output = sprintf(
            '<div class="split-text-container" style="text-align: %1$s;">',
            esc_attr($text_align)
        );

        $output .= sprintf(
            '<%1$s class="split-text" style="color: %2$s;">',
            esc_html($header_tag),
            esc_attr($text_color)
        );

        foreach (str_split($text) as $char) {
            $output .= sprintf(
                '<span class="char">%1$s</span>',
                esc_html($char)
            );
        }

        if (!empty($link)) {
            $output .= sprintf(
                '<a href="%1$s">%2$s</a>',
                esc_url($link),
                esc_html($text)
            );
        }

        $output .= sprintf(
            '</%1$s>',
            esc_html($header_tag)
        );

        $output .= '</div>';

        return $output;
    }

    public function render_visual_builder_content() {
        return $this->render();
    }
}

new ET_Builder_Module_Split_Text();
