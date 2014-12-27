<?php 
/**
 * Template Name: top-performers
 */
$in_woocommerce_page = 0;

if(function_exists('is_woocommerce_page') && is_woocommerce_page()){
	$in_woocommerce_page = 1;
}

$woocommerce_class = '';
if(function_exists('is_woocommerce_thanks_page')){
	$woocommerce_class = is_woocommerce_thanks_page() ? "woo-page thanks":(is_woocommerce_myaccount_page() ? "woo-page myaccount":(is_woocommerce_editaddress_page() ? "woo-page editaddress":(is_woocommerce_changepassword_page() ? "woo-page changepassword":(is_woocommerce_lostpassword_page() ? "woo-page lostpassword":(is_woocommerce_vieworder_page() ? "woo-page vieworder":(is_woocommerce_logout_page() ? "woo-page logout":""))))));
}
 
get_header(); ?>

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
			<div style="float: left;width: 100%;margin-bottom:2%;">
			<h5 style="color:#b7b7b7;float:left;width:10%;line-height:10px;">Filter by</h5>
			<select style="float:left">
			<option value="male">Male</option>
			<option value="female">Female</option>
			</select>
			<button type="submit" style="color:#fff;background:#78787B;border:none;font-size:15px;margin-left:1%;border-radius:3px;float:left;padding:5px 20px 5px 20px" ><i class="icon-filter"></i> FILTER</button>
			 			</div>
				 <div class="claer"></div>
          <?php 
					global $post;

$args = array (

	'post_type'              => 'exercises',
	'post_status'            => 'publish',
	'meta_query'             => array(
		array(
			'key'       => 'perfomers',
			'value'     => 'yes',
			'compare'   => 'LIKE',
			'type'      => 'CHAR',
		),
	),
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
	?><h5><?php echo  the_title(); ?>
</h5><?php
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
	
					
					//get_template_part('content','page');?>
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
