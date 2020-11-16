<?php

  Class Book{

    protected int $id;
    protected string $name;
    protected string $isbn;
    protected string $title;
    protected string $pagesNum;
    protected string $author;
    protected string $publisher;
    protected date $releaseDate;
    protected double $weight;
    protected string $description;
    protected double $price;

    protected string $shippingDays;
    protected boolean $isAvailable;
    protected int $availableCopies;

    public __constructor(){}

    public __constructor(int $id, string $name, string $isbn, string $title, string $pagesNum, string $author,
    string $publisher, date $releaseDate, double $weight, string $description, double $price, string $shippingDays,
    boolean $isAvailable, int $availableCopies){
      $this->id = $id;
      $this->name = $name;
      $this->isbn = $isbn;
      $this->pagesNum = $pagesNum;
      $this->author = $author;
      $this->publisher = $publisher;
      $this->releaseDate = $releaseDate;
      $this->weight = $weight;
      $this->description = $description;
      $this->price = $price;
      $this->shippingDays = $shippingDays;
      $this->isAvailable = $isAvailable;
      $this->availableCopies = $availableCopies;
    }

// SET METHODS
    public function setID(int $id){ $this->id = $id; }
    public function setName(string $name){ $this->name = $name; }
    public function setISBN(string $isbn){ $this->isbn = $isbn; }
    public function setTitle(string $title){ $this->title = $title; }
    public function setPagesNum(string $pagesNum){ $this->pagesNum = $pagesNum; }
    public function setAuthor(string $author){ $this->author = $author; }
    public function setPublisher(string $publisher){ $this->publisher = $publisher; }
    public function setReleaseDate(date $releaseDate){ $this->releaseDate = $releaseDate; }
    public function setWeight(double $weight){ $this->weight = $weight; }
    public function setDescription(string $description){ $this->description = $description; }
    public function setPrice(double $price){ $this->price = $price; }
    public function setShippingDays(string $shippingDays){ $this->shippingDays = $shippingDays; }
    public function setIsAvailable(boolean $isAvailable){ $this->isAvailable = $isAvailable; }
    public function setAvailableCopies(int $availableCopies){ $this->availableCopies = $availableCopies; }


// GET METHODS
    public function getID(){ return $this->id};
    public function getName(){ return $this->name; }
    public function getISBN(){ return $this->isbn; }
    public function getTitle(){ return $this->title; }
    public function getPagesNum(){ return $this->pagesNum; }
    public function getAuthor(){ return $this->author; }
    public function getPublisher(){ return $this->publisher; }
    public function getReleaseDate(){ return $this->releaseDate; }
    public function getWeight(){ return $this->weight; }
    public function getDescription(){ return $this->description; }
    public function getPrice(){ return $this->price; }
    public function getShippingDays(){ return $this->shippingDays; }
    public function getIsAvailable(){
      if($isAvailable && $availableCopies > 0)
        return true;
      return false;
    }
  }

?>
