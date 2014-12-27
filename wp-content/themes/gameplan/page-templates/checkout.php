<?php 
/**
 * Template Name: checkout
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
         <!-- display contain -->
         
         <div class="chk" style="margin-top:89px;">
	<?php global $current_user;
	
      get_currentuserinfo();
	  
	  ?>
     
	<div id="ptitle">PERSONAL INFORAMTION</div>
	   
	   <div id="pdtails">
	   <?php echo '<div id="showdata"><span id="showdetails">FULL NAME:</span> <br>' . $current_user->user_login . "</div><br>";
	  echo '<div id="showdata"><span id="showdetails">TEL:</span> <br>' . $current_user->phone . "</div><br>";
      echo '<div id="showdata"><span id="showdetails">EMAIL:</span><br> ' . $current_user->user_email . "</div><br>";
      echo '<div id="showdata"><span id="showdetails">COUNTRY:</span><br>' . $current_user->country . "</div><br>";
 		
?>
         </div>
        </div> 
         
         
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
