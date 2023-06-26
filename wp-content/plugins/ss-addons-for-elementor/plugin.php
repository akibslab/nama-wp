<?php

namespace SSAddons;

use SSAddons\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class SS_Addons_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function ss_addons_elementor_category($manager) {
		$manager->add_category(
			'ss-addons',
			array(
				'title' => esc_html__('SS Addons', 'ss-addons'),
				'icon' => 'eicon-banner',
			)
		);
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script('ss-addons', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'ss-addons-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * ss_enqueue_editor_scripts
	 */
	function ss_enqueue_editor_scripts() {
		wp_enqueue_style('ss-element-addons-editor', SS_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
	}


	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle) {
		if ('ss-addons-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager) {
		// Its is now safe to include Widgets files
		foreach ($this->ss_addons_widget_list() as $widget_file_name) {
			require_once(SS_ELEMENTS_PATH . "/{$widget_file_name}.php");
		}

		// Charitable_Campaign
		if (function_exists('tutor')) {
			foreach ($this->ss_addons_widget_list_tutor() as $widget_file_name) {
				require_once(SS_ELEMENTS_PATH . "/{$widget_file_name}.php");
			}
		}
	}

	public function ss_addons_widget_list() {
		return [
			'hero-banner',
			'features',
			'howtowork',
			'faq',
			'brand',
			'advanced-tab'
		];
	}

	// ss_addons_widget_list_campaign
	public function ss_addons_widget_list_tutor() {
		return [
			// 'tutor-course',
		];
	}

	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

	// public function register_controls(Controls_Manager $controls_Manager) {
	// 	include_once(SS_ADDONS_DIR . '/controls/ssgradient.php');
	// 	$ssgradient = 'SSAddons\Elementor\Controls\Group_Control_ssGradient';
	// 	$controls_Manager->add_group_control($ssgradient::get_type(), new $ssgradient());

	// 	include_once(SS_ADDONS_DIR . '/controls/ssbggradient.php');
	// 	$ssbggradient = 'SSAddons\Elementor\Controls\Group_Control_SSBGGradient';
	// 	$controls_Manager->add_group_control($ssbggradient::get_type(), new $ssbggradient());
	// }




	public function ss_add_custom_icons_tab($tabs = array()) {
		// $feather_icons_path = include(SS_INCLUDE_PATH . '/icons/feather-fonts.php');
		return $tabs;
	}


	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		// Register custom category
		add_action('elementor/elements/categories_registered', [$this, 'ss_addons_elementor_category']);

		// Register custom controls
		// add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

		// Register custom icons
		add_filter('elementor/icons_manager/additional_tabs', [$this, 'ss_add_custom_icons_tab']);

		// $this->ss_add_custom_icons_tab();

		add_action('elementor/editor/after_enqueue_scripts', [$this, 'ss_enqueue_editor_scripts']);

		// add_filter('template_include', [$this, 'campaign_template_fun'], 99);

	}
}

// Instantiate Plugin Class
SS_Addons_Plugin::instance();
