<?php 
/*
* Template Name: Events
*/
get_template_part( 'template-parts/include', 'header' ); ?>


<?php 

	// get events after today 
	$today = date('Ymd');
	$event_args = array(
		'post_type' => 'volunteerevent',
		
		'meta_key'	=> 'date',
		'orderby'	=> 'meta_value_num',
		'order'		=> 'ASC',
		
		'meta_query' => array(
			array(
				'key'		=> 'date',
				'compare'	=> '>=',
				'value'		=> $today,
			)
		),
	);
	$event_query = new WP_Query( $event_args );
?>


	
	<div class="container events">
		<h1 class="text-center"><span class="icon icon-weekend"></span><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
	<div class="whats-on-listings">

	<div class="container">

	<?php if ( $event_query->have_posts() ): ?>

		<?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
			<?php
				$rawDate = get_field('date', false, false);
				$date = new DateTime($rawDate);
			?>
			
			<div class="row item">
				<div class="col-md-4">
					<figure>
						<a href="<?php echo the_permalink(); ?>" class="link-arrow-pink">See more</a>
						<?php the_post_thumbnail('medium'); ?>
					</figure>
				</div>
				<div class="col-md-8 v-align-p">
					<a href="<?php echo the_permalink(); ?>" class="title-link">
						<div class="v-align-child date_component mr2 <?php echo 'date-' . $class;?>">
							<p>
								<span>
									<strong><?php echo $date->format('j');?></strong>
								</span>
								<span><?php echo $date->format('M');?></span>
							</p>
						</div>
						
						<h2 class="inline-block v-align-child mb0 pl1-2">
							<?php the_title(); ?>
						</h2>
					</a>
					
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