<?php
/**
 * Template Name: My Program
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */

function Difference($startDate, $endDate) 
        { 
  
            $startDate = strtotime($startDate); 
            $endDate = strtotime($endDate); 
            if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate) 
                return false; 
                
            $years = date('Y', $endDate) - date('Y', $startDate); 
            
            $endMonth = date('m', $endDate); 
            $startMonth = date('m', $startDate); 
            
            // Calculate months 
            $months = $endMonth - $startMonth; 
            if ($months <= 0)  { 
                $months += 12; 
                $years--; 
            } 
            if ($years < 0) 
                return false; 
            
            // Calculate the days 
                        $offsets = array(); 
                        if ($years > 0) 
                            $offsets[] = $years . (($years == 1) ? ' year' : ' years'); 
                        if ($months > 0) 
                            $offsets[] = $months . (($months == 1) ? ' month' : ' months'); 
                        $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now'; 

                        $days = $endDate - strtotime($offsets, $startDate); 
                        $days = date('d', $days);    
                        
            return array($years, $months, $days); 
        }


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

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
if (!empty($_POST['PRODUCT1'])) {
    $result = test_input($_POST['req_code']);
    if(!is_numeric($result)) $result  = "Only numbers accepted."; 
    else $result = "Your PRODUCT1 activation code: " . $_POST['req_code']*1;
} 

if (!empty($_POST['PRODUCT2'])) {
    $result = test_input($_POST['req_code']);
    if(!is_numeric($result)) $result  = "Only numbers accepted."; 
    else $result = "Your PRODUCT2 activation code: " . $_POST['req_code']*2;
}
?>
<style>


