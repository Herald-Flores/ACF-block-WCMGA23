<?php 
/**
 * Plugin Name: ACF Block WCMGA23
 * Description: ACF Guttemberg Block WCMGA23 for WordPress
 * Version: 1.0
 * Author: WCMGA23
 * Author URI: https://github.com/Herald-Flores/ACF-block-WCMGA23
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wcmga23
 * Domain Path: /languages
 * Plugin URI: https://github.com/Herald-Flores/ACF-block-WCMGA23
 * @package wcmga23
 * @since 1.0
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'PLUGIN_VERSION', '1.0.0' );
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

class WCMGAClass {
  /**
   * Constructor for the class.
   *
   * Adds an action to the 'init' hook that calls the 'onInit' method of the current object.
   */
  function __construct() {
    $action = 'init';
    $callback = array($this, 'onInit');
    add_action($action, $callback);

    // Call check_acf_pro_activation in the constructor
    $this->check_acf_pro_activation();

    // Register the deactivation hook
    register_deactivation_hook(__FILE__, array($this, 'deactivatePlugin'));
  }

  /**
   * Checks if ACF Pro is activated and removes the alert from the plugin.
   *
   */
  function check_acf_pro_activation() {
    if (class_exists('acf_pro')) {
      // ACF Pro is activated, remove the alert from your plugin
      remove_action('admin_notices', array($this, 'my_plugin_acf_notice'));
    }
  }

  function my_plugin_acf_notice() {
    echo '<div class="error"><p>';
    echo 'We require ACF Pro plugin to use these blocks. <a href="https://www.advancedcustomfields.com/pro/" target="_blank">Upgrade to ACF Pro</a>.';
    echo '</p></div>';
  }

  /**
   * Deactivates the plugin.
   *
   * This function requires the file 'class-wcmga-deactivator.php' located in the 'includes'
   * directory of the plugin. It then calls the 'deactivate' method of the 'WCMGA_Deactivator'
   * class to deactivate the plugin.
   */
  function deactivatePlugin() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-wcmga-deactivator.php';
    WCMGA_Deactivator::deactivate();
  }
  
  /**
   * Initializes the function.
   *
   */
  function onInit() {
    add_action('admin_init', array($this, 'check_acf_pro_activation'));
    add_action('admin_notices', array($this, 'my_plugin_acf_notice'));
    add_action('admin_enqueue_scripts', array($this, 'load_admin_css'));
    add_action('wp_enqueue_scripts', array($this, 'wcmga_enqueue_scripts'));

    add_theme_support( 'align-wide' );
  }

  function wcmga_enqueue_scripts() {
    // Enqueue custom JavaScript file
    wp_enqueue_script(
      'wcmga-script',
      plugins_url('dist/js/index.js', __FILE__),
      array('jquery'),
      '1.0',
      true
    );

    // Enqueue custom CSS file
    wp_enqueue_style(
      'wcmga-style',
      plugins_url('dist/index.css', __FILE__),
      array(),
      '1.0'
    );
  }

  function load_admin_css() {
    wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . 'admin/css/main.css');
    wp_enqueue_style('blocks-styles', plugin_dir_url(__FILE__) . 'dist/index.css');
  }

  // Create a function lo load the ACF config from /includes/acf-config.php
  function load_acf_config() {
    require_once plugin_dir_path(__FILE__) . 'includes/acf-config.php';
  }
}

/**
 * Instantiates the class.
 */
$WCMGA = new WCMGAClass();
$WCMGA->load_acf_config();
