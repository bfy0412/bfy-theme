<?php get_header(); ?>
	<div id="container">
		 <?php get_sidebar(); ?>
		<div id="content">
			<?php 
				$allsearch = new WP_Query("s=$s&showposts=-1");
				$count = $allsearch->post_count;
				$keywords = wp_specialchars($s, 1);
			?>
			<?php if ($count==0) : ?>
			<h1>搜索结果</h1>
			<div class="error">
				<p>很遗憾，未找到与您搜索的关键词相关的内容，可能是本站还没有这方面的内容或是您输入的关键词不够准确，您可以尝试在下面的搜索框中使用新的关键词重新搜索：</p>
				<div class="nav-search">
					<form method="get" action="<?php bloginfo('home'); ?>">
						<input type="search" name="s" value="<?php echo wp_specialchars($s, 1); ?>" size="20" /><input type="submit" class="submit-search" value="搜索" />
					</form>
				</div>
				<p>如果这样仍不能解决您的问题，请发送邮件至<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a>，<?php echo get_the_author_meta('nickname',1); ?>在收到您的来邮后会第一时间回复，非常感谢您的支持！</p>
			</div>
			<?php else : ?>
			<div class="header">
				<h1>搜索结果</h1>
				<p><?php echo '共找到含有“' . $keywords . '”的文章' . $count . '篇'; ?></p>
			</div>
			<?php get_template_part( 'content', '' ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>
