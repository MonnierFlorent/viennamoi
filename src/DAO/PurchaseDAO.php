<?php

namespace viennamoi\DAO;

use viennamoi\Domain\Purchase;

class PurchaseDAO extends DAO {
    private $userDAO;
    
    public function setUserDAO(UserDAO $userDAO) {
	$this->userDAO = $userDAO;
    }
    
    public function find($id) {
        $sql = "select * from purchase where user_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
	    return $this->buildDomainObject($row);
	} else {
	    throw new \Exception("No purchase matching id " . $id);
	    //fonctionne aussi sans le '\'
	}
    }
    
    public function findALL() {
	$sql = "select * from purchase order by user_id desc";
	$result = $this->getDb()->fetchAll($sql);
	
	//convert query result to an array of domain objects
	$entities = array ();
	foreach ($result as $row) {
	    $id = $row['user_id'];
	    $entities[$id] = $this->buildDomainObject($row);
	}
	return $entities;
    }
 
/////////////// a revoir ///////////////////////////    
    public function save(Purchase $purchase) {
	if ($purchase->getStock()== 0) {
	    $available = 0;
	}
	else {
	    $available = getStock()-1;
	}
	
	if($purchase->getUser()== null) {
	    $userId = null;
	}
	else {
	    $userId = $purchase->getUser()->getId();
	}
	
	$purchaseData = array(
            'prod_id' => $purchase->getProd_id(),
            'user_id' => $purchase->getUser_id(),
	    'price' => $purchase->getPrice(),
	    'quantity' => $purchase->getQuantity(),
	    'hour' => $purchase->getHour(),
            );

        if ($purchase->getId()) {
            // The book has already been saved : update it
            $this->getDb()->update('books', $purchaseData, array('book_id' => $purchase->getId()));
        } else {
            // The book has never been saved : insert it
            $this->getDb()->insert('books', $purchaseData);
            // Get the id of the newly created book and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $purchase->setId($id);
        }
    }
 /////////////////////////////////////////////////////
    
    protected function buildDomainObject(array $row) {
	$purchase = new Purchase();
	$purchase->setProd_id($row['prod_id']);
	$purchase->setUser_id($row['user_id']);
        $purchase->setQuantity($row['quantity']);
        $purchase->setPrice($row['price']);
        $purchase->setHour($row['hour']);
	
	if ($row['user_id']!=null) {
	    // find and set the associated user
	    $userId = $row['user_id'];
	    $user = $this->userDAO->find($userId);
	    $purchase->setUser($user);
	}	
        return $purchase;
    }
    
    public function delete($id) {
        // Delete the book
	$this->getDb()->delete('purchase', array('user_id' => $id));
	
    }
}
