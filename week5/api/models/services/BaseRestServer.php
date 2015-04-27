<?php

/**
 * Description of API
 *
 * @author GFORTI
 */
abstract class BaseRestServer {
    
   
    
    function getHTTPVerb(){        
        
        $verb = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $httpMethod = filter_input(INPUT_SERVER, 'HTTP_X_HTTP_METHOD');
        
        if ( $verb === 'POST' ) {
            if ( $httpMethod === 'DELETE') {
                $verb = 'DELETE';
            } else if ( $httpMethod === 'PUT') {
                $verb = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
        
        return $verb;
    }
    
    
    function getHTTPData() {
        $data = array();// file_get_contents("php://input");
        
        $verb = $this->getHTTPVerb();
        
        
        switch($verb) {
        case 'DELETE':
        case 'POST':
            $data = filter_input_array(INPUT_POST);
            break;
        case 'GET':
            $data = filter_input_array(INPUT_GET);
            break;
        case 'PUT':
            parse_str(file_get_contents('php://input'), $data);
            //$this->file = file_get_contents("php://input");
            break;       
        }
        
        return $data;
    }
     
    
}
