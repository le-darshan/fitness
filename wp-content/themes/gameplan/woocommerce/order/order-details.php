<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce   ;
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

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$order = new WC_Order( $order_id );
$user_id = $order->user_id;
 if ( sizeof( $order->get_items() ) > 0 ) {

			foreach( $order->get_items() as $item ) {
				$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$item_meta    = new WC_Order_Item_Meta( $item['item_meta'] );
}}
 $cat = get_the_terms( $item['product_id'], 'product_cat');

								$category =$cat[0]->name;
							 
 ?>

<div class="row-fluid" id="le_order">
  <div class="" >
  
    <?php //echo do_shortcode('[heading heading="'.__( 'Order Details', 'woocommerce' ).'" firstword="yes" dotted="yes" style="dot" firstword="no" ]');?>

	<div class="">
	<h2 class="title def_style " style="color:  !important"><span><span class="firstword" style="color:  !important">THANK YOU FOR PURCHASING </span></span></h2> <span class="print_icon" style="float:right;padding-top: 30px;" >       <a href="" onclick="printDiv('printableArea')"><i class="icon icon-print" ></i>Print</a></div>
	
    <table class="shop_table cart" cellspacing="0">
      <thead>
        <tr>
          <th class="product-name"><?php _e( 'Package/programs', 'woocommerce' ); ?></th>
          <th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
          <th class="product-quantity" style="text-align:center;"><?php _e( 'Duration/Months', 'woocommerce' ); ?></th>
          <th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php 
						   $subtotal =0;
						   $id= get_current_user_id( );
						     $order_id1=get_the_author_meta('order_id', $id );
                            $oid = explode(',', $order_id1);

		                     $result = count($oid);
			
						
		              			for($i=0; $i<$result; $i++)
		        					{ 
							             if($oid[$i] == $order_id)
										 {
										     $o_id =  $order_id;
										  }
									}
								global $wpdb;
						
					$type_month= $wpdb->get_col("SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id=".$o_id);

					$c =0;
					 	 foreach($type_month as $month)
					 	 	{

						$month1=$wpdb->get_col("SELECT meta_value as id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key='pa_select-duration' and order_item_id=".$month);                     foreach($month1 as $m)     
								{ 
								 
								echo'<tr><td>'; if ( $_product && ! $_product->is_visible() ){echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );}
							else{$cat = get_the_terms( $item['product_id'], 'product_cat');
								echo $cat[0]->name;echo " - ";echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
}
				if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

								$download_files = $order->get_item_downloads( $item );
								$i              = 0;
								$links          = array();
								
								foreach ( $download_files as $download_id => $file ) {
									$i++;

									$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
								}

								echo '<br/>' . implode( '<br/>', $links );
							}
								echo'</td>'; 
								
								echo '<td class="product-price">';
								 
								echo $order->get_formatted_line_subtotal( $item ); echo '</td>';
								echo '<td style="text-align:center">'; print_r($m);echo '</td>';
								$sub= $order->get_formatted_line_subtotal( $item );
								$sub1=floatval(preg_replace('/[^\d\.]/', '', $sub));
								$subtotal = $subtotal + $sub1;
								echo ' <td class="product-subtotal">'; echo $order->get_formatted_line_subtotal( $item ); echo '</td>';
        
								
								
								  }
				
					  }	
			 ?>
        <?php

				if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
					?>
        <tr class="product-purchase-note">
          <td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
        </tr>
        <?php
				}
	

		do_action( 'woocommerce_order_items_table', $order );
		?>
      </tbody>
    </table>
    <?php 
	     $taxes=15;
		 $total = ($subtotal+ $taxes );
	  ?>
    <div class="span6" id="main_cart_cart">
      <div id="c_title">CART TOTAL</div>
      <div id="subtotal"> <strong>
        <?php _e( 'Order Subtotal', 'woocommerce' ); ?>
        </strong>
        <div id="amount"><?php echo $subtotal; ?></div>
      </div>
      <div id="subtotal"> <strong>Taxes</strong> <span id="show_pric">£15</span> </div>
      <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
      <div id="total"> <strong>
        <?php _e( 'Order Total', 'woocommerce' ); ?>
        </strong> <span id="show_pric"><strong>£
        <?php   echo $total; // echo $woocommerce->cart->get_total(); ?>
        </strong></span> </div>
    </div>
    <?php if ( get_option('woocommerce_allow_customers_to_reorder') == 'yes' && $order->status=='completed' ) : ?>
    <p class="order-again"> <a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button">
      <?php _e( 'Order Again', 'woocommerce' ); ?>
      </a> </p>
    <?php endif; ?>
    <?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
  </div>
