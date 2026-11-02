<?php // Location Map

$location	= get_field('location', 'option');

if ($location) : ?>
<section class="location-map" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></section>
<?php endif; ?>