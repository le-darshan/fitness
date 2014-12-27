 
<?php
/**
 * Template Name: View Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */


?>
<?php
get_header();?>

<div class="bg-container single-post-body <?php echo $woocommerce_class;?>"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
	<div class="container"> 
   <div class="container-pad" >
	<div class="row-fluid">	
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
                <?php  
				$users = get_users();
				
	   	
						 $udata = get_userdata( $current_user->ID  );
      
       					 $registered = $udata->user_registered;
						 
			 
				?>
              
	 <div class="span3 mainsidebar"></div>
	<div class="span9"><h6 style="text-align:center;height: 18px;"><span id="l_text">PROFILE </span><span style="text-align:right;float:right">
</Div>
	<div class="clear"></div>
  	<hr/>
 
     <?php
	 	//$ids_array= get_the_author_meta('ids',$current_user->ID);
	 	//$check = explode("$",$ids_array);
	  // if(in_array("photos",$check)) { ?>
	<div class="span3 mainsidebar" style="width:20%; border:red; border-color:#FF0000; border:medium; ">
	<?php echo get_avatar(  $current_user->ID ,150); ?>
	
	
		 
	</div>
	  
	  <?php 
	
	  $ids_array= get_the_author_meta('ids',$current_user->ID);
	  $check = explode("$",$ids_array);
	  $result=count($check);
	  $fname= get_the_author_meta( 'first_name', $current_user->ID );
	  $lname= get_the_author_meta( 'last_name', $current_user->ID );
	  
	  $name =  $fname.' '. $lname ;
	  
	  
	  ?>
		<div class="span9">
                <div class="span4">
				<h4></h4>
				         <p class="form-gende">
						 
						  
                        <label for="age" ><?php _e('First Name', 'profile'); ?> &nbsp; :
                        <span id="l_text"><?php  echo $name ; ?>
                    	 &nbsp; 
                        <?php  ?></label></span>
                   		 </p>
						 <?php $y = date('Y', strtotime(get_the_author_meta('birth_date', $current_user->ID )));
						 
						  	$current_date = date('Y');
						 	$age =   $current_date - $y ;
							    
						  ?>
									
						 
						 <p class="form-age">
						 <label for="age"> Age :<span id="l_text"> <?php echo $age; ?> </span> </label>
						 </p>
						 
						

						 
                   		
								<?php  
								$gender = get_the_author_meta('gender', $current_user->ID );
								    if(in_array($gender,$check))
										{ ?>
								 <p class="form-age" id="gender">
                        		<label for="gender"><?php _e('Gender', 'profile'); ?> &nbsp; :
	    			 			 	<?php echo $gender;
									 } ?>
      		 						</label>
								 </p>

						<p class="form-regdate"> 
					
						<label> Registration Date &nbsp;: <span id="l_text"> <?php echo date('d - m - Y', strtotime($registered)); ?></span></label>
						</p>
				</div>
				
				<div class="span4">
				<h4></h4>
						
						<?php $country = get_the_author_meta('country', $current_user->ID );
								    if(in_array($country,$check))
									{ 
									?>
									<p class="form-country">
                					<label for="country"><?php _e('Country', 'profile'); ?>&nbsp; :
	    			 			 	<?php echo $country;
									} ?>
      		 						</label>
                     				</p>   
						         
                   		
                         <?php $town = get_the_author_meta('town', $current_user->ID );
								    if(in_array($town,$check))
									{ ?>
								 <p class="form-town">
								<label for="town"><?php _e('Town', 'profile'); ?>&nbsp; :
								<span id="l_text"> <?php echo $town;?>
								 </label>
								 </p>
								<?php 	}
      		 						
	 ?>
						 
						 
                       	<?php $email = get_the_author_meta('email', $current_user->ID );
								    if(in_array($email,$check))
									{ ?> 
									<p class="form-email">	
                        <label for="email"><?php _e('E-mail *', 'profile');?>&nbsp;:
	    			 			 	<?php echo $email;
									}
      		 						 ?></label>
                   		 </p>
						 
                    
						<span id="l_text"><?php  $telephone = get_the_author_meta('telephone', $current_user->ID );
								    if(in_array($telephone,$check))
									{ ?><p class="form-url">
                        <label for="url">Tel &nbsp; :
	    			 			 	 <?php  echo $telephone ; 
									}
      		 						?> </label>
                    </p>
					</div>
<?php	$reg = date('Y-m-d', strtotime($registered));


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
								 
echo '<div id="le_trainingage" class="span4"><h4>TRANING AGE</h4><span id="value">'. $pieces[0] ."</span> <span></span>&nbsp;<span id='l_text'>Years</span><br/>";
		   		echo '<span id="value">'.$pieces[2].'</span><span id="l_text">&nbsp;Months</span><br/>';
				 echo '<span id="value">'.$pieces[4].'</span><span id="l_text">&nbsp;Days</span></div>';
				 ?>


	
	<div class="clear"></div>
	
	
	    <h6 style="text-align:center"><span id="l_text">MORE ABOUT ME</span></h6>
				<hr />
				<div class="span3">
					<p class="form-food">
                        <label for="food"><?php _e('Favorite Food', 'profile'); ?>&nbsp; :<br />
                        <span id="l_text"><?php  $food = get_the_author_meta('food ', $current_user->ID );
								    if(in_array($food ,$check))
									{ 
	    			 			 	echo $food ;
									}
      		 						else
	   								{
									echo " ";
	  								}
	 ?></span></label>
                    </p>
				</div>
				<div class="span3">
					<p class="form-exercise">
                        <label for="exercise"><?php _e('Favorite Exercise', 'profile'); ?>&nbsp; :<br>
                        <span id="l_text"><?php  $exercise = get_the_author_meta('exercise', $current_user->ID );
								    if(in_array($exercise ,$check))
									{ 
	    			 			 	echo $exercise ;
									}
      		 						else
	   								{
									echo " ";
	  								}
	 ?></span></label>
                    </p>
				</div>
				<div class="span3">
					<p class="form-Quote">
                        <label for="quote"><?php _e('Favorite Motivation Quote', 'profile'); ?>&nbsp; :<br />
                        <span id="l_text"><?php  $quote = get_the_author_meta('quote', $current_user->ID );
								    if(in_array($quote,$check))
									{ 
	    			 			 	echo $quote ;
									}
      		 						else
	   								{
									echo " ";
	  								}
	 ?></span></label>
                 </div>
   
	 	
	<div class="clear"></div>
	

	    <h6 style="text-align:center"><span id="l_text">PROGRESS</span></h6>
		<hr />
	
	
				

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