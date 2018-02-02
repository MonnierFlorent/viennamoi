<?php

namespace viennamoi\Domain;

class Provider {
    
    private $id;
    private $name;
    private $content;
    private $adress;
    private $zip;
    private $city;
    private $image;
    
    public function getId() {
	return $this->id;
    }

    public function getName() {
	return $this->name;
    }

    public function getContent() {
	return $this->content;
    }

    public function getAdress() {
	return $this->adress;
    }

    public function getZip() {
	return $this->zip;
    }

    public function getCity() {
	return $this->city;
    }

    public function setId($id) {
	$this->id = $id;
	return $this;
    }

    public function setName($name) {
	$this->name = $name;
	return $this;
    }

    public function setContent($content) {
	$this->content = $content;
	return $this;
    }

    public function setAdress($adress) {
	$this->adress = $adress;
	return $this;
    }

    public function setZip($zip) {
	$this->zip = $zip;
	return $this;
    }

    public function setCity($city) {
	$this->city = $city;
	return $this;
    }


    public function getImage() {
	return $this->image;
    }

    public function setImage($image) {
	$this->image = $image;
	return $this;
    }


    
}
