<?php
/*	
	*	Diet Plan Module File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Saumil Nagariya
	* 	@link		http://logicexpress.net
	* 	@copyright	Copyright (c) Logicexpress
	*	---------------------------------------------------------------------
	*	This file create and contains the diet_plan post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_sam_diet_plan' );
	function create_sam_diet_plan() {
	
		$labels = array(
			'name' => _x('Diet Plan', 'Diet Plan General Name', 'diet_plan_back_office'),
			'singular_name' => _x('Diet Plan', 'Diet Plan Singular Name', 'diet_plan_back_office'),
			'all_items'=> _x('List Meals', 'Diet Plan Singular Name', 'diet_plan_back_office'),
			'add_new' => _x('Add Meal', 'Add Meal', 'diet_plan_back_office'),
			'add_new_item' => __('Add Meal', 'diet_plan_back_office'),
			'edit_item' => __('Edit Album', 'diet_plan_back_office'),
			'new_item' => __('New Diet Plan', 'diet_plan_back_office'),
			'view_item' => '',
			'search_items' => __('Search Diet Plan', 'diet_plan_back_office'),
			'not_found' =>  __('Nothing found', 'diet_plan_back_office'),
			'not_found_in_trash' => __('Nothing found in Trash', 'diet_plan_back_office'),
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => true,
			"show_in_nav_menus" => false,
			'supports' => array('title','editor','thumbnail','excerpt'),
			'rewrite' => array('slug' => 'dietplan_cat', 'with_front' => false)
		); 
		  
		register_post_type( 'diet-plan' , $args);
		
		register_taxonomy(
				"diet-plan-type", array("diet-plan"), array(
					"hierarchical" => true, 
					"add_new_item"=>__( 'Add New Type' ),
					"name"=>__( 'Add New Type' ),
					"new_item_name"=>__( 'Add New Type' ),
					"label" => "Type", 
					"singular_label" => "Diet Plan Type", 
					"show_in_nav_menus" => true,
					'show_ui'=>true,
			          'query_var'=>true,
					"rewrite" => true));

		register_taxonomy_for_object_type('diet-plan-type', 'diet-plan');

		register_taxonomy(
				"diet-plan-category", array("diet-plan"), array(
					"hierarchical" => true, 
					"label" => "Category", 
					"singular_label" => "Diet Plan Categories", 
					"show_in_nav_menus" => true,
					"rewrite" => true));

		register_taxonomy_for_object_type('diet-plan-category', 'diet-plan');
		
	}
	$dietplan_meta_box = array(	
		"Gallery Picker" => array(
			'type'=>'gallerypicker',
			'title'=> __('SELECT IMAGES', 'diet_plan_back_office'),
			'xml'=>'post-option-gallery-xml',
			'name'=>array(
				'image'=>'post-option-inside-thumbnail-slider-image',
				'title'=>'post-option-inside-thumbnail-slider-title',
				'link'=>'post-option-inside-thumbnail-slider-link',
				'linktype'=>'post-option-inside-thumbnail-slider-linktype'),
			'hr'=>'none'
		)	
	);

	add_action('add_meta_boxes', 'add_diet_plan_option');
	function add_diet_plan_option(){
		add_meta_box('diet-plan-option', __('Diet Plan Option','diet_plan_back_office'), 'add_diet_plan_option_element','diet-plan', 'normal', 'high');
	}

	function add_diet_plan_option_element(){
	
		global $post, $dietplan_meta_box;

		$dp_option = get_post_custom($post->ID);
		$yt_location = $dp_option["yt_location"][0];
		$meal_cat = $dp_option["meal_cat"][0];

		echo '<div id="sam-overlay-wrapper">';
		
		?> <div class="diet-plan-option-meta" id="diet-plan-option-meta">
			<label>Select Program</label>
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
		<?php wp_create_nonce('diet-plan-option-nonce');
			
			/*foreach($gallery_meta_box as $meta_box){

				if( $meta_box['type'] == 'gallerypicker' ){
				
					$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
					if( !empty($xml_string) ){

						$xml_val = new DOMDocument();
						$xml_val->loadXML( $xml_string );
						$meta_box['value'] = $xml_val->documentElement;
						
					}
					print_gallery_picker($meta_box);
					
				}else{
				
					$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
					print_meta($meta_box);
				
				}
				
				
			}*/
			
		?> </div> <?php
		
		echo '</div>';
		
	}

	add_action('save_post', 'save_dietplan_option');
     function save_dietplan_option(){
	  global $post;
	 	update_post_meta($post->ID, "yt_location", $_POST["yt_location"]);
		update_post_meta($post->ID, "meal_cat", $_POST["meal_cat"]);
	
	}
	
	/*Add Column in listing & manage its value*/	
	add_filter( 'manage_edit-diet-plan_columns', 'set_custom_edit_diet_plan_columns' );
	add_action( 'manage_diet-plan_posts_custom_column' , 'custom_diet_plan_column', 10, 2 );

	function set_custom_edit_diet_plan_columns($columns) {
		$columns['diet-plan-type'] = __( 'Type', 'diet_plan_back_office' );
		$columns['diet-plan-category'] = __( 'Category', 'diet_plan_back_office' );
		unset($columns['date']);
		return $columns;
	}

	function custom_diet_plan_column( $column, $post_id ) {
	    switch ( $column ) {

		   case 'diet-plan-type' :
		       $terms = get_the_term_list( $post_id , 'diet-plan-type' , '' , ',' , '' );
		       if ( is_string( $terms ) )
		           echo $terms;
		       else
		           _e( 'Unable to get', 'diet_plan_back_office' );
		       break;

		   case 'diet-plan-category' :
		       $terms = get_the_term_list( $post_id , 'diet-plan-category' , '' , ',' , '' );
		       if ( is_string( $terms ) )
		           echo $terms;
		       else
		           _e( 'Unable to get', 'diet_plan_back_office' );
		       break;
	    }
	}

	function diatpan_add_taxonomy_filters() {
		global $typenow;
	 
		// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array('diet-plan-type','diet-plan-category');
	 
		// must set this to the post type you want the filter(s) displayed on
		if( $typenow == 'diet-plan' ){
	 
			foreach ($taxonomies as $tax_slug) {
				$tax_obj = get_taxonomy($tax_slug);
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if(count($terms) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>Show All $tax_name</option>";
					foreach ($terms as $term) { 
						echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
					}
					echo "</select>";
				}
			}
		}
	}
	add_action( 'restrict_manage_posts', 'diatpan_add_taxonomy_filters' );
?>


