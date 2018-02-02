<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace viennamoi\Domain;

class Role {
 private $id;
 
 private $name;
 
 public function getId() {
  return $this->id;
 }

 public function getName() {
  return $this->name;
 }

 public function setId($id) {
  $this->id = $id;
  return $this;
 }

 public function setName($name) {
  $this->name = $name;
  return $this;
 }


}
