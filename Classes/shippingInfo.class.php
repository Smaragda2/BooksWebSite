<?php
  Class ShippingInfo{

    protected string ID;
    protected string name;
    protected double price;

    protected int discountAfterQuantity;
    protected double discountFixedPriceOff;

    /**
    * This method checks if the cart is able for Discount.
    * Method takes as param a Cart Obj.
    * If there are no Discounts in the Database will return the Cart Obj as it is.
    * @param Cart $cart
    *
    * @return Cart $newCart
    */
    public function isAbleForDiscount(Cart $cart){
      $newCart = $cart;
      $itemsNum = count($newCart->booksInCart);
      if($cart->getHasShippingDiscount())
        return $newCart;
      if ($discountAfterQuantity > $itemsNum) {
        $newCart->setHasShippingDiscount(false);
        $newCart->setShippingDiscountPrice(0.0);
      }elseif ($discountAfterQuantity <= $itemsNum) {
        $newCart = $newCart->calculateDiscountPrice();
      }
      return $newCart;
    }

    private function calculateDiscountPrice(Cart $cart){
      $newCartPrice = $cart->getTotalPrice() - $this->price;
      $cart->setShippingDiscountPrice($this->price);
      $cart->setTotalPrice($newCartPrice);
      return $cart;
    }
  }
?>
