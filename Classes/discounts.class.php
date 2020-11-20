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
        $tempDiscount->setID((int)$row['id']);
        $tempDiscount->setDiscountAfterQuantity((int)$row['discountAfterQuantity']);
        $tempDiscount->setDiscountType((string)$row['discountType']);
        $tempDiscount->setDiscountPrice((double)$row['discountPrice']);
        array_push($this->discounts, $tempDiscount);
      }
      unset($tempDiscount);
      $this->closeConnection();
    }

    /**
    * This method checks if the cart is able for Discount.
    * Method takes as param a Cart Obj.
    * If there are no Discounts in the Database will return the Cart Obj as it is.
    * @param Cart $cart
    *
    * @return Nothing
    * The changes are made to the original Object that has been send by Reference.
    */
    public function isAbleForDiscount(Cart &$cart){
      $newCart = $cart;
      $itemsNum = count($newCart->booksInCart);
      if($cart->getHasDiscount())
        return;
      if ($discountAfterQuantity > $itemsNum) {
        $newCart->setHasDiscount(false);
        $newCart->setDiscountPrice(0.0);
      }elseif ($discountAfterQuantity <= $itemsNum) {
        $newCart = $newCart->calculateDiscountPrice();
      }
    }

    private function calculateDiscountPrice(Cart &$cart){
      $newCartPrice = $cart->getTotalPrice();
      foreach ($this->discounts as $discount) {
        if($cart->getHasDiscount())
          return;
        if (strcasecmp($discount->getDiscountType(), DiscountTypes::PRICE_OFF)) {
          $newCartPrice = $newCartPrice - $discount->getDiscountPrice();
        }
        if (strcasecmp($discount->getDiscountType(), DiscountTypes::PERCENT_OFF)) {
          $newCartPrice = $newCartPrice - ($newCartPrice * $discount->getDiscountPrice());
        }
        if($newCartPrice == 0 || $newCartPrice < 0)
          return;
        $cart->setDiscountPrice($newCartPrice);
      }
    }
  }

?>
