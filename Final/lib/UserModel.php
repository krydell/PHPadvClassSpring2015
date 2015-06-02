<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserModel implements IModel {
    private $username;
    private $password;
    private $points;
    private $pets;

    function getUsername() {
        return $this->username;
    }
    function getPassword() {
        return $this->password;
    }
    function getPoints() {
        return $this->poins;
    }
    function getPets() {
        return $this->pets;
    }
    function setUsername($emailid) {
        $this->username = $emailid;
    }
    function setPassword($email) {
        $this->password = $email;
    }
    function setPoints($emailid) {
        $this->poins = $emailid;
    }
    function setPets($email) {
        $this->pets = $email;
    }

    public function reset() {
        $this->username('');
        $this->password('');
        $this->pets('');
        $this->points('');

        return $this;
    }
    
    
   
    public function map(array $values) { // To map values to the model.
        
        if ( array_key_exists('username', $values) ) {
            $this->setUsername($values['username']);
        }
        
        if ( array_key_exists('password', $values) ) {
            $this->setPassword($values['password']);
        }
        
        if ( array_key_exists('points', $values) ) {
            $this->setPoints($values['points']);
        }
        
        if ( array_key_exists('pets', $values) ) {
            $this->setPets($values['pets']);
        }


        return $this;
    }
}
