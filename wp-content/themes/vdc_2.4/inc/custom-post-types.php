<?php
/* 
Organisation events, no categories
*/
$vdc_org_events = new CPT(array(
	'post_type_name' => 'orgevent',
	'singular' => 'Org Event',
	'plural' => 'Org Events',
	'slug' => 'orgevent'
), array(
	'supports'	=> array('title', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-calendar-alt'
));
// Org Categories
// $vdc_org_events->register_taxonomy(array(
//     'taxonomy_name' => 'orgcats',
//     'singular' => 'Category',
//     'plural' => 'Categories',
//     'slug' => 'orgcats'
// ));

/* 
Vol events, no categories
*/
$vdc_vol_events = new CPT(array(
	'post_type_name' => 'volevent',
	'singular' => 'Vol Event',
	'plural' => 'Vol Events',
	'slug' => 'volevent'
), array(
	'supports'	=> array('title', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-calendar-alt'
));
// Vol Categories
$vdc_vol_events->register_taxonomy(array(
    'taxonomy_name' => 'volcats',
    'singular' => 'Category',
    'plural' => 'Categories',
    'has_archive' => true,
    // 'hierarchical' => true,
    'slug' => 'volcats'
));

// Opportunities
$vdc_opps = new CPT(array(
	'post_type_name' => 'opportunity',
	'singular' => 'Opportunity',
    	'plural' => 'Opportunities',
    	'slug' => 'opportunity'
), array(
	'supports'	=> array('title', 'editor', 'thumbnail'),
	'show_in_rest'       => true,
	'rest_base'          => 'opps-api',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
));
$vdc_opps->menu_icon('dashicons-calendar-alt');

// Opps Columns
$vdc_opps->columns(array(
	'cb' => '<input type="checkbox" />',
    	'title' => __('Title'),
    	'organisation' => __('Organisation'),
    	'activity' => __('Activity (iVol)'),
    	'date' => __('Published')
));



// Opportunities
$vdc_opportunities = new CPT(array(
	'post_type_name' => 'opp',
	'singular' => 'Opportunity',
	'plural' => 'New Opportunities',
	'slug' => 'opp'
), array(
	'supports'	=> array('title'),
	// 'show_in_rest'       => true,
	// 'rest_base'          => 'opps-api',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
));

// function wpdocs_create_opp_tax() {
//     register_taxonomy( 'opp_category', 'opp', array(
//         'label'        => __( 'Opprtunity Category', 'textdomain' ),
//         'rewrite'      => array( 'slug' => 'opp_category' ),
//         'hierarchical' => true,
//     ) );
// }
// add_action( 'init', 'wpdocs_create_opp_tax', 0 );
$vdc_opportunities->menu_icon('dashicons-list-view');



// Populate the column text
$vdc_opps->populate_column('organisation', function($column, $post) {

	echo get_field('organisation'); // ACF get_field() function

});

$vdc_opps->populate_column('activity', function($column, $post) {

	$field = get_field_object('activity');
	$value = get_field('activity');
	$label = $field['choices'][ $value ];
	
	echo $label;

});

// Opps Columns Sortable
$vdc_opps->sortable(array(
	'organisation' => array('organisation', false),
	'activity' => array('activity', false)
));








// Staff CPT

$labels = array(
	'post_type_name' => 'staff',
    	'singular' => 'Staff',
    	'plural' => 'Staff',
    	'slug' => 'staff'
);

$our_people = new CPT($labels, array(
	'supports'	=> array('title', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-admin-users'
));

$args = array(
	'hierarchical' => false
);

$our_people->register_taxonomy('role', $args);

// Managing Volunteers CPT
$labels = array(
	'post_type_name' => 'managing-volunteers',
    	'singular' => 'Manage Volunteer',
    	'plural' => 'Managing Volunteers',
    	'slug' => 'managing-volunteers'
);
$managing_volunteers = new CPT($labels, array(
	'supports'	=> array('title', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-universal-access',
	'capability_type'    => 'post',
	'has_archive'        => true
));

// Toolkit CPT
$labels = array(
	'post_type_name' => 'toolkit',
    	'singular' => 'Toolkit',
    	'plural' => 'Toolkits',
    	'slug' => 'toolkit'
);
$toolkit = new CPT($labels, array(
	'supports'	=> array('title', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-hammer'
));
$toolkitArgs = array(
	'hierarchical' => false
);
$toolkit->register_taxonomy('kind', $toolkitArgs);

// vision and mission attachments CPT
$labels = array(
	'post_type_name' => 'vmattachments',
    	'singular' => 'V&M Attachment',
    	'plural' => 'V&M Attachments',
    	'slug' => 'vmattachments'
);
$vmattachments = new CPT($labels, array(
	'menu_icon' => 'dashicons-media-document',
));