</div>
<!-- end row-fluid -->
<div class="clear"></div>
<?php  $id= get_current_user_id(); ?>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="height:300"> <span id="le_popuptitle_1">Training Progrma Setting</span>
  <div id="le_poupcontent" style="margin: 0 auto;  width:85%;text-align:justify">
    <?php $order = new WC_Order( $order_id );

?>
    <input name="oid" id="oid" type="hidden" value="<?php the_author_meta('order_id', $id );echo ','; echo $order->id; ?>"  />
    <br>
    <input name="date" id="date"type="hidden" value="<?php echo date('d - m - Y', strtotime($order->order_date)); ?>" />
    <br>
    <input name="total" id="total" type="hidden" value="<?php echo $order->order_total; ?>" />
    <input name="user" id="user"type="hidden" value="<?php echo $order->customer_user;  ?>" />
    <input name="u_id" id="u_id" type="hidden" value="<?php echo $order->user_id; ?>" />
    <div class="span11"> <span style="color:#810000;font-weight:bold">Congratulations.</span><br/>
      Your Training Program is now ready to be actived, in order to proceed You<strong> MUST </strong>select the number of days you plan to exercise pr week. <br />
    </div>
    <div class="clear"></div>
    <div class="day" style="margin-left:3%;margin-top:5%;"> <strong style="float: left;line-height: 25px;margin-right: 1%;">I Excercise</strong>
      <select name="prg_day" id="prg_day" style="width:auto;float:left;margin-right:3%;">
        <option value="2">2 DAYS</option>
        <option value="3">3 DAYS</option>
        <option value="6">6 DAYS</option>
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="float:left;line-height: 25px;">per week</strong><br />
    </div>
    <span id="le_popuptitle" style=" width:89%">
    <input type="submit" name="save" id="save" class="submit_button" value="ACTIVATE MY TRAINING PROGRAM" />
    </span> </div>
  <div class="clear"></div>
  <div class="span11" style="margin: 0 auto;float:none;width:85%;text-align:justify"><span style="color:#810000">Note:</span> The number of day cannot be altered to edited in th future</div>
</div>
<!-- /.modal -->
<!-- Popup Div Starts Here -->
<div id="abc" style="display:none">
  <div id="popupContact"> <span id="le_popuptitle_1">Custom Program From</span>
    <div class="le_custompop" style="margin: 0 auto;width: 80%;text-align: justify;float: none!important;margin-top: 7%;"> <span style="color:#810000;font-weight:bold;">Congratulations.</span><br/>
      Tour training program is almost ready, in order to proceed you <b>MUST</b> provide us with some additional data. Please clock the button below to fill up the form. <span id="le_popuptitle"> <a type="submit" name="save" id="custom_save" href="#">FILL UP CUSTOM TRAINING FROM</a> </span> </div>
    <div class="clear"></div>
  </div>
