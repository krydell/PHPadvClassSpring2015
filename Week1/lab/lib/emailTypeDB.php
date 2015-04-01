<?php

/*
 *  Returns an echo of the e-mails found.
 * 
 */
class emailTypeDB {

    public function getEmails(){
        
        $dbConfig = array(
            "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER" => 'root', 
            "DB_PASSWORD" => '');
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo '<h3>Types of E-mails</h3>';
            foreach ($results as $value) {
                echo '<p>- <strong>', $value['emailtype'], '</strong></p>';
            }
        } else {
            echo '<p>No Data</p>';
        }        
        
    }
    
/*
 *  Saves the e-mails to the databse.
 * 
 * 
 */    
    
    public function saveEmails(){
        $util = new Util();
        
        $validator = new Validator();
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $errors = array();
        if ($util->isPostRequest()) {
            if (!$validator->emailTypeIsValid($emailType)) {
                $errors[] = 'E-mail type is not valid';
            }
        }
        if (count($errors) > 0) {
            foreach ($errors as $value) {
                echo '<p>', $value, '</p>';
            }
        } else {

            // Save the submission into the database. 
            
            $dbConfig = array(
                "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER" => 'root',
                "DB_PASSWORD" => ''
            );


            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");

            $values = array(":emailtype" => $emailType);
            if ($stmt->execute($values) && $stmt->rowCount() > 0) {
                echo 'E-mail Added';
            }
        }
    }
    
}