<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */

global $WOWTheme;
?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>

                <h1 class="entry-title"><?php the_title(); ?></h1>

                <?php the_post_thumbnail(
                                'post-thumbnail',
                                array("class" => "featured_image")
                ); ?>
                <?php the_content( ); ?>
                <?php wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'letheme' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                ) ); ?>
			<div class="clear"></div>
        </div>