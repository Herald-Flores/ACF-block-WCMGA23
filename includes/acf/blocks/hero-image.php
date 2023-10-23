<?php
/**
 * Hero block
 * 
 * @link https://www.advancedcustomfields.com/resources/blocks/
 * @package acf-block-wcmga23
 * @since 1.0
 */


acf_register_block_type(
	array(
		'name'              => 'hero-image',
		'title'             => __( 'Hero Image Block', 'wcmga23' ),
		'description'       => __( 'hero custom block', 'wcmga23' ),
		'render_template'   => dirname( __file__ ) . '/template/hero-image/index.php',
		'category'          => CATEGORYHEROS, // formatting
		'icon'              => array(
			'background' => $iconBackground,
			'foreground' => $iconForeground,
			'src'        => 'cover-image',
		),
		'keywords'          => array( 'hero image', 'custom' ),
		'mode'              => 'preview',
		'align'             => 'full',
		'supports'          => $supports,
		'example'           => array(
			'attributes' => array(
				'mode' => 'preview',
			),
		),
	)
);