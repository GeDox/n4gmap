<?php defined( 'ABSPATH' ) or die( ':)' );
/*
Plugin Name: Mapa stref N4G
Plugin URI: http://n4gmap.kozioldev.eu
Version: 1.0
Author: Przemysław GeDox Kozłowski
Author URI: http://kozioldev.eu
Description: Interaktywna mapa stref
*/

class N4GMap {
	private static $instance;
	public static $templates = array(
		'../templates/map.php' => 'Mapa stref N4G',
	);

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new N4GMap();
		} 

		include('lib/template.php');
		include('lib/role.php');
		include('lib/data.php');

		$data = new N4GMap_Data();
		global $n4gmap_areas;
		$n4gmap_areas = $data->get_areas();

		new N4GMap_Role();
		new N4GMap_Template();

		return self::$instance;
	} 

	private function __construct() {
	}
} 
add_action( 'plugins_loaded', array( 'N4GMap', 'get_instance' ) );