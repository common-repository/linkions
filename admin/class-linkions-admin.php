<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://linkions.com
 * @since      1.0.0
 *
 * @package    Linkions
 * @subpackage Linkions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Linkions
 * @subpackage Linkions/admin
 * @author     Linkions <support@linkions.com>
 */
class Linkions_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('init', array($this, 'linkions_post_type_generate'));
		add_action('admin_menu', array($this, 'linkions_post_type_menus'));
		add_action('appearance-section-form', array($this, 'linkions_appearance_section_form_submit'));
		add_action('social-section-form', array($this, 'linkions_social_section_form_submit'));
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Linkions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Linkions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/linkions-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Linkions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Linkions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/linkions-admin.js', array('jquery'), $this->version, false);
		if (!did_action('wp_enqueue_media')) {
			wp_enqueue_media();
		}
	}

	public function linkions_post_type_generate()
	{

		register_post_type(
			'linkions',
			array(
				'labels' => array(
					'name' => 'Linkions',
					'singular_name' => 'Linkion',
					'add_new' => 'Add Linkion',
					'add_new_item' => 'Add New Linkion',
					'edit' => 'Edit',
					'edit_item' => 'Edit Linkion',
					'new_item' => 'New Linkion',
					'view' => 'View',
					'view_item' => 'View Linkion',
					'search_items' => 'Search Linkion',
					'not_found' => 'No Linkion found',
					'not_found_in_trash' =>
					'No Linkion found in Trash',
					'parent' => 'Parent Linkion',
				),
				'public' => false,
				'menu_position' => 99,
				'menu_icon' => 'dashicons-admin-links',
				'supports' => array('title', 'editor', 'thumbnail'),
				'capabilities' => array(
					'create_posts' => 'do_not_allow',
				)
			)
		);
	}

	public function linkions_post_type_menus()
	{

		add_menu_page(
			'Linkions',
			'Linkions',
			'manage_options',
			'linkions-appearance',
			array($this, 'linkions_appearance_settings'),
			'dashicons-admin-links',
		);

		add_submenu_page(
			'linkions-appearance',
			'Appearance',
			'Appearance',
			'manage_options',
			'linkions-appearance',
			array($this, 'linkions_appearance_settings'),
		);

		add_submenu_page(
			'linkions-appearance',
			'Social',
			'Social',
			'manage_options',
			'linkions-social',
			array($this, 'linkions_social_settings')
		);
	}

	public function linkions_appearance_settings()
	{

		if (!current_user_can('manage_options')) {
			return;
		}

		$default_tab = 'general';
		$tab = isset($_GET['tab']) ? sanitize_title($_GET['tab']) : $default_tab;

?>
		<div class="wrap">
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			<nav class="nav-tab-wrapper">
				<a href="?page=linkions-appearance" class="nav-tab <?php if ($tab === 'general') : ?>nav-tab-active<?php endif; ?>">General</a>
				<!-- <a href="?page=linkions-appearance&tab=settings" class="nav-tab <?php if ($tab === 'settings') : ?>nav-tab-active<?php endif; ?>">Settings</a>
				<a href="?page=linkions-appearance&tab=tools" class="nav-tab <?php if ($tab === 'tools') : ?>nav-tab-active<?php endif; ?>">Tools</a> -->
			</nav>
			<div class="tab-content">
				<?php switch ($tab):
					case 'general':
						include plugin_dir_path(__FILE__) . '/partials/appearance-general-form.php';
						break;
					case 'settings':
						echo 'Settings';
						break;
					case 'tools':
						echo 'Tools';
						break;
					default:
						echo 'Default tab';
						break;
				endswitch; ?>
			</div>

		<?php
	}

	public function linkions_social_settings()
	{

		if (!current_user_can('manage_options')) {
			return;
		}

		$default_tab = 'icons';
		$tab = isset($_GET['tab']) ? sanitize_title($_GET['tab']) : $default_tab;

		?>
			<div class="wrap">
				<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
				<nav class="nav-tab-wrapper">
					<a href="?page=linkions-social&tab=icons" class="nav-tab <?php if ($tab === 'icons') : ?>nav-tab-active<?php endif; ?>">Social Icons</a>
				</nav>
				<div class="tab-content">
					<?php switch ($tab):
						case 'icons':
							include plugin_dir_path(__FILE__) . '/partials/social-icons-form.php';
							break;
						default:
							echo 'Default tab';
							break;
					endswitch; ?>
				</div>
		<?php
	}

	public function linkions_appearance_section_form_submit()
	{

		if (!isset($_POST['appearance_action_nonce']) || !wp_verify_nonce($_POST['appearance_action_nonce'], 'appearance_action')) {
			return;
		}

		if (isset($_POST['save-changes'])) {

			$last_linkions_id = intval(sanitize_text_field($_POST['last_linkions_id']));
			$linkions_url = sanitize_title($_POST['linkions-url']);
			$linkions_title = sanitize_text_field($_POST['linkions-title']);
			$linkions_description = sanitize_textarea_field($_POST['linkions-description']);
			$linkion_profile_image = intval(sanitize_text_field($_POST['linkion-profile-image']));

			if (!$this->is_slug_unique($linkions_url)) {
				add_settings_error('linkions', 'linkions_appearance', __("URL already exist. Please try different URL.", 'linkions'), 'error');
				set_transient('linkions_appearance_errors', get_settings_errors(), 30);
				return false;
			}

			if (!empty($last_linkions_id)) {
				$linkions_data = array(
					'ID' => $last_linkions_id,
					'post_title' => $linkions_title,
					'post_name' => $linkions_url,
					'post_content' => $linkions_description,
					'post_excerpt' => $linkions_description,
				);

				$updated_linkions_id = wp_update_post($linkions_data);
				update_post_meta($updated_linkions_id, '_thumbnail_id', $linkion_profile_image);
				add_settings_error('linkions', 'linkions_appearance', __("Profile page updated successfully", 'linkions'), 'success');
				set_transient('linkions_appearance_errors', get_settings_errors(), 30);
			} else {
				$insert_linkions_id = wp_insert_post(array(
					'post_type' => 'linkions',
					'post_title' => $linkions_title,
					'post_name' => $linkions_url,
					'post_content' => $linkions_description,
					'post_excerpt' => $linkions_description,
					'post_status' => 'publish',
					'comment_status' => 'closed',
					'ping_status' => 'closed',
				));

				update_post_meta($insert_linkions_id, '_thumbnail_id', $linkion_profile_image);
				add_settings_error('linkions', 'linkions_appearance', __("Profile page created successfully"), 'success');
				set_transient('linkions_appearance_errors', get_settings_errors(), 30);
			}
		}
	}

	public function linkions_latest_id()
	{
		$lastrowId = get_posts("post_type=linkions&numberposts=1&fields=ids");
		if (!empty($lastrowId)) {
			return $lastrowId[0];
		}
		return;
	}

	public function linkions_social_section_form_submit()
	{

		if (!isset($_POST['social_action_nonce']) || !wp_verify_nonce($_POST['social_action_nonce'], 'social_action')) {
			return;
		}

		if (isset($_POST['save-changes'])) {
			$linkions_social = array();
			$linkions_social['linkions-social-position'] = (isset($_POST['linkions-social-position'])) ? sanitize_key($_POST['linkions-social-position']) : "Top";
			$linkions_social['linkions-fb-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-fb-url']));
			$linkions_social['linkions-twitter-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-twitter-url']));
			$linkions_social['linkions-instagram-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-instagram-url']));
			$linkions_social['linkions-linkedin-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-linkedin-url']));
			$linkions_social['linkions-pinterest-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-pinterest-url']));
			$linkions_social['linkions-youtube-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-youtube-url']));
			$linkions_social['linkions-behance-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-behance-url']));
			$linkions_social['linkions-github-url'] = wp_http_validate_url(sanitize_url($_POST['linkions-github-url']));

			update_option('linkions_social', $linkions_social);

			add_settings_error('linkions', 'linkions_appearance', __("Social network settings updated successfully"), 'success');
			set_transient('linkions_appearance_errors', get_settings_errors(), 30);
		}
	}

	public function is_slug_unique($slug)
	{
		global $wpdb;

		$slug = sanitize_title($slug);

		$post_count = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT count(post_title) FROM $wpdb->posts WHERE post_name like %s AND post_type != %s ;",
				$slug,
				$this->plugin_name
			)
		);

		return 0 === (int) $post_count;
	}
}
