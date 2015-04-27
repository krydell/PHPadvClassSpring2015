<?php

/**
 * Description of PhoneTypeRestServer
 *
 * @author User
 */
class RestServer {
    
    private $response;
    private $model;


    public function __construct( $restModel, $responseModel ) {
        
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        
        
        $restModel->setVerb($this->getHTTPVerb());
        $restModel->getRequestData($this->getHTTPData());
        
        $restModel->setEndpoint( filter_input(INPUT_GET, 'endpoint') );
        
        $endpoint = $restModel->getEndpoint();
        
        $restArgs = explode('/', rtrim($endpoint, '/'));
        $restModel->setResource(array_shift($restArgs));
        
        if ( isset($restArgs[0]) && is_numeric($restArgs[0]) ) {
            $restModel->setId($restArgs[0]);
        }
       
        $this->response = $responseModel;
        $this->model = $restModel;
        
    }
    
    public function process() {
        
        
        return $this->_response(null, 404);
        
    }
    
    protected function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->response->getStatusMessage($status));
        
        $this->response->setStatusCode($status);
        $this->response->setData($data);
        
        return $this->response->getJSONReponse();
    }
    
    
    protected function _getHTTPVerb(){        
        
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
    
    
    protected function _getHTTPData() {
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
