<?php 

    define('CUSTOM_POST_TYPE1','program');  //PLEASE DON'T CHANGE THIS CONTENT max. 20 characters, can not contain capital letters or spaces
    define('CUSTOM_CATEGORY_TYPE1','Category');  //PLEASE DON'T CHANGE THIS CONTENT
    define('CUSTOM_TAG_TYPE1','programtags');  //PLEASE DON'T CHANGE THIS CONTENT

    //////////CUSTOM POST TYPE LABELS////////
    define('CUSTOM_TAXONOMY_SEARCH_ITEM',__('Search Category'));
    define('CUSTOM_POST_EDIT',__('Edit'));
    define('CUSTOM_POST_LABEL',__('programs'));
 	define('CUSTOM_POST_NAME',__('Programs'));
    define('CUSTOM_POST_SINGULAR_NAME',__('program'));
    define('CUSTOM_POST_ADD_NEW',__('Add New'));
    define('CUSTOM_POST_ADD_NEW_ITEM',__('Add New program'));
    define('CUSTOM_POST_EDIT_ITEM',__('Edit program'));
    define('CUSTOM_POST_NEW_ITEM',__('New program'));
    define('CUSTOM_POST_VIEW_ITEM',__('View program'));
    define('CUSTOM_POST_SEARCH_ITEM',__('Search programs'));
    define('CUSTOM_POST_NOT_FOUND',__('No programs found'));
    define('CUSTOM_POST_NOT_FOUND_IN_TRASH',__('No programs found in trash'));
 
    add_action("init", "custom_posttype_menu_wp_admin");
	
    function custom_posttype_menu_wp_admin(){
    //===============program SECTION START================
        register_post_type( CUSTOM_POST_TYPE1, 
                    array(  'label'             => CUSTOM_POST_LABEL,
                            'labels'            => array(   'name'                  => CUSTOM_POST_NAME,//
                                                            'singular_name'         => CUSTOM_POST_SINGULAR_NAME,
                                                            'add_new'               =>  CUSTOM_POST_ADD_NEW,
                                                            'add_new_item'          =>  CUSTOM_POST_ADD_NEW_ITEM,
                                                            'edit'                  =>  CUSTOM_POST_EDIT,
                                                            'edit_item'             =>  CUSTOM_POST_EDIT_ITEM,
                                                            'new_item'              =>  CUSTOM_POST_NEW_ITEM,
                                                            'view_item'             =>  CUSTOM_POST_VIEW_ITEM,
                                                            'search_items'          =>  CUSTOM_POST_SEARCH_ITEM,
                                                            'not_found'             =>  CUSTOM_POST_NOT_FOUND,
                                                            'not_found_in_trash'    =>  CUSTOM_POST_NOT_FOUND_IN_TRASH  ),
                            'public'            => true,
                            'can_export'        => true,
                            'show_ui'           => true, // UI in admin panel
                            '_builtin'          => false, // It's a custom post type, not built in
                            '_edit_link'        => 'post.php?post=%d',
                            'capability_type'   => 'post',
                            'menu_icon'         => get_bloginfo('template_url').'/images/Program-Group-icon.png',
                            'hierarchical'      => false,
                            'rewrite'           => array(   "slug" => CUSTOM_POST_TYPE1 ), // Permalinks
                            'query_var'         => CUSTOM_POST_TYPE1, // This goes to the WP_Query schema
                            'supports'          => array('title') ,
                            'show_in_nav_menus' => true ,
                      
                            'menu_position' => 57
                        )
        );



 }
 //register_taxonomy("Category", array("programs"), array("hierarchical" => true, "label" => "Category", "singular_label" => "Category", "rewrite" => true));
 add_action("admin_init", "admin_init");
 
function admin_init(){
 
  add_meta_box("program_meta", "Options Program", "program_meta", "program", "normal", "low");
  add_meta_box("multiple_meta", "Multiple Programe", "multiple_meta", "program", "normal", "low");
   
}


