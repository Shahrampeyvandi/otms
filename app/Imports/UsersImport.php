<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // foreach ($rows as $row) {

        // dump($row['client_id']);
        // dd($row->toArray());
        // dump($row['client_id']);
         if($user = User::where(['client_id'=>$row['client_id']])->first()){

         }else{
             $user = new User;
             $user->client_id =$row['client_id'];
         }
            $user->client_en_name =$row['client_name_en'];
            $user->client_fa_name =$row['client_name_fa'];
            $user->economic_code =$row['economic_code'];
            $user->national_idcode =$row['national_idcode'];
            $user->email =$row['email'];
            $user->addressen =$row['addressen'];
            $user->addressfa =$row['addressfa'];
            $user->tel =$row['tel'];
            $user->fax =$row['fax'];
            $user->mob =$row['mob'];
           return $user;
        
 
        // foreac; ($row->toArray() as $key => $value) {

        // $user = new User();
        // $user->clientID = $row['client_id'];
        // $user->clientEnName = $row['client_name_en'];
        // $user->clientFaName = $row['client_name_fa'];
        // $user->password = 12345;
        // $user->save();
        // }
        // }
    }
}
