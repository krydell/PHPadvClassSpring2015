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

class EmailModel implements IModel {
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $emailtypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getEmailid() {
        return $this->emailid;
    }
    function getEmail() {
        return $this->email;
    }
    function getEmailtypeid() {
        return $this->emailtypeid;
    }
    
     function getEmailtype() {
        return $this->emailtype;
    }
    function getEmailtypeactive() {
        return $this->emailtypeactive;
    }
    function getLogged() {
        return $this->logged;
    }
    function getLastupdated() {
        return $this->lastupdated;
    }
    function getActive() {
        return $this->active;
    }
    function setEmailid($emailid) {
        $this->emailid = $emailid;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }
    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }
    function setEmailtypeactive($emailtypeactive) {
        $this->emailtypeactive = $emailtypeactive;
    }
    
    function setLogged($logged) {
        $this->logged = $logged;
    }
    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }
    function setActive($active) {
        $this->active = $active;
    }
    
    /*
    * When a class has to implement an interface those functions must be created in the class.
    */
    public function reset() {
        $this->setEmailid('');
        $this->setEmail('');
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        $this->setEmailtypeactive('');
        $this->setLogged('');
        $this->setLastupdated('');
        $this->setActive('');
        return $this;
    }
    
    
   
    public function map(array $values) { // To map values to the model.
        
        if ( array_key_exists('emailid', $values) ) {
            $this->setEmailid($values['emailid']);
        }
        
        if ( array_key_exists('email', $values) ) {
            $this->setEmail($values['email']);
        }
        
        if ( array_key_exists('emailtypeid', $values) ) {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) ) {
            $this->setEmailtype($values['emailtype']);
        }
        
        if ( array_key_exists('emailtypeactive', $values) ) {
            $this->setEmailtypeactive($values['emailtypeactive']);
        }
        
        if ( array_key_exists('logged', $values) ) {
            $this->setLogged($values['logged']);
        }
        
        if ( array_key_exists('lastupdated', $values) ) {
            $this->setLastupdated($values['lastupdated']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }
}