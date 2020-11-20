<?php
  Class Cart{
// PROPERTIES
      protected string $ID;
      protected Book $booksInCart = array();
      protected string $paymentMethod;

      protected boolean $hasDiscount =false;
      protected boolean $hasShippingDiscount = false;
      protected boolean $isPlaced = false;
      protected boolean $isPaid = false;

      private double $totalPrice = 0.0;
      private double $discountPrice = 0.0;
      private double $discountShippingPrice = 0.0;

// SET METHODS
      public function setID(string $id) {$this->id = $id; }
      public function setHasDiscount(boolean $hasDiscount){ $this->hasDiscount = $hasDiscount; }
      public function setDiscountPrice(double $discountPrice){
        if($discountPrice > 0.0)
          $this->hasDiscount = true;
        else
          $this->hasDiscount = false;
        $this->discountPrice = $discountPrice;
      }
      public function setShippingDiscountPrice(dooble $discountShippingPrice){
        if($discountShippingPrice > 0.0)
          $this->hasShippingDiscount = true;
        else
          $this->hasShippingDiscount = false;
        $this->discountShippingPrice = $discountShippingPrice;
      }
      public function setTotalPrice(double $newTotalPrice){ $this->totalPrice = $newTotalPrice; }
      public function setIsPlaced(boolean $isPlaced){ $this->isPlaced = $isPlaced; }
      public function setIsPaid(boolean $isPaid){ $this->isPaid = $isPaid; }
      public function setPaymentMethod(string $paymentMethod){ $this->paymentMethod = $paymentMethod; }

// GET METHODS
      public function getTotalPrice(){ return $this->totalPrice; }
      public function getHasDiscount(){ return $this->hasDiscount; }
      public function getHasShippingDiscount(){ return $this->hasShippingDiscount; }
      public function getHasShippingPrice(){ return $this->discountShippingPrice; }
      public function getAllBooksInCart(){ return $this->booksInCart; }
      public function getPaymentMethod(){ return $this->paymentMethod; }
      public function isPaid(){ return $this->isPaid; }
      public function isPlaced(){ return $this->isPlaced; }

// PUBLIC METHODS
      public function isEmpty(){ return (empty($this->$booksInCart)) ? true : false; }

      public function addBookToCart(Book $book){
        array_push($this->booksInCart, $book);
        updateTotalPrice($book->getPrice());
        checkForDiscounts();
      }

      public function RemoveBookFromCart(int $bookID){
        foreach ($this->booksInCart as $bookInCart) {
          if(!empty($bookInCart->getID()) && $bookInCart->getID() == $bookID){
            unset($this->booksInCart[$bookInCart]);
          }
        }
      }

      public function Place()
      {
        OrderManager $manager = new OrderManager();
        try {
          $result = $manager->placeOrder();
          //clear Cart
          //redirect to thanks page
        } catch (PlaceOrderException $e) {
          echo "<script> alert(".$e->errorMessage()."); </script>";
        }
      }

      public function Pay()
      {
        // code...
      }

// PRIVATE METHODS
      private function checkForDiscounts(){
        checkForBookDiscount();
        checkForShippingDiscount();
      }

      private function checkForBookDiscount(){
        Discounts $discounts = new Discounts();
        $this = $discounts->isAbleForDiscount($this);
      }

      private function checkForShippingDiscount(){
        ShippingInfo $shippingInfo = new ShippingInfo();
        $this = $shippingInfo->isAbleForDiscount($this);
      }

      private function updateTotalPrice(double $bookPrice){
        $newPrice = $this->totalPrice + $bookPrice;
        setTotalPrice($newPrice);
      }
  }
?>
