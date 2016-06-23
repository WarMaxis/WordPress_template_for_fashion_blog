<footer class="blog-footer2">
	<div class="footer-container">

		<!-- Opis stopki -->
		<div class="footer-credits">
			<p><a href="<?php echo home_url(); ?>"><img src="<?php echo get_bloginfo('template_directory');?>/images/logo-footer.png" alt="logo-footer" width="180"></a></p>
			<p class="footer-second-description">Copyright by DressMaker's Pin. 2016.</p>
		</div>

		<!-- Menu stopki -->
		<nav class="footer-menu">
			<?php wp_nav_menu( array('menu' => 'Main', 'depth'=> 3, 'container'=> false, 'walker'=> new Bootstrap_Walker_Nav_Menu)); ?>
		</nav>

	</div>
</footer>

<?php wp_footer(); ?>

<!-- Font Awesome -->
<script src="https://use.fontawesome.com/8487f6a2c2.js"></script>

<!-- Disqus -->
<script id="dsq-count-scr" src="//michadevelopwpsite.disqus.com/count.js" async></script>

<!-- Slider -->
<script src="<?php echo get_bloginfo('template_directory');?>/js/slider.js"></script>

</body>
</html>
