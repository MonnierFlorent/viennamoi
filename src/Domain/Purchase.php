<?php
namespace viennamoi\Domain;

class Purchase {
   
    private $prod_id;
    private $user_id;
    private $price;
    private $quantity;
    private $hour;
    
    public function getProd_id() {
	return $this->prod_id;
    }

    public function getUser_id() {
	return $this->user_id;
    }

    public function getPrice() {
	return $this->price;
    }

    public function getQuantity() {
	return $this->quantity;
    }

    public function getHour() {
	return $this->hour;
    }

    public function setProd_id($prod_id) {
	$this->prod_id = $prod_id;
	return $this;
    }

    public function setUser_id($user_id) {
	$this->user_id = $user_id;
	return $this;
    }

    public function setPrice($price) {
	$this->price = $price;
	return $this;
    }

    public function setQuantity($quantity) {
	$this->quantity = $quantity;
	return $this;
    }

    public function setHour($hour) {
	$this->hour = $hour;
	return $this;
    }


    
    
}
