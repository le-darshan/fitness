<?php 
/**
 * Template Name: Right Sidebar
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
<?php if(is_page('3121')){?>

<div class="bg-container single-post-body <?php echo $woocommerce_class;?>"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
		<div class="container-pad">
			<div class="row-fluid">
				<div class="span9">
				<div class="vc_row wpb_row vc_row-fluid" style="margin-bottom:0px;">
	<div class="vc_col-sm-12 wpb_column vc_column_container">
		<div class="wpb_wrapper">
			
			<div class="box-style-1 heading-shortcode" id="heading-id16872">
				<div class="module-title"><h2 class="title def_style" style="color:  !important"><span><span class="firstword" style="color:  !important">TRAINING PROGRAMS</span></span></h2></div>
			</div>
		
		</div> 
	</div> 
</div>
				<div class="vc_row wpb_row vc_row-fluid">
			
		 
	
	
 	
   <?php
   $category_id = get_cat_ID('generic');
    $cat_id = $category_id;; //the certain category ID
            $latest_cat_post = new WP_Query( array('posts_per_page' => 2, 'category__in' => array($cat_id)));
            if( $latest_cat_post->have_posts() ) : while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post();  ?>
            
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="vc_col-sm-6 wpb_column vc_column_container">
                  <div class="wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element le_test" style="margin-top:0px;">
	<div id="le_img-title" class="img-title" ><a class="view_all"><h4><?php the_title();?></h4></a></div>
		<div class="wpb_wrapper gallery-item">
				 <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(720,720) );  ?></a>
				 
		</div> 
		
	</div> 
	 
		</div>  
					
					 
                   
                <?php endif; ?>
            <div class="wpb_text_column wpb_content_element  vc_custom_1415099094692">
		<div class="wpb_wrapper">
			 
	<?php the_excerpt(); ?>
		</div> 
	</div>
         
		
					 
             </div> 
            
            <?php endwhile; endif; ?>
  
</div>					<?php //get_template_part('content','page');?>
					<div class="clear"></div>
					<div class="vc_row wpb_row vc_row-fluid" style="margin-bottom:0px;">
	<div class="vc_col-sm-12 wpb_column vc_column_container">
		<div class="wpb_wrapper">
			
			<div class="box-style-1 heading-shortcode" id="heading-id16872">
				<div class="module-title"><h2 class="title def_style" style="color:  !important"><span><span class="firstword" style="color:  !important">DIET PLANS</span></span></h2></div>
			</div>
		
		</div> 
	</div> 
</div>
				<div class="vc_row wpb_row vc_row-fluid">
			
		 
	
	
 	
   <?php
   $category_id = get_cat_ID('generic');
    $cat_id = $category_id;; //the certain category ID
            $latest_cat_post = new WP_Query( array('posts_per_page' => 2, 'category__in' => array($cat_id)));
            if( $latest_cat_post->have_posts() ) : while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post();  ?>
            
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="vc_col-sm-6 wpb_column vc_column_container">
                  <div class="wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element le_test" style="margin-top:0px;">
	<div id="le_img-title" class="img-title" ><a class="view_all"><h4><?php the_title();?></h4></a></div>
		<div class="wpb_wrapper gallery-item img-wrap1">
				 <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(720,720) );  ?></a>
				 
		</div> 
		
	</div> 
	 
		</div>  
					
					 
                   
                <?php endif; ?>
            <div class="wpb_text_column wpb_content_element  vc_custom_1415099094692">
		<div class="wpb_wrapper">
			 
	<?php the_excerpt(); ?>
		</div> 
	</div>
         
		
					 
             </div> 
            
            <?php endwhile; endif; ?>
			<div class="clear" style="margin-bottom:3%;"></div>
			<div style="padding-left: 15px;padding-right: 15px;">
			
			<?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home sale') ) {}?>	
			</div>
  
</div>	
				
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



<?php }else{ ?>
<div class="bg-container single-post-body <?php echo $woocommerce_class;?>"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
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
<?php } ?>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>