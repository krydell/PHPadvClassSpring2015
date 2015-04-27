<?php

/**
 * Description of RestServerResponseModel
 *
 * @author User
 */
class RestServerResponseModel {
    private $response = array();
    
    protected $status_codes = array(  
            200 => 'OK',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 

   public function __construct(){
        $this->response = array(
            "status_code" => '',
            "status_message" => '',
            "data" => null
        );
    }

    
    public function setStatusCode($code) {
        if ( isset($this->status_codes[$code]) ) {
            $this->response["status_code"] = $code;
            $this->response["status_message"] = $this->status_codes[$code];            
        }
    }
    
    public function setData($data) {
        $this->response["data"] = $data;
    }
    
    public function getReponse() {
        return $this->response;
    }
   
     public function getJSONReponse() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
    
    public function getStatusCodes() {
        return $this->status_codes;
    }
    
     public function getStatusMessage($code) {
        return ( isset($this->status_codes[$code]) ? $this->status_codes[$code] : $this->status_codes[500] );
    }
}
