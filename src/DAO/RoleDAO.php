<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace viennamoi\DAO;

class RoleDAO extends DAO {
 
 public function findAll() {
  $sql = "select * from vienn_role";
  $result = $this->getDb()->fetchAll($sql);
  // Convert query result to an array of domain objects
  $entities = array();
  foreach ($result as $row) {
   $id = $row['role_id'];
   $entities[$id] = $this->buildDomainObject($row);
  }
  return $entities;
 }

 
 public function find($id) {
  $sql = "select * from vienn_role where role_id=?";
  $row = $this->getDb()->fetchAssoc($sql, array($id));
  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new \Exception("No role  matching id " . $id);
  }
 }
 
 protected function buildDomainObject(array $row) {
  $role = new Role();
  $role->setId($row['role_id']);
  $role->setUser($row['role_name']);
  return $role;
 }
}
