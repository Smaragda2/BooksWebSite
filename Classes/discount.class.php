<?php
  class Discount{
    private int $discountAfterQuantity;
    private string $discountType;
    private double $DiscountPrice;

// SET METHODS
    public function setDiscountAfterQuantity(int $discountAfterQuantity){
      $this->discountAfterQuantity = $discountAfterQuantity;
    }
    public function setDiscountType(string $discountType){
      $this->discountType = $discountType;
    }
    public function setDiscountPrice(double $discountPrice){
      $this->discountPrice = $discountPrice;
    }

// GET METHODS
    public function getDiscountAfterQuantity(){ return $this->discountAfterQuantity; }
    public function getDiscountType(){ return $this->discountType; }
    public function getDiscountPrice(){ return $this->discountPrice; }
  }

?>
