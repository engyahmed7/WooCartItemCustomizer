<?php

use Automattic\WooCommerce\Blocks\Integrations\IntegrationInterface;

require_once WP_PLUGIN_DIR . '/woocommerce/src/Blocks/Integrations/IntegrationInterface.php';

class WooCommerce_Example_Plugin_Integration implements IntegrationInterface
{
    public function get_name()
    {
        return 'woocommerce-example-plugin';
    }

    public function initialize()
    {
        $script_path = '/build/index.js';
        $style_path = '/build/style-index.css';

        $script_url = plugins_url($script_path, __FILE__);
        // error_log($script_url);
        $style_url = plugins_url($style_path, __FILE__);

        $script_asset_path = plugin_dir_path(__FILE__) . 'build/index.asset.php';
        $script_asset = file_exists($script_asset_path)
            ? require $script_asset_path
            : ['dependencies' => [], 'version' => $this->get_file_version($script_path)];

        wp_enqueue_style(
            'woocommerce-example-plugin-style',
            $style_url,
            [],
            $this->get_file_version($style_path)
        );

        wp_register_script(
            'woocommerce-example-plugin-script',
            $script_url,
            $script_asset['dependencies'],
            $script_asset['version'],
            true
        );

        wp_set_script_translations(
            'woocommerce-example-plugin-script',
            'woocommerce-example-plugin',
            plugin_dir_path(__FILE__) . 'languages'
        );
    }

    public function get_script_handles()
    {
        return ['woocommerce-example-plugin-script'];
    }

    public function get_editor_script_handles()
    {
        return ['woocommerce-example-plugin-script'];
    }

    public function get_script_data()
    {
        return [
            'some_data_key' => 'Some Data Value',
        ];
    }

    protected function get_file_version($file)
    {
        return defined('SCRIPT_DEBUG') && SCRIPT_DEBUG && file_exists(plugin_dir_path(__FILE__) . $file)
            ? filemtime(plugin_dir_path(__FILE__) . $file)
            : '1.0.0';
    }
}