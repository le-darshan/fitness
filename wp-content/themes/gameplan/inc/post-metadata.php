<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_post_meta_boxes' );

if ( ! function_exists( 'ct_post_meta_boxes' ) ){
	function ct_post_meta_boxes() {
	  $meta_box = array(
		'id'        => 'meta_box',
		'title'     => 'Post Settings',
		'desc'      => '',
		'pages'     => array( 'post' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
		  array(
			'id'          => 'sticky_tag',
			'label'       => __('Sticky Tag','cactusthemes'),
			'desc'        => __('Enter the word which will be used for the Sticky Tag.','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'background',
			'label'       => __('Background','cactusthemes'),
			'desc'        => __('Background image for page header','cactusthemes'),
			'std'         => '',
			'type'        => 'background',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'header_height',
			'label'       => __('Header height','cactusthemes'),
			'desc'        => __('Height of page header (in px)','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'show_hide_social',
			'label'       => __('Show/hide social sharing','cactusthemes'),
			'desc'        => __('','cactusthemes'),
			'std'         => '',
			'type'        => 'select',
			'class'       => '',
			'choices'     => array(
			  array(
				'value'       => 'def',
				'label'       => __('Default','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'show',
				'label'       => __('Show','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'hide',
				'label'       => __('Hide','cactusthemes'),
				'src'         => ''
			  )
			)
		  ),
      array(
        'id'          => 'single_post_layout',
        'label'       => 'Single Post Layout',
        'desc'        => 'Select layout for a single post page. This setting can be overridden in a specific post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
		  array(
			'value'       => 'def',
			'label'       => __('Default','cactusthemes'),
			'src'         => ''
		  ),
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Fullwidth',
            'src'         => ''
          )
        ),
      ),

		)
	  );
	  
	  ot_register_meta_box( $meta_box );

	}
}


