<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for Features.
 */
class SS_Features extends Widget_Base {

    /**
     * Retrieve the widget name.
     */
    public function get_name() {
        return 'ss-features';
    }

    /**
     * Retrieve the widget title.
     */
    public function get_title() {
        return __('SS Features', 'ss-addons');
    }

    /**
     * Retrieve the widget icon.
     */
    public function get_icon() {
        return 'ss-icon eicon-sitemap';
    }

    /**
     * Widget categories. 
     */
    public function get_categories() {
        return ['ss-addons'];
    }

    /**
     * Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['ss-addons'];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls() {
        // Service group
        $this->start_controls_section(
            'ss_features',
            [
                'label' => esc_html__('Features', 'ss-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ss_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'ss-addons'),
                    'icon' => esc_html__('Icon', 'ss-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'ss_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ss_features_icon_type' => 'image'
                ]

            ]
        );

        if (ss_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'ss_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'ss_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'ss_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'ss_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'ss_features_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Service Title', 'ss-addons'),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'ss_features_list',
            [
                'label' => esc_html__('Feature - List', 'ss-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ss_features_title' => ss_kses('Licensed finance firms<br> manage investment funds'),
                    ],
                    [
                        'ss_features_title' => ss_kses('Sharia-compliant<br> investment funds'),
                    ],
                    [
                        'ss_features_title' => ss_kses('Fast and secure<br>investment'),
                    ]
                ],
                'title_field' => '{{{ ss_features_title }}}',
            ]
        );
        $this->end_controls_section();

        // TAB_STYLE
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'feature_background',
                'types' => ['classic'],
                'exclude' => ['gradient', 'video'],
                'selector' => '{{WRAPPER}} .feature-section',
            ]
        );
        $this->add_responsive_control(
            'section_padding',
            [
                'label' => esc_html__('Section Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .feature-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'section_margin',
            [
                'label' => esc_html__('Section Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .feature-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_width',
            [
                'label' => esc_html__('Box Width', 'ss-addons'),
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
                    '{{WRAPPER}} .feature_inner .feature_img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_height',
            [
                'label' => esc_html__('Box Height', 'ss-addons'),
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
                    '{{WRAPPER}} .feature_inner .feature_img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .feature_inner .feature_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'ss-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature_inner .feature_img i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature_inner .feature_img i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
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
                    '{{WRAPPER}} .feature_inner .feature_img img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .feature_inner .feature_img svg' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature_inner .feature_img img' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .feature_inner .feature_img svg' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .feature_inner .feature_img img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .feature_inner .feature_img svg' => 'height: {{SIZE}}{{UNIT}};',
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
            'title_color',
            [
                'label' => esc_html__('Text Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature_inner .feature_text .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .feature_inner .feature_text .title',
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .feature_inner .feature_text .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .feature_inner .feature_text .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $features = $settings['ss_features_list']
?>

        <!-- start: Feature Section -->
        <?php if (!empty($features)) : ?>
            <section class="feature-section">
                <div class="container">
                    <div class="row">
                        <?php foreach ($features as $key => $feature) : ?>
                            <div class="col-lg-4">
                                <div class="single_feature">
                                    <div class="feature_inner">
                                        <div class="feature_img">
                                            <?php if ($feature['ss_features_icon_type'] !== 'image') : ?>
                                                <?php if (!empty($feature['ss_features_icon']) || !empty($feature['ss_features_selected_icon']['value'])) : ?>
                                                    <?php ss_render_icon($feature, 'ss_features_icon', 'ss_features_selected_icon'); ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (!empty($feature['ss_features_image']['url'])) : ?>
                                                    <img src="<?php echo $feature['ss_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($feature['ss_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($feature['ss_features_title'])) : ?>
                                            <div class="feature_text">
                                                <h5 class="title"><?php echo ss_kses($feature['ss_features_title']); ?></h5>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- end: Feature Section -->

<?php
    }
}

$widgets_manager->register(new SS_Features());
