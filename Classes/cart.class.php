<?php
  Class Cart{
// PROPERTIES
      protected string $ID;
      protected Book $booksInCart = array();
      protected boolean $hasDiscount =false;
      protected boolean $hasShippingDiscount = false;

      protected boolean $isPlaced = false;
      protected boolean $isPaid = false;

      private double $totalPrice = 0.0;
      private double $discountPrice = 0.0;
      private double $discountShippingPrice = 0.0;

// SET METHODS
      public function setID(string $id) {$this->id = $id; }
      public function setHasDiscount(boolean $hasDiscount){
        $this->hasDiscount = $hasDiscount;
      }
      public function setDiscountPrice(double $discountPrice){
        if($discountPrice > 0.0)
          $this->hasDiscount = true;
        else
          $this->hasDiscount = false;
        $this->discountPrice = $discountPrice;
      }
      public function setShippingDiscountPrice(dooble $discountShippingPrice)
      {
        if($discountShippingPrice > 0.0)
          $this->hasShippingDiscount = true;
        else
          $this->hasShippingDiscount = false;
        $this->discountShippingPrice = $discountShippingPrice;
      }
      public function setTotalPrice(double $newTotalPrice){ $this->totalPrice = $newTotalPrice; }\

// GET METHODS
      public function getTotalPrice(){ return $totalPrice; }
      public function getHasDiscount(){ return $hasDiscount; }
      public function getHasShippingDiscount(){ return $hasShippingDiscount; }
      public function getHasShippingPrice(){ return $discountShippingPrice; }

// PUBLIC METHODS
      public function addBookToCart(Book $book){
        array_push($this->booksInCart, $book);
        updateTotalPrice($book->getPrice());
        checkForDiscounts();
      }


// PRIVATE METHODS
      private function checkForDiscounts(){
        checkForBookDiscount();
        checkForShippingDiscount();
      }

      private function checkForBookDiscount()
      {
        Discounts $discounts = new Discounts();
        $this = $discounts->isAbleForDiscount($this);
      }

      private function checkForShippingDiscount()
      {
        ShippingInfo $shippingInfo = new ShippingInfo();
        $this = $shippingInfo->isAbleForDiscount($this);
      }

      private function updateTotalPrice(double $bookPrice){
        $newPrice = $this->totalPrice + $bookPrice;
        setTotalPrice($newPrice);
      }
  }
?>
