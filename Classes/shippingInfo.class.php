<?php
  Class ShippingInfo{

    protected int $ID;
    protected string $name;
    protected double $price;

    protected int $discountAfterQuantity;
    protected double $discountFixedPriceOff;

// SET METHODS
    public function setID(int $id){ $this->id = $id; }
    public function setName(string $name){ $this->name = $name; }
    public function setPrice(double $price){ $this->price = $price; }
    public function setDiscountAfterQuantity(int $discountAfterQuantity){
      $this->discountAfterQuantity = $discountAfterQuantity;
    }
    public function setDiscountFixedPriceOff(double $discountPrice){
      $this->discountFixedPriceOff = $discountPrice;
    }

// GET METHODS
    public function getID(){ return $this->id; }
    public function getName(){ return $this->name; }
    public function getPrice(){ return $this->price; }
    public function getDiscountAfterQuantity(){ return $this->discountAfterQuantity; }
    public function getDiscountFixedPriceOff(){ return $this->discountFixedPriceOff; }

// PUBLIC METHODS
  }
?>
