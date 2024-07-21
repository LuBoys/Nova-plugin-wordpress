<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directement

class Widget_Carte_3D_Tournante extends Widget_Base {

    public function get_name() {
        return 'carte_3d_tournante';
    }

    public function get_title() {
        return __('Carte 3D Tournante', 'custom-widgets');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Contenu', 'custom-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choisir une image', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Titre', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Titre de la carte', 'custom-widgets'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Description de la carte', 'custom-widgets'),
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
            'title_color',
            [
                'label' => __('Couleur du titre', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carte-3d-tournante .titre' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .carte-3d-tournante .titre',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Couleur de la description', 'custom-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carte-3d-tournante .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography_description',
                'selector' => '{{WRAPPER}} .carte-3d-tournante .description',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="carte-3d-tournante">
            <div class="carte">
                <div class="face avant">
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                </div>
                <div class="face arriere">
                    <h3 class="titre"><?php echo esc_html($settings['title']); ?></h3>
                    <p class="description"><?php echo esc_html($settings['description']); ?></p>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var image = settings.image.url;
        var title = settings.title;
        var description = settings.description;
        #>
        <div class="carte-3d-tournante">
            <div class="carte">
                <div class="face avant">
                    <img src="{{ image }}" alt="{{ title }}">
                </div>
                <div class="face arriere">
                    <h3 class="titre">{{{ title }}}</h3>
                    <p class="description">{{{ description }}}</p>
                </div>
            </div>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget_Carte_3D_Tournante());
?>
