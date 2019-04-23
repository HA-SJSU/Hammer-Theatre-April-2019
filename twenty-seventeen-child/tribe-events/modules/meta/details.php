<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */


$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$event_id = Tribe__Main::post_id_helper();

/**
 * Returns a formatted time for a single event
 *
 * @var string Formatted time string
 * @var int Event post id
 */
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );

/**
 * Returns the title of the "Time" section of event details
 *
 * @var string Time title
 * @var int Event post id
 */
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time:', 'the-events-calendar' ), $event_id );

$cost = tribe_get_formatted_cost();
$website = tribe_get_event_website_link();

$review = get_post_meta($event_id, 'Reviews', true);
$review_author = get_post_meta($event_id, 'Reviews_Author', true);
$review_url = get_post_meta($event_id, 'Reviews_URL', true);


/*
 * Here, I am getting the category in String
 * Determining the following:
 * - the color of "learn more" button
 * based on the category
 */
// This function "tribe_get_text_categories();"
// is custom function in the `twenty-seleventeen-child/function.php`
// For more detail go to there and please read the doc there. Thank you!
$category_text = tribe_get_text_categories();
$category_color = tribe_get_color_for_categories($category_text);

?>

<div class="tribe-events-meta-group tribe-events-meta-group-details" style="background-color: var(<?php echo $category_color ?>);">
	<h2 class="tribe-events-single-section-title"> <?php esc_html_e( 'Dates', 'the-events-calendar' ) ?> </h2>
	<dl>

		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>

			<dt> <?php esc_html_e( 'Start:', 'the-events-calendar' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr tribe-events-start-datetime published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_date ) ?> </abbr>
			</dd>

			<dt> <?php esc_html_e( 'End:', 'the-events-calendar' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php esc_attr_e( $end_ts ) ?>"> <?php esc_html_e( $end_date ) ?> </abbr>
			</dd>

		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			?>

			<dt> <?php esc_html_e( 'Date:', 'the-events-calendar' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr tribe-events-start-datetime published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_date ) ?> </abbr>
			</dd>

		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			?>

			<dt> <?php esc_html_e( 'Start:', 'the-events-calendar' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_datetime ) ?> </abbr>
			</dd>

			<dt> <?php esc_html_e( 'End:', 'the-events-calendar' ) ?> </dt>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php esc_attr_e( $end_ts ) ?>"> <?php esc_html_e( $end_datetime ) ?> </abbr>
			</dd>

		<?php
		// Single day events
		else :
			?>
                        <!--
                        <div class="event-detail">
                                <?php esc_html_e( $start_date ) ?> @ <?php echo $time_formatted; ?>
                        </div>
                        Original -->

                        <div>
                        	<?php if ( tribe_is_recurring_event($event_id) ): ?>
                             	<?php show_recurring_dates( $event_id, false, true ); ?>
                                <?php show_recurring_dates( $event_id); ?>
                       		 <?php else : ?>
                                <div class="event-detail">
                                        <?php esc_html_e( $start_date ) ?> @ <?php echo $time_formatted; ?>
                                </div>
                        <?php endif ?>
                        </div>

		<?php endif ?>

		<?php
		// Event Cost
		if ( ! empty( $cost ) ) : ?>
			<div class="tribe-events-event-cost"> <?php esc_html_e( $cost ); ?> </div>
		<?php endif ?>

                <!-- Render ticket link in single event page -->
                <?php
                        $is_past = tribe_is_past_event($event_id);
                        $ticket_type = get_field('ticket_type');
                        $ticket_url = get_field('ticket_url');
             
                        if ($ticket_type != 'free' && $ticket_type != 'reserved' && !$is_past) { ?>
                                <a href="<?php echo $ticket_url; ?>" class="button single-event-buy-ticket-button-container" style="color: var(<?php echo $category_color ?>);">BUY TICKETS </a>
                        <?php
                        }

                        else if ($ticket_type == 'reserved' && !$is_past) { ?>
                        		<a href="<?php echo $ticket_url; ?>" class="button single-event-buy-ticket-button-container" style="color: var(<?php echo $category_color ?>);">RESERVE TICKETS</a>
                        <?php
                        } 

                     
                        else if ($ticket_type == 'free' && !$is_past) { ?>
                     
                        	<span><h4 class="free-event" style="margin-top: 5px; font-size: 1.6rem; font-weight: bold;  ;">This is a free event.</h4></span>
                        <?php
                    	}
                    	else
                    	{
                    		
                    	}
                        ?>
		<?php

		// Event Website
		if ( ! empty( $website ) ) : ?>
			<br>
			<dt> <?php esc_html_e( 'Website:', 'the-events-calendar' ) ?> </dt>
			<dd class="tribe-events-event-url" style="color: white !important;"> <?php echo $website; ?> </dd>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</dl>
</div>


<?php 
if ($review && $review_author && $review_url) {
	echo '<div class="tribe-events-meta-group tribe-events-meta-group-details" style="background-color: var('.$category_color.');">';
		echo '<h2 class="tribe-events-single-section-title"> Reviews/Articles </h2>';
		echo '<dl>';

			do_action( 'tribe_events_single_meta_details_section_start' );
			echo '<span><em>"'.$review.'"</em></span>';
			echo '<span> — <strong>'.$review_author.'</strong></span><br>';
			echo '<span style="color: white !important;"><a target="_blank" href="'.$review_url.'">Read full review here</em></span><br>';

			do_action( 'tribe_events_single_meta_details_section_end' );

		echo '</dl>';
	echo '</div>';
}

?>




