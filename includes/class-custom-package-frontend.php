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
<script>
// custom-cart-script.js
jQuery(document).ready(function($) {
    // get the base price per unit exist in woo-commerce
    const basePricePerUnit = parseFloat(
        $(".cart_item .woocommerce-Price-amount").text().replace("EGP", "").trim()
    );

    console.log("Base price per unit: " + basePricePerUnit);

    function updateTotalPrice() {
        // Iterate through each cart item
        $(".cart_item").each(function() {
            const quantity = parseInt($(this).find(".qty").val(), 10);
            const itemTotalPrice = quantity * basePricePerUnit;

            // Update the total price for this item
            $(this)
                .find(".cart_item_total .woocommerce-Price-amount")
                .each(function() {
                    $(this).html(
                        "<bdi>" +
                        itemTotalPrice.toFixed(2) +
                        ' <span class="woocommerce-Price-currencySymbol">EGP</span></bdi>'
                    );
                });

            // Optionally update the subtotal
            updateCartSubtotal();
        });
    }

    function updateCartSubtotal() {
        let subtotal = 0;
        $(".cart_item").each(function() {
            const itemTotalPrice = parseFloat(
                $(this)
                .find(".cart_item_total .woocommerce-Price-amount")
                .text()
                .replace("EGP", "")
                .trim()
            );
            subtotal += itemTotalPrice;
        });

        $(".cart-subtotal .woocommerce-Price-amount").each(function() {
            $(this).html(
                "<bdi>" +
                subtotal.toFixed(2) +
                ' <span class="woocommerce-Price-currencySymbol">EGP</span></bdi>'
            );
        });
    }

    // Update total price on quantity change
    $(document).on("change", ".qty", function() {
        updateTotalPrice();
    });

    // Initial update on page load
    updateTotalPrice();
});
</script>
<?php
    }
}
?>