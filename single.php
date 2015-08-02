<?php get_header(); ?>
<div id="container">
	<?php get_sidebar(); ?>
	<div id="content">
		<?php while (have_posts()) : the_post(); ?>
			<div id="article-content">
				<div class="header">
					<h1><?php the_title_attribute(); ?></h1>
					<div class="meta-data">
						<span class="date">发表于：<?php the_time('Y-m-d'); ?></span>
						<span class="author">作者：<?php the_author_posts_link(); ?></span>
						<?php if ( !post_password_required() && comments_open() ) : ?>
						<span class="comments">评论：<?php comments_popup_link('0', '1', '%'); ?>条</span>
						<?php endif; ?>
						<?php edit_post_link('编辑', '<span class="edit">', '</span>'); ?>
					</div>
				</div>
				<div class="content-inner">
					<?php the_content(); ?><!--文章内容-->
				</div>
			</div><!--单篇文章全部内容-->
			<?php previous_post_link('<div class="previous-article">上一篇：%link</div>', '%title',$in_same_cat = true); ?>
			<?php next_post_link('<div class="next-article">下一篇：%link</div>', '%title',$in_same_cat = true); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; ?>
	</div>
</div>
<?php get_footer();?>
