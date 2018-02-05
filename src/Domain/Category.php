<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace viennamoi\Domain;

/**
 * Description of Category
 *
 * @author Etudiant
 */
class Category {

 private $id;
 private $content;
 private $image;
 private $name;

 public function getId() {
  return $this->id;
 }

 public function getContent() {
  return $this->content;
 }

 public function getImage() {
  return $this->image;
 }

 public function getName() {
  return $this->name;
 }

 public function setId($id) {
  $this->id = $id;
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

 public function setName($name) {
  $this->name = $name;
  return $this;
 }

}
