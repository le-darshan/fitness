<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<?php if(ot_get_option( 'responsive', 0)){ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php } ?>
		<script type="text/javascript">
			_THEME_URL_ = "<?php echo get_stylesheet_directory_uri(); ?>";
		</script>
		<title>
			<?php 
			$headings = get_tribe_events_page_heading();
			if($headings !== false){
				echo strip_tags($headings[0]);
			} elseif(is_404()&&ot_get_option('page404_title',false)){
				echo ot_get_option('page404_title','Page not found'); 
			}
			else {
				wp_title( '|', true, 'right' ); 
			}
			?>
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if(ot_get_option('favicon')):?>
			<link rel="shortcut icon" href="<?php echo ot_get_option('favicon');?>">
		<?php endif;?>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<script type="text/javascript">
			var is_isotope = false;
			<?php if(ot_get_option('portfolio_animation') == 'isoptope'):?> is_isotope = true; <?php endif;?>
		</script>
		<?php
		if(is_active_sidebar('main_top')){
			$background = ot_get_option('background_slider');
			$back1=isset($background['background-image'])?$background['background-image']:'';
			$back2=isset($background['background-color'])?$background['background-color']:'';
			if($back1!='' || $back2!='')	{
		?>
		
		<style type="text/css" >
			#slider{
				<?php if(isset($background['background-image'])){?>background:<?php echo $background['background-color'];?> url(<?php echo $background['background-image'];?>) <?php echo $background['background-attachment'];?> center 0 <?php echo $background['background-repeat'];?>;background-size:cover<?php }?>
			}
		</style>
		<?php
			}
		}
		?>
<?php if(ot_get_option('retina_logo')):?>
<style type="text/css" >
	@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
		/* Retina Logo */
		.logo{background:url(<?php echo ot_get_option('retina_logo'); ?>) no-repeat center; display:inline-block !important; background-size:contain;}
		.logo img{ opacity:0; visibility:hidden}
		.logo *{display:inline-block}
	}
</style>
<?php endif;?>

<?php wp_head(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
 
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->						
<link href='http://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
</head>
<?php
$body_class = '';
$body_class .= ot_get_option( 'theme_style') == 'dark' ? 'light dark ' : 'light ';
$body_class .= ot_get_option( 'layout', false) ? ot_get_option( 'layout' ).' ' : '';
$body_class .= ot_get_option( 'responsive', 1) ? '' : 'no-responsive ';
if(is_page_template('page-templates/front-page.php')){
	$body_class .= 'home ';
	$revslider = get_post_meta($post->ID,'revslider',true);
	$body_class .= ($revslider == '') ? 'use-maintop-sidebar ' : '';
}else{
	$body_class .= (ot_get_option('slider_section','noslider') == 'noslider') ? ((!is_active_sidebar('main_top'))?'noslider':'use-maintop-sidebar') : '';
}
global $default_color;
$default_color = ot_get_option( 'main_color')?ot_get_option( 'main_color'):(ot_get_option( 'theme_style') == 'dark' ? '#ffd600' : '#ee4422');
?>
<body <?php body_class($body_class) ?>>
<a name="top" style="height:0; position:absolute; top:0;"></a>
	<div class="clear"></div>
    <header>
        <?php get_template_part( 'header', 'navigation' ); // load header-navigation.php ?>
		<?php 			
			if(is_home() || is_front_page() || is_page_template('page-templates/front-page.php')){
				get_template_part( 'header', 'frontpage' ); // load header-frontpage.php
			} /*else if(is_search()){
				get_template_part( 'header', 'search' ); // load headersearch-single.php
			}*/
			else{
				get_template_part( 'header', 'single' ); // load header-single.php
			}?>
    </header>
    <div class="clear"></div>
    <div id="body">
    	<div id="wrapper">      
<script type="text/javascript">
jQuery(document).ready(function($){
var location = window.location.pathname;
	$(function() {
    $(".navigation a").each(function(){
        if($(this).attr("href") == window.location.pathname || window.location.pathname == '')
		$(this).parent().addClass("active");
    })
});
});
</script>