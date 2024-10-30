<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://linkions.com
 * @since      1.0.0
 *
 * @package    Linkions
 * @subpackage Linkions/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Linkions
 * @subpackage Linkions/public
 * @author     Linkions <support@linkions.com>
 */
class Linkions_Public
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
	 * Contains the display name of social networks.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $social_profile_names	Contains the display name of social networks.
	 */
	private $social_profile_names;



	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->set_social_profile_names();

		add_action('init', array($this, 'catch_slug'), 0);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/linkions-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/linkions-public.js', array('jquery'), $this->version, false);
	}

	public function set_social_profile_names()
	{
		$this->social_profile_names = [
			'linkions-fb-url' => 'Facebook',
			'linkions-twitter-url' => 'Twitter',
			'linkions-instagram-url' => 'Instagram',
			'linkions-linkedin-url' => 'LinkedIn',
			'linkions-pinterest-url' => 'Pinterest',
			'linkions-youtube-url' => 'YouTube',
			'linkions-behance-url' => 'Behance',
			'linkions-github-url' => 'Github',
		];
	}

	public function catch_slug()
	{

		if (is_admin()) {
			return;
		}

		$request_uri = sanitize_title(basename(strtok($_SERVER["REQUEST_URI"], '?')));

		$post = get_page_by_path(
			$request_uri,
			OBJECT,
			[$this->plugin_name]
		);

		if (!$post || !$post instanceof \WP_Post) {
			return;
		}

		$this->render($post);
		exit;
	}

	public function render($post)
	{

		if (!$post instanceof \WP_Post) {
			$post = get_post($post, OBJECT);
		}

		if (!$post instanceof \WP_Post) {
			return false;
		}

		$linkions_profile_id = $post->ID;
		$linkion_page = get_post($linkions_profile_id);
		$linkions_social = get_option('linkions_social');
		$linkions_image = wp_get_attachment_url(get_post_thumbnail_id($linkions_profile_id), 'thumbnail');

		$stylesheet_url = plugin_dir_url(__FILE__) . 'css/linkions-public.css';
		$title = get_the_title($post);
		$description = get_the_excerpt($post);

		http_response_code(200);

		include plugin_dir_path(__FILE__) . 'profile-view.php';

		exit;
	}
}
