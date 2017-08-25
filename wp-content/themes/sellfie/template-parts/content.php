<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sellfie
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php sellfie_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
        
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="attachment-img">
                <?php the_post_thumbnail(); ?>
            </a>
        <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( 'option2' == sellfie_sanitize_index_content( get_theme_mod( 'sellfie_post_content' ) ) ) :
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'sellfie' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
			else :
			the_excerpt(); 
			endif;
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sellfie' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php sellfie_entry_footer(); ?>
	</footer><!-- .entry-footer -->
    
</article><!-- #post-## -->
