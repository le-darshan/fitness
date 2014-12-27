<?php 
include($_SERVER['DOCUMENT_ROOT']."/wp-load.php");
global $wpdb;
$sel_value = $_REQUEST['sel_value'];


for($i=0; $i<$sel_value; $i++){
?>

<?php
global $post;

$qry_args = array (
	'post_type'              => 'exercises',
	'meta_query'             => array(
		array(
			'key'       => 'exe_cat',
			'value'     => 'build-muscels',
		),
	),
	);
	
	$all_posts = new WP_Query( $qry_args );
 
		$data = $all_posts->posts;
		
		 //echo "Total matching posts: $all_posts->found_posts<br/>";
		 $id_vals='';
		 ?>
		 <div id="le_test" class="le_prgtable" style="clear:both">
	
		<h3 class="hndle" style="text-align: center;width: 100%;"> Days <?php echo $i+1; ?></h3>
		 <br/>
		 <Span style="color:#000;font-weight:700">Build Muscels</Span>
		 <div class="clear:both"></div>
		 <ul style="float:left;width: 20%;">
	  	<?php 
		
				
			 global $post;
			   $custom = get_post_custom($post->ID);
			   #echo "<pre>";print_r($custom);
				$arr=array();
		 foreach( $data as  $title){
		 #echo $title->post_title;
		 	 #echo "<pre>";print_r($data);exit;
			  
			$id_vals.=$title->ID.',';
	 		$post_meta=get_post_meta($title->ID);
			$extra='';
		
			if($custom['set_'.$title->ID][0]!='' || $custom['reps_'.$title->ID][0]!='' ||$custom['rest_'.$title->ID][0]!='')
			{	
				$arr[]=$title->ID;
				$extra='checked=checked';
			}
		?>		
		
		 <li style="width: auto;float: left;clear: both;">
		<input type="checkbox" name="duration[]" value="<?php echo $title->post_title; ?>" <?php echo $extra; ?> disp_val="<?php echo $i; ?>_<?php echo $title->ID; ?>"/><label><?php echo $title->post_title;?></label></li><?php } ?>
	
		 </ul>
		 <table id="data_table_<?php echo $i;?>">
		 <?php  foreach( $arr as  $id){
		 	
		 ?>
		 		<tr id="tr_<?php echo $i; ?>_<?php echo $id;?>" class="red" ><th>set</th><td><input type="number" name="set_<?php echo $i; ?>_<?php echo $id;?>" value="<?php echo $custom['set_'.$id][0];?>" /></td><th>Reps</th><td><input type="number" name="reps_<?php echo $i; ?>_<?php echo $id;?>" value="<?php echo $custom['reps_'.$id][0];?>" required /></td><th>Rest</th><td><input type="number" name="rest_<?php echo $i; ?>_<?php echo $id;?>" value="<?php echo $custom['rest_'.$id][0];?>" required /></td></tr>
		<?php }?>
		 </table>
		</div><?php
		


$qry_args = array (
	'post_type'              => 'exercises',
	'meta_query'             => array(
		array(
			'key'       => 'exe_cat',
			'value'     => 'lose-weight',
		),
	),
);
	
	$all_posts = new WP_Query( $qry_args );
 
		$data = $all_posts->posts;
		
		// echo "Total matching posts: $all_posts->found_posts<br/>";
		 $id_vals='';
		 ?>
		 <div id="le_test" class="le_prgtable"  style="clear:both;">
		  <Span style="color:#000;font-weight:700">Lose Weight</Span>
		  <div class="clear:both"></div>
			 <ul style="float:left;width: 20%;">
	  	<?php 
		
				
			 global $post;
			   $custom = get_post_custom($post->ID);
			   #echo "<pre>";print_r($custom);
				$arr=array();
		 foreach( $data as  $title){
		 #echo $title->post_title;
		 	 #echo "<pre>";print_r($data);exit;
			  
			$id_vals.=$title->ID.',';
	 		$post_meta=get_post_meta($title->ID);
			$extra='';
		
			if($custom['set_'.$title->ID][0]!='' || $custom['reps_'.$title->ID][0]!='' ||$custom['rest_'.$title->ID][0]!='')
			{	
				$arr[]=$title->ID;
				$extra='checked=checked';
			}
		?>		
		
		 <li style="width: auto;float: left;clear: both;">
		<input for="loseweight" type="checkbox" name="duration[]" value="<?php echo $title->post_title; ?>" <?php echo $extra; ?> disp_val="<?php echo $i; ?>_<?php echo $title->ID; ?>"/><label><?php echo $title->post_title;?></label></li><?php } ?>
		
		 </ul>
		 <table id="data_table2_<?php echo $i;?>">
		 <?php  foreach( $arr as  $id){
		 	
		 ?>
		 		<tr id="tr_<?php echo $i; ?>_<?php echo $id;?>" class="red" ><th>set</th><td><input type="number" name="set__<?php echo $i; ?>_<?php echo $id;?>" value="<?php echo $custom['set_'.$id][0];?>" /></td><th>Reps</th><td><input type="number" name="reps__<?php echo $i; ?>_<?php echo $id;?>" value="<?php echo $custom['reps_'.$id][0];?>" required /></td><th>Rest</th><td><input type="number" name="rest_<?php echo $i; ?>_<?php echo $id;?>" value="<?php echo $custom['rest_'.$id][0];?>" required /></td></tr>
		<?php }?>
		 </table>
		</div><?php
		
}
?>