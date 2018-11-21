<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<?php 
  $slickData = array(
    'slideAttach' => '#motion-'.$this->atts['gallery'],
    'atts'        => $this->atts
  );

  $slickAttr = 'slickAttrMotion'.$this->atts['gallery'] ;
?>

<?php  wp_enqueue_script('slick-shortcode', plugin_dir_url(__FILE__) . 'js/slick-initiate.js', array( 'jquery', 'slick' ),'1',true ); ?>
<?php wp_localize_script( 'slick-shortcode', $slickAttr, $slickData ); ?>




<?php if($this->slide_query->have_posts() ) : ?>

  <div class="dei-slider-shortcode-wrapper">

    <div id="motion-<?php echo $this->atts['gallery']; ?>" data-slick="Motion<?php echo $this->atts['gallery']; ?>"> 

   <?php while ( $this->slide_query->have_posts() ) : $this->slide_query->the_post(); ?>
        

      <div class="slider-inner" >

        <div class="item" >
          <?php require plugin_dir_path( __FILE__ ) . 'content-slide.php'; ?>
        </div><!--  item -->


      </div><!-- slider-inner -->

      
      <?php endwhile; ?> 


    </div><!-- #motion -->

  </div> <!-- #shortcode-wrapper -->


<?php endif; wp_reset_postdata(); ?>
