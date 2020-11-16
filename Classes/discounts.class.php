<?php

  class Discounts extends Database{
    private Discount $discounts = array();

    function __construct()
    {
      getAllDiscountsFromDB();
    }

    private function getAllDiscountsFromDB(){
      $sql = 'SELECT * FROM Discount';
      $stmt = $this->getConnection()->query($sql);
      while ($row = $stmt->fetch()) {
        $tempDiscount = new Discount();
        $tempDiscount->setDiscountAfterQuantity((int)$row['discountAfterQuantity']);
        $tempDiscount->setDiscountType((string)$row['discountType']);
        $tempDiscount->setDiscountPrice((double)$row['discountPrice']);
        array_push($this->discounts, $tempDiscount);
      }
      unset($tempDiscount);
    }

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
      if($cart->getHasDiscount())
        return $newCart;
      if ($discountAfterQuantity > $itemsNum) {
        $newCart->setHasDiscount(false);
        $newCart->setDiscountPrice(0.0);
      }elseif ($discountAfterQuantity <= $itemsNum) {
        $newCart = $newCart->calculateDiscountPrice();
      }
      return $newCart;
    }

    private function calculateDiscountPrice(Cart $cart){
      $newCartPrice = $cart->getTotalPrice();
      foreach ($this->discounts as $discount) {
        if($cart->getHasDiscount())
          return $cart;
        if (strcasecmp($discount->getDiscountType(), DiscountTypes::PRICE_OFF)) {
          $newCartPrice = $newCartPrice - $discount->getDiscountPrice();
        }
        if (strcasecmp($discount->getDiscountType(), DiscountTypes::PERCENT_OFF)) {
          $newCartPrice = $newCartPrice - ($newCartPrice * $discount->getDiscountPrice());
        }
        $cart->setDiscountPrice($newCartPrice);
        return $cart;
      }
    }
  }

?>
