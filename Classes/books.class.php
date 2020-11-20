<?php
  Class Books extends Database{
    private Book $books=array();

    public __constructor(){
      getAllBooksFromDB();
    }

    private function getAllBooksFromDB(){
      $sql = "SELECT * FROM Book";
      $stmt = $this->conn->query($sql);

      while ($row = $stmt->fetch()) {
        $tempBook = new Book();

        $tempBook->setID($row['id']);
        $tempBook->setName($row['name']);
        $tempBook->setISBN($row['isbn']);
        $tempBook->setTitle($row['title']);
        $tempBook->setPagesNum($row['pagesNum']);
        $tempBook->setAuthor($row['author']);
        $tempBook->setPublisher($row['publisher']);
        $tempBook->setReleaseDate($row['releaseDate']);
        $tempBook->setWeight($row['weight']);
        $tempBook->setDescription($row['description']);
        $tempBook->setPrice($row['price']);
        $tempBook->setShippingDays($row['$shippingDays']);
        $tempBook->setIsAvailable($row['isAvailable']);
        $tempBook->setAvailableCopies($row['availableCopies']);

        array_push($this->books, $tempBook);
      }
      unset($tempBook);
    }
  }
?>
