<?php
$parent_page = $_COOKIE["page_name"];
$page_id = $post->ID;
// print_r($page_id .'   '. $parent_page);


if ( ( $parent_page == "vol" ) && ( $page_id != 4 ) ) {

	get_header('vol');

} elseif ( ( $parent_page == "vol" ) && ( $page_id == 4 ) ) {
	
	get_header('vol-home');

} elseif ( ( $parent_page == "org" ) && ( $page_id != 6 ) ) {

	get_header('org');

} elseif ( ( $parent_page == "org" ) && ( $page_id == 6 ) ) {
	
	get_header('org-home');

} else {

	get_header();

}