function multiple_meta() {
  global $post;
if(strpos($_SERVER['REQUEST_URI'],'post-new') ==false)
{

		
		 //echo "Total matching posts: $all_posts->found_posts<br/>";
		 $id_vals='';
		  global $post;
			   $custom = get_post_custom($post->ID);
		for($i=0;$i< $custom['exe_days'][0];$i++){
		
		?>

<div id="le_test" class="le_prgtable" style="clear:both">
	
		<h3 class="hndle" style="text-align: center;width: 100%;"> Days <?php echo $i+1; ?></h3>
		 <br/>
		 <Span style="color:#000;font-weight:700">Build Muscels</Span>
		 <div class="clear:both"></div>
		 <ul style="float:left;width: 20%;">
    <?php 
		
		$qry_args = array (
	'post_type'              => 'exercises',
	'meta_query'             => array(
		array(
			'key'       => 'exe_cat',
			'value'     => 'build-muscels',
		),
	),
	);
	
	$all_posts1 = new WP_Query( $qry_args );
 
		$data = $all_posts1->posts;		
			
			 //  echo "<pre>";print_r($custom);
				$arr=array();
		
		 foreach( $data as  $title){
		 #echo $title->post_title;
		 	 #echo "<pre>";print_r($data);exit;
			  
			$id_vals.=$title->ID.',';
	 		$post_meta=get_post_meta($title->ID);
			$extra='';
		
			if($custom['set_'.$i.'_'.$title->ID][0]!='' || $custom['reps_'.$i.'_'.$title->ID][0]!='' ||$custom['rest_'.$i.'_'.$title->ID][0]!='')
			{	
				$arr[]=$i.'_'.$title->ID;
				$extra='checked=checked';
			}
		
		?>
    <li style="width: auto;float: left;clear: both;">
      <input type="checkbox" name="duration[]" value="<?php echo $title->post_title; ?>" <?php echo $extra; ?> disp_val="<?php echo $i; ?>_<?php echo $title->ID; ?>"/>
      <label><?php echo $title->post_title;?></label>
    </li>
    <?php } ?>
  </ul>
  <table id="data_table_<?php echo $i; ?>">
    <?php  foreach( $arr as  $id){
		 	
		 ?>
    <tr id="tr_<?php echo $id;?>" class="red" >
      <th>set</th>
      <td><input type="number" name="set_<?php echo $id;?>" value="<?php echo $custom['set_'.$id][0];?>" /></td>
      <th>Reps</th>
      <td><input type="number" name="reps_<?php echo $id;?>" value="<?php echo $custom['reps_'.$id][0];?>" required /></td>
      <th>Rest</th>
      <td><input type="number" name="rest_<?php echo $id;?>" value="<?php echo $custom['rest_'.$id][0];?>" required /></td>
    </tr>
    <?php }?>
  </table>
</div>
<?php
		


$qry_args = array (
	'post_type'              => 'exercises',
	'meta_query'             => array(
		array(
			'key'       => 'exe_cat',
			'value'     => 'lose-weight',
		),
	),
);
	
	$all_posts2 = new WP_Query( $qry_args );
 
		$data = $all_posts2->posts;
		
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
		
			if($custom['set_'.$i.'_'.$title->ID][0]!='' || $custom['reps_'.$i.'_'.$title->ID][0]!='' ||$custom['rest_'.$i.'_'.$title->ID][0]!='')
			{	
				$arr[]=$i.'_'.$title->ID;
				$extra='checked=checked';
			}
		?>
    <li style="width: auto;float: left;clear: both;">
      <input for="loseweight" type="checkbox" name="duration[]" value="<?php echo $title->post_title; ?>" <?php echo $extra; ?> disp_val="<?php echo $i; ?>_<?php echo $title->ID; ?>"/>
      <label><?php echo $title->post_title;?></label>
    </li>
    <?php } ?>
  </ul>
  <table id="data_table2_<?php echo $i; ?>">
    <?php  foreach( $arr as  $id){
		 	
		 ?>
    <tr id="tr_<?php echo $id;?>" class="red" >
      <th>set</th>
      <td><input type="number" name="set_<?php echo $id;?>" value="<?php echo $custom['set_'.$id][0];?>" /></td>
      <th>Reps</th>
      <td><input type="number" name="reps_<?php echo $id;?>" value="<?php echo $custom['reps_'.$id][0];?>" required /></td>
      <th>Rest</th>
      <td><input type="number" name="rest_<?php echo $id;?>" value="<?php echo $custom['rest_'.$id][0];?>" required /></td>
    </tr>
    <?php }?>
  </table>
</div>
<?php
		
		}
	}	
	
	$qry_args = array (
	'post_type'              => 'exercises',
	'meta_query'             => array(
		array(
			'key'       => 'exe_cat',
			'value'     => array('build-muscels','lose-weight'),
		),
	),
	);
	$all_posts = new WP_Query( $qry_args );
 	$data = $all_posts->posts;
		
		 //echo "Total matching posts: $all_posts->found_posts<br/>";
		 $id_vals='';
		  foreach( $data as  $title){
		  	$id_vals.=$title->ID.',';
		  }
	?>
