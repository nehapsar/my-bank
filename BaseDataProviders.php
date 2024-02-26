<?php

namespace App\util;

abstract  class BaseDataProvider{
  
    private $dbObj;
    private $collectionObject;

    public function __construct(){
        $this->dbObj = new DatabaseUtil();
        $this->collectionObject = $this->dbObj->getConnection($this->collection());
    }

    abstract protected function collection();

    public function insertOne($data){
        if(!isset($data['accountNumber'])) {
            $data['accountNumber'] = $this->generateAccountNumber();
        }
      
        if(!isset($data['balance'])){
            $data['balance'] = 0;
        }
      
        $result = $this->collectionObject->insertOne($data);
        return $result->isAcknowledged();
    }
  
    private function generateAccountNumber(){
        $accountNumber = rand(100,999);
        return $accountNumber;
    }
}
