<?php

if(!defined('PARENT_THEME')){
	define('PARENT_THEME','gameplan');
}
static $check_widget=0;
/* Define list of recommended and required plugins */
$_theme_required_plugins = array(
        array(
            'name'      => 'WP Pagenavi',
            'slug'      => 'wp-pagenavi',
            'required'  => true
        ),
		array(
            'name'      => 'Custom Sidebars',
            'slug'      => 'custom-sidebars',
            'required'  => false
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),
		array(
            'name'      => 'The Events Calendar',
            'slug'      => 'the-events-calendar',
            'required'  => false
        ),
		array(
            'name'      => 'Flickr Badges Widget',
            'slug'      => 'flickr-badges-widget',
            'required'  => false
        ),
		array(
            'name'      => 'Gameplan - Member',
            'slug'      => 'gameplan-member',
            'required'  => false
        ),
		array(
            'name'      => 'Gameplan - Portfolio',
            'slug'      => 'gameplan-portfolio',
            'required'  => false
        ),
		array(
            'name'      => 'Gameplan - Shortcodes',
            'slug'      => 'gameplan-shortcodes',
            'required'  => true
        ),
		array(
            'name'      => 'Gameplan - Tribe - Addons',
            'slug'      => 'gameplan-tribe-addons',
            'required'  => false
        ),
		array(
            'name'      => 'Revolution Slider',
            'slug'      => 'revslider',
            'required'  => false
        )
    );
	
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //for check plugin status


/**
 * =============== CACTUSTHEMES.COM ===================
 * ======== Cactusthemes Skeleton Framework ===========
 *          version 0.1 - created 29/4/2013
 * ====================================================
 */
require_once 'inc/core/skeleton-core.php';

/**
 * Load Theme Options settings
 */ 
require_once 'inc/theme-options.php';

/**
 * Load Theme Core Functions, Hooks & Filter
 */
require_once 'inc/core/theme-core.php';

if(is_plugin_active('woocommerce/woocommerce.php')){
	require_once 'inc/functions-woocommerce.php';
}

require_once 'sample-data/gp_importer.php'; /* to enable "one click install" sample data

/**
 * Sets up theme defaults and registers the various WordPress features that
 * theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function cactusthemes_setup() {
	/*
	 * Makes theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'cactusthemes', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'woocommerce' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'gallery'));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'cactusthemes' ) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'cactusthemes_setup' );

/**
 * Enqueues scripts and styles for front-end.
 */
