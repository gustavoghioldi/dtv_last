<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package themecap
 * @subpackage caps
 * @since caps 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
	<div class="comments">
	<?php if ( have_comments() ) : ?>
      
        <h3 class="title"><span><?php echo __( get_comments_number(). ' Comments', 'caps' ); ?></span></h3>
        
		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
									'callback' => 'caps_comments'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'caps' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'caps' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'caps' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'caps' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
</div><!--.comments-->

<?php caps_comment_form(); ?>