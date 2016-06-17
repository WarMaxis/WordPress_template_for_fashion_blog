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
					<!-- <p class="blog-post-meta"><a href="trends.html">Trendy</a><time>2 / 05</time></p> -->
					<!-- <a href="post.html"> -->
						<?php the_title('<h2 class="blog-post-title">','</h2>'); ?>
					<!-- </a> -->
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

				<div class="alert alert-info">
					<strong>No content in this loop</strong>
				</div>

				<?php endif; ?>

				<blockquote class="blockquote-featured">
					<div class="reference-container">
						<p class="reference-blockquote">POLECAM</p>
						<div class="reference-border"></div>
					</div>
					<div class="blockquote-container">
						<p class="blockquote-paragraph">“Daj mi właściwe słowo i odpowiedni akcent, a poruszę świat.”</p>
						<p class="blockquote-link">
							<strong>
								<a href="http://www.complex.com/" target="_blank">www.complex.com</a>
							</strong>
						</p>
					</div>
				</blockquote>

			</section>	<!-- /.blog-main -->

			<!-- Sidebar -->
			<aside class="col-sm-3 col-sm-offset-1 blog-sidebar">
				<div class="sidebar-module sidebar-module-inset">

					<!-- Zdjęcie profilowe -->
					<img class="profile-photo" src="http://michaldevelopwp.azurewebsites.net/wp-content/uploads/2016/06/autorka-profilowe.png" alt="autorka-profilowe" width="100">

					<!-- Opis autorki -->
					<p class="profile-description"><strong>Cześć, tu Aga!</strong><br>Prowadzę tego bloga i tego, i czytajcie a sie dowiecie. Same fajne rzeczy, bez ściemniania.</p>

					<!-- Ikonki social media -->
					<section class="social-icons sidebar">
						<a href="https://www.facebook.com/"><span class="fa fa-facebook"></span></a>
						<a href="https://twitter.com/"><span class="fa fa-twitter"></span></a>
						<a href="https://www.instagram.com/"><span class="fa fa-instagram"></span></a>
					</section>

				</div>
			</aside>	<!-- /.blog-sidebar -->

		</div>	<!-- /.row -->

</div>	<!-- /.container -->

<?php get_footer(); ?>
