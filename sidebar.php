<section id="sidebar" class="clear">
	<div id="cat" class="clear">
		<p style="margin-left:45px;">博客分类</p>
		<ul class="cat">
			<?php wp_list_categories('orderby=id&title_li=&show_count=0&hide_empty=0&use_desc_for_title='); ?><!--以列表形式输出所有分类的链接，自动生成li标签-->
		</ul>
	</div>
		<div class="recent">
			<h3>最新文章</h3>
		<ul>
			<?php bfy_recent_posts(10, 36); ?>
		</ul>
	<div class="most-commented">
		<h3>热评文章</h3>
		<ul>
			<?php bfy_most_commented_post(8, 36, 365, 'DESC'); ?>
		</ul>
	</div>
	<div class="recent-comments">
		<h3>近期评论</h3>
		<ul>
			<?php bfy_recent_comments(6, 32, 32); ?>
		</ul>
	</div>
	<!--使用functions.php模板文件中写的函数-->
	<div class="tag">
		<h3>标签云集</h3>
		<div>
			<?php wp_tag_cloud('smallest=8&largest=22&unit=px&number=45'); ?><!--使用WP官方自带函数-->
		</div>
	</div>
	<div class="links">
		<h3>友情链接</h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=20'); ?><!--使用WP官方自带函数-->
		</ul>
	</div>
</section>
