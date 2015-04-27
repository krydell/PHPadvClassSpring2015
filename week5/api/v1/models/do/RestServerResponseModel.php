<?php

/**
 * Description of RestServerResponseModel
 *
 * @author User
 */

namespace App\models\services;


class RestServerResponseModel extends BaseModel {
   
    private $status_code;
    private $status_message;
    private $data;
     
    function getStatus_code() {
        return $this->status_code;
    }

    function getStatus_message() {
        return $this->status_message;
    }

    function getData() {
        return $this->data;
    }


    function setStatus_code($status_code) {
        $this->status_code = $status_code;
    }

    function setStatus_message($status_message) {
        $this->status_message = $status_message;
    }

    function setData($data) {
        $this->data = $data;
    }
      
}
