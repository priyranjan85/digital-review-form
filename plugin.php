<?php
/*
Plugin Name: Review Form
Plugin URI: https://www.phoeniixx.com/
Description: Review Form.
Version: 1.5.0
Author: smeogoweb
Author URI: http://www.phoeniixx.com
Text Domain: pho-pincode-zipcode-cod
WC requires at least: 2.6.0
WC tested up to: 3.5.2
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**

** Check if WooCommerce is active
 
**/


add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */


function wpdocs_register_meta_boxes() {
    add_meta_box( 'meta-box-id', __( 'Review Form', 'textdomain' ), 'wpdocs_my_display_callback', 'review_form' );
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );

function wpdocs_my_display_callback( $post ) {
  $outline="";
  $outline .= '<div style="width:100%;float:left;margin:10px 0;"><label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Email ID', 'text-domain') .'</label>';
  $email_id = get_post_meta( $post->ID, 'email_id', true );
  $outline .= $email_id.'</div>';

$outline .= '<div style="width:100%;float:left;margin:10px 0;"><label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Telephone No', 'text-domain') .'</label>';
  $telphone_no = get_post_meta( $post->ID, 'telphone_no', true );
  $outline .= $telphone_no.'</div>';
  $outline .= '<div style="width:100%;float:left;margin:10px 0;"><label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Deliver Address', 'text-domain') .'</label>';
  $delivery_address = get_post_meta( $post->ID, 'delivery_address', true );
  $outline .= $delivery_address.'</div>';

$outline .= '<div style="width:100%;float:left;margin:10px 0;"><label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Rating', 'text-domain') .'</label>';
  $rating = get_post_meta( $post->ID, 'rating', true );
  $outline .= $rating.'</div>';
$outline .= '<div style="width:100%;float:left;margin:10px 0;"><label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Feedback', 'text-domain') .'</label>';
  $feedback = get_post_meta( $post->ID, 'feedback', true );
  $outline .= $feedback.'</div>';
    echo $outline;
}

function review_form() {
    $args = array(
      'public' => true,
      'supports' => array( 
  'title', 
  'editor', 
  'excerpt', 
  'thumbnail', 
  'custom-fields', 
  'revisions' 
),
      'label'  => 'Review Form'
    );
    register_post_type( 'review_form', $args );
}

//
add_action( 'init', 'review_form' );
function myplugin_activate() {

  
}
register_activation_hook( __FILE__, 'digital-review-form_activate' );
add_shortcode('left_review_form','left_review_form_function');
function left_review_form_function( $atts ) {

   require_once(dirname(__FILE__).'/function.php');
    wp_enqueue_style( 'digital-review-form-css', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
    wp_enqueue_style( 'digital-review-form-css', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css' );
    wp_enqueue_script( 'digital-review-form', plugin_dir_url( __FILE__ ) . '/assets/js/custom.js', array( 'jquery' ) );
?>

    <style>
  <style>

</style>

<script type="text/javascript">
   
    // ]]></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <div id="feedbackside-wrap">

      <div class="callto" onclick="toggleForm()">Customer Feedback Form</div>
      <div class="feedbackfor">
        <form action="" method="POST" enctype="multipart/form-data" id="tesimonial-form" onsubmit="return validateform();">
          <input type="text" name="fname" placeholder="Full Name" required>
          <input type="email" name="emailid" placeholder="Email" required>
          <input type="number" name="phone_no" placeholder="Phone" required>
          <textarea placeholder="Address" name="address" required></textarea>
          <div class="feedimg">
            <input type="file" name="file1" placeholder="Profile Picture" onchange="previewFile()">
            <img src="<?php bloginfo('template_url') ?>/images/default-avatar.jpg" height="200" alt="Image preview...">
          </div>
          <textarea placeholder="Message" name="feedback" required></textarea>
          <div class="feedstar">
            <input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
              <label class="star star-5" for="star-5"></label>
              <input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
              <label class="star star-4" for="star-4"></label>
              <input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
              <label class="star star-3" for="star-3"></label>
              <input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
              <label class="star star-2" for="star-2"></label>
              <input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
              <label class="star star-1" for="star-1"></label>
          </div>
          <?php 
         $digital_google_captcha=get_option('digital_google_captcha');
          if($digital_google_captcha!="")
             {
          echo '<div class="g-recaptcha" data-sitekey="'.$digital_google_captcha.'"></div>';
             }?>
          <input type="submit" name="done" value="Submit">
        </form>
      </div>
    </div>
    <?php

}
/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_review_menu' );

/** Step 1. */
function my_review_menu() {
  add_options_page( 'Review Setting', 'Review Setting', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
   if(isset($_POST['submit']))
   {
   update_option( 'digital_google_captcha', $_POST['digital_google_captcha'] );
   update_option( 'digital_thankyou', $_POST['digital_thankyou'] );
   
    update_option( 'digital_emailid', $_POST['digital_emailid'] );
  
  }

  $digital_google_captcha=get_option('digital_google_captcha');
   $digital_thankyou=get_option('digital_thankyou');
    $digital_emailid=get_option('digital_emailid');

  echo 'Please Use shortcode:      [left_review_form]';
   
  echo '<form action="#" method="post">';
  echo '<div style="width:100%;float:left;margin:5px 0;"><label style="display:inline-block;width:145px;"> Google data-sitekey</label><input type="text" name="digital_google_captcha" style="margin: 10px;width: 400px;" value="'. $digital_google_captcha.'"></div>';
  echo '<div style="width:100%;float:left;margin:10px 0;"><label style="display:inline-block;width:145px;"> Thank You Page</label><input type="text" name="digital_thankyou"  style="margin: 10px;width: 400px;" value="'.$digital_thankyou.'"></div>';
    echo '<div style="width:100%;float:left;margin:10px 0;"><label style="display:inline-block;width:145px;">Email ID</label><input type="text" name="digital_emailid"  style="margin: 10px;width: 400px;" value="'.$digital_emailid.'"></div>';
   echo '<div style="width:100%;float:left;margin:10px 0;"><input type="submit" name="submit" value="submit"></div>'; 
  echo '</form>';
}

add_action( 'init', 'review_published_post' );

function review_published_post()
{
    
    
    
    if($_REQUEST['publish']!='')
    {
        
        $post_id=$_REQUEST['publish'];
   
       $post = array( 'ID' => $post_id, 'post_status' =>'publish' );
       wp_update_post($post);
        $url= get_option('digital_thankyou');
      echo "<script>window.location.href='{$url}';</script>";

    }
    
}

?>
