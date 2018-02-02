<?php

namespace viennamoi\Domain;

class Address {
 private $id;
 
 private $user;
 
 private $line1;
 
 private $line2;
 
 private $insee;
 
 private $type;
 
 private $name;
 
 public function getId() {
  return $this->id;
 }

 public function getUser() {
  return $this->user;
 }

 public function getLine1() {
  return $this->line1;
 }

 public function getLine2() {
  return $this->line2;
 }

 public function getInsee() {
  return $this->insee;
 }

 public function getType() {
  return $this->type;
 }

 public function getName() {
  return $this->name;
 }

 public function setId($id) {
  $this->id = $id;
  return $this;
 }

 public function setUser($user) {
  $this->user = $user;
  return $this;
 }

 public function setLine1($line1) {
  $this->line1 = $line1;
  return $this;
 }

 public function setLine2($line2) {
  $this->line2 = $line2;
  return $this;
 }

 public function setInsee($insee) {
  $this->insee = $insee;
  return $this;
 }

 public function setType($type) {
  $this->type = $type;
  return $this;
 }

 public function setName($name) {
  $this->name = $name;
  return $this;
 }


}
