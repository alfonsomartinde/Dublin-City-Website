<?php 
/*
* Template Name: Events
*/
get_template_part( 'template-parts/include', 'header' ); ?>

<div class="container events">
		<?
			$args = array(
				'numberposts'		=> -1,
				'post_type'			=> 'opp',
				'ignore_sticky_posts' => 1
			);
			
			$loop = new WP_Query( $args );
			
			
			$opp_categories = array();
			while ( $loop->have_posts() ) : $loop->the_post(); 
				array_push($opp_categories, get_field_object("opp_category"));
			endwhile; 
			
			$dub_locations = array();
			while ( $loop->have_posts() ) : $loop->the_post(); 
				array_push($dub_locations, get_field_object("dub_location"));
			endwhile; 
			
			$opp_category = $_GET['c']; 
			
			$dub_location = $_GET['l']; 
			
			
			
		if ($opp_category){
			$current_opp_activity = $opp_categories[0]["choices"][$opp_category];
			
			$args = array(
				'numberposts'		=> -1,
				'post_type'			=> 'opp',
				'ignore_sticky_posts' => 1,
				'paged'					=> $paged,
				
				'meta_query'		=> array(
					array(
						'key'					=> 'opp_category',
						'value'				=> $opp_category,
						'compare' => 'LIKE',
					),
				),
			);
		} elseif ($dub_location) {
			$current_opp_activity = $dub_locations[0]["choices"][$dub_location];
			
			$args = array(
				'numberposts'		=> -1,
				'post_type'			=> 'opp',
				'ignore_sticky_posts' => 1,
				'paged'					=> $paged,
				
				'meta_query'		=> array(
					array(
						'key'					=> 'dub_location',
						'value'				=> $dub_location,
						'compare' => 'LIKE',
					),
				),
			);
		} else { 
			$current_opp_activity = "Latest";
			
			$args = array(
				'numberposts'		=> -1,
				'post_type'			=> 'opp',
				'ignore_sticky_posts' => 1,
				'paged'					=> $paged,
				
				'meta_key'		=> 'latest',
				'meta_value'	=> true
			);
		}
		
		$loop = new WP_Query( $args );
		$activities = array();
		while ( $loop->have_posts() ) : $loop->the_post(); 
			array_push($activities, get_field("activity"));
		endwhile; 
		?>
		
		
		<? // because "50+ Opportunities" dosen't sound right 
		if ($current_opp_activity === '50+'){ ?>
			<h1 class="text-center blue">Opportunities <? echo $current_opp_activity; ?></h1>
		<? } else { ?>
			<h1 class="text-center blue"><? echo $current_opp_activity; ?> Opportunities</h1>
		<? } ?>
		
		
		<section class="opportunities">
		
		
		<?php 
		$posts = get_posts(array(
			'post_type'			=> 'opp',
			'posts_per_page'	=> -1,
			'meta_query'		=> array(
				array(
					'key'				=> 'opp_category',
					'value'				=> $opp_category,
					'compare' => 'LIKE',
				)
			),
			
			'meta_key'			=> 'activity',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC'
		));

		if( $posts ): ?>
			
			<?php 
			
			$prev_activity = '';
			foreach( $posts as $post ): 
				
				setup_postdata( $post );
				
				$the_activity = get_field('activity');
				
				 if ($the_activity != $prev_activity) { ?>
					<span class="icon icon-<? the_field('activity'); ?> opportunity-title-icon"></span>
					<h2 class="opportunity-title line-after">
						<span>
						<? 
							$field = get_field_object('field_58d3cc32553ef');
							$value = get_field('activity');
							echo $field['choices'][ $value ];
						?></span>
					</h2>
				<? } 
				?>
				
				<div class="opportunities">

				<div class="opps-item">
					<div>
						<div class="row opportunity-item">
							<div class="col-xs-6 col-md-3 sub-item">
								<h5>Opportunity</h5>
								<p>
									<? the_title(); ?>
								</p>
							</div>
							<div class="col-xs-6 col-md-2 sub-item">
								<? $opp_category = get_field('opp_category');
									foreach ($opp_category as $key => $value) { ?>
									<div class="col-xs-6 col-sm-3 col-md-6"> 
										<a class="opp_category" href="<? echo home_url(add_query_arg(array(),$wp->request)); ?>?c=<? echo $value; ?>">
											<i class="icon icon-<? echo $value; ?> " tooltips tooltip-template="<? echo $value; ?>"></i>
										</a>
									</div>
								<? } ?>
							</div>
							<div class="clearfix visible-xs visible-sm"></div>
							<div class="col-xs-6 col-md-3 sub-item">
								<h5>Organisation</h5>
								<p>
									<? the_field("organisation"); ?>
								</p>
							</div>
							<div class="col-xs-6 col-md-3 sub-item location">
								<h5>Location</h5>
								<a href="http://maps.google.com/maps?z=12&t=m&q=loc:<? echo get_field("location")['lat']; ?>+<? echo get_field("location")['lng']; ?>" target="_blank">
									<? the_field("location_text"); ?>
								</a>
							</div>
							<style>
								@media screen and (min-width: 992px) {
									.opportunity-item{
										overflow: hidden
									}
									.view a{
										z-index: 10;
										height: 5em; 
										margin-top: 0; 
										left: .845em;
										position: relative;
									}
									.view a:after{
										content: '';
										bottom: -100%;
										right: 0;
										left: 0;
										top: 0;
										background: #e00d7b;
										display: block;
										position: absolute;
										z-index: -1;
									}
								}
								@media screen and (max-width: 992px) {
									.view a{
										top: 0  !important;
										left: -1em !important;
										position: relative !important;
										margin-top: .75em
									}
									.view a span{
										position: static !important
									}
									.view a span:after{
										position: relative !important;
										padding-left: .5em;
										top: .2em !important;
									}
								}
							</style>
							<div class="col-xs-12 col-md-1 sub-item view">
								<a href="<? the_field("ivol_link"); ?>" target="_blank" ><span>View</span></a>
							</div>
						</div>
					</div>
				</div>
			
			<?php 
				$prev_activity = get_field('activity');
				endforeach; 
			?>
			
			
			<?php wp_reset_postdata(); ?>
		
		<?php endif; ?>
					</div>	
		</section>
		
	
	<?php wp_reset_postdata(); ?>
	
</div>

<?php get_footer(); ?>