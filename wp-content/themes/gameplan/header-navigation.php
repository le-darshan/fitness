<?php 
	// Navigation part of template
?>
<div id="navigation">
			<?php if(ot_get_option( 'topmenu_visible', 1)){?>
            <div class="bg-container" id="nav-top">
                <div class="container">
                	<div class="container-pad">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="nav-contact">
                                    <?php if(is_active_sidebar('top_menu')):?>                                    
                                        <?php echo get_dynamic_sidebar('top_menu');?>
                                    <?php endif;?>
                                </div>
                            </div>
                            
                        <div class="span6 text-right">
                        
                         <?php global $current_user, $wp_roles;
							

								/* Load the registration file. */
							
									if ( is_user_logged_in() ) 
									{ 
										 get_currentuserinfo(); 
									?>
                        
						<div id="le_menutop"> <ul>
						<li><a href="http://cleaverfitness.com/checkout/"><i style="color:#A85353;font-size:17px;vertical-align:sub" class="icon-shopping-cart">&nbsp;&nbsp;&nbsp;</i>Checkout</a></li>
						<li>
						                      <a href="#" class="le_loginmenu" style="margin-right: 2%;"> <img src="http://cleaverfitness.com/wp-content/uploads/2014/11/register.png"/>&nbsp;
						 <?php echo $current_user->user_login ;  ?> </a>
						 <ul>
						 
						 <li><a href="<?php get_site_url(); ?>/user-view-profile">Profile</a></li>
						
						 </ul></li></ul>
						 </div>
     
         <a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout" class="le_loginmenu" style=" margin-right:45px;color:#fff "><img src="http://cleaverfitness.com/wp-content/uploads/2014/11/login.png" /> 
&nbsp;logout</a>

                        <?php } else{ ?>
                      
                        	<a href="<?php get_site_url(); ?>/register" class="le_loginmenu">
                           
                            <img src="http://cleaverfitness.com/wp-content/uploads/2014/11/register.png"/>&nbsp;&nbsp;Regster</a>
                                                    
                     
                           <a class="le_loginmenu" href="http://cleaverfitness.com/login" style="margin-right:73px"><img src="http://cleaverfitness.com/wp-content/uploads/2014/11/login.png" /> &nbsp;&nbsp;Sign in</a>
                           
		              
                      
                      
                      
                           <?php } ?>
                            <?php 
                        
							$arr_social = array(
								'facebook' => ot_get_option('acc_facebook'),
								'envelope' => ot_get_option('acc_envelope'),
								'twitter' => ot_get_option('acc_twitter'),
								'linkedin' => ot_get_option('acc_linkedin'),
								//'behance' => ot_get_option('acc_behance'),
								'dribbble' => ot_get_option('acc_dribbble'),
								'flickr' => ot_get_option('acc_flickr'),
								'google_plus' => ot_get_option('acc_google_plus'),
								'instagram' => ot_get_option('acc_instagram'),
								'tumblr' => ot_get_option('acc_tumblr'),
								'pinterest_sign' => ot_get_option('acc_pinterest_sign'),
								'github' => ot_get_option('acc_github'),
								'youtube' => ot_get_option('acc_youtube'),
							);
							echo show_social_icon($arr_social);
							?>
							<?php if(is_active_sidebar('search')):?>
								<div id="search">
									<?php echo get_dynamic_sidebar('search');?>
								</div>
							<?php endif;?>
                            <span style="height:35px;display:inline-block;vertical-align:middle; margin-left:-4px"></span>
                        </div>

                    </div>
                </div>
            </div>
            </div>
			<?php }?>
			<?php if(ot_get_option( 'nav_show', 1)){?>
            <div class="bg-container" id="nav-bottom">
                <div class="shadow"><!----></div>
                <div class="nav-bottom">                	
                    <div class="container">
                    	<div class="container-pad">
                            <div class="row-fluid">
                                <div class="span3"  >
										<?php if(ot_get_option('logo_image') == ''):?>
											<a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo get_template_directory_uri()?>/images/logo-1.png" /></a>
										<?php else:?>
											<a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo ot_get_option('logo_image'); ?>" alt="<?php wp_title( '|', true, 'right' ); ?>"/></a>
										<?php endif;?>
                                </div>
                                <div class="span9" style="margin-left:0px;width: 76.7%;">                            
                                    <div id="navigation-menu">
                                        <div class="current-menu"></div>                            
                                        <?php
                                            if(is_active_sidebar('navigation'))
                                                echo get_dynamic_sidebar('navigation');
                                            else
                                                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu','container_class'=>'menu-main-menu-container','walker'=> new custom_walker_nav_menu()));
                                        ?>                                                                           
                                    </div>
                                    <div id="navigation-menu-mobile" class="hide">
                                    	<?php
											wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu-mobile','container_class'=>'menu-main-menu-container','walker'=> new custom_walker_nav_menu_mobile(), 'items_wrap' => '<div class="divselect"><select onchange="if(this.value != \'\' && this.value != \'#\') location.href=this.value" id="%1$s" class="%2$s"><option value="#" style=" display:none"></option>%3$s</select><span class="spanselect"></span><i class="icon-reorder"></i></div>','fallback_cb'=>false));
											
                                        ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php }
			$sticky_show_menu=ot_get_option( 'sticky_show_menu');
			if($sticky_show_menu=='1'){ ?>
				<script>
				jQuery(document).ready(function(){
					if(jQuery(document).scrollTop()>35){
						jQuery('#navigation').addClass('pos_fixed_nav');
					}
				   jQuery(window).scroll(function(e){
					   if(jQuery(document).scrollTop()>35){
							jQuery('#navigation').addClass('pos_fixed_nav');
					   }else{
						   jQuery('#navigation').removeClass('pos_fixed_nav');
					   }
				   }); 
				});
				</script>
			<?php }?>
</div>