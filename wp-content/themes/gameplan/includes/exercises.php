<?php  
add_action('init', 'exercises');
 
function exercises() {

$labels = array(
		'name' => _x('Exercises', 'post type general name'),
		'singular_name' => _x('exercises', 'post type singular name'),
		'add_new' => _x('Add New', 'exercises'),
		'add_new_item' => __('Add New exercises'),
		'edit_item' => __('Edit exercises'),
		'new_item' => __('New exercises'),
		'view_item' => __('View exercises'),
		'search_items' => __('Search exercises'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/exe.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor'),
		'menu_position' => 58
	  ); 
 
	register_post_type( 'exercises' , $args );
}
//register_taxonomy("Category", array("exercises"), array("hierarchical" => true, "label" => "Category", "singular_label" => "Category", "rewrite" => true));
add_action("admin_init", "admins_init");
 
function admins_init(){
 
  add_meta_box("data_meta", "Options Excersice", "data_meta", "exercises", "normal", "low");
}
 

 
function data_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $location = $custom["location"][0];
  $perfomers = $custom["perfomers"][0];
  $exe_cat = $custom["exe_cat"][0];
  $exe_req = $custom["exe_req"][0];
  ?>
<p>
<label>Category</label>
<select name="exe_cat">
<option>--select category--</option>
<option value="build-muscels" <?php if($exe_cat == "build-muscels"){echo 'selected=selected';}?> >Build Muscels</option>
<option value="lose-weight" <?php if($exe_cat == "lose-weight"){echo 'selected=selected';}?> >Lose Weight</option>
</select>
</p>
<p>
  <label>YouTube (Embedded Code)</label>
  <br />
  <input style="width:50%;" type="text" name="location" value=" <?php echo $location; ?> " class="widefat" />
<p>
  <label>Show on Top Performers Page</label>
  <br />
</p>
<input type="radio" name="perfomers" <?php if($perfomers == "yes"){echo 'checked=checked';}?> class="performers"  value="yes"/>
Yes &nbsp;&nbsp;&nbsp;
<input type="radio" name="perfomers" <?php if($perfomers == "no"){echo 'checked=checked';}?>   class="performers"  value="no"/>
No
</p>

<p><label>Required </label><br/></p>
<input type="radio" id="exe_req" <?php if($exe_req == "yes"){echo 'checked=checked';}?>   name="exe_req" value="yes"/> Yes &nbsp;&nbsp;&nbsp;
<input type="radio" id="exe_req" <?php if($exe_req == "no"){echo 'checked=checked';}?>    name="exe_req" value="no"/> No


<?php
}
add_action("manage_posts_custom_column",  "exercises_custom_columns");
add_filter("manage_edit-exercises_columns", "exercises_edit_columns");
add_action('save_post', 'save_details');
 function save_details(){
  global $post;
 

  update_post_meta($post->ID, "location", $_POST["location"]);
  update_post_meta($post->ID, "perfomers", $_POST["perfomers"]);
  update_post_meta($post->ID, "exe_cat", $_POST["exe_cat"]);
  update_post_meta($post->ID, "exe_req", $_POST["exe_req"]);

}
function exercises_edit_columns($columns){
  $columns = array(
     
    "title" => "Exercises Name",
    "exe_cat" => "Program",
	"exe_req" => "Required",
	"perfomers" => "Leaderboard",
 
  );
 
  return $columns;
}
function exercises_custom_columns($column){
  global $post;
 
  switch ($column) {
 
    case "exe_cat":
 	  $custom = get_post_custom();
      echo ucfirst($custom["exe_cat"][0]);
      break;
	  case "exe_req":
 	  $custom = get_post_custom();
      echo ucfirst($custom["exe_req"][0]);
      break;
	  case "perfomers":
 	  $custom = get_post_custom();
      echo ucfirst($custom["perfomers"][0]);
      break;
  }
}
function set_messages($messages) {
global $post, $post_ID;
$post_type = get_post_type( $post_ID );

$obj = get_post_type_object($post_type);
$singular = $obj->labels->singular_name;

$messages[$post_type] = array(
0 => '', // Unused. Messages start at index 1.
1 => sprintf( __($singular.' updated. <a href="%s" style="display:none">View '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
2 => __('Custom field updated.'),
3 => __('Custom field deleted.'),
4 => __($singular.' updated.'),
5 => isset($_GET['revision']) ? sprintf( __($singular.' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
6 => sprintf( __($singular.' published. <a href="%s">View '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
7 => __('Page saved.'),
8 => sprintf( __($singular.' submitted. <a target="_blank" href="%s">Preview '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
9 => sprintf( __($singular.' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview '.strtolower($singular).'</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
10 => sprintf( __($singular.' draft updated. <a target="_blank" href="%s">Preview '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
);
return $messages;
}

add_filter('post_updated_messages', 'set_messages' );



?>
