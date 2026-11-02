<?php

add_filter( 'register_block_type_args', 'mill_district_remove_default_blocks', 10, 2 );
function mill_district_remove_default_blocks( array $args, string $block_type ) {

	if (is_admin()) {
		return [];
	}

	return $args;
}


add_filter( 'block_categories_all', 'mill_district_block_category', 10, 2);
function mill_district_block_category( $categories, $post ) {
	
	$categories[] = [ 'slug' => 'mill-district', 'title' => 'The Mill District' ];
	return $categories;

}


// Gutenberg ACF blocks
add_action('acf/init', 'mill_district_acf_init_block_types');

function mill_district_acf_init_block_types() {

	if( !function_exists('acf_register_block_type') ) {
		return;
	}

	$theme_color = '#834af5';

	acf_register_block_type(
		array(
			'name'              => 'example',
			'title'             => __('Example'),
			'description'       => __('Example ACF block.'),
			'render_template'   => 'partials/acf-blocks/example.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'embed-generic',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'Example' ),
			'align'	 			=> 'full',
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'hero-banner',
			'title'             => __('Hero Banner'),
			'description'       => __('Heading with a muted background video and a full-video popup.'),
			'render_template'   => 'partials/acf-blocks/hero-banner.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'format-video',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'hero', 'banner', 'video' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'two-column-media-and-text',
			'title'             => __('Two Column Media and Text'),
			'description'       => __('Copy with a small image and stamp beside a large image.'),
			'render_template'   => 'partials/acf-blocks/two-column-media-and-text.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'columns',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'two column', 'media', 'text', 'image' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'content-carousel',
			'title'             => __('Content Carousel'),
			'description'       => __('A left-aligned carousel of image, heading, and copy slides.'),
			'render_template'   => 'partials/acf-blocks/content-carousel.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'slides',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'carousel', 'slider', 'content' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'split-text-and-image',
			'title'             => __('Split Text and Image'),
			'description'       => __('Heading and copy beside an image with an overlapping stamp.'),
			'render_template'   => 'partials/acf-blocks/split-text-and-image.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'align-pull-right',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'split', 'text', 'image', 'stamp' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'two-column-media-and-text-with-cta',
			'title'             => __('Two Column Media and Text with CTA'),
			'description'       => __('A large and small image beside copy, a statement, and a button.'),
			'render_template'   => 'partials/acf-blocks/two-column-media-and-text-with-cta.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'columns',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'two column', 'media', 'text', 'cta' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'editorial-text-and-image',
			'title'             => __('Editorial Text and Image'),
			'description'       => __('Heading, copy, and a button beside a large image.'),
			'render_template'   => 'partials/acf-blocks/editorial-text-and-image.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'align-pull-right',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'editorial', 'text', 'image' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'centered-content-with-cta',
			'title'             => __('Centered Content with CTA'),
			'description'       => __('Centered heading, copy, and primary buttons.'),
			'render_template'   => 'partials/acf-blocks/centered-content-with-cta.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'align-center',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'centered', 'content', 'cta' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'sub-hero-banner',
			'title'             => __('Sub Hero Banner'),
			'description'       => __('A full-width muted video with a heading below.'),
			'render_template'   => 'partials/acf-blocks/sub-hero-banner.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'format-video',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'sub hero', 'banner', 'video', 'heading' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'two-column-label-and-text',
			'title'             => __('Two Column Label and Text'),
			'description'       => __('An uppercase label beside a column of copy.'),
			'render_template'   => 'partials/acf-blocks/two-column-label-and-text.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'editor-alignleft',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'two column', 'label', 'text', 'copy' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'content-list',
			'title'             => __('Content List'),
			'description'       => __('A list of headings and copy, with a portrait image for the hovered item.'),
			'render_template'   => 'partials/acf-blocks/content-list.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'list-view',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'content', 'list', 'image', 'hover' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'stats-columns',
			'title'             => __('Stats Columns'),
			'description'       => __('A row of statistic columns with a count-up number, prefix, suffix, and copy.'),
			'render_template'   => 'partials/acf-blocks/stats-columns.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'chart-bar',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'stats', 'columns', 'counter', 'numbers' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'image-banner',
			'title'             => __('Image Banner'),
			'description'       => __('A 16:9 image with a scroll parallax effect.'),
			'render_template'   => 'partials/acf-blocks/image-banner.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'format-image',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'image', 'banner', 'parallax' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'heading-with-stamp',
			'title'             => __('Heading with Stamp'),
			'description'       => __('A heading with a stamp aligned to the right.'),
			'render_template'   => 'partials/acf-blocks/heading-with-stamp.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'editor-textcolor',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'heading', 'stamp' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'image-with-stamp',
			'title'             => __('Image with Stamp'),
			'description'       => __('A stamp beside a large image.'),
			'render_template'   => 'partials/acf-blocks/image-with-stamp.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'format-image',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'image', 'stamp' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'faqs-accordion',
			'title'             => __('FAQs Accordion'),
			'description'       => __('A label beside an accordion of questions and answers.'),
			'render_template'   => 'partials/acf-blocks/faqs-accordion.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'editor-help',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'faq', 'faqs', 'accordion', 'questions' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'testimonials',
			'title'             => __('Testimonials'),
			'description'       => __('A row of quotes with a name and company.'),
			'render_template'   => 'partials/acf-blocks/testimonials.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'format-quote',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'testimonials', 'quotes' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

	acf_register_block_type(
		array(
			'name'              => 'contact-section',
			'title'             => __('Contact Section'),
			'description'       => __('A heading, contact form, and image in three columns.'),
			'render_template'   => 'partials/acf-blocks/contact-section.php',
			'category'          => 'mill-district',
			'icon'              => [
				'src' => 'email',
				'background' => $theme_color,
				'foreground' => '#fff',
			],
			'keywords'          => array( 'contact', 'form', 'image' ),
			'align'	 			=> 'full',
			'mode'              => 'preview',
			'supports'          => array(
				'align' => false,
			),
			'enqueue_assets'    => function() {}
		)
	);

}
