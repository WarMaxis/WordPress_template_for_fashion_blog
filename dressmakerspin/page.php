<?php get_header(); ?>

<div class="container">

	<div class="row">

			<section class="col-sm-12">

				<article class="subpages-article">

					<?php if (have_posts()) : while (have_posts()) : the_post();?>
					<?php the_content(); ?>
					<?php endwhile; endif; ?>

				</article>

			</section>

	</div>	<!-- /.row -->

</div>	<!-- /.container -->

<?php get_footer(); ?>
