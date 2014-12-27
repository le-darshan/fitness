<?php 
/**
 * Template Name: Dait Program
 */
$in_woocommerce_page = 0;

if(function_exists('is_woocommerce_page') && is_woocommerce_page()){
	$in_woocommerce_page = 1;
}

$woocommerce_class = '';
if(function_exists('is_woocommerce_thanks_page')){
	$woocommerce_class = is_woocommerce_thanks_page() ? "woo-page thanks":(is_woocommerce_myaccount_page() ? "woo-page myaccount":(is_woocommerce_editaddress_page() ? "woo-page editaddress":(is_woocommerce_changepassword_page() ? "woo-page changepassword":(is_woocommerce_lostpassword_page() ? "woo-page lostpassword":(is_woocommerce_vieworder_page() ? "woo-page vieworder":(is_woocommerce_logout_page() ? "woo-page logout":""))))));
}
 
get_header();  
 

global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
$current_url = substr($current_url, strrpos($current_url, '/') + 1);
?>
<div class="bg-container single-post-body <?php echo $woocommerce_class;?>">
  <div class="body-top-color">
    <!---->
  </div>
  <div class="background-color">
    <!---->
  </div>
  <div class="container">
    <div class="container-pad">
      <div class="row-fluid revert-layout">
<div class="span9">
           <h6 style="text-align:center; height: 14px;"><span id="l_text">MY PROGRAM</span></h6><hr />
	<div class="span3" style="width:auto;">
	<span><strong>Meal Options&nbsp;&nbsp;</strong> </span>
		 	<select name="meal_cat">
			 <option>--select--</option>
    <option value="breakfast"  >Breakfast</option>
	<option value="lunch" >lunch</option>
	<option value="dinner" >dinner</option>
    </select></div>
  <div class="span3" style="width:auto;"><span><strong>Type&nbsp;&nbsp;</strong> </span>
  <select name="meal_type">
	<option value="quick&easy" >Quick & Easy</option>
	<option value="luxury" >Luxury</option>
	<option value="fullfat" >Full Fat</option>
</select>

  </div>

		  <?php
	 // WP_Query arguments
$args = array (
 'post_type'              => 'diet_plans',
 'post_status'            => 'publish',
 'pagination'             => true,
 'posts_per_page'         => '4',
 'meta_query'             => array(
  array(
   'key'       => 'meal_cat',
   'value'     => 'lose-weight',
  ),
 ),
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
 while ( $query->have_posts() ) {
  $query->the_post();
  
//echo '<pre>'; print_r($query);exit;
  ?><div id="le_ecerciseprg">
						 		<div id="le_ecercisechild">
									<div id="le_ecerciseimg">
										<img src="<?php bloginfo('template_directory'); ?>/images/embeded.png" />
									</div>
									<div id="le_ecercisesub">
										<div id="le_ecercisetitle"><?php the_title(); ?></div>
										<div id="le_ecercisecontent"><?php the_excerpt(); ?></div>
										<div id="le_button" style="float:right"><input class="wpvdo" type="button" name="eatch-video" value="Watch Video" /> &nbsp;&nbsp;<input class="wpvdo" type="button" name="insturctions" value="Insturctions" /></div>
									
									</div>
									<div id="le_exeline"></div>
								</div>
									
									
							<div class="clear"></div></div><?php
 }  
} else {
 // no posts found
}

// Restore original Post Data
wp_reset_postdata();
 			  ?>
        
        </div>
        <div id="mainsidebar" class="span3">
          <?php 
					if($in_woocommerce_page){
							if(is_active_sidebar('woocommerce')){
								echo get_dynamic_sidebar('woocommerce');
							} else {
								echo get_dynamic_sidebar(get_post_meta(get_the_ID(),'sidebar_name',true)?get_post_meta(get_the_ID(),'sidebar_name',true):'main_sidebar');
							}
						} else 
							echo get_dynamic_sidebar(get_post_meta(get_the_ID(),'sidebar_name',true)?get_post_meta(get_the_ID(),'sidebar_name',true):'main_sidebar');?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="bg-container">
  <?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
  <?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>
