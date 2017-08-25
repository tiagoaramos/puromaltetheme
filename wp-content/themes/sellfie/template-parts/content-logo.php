
				<?php if ( has_custom_logo( $blog_id = 0 ) ) : ?> 
                    
						<?php if ( function_exists( 'the_custom_logo' )) : ?>
                        
                        	<h1 class="site-title">
                   				<?php the_custom_logo( $blog_id = 0 ); ?> 
  							</h1>
                            
                        <?php endif; ?>
                        
                    <?php else : ?>
                     
						<?php if ( is_front_page() && is_home() ) : ?>
							
                            <h1 class="site-title">
                            	<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                        
									<?php bloginfo( 'name' ); ?>
                            
                    			</a>
                            </h1>
                            
						<?php else : ?>
							
                            <p class="site-title">
                            	<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                        
									<?php bloginfo( 'name' ); ?>
                            
                    			</a> 
                            </p>
                            
						<?php endif; ?>
						
							
						<p class="site-description">
							<?php echo get_bloginfo( 'description', 'display' ); ?>
                        </p>
						
				<?php endif; ?> 