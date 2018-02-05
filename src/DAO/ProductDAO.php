<?php

namespace viennamoi\DAO;

use viennamoi\Domain\Product;

class ProductDAO extends DAO{
    
    public function find($id) {
        $sql = "select * from vienn_format where format_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
	    return $this->buildDomainObject($row);
	} else {
	    throw new \Exception("No product matching id " . $id);
	    //fonctionne aussi sans le '\'
	}
    }
    
    public function findALL() {
	$sql = "select * from vienn_format order by format_cate";
	$result = $this->getDb()->fetchAll($sql);
	
	//convert query result to an array of domain objects
	$entities = array ();
	foreach ($result as $row) {
	    $id = $row['format_id'];
	    $entities[$id] = $this->buildDomainObject($row);
	}
	return $entities;
    }
    
    public function save(Product $product) {
		
	$productData = array(
            'format_name' => $product->getName(),
            'format_price' => $product->getContent(),
            'format_content' => $product->getPrice(),
            'format_cate' => $product->getCate(),
            'format_stock' => $product->getStock(),
	    	    
            );

        if ($product->getId()) {
            // The book has already been saved : update it
            $this->getDb()->update('vienn_format', $productData, array('format_id' => $product->getId()));
        } else {
            // The book has never been saved : insert it
            $this->getDb()->insert('vienn_format', $productData);
            // Get the id of the newly created book and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $product->setId($id);
        }
    }
    
    protected function buildDomainObject(array $row) {
	$product = new Product();
	$product->setId($row['format_id']);
	$product->setName($row['format_name']);
    $product->setContent($row['format_content']);
    $product->setPrice($row['format_price']);
    $product->setStock($row['format_stock']);	
    $product->setCate($row['format_cate']);	
		
        return $product;
    }
    
    public function delete($id) {
        // Delete the book
	$this->getDb()->delete('product', array('format_id' => $id));
	
    }

}
