<?php

namespace viennamoi\DAO;

use viennamoi\Domain\Provider;

class ProviderDAO extends DAO{
    
    public function find($id) {
        $sql = "select * from providers where prov_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
	    return $this->buildDomainObject($row);
	} else {
	    throw new \Exception("No provider matching id " . $id);
	    //fonctionne aussi sans le '\'
	}
    }
    
    public function findALL() {
	$sql = "select * from providers order by prov_id desc";
	$result = $this->getDb()->fetchAll($sql);
	
	//convert query result to an array of domain objects
	$entities = array ();
	foreach ($result as $row) {
	    $id = $row['prov_id'];
	    $entities[$id] = $this->buildDomainObject($row);
	}
	return $entities;
    }
    
    public function save(Provider $provider) {
		
	$providerData = array(
            'prov_name' => $provider->getName(),
            'prov_content' => $provider->getContent(),
	    'prov_adress' => $provider->getAdress(),
	    'prov_zip' => $provider->getZip(),
	    'prov_city' => $provider->getCity(),
	    'prov_img' => $provider->getImage(),
	    
            );

        if ($provider->getId()) {
            // The provider has already been saved : update it
            $this->getDb()->update('providers', $providerData, array('prov_id' => $provider->getId()));
        } else {
            // The provider has never been saved : insert it
            $this->getDb()->insert('providers', $providerData);
            // Get the id of the newly created book and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $provider->setId($id);
        }
    }
    
    protected function buildDomainObject(array $row) {
	$provider = new Provider();
	$provider->setId($row['prov_id']);
	$provider->setName($row['prov_name']);
        $provider->setContent($row['prov_content']);
        $provider->setAdress($row['prov_adress']);
        $provider->setZip($row['prov_zip']);
	$provider->setCity($row['prov_city']);
	$provider->setImage($row['prov_img']);
			
        return $provider;
    }
    
    public function delete($id) {
        // Delete the book
	$this->getDb()->delete('providers', array('prov_id' => $id));
	
    }

}
