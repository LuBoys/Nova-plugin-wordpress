<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class DraggableModule extends ET_Builder_Module {

    public $slug       = 'et_pb_draggable';
    public $vb_support = 'on';

    protected $module_credits = array(
        'author'     => 'Votre Nom',
        'author_uri' => 'https://votre-site.com',
    );

    public function init() {
        $this->name = esc_html__('Draggable', 'et_builder');

        $this->settings_modal_toggles = array(
            'general' => array(
                'toggles' => array(
                    'content' => esc_html__('Content', 'et_builder'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'text' => array(
                        'title'    => esc_html__('Text', 'et_builder'),
                        'priority' => 49,
                    ),
                ),
            ),
        );

        $this->advanced_fields = array(
            'fonts' => array(
                'text' => array(
                    'css'          => array(
                        'main' => '%%order_class%% .draggable-element',
                    ),
                    'font_size'    => array(
                        'default' => '14px',
                    ),
                    'line_height'  => array(
                        'default' => '1.7em',
                    ),
                ),
            ),
            'text' => array(
                'use_text_orientation' => true,
                'css'                  => array(
                    'main' => '%%order_class%% .draggable-element',
                ),
            ),
        );
    }

    public function get_fields() {
        return array(
            'content_type' => array(
                'label'           => esc_html__('Type de Contenu', 'et_builder'),
                'type'            => 'select',
                'options'         => array(
                    'text'  => esc_html__('Texte', 'et_builder'),
                    'image' => esc_html__('Image', 'et_builder'),
                    'icon'  => esc_html__('Icône', 'et_builder'),
                ),
                'default'         => 'text',
                'toggle_slug'     => 'content',
            ),
            'text' => array(
                'label'           => esc_html__('Texte', 'et_builder'),
                'type'            => 'text',
                'default'         => esc_html__('Draggable Element', 'et_builder'),
                'toggle_slug'     => 'content',
                'show_if'         => array('content_type' => 'text'),
            ),
            'html_tag' => array(
                'label'           => esc_html__('HTML Tag', 'et_builder'),
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
                'toggle_slug'     => 'content',
                'show_if'         => array('content_type' => 'text'),
            ),
            'image' => array(
                'label'           => esc_html__('Choisir une Image', 'et_builder'),
                'type'            => 'upload',
                'upload_button_text' => esc_attr__('Upload an image', 'et_builder'),
                'choose_text'     => esc_attr__('Choose an Image', 'et_builder'),
                'default'         => '',
                'toggle_slug'     => 'content',
                'show_if'         => array('content_type' => 'image'),
            ),
            'icon' => array(
                'label'           => esc_html__('Icône', 'et_builder'),
                'type'            => 'select_icon',
                'default'         => '%%icon%%',
                'toggle_slug'     => 'content',
                'show_if'         => array('content_type' => 'icon'),
            ),
        );
    }

    public function render($attrs, $content = null, $render_slug) {
        $content_type = $this->props['content_type'];
        $html_tag = $this->props['html_tag'];
        $text = $this->props['text'];
        $image = $this->props['image'];
        $icon = $this->props['icon'];

        $content = '<div class="draggable-element" style="position: absolute;">';

        if ($content_type === 'text') {
            $content .= sprintf('<%1$s>%2$s</%1$s>', esc_html($html_tag), esc_html($text));
        } elseif ($content_type === 'image') {
            $content .= sprintf('<img src="%1$s" alt="" />', esc_url($image));
        } elseif ($content_type === 'icon') {
            $content .= sprintf('<span class="et-pb-icon">%1$s</span>', esc_html($icon));
        }

        $content .= '</div>';

        return $content;
    }
}

new DraggableModule();

