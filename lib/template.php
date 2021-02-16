<?php defined( 'ABSPATH' ) or die( ':)' );

class N4GMap_Template extends N4GMap {    
    public function __construct() {
		add_filter( 'theme_page_templates', array( $this, 'add_new_template' ) );
		add_filter( 'wp_insert_post_data',  array( $this, 'register_project_templates' ) );
        add_filter( 'template_include', array( $this, 'view_project_template') );
    }

    public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, parent::$templates );
		return $posts_templates;
	}

	public function register_project_templates( $atts ) {
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
        } 
        
		wp_cache_delete( $cache_key , 'themes');

		$templates = array_merge( $templates, parent::$templates );

		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;
	} 

	public function view_project_template( $template ) {
		global $post;

		if ( ! $post ) {
			return $template;
		}

		if ( ! isset( parent::$templates[get_post_meta( 
			$post->ID, '_wp_page_template', true 
		)] ) ) {
			return $template;
		} 

		$file = plugin_dir_path( __FILE__ ). get_post_meta( 
			$post->ID, '_wp_page_template', true
		);

		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		return $template;
	}
}