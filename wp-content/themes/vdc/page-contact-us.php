<?php 
/*
* Template Name: Contact Us
*/
get_template_part( 'template-parts/include', 'header' ); 
$title = get_field('hide_title'); 
$event_blog_block = get_field('events_blog');
$has_underline = get_field('title_underline');
$title_icon = get_field('title_icon');
?>

<div class="wb-white-bg">
	<div class="container">
		<div class="row">
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
		</div>
		<div class="row">
			
			<div class="col-md-8">
				<div class="vdc-contact-details">
					<div class="vdc-contact-details-left">
						<?php 
						$tel = get_field('phone_number', 'option'); 
						$tel_link = str_replace(' ', '', $tel);?>
						<a href="tel:<?php echo $tel_link ?>">
							<strong>Tel: </strong>
							<?php echo $tel ?>
						</a>

						<?php $mail = get_field('email_address', 'option'); ?>
						<a href="mailto:<?php echo $mail ?>">
							<strong>Email: </strong>
							<?php echo $mail ?>
						</a>
					</div>
					
					<?php vdc_social_link_plain(); ?>

				</div>

				<!-- Tabs -->
				<div>

					 <!-- Nav tabs -->
					<ul class="contact-us-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#get_in_touch" aria-controls="get_in_touch" role="tab" data-toggle="tab">Get in Touch</a></li>
						<li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="get_in_touch">
							<?php gravity_form(1, false, false, false, '', true, 12); ?>
						</div>
						<div role="tabpanel" class="tab-pane" id="comments">
							<?php gravity_form(2, false, false, false, '', true, 12); ?>
						</div>
					</div>

				</div>

			</div>

			<div class="col-md-4">
				<?php $location = get_field('hq_office_location', 'option'); ?>

				<div class="vdc-written-address">
					<p class="text-center">
					<?php 
						// echo $location['address']; 
						$address = $location['address'];

						$address = explode( ',', $address);
						echo $address[0].', <br />';
						echo $address[1].', ';
						echo $address[2].', ';
						echo $address[3];
					?>
					</p>
				</div>

				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php get_footer(); ?>