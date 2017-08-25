<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
 
global $WOWTheme;
?>

<article id="post-<?php the_ID(); ?>" <?php !is_single()?post_class( 'article-box' ):post_class(); ?>>
	
	<!-- ========== Post Meta ========== -->
	<div class="entry-meta">
		<span class='post-date'><div class="day"><?php echo get_the_date('d'); ?></div><?php echo get_the_date('M'); ?></span>
		<div class="left-meta"><?php if(comments_open( get_the_ID() )) { ?>
			<span class='post-comments'><?php comments_popup_link( $WOWTheme->_( 'noresponses' ), $WOWTheme->_( 'oneresponse' ), $WOWTheme->_( 'multiresponse' ) ); ?></span>
			<?php } edit_post_link( $WOWTheme->_( 'edit' ), '     |     <span class="edit-link">', '</span>' ); ?>
			<div class="clear"></div>
			<span class="post-author"><?php echo the_author_posts_link();?></span>
		</div>
	</div>
	
	<!-- ========== Post Featured Image ========== -->
	<?php if ( has_post_thumbnail() ) { // if there is featured image for this post you may wrapper for it ?>
		<div class="featured-img-container">
		
	<div class="featured-text">
		<!-- ========== Post Title ========== -->
		<?php  //Title
			if (!is_single()&&!is_page()) { ?>
				<h2 class='entry-title'><a href="<?php the_permalink(); ?>" title="<?php printf( $WOWTheme->_( 'permalink' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			<?php } else { ?>
				<h1 class='entry-title'><?php the_title(); ?></h1>
		<?php } ?>
		<span class='post-categories'><?php the_category(' '); ?></span> 
	</div>
	
		<?php the_post_thumbnail(
				'post-thumbnail',
				array("class" => "featured_image" )
			); ?>
		</div>	
	<?php } else { ?>
	
		<!-- ========== Post Title ========== -->
		<?php  //Title
			if (!is_single()&&!is_page()) { ?>
				<h2 class='entry-title'><a href="<?php the_permalink(); ?>" title="<?php printf( $WOWTheme->_( 'permalink' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			<?php } else { ?>
				<h1 class='entry-title'><?php the_title(); ?></h1>
		<?php } ?>
		<span class='post-categories'><?php the_category(' '); ?></span> 
	
	<?php } ?>
		
	<!-- ========== Post content  ========== -->
	<?php if ( !is_single() ) : ?>
		
		<!-- ========== Post content in posts feed ========== -->
		<div class="entry-summary">
			<?php wow_excerpt('echo=1');?>
			<a href='<?php the_permalink(); ?>' class='readmore'><?php echo $WOWTheme	->_( 'readmore' ); ?></a>
		</div><!-- .entry-summary -->
	
	<?php else : ?>
	
		<!-- ========== Post content in single post page ========== -->
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'letheme' ) );
				wp_link_pages( array(	
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'letheme' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
		
	<?php endif; ?>
		
	<div class="clear"></div>
</article><!-- #post-## -->
