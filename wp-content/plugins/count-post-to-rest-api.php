<?php
/*
Plugin Name: Count Posts to Rest API
Description: Counts the post types and add them to the rest API
Plugin URI: https://webbiz.ie
Author: Jason Morton
Author URI: https://webbiz.ie
Version: 1.0
License: GPL2
Text Domain: count-posts
*/

/*

    Copyright (C) 2016  Jason Morton  info@webbiz.ie

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * 
 * Count all the posts in the blog and return the number to the REST API
 * 
 */
function wb_count_post_localization() {
    wp_localize_script( 'count_post_angular', 'postdata', 
        array(
            'count_posts' => wb_count_posts()
        )
    );
}
function wb_count_posts() {
    $post_types = array();
    $count_posts = array();

    // Get an array of Registered Post Types
    foreach ( get_post_types( '', 'names' ) as $post_type ) {
        // Push PT names to an array
        array_push( $post_types,  $post_type );

    }
    // Get the count of each post type 
    foreach ($post_types as $post_type ) {
        // Push PT names to an array
        array_push( $count_posts,  wp_count_posts($post_type) );

    }

    // Combine the two Arrays KEY(Post Type), VALUE (Post Count)
    $data = array_combine($post_types, $count_posts);
    return $data;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'count-posts/v1', '/count', array(
        'methods' => 'GET',
        'callback' => 'wb_count_posts',
    ) );
} );









