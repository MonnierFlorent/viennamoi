<?php

namespace viennamoi\Domain;

class Bakery {
 private $id;
 
 private $name;
 
 private $content;
 
 private $image;
 
 private $user;
 
 private $address;
 
 public function getId() {
  return $this->id;
 }

 public function getName() {
  return $this->name;
 }

 public function getContent() {
  return $this->content;
 }

 public function getImage() {
  return $this->image;
 }

 public function getUser() {
  return $this->user;
 }

 public function getAddress() {
  return $this->address;
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

 public function setImage($image) {
  $this->image = $image;
  return $this;
 }

 public function setUser($user) {
  $this->user = $user;
  return $this;
 }

 public function setAddress($address) {
  $this->address = $address;
  return $this;
 }

}
