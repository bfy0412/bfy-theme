<?php get_header(); ?>
	<div id="container">
	<div id="content">
	<?php 
	$allsearch = new WP_Query("s=$s&showposts=-1");
	$count = $allsearch->post_count;
	$keywords = wp_specialchars($s, 1);
	?>
	<?php if ($count==0) : ?>
	<h1>�������</h1>
	<div class="error">
	<p>���ź���δ�ҵ����������Ĺؼ�����ص����ݣ������Ǳ�վ��û���ⷽ������ݻ���������Ĺؼ��ʲ���׼ȷ�������Գ������������������ʹ���µĹؼ�������������</p>
	<div class="nav-search">
	<form method="get" action="<?php bloginfo('home'); ?>">
	<input type="search" name="s" value="<?php echo wp_specialchars($s, 1); ?>" size="20" /><input type="submit" class="submit-search" value="����" />
	</form>
	</div>
	<p>��������Բ��ܽ���������⣬�뷢���ʼ���<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a>��<?php echo get_the_author_meta('nickname',1); ?>���յ��������ʺ���һʱ��ظ����ǳ���л����֧�֣�</p>
	</div>
	<?php else : ?>
	<div class="header">
	<h1>�������</h1>
	<p><?php echo '���ҵ����С�' . $keywords . '��������' . $count . 'ƪ'; ?></p>
	</div>
	<?php get_template_part( 'content', '' ); ?>
	<?php endif; ?>
	</div>
	 <?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
