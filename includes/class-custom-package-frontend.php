<?php
class Custom_Package_Frontend
{
    /**
     * Initialize the class by hooking into WooCommerce actions.
     */
    public function init()
    {
        add_action('woocommerce_before_add_to_cart_button', array($this, 'display_package_dropdown'));
    }

    /**
     * Display the package selection dropdown and dynamically update price and quantity on the product page.
     */
    public function display_package_dropdown()
    {
        global $post;
        $package_data = get_post_meta($post->ID, '_package_data', true);

        if (!$package_data) {
            return;
        }

        $product = wc_get_product($post->ID);
        $base_price = $product ? $product->get_price() : 0;
?>
        <div class="package-selection">
            <label for="package"><?php _e('Select Package:', 'custom-package-plugin'); ?></label>
            <select id="package" name="package">
                <option value="simple"><?php _e('Simple Package', 'custom-package-plugin'); ?></option>
                <option value="back"><?php _e('Back Package', 'custom-package-plugin'); ?></option>
                <option value="parallel"><?php _e('Parallel Package', 'custom-package-plugin'); ?></option>
            </select>
        </div>

<?php
    }
}
?>