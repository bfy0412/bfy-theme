<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo trim(wp_title('',0)); if(!is_home()) echo ' - '; bloginfo( 'name' ); ?></title><!--每个页面输出不同的标题，加上站点名称-->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<?php wp_head(); ?><!--作为插件的预留钩子-->
	</head>
	<body <?php body_class(); ?>>
		<section id="header">
			<div id="title">
				<?php
					if(is_home()) {
					echo '<h1>' . get_bloginfo('name') . '</h1>';
					} else {
					echo '<p>' . get_bloginfo('name') . '</p>';
					}
				?>
				<p><?php bloginfo('description'); ?></p>
			</div>
			<div id="nav">
				<ul class="page clear">
					<li><a href="<?php bloginfo('url'); ?>">首页</a></li>
					<li><a href="http://www.douban.com/people/bfy0412/" target="_blank">我的豆瓣</a></li>
					<li><a href="http://www.zhihu.com/people/bifangya" target="_blank">我的知乎</a></li>
					<li><a href="https://github.com/bfy0412" target="_blank">My Github</a></li>
					<?php wp_list_pages('title_li='); ?><!--以列表方式输出所有页面的链接，自动生成li标签，默认只有首页-->
				</ul>
				<p style="margin-left:45px;">博客分类</p>
				<ul class="cat">
					<?php wp_list_categories('orderby=id&title_li=&show_count=0&hide_empty=0&use_desc_for_title='); ?><!--以列表形式输出所有分类的链接，自动生成li标签-->
				</ul>
			</div>
		</section>

