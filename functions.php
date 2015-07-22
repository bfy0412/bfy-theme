<?php
	//最新文章
	function bfy_recent_posts($limit=10, $count=32) {
		$category_id = '';
		if (is_single() ) {
			$categories = get_the_category();
			foreach ($categories as $category) {
				$category_id = $category->term_id;
			}
		}
		$new_posts = get_posts('numberposts=' . $limit .'&orderby=post_date&category=' . $category_id);
			foreach( $new_posts as $post ) {
				echo '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark">' . mb_strimwidth($post->post_title,0,$count) . '</a></li>';
			}
		}
	//最新评论
	function bfy_recent_comments($limit=10, $count=28, $avatarsize=26) {
		global $wpdb;
		$sql = "SELECT ID, comment_ID, comment_content, post_title, comment_author_email, comment_author FROM $wpdb->posts, $wpdb->comments WHERE $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND (post_status = 'publish' AND comment_author != 'admin' AND user_id !=1 OR post_status = 'static') AND comment_type = ''";
		$sql .= "AND comment_approved = '1' ORDER BY $wpdb->comments.comment_date DESC LIMIT $limit";
		$comments = $wpdb->get_results($sql);
		$output = '';
		foreach ($comments as $comment) {
		$comment_author = stripslashes($comment->comment_author);
		$comment_excerpt = mb_strimwidth(strip_tags(apply_filters('the_comment', $comment->comment_content)), 0, $count, "...");
		$permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;
		$output .= '<li>' .get_avatar($comment, $avatarsize) . '<p>' . $comment_author . '</p><p><a href="' . $permalink . '" title="点击杳看' . $comment_author . '在文章“' . $comment->post_title . '”中的评论">' . $comment_excerpt . '</a></p></li>';
		}
		echo $output;
	}
	//热评文章$sort='DESC' 冷评文章$sort='ASC'
	function bfy_most_commented_post($limit=10, $count=32, $days=365, $sort='DESC') {
		global $wpdb;
		$sql = "SELECT ID , post_title , comment_count
		FROM $wpdb->posts
		WHERE post_status = 'publish' AND post_type = 'post' AND post_type != 'page' AND post_title != '' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
		ORDER BY comment_count $sort LIMIT 0 , $limit ";
		$posts = $wpdb->get_results($sql);
		$output = '';
		foreach ($posts as $post){
		$output .= '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark">' . mb_strimwidth($post->post_title,0,$count) . '</a></li>';
		}
		echo $output;
	}
	//以上函数方便sidebar的调用
	
	//去掉空格
	function delete_html($str) {
		$str = strip_tags($str,'');
		$str = ereg_replace('\t','',$str);
		$str = ereg_replace('\r\n','',$str);
		$str = ereg_replace('\r','',$str);
		$str = ereg_replace('\n','',$str);
		$str = ereg_replace(' ','',$str);
		return trim($str);
}
	//摘要
	function content_excerpt($count=200, $string='') {
		global $post;
		$content = apply_filters('the_content', $post->post_content);
		$content_text = delete_html($content);
		return wp_trim_words($content_text, $count, $string);
	}
	//分页
	function page_navigation($range=10) {
		global $paged, $wp_query;
		$range = ceil($range/2)*2;
		if ( !$max_page ) $max_page = $wp_query->max_num_pages;

		if($max_page > 1) {
		if(!$paged) $paged = 1;

		function pageNum($range, $max_page, $paged) {
		if($max_page > $range) {
		if($paged < $range) {
		for($i = 1; $i <= $range; $i++) {
		$page_num[$i] = $i;
		}
		} elseif($paged >= ($max_page - ($range/2) ) ) {
		for($i = $max_page - $range+1; $i <= $max_page; $i++) {
		$page_num[$i] = $i;
		}
		} elseif($paged >= $range && $paged < ($max_page - ($range/2) ) ) {
		for($i = ($paged - $range/2+1 ); $i <= ($paged + ($range/2) ); $i++) {
		$page_num[$i] = $i;
		}
		}
		} else {
		for($i = 1; $i <= $max_page; $i++) {
		$page_num[$i] = $i;
		}
		}
		return $page_num;
		}
		$page_num = pageNum($range, $max_page, $paged);

		echo '<div class="page-nav"><span class="total-page">' . sprintf(__('共有%s页', 'enterprise-themes'), $max_page) . '</span>';
		if($paged != 1) echo '<a href="' . get_pagenum_link(1) . '" class="first-page">' . __('首页', 'enterprise-themes') . '</a>';
		previous_posts_link(__('上一页', 'enterprise-themes') );
		foreach($page_num as $num) {
		echo '<a href="' . get_pagenum_link($num) . '"';
		if($num==$paged) echo ' class="current-page"';
		echo '>' . $num . '</a>';
		}
		next_posts_link(__('下一页', 'enterprise-themes') );
		if($paged != $max_page) {
		echo '<a href="' . get_pagenum_link($max_page) . '" class="last-page">' . __('末页', 'enterprise-themes') . '</a>';
		}
		echo '</div>';
		}
	}
	//以上函数主要用在content.php主循环中
	add_theme_support( 'post-thumbnails' );//特色图像设置
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'status', 'video'));
		//面包屑导航
	function bfy_path() {
		global $cat, $s, $post;
		echo '<div id="path">您现在的位置：<ol><li class="home"><a href="' . get_bloginfo('url') . '">首页</a></li>';
		if((is_single() || is_category() ) && !is_attachment() ) {
		$categorys = get_the_category();
		$category = $categorys[0];
		$category_id = $category->term_id;
		if(is_category() ) $category_id = $cat;
		$category_name = get_category_parents($category_id, false, ',');
		$category_name_group = explode(',', $category_name);
		foreach ($category_name_group as $cat_name) {
		if($cat_name) {
		$cat_ID = get_cat_ID($cat_name);
		$cat_url = get_category_link( $cat_ID );
		if(is_single() || (is_category() && $cat_ID != $cat) ) echo '<li><a href="' . $cat_url . '">' . $cat_name . '</a></li>';
		if(is_category() && $cat_ID == $cat) echo '<li>' . $cat_name . '</li>'; 
		}
		}
		if(is_single() || is_date() ) echo '<li>' . the_title_attribute('echo=0') . '</li>';
		}
		if(is_page() ) {
		if ($post->post_parent) {
		$ancestors = array_reverse(get_post_ancestors($post->ID) );
		foreach ( $ancestors as $ancestor ) {
		$page_name = get_the_title($ancestor);
		$page_url = get_permalink($ancestor);
		echo '<li><a href="' . $page_url . '">' . $page_name . '</a></li>';
		}
		}
		echo '<li>' . the_title('', '', false) . '</li>';
		}
		if (is_search() ) echo '<li>"' . $s . '"的搜索结果</li>';
		if(is_tag() ) echo '<li>' . single_tag_title('', false) . '</li>';
		if(is_404() ) echo '<li>404页面</li>';
		if(is_attachment() ) echo '<li>附件</li><li>' . the_title_attribute('echo=0') . '</li>';
		echo '</ol></div>';
	}
	//随机文章
	function bfy_random_posts($limit=10, $count=32) {
		$rand_posts = get_posts('numberposts=' . $limit .'&orderby=rand');
		foreach( $rand_posts as $post ) {
		echo '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark">' . wp_trim_words($post->post_title,$count,'') . '</a></li>';
		}
	}

?>