<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZIPCodeDAO
 *
 * @author User
 */

namespace App\Model\Service;


use App\Model\Models\ZIPCodeModel;
use \PDO;

class ZIPCodeDAO {
    //put your code here
    
    private $DB = null;


    public function __construct( PDO $db ) {
        
        $this->setDB($db);
        
        
    }
    
    private function setDB( PDO $DB) {
        
            $this->DB = $DB;
    }
    
    private function getDB() {
        return $this->DB;
    }

    
     public function getById($id) {
         
         $zipcodeModel = new ZIPCodeModel();
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT * FROM zipcodes WHERE Zipcode = :Zipcode");
         
         if ( $stmt->execute(array(':Zipcode' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $zipcodeModel->map($results);
         }
         
         return $zipcodeModel;
     }
     
     /*
     public function getAll() {
         
         $zipcodes = array();
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT * FROM zipcodes");
         
         if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
             
             foreach ($results as $value) {
                 $zipcodes[] = new ZIPCodeModel($value);
             }
             
         }
         
         return $zipcodes;
     }
    
     */

    
}
