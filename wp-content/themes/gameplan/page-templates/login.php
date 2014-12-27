<?php 
/**
*  Template Name: login
*/
get_header();
 
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
      <div class="row-fluid">
	    <h3 class="le_loginpage">Account Log In</h3>
            <hr />
        <div class="le_login" style="width:33.33%;margin:0 auto;">
          <form id="login" class="ajax-auth" action="login" method="post">
          
            <p class="status"></p>
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
			 <div class="form-group1">
            <label for="username">Username</label>
            <input id="username" type="text" class="required" name="username">
			</div>
			 <div class="form-group1">
            <label for="password">Password</label>
            <input id="password" type="password" class="required" name="password">
			</div>
			 <div class="le_links">
            <a class="text-link" href="<?php echo wp_lostpassword_url(); ?>">Forgot your password?</a><div class="clear"></div>
			<a class="text-link" href="<?php echo wp_lostpassword_url(); ?>/register">Not registered yet? Create an account now</a>
</div>
            <input class="submit_button" type="submit" value="LOGIN">
          </form>
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
