<?php

namespace viennamoi\DAO;

use viennamoi\domain\Bakery;

/**
 * Description of BakeryDAO
 *
 * @author ETUDIANT
 */
class BakeryDAO extends DAO {

 
 private $addressDAO;

 public function setAddressDAO(AddressDAO $addressDAO) {
  $this->addressDAO = $addressDAO;
 }

 //
 public function find($id) {
  $sql = "select * from vienn_bakery where bak_id=?";
  $row = $this->getDb()->fetchAssoc($sql, array($id));
  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new \Exception("No bakery matching id " . $id);
  }
 }

 public function findAll() {  //elle va retourner l'ensemble des bouquins
  $sql = "select * from vienn_bakery order by bak_id";
  $result = $this->getDb()->fetchAll($sql);

  $entities = array();
  foreach ($result as $row) {
   $id = $row['bak_id'];
   $entities[$id] = $this->buildDomainObject($row);
  }
  return $entities;
 }

 //put your code here
 protected function buildDomainObject(array $row) {
  $bakery = new Bakery();
  $bakery->setId($row['bak_id']);
  $bakery->setName($row['bak_name']);
  $bakery->setContent($row['bak_content']);
  $bakery->setImage($row['bak_image']);
  //$bakery->setUser($row['available']);

  if ($row['bak_address'] != null) {
   //find and set the associated user
   $addressId = $row['bak_address'];
   $address = $this->addressDAO->find($addressId);
   $bakery->setAddress($address);
  }
  return $bakery;
 }

//inserer un book en bdd
// public function save(book $book) {
//  if ($book->getAvailable() == 0) {
//   $available = 0;
//  } else {
//   $available = 1;
//  }
//
//  if ($book->getUser() == null) {
//   $userId = null;
//  } else {
//   $userId = $book->getUser()->getId();
//  }
//  $bookData = array(
//      'book_title' => $book->getTitle(),
//      'book_author' => $book->getAuthor(),
//      'book_summary' => $book->getSummary(),
//      'user_id' => $userId,
//      'available' => $available
//  );
//  if ($book->getId()) {
//   // The book has already been saved : update it
//   $this->getDb()->update('books', $bookData, array('book_id' => $book->getId()));
//  } else {
//   // The book has never been saved : insert it
//   $this->getDb()->insert('books', $bookData);
//   // Get the id of the newly created book and set it on the entity.
//   $id = $this->getDb()->lastInsertId();
//   $book->setId($id);
//  }
// }

// //remove a book
// public function delete($id) {
//  // Delete the book
//  $this->getDb()->delete('books', array('book_id' => $id));
// }

}
