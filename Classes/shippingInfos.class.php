<?php

  class ShippingInfos
  {
    private ShippingInfo $shippingInfos = array();

    function __construct(argument)
    {
      // code...
    }

    /**
    * This method checks if the cart is able for Discount.
    * Method takes as param a Cart Obj by Reference and modify it.
    * If there are no Discounts in the Database will return the Cart Obj as it is.
    * @param Cart $cart
    *
    * @return Nothing
    * Nothing is returned since the actual Cart Obj has been modified by the method.
    */
    public function isAbleForDiscount(Cart &$cart){
      $newCart = $cart;
      $itemsNum = count($newCart->booksInCart);
      if($cart->getHasShippingDiscount())
        return;
      foreach ($shippingInfos as $shippingInfo) {
        if ($shippingInfo->getDiscountAfterQuantity() > $itemsNum) {
          $newCart->setHasShippingDiscount(false);
          $newCart->setShippingDiscountPrice(0.0);
        }elseif ($shippingInfo->getDiscountAfterQuantity() <= $itemsNum) {
          $newCart = $newCart->calculateDiscountPrice($cart, $shippingInfo->getPrice());
        }
      }
    }

    private function calculateDiscountPrice(Cart &$cart, ShippingInfo $shippingInfo){
      $newShippingPrice = $shippingInfo->getPrice() - $shippingInfo->getDiscountFixedPriceOff();
      $newCartPrice = $cart->getTotalPrice() - $newShippingPrice;
      if($newCartPrice == 0 || $newCartPrice < 0)
        return;
      $cart->setShippingDiscountPrice($newShippingPrice);
      $cart->setTotalPrice($newCartPrice);
    }
  }

?>
