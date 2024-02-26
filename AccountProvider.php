<?php

namespace App\providers;
use App\util\BaseDataProvider;

class AccountProvider extends BaseDataProvider{
    protected function collection(){
      return "account_holders_information";
    }
}
