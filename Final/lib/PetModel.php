<?php
/**
 * EmailModel
 * 
 * The idea of the model(Data Object) is to provide an object the reflects your
 * table in your database.  Notice all the private variables are the colums from
 * the table in our database.
 * 
 * One word of advise, keep all table names in your models class lowercase.  When creating 
 * getter and setter functions it will camel case (Java Style) your functions.
 *
 * @author User
 */

//namespace kvasile\week2;

class PetModel implements IModel {
 
    private $pet_id;
    private $pet_name;
    private $species;
    private $happy;
    private $hungry;
    private $owner;

    
    function getPetId() {
        return $this->pet_id;
    }
    function getPetname() {
        return $this->pet_name;
    }
    function getSpecies() {
        return $this->species;
    }
    
     function getHappy() {
        return $this->happy;
    }
    function getHungry() {
        return $this->hungry;
    }
    function getOwner() {
        return $this->owner;
    }
    function setPetid($emailid) {
        $this->pet_id = $emailid;
    }
    function setPetname($email) {
        $this->pet_name = $email;
    }
    function setSpecies($emailtypeid) {
        $this->species = $emailtypeid;
    }
    function setHappy($emailtype) {
        $this->setHappy = $emailtype;
    }
    function setHunger($emailtypeactive) {
        $this->setHunger = $emailtypeactive;
    }
    function setOwner($emailtypeactive) {
        $this->owner = $emailtypeactive;
    }
    
    
    /*
    * When a class has to implement an interface those functions must be created in the class.
    */
    public function reset() {
        $this->pet_id('');
        $this->pet_name('');
        $this->species('');
        $this->happy('');
        $this->hungry('');
        $this->owner('');

        return $this;
    }
    
    
   
    public function map(array $values) { // To map values to the model.
        
        if ( array_key_exists('pet_id', $values) ) {
            $this->setPetid($values['pet_id']);
        }
        
        if ( array_key_exists('name', $values) ) {
            $this->setPetname($values['name']);
        }
        
        if ( array_key_exists('pet', $values) ) {
            $this->setSpecies($values['pet']);
        }
        
        if ( array_key_exists('happy', $values) ) {
            $this->setHappy($values['happy']);
        }
        
        if ( array_key_exists('hunger', $values) ) {
            $this->setHunger($values['hunger']);
        }
        
        if ( array_key_exists('username', $values) ) {
            $this->setOwner($values['username']);
        }

        return $this;
    }
}