<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for Brand.
 */
class SS_Brand extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 */
	public function get_name() {
		return 'ss-brand';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title() {
		return __('SS Brand', 'ss-addons');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon() {
		return 'ss-icon eicon-carousel';
	}

	/**
	 * Widget categories
	 */
	public function get_categories() {
		return ['ss-addons'];
	}

	/**
	 * Widget scripts dependencies
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


		$this->start_controls_section(
			'ss_brand_section',
			[
				'label' => __('Brand Logos', 'ss-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ss_brand_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __('Image', 'ss-addons'),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'ss_brand_url',
			[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'label' => __('URL', 'ss-addons'),
				'default' => __('#', 'ss-addons'),
				'placeholder' => __('Type url here', 'ss-addons'),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_control(
			'brand_items',
			[
				'label' => esc_html__('Brand Items', 'ss-addons'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => 'Brand Logo',
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
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'faq_background',
				'types' => ['classic'],
				'exclude' => ['gradient', 'video'],
				'selector' => '{{WRAPPER}} .partners-section',
			]
		);
		$this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__('Section Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .partners-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .partners-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .partners-section .section_title .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .partners-section .section_title .title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .partners-section .section_title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .partners-section .section_title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$brand_items = $settings['brand_items'];

		$this->add_render_attribute('title_args', 'class', 'title');
?>

		<!-- start: Partners Section -->
		<section class="partners-section">
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
				<div class="row">
					<div class="col">
						<?php if (!empty($brand_items)) : ?>
							<div class="partners_logo">
								<?php foreach ($brand_items as $item) : ?>
									<div class="single_logo">
										<?php if (!empty($item['ss_brand_url'])) : ?>
											<a href="<?php echo esc_url($item['ss_brand_url']); ?>"><img src="<?php echo esc_url($item['ss_brand_image']['url']); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_brand_image']['url']), '_wp_attachment_image_alt', true); ?>"></a>
										<?php else : ?>
											<img src="<?php echo esc_url($item['ss_brand_image']['url']); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_brand_image']['url']), '_wp_attachment_image_alt', true); ?>">
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<!-- end: Partners Section -->

<?php
	}
}

$widgets_manager->register(new SS_Brand());
