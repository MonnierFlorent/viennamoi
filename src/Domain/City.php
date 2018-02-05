<?php

namespace viennamoi\Domain;

/**
 * Description of City
 *
 * @author ETUDIANT
 */
class City {
 private $id;
 
 private $name;
 
 private $CP;
 
 public function getId() {
  return $this->id;
 }

 public function getName() {
  return $this->name;
 }

 public function getCP() {
  return $this->CP;
 }

 public function setId($id) {
  $this->id = $id;
  return $this;
 }

 public function setName($name) {
  $this->name = $name;
  return $this;
 }

 public function setCP($CP) {
  $this->CP = $CP;
  return $this;
 }

}
