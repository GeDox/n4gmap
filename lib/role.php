<?php defined( 'ABSPATH' ) or die( ':)' );

class N4GMap_Role {
    public function __construct() {
        add_role('n4gmap_editor', 'Edytor mapy stref', array(
			'read' => true,
			'edit_map' => true
		));

		$adminRole = get_role( 'administrator' );
        $adminRole->add_cap( 'edit_map' ); 
    }
}