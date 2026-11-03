<?php
/**
 * The template for displaying the footer.
 */ 
?>
</main>

<?php
$has_contact_section = is_singular() && has_block( 'acf/contact-section', get_queried_object_id() );
$footer_classes      = 'footer' . ( $has_contact_section ? ' footer--contact' : '' );
?>

<footer id="footer" class="<?php echo esc_attr( $footer_classes ); ?>">
	<div class="container-fluid">
		<div class="footer__logo-small fadeIn">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<?php get_template_part( 'assets/img/svg/footer-logo-small' ); ?>
			</a>
		</div>

		<div class="row footer__columns">
			<div class="col-12 col-lg-3 col-left fadeInLeft">
				<?php
				$footer_copy = get_field( 'footer_copy', 'options' );

				if ( $footer_copy ) :
					?>
					<div class="footer__copy">
						<?php echo wp_kses_post( wpautop( $footer_copy ) ); ?>
					</div>
					<?php
				endif;
				?>
			</div>

			<div class="col-12 col-lg-3 col-middle fadeInUp delayShort">
				<nav class="footer__menus" aria-label="<?php echo esc_attr_x( 'Footer', 'footer', 'the-mill-district' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);

					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
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

			<?php if ( ! $has_contact_section ) : ?>
				<div class="col-12 col-lg-6 footer__form-column fadeInRight">
					<?php
					$footer_form_heading     = get_field( 'footer_form_heading', 'options' );
					$gravity_form_shortcode  = get_field( 'gravity_form_shortcode', 'options' );
					$footer_form_description = get_field( 'footer_form_description', 'options' );

					if ( $footer_form_heading ) :
						?>
						<p class="footer__form-heading"><?php echo esc_html( $footer_form_heading ); ?></p>
						<?php
					endif;

					if ( $gravity_form_shortcode ) :
						?>
						<div class="footer__form" id="register">
							<?php echo do_shortcode( $gravity_form_shortcode ); ?>
						</div>
						<?php
					endif;

					if ( $footer_form_description ) :
						?>
						<p class="footer__form-description"><?php echo esc_html( $footer_form_description ); ?></p>
						<?php
					endif;
					?>
				</div>
			<?php endif; ?>
		</div>

		<div class="footer__meta fadeIn">
			<p class="footer__copyright">&copy; The Mill District <?php echo esc_html( wp_date( 'Y' ) ); ?></p>
			<p class="footer__credit">
				<?php echo esc_html_x( 'Website by', 'footer', 'the-mill-district' ); ?>
				<a href="https://supercurious.au/" target="_blank" rel="noopener noreferrer">Supercurious</a>
			</p>
		</div>

		<div class="footer__logo-large slideInUp">
			<a href="<?php bloginfo('url') ?>">
				<?php get_template_part( 'assets/img/svg/footer-logo-large' ); ?>
			</a>
		</div>
	</div>
</footer>

		</div>
	</div>

<?php do_action('shortcode_output'); ?>

<div id="outdated"></div>
<script src="<?php echo get_bloginfo('template_url'); ?>/assets/js/outdatedbrowser.min.js"></script>
<script>
	//event listener: DOM ready
	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				if (oldonload) {
					oldonload();
				}
				func();
			}
		}
	}
	//call plugin function after DOM ready
	addLoadEvent(function() {
		outdatedBrowser({
			bgColor: '#f25648',
			color: '#ffffff',
			lowerThan: 'borderImage',
			languagePath: '<?php echo get_bloginfo('template_url'); ?>/assets/js/lang/en.html'
		})
	});
</script>

<!--[if lt IE 9]>
		  <script src="<?php echo get_bloginfo('template_url'); ?>/assets/js/html5shiv.js"></script>
		  <script src="<?php echo get_bloginfo('template_url'); ?>/assets/js/respond.min.js"></script>
		<![endif]-->

<?php wp_footer(); ?>

</body>

</html>