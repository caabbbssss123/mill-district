<?php
/**
 * The Header for our theme.
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/favicon/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri() ?>/favicon/favicon.svg" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/favicon/favicon.ico" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/favicon/apple-touch-icon.png" />
	<meta name="apple-mobile-web-app-title" content="The Mill District" />
	<link rel="manifest" href="<?php echo get_template_directory_uri() ?>/favicon/site.webmanifest" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/assets/css/outdatedbrowser.min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="smooth-wrapper">
		<div id="smooth-content">

	<div class="menu-backdrop" aria-hidden="true"></div>
	<header id="main-header" aria-label="Main Header">
		<div id="main-menu" class="main-menu">
			<div class="container-fluid">
				<nav aria-label="<?php echo esc_attr_x( 'Primary', 'header', 'the-mill-district' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
						)
					);
					?>
					<?php if ( have_rows( 'social_links', 'options' ) ) : ?>
						<ul class="social-links">
							<?php
							while ( have_rows( 'social_links', 'options' ) ) :
								the_row();
								$social_media = get_sub_field( 'social_media' );
								$social_url   = get_sub_field( 'url' );

								if ( ! $social_url ) {
									continue;
								}
								?>
								<li>
									<a href="<?php echo esc_url( $social_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $social_media ); ?></a>
								</li>
								<?php
							endwhile;
							?>
						</ul>
					<?php endif; ?>
				</nav>
			</div>
		</div>
		<div class="container-fluid">
			<div class="inner-wrapper">
				<div class="nav-wrapper">
					<button type="button" class="navbar-toggle collapsed" aria-label="<?php echo esc_attr_x( 'Menu', 'header', 'the-mill-district' ); ?>" aria-expanded="false" aria-controls="main-menu">
						<span class="navbar-toggle-text"><?php echo esc_html_x( 'Menu', 'header', 'the-mill-district' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="logo-wrapper">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<?php get_template_part('assets/img/svg/header-logo'); ?>
					</a>
				</div>
				<div class="button-wrapper">
					<?php
					$header_button_link = get_field( 'header_button_link', 'options' );

					if ( $header_button_link ) {
						get_template_part(
							'partials/components/button',
							null,
							array(
								'url'    => $header_button_link['url'],
								'title'  => $header_button_link['title'],
								'target' => $header_button_link['target'],
								'class'  => 'btn-primary',
							)
						);
					}
					?>
				</div>
			</div>
		</div>
	</header>

	<main>