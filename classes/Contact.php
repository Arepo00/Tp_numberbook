<?php 
class Contact { 
    private $id; 
    private $name; 
    private $telephone; 
    
    function __construct($id, $name, $telephone) { 
        $this->id = $id; 
        $this->name = $name; 
        $this->telephone = $telephone; 
    } 
    
    function getId() { 
        return $this->id; 
    } 
    
    function getName() { 
        return $this->name; 
    } 
    
    function getTelephone() {
        return $this->telephone; 
    } 
    
    function setId($id) { 
        $this->id = $id; 
    } 
    
    function setName($name) { 
        $this->name = $name; 
    } 
    
    function setTelephone($telephone) { 
        $this->telephone = $telephone; 
    } 
    
    public function __toString() { 
        return $this->name; 
    } 
}