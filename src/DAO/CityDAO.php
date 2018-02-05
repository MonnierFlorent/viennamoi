<?php

namespace viennamoi\DAO;

use viennamoi\Domain\City;

/**
 * Description of CityDAO
 *
 * @author ETUDIANT
 */
class CityDAO extends DAO {
  /**
  * Returns a list of all users, sorted by role and name.
  *
  * @return array A list of all users.
  */
 public function findAll() {
  $sql = "select * from vienn_city";
  $result = $this->getDb()->fetchAll($sql);
  // Convert query result to an array of domain objects
  $entities = array();
  foreach ($result as $row) {
   $id = $row['Code_commune_INSEE'];
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
  $sql = "select * from vienn_city where Code_commune_INSEE=?";
  $row = $this->getDb()->fetchAssoc($sql, array($id));
  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new \Exception("No city matching id " . $id);
  }
 }
 
 protected function buildDomainObject(array $row) {
  $city = new City();
  $city->setId($row['Code_commune_INSEE']);
  $city->setName($row['Nom_commune']);
  $city->setCP($row['Code_postal']);
  return $city;
 }
}
