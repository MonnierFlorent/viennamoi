<?php

namespace viennamoi\Domain;

class Product {

 private $id;
 private $name;
 private $content;
 private $price;
 private $stock;
 private $cate;

 public function getId() {
  return $this->id;
 }

 public function getName() {
  return $this->name;
 }

 public function getContent() {
  return $this->content;
 }

 public function getPrice() {
  return $this->price;
 }

 public function getStock() {
  return $this->stock;
 }

 public function getCate() {
  return $this->cate;
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

 public function setPrice($price) {
  $this->price = $price;
  return $this;
 }

 public function setStock($stock) {
  $this->stock = $stock;
  return $this;
 }

 public function setCate($cate) {
  $this->cate = $cate;
  return $this;
 }

}
