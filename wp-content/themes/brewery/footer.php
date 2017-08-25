<?php global $WOWTheme; ?>
  
</div>	</div></div>

<?php	
if ($WOWTheme->get( 'social', 'showsocial')) {
	$WOWTheme->block_social();
}
?>
<div id='content-bottom' class='container'></div>
<div id='footer'>
		<div class='container clearfix'>
			
			<?php if ($WOWTheme->get("layout","footerwidgets")) { ?>
			<div class='footer-widgets-container'><div class='footer-widgets'>
				<div class='widgetf'>
					<?php 
					if ( !function_exists("dynamic_sidebar") || !dynamic_sidebar("footer_1") ) {
						;
					} ?>
				</div>
				
				<div class='widgetf'>
					<?php 
					if ( !function_exists("dynamic_sidebar") || !dynamic_sidebar("footer_2") ) {
						;
					} ?>
				</div>
				
				<div class='widgetf widgetf_last'>
					<?php if ( !function_exists("dynamic_sidebar") || !dynamic_sidebar("footer_3") ) {
						;
					} ?>
				</div>
			</div></div>
			<?php } ?>
			
		</div>
		
		<div class='footer_txt'>
			<div class='container'>
				<div class='top_text'>
				<?php
                    if ($WOWTheme->get( "layout","footertext" )) {
                        echo $WOWTheme->get( "layout","footertext" );
                    } else { 
                        ?>Copyright &copy; <?php echo date("Y"); ?>  <a href="<?php echo home_url(); ?>"><?php bloginfo("name"); ?></a><?php
						echo (get_bloginfo('description'))?' - '.get_bloginfo('description'):'';
                    }
                ?>
				</div>
				<div class='wpwow'>Designed by <a href='http://wpwow.com/' target='_blank'>WPWOW.com</a>, thanks to: <a href='http://wpdis.co/free/spapress/' target='_blank'>Free medicine WordPress themes</a>, <a href='http://lizardthemes.com' target='_blank'>LizardThemes.com</a> and <a href='http://fthe.me' target='_blank'>FThe.me</a></div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</div> <?php //footer ?>
</div> <?php //all ?>
<?php
	echo $WOWTheme->get( "integration","footercode" );
?>
</body>
</html>