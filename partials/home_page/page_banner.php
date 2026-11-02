<?php // Page Banner

while( have_rows('page_banner') ): the_row();

$banners		= get_sub_field('banners');
$banner_count	= (!empty($banners)) ? count($banners) : 0;

if( have_rows('banners') ): ?>
<section class="banner-row position_relative">
	<?php /*<div class="flexslider<?php if ($banner_count <= 1) echo ' flexslider--hide-controls'; ?>">--> */ ?>
	<div class="swiper _swiper--overflow js-swiper<?php if ($banner_count <= 1) echo ' swiper--hide-controls'; ?>" data-effect="fade" data-centerSlides="false" data-autoplay="1" data-autoplayDelay="5000" data-pauseOnMouseEnter="1" data-speed="1000" data-spaceBetween="1.5" data-slidesPerView="1.4" _data-loop="true">
		<div class="swiper-wrapper grid-x" >
			<?php while( have_rows('banners') ): the_row(); 
			$banner_title		= get_sub_field('banner_title');
			$banner_content		= get_sub_field('banner_content');
			$background_image	= wp_get_attachment_image_src(get_sub_field('background_image'), 'large');
			$background_video	= get_sub_field('background_video');
			?>
			<div class="swiper-slide cell <?php if ($background_image || $background_video) echo 'background-image'; if ($banner_title) echo ' background-image--overlay'; ?>"<?php if ($background_image) echo ' style="background-image:url(' . $background_image[0] . ')"'; ?>> 
				<div class="grid-container banner-row__slide height_100 position_relative color-white content-area-x2">
					<?php /*<div class="grid-container content-area-x2 position_relative color-white align-self-middle">*/ ?>
						<div class="grid-x banner-row__slide__content content-area-x2 xxlarge-padding-left xxlarge-padding-right">
							<?php /*<div class="cell">*/ ?>
								<?php
								if ($banner_title) echo '<div class="cell grid-x"><div class="cell xxlarge-10"><h2 class="h1 fix_line_height">' . $banner_title . '</h2></div></div>';

								if ($banner_content) echo '<div class="cell grid-x padding-top-x2 wysiwyg"><div class="cell large-10 xlarge-8">' . coord_wpautop($banner_content, 'size-h6') . '</div></div>';

								if( have_rows('banner_buttons') ): ?>
								<div class="padding-top-x2">
									<div class="grid-x grid-x--small grid-padding-x grid-padding-y">
										<?php
										while ( have_rows( 'banner_buttons' ) ): the_row();
										$button_type	= get_sub_field('button_type');
										
										if ($button_type == 'default') :
										$button			= get_sub_field('button');
										$link_url		= $button['url'];
										$link_title		= $button['title'];
										$link_target	= $button['target'] ? $button['target'] : '_self';
										?>
										<div class="cell shrink">
											<a class="btn btn--white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
										</div>
										<?php
										elseif ($button_type == 'video') :
										$button_text	= get_sub_field('button_text');
										$video_url		= get_sub_field('video_url');
										?>
										<div class="cell shrink">
											<a class="btn btn--white" href="<?php echo esc_url( $video_url ); ?>" data-fancybox="banner"><?php echo esc_html( $button_text ); ?></a>
										</div>
										<?php
										endif;
										endwhile;
										?>
									</div>
								</div>
								<?php endif; ?>
							<?php /*</div>*/?>
						</div>
					<?php /*</div> */ ?>
					<?php if ($background_video) : ?>
					<div class="banner-row__video background-image<?php if ($banner_title) echo ' background-image--overlay'; ?>">
						<?php 
						/**
						 * SLIDER VIDEOS
						 *
						 * To allow videos to control the slider complete the following steps:
						 *
						 * 1. Add "onended=resumeslider('[data-videoSlider]')" to the video elemment
						 * 2. Remove the "autoplay" and "loop" variables from the video elemment
						 * 3. Add the "data-videoSlider" attribute to the slider
						 */
						?>
						<video class="js-banner-video" preload="auto" autoplay loop muted playsinline controlsList="nodownload">
							<source src="<?php echo $background_video; ?>" type="video/mp4">
						</video>
					</div>
					<?php endif; ?>
				</div> 
			</div>
			<?php endwhile; ?>
		</div>
		
	</div>
	
	<div class="banner-row__pagination padding-bottom">
		<div class="grid-container">
			<div class="grid-x grid-padding-x grid-padding-y align-middle <?php echo ($banner_count >= 2) ? 'align-justify' : 'align-center'; ?>">
				<?php if ($banner_count > 1 ) : ?>
				<div class="swiper-pagination"></div>
				<?php endif; ?>
				<div class="cell shrink">
					<a href="#" class="js-next-section">
						<span class="link-icon link-icon--white">
							<i class="fa-regular fa-arrow-down" aria-hidden="true">arrow down</i>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
endif;
endwhile;
?>