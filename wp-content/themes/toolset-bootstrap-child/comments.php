<?php
/**
 * The template for displaying Comments.
 *
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( wpbootstrap_get_setting('general_settings', 'display_comments' ) ): ?>
	<?php if (comments_open()) { ?><section id="comments"><?php }?>
		<?php if (comments_open()): ?>
			<?php if ( have_comments() ) : ?>
				<a name="respond" />
				<div class="comments-header clearfix">
					<h2 id="comments-title" class="pull-left">
					<?php
						$comment_count_actual = get_comments_number();
						if ($comment_count_actual = 1) {
							printf( __( '1 Comment', 'wpbootstrap' ));
	                    } elseif ($comment_count_actual > 1) {
							printf( '%1$s '.__( 'Comments', 'wpbootstrap' ).' &ldquo;%2$s&rdquo;',number_format_i18n( get_comments_number() ));
						}
					?>
					</h2>
					<a class="commentlink pull-right" href="#respond"/>Add your comment</a>
				</div>
				<ol class="commentlist unstyled">
					<?php wp_list_comments(array('walker'=>new Wpbootstrap_Comments())); ?>
				</ol> <!-- .commentlist -->

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<ul class="pager">
					<li class="previous"><?php previous_comments_link( '&larr; '.__( 'Older Comments', 'wpbootstrap' ) ); ?></li>
					<li class="next"><?php next_comments_link( __( 'Newer Comments', 'wpbootstrap' ).' &rarr;' ); ?></li>
				</ul>
				<?php endif; // check for comment navigation ?>

				<?php
				// If there are no comments and comments are closed
				if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.' , 'wpbootstrap' ); ?></p>
				<?php endif; ?>

			<?php endif; // have_comments() ?>

			<?php comment_form(array('comment_notes_after' => '')); ?>

		<?php else: ?>
			<?php if ( wpbootstrap_get_setting('general_settings', 'display_comments_closed_info' ) ): ?>
				<p class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php _e('Comments are closed','wpbootstrap'); ?>
				</p>
			<?php endif; ?>
		<?php endif;?>

	<?php if (comments_open()) { ?></section><!-- #comments --><?php }?>
<?php endif;