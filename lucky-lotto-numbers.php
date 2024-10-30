<?php
/*
 * Plugin Name: Loton onnennumerot
 * Plugin URI: https://wordpress.org/plugins/loton-onnennumerot
 * Description: Arpoo sinulle loton onnennumerot
 * Version: 1.0.0
 * Author: Ricky Green
 * Author URI: https://profiles.wordpress.org/rickygreen23
 * License: GPLv2 or later
 *
*/

if ( ! defined( 'ABSPATH' ) ) exit; 
// Load Styles
function lucky_lotto_backend_styles() {

 wp_enqueue_style( 'lucky_lotto_backend_css', plugins_url( 'css/lucky_lotto.css', __FILE__ ) );

}
add_action( 'admin_head', 'lucky_lotto_backend_styles' );


function lucky_lotto_frontend_scripts_and_styles() {

 wp_enqueue_style( 'lucky_lotto_frontend_css', plugins_url( 'css/lucky_lotto.css', __FILE__ ) );
 wp_enqueue_script( 'lucky_lotto_frontend_js', plugins_url( 'js/lucky_lotto.js', __FILE__ ), array('jquery'), '', true );

 // Localize the script 
$dir = basename(__DIR__) ;
$lotto_urls = array(
  'plugin_url'  => plugins_url() . '/' .  $dir
);
wp_localize_script( 'lucky_lotto_frontend_js', 'lucky_lotto_urls', $lotto_urls, admin_url( 'admin-ajax.php' ) );

}
add_action( 'wp_enqueue_scripts', 'lucky_lotto_frontend_scripts_and_styles' );

/**
 * Adds lucky_lotto widget.
 */
class lucky_lotto extends WP_Widget {

 /**
  * Register widget with WordPress.
  */
 function __construct() {
  parent::__construct(
   'lucky_lotto', // Base ID
   __( 'Loton Onnennumerot', 'lucky_lotto' ), // Name
   array( 'description' => __( 'Lisäosa joka arpoo lottonumerot', 'lucky_lotto' ), ) // Args
  );
 }

 /**
  * Front End 
  *
  * @see WP_Widget::widget()
  *
  * @param array $args     Widget arguments.
  * @param array $instance Saved values from database.
  */
 public function widget( $args, $instance ) {
  echo $args['before_widget'];
  if ( ! empty( $instance['title'] ) ) {
   echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
  } ?>
<form id="lucky-lotto-numbers">

<label class="lucky-lotto-label">Mikä on arvonta-asteikko?</label>
<select class="lucky-lotto-select" id="lotto-numbers">
  <option selected disabled>Numerot</option>
  <option value="40">1-40 Lotto</option>
  <option value="48">1-48 Viking Lotto</option>
  <option value="48">1-50 EuroJackpot</option>
</select>

<label class="lucky-lotto-label">Kuinka monta numeroa rivillä?</label>
<select class="lucky-lotto-select" id="lotto-rows">
  <option selected disabled>Määrä</option>
  <option value="7">7 Lotto</option>
  <option value="6">6 Viking Lotto</option>
  <option value="5">5 + 2 EuroJackpot</option>
</select>
<button class="button btn btn-md btn-danger" id="lucky-lotto-btn">Arvo numerot</button>
</form>

<ul id="lotto-number-response"></ul>
<?php
 echo $args['after_widget'];
 }

 /**
  * Back-end widget form.
  *
  * @see WP_Widget::form()
  *
  * @param array $instance Previously saved values from database.
  */
 public function form( $instance ) {
  $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Loton Onnennumerot', 'lucky_lotto' );
 // $number = ! empty()
  ?>
  <p>
  <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
  </p>
  <?php 
 }

 /**
  * Sanitize widget form values as they are saved.
  *
  * @see WP_Widget::update()
  *
  * @param array $new_instance Values just sent to be saved.
  * @param array $old_instance Previously saved values from database.
  *
  * @return array Updated safe values to be saved.
  */
 public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
  
  return $instance;
 }

} 

// register lucky_lotto widget
function register_lucky_lotto() {
    register_widget( 'lucky_lotto' );
}
add_action( 'widgets_init', 'register_lucky_lotto' );

?>