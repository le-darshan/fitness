<?php get_header(); 

$single_post_layout = get_post_meta($post->ID,'single_post_layout',true);
$global_post_layout = ot_get_option( 'post_layout');

if($single_post_layout == 'def' || $single_post_layout==''){
	$single_post_layout = $global_post_layout;
}
?>
<div class="bg-container single-post-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
		<div class="container-pad">
            <div class="row-fluid <?php echo ($single_post_layout == 'left') ? "revert-layout" : "";?>">
            	<?php 
                if($single_post_layout=='full' && $single_post_layout!='def'){?>
                	<div <?php post_class("span12"); ?>>
                <?php } else{?>
                	<div <?php post_class("span9"); ?>>
                <?php }
				$global_sticky_tag = ot_get_option('sticky_tag_blog');
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post();
						$format = get_post_format();
						$class = '';
						if($format == 'gallery'){
							echo '<div id="post-gallery">';
							echo do_shortcode('[ctgallery]');
							echo '</div>';
						} elseif($format == 'image'){
							echo '<div id="post-thumb">';
							the_post_thumbnail('full');
							echo '</div>';
						} else {
							$class = 'no-feature-image';
						}
						
						$sticky_tag = get_post_meta(get_the_ID(),'sticky_tag',true);
						if(is_sticky()){
							if($sticky_tag == '') $sticky_tag = $global_sticky_tag;
						}
						
						?>
						<h2 class="post-title <?php echo $class;?>"><?php the_title();?></a><?php if($sticky_tag){?>
																<i class="bookmark">
																	<?php echo $sticky_tag; ?>
																</i><?php }?></h2>
						<?php
                        the_content();
						wp_link_pages(); ?>
						<!--<div id="post-meta" class="post-meta">
							<div class="inner">
										<span class="author"><span class="icon-user"><?php the_author_posts_link(); ?></span></span> 					
									|
										<span class="rt-date-posted"><span class="icon-calendar"><?php echo date_i18n(get_option('date_format') ,strtotime(get_the_date()));?></span></span> 
									
									|
									<span class="rt-comment-block "> 
									  <a href="<?php comments_link(); ?>" class="rt-comment-text"> <span class="icon-comments"><?php echo get_comments_number(get_the_ID()) . ' ' . __('comments','cactusthemes');?></span> </a> 
									</span> 
									<?php
										$show_tag = ot_get_option('blog_show_cat');
										$posttags = get_the_tags();
										if (($show_tag == '1' || $show_tag == '') && $posttags) {?>
									|
									<span class="rt-tags">										
                                      <div class="post-tags">
                                        <i class="icon-tag"></i>
                                        <?php
                                            $i = 0;
                                          foreach($posttags as $tag) {
                                            echo 
                                            '<a title="'.$tag->name.'" href="' . get_tag_link($tag->term_id) .'">'.$tag->name . '</a>';
                                            if($i < count($posttags) - 1) echo ', '; 
                                            $i++;
                                          }
                                        ?>
                                      </div>
									</span>
									<?php } 
									?>
									<?php 
										$show_cat = ot_get_option('blog_show_cat');
										if($show_cat == '1' || $show_cat =='')
										{
											$cats = get_the_category();
											$separator = ', ';
											$output = '';
											if ($cats) {?>
											  <div class="post-cats post-tags">
												<i class="icon-bookmark" style="margin-right:3px;"></i>
												<?php
													$i = 0;
												  foreach($cats as $cat) {
													$output .= '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'cactusthemes'), $cat->name ) ) . '">'.$cat->cat_name.'</a>'.$separator;
												  }
												  
												  echo trim($output, $separator);
												?>
											  </div>
											<?php } 
										}
										?>
							</div>
						</div>-->
						<!-- end post meta -->
						<?php
						$social_post= get_post_meta($post->ID,'show_hide_social',true);
						if($social_post=='show'){ //check if show social share
                        	gp_social_share(get_the_ID());
						}
						if($social_post=='def'){
							if( ot_get_option( 'blog_show_socialsharing', 1)){ //check if show social share
								gp_social_share(get_the_ID());
							}
						}
						if(ot_get_option( 'blog_show_authorbio', 1)){ //check if show bio ?>
                        <!--<div id="author-bio">
							<div class="dotted-title">
                            <?php
							$rtl = ot_get_option('righttoleft');
							 if($rtl==0){?>
								<h3><?php echo __('About The Author','cactusthemes'); ?></h3>
								<div class="dotted"></div>
                            <?php }else{?>
                            	<div class="dotted"></div>
                            	<h3><?php echo __('About The Author','cactusthemes'); ?></h3>
                            <?php }?>
						  </div>
                          <div id="author-content">
                            <div id="author-avatar">
                                <?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>
                            </div>
							<h4><?php the_author_posts_link(); ?></h4>
                            <?php the_author_meta('description'); ?>                          
							<div class="clear"><!-- </div>
                          </div> 
						  <div class="clear"><!--</div>
                        </div>-->
                    <?php 
						}//if show bio
						
						$numberpost = ot_get_option('related_posts');
						$show_re_metadata = ot_get_option('show_re_metadata');
						$test = '';
						if( $numberpost==''||$numberpost=='-1'){
							$numberpost='All';
						}
						$conditions_posts = ot_get_option('conditions_posts');
						global $post;
						$posttypes= get_post_type();
						$posts_not_in= get_the_ID();
						$cat = '';
						$tags = '';
						if($conditions_posts==0)
						{
							$catt= wp_get_post_categories($post->ID);
							$cat = ($catt['0']);
						}
						else{
							$posttags = get_the_tags();
							if ($posttags) {
								foreach($posttags as $tag) {
									$tags .= ',' . $tag->slug; 
								}
								$tags = substr($tags, 1); 
							}
							
						}
						
                    if($numberpost!='0'){?>
						<!-- start related posts -->
							<?php 
							if(gp_is_plugin_active('gameplan-shortcodes/gameplan-shortcodes.php')){
								//echo do_shortcode('[related_post showmetadata="'.$show_re_metadata.'" posttypes="'.$posttypes.'" categories="'.$cat.'"  count="'.$numberpost.'"  condition="'.$tags.'" posts_not_in="'.$posts_not_in.'" ]');
							}?>
						<!-- end related posts -->
                          <?php } ?>
                         
                       <?php //comments_template( '', true );
                    endwhile; 
                endif; 
                ?>
                </div>
                <?php if($single_post_layout !='full'){?>
                	<div class="span3">
						<div id="mainsidebar">
                        <?php if(is_active_sidebar('single_blog_sidebar')) {
								echo get_dynamic_sidebar('single_blog_sidebar');
							}else{
								echo get_dynamic_sidebar('main_sidebar');
							}?>
                        </div>
                    </div>
				<?php } ?>
            </div>
		</div>
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>