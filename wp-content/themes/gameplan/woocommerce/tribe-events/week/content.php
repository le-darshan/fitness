<?php
/**
 * Week View Content
 * The content template for the week view. This template is also used for
 * the response that is returned on week view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/week/content.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<div id="tribe-events-content" class="tribe-events-week-grid">
	
	<!-- Calendar Title -->
	<?php do_action( 'tribe_events_before_the_title') ?>
	<h2 class="tribe-events-page-title"><?php tribe_events_title() ?></h2>
	<?php do_action( 'tribe_events_after_the_title') ?>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<!-- Calendar Header -->
	<?php do_action( 'tribe_events_before_header') ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes('week-header') ?>>

		<!-- Header Navigation -->
		<?php tribe_get_template_part('week/nav', 'header'); ?>

	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header') ?>

	<?php
	global $detect;
	if($detect->isMobile()) {
						?>
                        <style>
                        #tribe-events-mobile-template{display:block}
                        </style>
                        <?php
							// if on mobile, grid should not be shown
							// don't know what to do here, so leave it blank!
						} else { ?>

	<!-- Calendar Grid -->
	<?php tribe_get_template_part('week/loop', 'grid') ?>

	<!-- Calendar Footer -->
	<?php do_action( 'tribe_events_before_footer') ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part('week/nav', 'footer'); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>
	</div><!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer') ?>
	
	<?php 
	} // end if is not mobile
	?>
	
	<div id="tribe-events-mobile-template">		
		<?php //tribe_get_template_part( 'week/loop', 'grid-allday' ); ?>
		
		<?php tribe_events_week_set_loop_type( 'allday' ); ?>
		
		<?php while ( tribe_events_week_have_days() ) : tribe_events_week_the_day(); tribe_events_week_reset_the_day_map(); ?>		
			<?php foreach ( tribe_events_week_get_all_day_map() as $all_day_cols ) : tribe_events_week_the_day_map(); ?>
				<?php tribe_get_template_part( 'list/single-event_week_allday_mob'); ?>
			<?php endforeach; ?>		
		<?php endwhile; ?>
		
		<?php tribe_events_week_set_loop_type( 'hourly' ); ?>
		<?php while ( tribe_events_week_have_days() ) : 
				tribe_events_week_the_day(); ?>
			<?php foreach ( tribe_events_week_get_hourly() as $event ) : if ( tribe_events_week_setup_event( $event ) ) : ?>
				<?php tribe_get_template_part( 'list/single-event_week_hourly_mob'); ?>
			<?php endif; endforeach; ?>
		<?php endwhile; ?>
		
		<?php		
			echo '<div id="tribe-events-mobile-nav">';
					tribe_get_template_part( 'month/nav' );
				echo '</div>';
		?>		
	</div>
	
</div><!-- #tribe-events-content -->