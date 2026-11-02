<?php
/**
 * Template Name: Contact Page
 */

get_header();

if (post_password_required()) :

	get_template_part('partials/password_protected/password_form');

else :

	if ( have_posts() ) while ( have_posts() ) : the_post();
	$page_title				= get_the_title();
	$page_content			= get_the_content();
	$background_colour		= get_field('background_colour');
	$contact_form			= get_field('contact_form');

	switch($background_colour) {
		case 'white':
			$tile_colour	= 'grey';
			break;
		default:
			$tile_colour	= 'white';
	}
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(sanitize_title($page_title)); ?>>

		<?php get_template_part('partials/contact_page/page_header'); ?>

		<section class="content-area-x2 background-<?php echo $background_colour; ?>">
			<div class="grid-container">
				<div class="grid-x grid-padding-x grid-padding-y">
					<div class="cell large-6">
						<?php 
						if ($page_content) echo do_shortcode('<div class="wysiwyg">' . apply_filters('the_content', $page_content) . '</div>');

						get_template_part('partials/contact_page/contact_details');
						?>
					</div>
					<?php if ($contact_form) echo '<div class="cell large-6"><div class="boxed-content background-' . $tile_colour . '">' . do_shortcode('[gravityform id="' . $contact_form . '" title="false" description="false" ajax="true" tabindex="50"]') . '</div></div>'; ?>
				</div>
			</div>
		</section>

		<?php get_template_part('partials/contact_page/location_map'); ?>

	</article>

	<?php 
	endwhile;

endif;

get_footer();
?>