<?php
class Custom_Package_Cart
{
    public function init()
    {
        add_filter('woocommerce_add_to_cart_quantity', array($this, 'adjust_quantity'), 10, 2);
        add_action('woocommerce_add_cart_item_data', array($this, 'save_package_selection'), 10, 2);
        add_filter('woocommerce_get_item_data', array($this, 'display_package_in_cart'), 10, 2);
        add_action('woocommerce_before_calculate_totals', array($this, 'modify_cart_item_price_based_on_quantity'), 10, 1);
    }

    /**
     * Modify the cart item price based on the quantity.
     * @param mixed $cart
     * @return void
     */
    public function modify_cart_item_price_based_on_quantity($cart)
    {
        if (is_admin() && ! defined('DOING_AJAX')) {
            return;
        }

        foreach ($cart->get_cart() as $cart_item) {
            $quantity = $cart_item['quantity'];

            if ($quantity == 23) {
                $new_price = 5;
                $cart_item['data']->set_price($new_price);
            }
        }
    }
    /**
     * Adjust the quantity based on the selected package.
     *
     * @param int $quantiaty Quantity to adjust.
     * @param int $product_id Product ID.
     * @return int Adjusted quantity.
     */
    public function adjust_quantity($quantity, $product_id)
    {
        $package_data = get_post_meta($product_id, '_package_data', true);

        if (isset($_POST['package']) && $package_data) {
            $selected_package = sanitize_text_field($_POST['package']);
            if (isset($package_data[$selected_package])) {
                $package_value = (int) $package_data[$selected_package];
                return $quantity + $package_value;
            }
        }

        return $quantity;
    }

    /**
     * Save the selected package and adjusted quantity in the cart item.
     *
     * @param array $cart_item_data Cart item data.
     * @param int $product_id Product ID.
     * @return array Modified cart item data.
     */
    public function save_package_selection($cart_item_data, $product_id)
    {
        if (isset($_POST['package'])) {
            $cart_item_data['package'] = sanitize_text_field($_POST['package']);
        }
        if (isset($_POST['quantity'])) {
            $cart_item_data['custom_quantity'] = sanitize_text_field($_POST['quantity']);
        }
        return $cart_item_data;
    }

    /**
     * Display the selected package in the cart.
     *
     * @param array $item_data Existing item data.
     * @param array $cart_item Cart item data.
     * @return array Modified item data.
     */
    public function display_package_in_cart($item_data, $cart_item)
    {
        if (isset($cart_item['package'])) {
            $item_data[] = array(
                'key'   => __('Package', 'custom-package-plugin'),
                'value' => ucfirst($cart_item['package']),
            );
        }
        if (isset($cart_item['custom_quantity'])) {
            $item_data[] = array(
                'key'   => __('Custom Quantity', 'custom-package-plugin'),
                'value' => $cart_item['custom_quantity'],
            );
        }
        return $item_data;
    }
}