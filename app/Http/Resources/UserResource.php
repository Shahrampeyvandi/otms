<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
                'client_en_name'=>$this->client_en_name,
                'client_fa_name'=>$this->client_fa_name,
                'tel'=>$this->tel,
                'mob'=>$this->mob,
                'fax'=>$this->fax,
                'email'=>$this->email,
        ];
    }
}
