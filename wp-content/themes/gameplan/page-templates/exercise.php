<?php 
/**
 * Template Name: program
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
          <?php
	 
  $user_id = get_current_user_id();
  $key = 'exercises_days';
  $single = true;
  $user_exercises = get_user_meta( $user_id, $key, $single ); 

 
				  $args = array (
					'post_type'              => 'exercises',
					'post_status'            => 'publish',
					
				 
				); 
				$ex_ids=array();
				// The Query
				 $querydata = new WP_Query( $args );
				  $querydata = new WP_Query( $args );
				if ( $querydata->have_posts() ) {
					while ( $querydata->have_posts() ) {
						 $querydata->the_post();
						//echo  $post_ids = $post->ID;
					
					
						$ex_ids[]=$post->ID;
					}
				} else {
					// no posts found
				}
				
				  // WP_Query arguments
				 
				  if($user_exercises == '2'){
				 $args = array (
					'post_type'              => 'program',
					'post_status'            => 'publish',
					'meta_query'             => array(
						array(
							'key'       => 'prg_day',
							'value'     => '2-day',
						),
					),
				); 

				// The Query
				 $query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						 $query->the_post();
						 

						 $data = get_post_meta($post->ID);
						
						 ?><h4><?php //the_title();?></h4><?php
						foreach($ex_ids as $id)
						{
							 if(isset($data['set_'.$id][0]) || isset($data['rest_'.$id][0]) || isset($data['reps_'.$id][0]))
							 {
							$exciese_content = get_post($id);
							#echo "<pre>";print_r($exciese_content);
							?><div id="le_ecerciseprg">
						 		<div id="le_ecercisechild">
									<div id="le_ecerciseimg">
										<img src="<?php bloginfo('template_directory'); ?>/images/embeded.png" />
									</div>
									<div id="le_ecercisesub">
										<div id="le_ecercisetitle"><a href="<?php the_permalink(); ?>"><?php 
										echo $exciese_content->post_title;  ?></a></div>
										<div id="le_ecercisecontent"><?php echo $exciese_content->post_excerpt; ?></div>
									</div>
									<div id="le_exeline"></div>
								</div>
									
									<div id="le_ecercisdata">
										<ul>
											<li>Sets</li>
											<li>Reps</li>
											<li>Rest</li>								
										</ul>
							</div>
							<div id="le_ecercisdata1">
										<ul>
								<?php
													
												
								echo '<li>'. $data['set_'.$id][0].'</li>';
							
									
							echo '<li>'. $data['rest_'.$id][0].'</li>';
							
								
							echo '<li>'.$data['reps_'.$id][0].'</li>';
							
							?>	</ul>
							</div><div class="clear"></div></div><?php
							}
						} 
						
					}
				} else {
					// no posts found
				}
				}elseif($user_exercises == '3'){
				
				
				 $args = array (
					'post_type'              => 'program',
					'post_status'            => 'publish',
					'meta_query'             => array(
						array(
							'key'       => 'prg_day',
							'value'     => '2-day',
						),
					),
				); 

				// The Query
				 $query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						 $query->the_post();
						 

						 $data = get_post_meta($post->ID);
						
						 ?><h4><?php //the_title();?></h4><?php
						foreach($ex_ids as $id)
						{
							 if(isset($data['set_'.$id][0]) || isset($data['rest_'.$id][0]) || isset($data['reps_'.$id][0]))
							 {
							$exciese_content = get_post($id);
							#echo "<pre>";print_r($exciese_content);
							?><div id="le_ecerciseprg">
						 		<div id="le_ecercisechild">
									<div id="le_ecerciseimg">
										<img src="<?php bloginfo('template_directory'); ?>/images/embeded.png" />
									</div>
									<div id="le_ecercisesub">
										<div id="le_ecercisetitle"><a href="<?php the_permalink(); ?>"><?php 
										echo $exciese_content->post_title;  ?></a></div>
										<div id="le_ecercisecontent"><?php echo $exciese_content->post_excerpt; ?></div>
									</div>
									<div id="le_exeline"></div>
								</div>
									
									<div id="le_ecercisdata">
										<ul>
											<li>Sets</li>
											<li>Reps</li>
											<li>Rest</li>								
										</ul>
							</div>
							<div id="le_ecercisdata1">
										<ul>
								<?php
													
												
								echo '<li>'. $data['set_'.$id][0].'</li>';
							
									
							echo '<li>'. $data['rest_'.$id][0].'</li>';
							
								
							echo '<li>'.$data['reps_'.$id][0].'</li>';
							
							?>	</ul>
							</div><div class="clear"></div></div><?php
							}
						} 
						
					}
				} else {
					// no posts found
				}
				
				}
				// Restore original Post Data
				 wp_reset_postdata(); ?>
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
