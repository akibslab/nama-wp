<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for FAQs
 */
class SS_FAQ extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 */
	public function get_name() {
		return 'ss-faq';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title() {
		return __('SS FAQ', 'ss-addons');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon() {
		return 'ss-icon eicon-accordion';
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
			'_accordion',
			[
				'label' => esc_html__('Accordion', 'ss-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'accordion_title',
			[
				'label' => esc_html__('Question', 'ss-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('How to invest in Nama?', 'ss-addons'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'accordion_description',
			[
				'label' => esc_html__('Answer', 'ss-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Investing in Nama requires registration and completion of all required information.', 'ss-addons'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'accordions',
			[
				'label' => esc_html__('Accordion Items', 'ss-addons'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'accordion_title' => esc_html__('How to invest in Nama?', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('How do I know about new opportunities in Nama?', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('Is the profit guaranteed in nama?', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('How can investment returns be obtained if the investment opportunity is profitable?', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('Can non-Saudis invest in Nama?', 'ss-addons'),
					],
				],
				'title_field' => '{{{ accordion_title }}}',
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
				'selector' => '{{WRAPPER}} .faq-section',
			]
		);
		$this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__('Section Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .faq-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .faq-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .faq-section .section_title .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .faq-section .section_title .title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .faq-section .section_title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .faq-section .section_title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'question_style',
			[
				'label' => __('Question', 'ss-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'question_color',
			[
				'label' => esc_html__('Text Color', 'ss-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .faq_content .accordion-item .accordion-header' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'question_typography',
				'selector' => '{{WRAPPER}} .faq_content .accordion-item .accordion-header',
			]
		);
		$this->add_responsive_control(
			'question_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .faq_content .accordion-item .accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'question_margin',
			[
				'label' => esc_html__('Margin', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .faq_content .accordion-item .accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'answer_style',
			[
				'label' => __('Answer', 'ss-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'answer_color',
			[
				'label' => esc_html__('Text Color', 'ss-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .faq_content .accordion-item .accordion-body' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'answer_typography',
				'selector' => '{{WRAPPER}} .faq_content .accordion-item .accordion-body',
			]
		);
		$this->add_responsive_control(
			'answer_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .faq_content .accordion-item .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'answer_margin',
			[
				'label' => esc_html__('Margin', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .faq_content .accordion-item .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$accordions = $settings['accordions'];

		$this->add_render_attribute('title_args', 'class', 'title');

?>

		<!-- start: FAQ Section -->
		<section class="faq-section">
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
					<?php if (!empty($accordions)) : ?>
						<div class="faq_content" id="faqAccordion-<?php echo esc_attr($this->get_id()); ?>">
							<?php foreach ($accordions as $index => $item) :
								$collapsed = ($index == '0') ? '' : 'collapsed';
								$aria_expanded = ($index == '0') ? "true" : "false";
								$show = ($index == '0') ? "show" : "";
							?>
								<div class="accordion-item">
									<h6 class="accordion-header <?php echo esc_attr($collapsed); ?>" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo esc_attr($index); ?>" aria-expanded="<?php echo esc_attr($aria_expanded); ?>">
										<?php echo esc_html($item['accordion_title']); ?>
									</h6>
									<div id="faq-<?php echo esc_attr($index); ?>" class="accordion-body accordion-collapse collapse <?php echo esc_attr($show); ?>" data-bs-parent="#faqAccordion-<?php echo esc_attr($this->get_id()); ?>">
										<?php echo ss_kses($item['accordion_description']); ?>
									</div>
								</div>
							<?php endforeach; ?>

						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<!-- end: FAQ Section -->

<?php
	}
}

$widgets_manager->register(new SS_FAQ());