#list{padding-left:20px;	line-height : 2;
}
#heading{ height:20px}
hr{
background-color:#810000; height: 3px; border:#810000;
}
#option-list{background-color: #151414;
height: 275px;
width: 236px;
}
span#space{ margin-bottom:2px}
span#l_text{ color:#FFFFFF}
#line hr {height: 1px; border:#666666;background-color:#666666; }
#le_trainingage{text-align:center;line-height:35px; }
#le_trainingage h4{color:#FFFF00;font-weight:normal}
#le_trainingage span#value {color:#FFFF00; font-size:20px;}
#le_trainingage span#l_text{ color:#FFFFFF;font-size:15px;}
i.test{color:#FFFF00}
.navigation{background-color: #1F1F1F;}	
.navigation ul li { line-height:1;line-height: 2;}
.navigation ul { margin-left: 30px;}
tr{height: 50px; color:#FFFFFF}
td{ text-align:center}
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

<h6 style="text-align:center; height: 14px;"><span id="l_text">MY PROGRAM</span></h6>
	<hr />
<div class="span3" style="width:35%"><span><strong>Type&nbsp;&nbsp;</strong> </span><select name="type"> 
<option value="all">All</option>
<option value="training-program">Training Program</option>
<option value="dait-plan">Dait Plan</option>
</select></div>
<div class="span3" style="width:35%"><span><strong>Type&nbsp;&nbsp;</strong> </span><select name="type"> 
<option value="all">All</option>
<option value="active">Active</option>
<option value="expire">Expire</option>
</select></div>	

<div class="clear"></div>
<table class="shop_table cart" cellspacing="0">
      <thead style="background-color: #1F1F1F;">
        <tr>
          <th>TYPE </th>
          <th>NAME</th>
          <th>PURACSED DATE</th>
          <th>STATISTICS</th>
		  <th>STATUS</th>
		  <th>VIEW</th>
        </tr>
      </thead>
	  <tbody>
	  
 	 
	  <?php 
	global $wpdb;
	$id= $current_user->ID;
	//echo $id;
	//$order = new WC_Order( $order_id);
	//echo'<pre>'; print_r($order)
	
global $wpdb ;


//$rows = $wpdb->get_col( "select user_id from wp_usermeta where user_id=".$id);
  	
	
		  $order_id=get_the_author_meta('order_id', $id );
          
		  
		  $oid = explode(',', $order_id);
		  
		  // echo '<pre>';print_r($oid);
		   $result = count($oid);
			 
						
		   for($i=0; $i<$result; $i++)
		   	{ 
			 $product_name=$wpdb->get_col("SELECT order_item_name as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id=".$oid[$i]);
		        //print_r($product_name);
			 foreach($product_name as $name)
				{  
				      
				     echo'<td>';
					 echo'Training Program<br>';
                     $type_name= $wpdb->get_col("SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id=".$oid[$i]);
			         //echo'<pre>'; print_r($type_name);
					  foreach($type_name as $name1)
					  {
					  //  echo $name;
						$na=$wpdb->get_col("SELECT meta_value as id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key='Select Plan Type' and order_item_id=".$name1);
							foreach($na as $n)
							{
								echo $n; echo '<br>';
							}
					   }
		  			 echo '</td>'; 
					 echo'<td>';
					// echo $oid[$i];
				 	 print_r($name);
				 	 echo '</td>';
				     echo'<td>';
					
			         $order_date = $wpdb->get_results("select post_date from 2Jnxj_posts where ID=".$oid[$i]);                      
					 foreach($order_date as $date)
					 {	
					 	 
						
						//print_r($date);
					
						$da = date('d - m - Y', strtotime($date->post_date));
						echo $da;
					 }
					  
					 echo '</td>';
					
					 echo'	<td><a href="#" style="color:#b7b7b7"><i  class="icon-adjust"></i></a></td>';
					 echo'	<td>';
					 $type_month= $wpdb->get_col("SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id=".$oid[$i]);
			         //echo'<pre>'; print_r($type_month);
					  foreach($type_month as $month)
					  {
					  //  echo $month;
						$month1=$wpdb->get_col("SELECT meta_value as id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key='pa_select-duration' and order_item_id=".$month);                     foreach($month1 as $m)     
							{   
								
								$da1=str_replace(' ', '',$da);
								
								$reg_month=date('m',strtotime($da1));echo'<br>';
							    $curent=date('Y-m-d');
								//$curent=date('Y-m-d',strtotime("+30 days"));
								if($m == '12-months')
								{ 
								 $total_day= 365;
								$trainig_total_day = date('d-m-Y',strtotime("+365 days"));
   								$trainig_total_day = date('Y-m-d',strtotime($trainig_total_day));
						
								}
								
								if($m == '6-months')
								{
								 $total_day= 180;
								 $trainig_total_day=date('d-m-Y',strtotime("+180 days"));
							     $trainig_total_day = date('Y-m-d',strtotime($trainig_total_day));
								}
								if($m == '3-months')
								{
								$total_day= 90;
							    $trainig_total_day=date('d-m-Y',strtotime("+90 days"));
								$trainig_total_day = date('Y-m-d',strtotime($trainig_total_day));
								}
								if($m == '1-months')
								{
								 $total_day= 30;
								 $trainig_total_day=date('d-m-Y',strtotime("+30 days"));
								 $trainig_total_day = date('Y-m-d',strtotime($trainig_total_day));
						
								}
							
							   
							    $datetime1 = new DateTime($da1);
							    $datetime2 = new DateTime($curent);
								$interval = $datetime1->diff($datetime2);
								$trainig_prog_done_day=$interval->format('%a days');//finding the total program day done.                       
								//echo $curent ;echo '<br>';  
							    //echo $da1 ;echo '<br>';	
								//echo $trainig_prog_done_day ;echo '<br>';
								//echo $total_day;echo '<br>';
								$leftday= ($total_day -$trainig_prog_done_day);
								$exp =$leftday;
								
								if($trainig_prog_done_day>= $total_day)
								{
								echo 'EXPIRD';
							    }
								if($trainig_prog_done_day < $total_day)
								{
								echo $leftday; echo' &nbsp; days left';
								}  
					  		}
					  } 
					  

				     echo'  </td>';
				 	 echo'	<td><a href="http://cleaverfitness.com/program/" style="color:#b7b7b7"><i class="icon-search"></i></a></td>';
					 echo '</tr>';
	 			 }
		
		          }//for loop close for name
				  
	
 		
		
	  ?>

  	 
	  <tbody>
	  
	  </tbody>
	  
	  </table>
	
		
		
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