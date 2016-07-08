<!-- Sidebar -->
<aside class="col-sm-3 col-sm-offset-1 blog-sidebar">

	<?php dynamic_sidebar( 'adwords-widget' ); ?>

	<div class="sidebar-module sidebar-module-inset">

		<!-- Zdjęcie profilowe -->
		<img class="profile-photo" src="<?php echo AUTHOR_PHOTO_LINK; ?>" alt="autorka-profilowe" width="100">

		<!-- Opis autorki -->
		<p class="profile-description"><?php echo AUTHOR_DESCRIPTION; ?></p>

		<!-- Ikonki social media -->
		<section class="social-icons sidebar">
			<a href="<?php echo FACEBOOK_LINK; ?>"><span class="fa fa-facebook"></span></a>
			<a href="<?php echo TWITTER_LINK; ?>"><span class="fa fa-twitter"></span></a>
			<a href="<?php echo INSTAGRAM_LINK; ?>"><span class="fa fa-instagram"></span></a>
		</section>

		<section class="instagram-sidebar">
			<div class="category-border sidebar"></div>
			<?php dynamic_sidebar(); ?>
		</section>

	</div>
</aside>	<!-- /.blog-sidebar -->
