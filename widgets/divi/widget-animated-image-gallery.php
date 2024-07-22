<?php

class ET_Builder_Module_Animated_Image_Gallery extends ET_Builder_Module {
    public $slug       = 'et_pb_animated_image_gallery';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => 'https://example.com',
        'author'     => 'Your Name',
        'author_uri' => 'https://example.com',
    );

    public function init() {
        $this->name = esc_html__( 'Animated Image Gallery', 'custom-widgets' );
    }

    public function get_fields() {
        return array(
            'gallery_images' => array(
                'label'           => esc_html__( 'Add Images', 'custom-widgets' ),
                'type'            => 'upload-gallery',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Add images to the gallery.', 'custom-widgets' ),
            ),
            'columns' => array(
                'label'           => esc_html__( 'Columns', 'custom-widgets' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'default' => '4',
            ),
            'gap' => array(
                'label'           => esc_html__( 'Gap', 'custom-widgets' ),
                'type'            => 'range',
                'option_category' => 'configuration',
                'range_settings'  => array(
                    'min'  => '0',
                    'max'  => '50',
                    'step' => '1',
                ),
                'default' => '10',
                'unit'    => 'px',
            ),
        );
    }

    public function render($attrs, $content = null, $render_slug) {
        $gallery_images = $this->props['gallery_images'];
        $columns = $this->props['columns'];
        $gap = $this->props['gap'];

        $output = sprintf(
            '<div class="custom-gallery" style="display: grid; grid-template-columns: repeat(%1$s, 1fr); gap: %2$spx;">',
            esc_attr($columns),
            esc_attr($gap)
        );

        if (!empty($gallery_images)) {
            $images = explode(',', $gallery_images);
            foreach ($images as $image_id) {
                $image_url = wp_get_attachment_url($image_id);
                if ($image_url) {
                    $output .= sprintf(
                        '<div class="custom-gallery-item"><img src="%1$s" alt=""></div>',
                        esc_url($image_url)
                    );
                }
            }
        }

        $output .= '</div>';

        return $output;
    }

    public function render_visual_builder_content() {
        return $this->render(null, null, $this->slug);
    }
}

new ET_Builder_Module_Animated_Image_Gallery();