<input type="hidden" name="id_vals" id="id_vals" value="<?php echo trim($id_vals,",");?>" />
<div id="content_holder"> </div>
<?php 
}

function program_meta() {
  global $post;
  
  $custom = get_post_custom($post->ID);
  /*$prg_day = $custom["prg_day"][0];*/
  $prg_cycle = $custom["prg_cycle"][0];
  $set = $custom["set"][0];
  $reps = $custom["reps"][0];
  $rest = $custom["rest"][0];
  $exe_days = $custom["exe_days"][0];
  ?>
<style>
.format-settings label {width:20%;float:left;padding:0 2%!important;}
.format-settings select{width:20%;}
#multiple_meta{clear: both;
float: left;
width: 100%;}
.le_prgtable ul li{LINE-HEIGHT: 22PX;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($){ 
$('select#exe_days').change(function() {
var sel_value = $( "#exe_days" ).val();
	
	var dataString = 'sel_value='+ sel_value;

		$.ajax({
			type: "POST",
			url: "http://cleaverfitness.com/wp-content/themes/gameplan/includes/ajaxdata.php",
			data: dataString,
			cache: true, 
			success: function(data){
				$("#content_holder").html(data);
			}
		});
		return false;
	

		});
})
 
</script>
</div>
<!--<p id="demo"  name="prog_name"></p>-->
<div class="format-settings">
<p style="display:none">
  <label>Day</label>
  <select name="prg_day" id="prg_day" >
    <option>--select--</option>
    <option value="2-day" <?php if($prg_day == "2-day"){echo 'selected=selected';}?>>2 Day</option>
    <option value="3-day" <?php if($prg_day == "3-day"){echo 'selected=selected';}?>>3 Day</option>
    <option value="4-day" <?php if($prg_day == "4-day"){echo 'selected=selected';}?>>4 Day</option>
  </select>
<P>
<div class="container">
  <div id="selected_form_code">
    <label>Day</label>
    <select id="exe_days" name="exe_days">
      <option>--select--</option>
      <option value="2-day" <?php if($exe_days == "2-day"){echo 'selected=selected';}?>>2 Day</option>
      <option value="3-day" <?php if($exe_days == "3-day"){echo 'selected=selected';}?>>3 Day</option>
      <option value="4-day" <?php if($exe_days == "4-day"){echo 'selected=selected';}?>>4 Day</option>
    </select>
  </div>
  </P>
  <p>
    <label>Cycle</label>
    <select name="prg_cycle" id="myselect" onchange="myFunction()">
      <option>--select--</option>
      <option value="1-month" <?php if($prg_cycle == "1-month"){echo 'selected=selected';}?>>1 Month</option>
      <option value="2-month" <?php if($prg_cycle == "2-month"){echo 'selected=selected';}?>>2 Month</option>
      <option value="3-month" <?php if($prg_cycle == "3-month"){echo 'selected=selected';}?>>3 Month</option>
      <option value="4-month" <?php if($prg_cycle == "4-month"){echo 'selected=selected';}?>>4 Month</option>
      <option value="5-month" <?php if($prg_cycle == "5-month"){echo 'selected=selected';}?>>5 Month</option>
      <option value="6-month" <?php if($prg_cycle == "6-month"){echo 'selected=selected';}?>>6 Month</option>
      <option value="7-month" <?php if($prg_cycle == "7-month"){echo 'selected=selected';}?>>7 Month</option>
      <option value="8-month" <?php if($prg_cycle == "8-month"){echo 'selected=selected';}?>>8 Month</option>
      <option value="9-month" <?php if($prg_cycle == "9-month"){echo 'selected=selected';}?>>9 Month</option>
      <option value="10-month" <?php if($prg_cycle == "10-month"){echo 'selected=selected';}?>>10 Month</option>
      <option value="11-month" <?php if($prg_cycle == "11-month"){echo 'selected=selected';}?>>11 Month</option>
      <option value="12-month" <?php if($prg_cycle == "12-month"){echo 'selected=selected';}?>>12 Month</option>
      <option value="13-month" <?php if($prg_cycle == "13-month"){echo 'selected=selected';}?>>13 Month</option>
      <option value="14-month" <?php if($prg_cycle == "14-month"){echo 'selected=selected';}?>>14 Month</option>
      <option value="15-month" <?php if($prg_cycle == "15-month"){echo 'selected=selected';}?>>15 Month</option>
      <option value="16-month" <?php if($prg_cycle == "16-month"){echo 'selected=selected';}?>>16 Month</option>
      <option value="17-month" <?php if($prg_cycle == "17-month"){echo 'selected=selected';}?>>17 Month</option>
      <option value="18-month" <?php if($prg_cycle == "18-month"){echo 'selected=selected';}?>>18 Month</option>
    </select>
  </p>
  <p style="display:none">
    <label>Set </label>
    <input type="text"  name="set" id="v" value="<?php echo $set; ?>" />
  </p>
  <p style="display:none">
    <label>Reps </label>
    <input type="text"  name="reps" id="reps" value="<?php echo $reps; ?>" />
  </p>
  <p style="display:none">
    <label>Rest </label>
    <input type="text"  name="rest" id="rest" value="<?php echo $rest; ?>" />
  </p>
