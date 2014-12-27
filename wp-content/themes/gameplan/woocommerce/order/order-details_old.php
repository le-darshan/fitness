<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$order = new WC_Order( $order_id );
?>
<div class="row-fluid">
<div class="">
 	

<?php //echo do_shortcode('[heading heading="'.__( 'Order Details', 'woocommerce' ).'" firstword="yes" dotted="yes" style="dot" firstword="no" ]');?>

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
		if ( sizeof( $order->get_items() ) > 0 ) {

			foreach( $order->get_items() as $item ) {
				$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$item_meta    = new WC_Order_Item_Meta( $item['item_meta'] );

				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
					<td class="product-name">
						<?php
							if ( $_product && ! $_product->is_visible() ){
								echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
								}
							else{$cat = get_the_terms( $item['product_id'], 'product_cat');echo '<strong>'.$cat[0]->name;echo " - ";
								//echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
								echo $item['name'].'</strong><br>';
								echo '<span style="color:#810000">'.$item['Select Type'].'</span>';
								
								#echo "<pre>";print_r($item);
							//echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );
							}

							//$item_meta->display();

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
						?>
					</td>
					<td class="product-price">
						<?php echo $order->get_formatted_line_subtotal( $item ); ?>
					</td>
					<td class="product-quantity" style="text-align:center"><?php echo substr($item['pa_select-duration'], 0 , -7);?></td>
					<td class="product-subtotal"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
				</tr>
				<?php

				if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
					?>
					<tr class="product-purchase-note">
						<td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
	</table>
	<div class="clear"></div>
	<div class="span6" id="main_cart_cart">
	<div id="c_title">CART TOTAL</div>
	<?php
		if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
			?><div id="subtotal">
             <strong><?php echo $total['label']; ?></strong>
			 <div id="amount"><span class="amount"><?php echo $total['value']; ?></span></div>
             </div>
		 
			<?php
		endforeach;
	?>
</div>




<?php if ( get_option('woocommerce_allow_customers_to_reorder') == 'yes' && $order->status=='completed' ) : ?>
	<p class="order-again">
		<a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button"><?php _e( 'Order Again', 'woocommerce' ); ?></a>
	</p>
<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</div>
<div class="span6" >
<?php //echo do_shortcode('[heading heading="'.__( 'Customer details', 'woocommerce' ).'" firstword="yes" dotted="yes" style="dot" firstword="no" ]');?>
<dl class="customer_details" style="display:none">
<?php
	if ($order->billing_email) echo '<dt>'.__( 'Email:', 'woocommerce' ).'</dt><dd>'.$order->billing_email.'</dd>';
	if ($order->billing_phone) echo '<dt>'.__( 'Telephone:', 'woocommerce' ).'</dt><dd>'.$order->billing_phone.'</dd>';
?>
</dl>

<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

<div class="col2-set addresses">

	<div class="col-1">

<?php endif; ?>

		<header class="title" style="display:none">
			<h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
		</header>
		<address style="display:none"><p>
			<?php
				if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
			?>
		</p></address>

<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

	</div><!-- /.col-1 -->

	<div class="col-2" style="display:none">

		<header class="title">
			<h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
		</header>
		<address><p>
			<?php
				if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
			?>
		</p></address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>
</div><!-- end span6 -->
</div><!-- end row-fluid -->
<div class="clear"></div>
<?php echo $id= get_current_user_id(); ?>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="height:300"> <span id="le_popuptitle_1">Training Progrma Setting</span>
  <div id="le_poupcontent" style="margin: 0 auto;  width:85%;text-align:justify">
    <?php $order = new WC_Order( $order_id );
//echo'<pre>'; print_r($order); 
?>
    <input name="oid" id="oid" type="hidden" value="<?php the_author_meta('order_id', $id );echo ','; echo $order->id; ?>"  />
    <br>
    <input name="date" id="date"type="hidden" value="<?php the_author_meta('order_date', $id );echo ','; echo date('d - m - Y', strtotime($order->order_date)); ?>" />
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
        <option value="2-day"="2-day">2 DAYS</option>
        <option value="3-day">3 DAYS</option>
        <option value="6-day">6 DAYS</option>
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="float:left;line-height: 25px;">per week</strong><br />
    </div>
    <div class="clear"></div>
    <span id="le_popuptitle" style=" width:89%">
    <input type="submit" name="save" id="save" class="submit_button "value="ACTIVATE MY TRAINING PROGRAM">
    </span> </div>
  <div class="clear"></div>
  <div class="span11" style="margin: 0 auto;float:none;width:85%;text-align:justify"><span style="color:#810000">Note:</span> The number of day cannot be altered to edited in th future</div>
</div>
<!-- /.modal -->
<script type="text/javascript">
jQuery(document).ready(function($){ 
	$(".submit_button").click(function() {alert('here');
		var test = $( "#prg_day" ).val();
		var oid = $("#oid").val();
		var uid = $("#uid").val();
		var date = $("#date").val();
		var total = $("#total").val();
		var user = $("#user").val();
		var dataString = 'oid1='+ oid +'&uid1='+uid +'&date1='+date +'&total1='+ total + '&user1='+ user  ;

		$.ajax({
			type: "POST", 
			url: "http://cleaverfitness.com/wp-content/themes/gameplan/woocommerce/order/action.php",
			data: dataString,
			cache: true,
			success: function(html){ alert('test');
			// window.location.href = ('http://cleaverfitness.com/post/'+test);
			}
			//$("#show").after(html);
			//document.getElementById('content').value='';
			//$("#flash").hide();
			//$("#content").focus();
		});
		return false;
	 });
 });
jQuery(document).ready(function($) {
	$("#le_custome_order").hide();
	$( '.modal' ).modal( 'toggle' );
	//$("#hide").click(function(){
	//  $("#le_order").hide();
	//  $("#le_custome_order").hide();
	//});
	
	//$("#le_popuptitle").click(function(){
	//  $("#le_custome").show();
	//  $("#le_custome_order").hide();
	//});

	$("#save").click(function(){
	//$("#le_custome").hide();
	$("#le_order").show();
	//  $('.model' ).modal('hide');
	//$('#modal').modal('hide');	
	$(".modal").remove();
});


})
 
</script>