</div>
<?php  $data = $cat[0]->name; if($category == $data) {?>
<script type="text/javascript">
jQuery(document).ready(function($){ 
	$(".submit_button").click(function() {
		var days = $( "#prg_day" ).val();
		var oid = $("#oid").val();
		var uid = $("#uid").val();
		var date = $("#date").val();
		var total = $("#total").val();
		var user = $("#user").val();
		var dataString = 'oid1='+ oid +'&uid1='+uid +'&date1='+date +'&total1='+ total + '&user1='+ user+'&exercises_days='+ days;

		$.ajax({
			type: "POST",
			url: "http://cleaverfitness.com/wp-content/themes/gameplan/woocommerce/order/action.php",
			data: dataString,
			cache: true, 
			success: function(html){

			}
		});
		return false;alert(test);
	 });

		$("#le_custome_order").hide();
		$( '.modal' ).modal( 'toggle' );
		$(".submit_button").click(function(){
		$("#le_order").show();
		$(".modal").remove();
});
})
 
</script>
<?php  }else{?>
<script>
jQuery(document).ready(function($) {
$('#abc').show();
 
 
});
</script>
<?php }?>
<style>
.abc .popupContact .le_custompop{margin: 0 auto;width: 80%;text-align: justify;float: none!important;0}
#save_data{background: none repeat scroll 0 0 #810000;color: #fff;float: left;text-align: center;text-transform: capitalize;width: 89%;margin-top: 4%;padding: 1% 0;margin-bottom: 3%;font: menu;border: none;}
#custom_save{background: none repeat scroll 0 0 #810000;color: #fff;float: left;text-align: center;text-transform: capitalize;width: 100%;margin-top: 4%;padding: 1% 0;margin-bottom: 3%;font: menu;border: none;}
span#le_popuptitle_1{background: none repeat scroll 0 0 #810000;color: #fff;float: left;ext-align: center;text-transform: capitalize;width: 100%;padding: 1% 0;}
#abc {position: fixed;top: 20%;left: 50%;max-width:100%;width: 560px;margin-left: -280px;background-color: #ffffff;height:180px;border: 1px solid #999;border: 1px solid rgba(0, 0, 0, 0.3);-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;-webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);-moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);-webkit-background-clip: padding-box;-moz-background-clip: padding-box;background-clip: padding-box;outline: none;opacity: 1;}
img#close {position:absolute;right:-14px;top:-14px;cursor:pointer}
div#popupContact {position:absolute;}
</style>
<div id="printableArea" style="display:none;">
<br />
<div class="span12">
<span style=" text-align:center"><h4>RECIPT FOR PURCHASE PAYMENT</h4><br /><br /></span></div>
<div class="span12" style="margin-bottom: 80px;">
<div class="span6" style="width: 330px; float: left; height: 160px;padding-left:25px;"> 

<img style="height: 40px; width: 170px;" src="http://cleaverfitness.com/wp-content/uploads/2014/11/logo.png" ><br />
<div class="span3" style="text-align:left; margin-top:14px;padding-left: 15px;">
<span style="text-align:center">www.cleaverfitness.com</span>
<br />
<span style="text-align:center">info@cleaverfitness.com </span></div>

</div> 
<div class="span6" style="width: 250px; float:right;height: 115px;line-height:1.5;" >
<?php global $current_user;
   $ID =get_current_user_id( );
     get_currentuserinfo();
	 $name= get_the_author_meta( 'first_name', $current_user->ID );
     $country = get_the_author_meta('country', $ID );
	 $tel =get_the_author_meta( 'telephone', $current_user->ID );
	  echo 'Username: ' . $name . "<br>";
      echo 'COUNTRY: ' . $country . "<br>";
      echo 'EMAIL: ' . $current_user->user_email . "<br>";
      echo 'TEL: ' . $tel . "<br>";
      echo 'INVOICE DATE' . date('d - m - Y', strtotime($order->order_date)). "<br>";
      echo 'INVOIC NUMBER: ' . $order->id. "<br><br>";
	  
