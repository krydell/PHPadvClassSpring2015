<?php
/**
 * Description of EmailTypeDAO
 * 
 * DAO = Data Access Object
 * 
 * The idea of a Data Access object is a class the will simply execute crud 
 * operations for your database.  We want to be able to create a DAO for each
 * table in your database.
 * 
 * CRUD = (Create Read Update Disable/Delete)
 *
 * @author User
 */

//namespace kvasile\week2;

class EmailTypeDAO implements IDAO {
    
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

    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
         
        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
        
    
    public function getById($id) {
         
         $model = new EmailTypeModel(); // this creates a dependacy, how can we fix this
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
         
         if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);            
         }
         
         return $model;
    }
    
    
    public function save(IModel $model) {
                 
         $db = $this->getDB();
         
         $values = array( ":emailtype" => $model->getEmailtype(),
                          ":active" => $model->getActive()
                    );
         
                
         if ( $this->idExisit($model->getEmailtypeid()) ) {
             $values[":emailtypeid"] = $model->getEmailtypeid();
             $stmt = $db->prepare("UPDATE emailtype SET emailtype = :emailtype, active = :active WHERE emailtypeid = :emailtypeid");
         } else {             
             $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype, active = :active");
         }
         
          
         if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
         }
         
         return false;
    }
    
    
    public function delete($id) {
          
         $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM emailtype WHERE emailtypeid = :emailtypeid");
         
         if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
     
    
    
    public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value) {
               $model = new EmailTypeModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {            
           //log($db->errorInfo() .$stmt->queryString ) ;           
        }  
        
        $stmt->closeCursor();         
         return $values;
     }
     
}