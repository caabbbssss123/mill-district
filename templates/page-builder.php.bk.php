<?php
/**
 * Template Name: Page Builder
 */

get_header();

if (post_password_required()) :

	get_template_part('partials/password_protected/password_form');

else :

	if ( have_posts() ) while ( have_posts() ) : the_post();
	$page_title			= get_the_title();
	$page_rows			= get_field('page_rows');
	$first_background	= (!empty($page_rows)) ? $page_rows[ 0 ]['background_colour'] : 'white';

	if (!is_front_page())
		$i				= 1;
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(sanitize_title($page_title)); ?>>

		<?php
		if (is_front_page()) {
			get_template_part('partials/home_page/page_banner');
		} else {
			get_template_part('partials/page_builder/page_banner');
		}

		get_template_part('partials/page_builder/page_builder_rows');
		?>

	</article>

	<?php 
	endwhile;

endif;

get_footer();
?>