<?php
  class OrderManager extends Database{

    function __construct(argument)
    {
      $this->getConnection();
    }
// PRIVATE METHODS
    private function insertPlacedOrder()
    {
      $sql = 'INSERT INTO PlacedOrder VALUES (?,?,?,?,?,?,?,?)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([]); //insert the params into query.
      try {
        //try execute the query.
      } catch (PDOException $err) {
        return $err;
      }

      return true;
    }

// PUBLIC METHODS
    public function placeOrder(Cart &$cart){
      if ($cart->isEmpty() == $cart->getTotalPrice() == 0)
        throw new PlaceOrderException("Το καλάθι είναι άδειο ή η Τελική Τιμή είναι 0");
      if (empty($cart->getPaymentMethod()))
        throw new PlaceOrderException("Δεν υπάρχει επιλεγμένη μέθοδος πληρωμής.");
      if (strcasecmp(PaymentMethodTypes::VIVA, $cart->getPaymentMethod())  && !$cart->isPaid())
        throw new PlaceOrderException("Η μέθοδος πληρωμής ".PaymentMethodTypes::VIVA." απαιτεί πληρωμή. \n Παρακαλώ ολοκληρώστε την πληρωμή σας.");
      if ($cart->getTotalPrice() < 0){
        throw new PlaceOrderException("Η Τελική Τιμή είναι αρνητική.")
      }
      if (!$res = $this->insertPlacedOrder()) {
        throw new PlaceOrderException("Η ολοκλήρωση τις παραγγελίας σας δεν μπόρεσε να ολοκληρωθεί. \n ".$res);
      }
      $cart->setIsPlaced(true);
      return 1;
    }


  }

?>
