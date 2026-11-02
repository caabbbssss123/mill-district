<?php
/**
 * The template for displaying all pages.
 */

get_header();

if (post_password_required()) :

	get_template_part('partials/password_protected/password_form');

else :

	if ( have_posts() ) while ( have_posts() ) : the_post();
	$page_title		= get_the_title();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(sanitize_title($page_title)); ?>>

		<section class="content-area-x2">
			<div class="grid-container">
				<div class="grid-x grid-padding-x">
					<div class="cell large-10 xlarge-8 wysiwyg">
						<div class="js-ajax-content">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

	</article>

	<?php 
	endwhile;

endif;

get_footer();
?>