<?php
  class PlaceOrderException extends Exception{
    public function errorMessage(){
      return $this->getMessage();
    }
  }

?>
