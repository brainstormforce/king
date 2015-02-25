<header id="masthead" class="site-header header-style1" role="banner">
	<div class="header-box <?php if( get_theme_mod( 'logo-img' ) ) {  echo 'header-logo-menu';}?>">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="king-main-menu-container clear">
		        <div class="header-logo">
		        	<?php if( get_theme_mod( 'logo-img' ) ) { ?>

		        		<h1 class="site-title">
			        		<a class="king-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">                
								<img class="king-logo-img" src="<?php echo get_theme_mod( 'logo-img' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="<?php // echo get_theme_mod( 'logo_width' ); ?>" height="<?php echo get_theme_mod( 'logo_height' ); ?>">
							</a>        
			  			</h1>

		        	<?php } else { ?>

			        	<h1 class="site-title">
			        		<a class="king-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">                
								<?php bloginfo( 'name' ); ?>
							</a>        
			  			</h1>
			  			<?php if( get_theme_mod( 'display_description_text' )) { ?>
				  			<h2 class="site-description">
								<?php 
									if(	get_bloginfo( 'description' ) !== ""){
										echo ' <span class="desc-sep">|</span><span class="blog-description site-description">';
										bloginfo( 'description' );
										echo '</span>';
									}
								?>
				  			</h2>
			  			<?php } //end if ?>

		  			<?php } ?>

				</div>

				<span class="menu-toggle-wrap fa fa-bars"></span>
			
				<?php wp_nav_menu( array( 
					'theme_location' 	=> 'primary', 
					'menu_class' 		=> 'nav-menu', 
					'container'       	=> 'div',
					'container_class' 	=> 'primary-menu-container',
				) ); ?>

		    </div><!--.king-main-menu-container-->
		</nav><!-- #site-navigation -->
	</div><!-- header-menu -->
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
	<?php endif; ?>
</header><!-- #masthead -->