<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZIPCodeModel
 *
 * @author User
 */

namespace App\models;

class ZIPCodeModel {
        
    private $Zipcode;
    private $ZipCodeType;
    private $City;
    private $State;
    private $LocationType;
    private $Lat;
    private $Lng;
    private $Location;
    private $Decommisioned;
    private $TaxReturnsFiled;
    private $EstimatedPopulation;
    private $TotalWages;
    
    public function __construct(array $values = array()) {
        $this->map($values);
         return $this;
    }
    
    public function map(array $values) {
        
        foreach ($values as $key => $value) {
           $method = 'set' . $key;
            if ( method_exists($this, $method) ) {
                $this->$method($value);
            }       
        } 
        return $this;
    }
    
      public function reset() {
        
        $class_methods = get_class_methods($this);

        foreach ($class_methods as $method_name) {
           if ( strrpos($method_name, 'set', -strlen($method_name)) !== FALSE ) {
               $this->$method_name('');
           }
            
        } 
         return $this;
    }
    
    public function getAll() {
        $class_vars = get_class_vars(__CLASS__);
        $values = array();

        foreach ($class_vars as $var_name => $value) {
            $method = 'get' . $var_name;
            $values[$var_name] = '';
            if ( method_exists($this, $method) ) {            
                $values[$var_name] = $this->$method();
            }
        }

        return $values; 
        
    }
    
    
    function getZipcode() {
        return $this->Zipcode;
    }

    function getZipCodeType() {
        return $this->ZipCodeType;
    }

    function getCity() {
        return $this->City;
    }

    function getState() {
        return $this->State;
    }

    function getLocationType() {
        return $this->LocationType;
    }

    function getLat() {
        return $this->Lat;
    }

    function getLng() {
        return $this->Lng;
    }

    function getLocation() {
        return $this->Location;
    }

    function getDecommisioned() {
        return $this->Decommisioned;
    }

    function getTaxReturnsFiled() {
        return $this->TaxReturnsFiled;
    }

    function getEstimatedPopulation() {
        return $this->EstimatedPopulation;
    }

    function getTotalWages() {
        return $this->TotalWages;
    }

    function setZipcode($Zipcode) {
        $this->Zipcode = $Zipcode;
    }

    function setZipCodeType($ZipCodeType) {
        $this->ZipCodeType = $ZipCodeType;
    }

    function setCity($City) {
        $this->City = $City;
    }

    function setState($State) {
        $this->State = $State;
    }

    function setLocationType($LocationType) {
        $this->LocationType = $LocationType;
    }

    function setLat($Lat) {
        $this->Lat = $Lat;
    }

    function setLng($Lng) {
        $this->Lng = $Lng;
    }

    function setLocation($Location) {
        $this->Location = $Location;
    }

    function setDecommisioned($Decommisioned) {
        $this->Decommisioned = $Decommisioned;
    }

    function setTaxReturnsFiled($TaxReturnsFiled) {
        $this->TaxReturnsFiled = $TaxReturnsFiled;
    }

    function setEstimatedPopulation($EstimatedPopulation) {
        $this->EstimatedPopulation = $EstimatedPopulation;
    }

    function setTotalWages($TotalWages) {
        $this->TotalWages = $TotalWages;
    }


    
    
}
