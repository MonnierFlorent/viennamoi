<?php

namespace viennamoi\DAO;

use viennamoi\Domain\Category;

/**
 * Description of CategoryDAO
 *
 * @author Etudiant
 */
class CategoryDAO extends DAO {

 public function find($id) {
  $sql = "select * from vienn_category where cate_id=?";
  $row = $this->getDb()->fetchAssoc($sql, array($id));

  if ($row) {
   return $this->buildDomainObject($row);
  } else {
   throw new \Exception("No product matching id " . $id);
   //fonctionne aussi sans le '\'
  }
 }

 public function findALL() {
  $sql = "select * from vienn_category order by cate_id ";
  $result = $this->getDb()->fetchAll($sql);

  //convert query result to an array of domain objects
  $entities = array();
  foreach ($result as $row) {
   $id = $row['cate_id'];
   $entities[$id] = $this->buildDomainObject($row);
  }
  return $entities;
 }

 public function save(Category $category) {

  $categoryData = array(
      'cate_name' => $category->getName(),
      'cate_content' => $category->getContent(),
      'cate_image' => $category->getImage(),
  );

  if ($category->getId()) {
   // The book has already been saved : update it
   $this->getDb()->update('vienn_category', $categoryData, array('category_id' => $category->getId()));
  } else {
   // The book has never been saved : insert it
   $this->getDb()->insert('vienn_category', $categoryData);
   // Get the id of the newly created book and set it on the entity.
   $id = $this->getDb()->lastInsertId();
   $category->setId($id);
  }
 }

 protected function buildDomainObject(array $row) {
  $category = new Category();
  $category->setId($row['cate_id']);
  $category->setName($row['cate_name']);
  $category->setContent($row['cate_content']);
  $category->setImage($row['cate_image']);


  return $category;
 }

 public function delete($id) {
  // Delete the book
  $this->getDb()->delete('vienn_category', array('category_id' => $id));
 }

}
