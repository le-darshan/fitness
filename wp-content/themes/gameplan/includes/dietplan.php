<?php
add_action( 'init', 'create_diet_plan' );

function create_diet_plan() {
    register_post_type( 'diet_plans',
        array(
            'labels' => array(
                'name' => 'Diet Plan',
                'singular_name' => 'diet_plan',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New diet_plan',
                'edit' => 'Edit',
                'edit_item' => 'Edit diet_plan',
                'new_item' => 'New diet_plan',
                'view' => 'View',
                'view_item' => 'View diet_plan',
                'search_items' => 'Search diet_plans',
                'not_found' => 'No diet_plans found',
                'not_found_in_trash' => 'No diet_plans found in Trash',
                'parent' => 'Parent diet_plan'
            ),
 
            'public'            => true,
							'has_archive' => true,
                            'can_export'        => true,
                            'show_ui'           => true, // UI in admin panel
                            '_builtin'          => false, // It's a custom post type, not built in
                            '_edit_link'        => 'post.php?post=%d',
                            'capability_type'   => 'post',
                            'menu_icon'         => get_bloginfo('template_url').'/images/Program-Group-icon.png',
                            'hierarchical'      => false,
                            'rewrite'           => array(   "slug" => "diet_plans" ), // Permalinks
                            'query_var'         => diet_plans, // This goes to the WP_Query schema
                            'supports'          => array('title','excerpt', 'editor','thumbnail') ,
                            'show_in_nav_menus' => true ,
                            'taxonomies' => array('category','post_tag'),
							
       )
    );
}



add_action("admin_init", "admins_init1");
 
function admins_init1(){
 
  add_meta_box("data_meals", "Adding New Meals:", "data_meals", "diet_plans", "normal", "low");
  
}
 
function data_meals() {
  global $post;
  $custom = get_post_custom($post->ID);
  $yt_location = $custom["yt_location"][0];
  $meal_cat = $custom["meal_cat"][0];


  ?>
  	 
<label>Select Meals</label>
  <br />
<p>
<select name="meal_cat" id="meal_cat">
	 <option>--select--</option>
    <option value="lose-weight" <?php if($meal_cat == "lose-weight"){echo 'selected=selected';}?> >Lose weight</option>
	<option value="build-muscles" <?php if($meal_cat == "build-muscles"){echo 'selected=selected';}?> >Build Muscles</option>
	
    </select>
 </p>


<label>YouTube (Embedded Code)</label>
  <br />
  <p>
<input style="width:50%;" type="text" name="yt_location" value="<?php echo $yt_location ;?>" class="widefat" />
</p>

<?php
}
 

add_action('save_post', 'save_meals_details');
 function save_meals_details(){
  global $post;
 	update_post_meta($post->ID, "yt_location", $_POST["yt_location"]);
	update_post_meta($post->ID, "meal_cat", $_POST["meal_cat"]);
	
}

?>


