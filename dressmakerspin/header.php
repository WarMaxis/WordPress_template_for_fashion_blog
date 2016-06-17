<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<title><?php wp_title(''); ?> - DressMaker's Pin</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(isset($class) ? $class : ''); ?>>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo get_bloginfo('template_directory');?>/images/logo.svg" width="240"></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse">
			<?php wp_nav_menu( array('menu' => 'Main', 'menu_class' => 'nav navbar-nav navbar-right', 'depth'=> 3, 'container'=> false, 'walker'=> new Bootstrap_Walker_Nav_Menu)); ?>
		</div><!-- /.navbar-collapse -->

	</div>	<!-- /.container-fluid -->
</nav>

<div class="category-menu">
	<ul class="category-list">

		<!-- Lista kategorii -->
		<li><a href="shopping.html">shopping</a></li>
		<li><a href="mohito.html">mohito</a></li>
		<li><a href="trends.html">trendy</a></li>
		<li><a href="conflicts.html">konflikty sąsiedzkie</a></li>

	</ul>

	<!-- Ikonki social media -->
	<div class="social-icons">

		<a href="https://www.facebook.com/"><span class="fa fa-facebook"></span></a>
		<a href="https://twitter.com/"><span class="fa fa-twitter"></span></a>
		<a href="https://www.instagram.com/"><span class="fa fa-instagram"></span></a>

	</div>

	<div class="category-border"></div>

</div>
