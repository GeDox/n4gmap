<?php defined( 'ABSPATH' ) or die( ':)' );

class N4GMap_Data {
    public function get_areas() {
        global $wpdb;
        return $wpdb->get_results( "SELECT `x`, `y`, `type`, `price`, `surface`, `mobile` FROM {$wpdb->prefix}areas");
    }
}