<?php // Contact Details
global $page_content;

$email_address		= get_field('email_address', 'option');
$phone_number		= get_field('phone_number', 'option');

$address			= get_field('address', 'option');
$address_output		= '';
if (!empty($address)) {

	if ($address['url']) {
		$address_url	= $address['url'];
		unset($address['url']);
	}

	$address			= array_filter($address);
	$address_output		= implode('<br>', $address);
}

$facebook_url		= get_field('facebook_url', 'option');
$instagram_url		= get_field('instagram_url', 'option');
$twitter_url		= get_field('twitter_url', 'option');
$linkedin_url		= get_field('linkedin_url', 'option');
$youtube_url		= get_field('youtube_url', 'option');

if ($email_address || $phone_number || $address || $facebook_url || $instagram_url || $twitter_url || $linkedin_url || $youtube_url) : ?>
<div class="<?php if ($page_content) echo 'padding-top-x2'; ?>">
	<div class="grid-x grid-padding-x grid-padding-y">
		<?php if ($phone_number) : ?>
		<div class="cell medium-6">
			<a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a>
		</div>
		<?php endif; ?>
		<?php if ($email_address) : ?>
		<div class="cell medium-6">
			<a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a>
		</div>
		<?php endif; ?>
		<?php if (!empty($address)) : ?>
		<div class="cell medium-6 ">
			<address><?php
				if ($address_url) echo '<a href="' . esc_url($address_url) . '" target="_blank">';
				echo $address_output;
				if ($address_url) echo '</a>';
			?></address>
		</div>
		<?php endif; ?>
		<?php if ($facebook_url || $instagram_url || $twitter_url || $linkedin_url || $youtube_url) : ?>
		<div class="cell medium-6">
			<div class="grid-x grid-x--xsmall grid-padding-x grid-padding-y">
				<?php if ($facebook_url) : ?>
				<div class="cell shrink"> 
					<a target="_blank" href="<?php echo esc_url($facebook_url); ?>"><span class="link-icon"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></span></a> 
				</div>
				<?php endif; ?>
				<?php if ($instagram_url) : ?>
				<div class="cell shrink"> 
					<a target="_blank" href="<?php echo esc_url($instagram_url); ?>"><span class="link-icon"><i class="fa-brands fa-instagram" aria-hidden="true"></i></span></a> 
				</div>
				<?php endif; ?>
				<?php if ($twitter_url) : ?>
				<div class="cell shrink"> 
					<a target="_blank" href="<?php echo esc_url($twitter_url); ?>"><span class="link-icon"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></span></a> 
				</div>
				<?php endif; ?>
				<?php if ($linkedin_url) : ?>
				<div class="cell shrink"> 
					<a target="_blank" href="<?php echo esc_url($linkedin_url); ?>"><span class="link-icon"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></span></a> 
				</div>
				<?php endif; ?>
				<?php if ($youtube_url) : ?>
				<div class="cell shrink"> 
					<a target="_blank" href="<?php echo esc_url($youtube_url); ?>"><span class="link-icon"><i class="fa-brands fa-youtube" aria-hidden="true"></i></span></a> 
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
endif;
?>