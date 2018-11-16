<?php
// exit if file is called directly
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Slick_Slider_Shortcode{

  public $atts = array();

  public $default_atts = array();

  public function __construct(){
    $this->init();
    $this->set_default_attributes();
  }

  //load actions and shortcodes in separate method because constructor should only establish what's necessary for the object to exist, indepedent of wordpress
  private function init(){
    add_shortcode('slick', array($this, 'slick_shortcode'));
    wp_enqueue_style('slick-shortcode.min.css', plugin_dir_url(__DIR__) .  'public/css/slick-slider-shortcode.css', array(), '1', 'all' ); 
    wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ),'1.8.1',true );
   
  }

  public function set_default_attributes(){

    $this->default_atts = array( 
      //slider stuff 
      'autoplay'        => false,
      'autoplaySpeed'   => 3000,
      'arrows'          => true,
      'dots'            => true,
      'fade'            => false,
      'infinite'        => false,
      'pauseOnHover'    => true,
      'slidesToScroll'  => 1,
      'slidesToShow'    => 1,
      

      //wp stuff for query
      'gallery'         => '',
      'ids'             =>  '',
      'order'           => 'ASC',
      'orderby'         => 'menu_order',
      'height'          => '500px',
      'width'           => '100%',
      'posts_per_page'  => '-1',
      'captions'        => false,
      'testimonials'     => false
    );

    return $this->default_atts;

  }

  //establish shortcode output and WP query
  //get base template file
  public function slick_shortcode($atts, $content = null ){ 

    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $this->atts = shortcode_atts( $this->default_atts, $atts);

    if ($this->atts['ids'] !== '') {
      $this->slide_query = new WP_Query(array(
      'post_type'       => 'slide',
      'orderby'         => $this->atts['orderby'],
      'order'           => $this->atts['order'],
      'post__in'        => explode(', ', $this->atts['ids']),
      'posts_per_page'  => $this->atts['posts_per_page'],
      )); 
    } elseif ($this->atts['gallery'] !== '') {
      $this->slide_query = new WP_Query(array(
      'post_type'       => 'slide',
      'orderby'         => $this->atts['orderby'],
      'order'           => $this->atts['order'],
      'slide-gallery'   => $this->atts['gallery'],
      'posts_per_page'  => $this->atts['posts_per_page'],
      )); 
    } else{
      return;
    }

    ob_start();
    require plugin_dir_path(__DIR__) . 'public/slide-gallery-base.php'; 
    return ob_get_clean(); 
  }

} //end class

$slick_slider_shortcode = new Slick_Slider_Shortcode(); 


//autoplay not working -- where are attributes being merged?
//what do we name sliders that only have ids and no galleries?