<?php

class ET_Builder_Module_Bouncing_Text extends ET_Builder_Module {
    public $slug       = 'et_pb_bouncing_text';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => 'https://example.com',
        'author'     => 'Votre Nom',
        'author_uri' => 'https://example.com',
    );

    public function init() {
        $this->name = esc_html__( 'Bouncing Text', 'custom-widgets' );
    }

    public function get_fields() {
        return array(
            'text' => array(
                'label'           => esc_html__( 'Texte', 'custom-widgets' ),
                'type'            => 'text',
                'default'         => 'Bouncing Text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Saisissez votre texte ici.', 'custom-widgets' ),
            ),
            'header_tag' => array(
                'label'           => esc_html__( 'Balise HTML', 'custom-widgets' ),
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
            'bounce_link' => array(
                'label'           => esc_html__( 'Lien', 'custom-widgets' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'URL pour le lien du texte.', 'custom-widgets' ),
            ),
            'bounce_height' => array(
                'label'           => esc_html__( 'Hauteur de Rebond', 'custom-widgets' ),
                'type'            => 'range',
                'option_category' => 'configuration',
                'default'         => '150px',
                'range_settings'  => array(
                    'min'  => '50',
                    'max'  => '300',
                    'step' => '10',
                ),
            ),
            'bounce_speed' => array(
                'label'           => esc_html__( 'Vitesse de Rebond', 'custom-widgets' ),
                'type'            => 'range',
                'option_category' => 'configuration',
                'default'         => '0.5s',
                'range_settings'  => array(
                    'min'  => '0.1',
                    'max'  => '3',
                    'step' => '0.1',
                ),
            ),
            'text_color' => array(
                'label'           => esc_html__( 'Couleur du Texte', 'custom-widgets' ),
                'type'            => 'color',
                'option_category' => 'basic_option',
                'default'         => '#000000',
            ),
            'text_align' => array(
                'label'           => esc_html__( 'Alignement du Texte', 'custom-widgets' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    'left'   => 'Gauche',
                    'center' => 'Centre',
                    'right'  => 'Droite',
                ),
                'default' => 'center',
            ),
        );
    }

    public function render($attrs, $content = null, $render_slug) {
        $text           = $this->props['text'];
        $header_tag     = $this->props['header_tag'];
        $link           = $this->props['bounce_link'];
        $bounce_height  = $this->props['bounce_height'];
        $bounce_speed   = $this->props['bounce_speed'];
        $text_color     = $this->props['text_color'];
        $text_align     = $this->props['text_align'];

        $output = sprintf(
            '<div class="bouncing-text-container" style="text-align: %1$s;" data-bounce-height="%2$s" data-bounce-speed="%3$s">',
            esc_attr($text_align),
            esc_attr($bounce_height),
            esc_attr($bounce_speed)
        );

        if (!empty($link)) {
            $output .= sprintf(
                '<%1$s class="bouncing-text" style="color: %2$s;"><a href="%3$s">%4$s</a></%1$s>',
                esc_html($header_tag),
                esc_attr($text_color),
                esc_url($link),
                esc_html($text)
            );
        } else {
            $output .= sprintf(
                '<%1$s class="bouncing-text" style="color: %2$s;">%3$s</%1$s>',
                esc_html($header_tag),
                esc_attr($text_color),
                esc_html($text)
            );
        }

        $output .= '</div>';

        return $output;
    }

    public function render_visual_builder_content() {
        return $this->render();
    }
}

new ET_Builder_Module_Bouncing_Text();
