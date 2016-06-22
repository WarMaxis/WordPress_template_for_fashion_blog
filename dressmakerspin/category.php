<?php get_header(); ?>

<div class="container categories">

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
					
					<p><?php the_excerpt();?></p>
					
				</article>	<!-- /.blog-post -->
				
		   		<?php endwhile; ?>
				
				<?php if (!is_singular()) : ?>
					<nav>
						<ul class="pager">
							<li><?php previous_posts_link( '<span class="fa fa-arrow-left"></span> Nowsze posty' ); ?></li>
							<li><?php next_posts_link( 'Starsze posty <span class="fa fa-arrow-right"></span>' ); ?></li>
						</ul>
					</nav>
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
