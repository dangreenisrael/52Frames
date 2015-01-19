<div class="clearfix pull-right navbar">
	<div class="navbar-inner">

			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<?php if ( of_get_option( 'navbar_title' ) ): 
			$logo = of_get_option( 'navbar_title' ) ?>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php echo $logo ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				</a>
			<?php endif; ?>

			<div class="nav-collapse collapse">

				<nav id="nav-main" role="navigation">
					<?php
					if ( has_nav_menu( 'header-menu' ) ) :
						wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav' ) );
					else:
						wp_nav_menu( array( 'menu_class' => 'nav', 'depth' => '1', 'walker' => null ) );
					endif;
					?>
				</nav> <!-- #nav-main -->

				<?php if ( of_get_option( 'navbar_search' ) ): ?>
				<form style="display:none;" id="search-form" class="navbar-form pull-right" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
					<input type="text" name="s" id="s" class="input-medium">
					<button type="submit" class="btn"><i class="fa fa-search"></i></button>
				</form><!-- .navbar-form -->
				<?php endif; ?>

			</div>

	</div>
</div><!-- .navbar -->