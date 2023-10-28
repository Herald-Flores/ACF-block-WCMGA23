<?php
/**
 * Hero ACF Custom Block Render
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$title       = get_field( 'title' ) ? get_field( 'title' ) : 'Title here...';
$description = get_field( 'description' ) ? get_field( 'description' ) : 'description here';
$image       = get_field( 'image' ) ? get_field( 'image' ) : 295;
$size        = 'full'; // (thumbnail, medium, large, full or custom size)
$mode        = get_field( 'mode' );
$txt_align   = get_field( 'align_text' );
?>

<section 
	id="<?php echo esc_attr( $anchor ); ?>" 
	class="
		<?php 
		echo esc_attr( $class_name );
		echo esc_attr(
			'dark' === $mode
		)
		? ' bg-gray-900'
		: ' bg-white'; 
		?>
	">
	<div class="grid max-w-screen-2xl px-4 lg:p-0 py-4  mx-auto lg:gap-8 lg:grid-cols-12">
		<div class="mr-auto place-self-center lg:col-span-6 
			<?php 
			echo 'left' ===
			$txt_align
			? 'order-first lg:pl-5'
			: 'order-last lg:pl-0'; 
			?>
		">
			<h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl 
				<?php	echo esc_attr( 'dark' === $mode ) ? 'text-white' : 'text-gray-900'; ?>">
				<?php echo esc_html( $title ); ?>
			</h1>
			<div class="max-w-2xl mb-6 font-light lg:mb-8 md:text-lg lg:text-xl 
			<?php 
			echo esc_attr(
				'dark' === $mode
			)
				? 'text-gray-200'
				: 'text-gray-600'; 
			?>
				">
				<?php echo $description; ?>
			</div>
		</div>
		<div class="hidden lg:mt-0 lg:col-span-6 lg:flex">
			<?php if ( ! empty( $image ) ) : ?>
				<img src="
					<?php 
						echo esc_url(
							$image['url']
						); 
					?>
					" 
					alt="<?php echo esc_attr( $image['alt'] ); ?>" />
			<?php endif; ?>
		</div>                
	</div>
</section>
