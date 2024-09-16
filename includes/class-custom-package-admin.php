<?php

class Custom_Package_Admin
{

    public function init()
    {
        add_action('woocommerce_product_data_tabs', array($this, 'add_tab'));
        add_action('woocommerce_product_data_panels', array($this, 'add_fields'));
        add_action('woocommerce_process_product_meta', array($this, 'save_fields'));
    }

    /**
     * Add a custom tab to the product data section.
     */
    public function add_tab($tabs)
    {
        $tabs['package'] = array(
            'label'    => __('Package', 'custom-package-plugin'),
            'target'   => 'package_product_data',
            'class'    => array('show_if_simple', 'show_if_subscription'),
            'priority' => 50,
        );
        return $tabs;
    }

    /**
     * Add custom fields to the custom tab.
     */
    public function add_fields()
    {
        global $post;
        $package_data = get_post_meta($post->ID, '_package_data', true);
?>
<div id='package_product_data' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <?php
                woocommerce_wp_text_input(array(
                    'id'          => '_package_simple',
                    'label'       => __('Simple Package', 'custom-package-plugin'),
                    'description' => __('Enter the quantity for Simple Package.', 'custom-package-plugin'),
                    'type'        => 'number',
                    'desc_tip'    => true,
                    'value'       => isset($package_data['simple']) ? esc_attr($package_data['simple']) : '',
                ));
                woocommerce_wp_text_input(array(
                    'id'          => '_package_back',
                    'label'       => __('Back Package', 'custom-package-plugin'),
                    'description' => __('Enter the quantity for Back Package.', 'custom-package-plugin'),
                    'type'        => 'number',
                    'desc_tip'    => true,
                    'value'       => isset($package_data['back']) ? esc_attr($package_data['back']) : '',
                ));
                woocommerce_wp_text_input(array(
                    'id'          => '_package_parallel',
                    'label'       => __('Parallel Package', 'custom-package-plugin'),
                    'description' => __('Enter the quantity for Parallel Package.', 'custom-package-plugin'),
                    'type'        => 'number',
                    'desc_tip'    => true,
                    'value'       => isset($package_data['parallel']) ? esc_attr($package_data['parallel']) : '',
                ));
                ?>
    </div>
</div>
<?php
    }

    /**
     * Save custom field values.
     *
     * @param int $post_id Product ID.
     */
    public function save_fields($post_id)
    {
        $simple = isset($_POST['_package_simple']) ? sanitize_text_field($_POST['_package_simple']) : '';
        $back = isset($_POST['_package_back']) ? sanitize_text_field($_POST['_package_back']) : '';
        $parallel = isset($_POST['_package_parallel']) ? sanitize_text_field($_POST['_package_parallel']) : '';

        $package_data = array('simple' => $simple, 'back' => $back, 'parallel' => $parallel);
        update_post_meta($post_id, '_package_data', $package_data);
    }
}
?>