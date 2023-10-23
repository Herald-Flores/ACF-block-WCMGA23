<?php
/** 
  * load acf files from ./acf folder  
  */

const CATEGORYDEFAULT = 'blocks';
const CATEGORYHEROS   = 'blocks_heros';
const CATEGORYSLIDER  = 'blockssliders';

/**
 * Register block categories.
 * Here we can and more custom categories to organize our blocks
 */
function wcmga_block_cat( $categories, $post ) {
  return array_merge(
    $categories,
    array(
      array(
        'slug'  => CATEGORYDEFAULT,
        'title' => esc_html__( 'WCMGA Blocks', 'wcmga23' ),
      ),
      array(
        'slug'  => CATEGORYHEROS,
        'title' => esc_html__( 'WCMGA - Heros', 'wcmga23' ),
      ),
      array(
        'slug'  => CATEGORYSLIDER,
        'title' => esc_html__( 'WCMGA - Sliders', 'wcmga23' ),
      ),
    )
  );
}
add_filter( 'block_categories', 'wcmga_block_cat', 10, 2 );

/**
 * Registers the ACF block types.
 *
 * This function dynamically loads block types based on the block types directory.
 * It supports align Blocks and anchors.
  */
function register_acf_block_types() {
  // Define the block types support options, Align Available settings are “left”, “center”, “right”, “wide” and “full”
  $supports = array(
    'align'  => array( 'wide', 'full' ),
    'anchor' => true,
  );

  // Define the icon colors
  $iconForeground = '#ffffff';
  $iconBackground = '#8d0fbe';

  // Register the block types
  $block_files = glob( __DIR__ . '/acf/blocks/*.php' ); // Get all block files .php
  foreach ( $block_files as $block_file ) {
    include_once $block_file;
  }

  $block_json_files = glob( __DIR__ . '/acf/blocks/*.json' ); // Get all block json files
  foreach ( $block_json_files as $block_json_file ) {
    $block_data = json_decode( file_get_contents( $block_json_file ), true );
    acf_register_block_type( $block_data );
  }

}
add_action( 'acf/init', 'register_acf_block_types' );
