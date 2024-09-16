# Custom Package Plugin for WooCommerce

**Custom Package Plugin** extends the functionality of WooCommerce by adding a custom "Package" tab to product data, adjusting quantities and pricing based on selected packages, and customizing cart and checkout displays. This plugin allows for flexible pricing and presentation modifications to enhance the WooCommerce shopping experience.

## Table of Contents

1. [Features](#features)
2. [Installation](#installation)
   - [Via WordPress Dashboard](#via-wordpress-dashboard)
   - [Via FTP](#via-ftp)
3. [Usage](#usage)
4. [Configuration](#configuration)
5. [Customization](#customization)
6. [Contributing](#contributing)

## Features

- **Custom "Package" Tab**: Adds a new tab to WooCommerce product data to manage custom packages.
- **Dynamic Pricing**: Adjusts prices based on quantity and selected packages.
- **Custom Quantity Handling**: Modifies product quantity in the cart based on selected packages.
- **Custom Cart Display**: Updates cart item displays with custom CSS classes and pricing information.
- **Integration with WooCommerce Blocks**: Customizes cart and checkout blocks using JavaScript filters.

## Installation

### Via WordPress Dashboard

1. Download the plugin `.zip` file.
2. Go to your WordPress admin dashboard and navigate to **Plugins > Add New**.
3. Click on **Upload Plugin**, then choose the `.zip` file and click **Install Now**.
4. Activate the plugin by clicking **Activate Plugin**.

### Via FTP

1. Unzip the plugin file.
2. Upload the plugin folder to `/wp-content/plugins/` on your server using an FTP client.
3. Go to **Plugins > Installed Plugins** in your WordPress dashboard.
4. Find **Custom Package Plugin** and click **Activate**.

## Usage

Once activated, the plugin integrates with WooCommerce to provide the following functionalities:

- **Custom Package Tab**: Manage custom packages directly from the product data tab.
- **Price and Quantity Adjustments**: Automatically adjusts product prices and quantities based on the selected package and quantity in the cart.
- **Cart and Checkout Customization**: Enhances cart and checkout displays with custom item names, classes, and price formats.

## Configuration

The plugin is designed to work seamlessly with WooCommerce. It provides a set of features that can be configured through the WooCommerce product settings and the plugin's JavaScript filters.

### JavaScript Customization

The following functions are used to customize the cart and checkout displays:

- **`modifyCartItemPrice`**: Adjusts the price of cart items based on quantity and context.
- **`modifyCartItemClass`**: Sets custom CSS classes for cart items based on context.
- **`modifyItemName`**: Alters the display name of items based on context.
- **`modifySubtotalPriceFormat`**: Changes the format of subtotal prices based on context.

These functions are registered using the `registerCheckoutFilters` method.

## Customization

### PHP Integration

The plugin includes PHP classes to handle custom package integration and cart modifications:

- **`Custom_Package_Plugin`**: Main plugin class that initializes admin, frontend, and cart functionality.
- **`Custom_Package_Admin`**: Manages admin-side configurations and settings.
- **`Custom_Package_Frontend`**: Handles frontend display and user interactions.
- **`Custom_Package_Cart`**: Manages cart operations, including price and quantity adjustments.


## Contributing

We welcome contributions to improve the plugin. Please fork the repository and submit pull requests with your changes. For major updates, consider opening an issue to discuss potential improvements.
