<?php
/**
 * Custom Testimonials Block built with ACF
 * ACF-block-WCMGA23\includes\acf\blocks\testimonials\index.php
 * 
 * @since 1.0
 * @package ACF-block-WCMGA23
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'testimonial-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  if( $block['align'] == 'wide' ) {
    $class_name .= ' w-2xl mx-auto';
  } else if( $block['align'] == 'full' ) {
    $class_name .= ' min-w-full mx-auto';
  }else if( $block['align'] == 'left' ) {
    $class_name .= ' text-left justify-start';
  }else if( $block['align'] == 'right' ) {
    $class_name .= ' text-right justify-end';
  }
}

$block_title       = get_field( 'title' );
$block_description = get_field( 'description' );
$block_mode        = get_field( 'block_mode' );
?>



<section id="<?php echo esc_attr( $anchor ); ?>" class="<?php 
		echo esc_attr( $class_name );
		echo esc_attr(
			'dark' === $block_mode
		)
		? ' bg-gray-900'
		: ' bg-white'; 
		?>
	">
  <div class="py-8 px-4 text-center lg:py-16 lg:px-6">
    <div class="mx-auto max-w-screen-sm">
      <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-gray-50">
        <?php the_field('block_title'); ?>
      </h2>
      <p class="mb-8 font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">
        <?php the_field('block_description'); ?>
      </p>
    </div> 
    <?php if( have_rows('testimonial_list') ): ?>
    <div class="grid mb-8 lg:mb-12 lg:grid-cols-2">
      <?php while( have_rows('testimonial_list') ): the_row(); ?>
      <figure class="flex flex-col justify-center items-center p-8 text-center bg-gray-50 border-b border-gray-200 md:p-12 lg:border-r dark:bg-gray-800 dark:border-gray-700">
        <blockquote class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?php the_sub_field('title_testimonial'); ?>
          </h3>
          <p class="my-4">
            <?php the_sub_field('testimonial_body'); ?>
          </p>
        </blockquote>
        <figcaption class="flex justify-center items-center space-x-3">
          <?php
            $image_url = get_sub_field('user_image');
            $image_url = $image_url['url'];
          ?>
          <img class="w-9 h-9 rounded-full" src="<?php echo esc_url( $image_url ); ?>" alt="Herald Flores profile picture">
          <div class="space-y-0.5 font-medium dark:text-white text-left">
            <div><?php the_sub_field('user_name'); ?></div>
            <div class="text-sm font-light text-gray-500 dark:text-gray-400">
              <?php the_sub_field('user_job_title'); ?>
            </div>
          </div>
        </figcaption>    
      </figure>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>
  </div>
</section>