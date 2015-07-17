<!--主循环内容-->
<?php if ( have_posts() ) : ?>
	<?php while( have_posts() ) : the_post(); ?>
		<div class="article-content entry">
			<h2<?php if( is_sticky() ) echo ' class="sticky"'; ?>><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title_attribute(); ?></a></h2>
			<div class="entry-content">
				<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
				<?php else : ?>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(150,150) ); ?></a><!--设置特色图像-->
				<?php endif; ?>
					<p class="summary"><?php echo content_excerpt(41); ?></p><!--文章摘要，参数为摘要字数-->
				<?php endif; ?>
			</div>
			<div class="meta">
				<span class="category">分类：<?php the_category(' ', ''); ?></span>
				<?php the_tags('<span class="tag">标签：', ',', '</span>'); ?>
				<span class="date">发表于：<?php the_time('Y-m-d'); ?></span>
			</div><!--文章元数据-->
		</div><!--单篇日志结束-->
	<?php endwhile; ?>
		<?php page_navigation(10); ?><!--分页-->
	<?php else : ?>
<?php endif; wp_reset_query(); ?><!--在有多个循环体时需要重置循环-->
