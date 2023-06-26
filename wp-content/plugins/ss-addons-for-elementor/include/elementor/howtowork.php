<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for how to work
 */
class SS_HowToWork extends Widget_Base {

    /**
     * Retrieve the widget name.
     */
    public function get_name() {
        return 'ss-howtowork';
    }

    /**
     * Retrieve the widget title.
     */
    public function get_title() {
        return __('SS How to Work', 'ss-addons');
    }

    /**
     * Retrieve the widget icon.
     */
    public function get_icon() {
        return 'ss-icon eicon-posts-group';
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

        // ss_section_title
        $this->start_controls_section(
            'ss_section_title',
            [
                'label' => esc_html__('Section Title', 'ss-addons'),
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
                'default' => 'h2',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        // _ss_image
        $this->start_controls_section(
            '_ss_image_section',
            [
                'label' => esc_html__('Image', 'ss-addons'),
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

        // Working
        $this->start_controls_section(
            'ss_working_step',
            [
                'label' => esc_html__('Working Steps', 'ss-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ss_step_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'ss-addons'),
                    'icon' => esc_html__('Icon', 'ss-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'ss_step_image',
            [
                'label' => esc_html__('Upload Icon Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ss_step_icon_type' => 'image'
                ]

            ]
        );

        if (ss_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'ss_step_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa-solid fa-check',
                    'condition' => [
                        'ss_step_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'ss_step_selected_icon',
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
                        'ss_step_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'ss_step_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Service Title', 'ss-addons'),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'ss_step_items',
            [
                'label' => esc_html__('Step Items', 'ss-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ss_step_title' => esc_html__('Create your account in minutes!', 'ss-addons'),
                    ],
                    [
                        'ss_step_title' => esc_html__('Choose your investment opportunity', 'ss-addons')
                    ],
                    [
                        'ss_step_title' => esc_html__('Track your investment status on our platform', 'ss-addons')
                    ]
                ],
                'title_field' => '{{{ ss_step_title }}}',
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'section_padding',
            [
                'label' => esc_html__('Section Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .howtowotk' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .howtowotk' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .howtowork-img img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .howtowork-img img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .howtowork-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .howtowork-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .howtowork-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
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
                    '{{WRAPPER}} .howtowotk .section_title .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .howtowotk .section_title .title',
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .howtowotk .section_title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .howtowotk .section_title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .step_inner .step_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .step_inner .step_icon i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_image_style',
            [
                'label' => __('Icon Image', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_image_width',
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
                    '{{WRAPPER}} .step_inner .step_icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .step_inner .step_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_image_max_width',
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
                    '{{WRAPPER}} .step_inner .step_icon img' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .step_inner .step_icon svg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_image_height',
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
                    '{{WRAPPER}} .step_inner .step_icon img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .step_inner .step_icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'step_title_style',
            [
                'label' => __('Step Text', 'ss-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'step_title_color',
            [
                'label' => esc_html__('Text Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .step_inner .step_text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'step_title_typography',
                'selector' => '{{WRAPPER}} .step_inner .step_text',
            ]
        );
        $this->add_responsive_control(
            'step_title_padding',
            [
                'label' => esc_html__('Padding', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .step_inner .step_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'step_title_margin',
            [
                'label' => esc_html__('Margin', 'ss-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .step_inner .step_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $ss_step_items = $settings['ss_step_items'];

        $this->add_render_attribute('title_args', 'class', 'title');


        if (!empty($settings['ss_image']['url'])) {
            $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
            $ss_image_alt = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
        }
?>

        <!-- start: How to work -->
        <section class="howtowotk">
            <div class="container">
                <?php if (!empty($settings['ss_title'])) : ?>
                    <div class="row">
                        <div class="col">
                            <div class="section_title">
                                <?php printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($settings['ss_title_tag']),
                                    $this->get_render_attribute_string('title_args'),
                                    ss_kses($settings['ss_title'])
                                ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <?php if (!empty($settings['ss_image']['url'])) : ?>
                            <div class="howtowork-img">
                                <img src="<?php echo esc_url($ss_image); ?>" alt="<?php echo esc_attr($ss_image_alt); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <?php if (!empty($ss_step_items)) : ?>
                            <div class="working_steps">
                                <?php foreach ($ss_step_items as $key => $item) : ?>
                                    <div class="single_step">
                                        <div class="step_inner">
                                            <div class="step_icon">
                                                <?php if ($item['ss_step_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['ss_step_icon']) || !empty($item['ss_step_selected_icon']['value'])) : ?>
                                                        <?php ss_render_icon($item, 'ss_step_icon', 'ss_step_selected_icon'); ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if (!empty($item['ss_step_image']['url'])) : ?>
                                                        <img src="<?php echo $item['ss_step_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_step_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="step_text">
                                                <?php if (!empty($item['ss_step_title'])) : ?>
                                                    <span><?php echo esc_html($item['ss_step_title']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: How to work -->

<?php
    }
}

$widgets_manager->register(new SS_HowToWork());
