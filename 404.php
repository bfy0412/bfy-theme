<?php get_header(); ?>
	<div id="container">
	<div id="content">
	<div class="error">
	<h1>������ʾ</h1>
	<p>�ܱ�Ǹ�������ҵ����ݿ����Ѿ�ɾ��������ת�ƣ��������ڱ�վ��������������ʹ�ò�ͬ�Ĺؼ��ֽ����������Ա��ҵ�������Ȥ�����ݣ��������Ե����ҳ�·�����������б���㿴����</p>
	<p>��������Բ��ܽ���������⣬�뷢���ʼ���<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a>��<?php echo get_the_author_meta('nickname',1); ?>���յ��������ʺ���һʱ��ظ����ǳ���л����֧�֣�</p>
	</div>
	<div class="random-articles">
	<h3>��㿴��</h3>
	<ul>
	<?php yercms_random_posts(40); ?>
	</ul>
	</div>
	</div>
	 <?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>