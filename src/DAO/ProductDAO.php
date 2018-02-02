<?php

namespace viennamoi\DAO;

use viennamoi\Domain\Product;

class ProductDAO extends DAO{
    
    public function find($id) {
        $sql = "select * from products where prod_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
	    return $this->buildDomainObject($row);
	} else {
	    throw new \Exception("No product matching id " . $id);
	    //fonctionne aussi sans le '\'
	}
    }
    
    public function findALL() {
	$sql = "select * from products order by prod_id desc";
	$result = $this->getDb()->fetchAll($sql);
	
	//convert query result to an array of domain objects
	$entities = array ();
	foreach ($result as $row) {
	    $id = $row['prod_id'];
	    $entities[$id] = $this->buildDomainObject($row);
	}
	return $entities;
    }
    
    public function save(Product $product) {
		
	$productData = array(
            'prod_name' => $product->getName(),
            'prod_content' => $product->getContent(),
	    'prod_price' => $product->getPrice(),
	    'prod_stock' => $product->getStock(),
	    	    
            );

        if ($product->getId()) {
            // The book has already been saved : update it
            $this->getDb()->update('product', $productData, array('prod_id' => $product->getId()));
        } else {
            // The book has never been saved : insert it
            $this->getDb()->insert('product', $productData);
            // Get the id of the newly created book and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $product->setId($id);
        }
    }
    
    protected function buildDomainObject(array $row) {
	$product = new Product();
	$product->setId($row['prod_id']);
	$product->setName($row['prod_name']);
        $product->setContent($row['prod_content']);
        $product->setPrice($row['prod_price']);
        $product->setStock($row['prod_stock']);	
		
        return $product;
    }
    
    public function delete($id) {
        // Delete the book
	$this->getDb()->delete('product', array('prod_id' => $id));
	
    }

}
