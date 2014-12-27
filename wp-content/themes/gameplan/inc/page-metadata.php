<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_page_meta_boxes' );

if ( ! function_exists( 'ct_page_meta_boxes' ) ){
	function ct_page_meta_boxes() {
	  $meta_box = array(
		'id'        => 'meta_box',
		'title'     => 'Page Settings',
		'desc'      => '',
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
			'id'          => 'page_subhead',
			'label'       => __('Page Sub-Heading','cactusthemes'),
			'desc'        => '',
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
			'id'          => 'showhide_social',
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
			'id'          => 'revslider',
			'label'       => __('Revolution Slider Alias Name (used with Front-Page template only)','cactusthemes'),
			'desc'        => 'Enter Alias Name of Revolution Slider to load if this page uses Front-Page template',
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'slider_style',
			'label'       => __('Slider Style','cactusthemes'),
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
				'value'       => 'wide',
				'label'       => __('Wide (Full width)','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'boxed',
				'label'       => __('Boxed','cactusthemes'),
				'src'         => ''
			  )			  
			)
		  ),
		  array(
			'id'          => 'sidebar_name',
			'label'       => __('Custom Sidebar','cactusthemes'),
			'desc'        => 'Enter ID of sidebar to use in this page. This sidebar will replace main sidebar. Custom Sidebar only works with Sidebar Left or Sidebar Right Page Template. Custom Sidebars can be created in Appearance > Sidebars',
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		)
	  );
	  
	  ot_register_meta_box( $meta_box );

	}
}


