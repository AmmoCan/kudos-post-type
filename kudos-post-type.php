<?php
/*
Plugin Name: Kudos Post Type
Plugin URI: http://2-drops.com/
Description: A plugin that will create a custom post type for displaying testimonials.
Version: 1.0
Author: AmmoCan
Author URI: http://www.linkedin.com/in/ammocan
License: GPL3
*/

/*  Copyright 2014 Two Drops (email : ammo@2-Drops.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this plugin; if not, write to the following:
    
    Free Software Foundation, Inc.,
    51 Franklin St, Fifth Floor,
    Boston, MA 02110-1301 USA
*/

/*
   Add custom post type.
*/

// Ensure the proper doctype is added to the HTML document.
if ( !function_exists( 'kudos_custom_posttype' ) ) :
function kudos_custom_posttype() {
  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __('Testimonials'),
        'singular_name' => __('Testimonial'), 
        'all_items' => __('All Testimonials'), 
        'add_new_item' => __('Add New Testimonial'),
        'edit_item' => __('Edit Testimonial'), 
        'view_item' => __('View Testimonial')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'testimonials'),
      'show_ui' => true, 
      'show_in_menu' => true, 
      'show_in_nav_menus' => true,
      'capability_type' => 'post', 
      'supports' => array('title', 'editor', 'thumbnail'), 
      'exclude_from_search' => true, 
      'menu_position' => 80, 
      'has_archive' => true, 
      'menu_icon' => 'dashicons-format-status'
    )
  );
}
add_action( 'init', 'kudos_custom_posttype');
endif;

// Set up meta box
if ( !function_exists( 'kudos_custom_meta_box' ) ) :
add_action( 'admin_init', 'kudos_custom_meta_box' );
function kudos_custom_meta_box() {
  add_meta_box( 'kudos_testimonial_meta_box', 'Testimonial Details', 'kudos_testimonial_form', 'testimonials', 'normal', 'high' );
}
endif;

// Create function to render the content of the meta box
if ( !function_exists( 'kudos_testimonial_form' ) ) :
function kudos_testimonial_form() {
  global $post;
  $values = get_post_custom( $post->ID );
  $client_name = isset( $values['client_name'] ) ? esc_attr( $values['client_name'][0] ) : '';
  $company = isset( $values['company'] ) ? esc_attr( $values['company'][0] ) : '';
  $link = isset( $values['link'] ) ? esc_attr( $values['link'][0] ) : '';
  
  wp_nonce_field( 'testimonials_nonce', 'testimonial_nonce' );
    ?>
  <div>
    <label for="client_name">Client Name</label>
    <input type="text" name="client_name" id="client_name" style="margin-top:15px; margin-left:9px; margin-bottom:10px;" value="<?php echo $client_name; ?>" /><br />
    <label for="company">Company</label>
    <input type="text" name="company" id="company" style="margin-left:25px; margin-bottom:10px;" value="<?php echo $company; ?>" /><br />
    <label for="company">Link</label>
    <input type="text" name="link" id="link" style="margin-left:58px; margin-bottom:15px;" value="<?php echo $link; ?>" />
  </div>
    <?php
}
endif;

// Create save post function to be used when saving
if ( !function_exists( 'kudos_save_meta' ) ) :
add_action( 'save_post', 'kudos_save_meta', 10, 2 );
function kudos_save_meta( $post_id ) {
  
  // Bail if we're doing an auto save
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if ( !isset( $_POST['testimonial_nonce'] ) || !wp_verify_nonce( $_POST['testimonial_nonce'], 'testimonials_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if ( !current_user_can( 'edit_post' ) ) return;

    if (isset( $_POST['client_name'] ) )
        update_post_meta( $post_id, 'client_name', esc_attr( $_POST['client_name'] ) );
        
    if (isset( $_POST['company'] ) )
        update_post_meta( $post_id, 'company', esc_attr( $_POST['company'] ) );
         
    if (isset( $_POST['link'] ) )
        update_post_meta( $post_id, 'link', esc_attr( $_POST['link'] ) );
}
endif;

// Create function to use custom template dedicated to custom post type
if ( !function_exists( 'kudos_template_function' ) ) :
add_filter( 'template_include', 'kudos_template_function', 1 );
function kudos_template_function( $template_path ) {
  
  if ( get_post_type() == 'testimonials' ) {
      if ( is_single() ) {
          // checks if the file exists in the theme first,
          // otherwise serve the file from the plugin
          if ( $theme_file = locate_template( array ( 'testimonial.php' ) ) ) {
              $template_path = $theme_file;
          } else {
              $template_path = plugin_dir_path( __FILE__ ) . '/templates/testimonial.php';
          }
      }
      if ( is_archive() ) {
          // checks if the file exists in the theme first,
          // otherwise serve the file from the plugin
          if ( $theme_file = locate_template( array ( 'archive-testimonials.php' ) ) ) {
              $template_path = $theme_file;
          } else {
              $template_path = plugin_dir_path( __FILE__ ) . '/templates/archive-testimonials.php';
          }
      }
  }
  return $template_path;
}
endif;

// Create function to remove the autop from the custom post type content
if ( !function_exists( 'kudos_remove_autop' ) ) :
add_filter( 'the_content', 'kudos_remove_autop', 0 );
function kudos_remove_autop( $content ) {
  
    'testimonials' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
    return $content;
}
endif;

// Create custom css function to enqueue style sheet only where custom post types are being displayed
// Comment out the following lines 163 - 173 if you are copying and pasting the plugins css into your theme's stylesheet
if ( !function_exists( 'kudos_css_function' ) ) :
add_action( 'wp_enqueue_scripts', 'kudos_css_function' );
function kudos_css_function() {
  
  if ( get_post_type() == 'testimonials' ) {
    if ( is_single() || is_archive() ) {
      wp_enqueue_style( 'kudos-styles', plugins_url( '/kudos-styles.css', __FILE__ ), array(), null, false );
    }
  }
}
endif;

?>