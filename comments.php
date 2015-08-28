<?php
	if ( post_password_required() ) {
		return;
	}//如果设置了加密，就不用加载评论了
	if( is_single() ) {
		$comment_title = '评论';
	} else {
		$comment_title = '留言';
	}
?>
<div id="comments" class="comments-area">
<?php if ( have_comments() ) : ?>
	<div id="comment-list">
	<h2 class="comment-title"><?php echo '用户' . $comment_title; ?></h2>
	<ol class="comment-entry">
		<?php
			wp_list_comments( array(
			'style' => 'ol',
			'avatar_size' => 36,
			'reply_text' => '回复',
			'format' => 'xhtml',
			'type' => 'comment',
			'login_text' => '登录并回复',
			) );
		?>
	</ol>
</div>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<div id="comment-nav" class="navigation comment-navigation">
<?php previous_comments_link( '&laquo; 上一页' ); ?>
<?php next_comments_link( '下一页 &raquo;' ); ?>
	</div>
<?php endif; ?>

<?php endif; ?>

<?php
	if ( ! comments_open() ) {
		echo '<p>' . $comment_title . '功能已关闭！' . '</p>';
	} else {
		$comments_args = array(
		'id_form' => 'comment-form',
		'id_submit' => 'comment-submit',
		'title_reply' => '发表' . $comment_title,
		'title_reply_to' => '回复',
		'cancel_reply_link' => '取消回复',
		'label_submit' => '提交' . $comment_title,
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . $comment_title . '</label><textarea id="comment" name="comment" cols="45" rows="8" required="required"></textarea><span class="required">* 必填</span></p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<p class="comment-form-author"><label for="author">昵称</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required="required" /><span class="required">* 必填</span></p>',
		'email' => '<p class="comment-form-email"><label for="email">邮箱</label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . ( $req ? ' required="required" /><span class="required">* 必填</span>' : ' />') . '</p>',
		//'url' => '<p class="comment-form-url"><label for="url">网址</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		)
		),
		);
		comment_form($comments_args);
	}
?>
</div>