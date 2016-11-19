<?php if ( get_row_layout() == 'dublin_ops' ) : ?>
	<div class="wb-white-bg">
		<div class="container vdc-box-links">
	
			<?php while(have_rows('links')) : the_row(); ?>
			
				<a href="<?php the_sub_field('link'); ?>" class="vdc-get-started-link vdc-get-started-link-blue vdc-can-i-volunteer-link-box">
					<?php 
						$icon = get_sub_field('icon');
					?>
					<i class="icon icon-<?php echo $icon; ?>"></i>
					<p><?php the_sub_field('title'); ?></p>
				</a>
			
			<?php endwhile; ?>

		</div>
	</div>
<?php endif; ?>