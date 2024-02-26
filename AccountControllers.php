<?php

namespace App\controllers;
use App\providers\AccountProvider;
use MongoDB\BSON\ObjectId;

class AccountControllers{
 
  private $dbObj ;
  
  public function __construct(){
        $this->dbObj = new AccountProvider();
  }
  
  public function createAccount($data){
        $validationResult = $this->isValidData($data);
        if ($validationResult["valid"]) {
            return ["result" => $validationResult["message"]];
        }
       
        $result = $this->dbObj->insertOne($data);
        return ["result" => "$result", $validationResult["message"]];
    }

  private function isValidData($data){
        if(!isset($data["name"])|| !preg_match('/^[a-zA-Z]+$/', $data['name'])){
            return ["valid"=>"false","message"=>"name contains only alphabets"];
        }

        if(!preg_match('/^\d{12}$/', $data['adhaarNumber'])){
            return ["valid"=>"false",
                "message"=>"Invalid adhaar number"];
        }

        if($data['DOB']) {
            $diff = date_diff(date_create($data['DOB']), date_create());
            $age = $diff->y;
            if ($age < 18) {
                return ["valid"=>"false","message" => "not eligible"];
            }
        }

        return ["message"=>"congratulations account created successfully"];
    }
}