?>
<style>
@media print {
   thead{
            background-color: #000000  !important;
            -webkit-print-color-adjust: exact; 

        }
		th{
            color: #FFFFFF !important;
            -webkit-print-color-adjust: exact; 

        }
#total{background-color: #333333 !important;color: #FFFFFF ; 
	  -webkit-print-color-adjust: 
	  exact; 
	  }
	  .subtotal_value{color: #FFFFFF ; -webkit-print-color-adjust: exact; }
	  .subtotal{color: #FFFFFF ; -webkit-print-color-adjust: exact;}
}
</style>
</div>
</div>
<div class="span12" style="margin-top: 70px; margin-bottom: 40px;">

<table style="color: #b7b7b7!important;" cellspacing="0" >
   <thead>
    <tr  style="display: table-row;vertical-align: inherit;border-color: inherit; height: 50px; background-color:black; -webkit-print-color-adjust: exact; ">
    <th style="font-weight: bold;color: white; text-align:left;"><?php _e( 'Package/programs', 'woocommerce' ); ?></th>
          <th style="font-weight: bold;color: white; text-align:left;"><?php _e( 'Price', 'woocommerce' ); ?></th>
          <th style="font-weight: bold;color: white; text-align:center;"><?php _e( 'Duration/Months', 'woocommerce' ); ?></th>
         <th style="font-weight: bold;color: white; text-align:center;"><?php _e( 'Total', 'woocommerce' ); ?></th>
        </tr>
   </thead>
      <tbody>
        <?php 
						   $subtotal =0;
						   $id= get_current_user_id( );
						     $order_id1=get_the_author_meta('order_id', $id );
                            $oid = explode(',', $order_id1);

		                     $result = count($oid);
			
						
		              			for($i=0; $i<$result; $i++)
		        					{ 
							             if($oid[$i] == $order_id)
										 {
										     $o_id =  $order_id;
										  }
									}
								global $wpdb;
						
					$type_month= $wpdb->get_col("SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id=".$o_id);

					$c =0;
					 	 foreach($type_month as $month)
					 	 	{

						$month1=$wpdb->get_col("SELECT meta_value as id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key='pa_select-duration' and order_item_id=".$month);                     foreach($month1 as $m)     
								{ 
								 
								echo'<tr style="display: table-row;vertical-align: inherit;border-color: inherit;border-bottom:  solid 1px gray;"><td style="color:black;font-weight:700;text-transform: uppercase;height: 90px;">'; if ( $_product && ! $_product->is_visible() ){echo '<strong>';    echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item ); echo '<strong>'; }
							else{$cat = get_the_terms( $item['product_id'], 'product_cat');
							
						echo $cat[0]->name;echo " - ";echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item ); 

}
				if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

								$download_files = $order->get_item_downloads( $item );
								$i              = 0;
								$links          = array();
								
								foreach ( $download_files as $download_id => $file ) {
									$i++;

									$links[] = '<strong><a style="color:black;" href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></strong>';
								}
 
								echo '<br/>' . implode( '<br/>', $links );
							}
								echo'</td>'; 
								
								echo '<td style="color:balck;"><strong>';
								 
								echo $order->get_formatted_line_subtotal( $item ); echo '</strong></td>';
								echo '<td style="text-align:center"><strong>'; print_r($m);echo '</strong></td>';
								$sub= $order->get_formatted_line_subtotal( $item );
								$sub1=floatval(preg_replace('/[^\d\.]/', '', $sub));
								$subtotal = $subtotal + $sub1;
								echo ' <td style="color:balck;"><strong>'; echo $order->get_formatted_line_subtotal( $item ); echo '</strong></td></tr>';
        
								
								
								  }
				
					  }	
			 ?>
        <?php

				if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
					?>
        <tr class="product-purchase-note">
          <td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
        </tr>
        <?php
				}
	

		do_action( 'woocommerce_order_items_table', $order );
		?>
      </tbody>
    </table>
</div>


    <?php 
	     $taxes=15;
		 $total = ($subtotal+ $taxes );
	  ?>
  
    
	 <br /><br />
       <div class="span6" style="float:right; width:411px;height: 50px;padding: 10px;margin-bottom: 4px;
text-align: right;"> CART TOTAL </div>  
	 <div class="span6" style="float:right; width:411px; border-style: solid;border-width: 1px;height: 50px;padding: 10px;margin-bottom: 4px;">
            
         <span id="subtotal" style="flaot:left;">  <?php _e( 'Order Subtotal', 'woocommerce' ); ?></span>
		 <span id="subtotal_value" style="float: right;">£ <?php echo $subtotal; ?></span>
     </div>

	 <div class="span6" style="float:right; width:411px; border-style: solid;border-width: 1px;height: 50px;padding: 10px;margin-bottom: 4px;">
           
         <span id="subtotal" style="flaot:left; width:411px;"> Taxes</span>
		 <span id="subtotal_value" style="float: right;">£15</span>
     </div>

	<div id="total"class="span6" style="float:right; width:411px; border-style: solid;border-width: 1px;height: 50px;padding: 10px;margin-bottom: 70px; background-color:#666666; color:#FFFFFF;">
         <span id="subtotal" style="flaot:left; color:#FFFFFF;"><?php _e( 'Order Total', 'woocommerce' ); ?> </span>
		 <span id="subtotal_value" style="float: right;color:#FFFFFF;">£
		 <?php   echo $total; // echo $woocommerce->cart->get_total(); ?></span>
     </div> 



	<div class="span12" style="float:right; text-align:center;">
	<span id="thankyou"style=" text-align:center;"><h4>THANK YOU FOR YOUR PURCHASE </h4></span>
	</div>
    
  </div>
 <!-- "printableArea" -->
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}</script>
