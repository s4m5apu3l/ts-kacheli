<?php
/**
 * Plugin Name: Mapplic
 * Plugin URI: https://www.mapplic.com/
 * Description: Mapplic is the #1 custom map WordPress plugin on the web. Turn simple images and vector graphics into high quality, responsive and fully interactive maps.
 * Version: 7.1
 * Author: sekler
 * Author URI: https://1.envato.market/R5Nv
 */

if (!class_exists('Mapplic')) :

class Mapplic {
	public static $version = '7.1';
	public $admin;

	public function __construct() {
		// Actions
		add_action('init', array($this, 'mapplic_create_post_type'));
		add_action('init', array($this, 'mapplic_localize'));
		add_action('wp_enqueue_scripts', array($this, 'mapplic_enqueue_scripts_styles'));

		// Filters
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'mapplic_add_action_link'));

		// Create shortcode
		add_shortcode('mapplic', array($this, 'mapplic_shortcode'));

		add_shortcode('mapplic-dir', array($this, 'mapplic_dir_shortcode'));
		add_shortcode('mapplic-dir-search', array($this, 'mapplic_dir_search_shortcode'));
		add_shortcode('mapplic-dir-filter', array($this, 'mapplic_dir_filter_shortcode'));
		add_shortcode('mapplic-dir-results', array($this, 'mapplic_dir_results_shortcode'));

		// Admin
		if (is_admin()) {
			include('admin/admin.php');
			$this->admin = new MapplicAdmin();
			register_activation_hook(__FILE__, array('MapplicAdmin', 'activation')); // activation
		}
	}

	public function mapplic_create_post_type() {
		$labels = array(
			'name' => __('Maps', 'mapplic'),
			'singular_name' => __('Map', 'mapplic'),
			'add_new_item' => __('Add New Map', 'mapplic'),
			'new_item' => __('New Map', 'mapplic'),
			'edit_item' => __('Edit Map', 'mapplic')
		);

		register_post_type('mapplic_map',
			array(
				'labels' => $labels,
				'show_in_menu' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'menu_position' => 25,
				'menu_icon' => 'dashicons-location-alt',
				'public' => false,
				'exclude_from_search' => true,
				'show_in_nav_menus' => false,
				'has_archive' => false,
				'rewrite' => array('slug' => 'mapplic_map'),
				'supports' => array ('title')
			)
		);
	}

	public function mapplic_add_action_link($links) {
		$newlink = array('<a href="' . admin_url('edit.php?post_type=mapplic_map' ) . '">' . __('Map List', 'mapplic') . '</a>');
		return array_merge($links, $newlink);
	}

	public function mapplic_enqueue_scripts_styles() {
		// Styles
		wp_register_style('magnific-popup', plugins_url('css/magnific-popup.css', __FILE__), false, null);
		wp_register_style('mapplic-style', plugins_url('core/mapplic.css', __FILE__), array('magnific-popup'), Mapplic::$version);

		// Scripts
		wp_register_script('mousewheel', plugins_url('js/jquery.mousewheel.js', __FILE__), false, null, false);
		wp_register_script('magnific-popup', plugins_url('js/magnific-popup.js', __FILE__), false, null, false);
		wp_register_script('mapplic-script', plugins_url('core/mapplic.js', __FILE__), array('jquery', 'mousewheel', 'magnific-popup'), Mapplic::$version, false);
		wp_register_script('csvparser', plugins_url('js/csvparser.js', __FILE__), false, '5.0.2', false);
		$mapplic_localization = array(
			'more' => __('More', 'mapplic'),
			'search' => __('Поиск', 'mapplic'),
			'notfound' => __('Nothing found. Please try a different search.', 'mapplic'),
			'iconfile' => plugins_url('core/images/icons.svg?v=' . Mapplic::$version, __FILE__)
		);
		wp_localize_script('mapplic-script', 'mapplic_localization', $mapplic_localization);
	}

	public function mapplic_localize() {
		load_plugin_textdomain('mapplic', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}

	public function mapplic_shortcode($atts) {
		$a = array(
			'id' => false,
			'h' => false,
			'class' => false, 
			'landmark' => false,
			'shortcode' => false,
			'csv' => false
		);
		extract(shortcode_atts($a, $atts, 'mapplic'));

		do_action('mapplic_shortcode');

		$post = get_post($id);
		if (!$post || !$id) return __('Error: map with the specified ID doesn\'t exist!', 'mapplic');

		$data = $post->post_content;
		$data = apply_filters('mapplic_data', $data);

		// preprocessing map data
		$data = json_decode($post->post_content);

		if (isset($data->locations) && $data->locations) {
			foreach($data->locations as $location) {
				// post
				if (isset($location->post) && $post = get_post((int) trim($location->post))) {
					if (isset($post->post_title)) $location->title = $post->post_title;
					if (isset($post->post_excerpt) && !isset($location->about)) $location->about = $post->post_excerpt;
					if (isset($post->post_content) && !isset($location->description)) {
						$parts = get_extended($post->post_content);
						$location->description = $parts['main']; // before main tag
					}

					$thumbnail = get_the_post_thumbnail_url($post, 'medium_large');
					if (isset($thumbnail) && !isset($location->image)) $location->image = $thumbnail;
					
					$link = get_post_permalink($post);
					if (isset($link) && !isset($location->link)) $location->link = $link;

					$categories = get_the_category($post->ID);
					if (!empty($categories)) {
						$cat = '';
						foreach ($categories as $category) $cat .= $category->slug . ',';
						$location->category = trim($cat);
					}

					// WooCommerce stock
					if (get_post_type($post) == 'product' && function_exists('wc_get_product')) {
						$product = wc_get_product(trim($location->post));
						if ($product->is_in_stock()) $location->category = trim($location->category . ' available');
						else $location->category = trim($location->category . ' sold');
					}
				}

				// shortcode support
				if ($shortcode) if (isset($location->description)) $location->description = do_shortcode($location->description);
				
				// filter
				$location = apply_filters('mapplic_location', $location);
			}
		}

		$data = json_encode($data);

		// markup
		$output = '<div id="mapplic-id' . $id . '" data-mapdata="' . htmlentities($data, ENT_QUOTES, 'UTF-8') . '"';
		if ($class) $output .= ' class="' . $class . '"';
		if ($landmark) $output .= ' data-landmark="' . $landmark . '"';
		if ($h) $output .= ' data-height="' . $h . '"';
		foreach (array_diff_key($atts, $a) as $attribute => $value) $output .= ' data-' . $attribute . '="' . $value . '"'; // non-default attributes
		$output .= '></div>';

		if (current_user_can('administrator') && (get_edit_post_link())) $output .= '<a href="' . get_edit_post_link($id) . '" class="mapplic-edit-map">' . __('Edit map', 'mapplic') . '</a>';

		wp_enqueue_style('mapplic-style');
		if ($csv) wp_enqueue_script('csvparser');
		wp_enqueue_script('mapplic-script');
		do_action('mapplic_enqueue');

		return $output;
	}

	public function mapplic_dir_shortcode($atts, $content = null) {
		$a = array(
			'id' => false,
			'attribute' => false,
			'pattern' => false,
			'title' => false
		);
		extract(shortcode_atts($a, $atts, 'mapplic-dir'));

		$output = '<div class="mapplic-dir" data-attribute="' . $attribute . '" data-pattern="' . $content . '">' . $title . '</div>';

		return $output;
	}

	public function mapplic_dir_search_shortcode($atts, $content = null) {
		$output = '<input type="text" class="mapplic-dir-search" placeholder="Search..." spellcheck="false">';
		return $output;
	}

	public function mapplic_dir_filter_shortcode($atts, $content = null) {
		$a = array(
			'attribute' => false,
			'default' => false,
			'generate' => false
		);
		extract(shortcode_atts($a, $atts, 'mapplic-dir-filter'));


		$output = '<select class="mapplic-dir-filter mapplic-dir-filter-generate"';
		if ($attribute) $output .= ' data-attribute="' . $attribute . '"';
		$output .= '>';
		if ($default) $output .= '<option value="">' . $default . '</option>';
		$output .= '</select>';

		return $output;
	}

	public function mapplic_dir_results_shortcode($atts, $content = null) {
		$output = '<div class="mapplic-dir-results mapplic-dir-grid mapplic-dir-columns mapplic-dir"></div>';
		return $output;
	}
}

endif;

function mapplic_build() {
	global $mapplic;
	if (!isset($mapplic)) $mapplic = new Mapplic();
	return $mapplic;
}
mapplic_build();

?>