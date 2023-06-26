<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for Advanced Tab
 */
class SS_Advanced_Tab extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 */
	public function get_name() {
		return 'ss-advanced-tab';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title() {
		return __('SS Advanced Tab', 'ss-addons');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon() {
		return 'ss-icon eicon-tabs';
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

	public function get_ss_contact_form() {
		if (!class_exists('WPCF7')) {
			return;
		}
		$ss_cfa         = array();
		$ss_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$ss_forms       = get_posts($ss_cf_args);
		$ss_cfa         = ['0' => esc_html__('Select Form', 'ss-addons')];
		if ($ss_forms) {
			foreach ($ss_forms as $ss_form) {
				$ss_cfa[$ss_form->ID] = $ss_form->post_title;
			}
		} else {
			$ss_cfa[esc_html__('No contact form found', 'ss-addons')] = 0;
		}
		return $ss_cfa;
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
			'ss_description',
			[
				'label' => esc_html__('Description', 'ss-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('We are in the beta launch, please register your information and we will contact you.', 'ss-addons'),
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
			'_section_price_tabs',
			[
				'label' => __('Advanced Tabs', 'ss-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs(
			'advanced_tabs'
		);

		$this->start_controls_tab(
			'client_tab',
			[
				'label' => esc_html__('Client', 'ss-addons'),
			]
		);
		$this->add_control(
			'client_tab_title',
			[
				'label' => esc_html__('Title', 'ss-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Client', 'ss-addons'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'client_contact_form',
			[
				'label'   => esc_html__('Select Form', 'ss-addons'),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_ss_contact_form(),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'investor_tab',
			[
				'label' => esc_html__('Investor', 'ss-addons'),
			]
		);
		$this->add_control(
			'investor_tab_title',
			[
				'label' => esc_html__('Title', 'ss-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Investor', 'ss-addons'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'investor_contact_form',
			[
				'label'   => esc_html__('Select Form', 'ss-addons'),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_ss_contact_form(),
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
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
				'name' => 'advanced_tab_background',
				'types' => ['classic'],
				'exclude' => ['gradient', 'video'],
				'selector' => '{{WRAPPER}} .contact-investment',
			]
		);
		$this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__('Section Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .contact-investment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .contact-investment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .contact-investment .section_title .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .contact-investment .section_title .title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .contact-investment .section_title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .contact-investment .section_title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'description_style',
			[
				'label' => __('Description', 'ss-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Text Color', 'ss-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-investment .section_title p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .contact-investment .section_title p',
			]
		);
		$this->add_responsive_control(
			'description_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .contact-investment .section_title p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__('Margin', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .contact-investment .section_title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'tab_title_style',
			[
				'label' => __('Tab Title', 'ss-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_title_color',
			[
				'label' => esc_html__('Text Color', 'ss-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact_investment_tabs .nav-item' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_title_typography',
				'selector' => '{{WRAPPER}} .contact_investment_tabs .nav-item',
			]
		);
		$this->add_responsive_control(
			'tab_title_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .contact_investment_tabs .nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_title_margin',
			[
				'label' => esc_html__('Margin', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .contact_investment_tabs .nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'form_label_style',
			[
				'label' => __('Form Label', 'ss-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__('Text Color', 'ss-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form_group label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .form_group label',
			]
		);
		$this->add_responsive_control(
			'label_padding',
			[
				'label' => esc_html__('Padding', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .form_group label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'label_margin',
			[
				'label' => esc_html__('Margin', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .form_group label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_tab_area',
			[
				'label'         => esc_html__('Form Field Style', 'ss-addons'),
				'tab'           => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cf_field_typo',
				'label'     => esc_html__('Field Typography', 'ss-addons'),
				'selector' => '{{WRAPPER}} .form_group select, {{WRAPPER}} .form_group .nice-select, {{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"]), {{WRAPPER}} .form_group textarea',
			]
		);
		$this->add_responsive_control(
			'cf_text_color',
			[
				'label' => esc_html__('Text Color', 'ss-addons'),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"])' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group select' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .nice-select' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group textarea' => 'color: {{VALUE}}',

					'{{WRAPPER}} .form_group textarea::-moz-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .nice-select::-moz-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .form-control::-moz-placeholder' => 'color: {{VALUE}}',

					'{{WRAPPER}} .form_group textarea::-ms-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .nice-select::-ms-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .form-control::-ms-input-placeholder' => 'color: {{VALUE}}',

					'{{WRAPPER}} .form_group textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .nice-select::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .form_group .form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'cf_bg_color',
			[
				'label' => esc_html__('Background Color', 'ss-addons'),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form_group select' => 'background: {{VALUE}}',
					'{{WRAPPER}} .form_group .nice-select' => 'background: {{VALUE}}',
					'{{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"])' => 'background: {{VALUE}}',
					'{{WRAPPER}} .form_group textarea' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cf_borders',
				'label' => esc_html__('Field Border', 'ss-addons'),
				'selector' => '{{WRAPPER}} .form_group select, {{WRAPPER}} .form_group .nice-select, {{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"]), {{WRAPPER}} .form_group textarea',
			]
		);
		$this->add_responsive_control(
			'cf_field_radius',
			[
				'label' => esc_html__('Field Radius', 'ss-addons'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .form_group select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group .nice-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cf_field_shadow',
				'label' => esc_html__('Field Shadow', 'ss-addons'),
				'selector' => '{{WRAPPER}} .form_group select, {{WRAPPER}} .form_group .nice-select, {{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"]), {{WRAPPER}} .form_group textarea',
			]
		);
		$this->add_responsive_control(
			'cf_field_padding',
			[
				'label' => esc_html__('Field Padding', 'ss-addons'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .form_group select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group .nice-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cf_field_margin',
			[
				'label' => esc_html__('Field Margin', 'ss-addons'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .form_group select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group .nice-select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .form_group input:not([type="submit"]):not([type="radio"]):not([type="checkbox"])' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cf_filed_height',
			[
				'label' => esc_html__('Input/Select Height', 'ss-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .form_group input[type="text"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group input[type="email"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group input[type="url"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group input[type="tel"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group input[type="number"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group input[type="date"]' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group select' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .form_group .nice-select' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cf_message_height',
			[
				'label' => esc_html__('Textarea Height', 'ss-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 500,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .form_group textarea' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'text_area_box_radius',
			[
				'label' => esc_html__('Textarea Radius', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .form_group textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cf_textarea_typo',
				'label'     => esc_html__('Textarea Typography', 'ss-addons'),
				'selector'  => '{{WRAPPER}} .form_group textarea',
			]
		);
		$this->add_responsive_control(
			'cf_message_padding',
			[
				'label' => esc_html__('Textarea Padding', 'ss-addons'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .form_group textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cf_message_margin',
			[
				'label' => esc_html__('Textarea Margin', 'ss-addons'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .form_group textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_button',
			[
				'label'         => esc_html__('Button Style', 'ss-addons'),
				'tab'           => Controls_Manager::TAB_STYLE
			]
		);
		$this->start_controls_tabs('style_tabs_1');
		$this->start_controls_tab(
			'btn_1_button_style_normal',
			[
				'label' => esc_html__('Normal', 'ss-addons'),
			]
		);
		$this->add_responsive_control(
			'btn_1_label_color',
			[
				'label' => esc_html__('Color', 'ss-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .client_form .btn'   => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_1_bg',
				'label' => esc_html__('Background', 'ss-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .client_form .btn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'btn_border',
				'label'     => esc_html__('Border', 'ss-addons'),
				'selector'  => '{{WRAPPER}} .client_form .btn',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'btn_box_shadow',
				'label'     => esc_html__('Box Shadow', 'ss-addons'),
				'selector'  => '{{WRAPPER}} .client_form .btn',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'btn_1_button_style_hover',
			[
				'label' => esc_html__('Hover', 'ss-addons'),
			]
		);
		$this->add_responsive_control(
			'btn_label_hover_color',
			[
				'label'     => esc_html__('Color', 'ss-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .client_form .btn:hover'   => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_hover__bg',
				'label' => esc_html__('Background', 'ss-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .client_form .btn:hover, {{WRAPPER}} .client_form .btn.active',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'btn_hover_border',
				'label'     => esc_html__('Border', 'ss-addons'),
				'selector'  => '{{WRAPPER}} .client_form .btn:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'btn_hover_box_shadow',
				'label'     => esc_html__('Box Shadow', 'ss-addons'),
				'selector'  => '{{WRAPPER}} .client_form .btn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'btn_1_width',
			[
				'label' => esc_html__('Width', 'ss-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .client_form .btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_1_height',
			[
				'label' => esc_html__('Height', 'ss-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .client_form .btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_1_typography',
				'label' => esc_html__('Button Typography', 'ss-addons'),
				'selector' => '{{WRAPPER}} .client_form .btn',
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .client_form .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_1_padding',
			[
				'label' => esc_html__('Paddings', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .client_form .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_1_margin',
			[
				'label' => esc_html__('Margin', 'ss-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .client_form .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_render_attribute('title_args', 'class', 'title');

?>
		<!-- start: Contact Investment -->
		<section class="contact-investment">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="contact_investment_wrapper">
							<div class="section_title">
								<?php if (!empty($settings['ss_title'])) : ?>
									<?php printf(
										'<%1$s %2$s>%3$s</%1$s>',
										tag_escape($settings['ss_title_tag']),
										$this->get_render_attribute_string('title_args'),
										ss_kses($settings['ss_title'])
									); ?>
								<?php endif; ?>
								<?php if (!empty($settings['ss_description'])) : ?>
									<p><?php echo esc_html($settings['ss_description']); ?></p>
								<?php endif; ?>
							</div>

							<ul class="contact_investment_tabs nav-tabs" role="tablist">
								<li class="nav-item active" data-bs-toggle="tab" data-bs-target="#client" aria-selected="true">
									<?php if (!empty($settings['client_tab_title'])) : ?>
										<?php echo esc_html($settings['client_tab_title']); ?>
									<?php endif; ?>
								</li>
								<li class="nav-item" data-bs-toggle="tab" data-bs-target="#investor" aria-selected="false">
									<?php if (!empty($settings['investor_tab_title'])) : ?>
										<?php echo esc_html($settings['investor_tab_title']); ?>
									<?php endif; ?>
								</li>
							</ul>

							<div class="tab-content contact_investment_tab_content">
								<div class="tab-pane fade show active" id="client" role="tabpanel">

									<?php if (!empty($settings['client_contact_form'])) : ?>
										<?php echo do_shortcode('[contact-form-7  id="' . $settings['client_contact_form'] . '"]'); ?>
									<?php else : ?>
										<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'ss-addons') . '</p></div>'; ?>
									<?php endif; ?>

								</div>
								<div class="tab-pane fade" id="investor" role="tabpanel">

									<?php if (!empty($settings['investor_contact_form'])) : ?>
										<?php echo do_shortcode('[contact-form-7  id="' . $settings['investor_contact_form'] . '"]'); ?>
									<?php else : ?>
										<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'ss-addons') . '</p></div>'; ?>
									<?php endif; ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end: Contact Investment -->

<?php
	}
}
$widgets_manager->register(new SS_Advanced_Tab());
