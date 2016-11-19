<?php 
// get cookie details
$parent_page = $_COOKIE["page_name"];
?>
<div class="vdc-nav-top-blocks">
	<!-- General Menu -->
	<?php get_template_part( 'template-parts/nav/nav', 'general-menu' ); ?>
	<!-- CTA -->
	<div class="vdc-cta-menu">
		<?php if ( $parent_page == 'vol' ): ?>

			<a href="<?php echo esc_url( home_url('/search-ivol') ); ?>">Search <strong>iVOL</strong> <i class="fa fa-search"></i></a>

		<?php elseif ( $parent_page == 'org' ): ?>
			
			<a href="<?php echo esc_url( home_url('/post-an-opportunity/') ); ?>">Post an <strong>opportunity</strong> <i class="fa fa-plus"></i></a>

		<?php else: ?>
			
		<?php endif ?>
		
	</div>
	<!-- Social -->

	<div class="vdc-social-top">
		<?php vdc_social_link_plain('list-inline', true); ?>
		<!-- <ul class="list-inline">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-envelope"></i></a></li>
		</ul> -->
	</div>
</div>
