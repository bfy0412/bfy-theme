<section id="sidebar" class="clear">
	<div class="cat clear">
		<h2><span>博文分类</span></h2>
		<ul>
			<?php wp_list_categories('orderby=id&title_li=&show_count=0&hide_empty=0&use_desc_for_title='); ?><!--以列表形式输出所有分类的链接，自动生成li标签-->
		</ul>
	</div>
	<div class="recent">
		<h3><span>最新文章</span></h3>
		<ul>
			<?php bfy_recent_posts(10, 36); ?>
		</ul>
	</div>
	<div class="most-commented">
		<h3><span>热评文章</span></h3>
		<ul>
			<?php bfy_most_commented_post(8, 36, 365, 'DESC'); ?>
		</ul>
	</div>
	<!--使用functions.php模板文件中写的函数-->
	<div class="tag">
		<h3><span>标签云集</span></h3>
		<div>
			<?php wp_tag_cloud('smallest=8&largest=22&unit=px&number=45'); ?><!--使用WP官方自带函数-->
		</div>
	</div>
	<div class="links">
		<h3><span>友情链接</span></h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=20'); ?><!--使用WP官方自带函数-->
		</ul>
	</div>
</section>