</div>

<?php
}
add_action("manage_posts_custom_column",  "program_custom_columns");
add_filter("manage_edit-program_columns", "program_edit_columns");
add_action('save_post', 'save_detail');
 function save_detail(){
  global $post;
//echo "<pre>";

 $ids=explode(",",$_POST['id_vals']);
 #print_r($ids);exit;
 $exe_days = $_POST['exe_days'];
// echo $exe_days;exit;
 for($i=0; $i<$exe_days ; $i++ ){
 foreach($ids as $id)
 {
 	echo $id;
 	if(isset($_POST['set_'.$i.'_'.$id])){
		 var_dump(update_post_meta($post->ID, "set_".$i.'_'.$id, $_POST["set_".$i.'_'.$id]));
	}
	if(isset($_POST['reps_'.$i.'_'.$id])){
		var_dump(update_post_meta($post->ID, "reps_".$i.'_'.$id, $_POST["reps_".$i.'_'.$id]));
	}
	if(isset($_POST['rest_'.$i.'_'.$id])){
		var_dump(update_post_meta($post->ID, "rest_".$i.'_'.$id, $_POST["rest_".$i.'_'.$id]));
	}
 }
 }


	update_post_meta($post->ID, "exe_days", $_POST["exe_days"]);
  /*update_post_meta($post->ID, "prg_day", $_POST["prg_day"]);*/
  update_post_meta($post->ID, "prg_cycle", $_POST["prg_cycle"]);
  update_post_meta($post->ID, "set", $_POST["set"]);
  update_post_meta($post->ID, "reps", $_POST["reps"]);
  update_post_meta($post->ID, "rest", $_POST["rest"]);

}
function program_edit_columns($columns){
  $columns = array(
     
    "title" => "Title",
   /* "prg_day" => "Day",
	"prg_cycle" => "Cycle",
	"set" => "Set",
	"reps" => "Reps",
	"rest" => "Rest",
	 "Category" => "category",*/
  );
 
  return $columns;
}
function program_custom_columns($column){
  global $post;

  switch ($column) {

   /* case "prg_day":
 	  $custom = get_post_custom();
      echo $custom["prg_day"][0];
      break;
    case "prg_cycle":
 	  $custom = get_post_custom();
      echo $custom["prg_cycle"][0];
      break;
    case "set":
 	  $custom = get_post_custom();
      echo $custom["set"][0];
      break;
    case "reps":
 	  $custom = get_post_custom();
      echo $custom["reps"][0];
      break;
    case "rest":
 	  $custom = get_post_custom();
      echo $custom["rest"][0];
      break;
	case "category":
      echo get_the_term_list($post->ID, 'Category', '', ', ','');
      break;*/
  }
}

function custom_admin_js() {
   
    echo '<script type="text/javascript" src="http://cleaverfitness.com/wp-content/themes/gameplan/admin/assets/js/back-scripts.js"></script>';
	
}
add_action('admin_footer', 'custom_admin_js');