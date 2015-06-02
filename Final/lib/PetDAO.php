 <?php
/**
 * EmailDAO
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
// *** NOTE this class is not complete and does not work
 
//namespace kvasile\week2; 
 
class PetDAO implements IDAO {
    
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
         
         $model = new EmailModel(); 
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT pets.pet_id, pets.pet_name, pets.species, pets.happy, pets.hungry, pets.owner"
                 . " FROM pets LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid WHERE emailid = :emailid");
         
         if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
         }
         
         return $model;
    }
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT emailid FROM email WHERE emailid = :emailid");
         
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }    
    
    public function save(IModel $model) {
                 
         $db = $this->getDB();
         
         $values = array( ":pet_name" => $model->getPetname(),
                          ":owner" => $model->getOwner(),
                          ":pet" => $model->getSpecies(),
                          ":happy" => 10,
                          ":hungry" => 100,
             
                    );
         
                
         if ( $this->idExisit($model->getPetId()) ) {

             $values[":pet_id"] = $model->getPetId();
             $stmt = $db->prepare("UPDATE pets SET pet_name = :pet_name, happy = :happy, hungry = :hungry WHERE pet_id = :pet_id");
         } else {  
             $stmt = $db->prepare("INSERT INTO pets SET SET pet_name = :pet_name, happy = :happy, hungry = :hungry, species = :pet");
         }
         
    
         if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
         }
         
         return false;
    }
    
    
    public function delete($id) {
          
         $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM pets WHERE pet_id = :pet_id");
         
         if ( $stmt->execute(array(':pet_id' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
     
    
    
    public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT pets.pet_name, pets.species, pets.hungry, pets.happy"
                 . " FROM pets, login"); // WHERE login.username = pets.owner
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value) {
               $model = new PetModel();
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