<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19209293-2', 'auto');
  ga('send', 'pageview');
// WEBBIZ
ga('create', 'UA-82657092-1', 'auto', {'name': 'newTracker'});	 
ga('newTracker.send', 'pageview');
</script>
		<?php wp_head(); ?>
	</head>
	<?php 
	// Vars
		$bg_img_bkup = get_field('fall_back_background_image', 'options');
		$bg_img = get_the_post_thumbnail_url();
	?>
	<body <?php body_class('animated fadeIn'); ?>>			
		
		<!-- Page Header -->
		<header id="org-home" data-img="<?php echo ( !empty($bg_img) ? $bg_img : $bg_img_bkup['url']);?>">
			<!-- Navigation -->
			<?php get_template_part( 'template-parts/nav/nav', 'top' ); ?>
			<div class="header-content-wrapper">
				<h1>Recruit a Volunteer</h1>
				<a href="<?php echo esc_url( home_url('/org/get-started-org/') ); ?>" class="home-cta">Get Started</a>
			</div>
		</header>
		<?php get_template_part( 'template-parts/nav/nav', 'mobile' ); ?>
		<main>
		
		
		
