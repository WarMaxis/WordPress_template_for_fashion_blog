<?php get_header(); ?>

<div class="container categories post">

		<div class="row">

			<!-- Lista postów -->
			<section class="col-sm-8 blog-main">

				<?php if(have_posts()) : ?>
		   		<?php while(have_posts()) : the_post(); ?>

				<!-- Zdjęcie wpisu -->
				<div class="blog-header post">
					<div class="header-container">

						<!-- Znak strony -->
						<img class="logo2" src="<?php echo get_bloginfo('template_directory');?>/images/logo2.png" alt="logo2" height="350">

						<?php if ( has_post_thumbnail() ) : ?>
							<img class="post-photo" src="<?php the_post_thumbnail_url(); ?>" alt="post-photo">
						<?php endif; ?>

					</div>
				</div>

				<article class="blog-post all" id="post-<?php the_ID(); ?>">
					
					<p class="blog-post-meta"><?php foreach((get_the_category()) as $category) { $category->cat_name . ' '; } ?><a href="<?php echo get_category_link(get_cat_id($category->cat_name)); ?>"><?php echo $category->cat_name ?></a><time><?php the_time('d / m'); ?></time></p>
					
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title('<h2 class="blog-post-title">','</h2>'); ?>
					</a>
					
					<p><?php the_content(); ?></p>
					
				</article>	<!-- /.blog-post -->
				
		   		<?php endwhile; ?>
				<?php endif; ?>

				<div class="reference-container">
					<p class="reference-blockquote">CZYTAJ RÓWNIEŻ</p>
					<div class="reference-border"></div>
				</div>

				<div class="more-posts">
					<div class="col-sm-4 first">
						<p class="blog-post-meta more-posts-title"><a href="trends.html">Trendy</a><time>2 / 05</time></p>
						<a href="#">
							<h3 class="blog-post-title read-also">Stroje komunijne dla dziewczyn i chłopców – sukienki i garnitur czy alby komunijne?</h3>
						</a>
					</div>
					<div class="col-sm-4 middle">
						<p class="blog-post-meta more-posts-title"><a href="trends.html">Trendy</a><time>2 / 05</time></p>
						<a href="#">
							<h3 class="blog-post-title read-also">Wakacje we dwoje? Czy to na pewno dobry pomysł?</h3>
						</a>
					</div>
					<div class="col-sm-4 last">
						<p class="blog-post-meta more-posts-title"><a href="trends.html">Trendy</a><time>2 / 05</time></p>
						<a href="#">
							<h3 class="blog-post-title read-also">Stroje komunijne dla dziewczyn i chłopców – sukienki i garnitur czy alby komunijne?</h3>
						</a>
					</div>
				</div>
				
				<!-- Disqus skrypt -->
				<div id="disqus_thread"></div>
					<script>
						var disqus_config = function () {
							this.page.url = '<?php echo get_permalink(); ?>';
							this.page.identifier = '<?php echo dsq_identifier_for_post($post); ?>';
						};

						(function() {  // DON'T EDIT BELOW THIS LINE
							var d = document, s = d.createElement('script');

							s.src = '//michadevelopwpsite.disqus.com/embed.js';

							s.setAttribute('data-timestamp', +new Date());
							(d.head || d.body).appendChild(s);
						})();
					</script>

					<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a>
					</noscript>

			</section>	<!-- /.blog-main -->

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</div>	<!-- /.row -->

</div>	<!-- /.container -->

<?php get_footer(); ?>
