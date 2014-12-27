 
<?php
/**
 * Template Name: Account Status
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */




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
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'submit' )
{

}
?>
<?php
get_header();?>


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
	  
	  		<h6 style="text-align:center; height: 14px;"><span id="l_text">ACCOUNT STATUS</span></h6>
	<hr />
<span>You have 2 option here : deactivate your account or delete it permently.Deactivating is essntially the same as deleting, except that all your data is retained , but not visible until your reactivate.</span>
<h6 style =" height: 14px;"><span id="l_text">I WOULD LIKE TO:</span></h6>	

<input type="radio" name="del" value="delete" /> Permanetly Delete My Account

<div class-"span3"  style="margin-top:60px">
<input type="submit" value="Change My Account Status" name="save" id="save" />
		
</div> </div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="height:400;margin-top:7%;"> <span id="le_popuptitle_1" style="height:10px"> </span>
  <div id="le_poupcontent" style="margin: 0 auto;  width:85%;text-align:justify">
<div class="span11"> <span style="color:#810000;font-weight:bold">Are you sure want to delete your account.          </span><br/>
      By deleting your account you will no longer be able to access it and will be delete permanetly. <br />
    </div>

    <div class="clear"></div>
    <span id="le_popuptitle" style=" width:60%; float:right;">
	<div id="b_a" style="width:245px">
    <div id="b_del" style="width: 145px;">
	<?php $id= get_current_user_id(); ?>
	 <input name="un_id" id="u_id" type="hidden" value="<?php echo $id; ?>" />
	<input type="submit" name="save" id="save" class="submit_button"value="DELETE MY ACCOUNT"></div>
	<div id="b_clear" style="width:50px; float:right;padding-top:4px;">
	<input type="submit" name="cansal" id="cansal" class="submit_button "value="cansal"></div>
    </span> </div></div>
  <div class="clear"></div>
  </div>
<script type="text/javascript">
jQuery(document).ready(function($){ 
	$(".submit_button").click(function() {
		
		var u_id = $("#u_id").val();

		//var user = $("#user").val();
		var dataString = '&u_id1='+u_id ;
		//+'&date1='+date +'&total1='+ total + '&user1='+ user +'&exercises_days='+ days;
		 
		$.ajax({
	       // alert('u_id');
			type: "POST",
			url: "http://cleaverfitness.com/wp-content/themes/gameplan/woocommerce/order/del_action.php",
			
			success: function(data){
			//alert(data);
			
			 window.location.href = ("http://cleaverfitness.com");
			}
			 
		});
		return false;
	 });
 });
//jQuery(document).ready(function($) {
//	$("#le_custome_order").hide();
//	$( '.modal' ).modal( 'toggle' );
//	$("#save").click(function(){
//	$("#le_order").show();
//	$(".modal").remove();
//});



</script>


<script type="text/javascript">

jQuery(document).ready(function($) {

	$("#save").click(function(){
	
	$( '.modal' ).modal( 'toggle' );
	
});

})



jQuery(document).ready(function($) {

	$("#cansal").click(function(){
	
	$(".modal").remove();
	
});

})

</script>


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