<?php get_header(); ?>
<div id="container">
	<div id="content">
		<?php while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<div class="page-content">
			<?php the_content(); ?>
		</div>
		<?php comments_template(); ?><!--评论-->
		<?php endwhile; ?>
	</div><!--页面展示内容-->
	<?php get_sidebar(); ?><!--侧边栏-->
</div><!--页面主体内容-->
<?php get_footer(); ?>