const { registerCheckoutFilters } = window.wc.blocksCheckout;
const { formatPrice } = window.wc.priceFormat;

const isOrderSummaryContext = (args) => args?.context === "summary";

const modifyCartItemPrice = (defaultValue, extensions, args) => {
  const isCartContext = args?.context === "cart";

  if (isCartContext) {
    const cartItem = args?.cartItem;
    const quantity = cartItem?.quantity;

    if (!quantity) {
      console.error("Quantity is undefined");
      return defaultValue;
    }

    if (quantity === 24) {
      const priceValue = 5000;
      const price = formatPrice(priceValue);
      return `<price/>${price}`;
    }
  }

  if (isOrderSummaryContext(args)) {
    return "<price/> for all items";
  }

  return defaultValue;
};

const modifyCartItemClass = (defaultValue, extensions, args) => {
  if (isOrderSummaryContext(args)) {
    return "my-custom-class";
  }
  return defaultValue;
};

const modifyItemName = (defaultValue, extensions, args) => {
  if (isOrderSummaryContext(args)) {
    return `this is ${defaultValue}`;
  }
  return defaultValue;
};

const modifySubtotalPriceFormat = (defaultValue, extensions, args) => {
  if (isOrderSummaryContext(args)) {
    return "<price/> per item";
  }
  return defaultValue;
};

registerCheckoutFilters("example-extension", {
  cartItemClass: modifyCartItemClass,
  cartItemPrice: modifyCartItemPrice,
  itemName: modifyItemName,
  subtotalPriceFormat: modifySubtotalPriceFormat,
});
