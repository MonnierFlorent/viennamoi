<?php

namespace viennamoi\DAO;

use viennamoi\Domain\Address;

/**
 * Description of AddressDAO
 *
 * @author ETUDIANT
 */
class AddressDAO extends DAO {
 
 private $cityDAO;

 public function setCityDAO(CityDAO $cityDAO) {
  $this->cityDAO = $cityDAO;
 }

 /**
  * Returns a list of all users, sorted by role and name.
  *
  * @return array A list of all users.
  */
 public function findAll() {
  $sql = "select * from vienn_address";
  $result = $this->getDb()->fetchAll($sql);
  // Convert query result to an array of domain objects
  $entities = array();
  foreach ($result as $row) {
   $id = $row['addr_id'];
   $entities[$id] = $this->buildDomainObject($row);
  }
  return $entities;
 }

 /**
  * Returns a user matching the supplied id.
  *
  * @param integer $id The user id.
  *
  * @return \BookShelf\Domain\User|throws an exception if no matching user is found
  */
 public function find($id) {
  $sql = "select * from vienn_address where addr_id=?";
  $row = $this->getDb()->fetchAssoc($sql, array($id));
  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new \Exception("No address matching id " . $id);
  }
 }

 /**
  * Saves a user into the database.
  *
  * @param \BookShelf\Domain\User $user The user to save
  */
// public function save(User $user) {
//  $userData = array(
//      'user_name' => $user->getUsername(),
//      'user_salt' => $user->getSalt(),
//      'user_password' => $user->getPassword(),
//      'user_role' => $user->getRole()
//  );
//  if ($user->getId()) {
//   // The user has already been saved : update it
//   $this->getDb()->update('users', $userData, array('user_id' => $user->getId()));
//  } else {
//   // The user has never been saved : insert it
//   $this->getDb()->insert('users', $userData);
//   // Get the id of the newly created user and set it on the entity.
//   $id = $this->getDb()->lastInsertId();
//   $user->setId($id);
//  }
// }

 /**
  * Removes an user from the database.
  *
  * @param integer $id The user id.
  */
// public function delete($id) {
//  // Delete the user
//  $this->getDb()->delete('users', array('user_id' => $id));
// }
//
// /**
//  * {@inheritDoc}
//  */
// public function loadUserByUsername($username) {
//  $sql = "select * from users where user_name=?";
//  $row = $this->getDb()->fetchAssoc($sql, array($username));
//  if ($row) {
//   return $this->buildDomainObject($row);
//  } else {
//   throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
//  }
// }
//
// /**
//  * {@inheritDoc}
//  */
// public function refreshUser(UserInterface $user) {
//  $class = get_class($user);
//  if (!$this->supportsClass($class)) {
//   throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
//  }
//  return $this->loadUserByUsername($user->getUsername());
// }
//
// /**
//  * {@inheritDoc}
//  */
// public function supportsClass($class) {
//  return 'BookShelf\Domain\User' === $class;
// }

 /**
  * Creates a User object based on a DB row.
  *
  * @param array $row The DB row containing User data.
  * @return \BookShelf\Domain\User
  */
 protected function buildDomainObject(array $row) {
  $address = new Address();
  $address->setId($row['addr_id']);
  $address->setUser($row['addr_user']);
  $address->setLine1($row['addr_line1']);
  $address->setLine2($row['addr_line2']);
  $address->setInsee($row['addr_insee']);
  //$address->setType($row['addr_type']);
  //$address->setName($row['addr_name']);
  
  if ($row['addr_id'] != null) {
   //find and set the associated user
   $cityId = $row['addr_insee'];
   $city = $this->cityDAO->find($cityId);
   $address->setInsee($city);
  }
  return $address;
 }

}
