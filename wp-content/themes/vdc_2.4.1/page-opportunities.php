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
				'orderby'			=> 'activity',
				'order'				=> 'ASC',
				
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
				'orderby'			=> 'activity',
				'order'				=> 'ASC',
				
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
				'orderby'			=> 'activity',
				'order'				=> 'ASC',
				
				'meta_key'		=> 'latest',
				'meta_value'	=> true
			);
		}
		
		$posts = get_posts($args);
		
		$activities = array();
		foreach( $posts as $post ){ 
			array_push($activities, get_field("activity"));
		}
		$activities = array_unique($activities);
		asort($activities);
		
		?>
		
		
		<? // because "50+ Opportunities" dosen't sound right 
		if ($current_opp_activity === '50+'){ ?>
			<h1 class="text-center blue">Opportunities <? echo $current_opp_activity; ?></h1>
		<? } else { ?>
			<h1 class="text-center blue"><? echo $current_opp_activity; ?> Opportunities</h1>
		<? } ?>
		
		
		<section class="opportunities">
		
		<?php 
		
		if( $posts ): ?>
			
			<?php 
			
			foreach( $activities as $activity ){ ?>
				<span class="icon icon-<? echo $activity; ?> opportunity-title-icon"></span>
				<h2 class="opportunity-title line-after">
					<span>
					<? 
						$field = get_field_object('field_58d3cc32553ef');
						$value = get_field('activity');
						echo $field['choices'][ $activity ];
					?></span>
				</h2>
			<?
			
				foreach( $posts as $post ): 
					
					setup_postdata( $post );
					
					// if the current post is the current activity
					if(get_field('activity') == $activity ){
					
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
										<div class="col-xs-6 col-sm-3 col-md-6 opp_out"> 
											<a class="opp_category" aira-label="<? echo $value;?>"
												href="<? echo home_url(add_query_arg(array(),$wp->request)); ?>?c=<? echo $value; ?>">
												<i class="opp_tooltip icon icon-<? echo $value; ?> " 
													aria-hidden="true" role="presentation" 
													data-title="<? echo $value;?>"></i>
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
								<div class="col-xs-12 col-md-1 sub-item view">
									<a href="<? the_field("ivol_link"); ?>" target="_blank" ><span>View</span></a>
								</div>
							</div>
						</div>
					</div>
				
				<?php 
				} // if it's the relevant activity 
				endforeach; // posts
				} // activites loop
			?>
			
			
			<?php wp_reset_postdata(); ?>
		
		<?php endif; ?>
		</div>
	</section>
		
	
	<?php wp_reset_postdata(); ?>
	
</div>

<?php get_footer(); ?>