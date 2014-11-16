<?php
/**
 * The template for displaying Author bios
 *
 * @package themecap
 * @subpackage caps
 * @since caps 1.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		$author_bio_avatar_size = apply_filters( 'caps_author_bio_avatar_size', 75 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h4><span class="author-title"><?php printf( __( 'About %s', THEMENAME ), get_the_author() ); ?></span></h4>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', THEMENAME ), get_the_author() ); ?>
			</a>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->