function cactusthemes_scripts_styles() {
	global $wp_styles;
	
	/*
	 * Loads our main javascript.
	 */	
	
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', true );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery-easing-1.3.js', array(), '', true );
	wp_register_script( 'jquery-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '', true );
	wp_register_script( 'isotope-portfolio', get_template_directory_uri() . '/js/isotope-portfolio.js', array('jquery'), '', true );
	wp_enqueue_script( 'modernizr-custom', get_template_directory_uri() . '/js/modernizr.custom.97074.js', array(), '', true );
	wp_register_script( 'jquery-hoverdir', get_template_directory_uri() . '/js/jquery.hoverdir.js', array('jquery'), '', true );
	wp_register_script( 'jquery-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '', true );	
	wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/jquery.caroufredsel-6.2.1.min.js', array(), '', true );
	wp_register_script( 'gauge', get_template_directory_uri() . '/js/gauge.js', array(), '', true );
	wp_register_script( 'countto', get_template_directory_uri() . '/js/jquery.countTo.js', array(), '', true );
	// Include Flipclock
	wp_register_script( 'prefixfree', get_template_directory_uri() . '/js/flipclock/libs/prefixfree.min.js', array(), '', true );
	wp_register_script( 'flipclock', get_template_directory_uri() . '/js/flipclock/flipclock.min.js', array('jquery'), '', true );
		
	wp_enqueue_script( 'template', get_template_directory_uri() . '/js/template.js', array('jquery'), '', true );
    
	wp_register_script( 'js-scrollbox', get_template_directory_uri() . '/js/jquery.scrollbox.js', array(), '', true );
	wp_enqueue_script( 'waypoints' );

	/*
	 * Loads our main stylesheet.
	 */
	$gp_all_font = array();
	if(ot_get_option( 'text_font', 'Lato')!='Custom Font 1' && ot_get_option( 'text_font', 'Lato')!='Custom Font 2'){
		$gp_all_font[] = ot_get_option( 'text_font', 'Lato');
	}
	if(ot_get_option( 'h1_font', 'Gotham_Bold')!='Custom Font 1' && ot_get_option( 'h1_font', 'Gotham_Bold')!='Custom Font 2'){
		$gp_all_font[] = ot_get_option( 'h1_font', 'Gotham_Bold');
	}
	if(ot_get_option( 'nav_font', 'Open Sans')!='Custom Font 1' && ot_get_option( 'nav_font', 'Open Sans')!='Custom Font 2'){
		$gp_all_font[] = ot_get_option( 'nav_font', 'Open Sans');
	}
	$all_font=implode('|',$gp_all_font);

	wp_enqueue_style( 'google-font', 'http://fonts.googleapis.com/css?family='.$all_font );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css');
	wp_enqueue_style( 'bootstrap-no-icons', get_template_directory_uri() . '/css/bootstrap.no-icons.min.css');
	wp_register_style( 'flipclock', get_template_directory_uri() . '/css/flipclock.css');	
	wp_enqueue_style( 'font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	
	if(is_singular() ) wp_enqueue_script( 'comment-reply' );

	wp_enqueue_style( 'gameplan-style', get_bloginfo( 'stylesheet_url' ), array(),'20131023');
	wp_enqueue_style( 'icon-effect', get_template_directory_uri() . '/css/icon-effect.css');
	if(ot_get_option( 'theme_style') == 'dark'){
		wp_enqueue_style( 'dark-style', get_template_directory_uri() . '/css/dark-style.css');
	}

	if(is_plugin_active('woocommerce/woocommerce.php')){
		wp_enqueue_style( 'gameplan-woocommerce', get_template_directory_uri() . '/css/gameplan-woocommerce.css');
	}
	
	wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/css/custom.css.php');
	if(ot_get_option( 'righttoleft', 0)){
		wp_enqueue_style( 'rtl', get_template_directory_uri() . '/css/rtl.css');
	}
	if(ot_get_option( 'responsive', 1)!=1){
		wp_enqueue_style( 'no-responsive', get_template_directory_uri() . '/css/no-responsive.css');
	}	
}
add_action( 'wp_enqueue_scripts', 'cactusthemes_scripts_styles' );

/**
 * Registers our main widget area and the front page widget areas. 
 */
function cactusthemes_widgets_init() {
	$rtl = ot_get_option( 'righttoleft', 0);
	
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'cactusthemes' ),
		'id' => 'main_sidebar',
		'description' => __( 'Appears all pages & posts, exepts for pages which have defined sidebar such as Blog or Search page.', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	
	register_sidebar( array(
		'name' => __( 'Top Menu', 'cactusthemes' ),
		'id' => 'top_menu',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Search', 'cactusthemes' ),
		'id' => 'search',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));	
	
	register_sidebar( array(
		'name' => __( 'Navigation', 'cactusthemes' ),
		'id' => 'navigation',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Main Top', 'cactusthemes' ),
		'id' => 'main_top',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	
	register_sidebar( array(
		'name' => __( 'Single Blog Sidebar', 'cactusthemes' ),
		'id' => 'single_blog_sidebar',
		'description' => __( 'Sidebar in single post page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => __( 'Single Event Sidebar', 'cactusthemes' ),
		'id' => 'single_event_sidebar',
		'description' => __( 'Sidebar in single event page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'cactusthemes' ),
		'id' => 'blog_sidebar',
		'description' => __( 'Sidebar in blog page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => __( 'Event Listing Sidebar', 'cactusthemes' ),
		'id' => 'event_listing_sidebar',
		'description' => __( 'Sidebar in event listing page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => __( 'Search Sidebar', 'cactusthemes' ),
		'id' => 'search_sidebar',
		'description' => __( 'Sidebar in search page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));

	register_sidebar( array(
		'name' => __( 'Body Bottom', 'cactusthemes' ),
		'id' => 'body_bottom',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));	
	
	register_sidebar( array(
		'name' => __( 'Main Bottom', 'cactusthemes' ),
		'id' => 'main_bottom',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
		
	register_sidebar( array(
		'name' => __( 'Copyright', 'cactusthemes' ),
		'id' => 'copyright',
		'description' => __( '', 'cactusthemes' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	if(is_plugin_active('woocommerce/woocommerce.php')){
		register_sidebar( array(
			'name' => __( 'WooCommerce Sidebar', 'cactusthemes' ),
			'id' => 'woocommerce',
			'description' => __( 'Appears in WooCommerce Pages. If empty, Main Sidebar will be used', 'cactusthemes' ),
			'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
			'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
		));
	}
}
add_action( 'widgets_init', 'cactusthemes_widgets_init' );

/* Functions, Hooks, Filters and Registers in Admin */
require_once 'inc/functions-admin.php';

/* Register Thumbnail Size */
add_image_size('thumb_100x100',100,100, true);
add_image_size('thumb160x120',160,120, true);
add_image_size('thumb_360x240',360,240, true);// classic blog listing (with sidebar)
add_image_size('thumb_467x9999',467,312, true);// classic blog listing (no sidebar)
add_image_size('small-carousel',245,136, true);// small carousel
add_image_size('medium-carousel',390,217, true);// medium carousel

add_image_size('thumb_250x200',250,200, true);
add_image_size('thumb_860x430',860,430, true);

//mobile bg
add_image_size('page_mobile_bg',540,9999, true);

// Hook widget 'SEARCH'
add_filter('get_search_form', 'cactus_search_form'); 
function cactus_search_form($text) {
	$text = str_replace('value=""', 'placeholder="'.__("SEARCH").'"', $text);
    return $text;
}

/**
 * Hook before widget 
 */
if(!is_admin()){
	add_filter('dynamic_sidebar_params', 'gameplan_hook_before_widget'); 	
	function gameplan_hook_before_widget($params){
	global $check_widget;
		/* Add a wrapper <div> to widgets in Body Bottom and Main Bottom based on layout setting in Theme Options */
	//	$pos = array('body_bottom','main_bottom');
	$pos = array('main_bottom');
		foreach($pos as $p){
			if($params[0]['id'] == $p){
				$layout = ot_get_option($p.'_layout',4); // not yet working
				$span = 12;
				switch($layout){
					case 1:
						$span = 12;
						break;
					case 2:
						$span = 6;
						break;
					case 3:
						$span = 4;
						break;
					case 4:
						$span = 3;
						break;
				}
				if($check_widget==0){
							$span = 6;
							$check_widget=1;
				}
				
				$params[0]['before_widget'] = preg_replace('/<div/', '<div class="span'.$span.'"><div', $params[0]['before_widget'], 1);
				$params[0]['after_widget'] .= '</div>';
			}
		}
	
		return $params;
	} 
}

/* Filter widget titles to add first word different */
add_filter('widget_title','gameplan_filter_widget_titles');
function gameplan_filter_widget_titles($old_title){
	$title = explode( " ", $old_title, 2 );
	$title[0] = isset($title[0]) ? $title[0] : null;
	$title[1] = isset($title[1]) ? $title[1] : null;
	$titleNew='';
	if($title[0]!=''||$title[1]!=''){
	$titleNew = "<span class='title def_style'>
		<span class='title-text'>
			<span class='firstword'>$title[0]</span> $title[1]
		</span>
	</span>";
	}
	return $titleNew;
}

// Functions 
function head_slide($pgs, $id='', $class='', $single_page=array()){
	if($single_page == NULL){
		$html = '
			<div id="'.$id.'" class="customslider">
				<div class="slides">
					<div class="slide">
						<div class="'.$class.'">
		';
	}elseif(isset($single_page['head']) && $single_page['head']){
		$html = '
			<div id="'.$id.'" class="'.$class.' customslider">
				<div class="slides">
		';
	}elseif(isset($single_page['page']) && $single_page['page']){
		$html = '
			<div class="slide">
				<div class="'.$class.'">
		';
	}	
	return $html;
}

function footer_slide($single_page=array(),$class=''){
	if($single_page == NULL){
		$html = '
						</div>
					</div>
				</div>
				<div class="clear"><!----></div>
				<div class="'.$class.' slides-control">
					<div class="dotted"><!---->
					<div class="control-a">
						<a href="javascript:void(0)" class="pre icon-sign-blank">
							<span class="icon-caret-left"><!----></span>
						</a>
						<a href="javascript:void(0)" class="next icon-sign-blank">
							<span class="icon-caret-right"><!----></span>
						</a>
					</div>
					</div>
				</div>
				<div class="clear"><!----></div>
			</div>
		';
	}elseif(isset($single_page['head'])){
		$html = '
				</div>
				<div class="clear"><!----></div>
				<div class="slides-control">
					<div class="dotted"><!---->
					<div class="control-a">
						<a href="javascript:void(0)" class="pre icon-sign-blank">
							<span class="icon-caret-left"><!----></span>
						</a>
						<a href="javascript:void(0)" class="next icon-sign-blank">
							<span class="icon-caret-right"><!----></span>
						</a>
					</div>
					</div>
				</div>
				<div class="clear"><!----></div>
			</div>
		';
	}elseif(isset($single_page['page'])){
		$html = '
					</div>
				</div>
		';
	}
	return $html;
}
if(!function_exists('show_social_icon')){
	function show_social_icon($arr_social = array()){
		$html = '';
		$social_link_open = ot_get_option( 'social_link_open');
		if($social_link_open=='on'){$target='target="_blank"';}
		if(count($arr_social) > 0){
			foreach($arr_social as $key => $value){
				if(isset($value) && $value != ''){
					if($key=='envelope'){
						$html .= '<a href="mailto:'.$value.'" class="icon-social icon-'.str_replace('_', '-', $key).'" style="padding-top: 2.5px; padding-right: 8.5px; padding-left: 6px;" '.$target.' ><!-- --></a>';
					}else {
						$html .= '<a href="'.$value.'" class="icon-social icon-'.str_replace('_', '-', $key).'" '.$target.'><!-- --></a>';
					}
				}
			}
		}
		return $html;
	}
}

function get_related_posts($post_id) {
	$query = new WP_Query();
    
    $args = '';

	$args = wp_parse_args($args, array(
		'showposts' => -1,
		'post__not_in' => array($post_id),
		'ignore_sticky_posts' => 0,
        'category__in' => wp_get_post_categories($post_id)
	));
	
	$query = new WP_Query($args);
	
  	return $query;
}

function gp_social_share($post_ID){ ?>

<div id="social-share"> <a href="#" style="text-decoration:none" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');return false;"> <img src="<?php echo get_template_directory_uri() ?>/images/facebook.gif" style="vertical-align:top; margin-top:1px" /> </a> &nbsp;
  <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post_ID)) ?>&amp;width=450&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false&amp;appId=498927376861973" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
  \A0 <a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  &nbsp; <a href="//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post_ID)) ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id($post_ID))); ?>&description=<?php echo urlencode(get_the_title($post_ID)) ?>" data-pin-do="buttonPin" data-pin-config="none"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
  <script type="text/javascript">
    (function(d){
      var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
      p.type = 'text/javascript';
      p.async = true;
      p.src = '//assets.pinterest.com/js/pinit.js';
      f.parentNode.insertBefore(p, f);
    }(document));
    </script>
  &nbsp;
  <div class="g-plusone" data-size="medium" data-annotation="none"></div>
  <script type="text/javascript">
      window.___gcfg = {lang: 'en-GB'};
    
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
</div>
<?php }


if(!function_exists('html_tags_project')){
	/* Function to write project/portfolio tags filter */
	function html_tags_project($all_tags){
		$html = '';
		if(count($all_tags) > 0){
			$html .= '
<div class="center">
  <ul id="project-tags" class="project-tags">
    <li><a class="active" href="javascript:void(0)" data-filter="*">All</a></li>
    ';
    foreach ($all_tags as $tag){
    //var_dump($tag);
    $html .= '
    <li><a href="javascript:void(0)" data-filter=".'.$tag->slug.'">'.$tag->name.'</a></li>
    ';
    }
    $html .= '
  </ul>
</div>
';
		}
		return $html;
	}
}

/* Tribe Events Calendar support 
 *
 *
 */


/* Get heading of Tribe Events page
 * 
 * Return : array[2]{heading,sub-heading} if found, false if not found
 * check https://gist.github.com/jo-snips/2415009
 *
 */
function get_tribe_events_page_heading(){

	if(class_exists('TribeEvents') && is_tribe_page()){
		if(((tribe_is_event() || get_post_type() == 'tribe_organizer') && is_single()) || tribe_is_venue()){
			// Single Eveng
			$heading = get_the_title(get_the_ID());
		} else {
			// List View
			$heading = tribe_get_events_title(); 		
		}
		if(is_single()){
		$sub_heading = '<a class="single_links" href="'.tribe_get_events_link().'">&laquo; ' . __('All Events','cactusthemes') . '</a>';
		}
		return array($heading,$sub_heading);
	} else return false;
}

/* Check if current page is a tribe page (listing, single ...) */
function is_tribe_page(){
	wp_reset_postdata();//reset custom query
	if(class_exists('TribeEvents')){
		if( tribe_is_month() && !is_tax() ) { // Month View Page 
			return true;		 
		} elseif( tribe_is_month() && is_tax() ) { // Month View Category Page
		 
		return true;
		 
		} elseif( tribe_is_past() || tribe_is_upcoming() && !is_tax() ) { // List View Page
		 
		return true;
		 
		} elseif( tribe_is_past() || tribe_is_upcoming() && is_tax() ) { // List View Category Page
		 
		return true;
		 
		} elseif( tribe_is_event() && is_single() ) { // Single Events
		 
		return true;
		 
		} elseif(class_exists('TribeEventsPro')){
			if( tribe_is_week() && !is_tax() ) { // Week View Page
		 
		return true;
		 
		} elseif( tribe_is_week() && is_tax() ) { // Week View Category Page
		 
		return true;
		 
		} elseif( tribe_is_day() && !is_tax() ) { // Day View Page
		 
		return true;
		 
		} elseif( tribe_is_day() && is_tax() ) { // Day View Category Page
		 
		return true;
		 
		} elseif( tribe_is_map() && !is_tax() ) { // Map View Page
		 
		return true;
		 
		} elseif( tribe_is_map() && is_tax() ) { // Map View Category Page
		 
		return true;
		 
		} elseif( tribe_is_photo() && !is_tax() ) { // Photo View Page
		 
		return true;
		 
		} elseif( tribe_is_photo() && is_tax() ) { // Photo View Category Page
		 
		return true;
		 
		} elseif( get_post_type() == 'tribe_organizer' && is_single() ) { // Single Organizers
		 
		return true;
		 
		} elseif( tribe_is_venue() ) { // Single Venues
		 
		return true;
		 
		} 
		}
	}
	return false;
}
function tribe_single_related_events_fix($count = 3, $post_type = TribeEvents::POSTTYPE ) {
	if(function_exists('tribe_get_related_posts')){
	$count = ot_get_option( 'number_re_event');
	if($count==''){$count=3;}
	$posts = tribe_get_related_posts( $count);
	if ( is_array( $posts ) && !empty( $posts ) ) {
		echo '
<div>'.do_shortcode('[divider colorstyle="colorstyle_2" dividerstyle="style_2" paddingtop="40" paddingbottom="10" animation="" ]').'</div>
';
		echo '
<h3 class="tribe-events-related-events-title">'.  __( 'Related Events', 'tribe-events-calendar-pro' ) .'</h3>
';
		echo '
<ul class="tribe-related-events tribe-clearfix hfeed vcalendar">
  ';
  foreach ( $posts as $post ) {
  echo '
  <li>';
    
    $thumb = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID, 'thumb_100x100' ) : '<img src="'. trailingslashit( TribeEventsPro::instance()->pluginUrl ) . 'resources/images/tribe-related-events-placeholder.png" alt="'. get_the_title( $post->ID ) .'" />';;
    echo '
    <div class="tribe-related-events-thumbnail">';
      echo '<a href="'. get_permalink( $post->ID ) .'" class="url" rel="bookmark">'. $thumb .'</a>';
      echo '</div>
    ';
    echo '
    <div class="tribe-related-event-info">';
      echo '
      <h3 class="tribe-related-events-title summary"><a href="'. get_permalink( $post->ID ) .'" class="url" rel="bookmark">'. get_the_title( $post->ID ) .'</a></h3>
      ';
      
      if ( class_exists( 'TribeEvents' ) && $post->post_type == TribeEvents::POSTTYPE && function_exists( 'tribe_events_event_schedule_details' ) ) {
      echo tribe_events_event_schedule_details( $post );
      }
      if ( class_exists( 'TribeEvents' ) && $post->post_type == TribeEvents::POSTTYPE && function_exists( 'tribe_events_event_recurring_info_tooltip' ) ) {
      echo tribe_events_event_recurring_info_tooltip( $post->ID );
      }
      echo '</div>
    ';
    echo '</li>
  ';
  }
  echo '
</ul>
';
		echo '
<div>'.do_shortcode('[divider colorstyle="colorstyle_2" dividerstyle="style_1" paddingtop="" paddingbottom="" animation="" ]').'</div>
'; 	
	}
	}
}
function gp_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}
function gp_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'gp_excerpt_more');
function tribe_events_single_event_meta_fix() {
	$event_id = get_the_ID();
	$skeleton_mode = apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, $event_id ) ;
	$group_venue = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, $event_id );
	$html = '';

	if ( $skeleton_mode ) {

		// show all visible meta_groups in skeleton view
		$html .= tribe_get_the_event_meta();

	} else {
		$html .= '
<div class="dotted"></div>
<div class="tribe-events-single-section tribe-events-event-meta tribe-clearfix">';
  // Event Details
  $html .= tribe_get_meta_group( 'tribe_event_details' );
  
  // When there is no map show the venue info up top
  if ( ! $group_venue && ! tribe_embed_google_map( $event_id ) ) {
  // Venue Details
  $html .= tribe_get_meta_group( 'tribe_event_venue' );
  $group_venue = false;
  } else if ( ! $group_venue && ! tribe_has_organizer( $event_id ) && tribe_address_exists( $event_id ) && tribe_embed_google_map( $event_id ) ) {
  $html .= sprintf( '%s
  <div class="tribe-events-meta-group tribe-events-meta-group-gmap">%s</div>
  ',
  tribe_get_meta_group( 'tribe_event_venue' ),
  tribe_get_meta( 'tribe_venue_map' )
  );
  $group_venue = false;
  } else {
  $group_venue = true;
  }
  
  // Organizer Details
  if ( tribe_has_organizer( $event_id ) ) {
  $html .= tribe_get_meta_group( 'tribe_event_organizer' );
  }
  
  $html .= apply_filters( 'tribe_events_single_event_the_meta_addon', '', $event_id );
  $html .= '</div>
';

	}

	if ( ! $skeleton_mode && $group_venue ) {
		// If there's a venue map and custom fields or organizer, show venue details in this seperate section
		$venue_details = tribe_get_meta_group( 'tribe_event_venue' ) .
						 tribe_get_meta( 'tribe_venue_map' );

		if ( !empty($venue_details) ) {
			$html .= apply_filters( 'tribe_events_single_event_the_meta_venue_row', sprintf( '
<div class="dotted"></div>
<div class="tribe-events-single-section tribe-events-event-meta tribe-clearfix">%s</div>
',
				$venue_details
			) );
		}
	}
	return apply_filters( 'tribe_events_single_event_meta', $html );
}
function pp_buttom($subscribe_bt,$b) {
	if($subscribe_bt=='pp_buynow'){
		echo '<a href="'.$b.'"><img alt="'. __('Buy Now Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_subscribe'){
		echo '<a href="'.$b.'"><img alt="'. __('Subscribe Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_donate'){
		echo '<a href="'.$b.'"><img alt="'. __('Donate Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_addtocart'){
		echo '<a href="'.$b.'"><img alt="'. __('Add to cart Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_buygift'){
		echo '<a href="'.$b.'"><img alt="'. __('Buy gift Button', 'cactusthemes').'" class="button_pp buygift" src="https://www.paypalobjects.com/en_US/i/btn/btn_gift_LG.gif" /></a>';
	}
}

add_filter('widget_text', 'do_shortcode');

require_once( get_template_directory() . '/libs/custom-ajax-auth.php' );


add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);

function sb_woo_remove_reviews_tab($tabs) { unset($tabs['reviews']);return $tabs;
}


add_action( 'pre_get_posts', 'hide_my_cat' );
function hide_my_cat( $q ) {
if ( ! $q->is_main_query() ) return;
if ( ! $q->is_post_type_archive() ) return;
if ( ! is_admin() ) { $q->set( 'tax_query', array(array(
    'taxonomy' => 'product_cat',
    'field' => 'slug',
    'terms' => array( 'services' ), // Don't display products in the membership category on the shop page
    'operator' => 'NOT IN'
    )));
}  remove_action( 'pre_get_posts', 'hide_my_cat' );}

 add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
 
function woocommerce_remove_related_products(){
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
add_action('woocommerce_after_single_product_summary', 'woocommerce_remove_related_products');
function woo_remove_tab($tabs) {
    unset($tabs['reviews']);
    unset($tabs['description']);
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_tab', 98);

add_action('woocommerce_checkout_init','disable_billing_shipping');
 
function disable_billing_shipping($checkout){ 
 
 $checkout->checkout_fields['billing']=array();
 $checkout->checkout_fields['shipping']=array();
 return $checkout;
}

function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 ); 
// for product footer 
/* if (function_exists('register_sidebar'))
register_sidebar(array('name' => 'Footer-Widgets','before_widget' => '<div class="footer-item">','after_widget' => '</div>','before_title' => '<h2>','after_title' => '</h2>',));
*/
// for admin bar
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
show_admin_bar(false);
if(!is_admin){
add_action('after_setup_theme', 'remove_admin_bar');
}


//image upload coe in profile
 class simple_local_avatars {
        function simple_local_avatars() {
            add_filter('get_avatar', array($this, 'get_avatar'), 10, 5);
            add_action('admin_init', array($this, 'admin_init'));
            add_action('show_user_profile', array($this, 'edit_user_profile'));
            add_action('edit_user_profile', array($this, 'edit_user_profile'));
            add_action('personal_options_update', array($this, 'edit_user_profile_update'));
            add_action('edit_user_profile_update', array($this, 'edit_user_profile_update'));
            //add_filter('avatar_defaults', array($this, 'avatar_defaults'));
        }
    function get_avatar($avatar = '', $id_or_email, $size = '80', $default = '', $alt = false) {
        if (is_numeric($id_or_email))
            $user_id = (int) $id_or_email;
        elseif (is_string($id_or_email)) {
            if ($user = get_user_by_email($id_or_email))
                $user_id = $user->ID;
        } elseif (is_object($id_or_email) && !empty($id_or_email->user_id))
            $user_id = (int) $id_or_email->user_id;
        if (!empty($user_id))
            $local_avatars = get_user_meta($user_id, 'simple_local_avatar', true);
        if (!isset($local_avatars) || empty($local_avatars) || !isset($local_avatars['full'])) {
            if (!empty($avatar))
                return "<img src='http://www.wrongmag.ru/wp-content/themes/wrongmag/scripts/timthumb.php?src=/uploads/default-avatar.png&amp;w={$size}&amp;h={$size}&amp;zc=1' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            remove_filter('get_avatar', 'get_simple_local_avatar');
            $avatar = get_avatar($id_or_email, $size, $default);
            add_filter('get_avatar', 'get_simple_local_avatar', 10, 5);
            return $avatar;
        }
        if (!is_numeric($size))
            $size = '80';
        if (empty($alt))
            $alt = get_the_author_meta('display_name', $user_id);
        if (empty($local_avatars[$size])) {
            $upload_path = wp_upload_dir();
            $avatar_full_path = str_replace($upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full']);
            $image_sized = image_resize($avatar_full_path, $size, $size, true);
            if (is_wp_error($image_sized))
                $local_avatars[$size] = $local_avatars['full'];
            else
                $local_avatars[$size] = str_replace($upload_path['basedir'], $upload_path['baseurl'], $image_sized);
            update_user_meta($user_id, 'simple_local_avatar', $local_avatars);
        } elseif (substr($local_avatars[$size], 0, 4) != 'http')
            $local_avatars[$size] = site_url($local_avatars[$size]);
        $author_class = is_author($user_id) ? ' current-author' : '';
        $avatar = "<img alt='" . esc_attr($alt) . "' src='" . $local_avatars[$size] . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
        return $avatar;
    }
    function admin_init() {
        load_plugin_textdomain('simple-local-avatars', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        register_setting('discussion', 'simple_local_avatars_caps', array($this, 'sanitize_options'));
        add_settings_field('simple-local-avatars-caps', __('Local Avatar Permissions', 'simple-local-avatars'), array($this, 'avatar_settings_field'), 'discussion', 'avatars');
    }
    function edit_user_profile($profileuser) {
        ?>
        <h3><?php // _e('Avatar', 'simple-local-avatars'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="simple-local-avatar" style="color:#FFFFFF;width: 71%;"><?php _e('Upload Photo', 'simple-local-avatars'); ?></label></th>
                <td style="width: 50px;valign="top">
                    <?php echo get_avatar($profileuser->ID); ?>
                </td>
                <td>
                    <?php
                    $options = get_option('simple_local_avatars_caps');
                    if (empty($options['simple_local_avatars_caps']) || current_user_can('upload_files')) {
                        do_action('simple_local_avatar_notices');
                        wp_nonce_field('simple_local_avatar_nonce', '_simple_local_avatar_nonce', false);
                    ?>
                    <input type="file" name="simple-local-avatar" id="simple-local-avatar" /><br />
                    <?php
                    if (empty($profileuser->simple_local_avatar))
                        echo '<span class="description">' . __('No local avatar is set. Use the upload field to add a local avatar.', 'simple-local-avatars');
                    else
                        echo '<input  style=" width:10%" type="checkbox" name="simple-local-avatar-erase" value="1" />Delete Profile Image ' . __('', 'simple-local-avatars') .  '</span><br />';
                            
                    } else {
                        if (empty($profileuser->simple_local_avatar))
                            echo '<span class="description">' . __('No local avatar is set. Set up your avatar at Gravatar.com.', 'simple-local-avatars') . '</span>';
                        else
                            echo '<span class="description">' . __('You do not have media management permissions. To change your local avatar, contact the blog administrator.', 'simple-local-avatars') . '</span>';
                    }
                    ?>
                </td>
            </tr>
        </table>
        <script type="text/javascript">var form=document.getElementById('your-profile');form.encoding='multipart/form-data';form.setAttribute('enctype','multipart/form-data');</script>
		
        <?php
    }
 

    function edit_user_profile_update($user_id) {
        if (!wp_verify_nonce($_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce'))
            return;
        if (!empty($_FILES['simple-local-avatar']['name'])) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'bmp' => 'image/bmp',
                'tif|tiff' => 'image/tiff'
            );
			
			if ( !function_exists( 'wp_handle_upload' ) )
             require_once( ABSPATH . 'wp-admin/includes/file.php' );

                $this->avatar_delete( $user_id ); // delete old images if successful
           
		  	   $avatar = wp_handle_upload($_FILES['simple-local-avatar'], array('mimes' => $mimes, 'test_form' => false));
			  
			
			
            if (empty($avatar['file'])) {
                switch ($avatar['error']) {
                    case 'File type does not meet security guidelines. Try another.':
                        add_action('user_profile_update_errors', create_function('$a', '$a->add("avatar_error",__("Please upload a valid image file for the avatar.","simple-local-avatars"));'));
                        break;
                    default:
                        add_action('user_profile_update_errors', create_function('$a', '$a->add("avatar_error","<strong>".__("There was an error uploading the avatar:","simple-local-avatars")."</strong> ' . esc_attr($avatar['error']) . '");'));
                }
                return;
            }
            $this->avatar_delete($user_id);
            update_user_meta($user_id, 'simple_local_avatar', array('full' => $avatar['url']));
        } elseif (isset($_POST['simple-local-avatar-erase']) && $_POST['simple-local-avatar-erase'] == 1)
            $this->avatar_delete($user_id);
    }

  /* function avatar_defaults($avatar_defaults) {
        remove_action('get_avatar', array($this, 'get_avatar'));
        return $avatar_defaults;
    }*/

    function avatar_delete($user_id) {
        $old_avatars = get_user_meta($user_id, 'simple_local_avatar', true);
        $upload_path = wp_upload_dir();
        if (is_array($old_avatars)) {
            foreach ($old_avatars as $old_avatar) {
                $old_avatar_path = str_replace($upload_path['baseurl'], $upload_path['basedir'], $old_avatar);
                @unlink($old_avatar_path);
            }
        }
        delete_user_meta($user_id, 'simple_local_avatar');
    }
}
$simple_local_avatars = new simple_local_avatars;   

	
/*Woocommerce Remove Menu*/
add_action( 'admin_menu', 'my_remove_menus');

function my_remove_menus() {
	//remove_submenu_page( 'woocommerce' ,'woocommerce_reports' );
	remove_submenu_page( 'woocommerce' ,'woocommerce_settings' );
 	//remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=model&amp;post_type=product' );
	//remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
	//remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_shipping_class&amp;post_type=product' );
 
}

require_once('includes/program.php');
require_once('includes/exercises.php');
#require_once('includes/dietplan.php');
require_once('includes/diet-plan.php');
//add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
	global $typenow;
	$taxonomy = $typenow.'_type';
	 
	if( $typenow != "page" && $typenow != "post" && $typenow != "diet-plan" && $typenow !="product" ){
		$filters = array($taxonomy);
		#echo"<pre>"; print_r($taxonomy);

		#echo $tax_obj = get_taxonomy($tax_slug);
		#echo"<pre>"; print_r($tax_obj );exit;
		$tax_name = $tax_obj->labels->name;
		 
		foreach ($filters as $tax_slug) {
		
			$tax_obj = get_taxonomy('Category');
			
			$tax_name = $tax_obj->labels->name;
		  
			$terms = get_terms('Category');
			
			echo "<select name='cat'  id='$tax_slug' class='postform'>";
			echo "<option value='0'>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->term_id, $_GET[$taxonomy] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}


function remove_menus(){
 

//remove_menu_page( 'index.php' );                 //Dashboard

remove_menu_page( 'edit.php' );                   //Posts

remove_menu_page( 'upload.php' );                 //Media

//remove_menu_page( 'edit.php?post_type=page' );   //Pages

remove_menu_page( 'edit-comments.php' );         //Comments

//remove_menu_page( 'themes.php' ); 
remove_submenu_page( 'themes.php','themes.php' );   //Appearance


remove_menu_page( 'plugins.php' );               //Plugins

//remove_menu_page( 'users.php' );                 //Users

remove_menu_page( 'tools.php' );                 //Tools

remove_menu_page( 'options-general.php' );       //Settings






 

}


function remove_wp_logo( $wp_admin_bar ) {
	//echo "<pre>";
	//print_r($wp_admin_bar);
	$wp_admin_bar->remove_node( 'wp-logo' ); // Remove wordpress logo from stiky header menu
	$wp_admin_bar->remove_node('comments'); // Remove wordpress comments from stiky header menu
	$wp_admin_bar->remove_node('new-content'); // Remove wordpress new from stiky header menu
	
}
function remove_customize_page(){
	global $submenu;
	//echo "<pre>";
	//print_r($submenu);
	
	unset($submenu['themes.php'][6]); // remove customize link
	unset($submenu['edit.php?post_type=bne_testimonials'][15]); // Remove Testimonial Category
		unset($submenu['edit.php?post_type=bne_testimonials'][16]); // Remove tetimonial Help
	unset($submenu['edit.php?post_type=product'][10]); // Remove Product > Addd Product
	unset($submenu['edit.php?post_type=product'][15]); // Remove Product > Categories
	unset($submenu['edit.php?post_type=product'][18]); // Remove Product > attribute
	//unset($submenu['woocommerce']['3']);
	//unset($submenu['woocommerce']['0']);
}

function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	 #echo  '<pre>';print_r($wp_meta_boxes);exit;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); 
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

function remove_contact_menu () {
global $menu;
	$restricted = array(__('Contact'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
function mytheme_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
function change_howdy_text_toolbar($wp_admin_bar)
{
	$getgreetings = $wp_admin_bar->get_node('my-account');
	$rpctitle = str_replace('Howdy','Welcome',$getgreetings->title);
	$wp_admin_bar->add_node(array("id"=>"my-account","title"=>$rpctitle));
}



 global $dummy_super_admin;
  $dummy_super_admin='prajapatibhavesh07@gmail.com';
  global $hide_dashboard_widget;
 $hide_dashboard_widget = false;

#print_r(get_user_meta(12, $key, $single));
if ( is_user_logged_in()) {
 	   $user_ID = get_current_user_id();  
       $user_info = get_userdata($user_ID);
	   
		if($dummy_super_admin != $user_info->data->user_email){
		 $hide_dashboard_widget = true;
			add_action( 'admin_menu', 'remove_menus' );
			add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
			add_action( 'admin_menu', 'remove_customize_page');
			add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
			add_filter( 'contextual_help', 'mytheme_remove_help_tabs', 999, 3 );
			add_filter('admin_bar_menu','change_howdy_text_toolbar');
			add_filter('bulk_actions-edit-product','my_custom_bulk_actions'); // Remove Bulk Action filter for Product
			if($_GET['post_type'] == 'product')
			{
			add_filter('months_dropdown_results', 'my_custom_bulk_actions', 99); // Remove Date-Monthe Filter for Product
			}
			remove_action( 'restrict_manage_posts','woocommerce_products_by_category');//Remove Category Fildter for Product
			remove_action( 'restrict_manage_posts', 'woocommerce_products_by_type');//Remove Type Fildter for Product
			
			$role_object = get_role( 'shop_manager' );

			// add $cap capability to this role object
			$role_object->add_cap( 'edit_theme_options' );
			/*remove_submenu_page('themes.php','themes.php'); 
			 global $submenu;
            unset($submenu['themes.php'][6]);
            
            remove_menu_page('tools.php');
            remove_menu_page('plugins.php');
            remove_menu_page('options-general.php');*/
			/*contact*/
			add_action('admin_menu', 'remove_contact_menu');
			if(!current_user_can('level_10')) {
				add_action('admin_menu', 'remove_contact_menu');
			}
			/*contact*/
			 if (!current_user_can('manage_options')) {
				add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
			}
			global $pagenow;
if( 'edit.php' == $pagenow && isset($_GET['page_type']) == 'exercises , program' ){
     // here i use delete post row function that explained by Maruti Mohanty on my custom post 
}

global $pagenow;
if ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) {
    add_action( 'admin_head', 'wpse_125800_custom_publish_box' );
    function wpse_125800_custom_publish_box() {
        if( !is_admin() )
            return;

        $style = '';
        $style .= '<style type="text/css">';
        $style .= '#edit-slug-box, #minor-publishing-actions, #visibility, .num-revisions, .curtime';
        $style .= '{display: none; }';
        $style .= '</style>';
        echo $style;
    }
}
		}
}
/*Rename woocmmerce tab*/
add_action( 'admin_menu', 'rename_woocoomerce_wpse_100758', 999 );

function rename_woocoomerce_wpse_100758() 
{
    global $menu;
	
    // Pinpoint menu item
    $woo = recursive_array_search_php_91365( 'WooCommerce', $menu );
	
    // Validate
    if( !$woo )
        return;

    $menu[$woo][0] = 'Training Programs ';
	
}

function recursive_array_search_php_91365( $needle, $haystack ) 
{
    foreach( $haystack as $key => $value ) 
    {
        $current_key = $key;
        if( 
            $needle === $value 
            OR ( 
                is_array( $value )
                && recursive_array_search_php_91365( $needle, $value ) !== false 
            )
        ) 
        {
            return $current_key;
        }
    }
    return false;
}
///////////////////////////////////Dhaval////////////////////////////

function my_custom_login_logo()
{
    echo '<style  type="text/css"> h1 a {  background-image:url(' . get_bloginfo('template_directory') . '/images/logo.png)  !important; } </style>';
}
add_action('login_head',  'my_custom_login_logo');

// Admin footer modification
 
function remove_footer_admin () 
{
    echo '<span id="footer-thankyou">Developed by <a href="http://cleaverfitness.com" target="_blank">eVenzia</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
//add_filter('screen_options_show_screen', '__return_false');

// Below function use to remove Parent & Description fields from type & category of diat plan
function wpse_58799_remove_parent_category()
{
	
    // don't run in the Tags screen
    if ( ('diet-plan-category' != $_GET['taxonomy']) && ('diet-plan-type' != $_GET['taxonomy']) )
	        return;
	
	

    // Screenshot_1 = New Category
    // http://example.com/wp-admin/edit-tags.php?taxonomy=category
    $parent = 'parent()';
	

    // Screenshot_2 = Edit Category
    // http://example.com/wp-admin/edit-tags.php?action=edit&taxonomy=category&tag_ID=17&post_type=post
    if ( isset( $_GET['action'] ) )
        $parent = 'parent().parent()';
		
		

    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {     
                $('label[for=parent]').<?php echo $parent; ?>.remove();
                $('label[for=tag-description]').<?php echo $parent; ?>.remove();
                $('label[for=description]').<?php echo $parent ; ?>.remove();         
            });
        </script>
    <?php
}
add_action( 'admin_head-edit-tags.php', 'wpse_58799_remove_parent_category' );

//Remove bulk Action dropdown
 function my_custom_bulk_actions($actions){
	 
       return array();
    }

