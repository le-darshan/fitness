 
<?php
/**
 * Template Name: Privacy Setting
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */

if(isset($_POST['submit'])) 
{ 
  $permision = implode("$",$_POST["ids"]);
	if ( !empty( $_POST['ids'] ) )
        update_user_meta( $current_user->ID, 'ids', esc_attr( $permision ) ); 
		//echo $permision;
}


$in_woocommerce_page = 0;

if(function_exists('is_woocommerce_page') && is_woocommerce_page()){
	$in_woocommerce_page = 1;
}

$woocommerce_class = '';
if(function_exists('is_woocommerce_thanks_page')){
$woocommerce_class = is_woocommerce_thanks_page() ? "woo-page thanks":(is_woocommerce_myaccount_page() ? "woo-page myaccount":(is_woocommerce_editaddress_page() ? "woo-page editaddress":(is_woocommerce_changepassword_page() ? "woo-page changepassword":(is_woocommerce_lostpassword_page() ? "woo-page lostpassword":(is_woocommerce_vieworder_page() ? "woo-page vieworder":(is_woocommerce_logout_page() ? "woo-page logout":""))))));
}

global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'submit' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) ) 
	  
        update_user_meta( $current_user->ID, 'user_url', esc_url( $_POST['url'] ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
	if ( !empty( $_POST['gender'] ) )
        update_user_meta($current_user->ID, 'gender', esc_attr( $_POST['gender'] ) );
	if ( !empty( $_POST['country'] ) )
        update_user_meta($current_user->ID, 'country', esc_attr( $_POST['country'] ) );
	if ( !empty( $_POST['town'] ) )
        update_user_meta($current_user->ID, 'town', esc_attr( $_POST['town'] ) );
	
	if ( !empty( $_POST['user_url'] ) )
        update_user_meta($current_user->ID, 'user_url', esc_attr( $_POST['user_url'] ) );
    if ( !empty( $_POST['food'] ) )
        update_user_meta($current_user->ID, 'food', esc_attr( $_POST['food'] ) );
	if ( !empty( $_POST['exercise'] ) )
        update_user_meta($current_user->ID, 'exercise', esc_attr( $_POST['exercise'] ) );
	if ( !empty( $_POST['quote'] ) )
        update_user_meta($current_user->ID, 'quote', esc_attr( $_POST['quote'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
    if ( !empty( $_POST['birth_date'] ) )
        update_user_meta( $current_user->ID, 'birth_date', esc_attr( $_POST['birth_date'] ) );
	if ( !empty( $_POST['telephone'] ) )
        update_user_meta( $current_user->ID, 'telephone', esc_attr( $_POST['telephone'] ) );
	
		 
		/* $id= $current_user->ID; 
		 $upload_dir = wp_upload_dir();
		 move_uploaded_file($_FILES['training_image']['tmp_name'],$upload_dir['path'].'/uploads/'. $id .'.jpg');
         $p = $upload_dir['path'].'/uploads/'. $id.'.jpg';
		 //echo $p; exit;
		if ( !empty( $_POST['trining_imags'] ) )
         update_user_meta( $current_user->ID, 'simple_local_avatar', esc_attr( $p ) );*/


    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        
        exit;
    }
}
?>
<?php
get_header();?>
<style>



</style>

<?php
 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>">
	    
        <div class="entry-content entry">
            <?php the_content(); ?>
            <?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p>
            	<?php else : ?>
                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; 
						$users = get_users();
				
	   	
						 $udata = get_userdata( $current_user->ID  );
						 $registered = $udata->user_registered;
						 
?>


<div class="bg-container single-post-body <?php echo $woocommerce_class;?>"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
	<div class="container"> 
   	<div class="container-pad" >
	<div class="row-fluid revert-layout">	



<div class="span9">

<h6 style="text-align:center; height: 18px;"><span id="l_text">PRIVACY SETTINGS </span></h6>
	<hr />
<span>Grant acces to what visitors can view on your profile and allow your data to be visbible or not on the leader dashboard.Visitors will only able to see th field marked with(<i class="fa fa-check test"></i>).</span>
<div class="clear"></div>
	
		
		
		<?php
		
		 $ids_array= get_the_author_meta('ids',$current_user->ID);
	 	 $check = explode("$",$ids_array); 
		 $country = get_the_author_meta('country', $current_user->ID );
		 $gender = get_the_author_meta('gender', $current_user->ID );
		 $town = get_the_author_meta('town', $current_user->ID );
		 $email = get_the_author_meta('email', $current_user->ID );
		 $telephone = get_the_author_meta('telephone', $current_user->ID );
		 $food = get_the_author_meta('food ', $current_user->ID );
		 $exercise = get_the_author_meta('exercise', $current_user->ID );
		 $quote = get_the_author_meta('quote', $current_user->ID );
		 ?>
		<div class="span3" id="option-list">
		
		<h6 class="firstword module-title title def_style" style="color:  !important">PERSONAL INFO
		</h6>
		<div id="list">
		<span id="l_text">Show my:</span> <br />
		<form method="post" action=" <?php echo get_site_url().'/privacy-setting'; ?>" >
	
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'gender', $current_user->ID ); ?>" <?php if(in_array($gender,$check)){?> checked="checked" <?php }?> />&nbsp; Gender<br />
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'country', $current_user->ID ); ?>"  <?php if(in_array($country,$check)){?> checked="checked" <?php }?>/>&nbsp; Country<br />
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'town', $current_user->ID ); ?>"    <?php if(in_array($town,$check)){?> checked="checked" <?php }?>/>&nbsp; Town</label><br />
		<!--<input type="checkbox" name="ids[]" value="photos" />&nbsp; Photos<br />-->
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'email', $current_user->ID ); ?>"    <?php if(in_array($email,$check)){?> checked="checked" <?php }?> />&nbsp; email<br />
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'telephone', $current_user->ID ); ?>"  <?php if(in_array($telephone,$check)){?> checked="checked" <?php }?>/>&nbsp; Telephone Number<br />
		</div>
	</div>
	

	<div class="span3" id="option-list">
		
		<h6 class="firstword module-title title def_style" style="color:  !important">TRANING  INFO
		</h6>
		<div id="list">
		<span id="l_text">Show my:</span> <br />
		
		<input type="checkbox" name="ids[]" value="progress" />&nbsp; Personal Progress<br />
		<input type="checkbox" name="ids[]" value="ranking"/>&nbsp; Ranking<br />
		<input type="checkbox" name="ids[]" value="rankin"/>&nbsp; Rank inTop Pefomers</br>
		</div>
		      
	</div>
	
	<div class="span3" id="option-list">
		
		<h6 class="firstword module-title title def_style" style="color:  !important">ABOUT ME
		</h6>
		<div id="list">
		<span id="l_text">Show my:</span> <br />
		 
		
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'food', $current_user->ID ); ?>" <?php if(in_array($food,$check)){?> checked="checked" <?php }?>"/> &nbsp;Favorite Food<br />
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'exercise', $current_user->ID ); ?>" <?php if(in_array($exercise,$check)){?> checked="checked" <?php }?>"/>&nbsp;Favorite Exercise<br />
		<input type="checkbox" name="ids[]" value="<?php the_author_meta( 'quote', $current_user->ID ); ?>"<?php if(in_array($quote,$check)){?> checked="checked" <?php }?>"/>&nbsp; Favorite Motivaion Quote<br />

		</div>
	</div> <!-- span 3 close -->
	<div class="clear"></div>
	 <div class="span3">
			<input type="submit" name="submit" value="Save Changes">
			</form>
	</div>

		
	
</div>  <!-- main span 9 close --> 
      
 <div id="mainsidebar " class="span3" >
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
                 
            <?php endif; ?>
        </div><!-- .entry-content -->
		
    </div><!-- .hentry .post -->
    <?php endwhile; ?>
<?php else: ?>

    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p>
<?php endif; ?>


</div></div></div></div>
<div class="bg-container">




<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>