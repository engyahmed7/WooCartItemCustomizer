<?php

/**
 * Plugin Name: Custom Package Plugin
 * Description: Adds a custom "Package" tab to WooCommerce product data and adjusts quantity/pricing based on selected package.
 * Version: 1.1
 * Author: Engy Ahmed
 * text-domain: custom-package-plugin
 */

if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    return;
}

// Include files
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-package-plugin.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-package-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-package-frontend.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-package-cart.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-woocommerc-plugin-integration.php';

function register_woocommerce_example_plugin_integration($integration_registry)
{
    $integration_registry->register(new WooCommerce_Example_Plugin_Integration());
}

add_action('woocommerce_blocks_mini-cart_block_registration', 'register_woocommerce_example_plugin_integration');
add_action('woocommerce_blocks_cart_block_registration', 'register_woocommerce_example_plugin_integration');
add_action('woocommerce_blocks_checkout_block_registration', 'register_woocommerce_example_plugin_integration');




function run_custom_package_plugin()
{
    $plugin = new Custom_Package_Plugin();
    $plugin->run();
}

run_custom_package_plugin();