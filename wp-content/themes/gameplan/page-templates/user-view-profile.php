 
<?php
/**
 * Template Name: User View Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */

global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' )
{

    
}
?>
<?php
get_header();?>


<div class="bg-container single-post-body <?php echo $woocommerce_class;?>"> 
	
	
	 <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
	<div class="container"> 
   	<div class="container-pad" >
	<div class="row-fluid revert-layout">	

	
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
         
<div class="span9">
		<h6 style="text-align:center;"><span id="l_text">PROFILE </span>
		<span style="text-align:right;float:right"><a href="<?php get_site_url();?>/profile">
		<a href="<?php get_site_url();?>/club/profile"><i class="icon icon-pencil test"></i>&nbsp;Edit Profile</span> </h6></a>
		<hr/>
		
		 <div class="span3 mainsidebar" style="width:20%; border:red; border-color:#FF0000; border:medium; ">
			<?php echo get_avatar(  $current_user->ID ,150); ?>
				</div>   
		         
		         
                <div class="span3">
				
				         <p class="form-gende">
                        <label for="first-name"><?php _e('First Name', 'profile'); ?> &nbsp; :
                        <span id="l_text"><?php the_author_meta( 'first_name', $current_user->ID ); ?>
                    	 &nbsp; 
                        <?php the_author_meta( 'last_name', $current_user->ID ); ?></label></span>
                   		 </p>
						 <?php $y = date('Y', strtotime(get_the_author_meta('birth_date', $current_user->ID )));
						 
						  	$current_date = date('Y');
						 	$age =   $current_date - $y ;
							    
						  ?>

						 <p class="form-age">
						 <label for="age"> Age :<span id="l_text"> <?php echo $age; ?> </span> </label>
						 </p>

                   		 <p class="form-age">
                        <label for="gender"><?php _e('Gender', 'profile'); ?> &nbsp; :
						<span id="l_text"><?php the_author_meta( 'gender', $current_user->ID );  ?> </span></label>
                    	</p>
						<p class="form-regdate"> 
					
						<label> Registration Date &nbsp;:<br /> <span id="l_text"> <?php echo date('d - m - Y', strtotime($registered)); ?></span></label>
						</p>
				</div>
				
				<div class="span3">
				
						<p class="form-country">
                		<label for="country"><?php _e('Country', 'profile'); ?>&nbsp; :
						 <span id="l_text"><?php the_author_meta( 'country', $current_user->ID );  ?><span id="l_text"></span></label>
                     	</p>   
						         
                   		<p class="form-town">
                        <label for="town"><?php _e('Town', 'profile'); ?>&nbsp; :
                         <span id="l_text"><?php the_author_meta( 'town', $current_user->ID );  ?><span id="l_text"></span></label>
                         </p>
						 
						 <p class="form-email">	
                        <label for="email"><?php _e('E-mail *', 'profile');?>&nbsp;:
                       	<span id="l_text"><?php the_author_meta( 'user_email', $current_user->ID ); ?><span id="l_text"></span></label>
                   		 </p>
						 
                    <p class="form-url">
                        <label for="url">Tel &nbsp; :
						<span id="l_text"><?php  the_author_meta( 'telephone', $current_user->ID ); ?> </span></label>
                    </p>
					</div> <!-- span 3 clsoe -->
    <?php  
$reg = date('Y-m-d', strtotime($registered));


 function dateDiff($start,$end=false)
{
   $return = array();
   
   try {
      $start = new DateTime($start);
      $end = new DateTime($reg);
      $form = $start->diff($end);
   } catch (Exception $e){
      return $e->getMessage();
   }
   
   $display = array('y'=>'year',
               'm'=>'month',
               'd'=>'day',
               'h'=>'hour',
               'i'=>'minute',
               's'=>'second');
   foreach($display as $key => $value){
      //if($form->$key > 0){
         $return[] = $form->$key.' '.($form->$key > 0 ? $value.'s' : $value);
     // }
   }
  
   return implode($return, ', ');
}
dateDiff($reg);
$r = dateDiff($reg);
//print_r($r);
$pieces = explode(" ",$r);
//print_r($pieces);

 echo '<div id="le_trainingage" class="span3"><h4>TRANING AGE</h4><span id="value">'. $pieces[0] ."</span> <span></span>&nbsp;<span id='l_text'>Years</span><br/>";
		   		echo '<span id="value">'.$pieces[2].'</span><span id="l_text">&nbsp;Months</span><br/>';
				 echo '<span id="value">'.$pieces[4].'</span><span id="l_text">&nbsp;Days</span></div>';
				 ?>


				 
		 <div class="span9" style="float:right" id="line">	
     		<hr />	          
		</div>
		<div class="clear"></div>
		
		<div class="span9" style="float:right">	
		   <div class="span5">
					<p class="form-food">
                        <label for="food"><?php _e('Favorite Food', 'profile'); ?>&nbsp; :<br />
                        <span id="l_text"><?php the_author_meta( 'food', $current_user->ID ); ?></span></label>
                    </p>
			</div>
			<div class="span5">
					<p class="form-exercise">
                        <label for="exercise"><?php _e('Favorite Exercise', 'profile'); ?>&nbsp; :<br>
                        <span id="l_text"><?php the_author_meta( 'exercise', $current_user->ID ); ?></span></label>
                    </p>
			</div>
		</div>
		<div class="span9" style="float:right" >
			<p class="form-Quote">
                        <label for="quote"><?php _e('Favorite Motivation Quote', 'profile'); ?>&nbsp; :<br />
                        <span id="l_text"><?php the_author_meta( 'quote', $current_user->ID ); ?></span></label>
              </p>
		</div>	
		
</div>  <!-- main span 9 close --> 

<div class="span9" style="float:right">
		<h6 style="text-align:center;"><span id="l_text">MY PROGRSS </span>
		<span style="text-align:right;float:right"></span> </h6>
		<hr/>

           
                 
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