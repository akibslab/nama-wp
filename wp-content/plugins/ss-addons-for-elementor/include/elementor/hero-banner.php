<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for Hero Banner.
 */
class SS_Hero_Banner extends Widget_Base {

    /**
     * Retrieve the widget name.
     */
    public function get_name() {
        return 'hero-banner';
    }

    /**
     * Retrieve the widget title.
     */
    public function get_title() {
        return __('SS Hero Banner', 'ss-addons');
    }

    /**
     * Retrieve the widget icon.
     */
    public function get_icon() {
        return 'eicon-banner ss-icon';
    }

    /**
     * Retrieve the list of categories 
     */
    public function get_categories() {
        return ['ss-addons'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     */
    public function get_script_depends() {
        return ['ss-addons'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls() {

        // ss_section_title
        $this->start_controls_section(
            'ss_section_title',
            [
                'label' => esc_html__('Title & Content', 'ss-addons'),
            ]
        );
        $this->add_control(
            'ss_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('SS Title Here', 'ss-addons'),
                'placeholder' => esc_html__('Type Heading Text', 'ss-addons'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_desctiption',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('SS section description here', 'ss-addons'),
                'placeholder' => esc_html__('Type section description here', 'ss-addons'),
            ]
        );
        $this->add_control(
            'ss_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'ss-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'ss-addons'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'ss-addons'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'ss-addons'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'ss-addons'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'ss-addons'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'ss-addons'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h1',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        // ss_btn_button_group
        $this->start_controls_section(
            'ss_btn_button_group',
            [
                'label' => esc_html__('Button', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ss-addons'),
                'label_off' => esc_html__('Hide', 'ss-addons'),
                'return_value' => 'yes',
                'default' => true,
            ]
        );

        $this->add_control(
            'ss_btn_text',
            [
                'label' => esc_html__('Button Text', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'ss-addons'),
                'title' => esc_html__('Enter button text', 'ss-addons'),
                'label_block' => true,
                'condition' => [
                    'ss_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'ss_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'ss_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'ss_btn_link',
            [
                'label' => esc_html__('Button link', 'ss-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ss-addons'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'ss_btn_link_type' => '1',
                    'ss_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'ss-addons'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ss_get_all_pages(),
                'condition' => [
                    'ss_btn_link_type' => '2',
                    'ss_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();


        // _ss_image
        $this->start_controls_section(
            '_ss_image_section',
            [
                'label' => esc_html__('Thumbnail', 'ss-addons'),
            ]
        );
        $this->add_control(
            'ss_image',
            [
                'label' => esc_html__('Desktop Image', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'ss_mobile_image',
            [
                'label' => esc_html__('Mobile Image', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ss_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();


        // TAB_STYLE
        $this->start_controls_section(
            'ss_hero_style',
            [
                'label' => __('Style', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ss_hero_background_color',
            [
                'label' => esc_html__('Background Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'ss_hero_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ss_hero_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hero_image_style',
            [
                'label' => __('Image', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Width', 'ss-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero_img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_max_width',
            [
                'label' => esc_html__('Max Width', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero_img img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Height', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero_img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_image_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_image_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // title
        $this->start_controls_section(
            '_title_style',
            [
                'label' => __('Title', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_title_color',
            [
                'label' => esc_html__('Text Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_content .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .hero_content .title',
            ]
        );
        $this->add_responsive_control(
            '_title_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_title_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // description
        $this->start_controls_section(
            '_description_style',
            [
                'label' => __('Description', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_description_color',
            [
                'label' => esc_html__('Text Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_content .text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .hero_content .text'
            ]
        );
        $this->add_responsive_control(
            '_description_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_description_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // button 1
        $this->start_controls_section(
            '_btn_style',
            [
                'label' => __('Button', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .hero_content .hero_btn'
            ]
        );

        $this->start_controls_tabs(
            'btn_tabs'
        );

        $this->start_controls_tab(
            'btn_normal_tab',
            [
                'label' => esc_html__('Normal', 'ss-addons'),
            ]
        );
        $this->add_control(
            'btn_text_color',
            [
                'label' => esc_html__('Text Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_color',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hero_content .hero_btn'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'ss-addons'),
            ]
        );
        $this->add_control(
            'btn_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover_color',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hero_content .hero_btn:hover'
            ]
        );
        $this->add_control(
            'btn_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'btn1_border_style!' => ['', 'none'],
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'btn_border_style',
            [
                'label' => esc_html__('Border Type', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    '' => esc_html__('Default', 'ss-addons'),
                    'none' => esc_html__('None', 'ss-addons'),
                    'solid'  => esc_html__('Solid', 'ss-addons'),
                    'dashed' => esc_html__('Dashed', 'ss-addons'),
                    'dotted' => esc_html__('Dotted', 'ss-addons'),
                    'double' => esc_html__('Double', 'ss-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'border-style: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'btn_border_width',
            [
                'label' => esc_html__('Border Width', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_border_style!' => ['', 'none'],
                ],
            ]
        );
        $this->add_control(
            'btn_border_color',
            [
                'label' => esc_html__('Border Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'btn_border_style!' => ['', 'none'],
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .hero_content .hero_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Link
        if ('2' == $settings['ss_btn_link_type']) {
            $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
            $this->add_render_attribute('ss-button-arg', 'target', '_self');
            $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('ss-button-arg', 'class', 'btn hero_btn');
        } else {
            if (!empty($settings['ss_btn_link']['url'])) {
                $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                $this->add_render_attribute('ss-button-arg', 'class', 'btn hero_btn');
            }
        }


        if (!empty($settings['ss_image']['url'])) {
            $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
            $ss_image_alt           = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
        }


        $this->add_render_attribute('title_args', 'class', 'title');

?>

        <!-- start: Hero Section -->
        <section class="hero-section overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="hero_content">
                            <?php
                            if (!empty($settings['ss_title'])) :
                                printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($settings['ss_title_tag']),
                                    $this->get_render_attribute_string('title_args'),
                                    ss_kses($settings['ss_title'])
                                );
                            endif;
                            ?>
                            <?php if (!empty($settings['ss_desctiption'])) : ?>
                                <p class="text"><?php echo ss_kses($settings['ss_desctiption']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($settings['ss_btn_text'])) : ?>
                                <a <?php echo $this->get_render_attribute_string('ss-button-arg'); ?>>
                                    <?php echo $settings['ss_btn_text']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <?php if (!empty($settings['ss_image']['url'])) : ?>
                            <div class="hero_img">
                                <img src="<?php echo esc_url($ss_image); ?>" alt="<?php echo esc_attr($ss_image_alt); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Hero Section -->

<?php

    }
}

$widgets_manager->register(new SS_Hero_Banner());
