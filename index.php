<?php
/*
Plugin Name: Perfect Related Posts
Plugin URI:  http://www.developingsense.com/perfectrelatedposts
Description: This plugin shows all the related posts according to the categories of the displayed post.
Version:     1.0
Author:      Amrinder Singh
Author URI:  http://www.developingsense.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_action( 'wp_enqueue_scripts', 'register_dsense_styles' );
function register_dsense_styles() {
	wp_register_style( 'ds-categories', plugins_url( 'perfect-related-posts/css/style.css' ) );
	wp_enqueue_style( 'ds-categories' );
}
function dsense_more_from_cat( $output ) {
	if(is_single()) {
    global $post;
    // We should get the first category of the post
    $categories = get_the_category( $post->ID );
	foreach ($categories as $category) {
	$cat = $category->cat_ID;
    //$first_cat = $categories[0]->cat_ID;
    // Let's start the $output by displaying the title and opening the <ul>
    $output .= '<div id="dsense_more_cat"><h3>Related Posts</h3>';
    // The arguments of the post list!
    $args = array(
        // It should be in the first category of our post:
		// doesnot include the child category posts using category_in
        'category__in' => array( $cat ),
        // Our post should NOT be in the list:
        'post__not_in' => array( $post->ID ),
        // ...And it should fetch 5 posts - you can change this number if you like:
        'posts_per_page' => get_option('dsense_number_posts')
    );
    // The get_posts() function
    $posts = get_posts( $args );
    if( $posts ) {
        $output .= '<ul id="#more-from-cat1">';
        foreach( $posts as $post ) {
            setup_postdata( $post );
            $post_title = get_the_title();
			$post_id = get_the_ID();
			$postimage = wp_get_attachment_thumb_url( get_post_thumbnail_id($post_id) );
            $permalink = get_permalink();
			$output .= '<li><a href="' . $permalink . '" title="' . esc_attr( $post_title ) . '">'.'<img src="'.$postimage.'"title="' . esc_attr( $post_title ) . '"></a>';
            $output .= '<a href="' . $permalink . '" title="' . esc_attr( $post_title ) . '">' . $post_title . '</a></li>';
			}
        $output .= '</ul>';
    } else {
        // If there are no posts, we should return something, too!
        $output .= '<p>Sorry, no more related posts!</p>';
    } wp_reset_query(); }
    // Let's close the <div> and return the $output:
    $output .= '</div>';
    return $output;
	}
		else{	
			echo get_the_content();
	}
}
add_action('the_content', 'dsense_more_from_cat');

add_action('admin_menu', 'dsense_admin_menu');
 
function dsense_admin_menu(){
        add_menu_page( 'Dsense related Cat page', 'Perfect Related Posts', 'manage_options', 'perfect related posts', 'prp_init' );
		add_action( 'admin_init', 'register_mysettings' ); 
}
 
function prp_init(){
       include('admin/perfect-related-admin.php');
}

function register_mysettings() { //register our settings 

register_setting( 'super-settings-group', 'dsense_number_posts' ); 
}
?>