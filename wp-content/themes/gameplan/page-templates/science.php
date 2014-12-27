<?php 
/**
 * Template Name: science
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
      <div class="row-fluid">
        <div class="span9">
          <?php get_template_part('content','page');?>
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
<div class="bg-container" style="background-color:#0f0f0f;left: 0;width: 100%;height: 100%;">
<div class="container">
	<div class="container-pad">

  <div class="body-bottom" style="float:left;">
  			
          <div class="module-title"><h2 class="title def_style" style="color:  !important;  <!--margin-left:3%-->"><span><span class="firstword" style="color:  !important">THE BASICS OF YOUR NUTRITION</span></span></h2></div>
          <?php
			   $category_id = get_cat_ID('generic');
			   $cat_id = $category_id; 
			    
            $latest_cat_post = new WP_Query( array('posts_per_page' => 2, 'category__in' => array($cat_id)));
            if( $latest_cat_post->have_posts() ) : while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post();  ?>
          <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
          <div  class="span3 span_img" style="margin-left:20px">
            <?php the_post_thumbnail(array(270,250) );  ?>
            <h5><?php echo $post->post_title;?></h5>
            <?php the_excerpt(); ?>
          </div>
          <?php endif; ?>
          <?php endwhile; endif; ?>
         
     
</div>

  	<div class="body-bottom le_body_bottom"  style="float:left;">
         <div class="module-title"><h2 class="title def_style" style="color:  !important; <!--margin-left:3%--> " ><span><span class="firstword" style="color:  !important">THE BASICS OF YOUR NUTRITION</span></span></h2></div>
          <?php
			   $category_id = get_cat_ID('generic');
			   $cat_id = $category_id; 
			    
            $latest_cat_post = new WP_Query( array('posts_per_page' => 2, 'category__in' => array($cat_id)));
            if( $latest_cat_post->have_posts() ) : while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post();  ?>
          <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
          <div class="span3 span_img" style="margin-left:20px">
            <?php the_post_thumbnail(array(270,250) );  ?>
            <h5><?php echo $post->post_title;?></h5>
            <?php the_excerpt(); ?>
			<div class="clear"></div>
          </div>
          <?php endif; ?>
          <?php endwhile; endif; ?>
         </div>
     </div>
</div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
 
<?php get_footer(); ?>
