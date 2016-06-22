<?php get_header(); ?>

<div class="container">

		<!-- Wyróżnione wpisy
		<section class="blog-header">
			<article class="header-container">

				<!-- Znak strony
				<img class="logo2" src="assets/images/logo2.png" alt="logo2" height="350">

				<!-- Slider
				<div class="slider-box">

					<div class="slides">
						<a href="post.html">
							<div class="header-photo"></div>
							<div class="header-title">
								<time class="lead blog-description">2 / 05</time>
								<h1 class="blog-title">Chcemy być modne, ale bez wydawania pieniędzy</h1>
								<div class="blog-title-border"></div>
							</div>
						</a>
					</div>
					<div class="slides first-hide">
						<a href="post.html">
							<div class="header-photo two"></div>
							<div class="header-title">
								<time class="lead blog-description">10 / 05</time>
								<h1 class="blog-title">Poważny temat numer dwa</h1>
								<div class="blog-title-border"></div>
							</div>
						</a>
					</div>
					<div class="slides first-hide">
						<a href="post.html">
							<div class="header-photo three"></div>
							<div class="header-title">
								<time class="lead blog-description">1 / 05</time>
								<h1 class="blog-title">Poważny temat numer trzy</h1>
								<div class="blog-title-border"></div>
							</div>
						</a>
					</div>

				</div>

			</article>
		</section> -->

		<div class="row">

			<!-- Lista postów -->
			<section class="col-sm-8 blog-main">

				<?php if(have_posts()) : ?>
		   		<?php while(have_posts()) : the_post(); ?>
				
				<article class="blog-post" id="post-<?php the_ID(); ?>">
					
					<p class="blog-post-meta"><?php foreach((get_the_category()) as $category) { $category->cat_name . ' '; } ?><a href="<?php echo get_category_link(get_cat_id($category->cat_name)); ?>"><?php echo $category->cat_name ?></a><time><?php the_time('d / m'); ?></time></p>
					
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title('<h2 class="blog-post-title">','</h2>'); ?>
					</a>
					
					<p><?php the_content(); ?></p>
					
				</article>	<!-- /.blog-post -->
				
				<?php
				if (is_singular()) {
				// support for pages split by nextpage quicktag
				wp_link_pages();

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );

				// tags anyone?
				the_tags();
				}
				?>
		   		<?php endwhile; ?>
				
				<?php if (!is_singular()) : ?>
				<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
				<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
				<?php endif; ?>

				<?php else : ?>

				<article class="subpages-article">

					<h1 class="subpages-title">Brak wpisów w tej kategorii.</h1>

					<p class="profile-description subpage"><strong>W tej chwili nie ma w tej kategorii żadnych wpisów.</strong><br>Jeśli chcesz możesz wejść na moją stronę główną <a href="http://michaldevelopwp.azurewebsites.net">klikając tutaj</a> :-)</p>

				</article>

				<?php endif; ?>

			</section>	<!-- /.blog-main -->

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</div>	<!-- /.row -->

</div>	<!-- /.container -->

<?php get_footer(); ?>
