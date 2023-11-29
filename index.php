function custom_cart_notice() {
    // Define the category ID for the restriction
    $allowed_category_id = 33; // Replace with the ID of the category where any one product can be purchased

    // Check if there is more than one product from the allowed category in the cart
    $cart = WC()->cart;
    $allowed_category_products = array();

    foreach ($cart->get_cart() as $cart_item) {
        $product_id = $cart_item['product_id'];
        $product_category_ids = wc_get_product_term_ids($product_id, 'product_cat');

        if (in_array($allowed_category_id, $product_category_ids, true)) {
            $allowed_category_products[] = $product_id;
        }
    }

    // Display a notice if there is more than one product from the allowed category
    if (count($allowed_category_products) > 1) {
        wc_add_notice('You can only purchase one product from this category.', 'error');
    }
}
add_action('woocommerce_check_cart_items', 'custom_cart_notice');
