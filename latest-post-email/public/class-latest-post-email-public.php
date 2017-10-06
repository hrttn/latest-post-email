<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.wpelk.com
 * @since      1.0.0
 *
 * @package    Latest_Post_Email
 * @subpackage Latest_Post_Email/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Latest_Post_Email
 * @subpackage Latest_Post_Email/public
 * @author     WP Elk <admin@wpelk.com>
 */
class Latest_Post_Email_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Latest_Post_Email_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Latest_Post_Email_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/latest-post-email-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Latest_Post_Email_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Latest_Post_Email_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/latest-post-email-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the latest published post to emails sent.
	 *
	 * @since    1.0.1
	 * @var	array $args original mail array
	 * @return	array $new_wp_mail the new mail array with the added text
	 */
	public function add_latest_post_to_mail( $args ) {
	
		$latest_post = $this->get_latest_published_post();
		$post_url = get_post_permalink( $latest_post->ID, true );
		$content_type = $this->get_content_type( $args['headers']) ;
		$message = $args['message'];
		
		//If there is a blog post
		if( null != $latest_post ) {
			if( 'text/plain' == $content_type ) {
				$message .= "\n\n Latest post: " . $post_url;
			} else {
				$message .=  "<p style='text-align: center;'><a href='".$post_url."'>".$latest_post->post_title."</a>";
			}
		}

		$new_wp_mail = array(
			'to'          => $args['to'],
			'subject'     => $args['subject'],
			'message'     => $message,
			'headers'     => $args['headers'],
			'attachments' => $args['attachments'],
		);
		
		return $new_wp_mail;
	}

	
	/**
	 * Get the latest published post of the blog
	 *
	 * @since    1.0.1
	 * @access   private
	 * @return	object WP_Post the latest post published by date 
	 */
	private function get_latest_published_post() {
		$args = array(
			'post_status'	=> 'publish',
			'numberposts'	=> 1,
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'post_type'		=> 'post'
		);
		
		$latest_posts = get_posts( $args );
		return get_post( $latest_posts[0] );
	}
	
	/**
	 * Get the content type of an email from the headers
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      (array|string)    $mail_hearders    headers of the email to check
	 * @return	string $content_type the content type of the email
	 */
	private function get_content_type($mail_headers) {

		$headers = array();
		if ( isset( $mail_headers ) ) {
			if ( is_array( $mail_headers ) ) {
				$headers = $mail_headers;
			} else {
				$headers = explode( "\n", str_replace( "\r\n", "\n", $mail_headers ) );
			}
		}
	 
		foreach ( $headers as $header ) {
			if ( strpos($header, ':') === false ) {
				continue;
			}
	 
			// Explode them out.
			list( $name, $content ) = explode( ':', trim( $header ), 2 );
			 
			// Cleanup crew.
			$name    = trim( $name    );
			$content = trim( $content );

			if ( 'content-type' === strtolower( $name ) ) {
				if ( strpos( $content, ';' ) !== false ) {
					list( $type, $charset ) = explode( ';', $content );
			 		$content_type = trim( $type );
				} else {
					$content_type = trim( $content );
				}
				break;
			}
		}
	 
		// Set Content-Type if we don't have a content-type from the input headers.
		if ( ! isset( $content_type ) ) {
			$content_type = 'text/plain';
		}

		/** This filter is documented in wp-includes/pluggable.php */
		$content_type = apply_filters( 'wp_mail_content_type', $content_type );
		return $content_type;
	}
}

	
