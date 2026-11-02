<?php
/**
 * Button
 *
 * Called with get_template_part(). Pass the link values in $args:
 *
 * get_template_part( 'partials/components/button', null, array(
 *     'url'    => 'https://example.com',
 *     'title'  => 'Learn more',
 *     'target' => '_blank',
 *     'class'  => 'btn-primary',
 * ) );
 *
 * @param array $args {
 *     @type string $url    Link URL. Required.
 *     @type string $title  Link text. Required.
 *     @type string $target Link target. Default _self.
 *     @type string $class  Extra class names, appended to btn.
 * }
 */

$url    = isset( $args['url'] ) ? $args['url'] : '';
$title  = isset( $args['title'] ) ? $args['title'] : '';
$target = ! empty( $args['target'] ) ? $args['target'] : '_self';
$class  = isset( $args['class'] ) ? $args['class'] : '';

if ( ! $url || '' === $title ) {
	return;
}

$allowed_targets = array( '_self', '_blank', '_parent', '_top' );

if ( ! in_array( $target, $allowed_targets, true ) ) {
	$target = '_self';
}

$classes = trim( 'btn ' . $class );
?>
<a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>"<?php echo '_blank' === $target ? ' rel="noopener noreferrer"' : ''; ?>>
	<span><?php echo esc_html( $title ); ?></span>
</a>
