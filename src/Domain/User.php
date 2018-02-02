<?php

namespace viennamoi\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {

 /**
  * User id.
  *
  * @var integer
  */
 private $id;

 /**
  * User name.
  *
  * @var string
  */
 private $username;

 /**
  * User firsttname.
  *
  * @var string
  */
 private $firstname;

 /**
  * User password.
  *
  * @var string
  */
 private $password;

 /**
  * Salt that was originally used to encode the password.
  *
  * @var string
  */
 private $salt;

 /**
  * Role.
  * Values : ROLE_USER or ROLE_ADMIN.
  *
  * @var string
  */
 private $role;

 /**
  * User adress.
  *
  * @var string
  */
 private $address;

 /**
  * User factadress.
  *
  * @var string
  */
 private $factadress;

 /**
  * User city.
  *
  * @var string
  */
 private $city;

 /**
  * User factcity.
  *
  * @var string
  */
 private $factcity;

 /**
  * User zipcode.
  *
  * @var string
  */
 private $zipcode;

 /**
  * User factzipcode.
  *
  * @var string
  */
 private $factzipcode;

 /**
  * User tel.
  *
  * @var string
  */
 private $tel;
 private $email;

 public function getEmail() {
  return $this->email;
 }

 public function setEmail($email) {
  $this->email = $email;
 }

 public function getId() {
  return $this->id;
 }

 public function setId($id) {
  $this->id = $id;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getUsername() {
  return $this->username;
 }

 public function setUsername($username) {
  $this->username = $username;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getFirstname() {
  return $this->firstname;
 }

 public function setFirstname($firstname) {
  $this->firstname = $firstname;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getPassword() {
  return $this->password;
 }

 public function setPassword($password) {
  $this->password = $password;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getSalt() {
  return $this->salt;
 }

 public function setSalt($salt) {
  $this->salt = $salt;
  return $this;
 }

 public function getRole() {
  return $this->role;
 }

 public function setRole($role) {
  $this->role = $role;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function eraseCredentials() {
  // Nothing to do here
 }

 /**
  * @inheritDoc
  */
 public function getAddress() {
  return $this->address;
 }

 /**
  * @inheritDoc
  */
 public function setAddress($address) {
  $this->address = $address;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getFactadress() {
  return $this->factadress;
 }

 /**
  * @inheritDoc
  */
 public function setFactadress($factadress) {
  $this->factadress = $factadress;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getCity() {
  return $this->city;
 }

 /**
  * @inheritDoc
  */
 function setCity($city) {
  $this->city = $city;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getFactcity() {
  return $this->factcity;
 }

 /**
  * @inheritDoc
  */
 function setFactcity($factcity) {
  $this->factcity = $factcity;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getZipcode() {
  return $this->zipcode;
 }

 /**
  * @inheritDoc
  */
 function setZipcode($zipcode) {
  $this->zipcode = $zipcode;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getFactzipcode() {
  return $this->factzipcode;
 }

 /**
  * @inheritDoc
  */
 public function setFactzipcode($factzipcode) {
  $this->factzipcode = $factzipcode;
  return $this;
 }

 /**
  * @inheritDoc
  */
 public function getTel() {
  return $this->tel;
 }

 /**
  * @inheritDoc
  */
 public function setTel($tel) {
  $this->tel = $tel;
  return $this;
 }

 public function getRoles() {
  return array($this->getRole());
 }

}
