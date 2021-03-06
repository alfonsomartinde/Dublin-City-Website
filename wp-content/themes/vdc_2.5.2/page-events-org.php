<?php 
/*
* Template Name: Events (Org)
*/
get_template_part( 'template-parts/include', 'header' ); ?>
	
	<div class="container events">
		<h1 class="text-center"><span class="icon icon-weekend"></span><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
	<div class="whats-on-listings">

	<div class="container">

	<?php 
		$event_args = array(
			'post_type' => 'orgevent',
			'order' => 'ASC',
		);
		$event_query = new WP_Query( $event_args );
	?>
	<?php if ( $event_query->have_posts() ): ?>

		<?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
			<?php
				$date_time = get_field('date_time');
				$dt_arr = explode(" ", $date_time);
			?>
			
			<div class="row item">
				<div class="col-md-4">
					<figure>
						<a href="<?php echo the_permalink(); ?>" class="link-arrow-pink">See more</a>
						<?php the_post_thumbnail('medium'); ?>
					</figure>
				</div>
				<div class="col-md-8">
					<a href="<?php echo the_permalink(); ?>" class="title-link"><h2><?php the_title(); ?></h2></a>
					<hr>
					<?php if ( !empty($date_time) ): ?>
						<i><?php echo $dt_arr[0] . ' the ' . $dt_arr[1] . ' of ' . $dt_arr[2] . ', ' . $dt_arr[3];  ?></i>
					<?php endif; ?>
					<div><p><?php echo wbstarter_excerpt(30); ?></p></div>
				</div>
			</div>

		<?php endwhile; wp_reset_query();?>

		<?php else : ?>

			<h2 class="center">Sorry, no events in this category</h2>

		<?php endif; ?>
	
	</div>

</div>

<?php get_footer(); ?>