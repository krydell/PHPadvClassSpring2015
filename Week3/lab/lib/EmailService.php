<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of EmailService
 *
 * @author User
 */
//namespace kvasile\week2;

class EmailService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailDAO;
    private $_EmailModel;
    public function __construct($db, $util, $validator, $emailDAO, $emailModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailDAO = $emailDAO;
        $this->_EmailModel = $emailModel;
    }
    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_EmailDAO->save($this->_EmailModel) ) {
                echo '<font color="green">Email added/updated.</font>';
            } else {
                echo '<font color="red">Email could not be added.</font>';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->emailIsValid($this->_EmailModel->getEmail()) ) {
                 $this->_errors[] = 'Email Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_EmailModel->getActive()) ) {
                 $this->_errors[] = 'Active is invalid';
            } 
        }
         
    }
    
    
    public function displayErrors() {
       
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
         
    }
    
    public function hasErrors() {        
        return ( count($this->_errors) > 0 );        
    }
    public function displayEmails() {        
       // this doesn't make good use of the getallrows function in my DAO
        $stmt = $this->_DB->prepare("SELECT * FROM email");
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['email'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    public function displayEmailsActions() {        
        
        $emails = $this->_EmailDAO->getAllRows();
        
        if ( count($emails) < 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>E-mail</th><th>Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($emails as $value) {
                echo '<tr>';
                echo '<td>', $value->getEmail(),'</td>';
                echo '<td>',$value->getEmailtype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><a href=update-emails.php?id=',$value->getEmailid(),'>Update</a></td>';
                echo '<td><a href=delete.php?id=',$value->getEmailid(),'>Delete</a></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
        
       
        
    }
    
    
    
    
}