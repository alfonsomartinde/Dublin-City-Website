<?php 
// get cookie details
$parent_page = $_COOKIE["page_name"];
// vars
$logo_header = get_field('logo_header', 'options');
?>
<a class="vdc-logo-lrg" href="<?php echo home_url('/' . $parent_page); ?>" alt="<?php echo $parent_page ?>">

  	<?php if ( !empty($logo_header) ): ?>
	
		<img src="<?php echo $logo_header['url']; ?>" alt="<?php echo $logo_header['alt']; ?>">	

	<?php else: ?>
  	
            <?php bloginfo('name'); ?>

        <?php endif; ?>
 </a>