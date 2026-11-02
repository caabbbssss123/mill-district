<?php
/**
 * Template Name: Plain
 */

get_header();
global $post;
?>

<article id="post-<?php the_ID(); ?>">
	
	<?php while(have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>

</article>

<?php get_footer(); ?>