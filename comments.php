<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vcard
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="box-inner post-comments">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="title title--h3">
			<?php comments_number( esc_html__( 'No comments found', 'vcard' ), esc_html__( '1 Comment', 'vcard' ), esc_html__( '% Comments', 'vcard' ) ); ?>
		</h2>

		<!-- comments -->
		<ul class="comments">
			<?php
			wp_list_comments( array(
				'style'	  => 'ul',
				'avatar_size' => '80',
				'callback' => 'vcard_comment'
			) );
			?>
		</ul>

		<?php
		the_comments_navigation( array(
			'screen_reader_text' => ' ',
			'prev_text' => esc_html__( 'Older comments', 'vcard' ),
			'next_text' => esc_html__( 'Newer comments', 'vcard' )
		) );

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'vcard' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>
	
	<div class="comment-form <?php if ( comments_open() ) : ?>comment-form-open<?php endif; ?>">
		<?php
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
		
			$comment_args = array(
				'title_reply' => esc_html__( 'Write a comment', 'vcard' ),
				'title_reply_to' => esc_html__( 'Write a comment to %s', 'vcard' ),
				'cancel_reply_link' => esc_html__( 'Cancel Reply', 'vcard' ),
				'title_reply_before' => '<h3 id="reply-title" class="title title--h4 comment-reply-title">',
				'title_reply_after' => '</h3>',
				'label_submit' => esc_html__( 'Submit', 'vcard' ),
				'comment_field' => '<div class="form-group"><textarea class="textarea textarea--white form-control" placeholder="' . esc_attr__( 'Comment', 'vcard' ).'" id="comment" name="comment" aria-required="true" ></textarea></div>',
				'must_log_in' => '<p class="must-log-in">' . esc_html__( 'You must be ', 'vcard' ) . '<a data-no-swup href="' . esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '">' . esc_html__( 'logged in', 'vcard' ) . '</a>' . esc_html__( ' to post a comment.', 'vcard' ) . '</p>',
				'logged_in_as' => '<p class="logged-in-as">' . esc_html__( 'Logged in as ', 'vcard' ) . '<a data-no-swup href="' . esc_url( admin_url( 'profile.php' ) ) . '">' . esc_html( $user_identity ) . '</a>' . esc_html__( '. ', 'vcard' ) . '<a data-no-swup href="' . esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '" title="' . esc_attr__( 'Log out of this account', 'vcard' ) . '">' . esc_html__( 'Log out?', 'vcard' ) . '</a></p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="form-group"><input id="author" class="input form-control" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'vcard' ) . '" value="" ' . $aria_req . ' /></div>',
					'email' => '<div class="form-group"><input id="email" class="input form-control" name="email" type="text" placeholder="' . esc_attr__( 'Email', 'vcard' ) . '" value="" ' . $aria_req . ' /></div>',
				)),
				'class_submit' => 'btn',
				'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
				'submit_button' => '<button type="submit" name="%1$s" id="%2$s" class="%3$s" data-text="%4$s"><i class="font-icon icon-send"></i> %4$s</button>'
			);

			comment_form( $comment_args );
		?>
	</div>

</div><!-- #comments -->
