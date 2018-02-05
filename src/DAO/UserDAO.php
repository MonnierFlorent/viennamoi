<?php

namespace viennamoi\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use viennamoi\Domain\User;

/**
 * Description of UserDAO
 *
 * @author Etudiant
 */
class UserDAO extends DAO implements UserProviderInterface {

 private $roleDAO;

 public function setRoleDAO(RoleDAO $roleDAO) {
  $this->roleDAO = $roleDAO;
 }
 
 /**
  * Returns a user matching the supplied id.
  *
  * @param integer $id The user id.
  *
  * @return \BookShelf\Domain\User|throws an exception if no matching user is found
  */
 public function find($id) {
  $sql = "select * from vienn_users where user_id=?";
  $row = $this->getDb()->fetchAssoc($sql, array($id));
  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new \Exception("No user matching id " . $id);
  }
 }

 /**
  * Returns a list of all users, sorted by role and name.
  *
  * @return array A list of all users.
  */
 public function findAll() {
  $sql = "select * from vienn_users order by user_role, user_name";
  $result = $this->getDb()->fetchAll($sql);

  // Convert query result to an array of domain objects
  $entities = array();
  foreach ($result as $row) {
   $id = $row['user_id'];
   $entities[$id] = $this->buildDomainObject($row);
  }
  return $entities;
 }

 public function save(User $user) {

  $userData = array(
      'user_name' => $user->getUsername(),
      'user_firstname' => $user->getFirstname(),
      'user_tel' => $user->getTel(),
      'user_email' => $user->getEmail(),
      'user_password' => $user->getPassword(),
      'user_salt' => $user->getSalt(),
      'user_role' => $user->getRole(),
  );

  if ($user->getId()) {
   // The userider has already been saved : update it
   $this->getDb()->update('vienn_users', $userData, array('user_id' => $user->getId()));
  } else {
   // The userider has never been saved : insert it
   $this->getDb()->insert('vienn_users', $userData);
   // Get the id of the newly created book and set it on the entity.
   $id = $this->getDb()->lastInsertId();
   $user->setId($id);
  }
 }

 /**
  * Creates a User object based on a DB row.
  *
  * @param array $row The DB row containing User data.
  * @return \viennamoi\Domain\User
  */
 protected function buildDomainObject(array $row) {
  $user = new User();
  $user->setId($row['user_id']);
  $user->setUsername($row['user_name']);
  $user->setFirstname($row['user_firstname']);
  $user->setPassword($row['user_password']);
  $user->setSalt($row['user_salt']);
  $user->setRole($row['user_role']);
  //$user->setAddress($row['user_address']);
  //$user->setTel($row['user_tel']);

//  if ($row['user_role'] != null) {
//   //find and set the associated user
//   
//   $roleId = $row['user_role'];
//   $role = $this->roleDAO->find($roleId);
//   $user->setRole($role);
//  }
  return $user;
 }

 /**
  * Loads the user for the given username.
  *
  * This method must throw UsernameNotFoundException if the user is not
  * found.
  *
  * @param string $username The username
  *
  * @return UserInterface
  *
  * @throws UsernameNotFoundException if the user is not found
  */
 public function loadUserByUsername($username) {
  $sql = "select * from vienn_users where user_name=?";
  $row = $this->getDb()->fetchAssoc($sql, array($username));

  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
  }
 }

 /**
  * Refreshes the user for the account interface.
  *
  * It is up to the implementation to decide if the user data should be
  * totally reloaded (e.g. from the database), or if the UserInterface
  * object can just be merged into some internal array of users / identity
  * map.
  *
  * @param UserInterface $user
  *
  * @return UserInterface
  *
  * @throws UnsupportedUserException if the account is not supported
  */
 public function refreshUser(UserInterface $user) {
  $class = get_class($user);
  if (!$this->supportsClass($class)) {
   throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
  }
  return $this->loadUserByUsername($user->getUsername());
 }

 /**
  * Whether this userider supports the given user class.
  *
  * @param string $class
  *
  * @return bool
  */
 public function supportsClass($class) {

  return 'viennamoi\Domain\User' === $class;
 }
 
     /**
  * Removes an user from the database.
  *
  * @param integer $id The user id.
  */
 public function delete($id) {
  // Delete the user
  $this->getDb()->delete('vienn_users', array('user_id' => $id));
 }

}
